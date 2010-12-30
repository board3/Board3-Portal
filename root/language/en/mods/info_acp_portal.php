<?php

/**
*
* @package - Board3portal
* @version $Id: info_acp_portal.php 503 2009-04-20 18:34:29Z kevin74 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( You - http://www.yourdomain.com )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_PORTAL_INFO'							=> 'Portal',
	'ACP_PORTAL_GENERAL_INFO'					=> 'General',
	'ACP_PORTAL_ANNOUNCEMENTS_INFO'				=> 'Global announcements',
	'ACP_PORTAL_NEWS_INFO'						=> 'News',
	'ACP_PORTAL_RECENT_INFO'					=> 'Recent topics',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Wordgraph',
	'ACP_PORTAL_GENERAL_INFO'					=> 'General settings',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal donations',
	'ACP_PORTAL_ATTACHMENTS_INFO'				=> 'Attachments',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'Newest members',
	'ACP_PORTAL_POLLS_INFO'						=> 'Poll',
	'ACP_PORTAL_BOTS_INFO'						=> 'Recent bots',
	'ACP_PORTAL_POSTER_INFO'					=> 'Peak posters',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Welcome message',
	'ACP_PORTAL_CUSTOMBLOCK_INFO'				=> 'Custom block',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini calendar',
	'ACP_PORTAL_LINKS_INFO'						=> 'Links',
	'ACP_PORTAL_BIRTHDAYS_INFO'					=> 'Birthdays',
	'ACP_PORTAL_FRIENDS_INFO'					=> 'Friends',
	
	// Logs
	'LOG_PORTAL_CONFIG'			=> '<strong>Altered Portal settings</strong><br />&raquo; %s',
	
	// Adding the permissions
	'acl_a_portal_manage'		=> array('lang' => 'Can alter Portal settings', 'cat' => 'misc'),
));

?>