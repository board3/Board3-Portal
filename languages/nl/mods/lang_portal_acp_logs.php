<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) Raimon ( http://www.phpBBservice.nl  )
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
    'LOG_CONFIG_CUSTOMBLOCK'            => '<strong>Portaal: aangepasteblok-instellingen aangepast</strong>',
	'LOG_CONFIG_GENERAL'				=> '<strong>Portaal: algemene instellingen aangepast</strong>',
	'LOG_CONFIG_LINKS'                  => '<strong>Portaal: linksblok-instellingen aangepast</strong>',
	'LOG_CONFIG_NEWS'					=> '<strong>Portaal: nieuwsinstellingen aangepast</strong>',
	'LOG_CONFIG_ANNOUNCEMENTS'			=> '<strong>Portaal: mededelingeninstellingen aangepast</strong>',
	'LOG_CONFIG_WELCOME'				=> '<strong>Portaal: welkomstbericht aangepast</strong>',
	'LOG_CONFIG_RECENT'					=> '<strong>Portaal: recente onderwerpeninstellingen aangepast</strong>',
	'LOG_CONFIG_WORDGRAPH'				=> '<strong>Portaal: woordgrafiekinstellingen aangepast</strong>',
	'LOG_CONFIG_PAYPAL'					=> '<strong>Portaal: paypal donatiesinstellingen aangepast</strong>',
	'LOG_CONFIG_ATTACHMENTS'			=> '<strong>Portaal: bijlageninstellingen aangepast</strong>',
	'LOG_CONFIG_MEMBERS'				=> '<strong>Portaal: laatste gebruikersinstellingen aangepast</strong>',
	'LOG_CONFIG_POLLS'					=> '<strong>Portaal: peilingeninstellingen aangepast</strong>',
	'LOG_CONFIG_BOTS'					=> '<strong>Portaal: laatst bezochte botsinstellingen aangepast</strong>',
	'LOG_CONFIG_POSTER'					=> '<strong>Portaal: meeste berichtenplaatsers-instellingen aangepast</strong>',
	'LOG_CONFIG_MINICALENDAR'			=> '<strong>Portaal: mini-kalenderinstellingen aangepast</strong>',

));

?>