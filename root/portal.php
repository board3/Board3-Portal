<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/


define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'portal/includes/functions.'.$phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/lang_portal');

$load_center = true;

if ( is_dir( $phpbb_root_path . 'install_portal/' ) === TRUE )
{
	if ( is_file( $phpbb_root_path . 'install_portal/install.php' ) === TRUE )
	{
		include $phpbb_root_path . 'install_portal/install.php';

		if ( version_compare( $current_version, $portal_config['portal_version'], '<=' ) === TRUE )
		{
			$template->assign_vars(array(
				'S_DISPLAY_GENERAL'	=> true,
				'GEN_TITLE'				=> $user->lang['PORTAL_ERROR'],
				'GEN_MESSAGE'			=> sprintf( $user->lang['PORTAL_DELETE_DIR'], $phpbb_root_path . 'install_portal' )
			));
		}
		else
		{
			$template->assign_vars(array(
				'S_DISPLAY_GENERAL'	=> true,
				'GEN_TITLE'				=> $user->lang['PORTAL_UPDATE'],
				'GEN_MESSAGE'			=> sprintf( $user->lang['PORTAL_UPDATE_TEXT'], $phpbb_root_path . 'install_portal/install.php', $current_version )
			));
		}

		$load_center = false;
	}
}

if ( $load_center === TRUE )
{
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
		$template->assign_vars(array(
			'S_DISPLAY_WELCOME' 	=> true,
			'PORTAL_WELCOME_INTRO'   => str_replace("\n", "<br />", $portal_config['portal_welcome_intro']),
		));
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

	/*
	if ($portal_config['portal_ads_center'])
	{
		$template->assign_vars(array(
			'S_ADS_CENTER' 		=> ($portal_config['portal_ads_center_box']) ? true : false,
		//	'ADS_CENTER_BOX'	=> $portal_config['portal_ads_center_box'],
		));
	}
	*/

	if ($portal_config['portal_whois_online'])
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
	$template->assign_vars(array(
		'S_DISPLAY_MAINMENU' 	=> true,
	));
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

if ($portal_config['portal_attachments'])
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

if ($portal_config['portal_leaders'])
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
//	include($phpbb_root_path . 'portal/block/links.'.$phpEx);
	$template->assign_vars(array(
		'S_DISPLAY_LINKS' => true,
	));
}


if ($portal_config['portal_pay_s_block'] or ( $portal_config['portal_pay_c_block'] && $load_center === TRUE ) )
{
	include($phpbb_root_path . 'portal/block/donate.'.$phpEx);
}

/*
if ($portal_config['portal_ads_small'])
{
	$template->assign_vars(array(
		'S_ADS_SMALL' 	=> ($portal_config['portal_ads_small_box']) ? true : false,
	//	'ADS_SMALL_BOX'	=> $portal_config['portal_ads_small_box'],
	));
}
*/

$template->assign_vars(array(
	'S_DISPLAY_JUMPBOX' 	=> $load_center,
	'PORTAL_LEFT_COLLUMN' 	=> $portal_config['portal_left_collumn_width'],
	'PORTAL_RIGHT_COLLUMN' 	=> $portal_config['portal_right_collumn_width'],
));

// output page
page_header($user->lang['PORTAL']);

$template->set_filenames(array(
	'body' => '/portal/portal_body.html'
));


make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));

page_footer();

?>
