<?php

/**
*
* @package - Board3portal
* @version $Id$
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
// + new posts since last visit & you post number
//
if ($user->data['is_registered'])
{
	$ex_fid_ary = array_unique(array_merge(array_keys($auth->acl_getf('!f_read', true)), array_keys($auth->acl_getf('!f_search', true))));
	
	if ($auth->acl_get('m_approve'))
	{
		$m_approve_fid_ary = array(-1);
		$m_approve_fid_sql = '';
	}
	else if ($auth->acl_getf_global('m_approve'))
	{
		$m_approve_fid_ary = array_diff(array_keys($auth->acl_getf('!m_approve', true)), $ex_fid_ary);
		$m_approve_fid_sql = ' AND (p.post_approved = 1' . ((sizeof($m_approve_fid_ary)) ? ' OR ' . $db->sql_in_set('p.forum_id', $m_approve_fid_ary, true) : '') . ')';
	}
	else
	{
		$m_approve_fid_ary = array();
		$m_approve_fid_sql = ' AND p.post_approved = 1';
	}

	$sql = 'SELECT COUNT(distinct t.topic_id) as total
				FROM ' . TOPICS_TABLE . ' t
				WHERE t.topic_last_post_time > ' . $user->data['user_lastvisit'] . '
					AND t.topic_moved_id = 0
					' . str_replace(array('p.', 'post_'), array('t.', 'topic_'), $m_approve_fid_sql) . '
					' . ((sizeof($ex_fid_ary)) ? 'AND ' . $db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '');
	$result = $db->sql_query($sql);
	$new_posts_count = (int) $db->sql_fetchfield('total');

	// your post number
	$sql = "SELECT user_posts
		FROM " . USERS_TABLE . "
		WHERE user_id = " . $user->data['user_id'];
	$result = $db->sql_query($sql);
	$you_posts_count = (int) $db->sql_fetchfield('user_posts');
}
//
// - new posts since last visit & you post number
//


// Get user...
$user_id = $user->data['user_id'];
$username = $user->data['username'];

$sql = 'SELECT *
	FROM ' . USERS_TABLE . '
	WHERE ' . (($username) ? "username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'" : "user_id = $user_id");
$result = $db->sql_query($sql);
$member = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$avatar_img = get_user_avatar($member['user_avatar'], $member['user_avatar_type'], $member['user_avatar_width'], $member['user_avatar_height']);
$rank_title = $rank_img = '';
get_user_rank($member['user_rank'], $member['user_posts'], $rank_title, $rank_img, $rank_img_src);
$username = $member['username'];
$user_id = (int) $member['user_id'];
$colour = $member['user_colour'];

// Assign specific vars
$template->assign_vars(array(
	'L_NEW_POSTS'	=> $user->lang['SEARCH_NEW'] . '&nbsp;(' . $new_posts_count . ')',
	'L_SELF_POSTS'	=> $user->lang['SEARCH_SELF'] . '&nbsp;(' . $you_posts_count . ')',

	'AVATAR_IMG'	=> $avatar_img,
	'RANK_TITLE'	=> $rank_title,
	'RANK_IMG'		=> $rank_img,
	'RANK_IMG_SRC'	=> $rank_img_src,

	'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
	'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
	'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
	'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

	'U_NEW_POSTS'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=newposts'),
	'U_SELF_POSTS'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=egosearch'),
	'U_UM_BOOKMARKS'		=> ($config['allow_bookmarks']) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&amp;mode=bookmarks') : '',
	'U_UM_MAIN_SUBSCRIBED'	=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&amp;mode=subscribed'),
	'U_MCP'					=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '', 
));

?>