<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

/**
* @ignore
*/

// Initial var setup
$forum_id	= request_var('f', 0);
$topic_id	= request_var('t', ((!empty($portal_config['portal_poll_topic_id'])) ? $portal_config['portal_poll_topic_id'] : 0)); 
$topic_id	= preg_replace('/[^0-9]/', '', $topic_id); // just a temporary solution to get rid of sql errors
$post_id	= request_var('p', 0);
$voted_id	= request_var('vote_id', array('' => 0));

$start		= request_var('start', 0);
$view		= request_var('view', '');

$sort_days	= request_var('st', ((!empty($user->data['user_post_show_days'])) ? $user->data['user_post_show_days'] : 0));
$sort_key	= request_var('sk', ((!empty($user->data['user_post_sortby_type'])) ? $user->data['user_post_sortby_type'] : 't'));
$sort_dir	= request_var('sd', ((!empty($user->data['user_post_sortby_dir'])) ? $user->data['user_post_sortby_dir'] : 'a'));

$update		= request_var('update', false);

// Do we have a topic or post id?
if (!$topic_id && !$post_id)
{
	//	trigger_error('NO_TOPIC');
	$portal_config['portal_poll_topic'] = false; 
}

// Find topic id if user requested a newer or older topic
if ($view && !$post_id)
{
	if (!$forum_id)
	{
		$sql = 'SELECT forum_id
			FROM ' . TOPICS_TABLE . "
			WHERE topic_id = $topic_id";
		$result = $db->sql_query($sql);
		$forum_id = (int) $db->sql_fetchfield('forum_id');
		$db->sql_freeresult($result);

		if (!$forum_id)
		{
			trigger_error('NO_TOPIC');
		}
	}

	// Check for global announcement correctness?
	if ((!isset($row) || !$row['forum_id']) && !$forum_id)
	{
		//trigger_error('NO_TOPIC');
		$portal_config['portal_poll_topic'] = false;
	}
	else if (isset($row) && $row['forum_id'])
	{
		$forum_id = $row['forum_id'];
	}
}

// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
$sql_array = array(
	'SELECT'	=> 't.*, f.*',

	'FROM'		=> array(
		FORUMS_TABLE	=> 'f',
	)
);

if ($user->data['is_registered'])
{
	$sql_array['SELECT'] .= ', tw.notify_status';
	$sql_array['LEFT_JOIN'] = array();

	$sql_array['LEFT_JOIN'][] = array(
		'FROM'	=> array(TOPICS_WATCH_TABLE => 'tw'),
		'ON'	=> 'tw.user_id = ' . $user->data['user_id'] . ' AND t.topic_id = tw.topic_id'
	);
}

if (!$post_id)
{
	$sql_array['WHERE'] = "t.topic_id = $topic_id";
}
else
{
	$sql_array['WHERE'] = "p.post_id = $post_id AND t.topic_id = p.topic_id" . ((!$auth->acl_get('m_approve', $forum_id)) ? ' AND p.post_approved = 1' : '');
	$sql_array['FROM'][POSTS_TABLE] = 'p';
}

$sql_array['WHERE'] .= ' AND (f.forum_id = t.forum_id';

$sql_array['WHERE'] .= ')';
$sql_array['FROM'][TOPICS_TABLE] = 't';

// Join to forum table on topic forum_id unless topic forum_id is zero
// whereupon we join on the forum_id passed as a parameter ... this
// is done so navigation, forum name, etc. remain consistent with where
// user clicked to view a global topic
$sql = $db->sql_build_query('SELECT', $sql_array);
$result = $db->sql_query($sql);
$topic_data = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

if (!$topic_data)
{
	// If post_id was submitted, we try at least to display the topic as a last resort...
	if ($post_id && $forum_id && $topic_id)
	{
		redirect(append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id"));
	}

	//trigger_error('NO_TOPIC');
	$portal_config['portal_poll_topic'] = false; 
}

$forum_id = (int) $topic_data['forum_id'];
$topic_id = (int) $topic_data['topic_id'];

// Setup look and feel
$user->setup('viewtopic', $topic_data['forum_style']);

if (!$topic_data['topic_approved'] && !$auth->acl_get('m_approve', $forum_id))
{
	//trigger_error('NO_TOPIC');
	$portal_config['portal_poll_topic'] = false; 
}

// Start auth check
if (!$auth->acl_get('f_read', $forum_id))
{
	if ($user->data['user_id'] != ANONYMOUS)
	{
		//trigger_error('SORRY_AUTH_READ');
		$portal_config['portal_poll_topic'] = false;
	}

	//login_box('', $user->lang['LOGIN_VIEWFORUM']);
	$portal_config['portal_poll_topic'] = false; 
}

// Forum is passworded ... check whether access has been granted to this
// user this session, if not show login box
if ($topic_data['forum_password'])
{
	login_forum_box($topic_data);
}

// Post ordering options
$limit_days = array(0 => $user->lang['ALL_POSTS'], 1 => $user->lang['1_DAY'], 7 => $user->lang['7_DAYS'], 14 => $user->lang['2_WEEKS'], 30 => $user->lang['1_MONTH'], 90 => $user->lang['3_MONTHS'], 180 => $user->lang['6_MONTHS'], 365 => $user->lang['1_YEAR']);

$sort_by_text = array('a' => $user->lang['AUTHOR'], 't' => $user->lang['POST_TIME'], 's' => $user->lang['SUBJECT']);
$sort_by_sql = array('a' => 'u.username_clean', 't' => 'p.post_time', 's' => 'p.post_subject');

$s_limit_days = $s_sort_key = $s_sort_dir = $u_sort_param = '';
gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);

