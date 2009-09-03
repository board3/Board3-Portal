<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/portal');

$portal_root_path = PORTAL_ROOT_PATH;
$portal_icons_path = PORTAL_ICONS_PATH;
if (!function_exists('group_memberships'))
{
    include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
}
if (!function_exists('obtain_portal_config'))
{
	include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
}
$portal_config = obtain_portal_config();


if (!$portal_config['portal_enable'])
{
	redirect($phpbb_root_path . 'index.' . $phpEx);
}

if (file_exists($phpbb_root_path . 'install/index.' . $phpEx) && ($user->data['user_type'] == USER_FOUNDER))
{
	$template->assign_var('S_DISPLAY_GENERAL', true);
}

// Grab blocks
if ($portal_config['num_blocks'] > 0)
{
	$blocks = $cache->obtain_blocks();

	if (sizeof($blocks))
	{
		foreach ($blocks as $id => $data)
		{
			$group_id = $data['group'];
			$user_id = $user->data['user_id'];
			$is_in_group = ($data['group'] <> 0) ? group_memberships($group_id, $user_id , true) : true;	

			/*if ($data['title'] == 'BLOCK_ANNOUNCEMENTS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/announcements.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_ATTACHMENTS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/attachments.' . $phpEx);
			}*/
			if ($data['title'] == 'BLOCK_BIRTHDAY' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/birthday_list.' . $phpEx);
			}
			/*if ($data['title'] == 'BLOCK_CHANGE_STYLE' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/change_style.' . $phpEx);
			}*/
			if ($data['title'] == 'BLOCK_DONATE' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/donate.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_ONLINE_FRIENDS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/friends.' . $phpEx);
			}			
			if ($data['title'] == 'BLOCK_LATEST_MEMBERS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/latest_members.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_BOTS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/latest_bots.' . $phpEx);
			}
			/*if ($data['title'] == 'BLOCK_LEADERS' && $data['position'] > 0 && $is_in_group)
			{
				if ($portal_config['portal_leaders_ext'])
				{
					include($phpbb_root_path . 'portal/block/leaders_ext.'.$phpEx);
				}
				else
				{
					include($phpbb_root_path . 'portal/block/leaders.'.$phpEx);
				}
			}
			if ($data['title'] == 'BLOCK_LINK_US' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/link_us.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_MINI_CAL' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/mini_cal.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_POLL' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/poll.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_RANDOM_MEMBER' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/random_member.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_RECENT' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/recent.' . $phpEx);
			}*/
			if ($data['title'] == 'BLOCK_STATISTICS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/statistics.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_TOP_POSTERS' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/top_posters.' . $phpEx);
			}
			if ($data['title'] == 'BLOCK_USER_MENU' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/user_menu.' . $phpEx);
			}
			/*if ($data['title'] == 'BLOCK_WORDGRAPH' && $data['position'] > 0 && $is_in_group)
			{
				include($phpbb_root_path . $portal_root_path . 'block/wordgraph.' . $phpEx);
			}*/

			$template->assign_block_vars('blocks', array(
				'TYPE'		=> $data['type'],
				'ICON'		=> $phpbb_root_path . $portal_icons_path .'/' . $data['icon'],
				'TITLE'		=> (!empty($user->lang[strtoupper($data['title'])])) ? $user->lang[strtoupper($data['title'])] : $data['title'],
				'TEXT'		=> ($data['type'] == 'custom') ? generate_text_for_display($data['text'], $data['text_uid'], $data['text_bitfield'], $data['text_options']) : '',
 
				'S_GROUP'				=> ($is_in_group) ? true : false,
				'S_ICON'				=> ($data['icon']) ? true : false,
				'S_BLOCK_LEFT'			=> ($data['position'] == BLOCK_LEFT) ? true : false,
				'S_BLOCK_RIGHT'			=> ($data['position'] == BLOCK_RIGHT) ? true : false,
				'S_BLOCK_TOP'			=> ($data['position'] == BLOCK_TOP) ? true : false,
				'S_BLOCK_BOTTOM'		=> ($data['position'] == BLOCK_BOTTOM) ? true : false,
				'S_BLOCK_MIDDLE_TOP'	=> ($data['position'] == BLOCK_MIDDLE_TOP) ? true : false,
				'S_BLOCK_MIDDLE_BOTTOM'	=> ($data['position'] == BLOCK_MIDDLE_BOTTOM) ? true : false,
			));
		}
	}
}

$sql = 'SELECT block_position
	FROM ' . PORTAL_BLOCKS_TABLE;
$result = $db->sql_query($sql);
$db->sql_freeresult($result);

// Grab navigation links
//if ($portal_config['num_links'] > 0)
//{
/*	$links = $cache->obtain_links();
	
	if (sizeof($links))
	{
		foreach ($links as $id => $data)
		{
			$template->assign_block_vars('links', array(
				'TITLE'	=> $data['title'],
				'URL'	=> $data['url'],

				'S_IS_CAT'	=> $data['is_cat'],
			));
		}
	}
//}
*/
// Assign specific vars
$template->assign_vars(array(
	'WELCOME_USERNAME'		=> get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']),

	'U_M_BBCODE'			=> append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode'),
	'U_M_TERMS'				=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=terms'),
	'U_M_PRV'				=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=privacy'),	

	'PAY_ACC'				=> $portal_config['portal_pay_acc'],

	'S_SMALL_BLOCK'			=> ($row['block_position'] == BLOCK_LEFT || $row['block_position'] == BLOCK_RIGHT) ? true : false,
	'S_PORTAL_LEFT_COLUMN'	=> $portal_config['portal_left_column_width'],
	'S_PORTAL_RIGHT_COLUMN'	=> $portal_config['portal_right_column_width'],
));

// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'portal/portal_body.html')
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum . $phpEx"));

page_footer();

?>