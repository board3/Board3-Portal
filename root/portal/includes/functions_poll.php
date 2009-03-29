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

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
function poll_vote_block($poll_block)
{
	global $auth, $config, $data, $db, $portal_config, $template, $user;
	global $phpbb_root_path, $phpEx;
	global $poll_view_ar, $has_poll, $poll_has_options, $view, $poll_view, $update;
	
	$has_poll = true;
	$poll_has_options = false;

	$topic_id = (int) $data['topic_id'];
	$forum_id = (int) $data['forum_id'];

	$cur_voted_id = array();
	if( $portal_config['portal_poll_allow_vote'] )
	{
		if ($user->data['is_registered'])
		{
			$vote_sql = 'SELECT poll_option_id
				FROM ' . POLL_VOTES_TABLE . '
				WHERE topic_id = ' . $topic_id . '
					AND vote_user_id = ' . $user->data['user_id'];
			$vote_result = $db->sql_query($vote_sql);
				
			while ($row = $db->sql_fetchrow($vote_result))
			{
				$cur_voted_id[] = $row['poll_option_id'];
			}
			$db->sql_freeresult($vote_result);
		}
		else
		{
			// Cookie based guest tracking ... I don't like this but hum ho
			// it's oft requested. This relies on "nice" users who don't feel
			// the need to delete cookies to mess with results.
			if (isset($_COOKIE[$config['cookie_name'] . '_poll_' . $topic_id]))
			{
				$cur_voted_id = explode(',', $_COOKIE[$config['cookie_name'] . '_poll_' . $topic_id]);
				$cur_voted_id = array_map('intval', $cur_voted_id);
			}
		}
	
		$s_can_vote = (((!sizeof($cur_voted_id) && $auth->acl_get('f_vote', $forum_id)) ||
			($auth->acl_get('f_votechg', $forum_id) && $data['poll_vote_change'])) &&
			(($data['poll_length'] != 0 && $data['poll_start'] + $data['poll_length'] > time()) || $data['poll_length'] == 0) &&
			$data['topic_status'] != ITEM_LOCKED &&
			$data['forum_status'] != ITEM_LOCKED) ? true : false;
	} 
	else
	{
		$s_can_vote = false;
	}

	$s_display_results = ( !$s_can_vote || ( $s_can_vote && sizeof($cur_voted_id) ) || ( $view == 'viewpoll' && in_array($topic_id, $poll_view_ar) ) ) ? true : false;

	$poll_sql = 'SELECT po.poll_option_id, po.poll_option_text, po.poll_option_total
		FROM ' . POLL_OPTIONS_TABLE . " po
		WHERE po.topic_id = {$topic_id}
		ORDER BY po.poll_option_id";

	$poll_result = $db->sql_query($poll_sql);
			
	$poll_total_votes = 0;

	$poll_data = array();

	if ($poll_result)
	{
		while( $polls_data = $db->sql_fetchrow($poll_result) )
		{
			$poll_has_options = true;
			$poll_data[] = $polls_data;
			$poll_total_votes += $polls_data['poll_option_total'];
		}
	}

	$db->sql_freeresult($poll_result);
			
	$make_poll_view = array();
			
	if( in_array($topic_id, $poll_view_ar) === FALSE )
	{
		$make_poll_view[] = $topic_id;
		$make_poll_view = array_merge($poll_view_ar, $make_poll_view);
	}
			
	$poll_view_str = urlencode( implode(',', $make_poll_view) );

	$portalpoll_url= append_sid("./portal.$phpEx", "polls=$poll_view_str");
	$portalvote_url= append_sid("./portal.$phpEx", "f=$forum_id&amp;t=$topic_id");
	$viewtopic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id");

	$poll_end = $data['poll_length'] + $data['poll_start'];
			
	// Parse BBCode title
	if ($data['bbcode_bitfield'])
	{
		$poll_bbcode = new bbcode();
	}
	else
	{
		$poll_bbcode = false;
	}

	$data['poll_title'] = censor_text($data['poll_title']);

	if ($poll_bbcode !== false)
	{
		$poll_bbcode->bbcode_second_pass($data['poll_title'], $data['bbcode_uid'], $data['bbcode_bitfield']);
	}

	$data['poll_title'] = bbcode_nl2br($data['poll_title']);
	$data['poll_title'] = smiley_text($data['poll_title']);
	unset($poll_bbcode);			

	$template->assign_block_vars($poll_block, array(
		'S_POLL_HAS_OPTIONS' => $poll_has_options,
		'POLL_QUESTION' => $data['poll_title'],
		'U_POLL_TOPIC' => append_sid($phpbb_root_path . 'viewtopic.' . $phpEx . '?t=' . $topic_id . '&amp;f=' . $forum_id),
		'POLL_LENGTH' => $data['poll_length'],
		'TOPIC_ID' => $topic_id,

		'TOTAL_VOTES' 		=> $poll_total_votes,
		
		'L_MAX_VOTES'		=> ($data['poll_max_options'] == 1) ? $user->lang['MAX_OPTION_SELECT'] : sprintf($user->lang['MAX_OPTIONS_SELECT'], $data['poll_max_options']),
		'L_POLL_LENGTH'		=> ($data['poll_length']) ? sprintf($user->lang[($poll_end > time()) ? 'POLL_RUN_TILL' : 'POLL_ENDED_AT'], $user->format_date($poll_end)) : '',
		
		'S_CAN_VOTE'		=> $s_can_vote,
		'S_DISPLAY_RESULTS'	=> $s_display_results,
		'S_IS_MULTI_CHOICE'	=> ($data['poll_max_options'] > 1) ? true : false,
		'S_POLL_ACTION'		=> $portalvote_url,
		
		'U_VIEW_RESULTS'   => $portalpoll_url . '&amp;view=viewpoll#viewpoll',
		'U_VIEW_TOPIC'		=> $viewtopic_url
	));

	foreach($poll_data as $pd)
	{
		$option_pct = ($poll_total_votes > 0) ? $pd['poll_option_total'] / $poll_total_votes : 0;
		$option_pct_txt = sprintf("%.1d%%", ($option_pct * 100));
				
		// Parse BBCode option text

		if ($data['bbcode_bitfield'])
		{
			$poll_bbcode = new bbcode();
		}
		else
		{
			$poll_bbcode = false;
		}

		$pd['poll_option_text'] = censor_text($pd['poll_option_text']);

		if ($poll_bbcode !== false)
		{
			$poll_bbcode->bbcode_second_pass($pd['poll_option_text'], $data['bbcode_uid'], $data['bbcode_bitfield']);
		}

		$pd['poll_option_text'] = bbcode_nl2br($pd['poll_option_text']);
		$pd['poll_option_text'] = smiley_text($pd['poll_option_text']);
		unset($poll_bbcode);				

		$template->assign_block_vars($poll_block . '.poll_option', array(
			'POLL_OPTION_ID' 		=> $pd['poll_option_id'],
			'POLL_OPTION_CAPTION' 	=> $pd['poll_option_text'],
			'POLL_OPTION_RESULT' 	=> $pd['poll_option_total'],
			'POLL_OPTION_PERCENT' 	=> $option_pct_txt,
			'POLL_OPTION_PCT'		=> round($option_pct * 100),
			'POLL_OPTION_IMG' 		=> $user->img('poll_center', $option_pct_txt, round($option_pct * 250)),
			'POLL_OPTION_VOTED'		=> (in_array($pd['poll_option_id'], $cur_voted_id)) ? true : false
		));
	}
}

?>