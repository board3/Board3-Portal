<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( delta221 http://www.scannernytt.net )
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
	'ACP_PORTAL_GENERAL_INFO'					=> 'Generell',
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Globale annonseringer',
	'ACP_PORTAL_NEWS_INFO'						=> 'Nyheter',
	'ACP_PORTAL_RECENT_INFO'					=> 'Siste emner',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Ordstokk',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Generelle instillinger',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal donasjoner',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'		=> 'Vedlegg',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'Siste medlemmer',
	'ACP_PORTAL_POLLS_INFO'						=> 'Avstemninger',
	'ACP_PORTAL_BOTS_INFO'						=> 'Sist besøkte boter',
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Topp postere',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Velkomstmelding',
	'ACP_PORTAL_ADS_INFO'						=> 'Annonse',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini kalender',
));

?>