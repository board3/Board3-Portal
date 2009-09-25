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

define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
include($phpbb_root_path . 'portal/includes/functions.' . $phpEx);

$portal_config = obtain_portal_config();

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_portal');

if (!$portal_config['portal_enable'])
{
	redirect($phpbb_root_path . 'index.' . $phpEx);
}

$load_center = true;

if (file_exists($phpbb_root_path . 'install/index.' . $phpEx) && ($user->data['user_type'] == USER_FOUNDER))
{
	$template->assign_var('S_DISPLAY_GENERAL', true);
	$load_center = false;
}

if ($portal_config['portal_phpbb_menu'])
{
	$template->assign_var('S_DISPLAY_PHPBB_MENU', true);
}

if ($portal_config['version_check_time'] + 86400 < time())
{
	// Scare the user of outdated versions
	if (!function_exists('mod_version_check'))
	{
		$phpbb_admin_path = $phpbb_root_path . 'adm/';
		include($phpbb_root_path . 'portal/includes/functions_version_check.' . $phpEx);
	}
	set_portal_config('version_check_time', time());
	set_portal_config('version_check_version', mod_version_check(true));
}

if ($auth->acl_get('a_') && version_compare($portal_config['portal_version'], $portal_config['version_check_version'], '<') && $portal_config['portal_version_check'])
{
	$user->add_lang('mods/lang_portal_acp');
	$template->assign_vars(array(
		'PORTAL_VERSION_CHECK'			=> sprintf($user->lang['NOT_UP_TO_DATE'], $user->lang['PORTAL']),
	));
}

if ($load_center)
{
	if ($portal_config['portal_forum_index'])
	{
		display_forums('');

		$template->assign_vars(array(
			'FORUM_IMG'						=> $user->img('forum_read', 'NO_NEW_POSTS'),
			'FORUM_NEW_IMG'					=> $user->img('forum_unread', 'NEW_POSTS'),
			'FORUM_LOCKED_IMG'				=> $user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
			'FORUM_NEW_LOCKED_IMG'			=> $user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),
			'S_DISPLAY_PORTAL_FORUM_INDEX'	=> true,
			'U_MARK_FORUMS'					=> ($user->data['is_registered'] || $config['load_anon_lastread']) ? append_sid("{$phpbb_root_path}index.$phpEx", 'mark=forums') : '',
			'U_MCP'							=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '',
		));
	}

	if ($portal_config['portal_recent'])
	{
		include($phpbb_root_path . 'portal/block/recent.' . $phpEx);
	}

	if ($portal_config['portal_wordgraph'])
	{
		include($phpbb_root_path . 'portal/block/wordgraph.' . $phpEx);
	}

	if ($portal_config['portal_poll_topic'])
	{
		include($phpbb_root_path . 'portal/block/poll.' . $phpEx);
	}

	if ($portal_config['portal_welcome'])
	{
		include($phpbb_root_path . 'portal/block/welcome.' . $phpEx);
	}

	if ($portal_config['portal_welcome_guest'])
	{
		$template->assign_var('S_DISPLAY_WELCOME_GUEST', true);
	}

	if ($portal_config['portal_announcements'])
	{
		include($phpbb_root_path . 'portal/block/announcements.' . $phpEx);
		$template->assign_var('S_ANNOUNCE_COMPACT', $portal_config['portal_announcements_style']);
	}

	if ($portal_config['portal_news'])
	{
		include($phpbb_root_path . 'portal/block/news.' . $phpEx);
		$template->assign_var('S_NEWS_COMPACT', $portal_config['portal_news_style']);
	}

	if ($portal_config['portal_custom_center'] || $portal_config['portal_custom_small'])
	{
		include($phpbb_root_path . 'portal/block/custom.' . $phpEx);
	}

	if ($portal_config['portal_pay_s_block'] || ($portal_config['portal_pay_c_block']))
	{
		include($phpbb_root_path . 'portal/block/donate.' . $phpEx);
	}

	if ($config['load_online'] && $config['load_online_time'] && $portal_config['portal_whois_online'])
	{
		include($phpbb_root_path . 'portal/block/whois_online.' . $phpEx);
	}
}

// show login box and user menu
// only registered user see user menu
if ($user->data['is_registered'])
{
	include($phpbb_root_path . 'portal/block/user_menu.' . $phpEx);
}
else
{
	include($phpbb_root_path . 'portal/block/login_box.' . $phpEx);
}

if ($portal_config['portal_main_menu'])
{
	include($phpbb_root_path . 'portal/block/main_menu.' . $phpEx);
}

if ($portal_config['portal_user_menu'])
{
	$template->assign_var('S_DISPLAY_USERMENU', true);
}

if ($portal_config['portal_birthdays'])
{
	include($phpbb_root_path . 'portal/block/birthday_list.' . $phpEx);
}

if ($portal_config['portal_search'])
{
	include($phpbb_root_path . 'portal/block/search.' . $phpEx);
}

if ($portal_config['portal_attachments'] && $config['allow_attachments'])
{
	include($phpbb_root_path . 'portal/block/attachments.' . $phpEx);
}

if ($portal_config['portal_advanced_stat'])
{
	include($phpbb_root_path . 'portal/block/statistics.' . $phpEx);
}

if ($portal_config['portal_minicalendar'])
{
	include($phpbb_root_path . 'portal/block/mini_cal.' . $phpEx);
}

if ($portal_config['portal_link_us'])
{
	include($phpbb_root_path . 'portal/block/link_us.' . $phpEx);
}

if ($portal_config['portal_leaders'] && $portal_config['portal_leaders_ext'])
{
	include($phpbb_root_path . 'portal/block/leaders_ext.' . $phpEx);
}
elseif ($portal_config['portal_leaders'])
{
	include($phpbb_root_path . 'portal/block/leaders.' . $phpEx);
}

if ($portal_config['portal_load_last_visited_bots'])
{
	include($phpbb_root_path . 'portal/block/latest_bots.' . $phpEx);
}

if ($portal_config['portal_top_posters'])
{
	include($phpbb_root_path . 'portal/block/top_posters.' . $phpEx);
}

if ($portal_config['portal_latest_members'])
{
	include($phpbb_root_path . 'portal/block/latest_members.' . $phpEx);
}

if ($portal_config['portal_random_member'])
{
	include($phpbb_root_path . 'portal/block/random_member.' . $phpEx);
}

if ($portal_config['portal_friends'])
{
	include($phpbb_root_path . 'portal/block/friends.' . $phpEx);
}

if ($portal_config['portal_change_style'])
{
	include($phpbb_root_path . 'portal/block/change_style.' . $phpEx);
}

if ($portal_config['portal_clock'])
{
	$template->assign_var('S_DISPLAY_CLOCK', true);
}

if ($portal_config['portal_links'])
{
	include($phpbb_root_path . 'portal/block/links.' . $phpEx);
}

include($phpbb_root_path . 'portal/block/additional_blocks.' . $phpEx);

$template->assign_vars(array(
	'PORTAL_LEFT_COLUMN'	=> $portal_config['portal_left_column_width'],
	'PORTAL_RIGHT_COLUMN'	=> $portal_config['portal_right_column_width'],
));

// output page
page_header($user->lang['PORTAL']);

$template->set_filenames(array(
	'body' => '/portal/portal_body.html'
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum . $phpEx"));

page_footer();

?>