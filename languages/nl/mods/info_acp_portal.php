<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( raimon http://www.phpBBservice.nl )
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
	'ACP_PORTAL_INFO'							=> 'Portaal',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Algemeen',
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Forummededelingen',
	'ACP_PORTAL_NEWS_INFO'						=> 'Nieuws',
	'ACP_PORTAL_RECENT_INFO'					=> 'Recente onderwerpen',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Wordgraph',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Algemene instellingen',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal donaties',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'		=> 'Bijlagen',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'Laatste gebruikers',
	'ACP_PORTAL_POLLS_INFO'						=> 'Peilingen',
	'ACP_PORTAL_BOTS_INFO'						=> 'Laatst bezochte bots',
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Meeste berichtenplaatsers',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Welkomsbericht',
	'ACP_PORTAL_ADS_INFO'						=> 'Adertenties',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini-kalender',
));

?>