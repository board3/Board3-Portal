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

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

//

if ($config['load_online'] && $config['load_online_time'])
{
	// who is online borrowed from index.php (phpBB-3.0.B3) 
	// if this gets changed (in index.php) and I don't notice it, please tell me)
	//

	// Grab group details for legend display
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

	$legend = '';
	while ($row = $db->sql_fetchrow($result))
	{
		$colour_text = ($row['group_colour']) ? ' style="color:#' . $row['group_colour'] . '"' : '';

		if ($row['group_name'] == 'BOTS')
		{
			$legend .= (($legend != '') ? ', ' : '') . '<span' . $colour_text . '>' . $user->lang['G_BOTS'] . '</span>';
		}
		else
		{
			$legend .= (($legend != '') ? ', ' : '') . '<a' . $colour_text . ' href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']) . '">' . (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']) . '</a>';
		}
	}
	$db->sql_freeresult($result);

	//
	// users online list borrowed from includes/functions.php (phpBB-3.0.B3) 
	// if this gets changed (in functions.php) and I don't notice it, please tell me)
	//
	$display_online_list = true;

	// Get users online list ... if required
	$l_online_users = $online_userlist = $l_online_record = '';

	if ($config['load_online'] && $config['load_online_time'] && $display_online_list)
	{
		// Assign specific vars
		$template->assign_vars(array(
			'LEGEND'						=> $legend,
		));

		if (!isset($template->filename['whois_online_block']))
		{
			$template->set_filenames(array(
				'whois_online_block'	=> 'portal/block/whois_online.html')
			);
		}

		$block_temp = $template->assign_display('whois_online_block');

		$template->assign_block_vars('portal_column_'.$block_pos, array(
			'BLOCK_DATA'	=> $block_temp)
		);
		unset( $block_temp );
	}
}

?>