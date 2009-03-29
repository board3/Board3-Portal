<?php
/*
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
if (!defined('IN_PHPBB') or !defined('IN_PORTAL'))
{
	exit;
}

/**
* @ignore
*/

$user->add_lang('viewtopic');

$view = request_var('view', '');
$update = request_var('update', false);
$poll_view = request_var('polls', '');

$poll_view_ar = ( strpos(urldecode($poll_view), ',') !== FALSE ) ? explode(',', urldecode($poll_view)) : (($poll_view != '') ? array($poll_view) : array());

if ($update && $portal_config['portal_poll_allow_vote'])
{
	$up_topic_id = request_var('t', 0);
	$up_forum_id = request_var('f', 0);
	$voted_id = request_var('vote_id', array('' => 0));

	$cur_voted_id = array();
	if ($user->data['is_registered'])
	{
		$sql = 'SELECT poll_option_id
			FROM ' . POLL_VOTES_TABLE . '
			WHERE topic_id = ' . $up_topic_id . '
				AND vote_user_id = ' . $user->data['user_id'];
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$cur_voted_id[] = $row['poll_option_id'];
		}
		$db->sql_freeresult($result);
	}
	else
	{
		// Cookie based guest tracking ... I don't like this but hum ho
		// it's oft requested. This relies on "nice" users who don't feel
		// the need to delete cookies to mess with results.
		if (isset($_COOKIE[$config['cookie_name'] . '_poll_' . $up_topic_id]))
		{
			$cur_voted_id = explode(',', $_COOKIE[$config['cookie_name'] . '_poll_' . $up_topic_id]);
			$cur_voted_id = array_map('intval', $cur_voted_id);
		}
	}

	$sql = 'SELECT t.poll_length, t.poll_start, t.poll_vote_change, t.topic_status, f.forum_status, t.poll_max_options
			FROM ' . TOPICS_TABLE . ' t, ' . FORUMS_TABLE . " f
			WHERE t.forum_id = f.forum_id AND t.topic_id = " . (int) $up_topic_id . " AND t.forum_id = " . (int) $up_forum_id;
	$result = $db->sql_query_limit($sql, 1);
	$topic_data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$s_can_up_vote = (((!sizeof($cur_voted_id) && $auth->acl_get('f_vote', $up_forum_id)) ||
		($auth->acl_get('f_votechg', $up_forum_id) && $topic_data['poll_vote_change'])) &&
		(($topic_data['poll_length'] != 0 && $topic_data['poll_start'] + $topic_data['poll_length'] > time()) || $topic_data['poll_length'] == 0) &&
		$topic_data['topic_status'] != ITEM_LOCKED &&
		$topic_data['forum_status'] != ITEM_LOCKED) ? true : false;

	if( $s_can_up_vote )
	{
		if (!sizeof($voted_id) || sizeof($voted_id) > $topic_data['poll_max_options'] || in_array(VOTE_CONVERTED, $cur_voted_id))
		{
			$redirect_url = append_sid("./portal.$phpEx");
	
			meta_refresh(5, $redirect_url);
			if (!sizeof($voted_id))
			{
				$message = 'NO_VOTE_OPTION';
			}
			else if (sizeof($voted_id) > $topic_data['poll_max_options'])
			{
				$message = 'TOO_MANY_VOTE_OPTIONS';
			}
			else
			{
				$message = 'VOTE_CONVERTED';
			}
	
			$message = $user->lang[$message] . '<br /><br />' . sprintf($user->lang['RETURN_PORTAL'], '<a href="' . $redirect_url . '">', '</a>');
			trigger_error($message);
		}
	
		foreach ($voted_id as $option)
		{
			if (in_array($option, $cur_voted_id))
			{
				continue;
			}
	
			$sql = 'UPDATE ' . POLL_OPTIONS_TABLE . '
				SET poll_option_total = poll_option_total + 1
				WHERE poll_option_id = ' . (int) $option . '
					AND topic_id = ' . (int) $up_topic_id;
			$db->sql_query($sql);
	
			if ($user->data['is_registered'])
			{
				$sql_ary = array(
					'topic_id'			=> (int) $up_topic_id,
					'poll_option_id'	=> (int) $option,
					'vote_user_id'		=> (int) $user->data['user_id'],
					'vote_user_ip'		=> (string) $user->ip,
				);
	
				$sql = 'INSERT INTO ' . POLL_VOTES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				$db->sql_query($sql);
			}
		}
	
		foreach ($cur_voted_id as $option)
		{
			if (!in_array($option, $voted_id))
			{
				$sql = 'UPDATE ' . POLL_OPTIONS_TABLE . '
					SET poll_option_total = poll_option_total - 1
					WHERE poll_option_id = ' . (int) $option . '
						AND topic_id = ' . (int) $up_topic_id;
				$db->sql_query($sql);
	
				if ($user->data['is_registered'])
				{
					$sql = 'DELETE FROM ' . POLL_VOTES_TABLE . '
						WHERE topic_id = ' . (int) $up_topic_id . '
							AND poll_option_id = ' . (int) $option . '
							AND vote_user_id = ' . (int) $user->data['user_id'];
					$db->sql_query($sql);
				}
			}
		}
	
		if ($user->data['user_id'] == ANONYMOUS && !$user->data['is_bot'])
		{
			$user->set_cookie('poll_' . $up_topic_id, implode(',', $voted_id), time() + 31536000);
		}
	
		$sql = 'UPDATE ' . TOPICS_TABLE . '
			SET poll_last_vote = ' . time() . "
			WHERE topic_id = $up_topic_id";
		//, topic_last_post_time = ' . time() . " -- for bumping topics with new votes, ignore for now
		$db->sql_query($sql);
	
		$redirect_url = append_sid("./portal.$phpEx");
	
		meta_refresh(5, $redirect_url);
		trigger_error($user->lang['VOTE_SUBMITTED'] . '<br /><br />' . sprintf($user->lang['RETURN_PORTAL'], '<a href="' . $redirect_url . '">', '</a>'));
	}
}

