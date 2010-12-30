<?php

/**
*
* @package - Board3portal
* @version $Id: user_menu.php 647 2010-04-07 10:55:50Z marc1706 $
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
	$db->sql_freeresult($result);
	
	// unread posts
	$sql_where = 'AND t.topic_moved_id = 0
					' . str_replace(array('p.', 'post_'), array('t.', 'topic_'), $m_approve_fid_sql) . '
					' . ((sizeof($ex_fid_ary)) ? 'AND ' . $db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '');
	$unread_list = array();
	$unread_list = get_unread_topics($user->data['user_id'], $sql_where, 'ORDER BY t.topic_id DESC');
	$unread_posts_count = sizeof($unread_list);
}
//
// - new posts since last visit & you post number
//


// Get user avatar and rank
$user_id = $user->data['user_id'];
$username = $user->data['username'];
$colour = $user->data['user_colour'];
$avatar_img = get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type'], $user->data['user_avatar_width'], $user->data['user_avatar_height']);
$rank_title = $rank_img = '';
get_user_rank($user->data['user_rank'], $user->data['user_posts'], $rank_title, $rank_img, $rank_img_src);


// Assign specific vars
$template->assign_vars(array(
	'L_NEW_POSTS'	=> $user->lang['SEARCH_NEW'] . '&nbsp;(' . $new_posts_count . ')',
	'L_SELF_POSTS'	=> $user->lang['SEARCH_SELF'] . '&nbsp;(' . $user->data['user_posts'] . ')',
	'L_UNREAD_POSTS'=> $user->lang['SEARCH_UNREAD'] . '&nbsp;(' . $unread_posts_count . ')',

	'B3P_AVATAR_IMG'    => $avatar_img,
	'B3P_RANK_TITLE'    => $rank_title,
	'B3P_RANK_IMG'        => $rank_img,
	'RANK_IMG_SRC'    => $rank_img_src,

	'USERNAME_FULL'        => get_username_string('full', $user_id, $username, $colour),
	'B3P_USERNAME'            => get_username_string('username', $user_id, $username, $colour),
	'B3P_USER_COLOR'        => get_username_string('colour', $user_id, $username, $colour),
	'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

	'U_NEW_POSTS'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=newposts'),
	'U_SELF_POSTS'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=egosearch'),
	'U_UNREAD_POSTS'		=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unreadposts'),
	'U_UM_BOOKMARKS'		=> ($config['allow_bookmarks']) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&amp;mode=bookmarks') : '',
	'U_UM_MAIN_SUBSCRIBED'	=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&amp;mode=subscribed'),
	'U_MCP'					=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '', 
));

?>