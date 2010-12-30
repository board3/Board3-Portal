<?php
/*
*
* @package - Board3portal
* @version $Id: top_posters.php 578 2009-11-20 09:34:35Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

/**
*/

$sql = 'SELECT user_id, username, user_posts, user_colour
	FROM ' . USERS_TABLE . '
	WHERE user_type <> ' . USER_IGNORE . '
		AND user_posts <> 0
	ORDER BY user_posts DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_most_poster']);

while(($row = $db->sql_fetchrow($result)) && ($row['username']))
{
	$template->assign_block_vars('top_poster', array(
		'S_SEARCH_ACTION'	=> append_sid("{$phpbb_root_path}search.$phpEx", 'author_id=' . $row['user_id'] . '&amp;sr=posts'),
		'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		'POSTER_POSTS'		=> $row['user_posts'],
		)
	);
}
$db->sql_freeresult($result);

$template->assign_var('S_DISPLAY_TOP_POSTERS', true);

?>