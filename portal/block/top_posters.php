<?php
/*
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
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
*/

$sql = 'SELECT user_id, username, user_posts, user_colour
	FROM ' . USERS_TABLE . '
	WHERE user_type <> ' . USER_IGNORE . '
		AND user_posts <> 0
	ORDER BY user_posts DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_most_poster']);

while( ($row = $db->sql_fetchrow($result)) && ($row['username']) )
{
	$template->assign_block_vars('top_poster', array(
		'S_SEARCH_ACTION'=> append_sid("{$phpbb_root_path}search.$phpEx", 'author_id=' . $row['user_id'] . '&amp;sr=posts'),
		'USERNAME'		=> censor_text($row['username']),
		'USERNAME_COLOR'=> ($row['user_colour']) ? ' style="color:#' . $row['user_colour'] .'"' : '',
		'U_USERNAME'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row['user_id']),
		'POSTER_POSTS'	=> $row['user_posts'],
		)
	);
}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'S_DISPLAY_TOP_POSTERS' => true
));

?>