<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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
	'ACP_PORTAL_INFO'							=> 'Portál',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Hlavní',
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Globální oznámení',
	'ACP_PORTAL_NEWS_INFO'						=> 'Poslední příspěvky',
	'ACP_PORTAL_RECENT_INFO'					=> 'Poslední články',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Wordgraph',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Základní nastavení',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal příspěvky',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'		=> 'Přílohy',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'Nejnovější uživatelé',
	'ACP_PORTAL_POLLS_INFO'						=> 'Ankety',
	'ACP_PORTAL_BOTS_INFO'						=> 'Poslední návštěvy botů',
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Nejaktivnější uživatelé',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Uvítací zpráva',
	'ACP_PORTAL_ADS_INFO'						=> 'Reklama',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Kalendář',
	'ACP_PORTAL_LINKS_INFO'                  => 'Odkazy',
	'ACP_PORTAL_CUSTOM_INFO'               => 'Uživatelský blok',
));

?>