<?php

/**
*
* @package - Board3portal
* @version $Id: random_member.php 523 2009-08-27 21:41:08Z christian_n $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

switch ($db->sql_layer)
{
	case 'postgres':
	$sql = 'SELECT *
		FROM ' . USERS_TABLE . '
		WHERE user_type <> ' . USER_IGNORE . '
		AND user_type <> ' . USER_INACTIVE . '
		ORDER BY RANDOM()';
	break;

	case 'mssql':
	case 'mssql_odbc':
	$sql = 'SELECT *
		FROM ' . USERS_TABLE . '
		WHERE user_type <> ' . USER_IGNORE . '
		AND user_type <> ' . USER_INACTIVE . '
		ORDER BY NEWID()';
	break;

	default:
	$sql = 'SELECT *
		FROM ' . USERS_TABLE . '
		WHERE user_type <> ' . USER_IGNORE . '
		AND user_type <> ' . USER_INACTIVE . '
		ORDER BY RAND()';
	break;
}

$result = $db->sql_query_limit($sql, 1);
$row = $db->sql_fetchrow($result);

$avatar_img = get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']);

$rank_title = $rank_img = '';
get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);

$username = $row['username'];
$user_id = (int) $row['user_id'];
$colour = $row['user_colour'];

$template->assign_block_vars('random_member', array(
	'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
	'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
	'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
	'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

	'RANK_TITLE'	=> $rank_title,
	'RANK_IMG'		=> $rank_img,
	'RANK_IMG_SRC'	=> $rank_img_src,

	'USER_POSTS'	=> (int) $row['user_posts'],
	'AVATAR_IMG'	=> $avatar_img,
	'JOINED'		=> $user->format_date($row['user_regdate'], 'd.M.Y'),
	'USER_OCC'		=> censor_text($row['user_occ']),
	'USER_FROM'		=> censor_text($row['user_from']),
	'U_WWW'			=> censor_text($row['user_website']),
));
$db->sql_freeresult($result);

$template->assign_var('S_DISPLAY_RANDOM_MEMBER', true);

?>