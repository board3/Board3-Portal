<?php

/**
*
* @package - Board3portal
* @version $Id: recent.php 648 2010-04-07 11:34:14Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

//
// Exclude forums
//
$sql_where = '';
if ($portal_config['portal_recent_forum'] > 0)
{
	$exclude_forums = explode(',', $portal_config['portal_recent_forum']);
	
	$sql_where = ' AND ' . $db->sql_in_set('forum_id', array_map('intval', $exclude_forums), ($portal_config['portal_exclude_forums']) ? true : false);
}

// Get a list of forums the user cannot read
$forum_ary = array_unique(array_keys($auth->acl_getf('!f_read', true)));

// Determine first forum the user is able to read (must not be a category)
$sql = 'SELECT forum_id
	FROM ' . FORUMS_TABLE . '
	WHERE forum_type = ' . FORUM_POST;

$forum_sql = '';
if (sizeof($forum_ary))
{
	$sql .= ' AND ' . $db->sql_in_set('forum_id', $forum_ary, true);
	$forum_sql = ' AND ' . $db->sql_in_set('t.forum_id', $forum_ary, true);
}

$result = $db->sql_query_limit($sql, 1);
$g_forum_id = (int) $db->sql_fetchfield('forum_id');
$db->sql_freeresult($result);

//
// Recent announcements
//
$sql = 'SELECT topic_title, forum_id, topic_id
	FROM ' . TOPICS_TABLE . ' t
	WHERE topic_status <> ' . FORUM_LINK . '
		AND topic_approved = 1 
		AND (topic_type = ' . POST_ANNOUNCE . ' OR topic_type = ' . POST_GLOBAL . ')
		AND topic_moved_id = 0
		' . $sql_where . '' .  $forum_sql . '
	ORDER BY topic_time DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while(($row = $db->sql_fetchrow($result)) && ($row['topic_title']))
{
	// auto auth
	if (($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0'))
	{
		$template->assign_block_vars('latest_announcements', array(
			'TITLE'			=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row['forum_id'] == 0) ? $g_forum_id : $row['forum_id']) . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);

//
// Recent hot topics
//
$sql = 'SELECT topic_title, forum_id, topic_id
	FROM ' . TOPICS_TABLE . ' t
	WHERE topic_approved = 1 
		AND topic_replies >=' . $config['hot_threshold'] . '
		AND topic_moved_id = 0
		' . $sql_where . '' .  $forum_sql . '
	ORDER BY topic_time DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while(($row = $db->sql_fetchrow($result)) && ($row['topic_title']))
{
	// auto auth
	if (($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0'))
	{
		$template->assign_block_vars('latest_hot_topics', array(
			'TITLE'			=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row['forum_id'] == 0) ? $g_forum_id : $row['forum_id']) . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);

//
// Recent topic (only show normal topic)
//
$sql = 'SELECT topic_title, forum_id, topic_id
	FROM ' . TOPICS_TABLE . ' t
	WHERE topic_status <> ' . ITEM_MOVED . '
		AND topic_approved = 1 
		AND topic_type = ' . POST_NORMAL . '
		AND topic_moved_id = 0
		' . $sql_where . '' .  $forum_sql . '
	ORDER BY topic_time DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_topics']);

while(($row = $db->sql_fetchrow($result)) && ($row['topic_title']))
{
	// auto auth
	if (($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0'))
	{
		$template->assign_block_vars('latest_topics', array(
			'TITLE'			=> character_limit($row['topic_title'], $portal_config['portal_recent_title_limit']),
			'FULL_TITLE'	=> censor_text($row['topic_title']),
			'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'])
		));
	}
}
$db->sql_freeresult($result);

$template->assign_var('S_DISPLAY_RECENT', true);

?>