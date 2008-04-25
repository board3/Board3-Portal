<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Global announcements',
	'ACP_PORTAL_NEWS_INFO'						=> 'News',
	'ACP_PORTAL_RECENT_INFO'					=> 'Recent topics',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Wordgraph',
	'ACP_PORTAL_GENERAL_INFO'					=> 'General settings',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal donations',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'		=> 'Attachments',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'Latest members',
	'ACP_PORTAL_POLLS_INFO'						=> 'Poll',
	'ACP_PORTAL_BOTS_INFO'						=> 'Last visited bots',
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Most posters',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Welcome message',
	'ACP_PORTAL_CUSTOM_INFO'					=> 'Custom block',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini calendar',
	'ACP_PORTAL_LINKS_INFO'						=> 'Links',
));

?>