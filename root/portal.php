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
include($phpbb_root_path . 'includes/message_parser.'.$phpEx);
include($phpbb_root_path . 'portal/includes/functions.'.$phpEx);

$portal_config = obtain_portal_config();

if (!$portal_config['portal_enable'])
{
	// Redirect the user to the installer
	// We have to generate a full HTTP/1.1 header here since we can't guarantee to have any of the information
	// available as used by the redirect function
	$server_name = (!empty($_SERVER['HTTP_HOST'])) ? strtolower($_SERVER['HTTP_HOST']) : ((!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME'));
	$server_port = (!empty($_SERVER['SERVER_PORT'])) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT');
	$secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;

	$script_name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF');
	if (!$script_name)
	{
		$script_name = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
	}

	// Replace any number of consecutive backslashes and/or slashes with a single slash
	// (could happen on some proxy setups and/or Windows servers)
	$script_path = trim(dirname($script_name)) . '/'.$phpbb_root_path.'index.' . $phpEx;
	$script_path = preg_replace('#[\\\\/]{2,}#', '/', $script_path);

	$url = (($secure) ? 'https://' : 'http://') . $server_name;

	if ($server_port && (($secure && $server_port <> 443) || (!$secure && $server_port <> 80)))
	{
		// HTTP HOST can carry a port number...
		if (strpos($server_name, ':') === false)
		{
			$url .= ':' . $server_port;
		}
	}

	$url .= $script_path;
	header('Location: ' . $url);
	exit;
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_portal');

$load_center = true;

if ( is_file( $phpbb_root_path . 'install/index.'.$phpEx ) === TRUE && ($user->data['user_type'] == USER_FOUNDER) )
{
		$template->assign_vars(array(
			'S_DISPLAY_GENERAL'	=> true,
			'GEN_TITLE'				=> $user->lang['PORTAL_INSTALL'],
			'GEN_MESSAGE'			=> $user->lang['PORTAL_INSTALL_TEXT']
		));
	$load_center = false;
}

if ($portal_config['portal_phpbb_menu'])
{
	$template->assign_vars(array(
		'S_DISPLAY_PHPBB_MENU' => true,
	));
}

if ( $load_center === TRUE )
{

	if ($portal_config['portal_forum_index']) 
	{ 
		display_forums('');

		$template->assign_vars(array(
			'FORUM_IMG'				=> $user->img('forum_read', 'NO_NEW_POSTS'),
			'FORUM_NEW_IMG'			=> $user->img('forum_unread', 'NEW_POSTS'),
			'FORUM_LOCKED_IMG'		=> $user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
			'FORUM_NEW_LOCKED_IMG'	=> $user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),
			'S_DISPLAY_PORTAL_FORUM_INDEX' => true,

			'U_MARK_FORUMS'		=> ($user->data['is_registered'] || $config['load_anon_lastread']) ? append_sid("{$phpbb_root_path}index.$phpEx", 'mark=forums') : '',
			'U_MCP'				=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '')
		);
	}

	if ($portal_config['portal_recent']) 
	{ 
		include($phpbb_root_path . 'portal/block/recent.'.$phpEx);
	}
		
	if ($portal_config['portal_wordgraph'])
	{
		include($phpbb_root_path . 'portal/block/wordgraph.'.$phpEx);
	}
		
	if ($portal_config['portal_poll_topic'])
	{
		include($phpbb_root_path . 'portal/block/poll.'.$phpEx);
	}
		
	if ($portal_config['portal_welcome'])
	{
		include($phpbb_root_path . 'portal/block/welcome.'.$phpEx);
	}
		
	if ($portal_config['portal_welcome_guest'])
	{
		$template->assign_vars(array(
			'S_DISPLAY_WELCOME_GUEST' => true,
		));
	}
		
	if ($portal_config['portal_announcements'])
	{
		include($phpbb_root_path . 'portal/block/announcements.'.$phpEx);
		$template->assign_vars(array(
			'S_ANNOUNCE_COMPACT' => ($portal_config['portal_announcements_style']) ? true : false,
		));
	}
		
	if ($portal_config['portal_news'])
	{
		include($phpbb_root_path . 'portal/block/news.'.$phpEx);
		$template->assign_vars(array(
			'S_NEWS_COMPACT' => ($portal_config['portal_news_style']) ? true : false,
		));
	}

	if ($portal_config['portal_custom_center'] or $portal_config['portal_custom_small'])
	{
		include($phpbb_root_path . 'portal/block/custom.'.$phpEx);
	}

	if ($config['load_online'] && $config['load_online_time'] && $portal_config['portal_whois_online'])
	{
		include($phpbb_root_path . 'portal/block/whois_online.'.$phpEx);
	}

}
// show login box and user menu
// only registered user see user menu
if ($user->data['is_registered'])
{
	include($phpbb_root_path . 'portal/block/user_menu.'.$phpEx);
}
else
{
	include($phpbb_root_path . 'portal/block/login_box.'.$phpEx);
}

if ($portal_config['portal_main_menu'])
{
	include($phpbb_root_path . 'portal/block/main_menu.'.$phpEx);
}

if ($portal_config['portal_user_menu'])
{
	$template->assign_vars(array(
		'S_DISPLAY_USERMENU' 	=> true,
	));
}

if ($portal_config['portal_birthdays'])
{
	include($phpbb_root_path . 'portal/block/birthday_list.'.$phpEx);
}

if ($portal_config['portal_search'])
{
	include($phpbb_root_path . 'portal/block/search.'.$phpEx);
}

if ($portal_config['portal_attachments'] && $config['allow_attachments'])
{
	include($phpbb_root_path . 'portal/block/attachments.'.$phpEx);
}

if ($portal_config['portal_advanced_stat'])
{
	include($phpbb_root_path . 'portal/block/statistics.'.$phpEx);
}

if ($portal_config['portal_minicalendar'])
{
	include($phpbb_root_path . 'portal/block/mini_cal.'.$phpEx);
}

if ($portal_config['portal_link_us'])
{
	include($phpbb_root_path . 'portal/block/link_us.'.$phpEx);
}

if ($portal_config['portal_leaders'] && $portal_config['portal_leaders_ext'])
{
	include($phpbb_root_path . 'portal/block/leaders_ext.'.$phpEx);
}
elseif ($portal_config['portal_leaders'])
{
	include($phpbb_root_path . 'portal/block/leaders.'.$phpEx);
}

if ($portal_config['portal_load_last_visited_bots'])
{
	include($phpbb_root_path . 'portal/block/latest_bots.'.$phpEx);
}

if ($portal_config['portal_top_posters'])
{
	include($phpbb_root_path . 'portal/block/top_posters.'.$phpEx);
}

if ($portal_config['portal_latest_members'])
{
	include($phpbb_root_path . 'portal/block/latest_members.'.$phpEx);
}

if ($portal_config['portal_random_member'])
{
	include($phpbb_root_path . 'portal/block/random_member.'.$phpEx);
}

if ($portal_config['portal_friends'])
{
	include($phpbb_root_path . 'portal/block/friends.'.$phpEx);
}

if ($portal_config['portal_change_style'])
{
	include($phpbb_root_path . 'portal/block/change_style.'.$phpEx);
}

if ($portal_config['portal_clock'])
{
	$template->assign_vars(array(
		'S_DISPLAY_CLOCK' => true,
	));
}

if ($portal_config['portal_links'])
{
	include($phpbb_root_path . 'portal/block/links.'.$phpEx);
}


if ($portal_config['portal_pay_s_block'] or ($portal_config['portal_pay_c_block']))
{
	include($phpbb_root_path . 'portal/block/donate.'.$phpEx);
}

include($phpbb_root_path . 'portal/block/additional_blocks.'.$phpEx);

$template->assign_vars(array(
	'PORTAL_LEFT_COLUMN' 	=> $portal_config['portal_left_column_width'],
	'PORTAL_RIGHT_COLUMN' 	=> $portal_config['portal_right_column_width'],
));

// output page
page_header($user->lang['PORTAL']);

$template->set_filenames(array(
	'body' => '/portal/portal_body.html'
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));

page_footer();

?>