$where = '';
$poll_forums = false;

if( $portal_config['portal_poll_topic_id'] !== '' )
{
	$poll_forums_config  = explode(',' ,$portal_config['portal_poll_topic_id']);
	foreach($poll_forums_config as $poll_forum )
	{
		if ( is_numeric(trim($poll_forum)) === TRUE )
		{
			$poll_forum = (int) trim($poll_forum);
			if( $auth->acl_get('f_read', $poll_forum) )
			{
				$poll_forums = true;
				$where .= ($where == "") ? "t.forum_id = '{$poll_forum}'" : " OR t.forum_id = '{$poll_forum}'";
			}
		}
	}
}
else
{
	$forum_list = $auth->acl_getf('f_read', true);

	foreach($forum_list as $pf => $pf_data )
	{
		$pf = (int) trim($pf);
		$poll_forums = true;
		$where .= ($where == "") ? "t.forum_id = '{$pf}'" : " OR t.forum_id = '{$pf}'";
	}
}

$where = ($where !== '') ? "AND ({$where})" : '';

if ($portal_config['portal_poll_hide'])
{
	$portal_poll_hide = "AND (t.poll_start + t.poll_length > ". time() ." OR t.poll_length = 0)";
} 
else
{
	$portal_poll_hide = '';
}

if( $poll_forums === TRUE )
{
	$sql = 'SELECT t.poll_title, t.poll_start, t.topic_id,  t.topic_first_post_id, t.forum_id, t.poll_length, t.poll_vote_change, t.poll_max_options, t.topic_status, f.forum_status, p.bbcode_bitfield, p.bbcode_uid
			FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p, ' . FORUMS_TABLE . " f
			WHERE t.forum_id = f.forum_id AND t.topic_approved = 1 AND t.poll_start > 0
			{$where}
			AND t.topic_moved_id = 0
			AND p.post_id = t.topic_first_post_id
			{$portal_poll_hide}
			ORDER BY t.poll_start DESC";

	$limit = ( isset($portal_config['portal_poll_limit']) ) ? $portal_config['portal_poll_limit'] : 3;

	$result = $db->sql_query_limit($sql, $limit);
	
	$has_poll = false;

	if ($result)
	{
		while( $data = $db->sql_fetchrow($result) )
		{
			if (!function_exists('poll_vote_block'))
			{
				include($phpbb_root_path . 'portal/includes/functions_poll.' . $phpEx);
			}
			poll_vote_block('poll');
		}
	}		

	$db->sql_freeresult($result);

	$template->assign_vars(array(
		'S_DISPLAY_POLL' => true,
		'S_HAS_POLL' => $has_poll,
		'POLL_LEFT_CAP_IMG'	=> $user->img('poll_left'),
		'POLL_RIGHT_CAP_IMG'=> $user->img('poll_right'),
	));
}

?>