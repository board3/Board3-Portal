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

// Display a listing of board admins, moderators
$user->add_lang('groups');

$sql = $db->sql_build_query('SELECT', array(
	'SELECT'	=> 'u.user_id, u.group_id as default_group, u.username, u.user_colour, u.user_allow_pm, g.group_id, g.group_name, g.group_colour, g.group_type, ug.user_id as ug_user_id',
	'FROM'		=> array(
		USERS_TABLE		=> 'u',
		GROUPS_TABLE	=> 'g'
	),
	'LEFT_JOIN'	=> array(
		array(
			'FROM'	=> array(USER_GROUP_TABLE => 'ug'),
			'ON'	=> 'ug.group_id = g.group_id AND ug.user_pending = 0 AND ug.user_id = ' . $user->data['user_id']
		)),
	'WHERE'		=> 'u.group_id = g.group_id AND ' . $db->sql_in_set('g.group_name', array('ADMINISTRATORS', 'GLOBAL_MODERATORS')),
	'ORDER_BY'	=> 'g.group_name ASC, u.username_clean ASC'
));

$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result))
{
	if ($row['group_name'] == 'ADMINISTRATORS')
	{
		$which_row = 'admin';
	}
	elseif ($row['group_name'] == 'GLOBAL_MODERATORS')
	{
		$which_row = 'mod';
	}

	if ($row['group_type'] == GROUP_HIDDEN && !$auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel') && $row['ug_user_id'] != $user->data['user_id'])
	{
		$group_name = $user->lang['GROUP_UNDISCLOSED'];
		$u_group = '';
	}
	else
	{
		$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];
		$u_group = append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']);
	}

	$template->assign_block_vars($which_row, array(
		'USER_ID'			=> $row['user_id'],
		'GROUP_NAME'		=> $group_name,
		'GROUP_COLOR'		=> $row['group_colour'],

		'U_GROUP'			=> $u_group,

		'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		'USERNAME'			=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
		'USER_COLOR'		=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour']),
		'U_VIEW_PROFILE'	=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
	));
}
$db->sql_freeresult($result);


$template->assign_var('S_DISPLAY_LEADERS', true);

?>