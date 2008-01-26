<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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

//
// Exclude forums
//
$sql_where = '';
if ($portal_config['portal_exclude_forums'])
{
	$exclude_forums = explode(',', $portal_config['portal_exclude_forums']);
	foreach ($exclude_forums as $i => $id)
	{
		if ($id > 0)
		{
			$sql_where .= ' AND forum_id <> ' . trim($id);
		}
	}
}

//
// Recent announcements
//
$sql = 'SELECT topic_title, forum_id, topic_id
	FROM ' . TOPICS_TABLE . '
	WHERE topic_status <> ' . FORUM_LINK . '
		AND topic_approved = 1 
		AND ( topic_type = ' . POST_ANNOUNCE . ' OR topic_type = ' . POST_GLOBAL . ' )
		' . $sql_where . '
	ORDER BY topic_time DESC';

$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while( ($row = $db->sql_fetchrow($result)) && ($row['topic_title']) )
{
	// auto auth
	if ( ($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0') )
	{
		$template->assign_block_vars('latest_announcements', array(
			'TITLE'	 		=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);

//
// Recent hot topics
//
$sql = 'SELECT topic_title, forum_id, topic_id
	FROM ' . TOPICS_TABLE . '
	WHERE topic_approved = 1 
		AND topic_replies >=' . $config['hot_threshold'] . '
		' . $sql_where . '
	ORDER BY topic_time DESC';

$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while( ($row = $db->sql_fetchrow($result)) && ($row['topic_title']) )
{
	// auto auth
	if ( ($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0') )
	{
		$template->assign_block_vars('latest_hot_topics', array(
			'TITLE'	 		=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);

//
// Recent topic (only show normal topic)
//
$sql = 'SELECT topic_title, forum_id, topic_id
	FROM ' . TOPICS_TABLE . '
	WHERE topic_status <> ' . FORUM_LINK . '
		AND topic_approved = 1 
		AND topic_type = ' . POST_NORMAL . '
		' . $sql_where . '
	ORDER BY topic_time DESC';

$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while( ($row = $db->sql_fetchrow($result)) && ($row['topic_title']) )
{
	// auto auth
	if ( ($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0') )
	{
		$template->assign_block_vars('latest_topics', array(
			'TITLE'	 		=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);


/*//we may also delete this?
//
// Recent active topic
//
$last_post_time_sql = ($sort_days) ? ' AND t.topic_last_post_time > ' . (time() - ($sort_days * 24 * 3600)) : '';

$sql = 'SELECT topic_title, forum_id, topic_id, topic_time, topic_first_poster_name
	FROM ' . TOPICS_TABLE . '
	WHERE topic_status <> ' . FORUM_LINK . "
		$last_post_time_sql
		AND topic_moved_id = 0
		AND topic_approved = 1 
		AND topic_type = " . POST_NORMAL . '
		' . $sql_where . '
	ORDER BY topic_time DESC';

$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while( ($row = $db->sql_fetchrow($result)) && ($row['topic_title']) )
{
	// auto auth
	if ( ($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0') )
	{
		$template->assign_block_vars('active_topics', array(
			'TITLE'	 		=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'DATE'			=> $user->format_date($row['topic_time']),
			'POSTER'		=> $row['topic_first_poster_name'],
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'])
		));
	}	
}
$db->sql_freeresult($result);
*/

$template->assign_vars(array(
	'S_DISPLAY_RECENT'			=> true,
));

?>