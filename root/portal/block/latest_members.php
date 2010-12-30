<?php

/**
*
* @package - Board3portal
* @version $Id: latest_members.php 578 2009-11-20 09:34:35Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$sql = 'SELECT user_id, username, user_regdate, user_colour
	FROM ' . USERS_TABLE . '
	WHERE user_type <> ' . USER_IGNORE . '
		AND user_inactive_time = 0
	ORDER BY user_regdate DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_last_member']);

while(($row = $db->sql_fetchrow($result)) && ($row['username']))
{
	$template->assign_block_vars('latest_members', array(
		'USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		'JOINED'		=> $user->format_date($row['user_regdate'], $format = 'd M'),
	));
}
$db->sql_freeresult($result);

$template->assign_var('S_DISPLAY_LATEST_MEMBERS', true);

?>