// General Viewtopic URL for return links
$viewtopic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id&amp;start=$start&amp;$u_sort_param");

// This is only used for print view so ...
$server_path = (!$view) ? $phpbb_root_path : generate_board_url() . '/';

// Does this topic contain a poll?
if (!empty($topic_data['poll_start']))
{
	$sql = 'SELECT o.*, p.bbcode_bitfield, p.bbcode_uid
		FROM ' . POLL_OPTIONS_TABLE . ' o, ' . POSTS_TABLE . " p
		WHERE o.topic_id = $topic_id
			AND p.post_id = {$topic_data['topic_first_post_id']}
			AND p.topic_id = o.topic_id
		ORDER BY o.poll_option_id";
	$result = $db->sql_query($sql);

	$poll_info = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$poll_info[] = $row;
	}
	$db->sql_freeresult($result);

	$cur_voted_id = array();
	if ($user->data['is_registered'])
	{
		$sql = 'SELECT poll_option_id
			FROM ' . POLL_VOTES_TABLE . '
			WHERE topic_id = ' . $topic_id . '
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
		if (isset($_COOKIE[$config['cookie_name'] . '_poll_' . $topic_id]))
		{
			$cur_voted_id = explode(',', $_COOKIE[$config['cookie_name'] . '_poll_' . $topic_id]);
			$cur_voted_id = array_map('intval', $cur_voted_id);
		}
	}

	$s_can_vote = (((!sizeof($cur_voted_id) && $auth->acl_get('f_vote', $forum_id)) ||
		($auth->acl_get('f_votechg', $forum_id) && $topic_data['poll_vote_change'])) &&
		(($topic_data['poll_length'] != 0 && $topic_data['poll_start'] + $topic_data['poll_length'] > time()) || $topic_data['poll_length'] == 0) &&
		$topic_data['topic_status'] != ITEM_LOCKED &&
		$topic_data['forum_status'] != ITEM_LOCKED) ? true : false;
	$s_display_results = (!$s_can_vote || ($s_can_vote && sizeof($cur_voted_id)) || $view == 'viewpoll') ? true : false;

	if ($update && $s_can_vote)
	{
		if (!sizeof($voted_id) || sizeof($voted_id) > $topic_data['poll_max_options'])
		{
			$redirect_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id");

			meta_refresh(5, $redirect_url);

			$message = (!sizeof($voted_id)) ? 'NO_VOTE_OPTION' : 'TOO_MANY_VOTE_OPTIONS';
			$message = $user->lang[$message] . '<br /><br />' . sprintf($user->lang['RETURN_TOPIC'], '<a href="' . $redirect_url . '">', '</a>');
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
					AND topic_id = ' . (int) $topic_id;
			$db->sql_query($sql);

			if ($user->data['is_registered'])
			{
				$sql_ary = array(
					'topic_id'			=> (int) $topic_id,
					'poll_option_id'	=> (int) $option,
					'vote_user_id'		=> (int) $user->data['user_id'],
					'vote_user_ip'		=> (string) $user->ip,
				);

				$sql = 'INSERT INTO  ' . POLL_VOTES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
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
						AND topic_id = ' . (int) $topic_id;
				$db->sql_query($sql);

				if ($user->data['is_registered'])
				{
					$sql = 'DELETE FROM ' . POLL_VOTES_TABLE . '
						WHERE topic_id = ' . (int) $topic_id . '
							AND poll_option_id = ' . (int) $option . '
							AND vote_user_id = ' . (int) $user->data['user_id'];
					$db->sql_query($sql);
				}
			}
		}

		if ($user->data['user_id'] == ANONYMOUS && !$user->data['is_bot'])
		{
			$user->set_cookie('poll_' . $topic_id, implode(',', $voted_id), time() + 31536000);
		}

		$sql = 'UPDATE ' . TOPICS_TABLE . '
			SET poll_last_vote = ' . time() . "
			WHERE topic_id = $topic_id";
		//, topic_last_post_time = ' . time() . " -- for bumping topics with new votes, ignore for now
		$db->sql_query($sql);

		$redirect_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id");

		meta_refresh(5, $redirect_url);
		trigger_error($user->lang['VOTE_SUBMITTED'] . '<br /><br />' . sprintf($user->lang['RETURN_TOPIC'], '<a href="' . $redirect_url . '">', '</a>'));
	}

	$poll_total = 0;
	foreach ($poll_info as $poll_option)
	{
		$poll_total += $poll_option['poll_option_total'];
	}

	if ($poll_info[0]['bbcode_bitfield'])
	{
		$poll_bbcode = new bbcode();
	}
	else
	{
		$poll_bbcode = false;
	}

	for ($i = 0, $size = sizeof($poll_info); $i < $size; $i++)
	{
		$poll_info[$i]['poll_option_text'] = censor_text($poll_info[$i]['poll_option_text']);
		$poll_info[$i]['poll_option_text'] = str_replace("\n", '<br />', $poll_info[$i]['poll_option_text']);

		if ($poll_bbcode !== false)
		{
			$poll_bbcode->bbcode_second_pass($poll_info[$i]['poll_option_text'], $poll_info[$i]['bbcode_uid'], $poll_option['bbcode_bitfield']);
		}

		$poll_info[$i]['poll_option_text'] = smiley_text($poll_info[$i]['poll_option_text']);
	}

	$topic_data['poll_title'] = censor_text($topic_data['poll_title']);
	$topic_data['poll_title'] = str_replace("\n", '<br />', $topic_data['poll_title']);

	if ($poll_bbcode !== false)
	{
		$poll_bbcode->bbcode_second_pass($topic_data['poll_title'], $poll_info[0]['bbcode_uid'], $poll_info[0]['bbcode_bitfield']);
	}
	$topic_data['poll_title'] = smiley_text($topic_data['poll_title']);

	unset($poll_bbcode);

	foreach ($poll_info as $poll_option)
	{
		$option_pct = ($poll_total > 0) ? $poll_option['poll_option_total'] / $poll_total : 0;
		$option_pct_txt = sprintf("%.1d%%", ($option_pct * 100));

		$template->assign_block_vars('poll_option', array(
			'POLL_OPTION_ID' 		=> $poll_option['poll_option_id'],
			'POLL_OPTION_CAPTION' 	=> $poll_option['poll_option_text'],
			'POLL_OPTION_RESULT' 	=> $poll_option['poll_option_total'],
			'POLL_OPTION_PERCENT' 	=> $option_pct_txt,
			'POLL_OPTION_PCT'		=> round($option_pct * 100),
			'POLL_OPTION_IMG' 		=> $user->img('poll_center', $option_pct_txt, round($option_pct * 10)),
			'POLL_OPTION_VOTED'		=> (in_array($poll_option['poll_option_id'], $cur_voted_id)) ? true : false
		));
	}

	$poll_end = $topic_data['poll_length'] + $topic_data['poll_start'];

	$template->assign_vars(array(
		'POLL_QUESTION'		=> $topic_data['poll_title'],
		'TOTAL_VOTES' 		=> $poll_total,
		'POLL_LEFT_CAP_IMG'	=> $user->img('poll_left'),
		'POLL_RIGHT_CAP_IMG'=> $user->img('poll_right'),

		'L_MAX_VOTES'		=> ($topic_data['poll_max_options'] == 1) ? $user->lang['MAX_OPTION_SELECT'] : sprintf($user->lang['MAX_OPTIONS_SELECT'], $topic_data['poll_max_options']),
		'L_POLL_LENGTH'		=> ($topic_data['poll_length']) ? sprintf($user->lang[($poll_end > time()) ? 'POLL_RUN_TILL' : 'POLL_ENDED_AT'], $user->format_date($poll_end)) : '',

		'S_HAS_POLL'		=> true,
		'S_CAN_VOTE'		=> $s_can_vote,
		'S_DISPLAY_RESULTS'	=> $s_display_results,
		'S_IS_MULTI_CHOICE'	=> ($topic_data['poll_max_options'] > 1) ? true : false,
		'S_POLL_ACTION'		=> $viewtopic_url,

		'U_VIEW_RESULTS'	=> $viewtopic_url . '&amp;view=viewpoll'
	));
	unset($poll_end, $poll_info, $voted_id);
}

$template->assign_vars(array(
	'S_DISPLAY_POLL' => true
));

?>