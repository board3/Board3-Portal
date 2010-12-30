<?php

/**
*
* @package - Board3portal
* @version $Id: leaders_ext.php 640 2010-04-05 11:04:12Z marc1706 $
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

$legends = array();
$groups = array();

if ($auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
{
	$sql = 'SELECT group_id, group_name, group_colour, group_type
		FROM ' . GROUPS_TABLE . '
		WHERE group_legend = 1
		ORDER BY group_name ASC';
}
else
{
	$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type
		FROM ' . GROUPS_TABLE . ' g
		LEFT JOIN ' . USER_GROUP_TABLE . ' ug
			ON (
				g.group_id = ug.group_id
				AND ug.user_id = ' . $user->data['user_id'] . '
				AND ug.user_pending = 0
			)
		WHERE g.group_legend = 1
			AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . $user->data['user_id'] . ')
		ORDER BY g.group_name ASC';
}
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result))
{
	$groups[$row['group_id']] = array(
		'group_name'	=> $row['group_name'],
		'group_colour'	=> $row['group_colour'],
		'group_type'	=> $row['group_type'],
		'group_users'	=> array(),
	);
	$legends[] = $row['group_id'];
}
$db->sql_freeresult($result);

if(sizeof($legends))
{
	$sql = 'SELECT
				u.user_id AS user_id, u.username AS username, u.user_colour AS user_colour, ug.group_id AS group_id
			FROM
				' . USERS_TABLE . ' AS u,
				' . USER_GROUP_TABLE . ' AS ug
			WHERE
				ug.user_id = u.user_id
				AND '. $db->sql_in_set('ug.group_id', $legends) . '
			ORDER BY u.username ASC';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$groups[$row['group_id']]['group_users'][] = array(
			'user_id'		=> $row['user_id'],
			'username'		=> $row['username'],
			'user_colour'	=> $row['user_colour'],
		);
	}
	$db->sql_freeresult($result);
}

if(sizeof($groups))
{
	foreach($groups as $group_id => $group)
	{
		if(sizeof($group['group_users']))
		{
			$group_name = ($group['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $group['group_name']] : $group['group_name'];
			$u_group = append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $group_id);

			$template->assign_block_vars('group', array(
				'GROUP_NAME'	=> $group_name,
				'GROUP_COLOUR'	=> $group['group_colour'],
				'U_GROUP'		=> $u_group,
			));

			foreach($group['group_users'] as $group_user)
			{
				$template->assign_block_vars('group.member', array(
					'USER_ID'			=> $group_user['user_id'],
					'USERNAME_FULL'		=> get_username_string('full', $group_user['user_id'], $group_user['username'], $group_user['user_colour']),
				));
			}
		}
	}
}

$template->assign_var('S_DISPLAY_LEADERS_EXT', true);

?>