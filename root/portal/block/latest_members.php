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

$sql = 'SELECT user_id, username, user_regdate, user_colour
	FROM ' . USERS_TABLE . '
	WHERE user_type <> ' . USER_IGNORE . '
		AND user_inactive_time = 0
	ORDER BY user_regdate DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_max_last_member']);

while( ($row = $db->sql_fetchrow($result)) && ($row['username']) )
{
	$template->assign_block_vars('latest_members', array(
		'USERNAME'		=> censor_text($row['username']),
		'USERNAME_COLOR'=> ($row['user_colour']) ? ' style="color:#' . $row['user_colour'] .'"' : '',
		'U_USERNAME'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row['user_id']),
		'JOINED'		=> $user->format_date($row['user_regdate'], $format = 'd M'),
	));
}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'S_DISPLAY_LATEST_MEMBERS' => true,
));

?>