<?php

/**
*
* @package - Board3portal
* @version $Id: info_acp_portal.php 503 2009-04-20 18:34:29Z kevin74 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
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
	'ACP_PORTAL_GENERAL_INFO'					=> 'Allgemein',
	'ACP_PORTAL_ANNOUNCEMENTS_INFO'				=> 'Bekanntmachungen',
	'ACP_PORTAL_NEWS_INFO'						=> 'Aktuelle Beiträge',
	'ACP_PORTAL_RECENT_INFO'					=> 'Aktuelle Themen',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Wordgraph',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Allgemeine Einstellungen',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal-Spenden',
	'ACP_PORTAL_ATTACHMENTS_INFO'				=> 'Dateianhänge',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'Die neuesten Mitglieder',
	'ACP_PORTAL_POLLS_INFO'						=> 'Umfragen',
	'ACP_PORTAL_BOTS_INFO'						=> 'Die letzten Bots',
	'ACP_PORTAL_POSTER_INFO'					=> 'Die Vielschreiber',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Willkommens-Nachricht',
	'ACP_PORTAL_CUSTOMBLOCK_INFO'				=> 'Eigener Block',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini-Kalender',
	'ACP_PORTAL_LINKS_INFO'						=> 'Links',
	'ACP_PORTAL_BIRTHDAYS_INFO'					=> 'Geburtstage',
	'ACP_PORTAL_FRIENDS_INFO'					=> 'Freunde',
	
	// Logs
	'LOG_PORTAL_CONFIG'			=> '<strong>Portal-Einstellungen geändert</strong><br />&raquo; %s',
	
	// Adding the permissions
	'acl_a_portal_manage'		=> array('lang' => 'Kann Portal-Einstellungen ändern', 'cat' => 'misc'),
));

?>