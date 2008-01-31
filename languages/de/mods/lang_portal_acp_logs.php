<?php

/**
*
* @package - Board3portal
* @version
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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
	'LOG_CONFIG_GENERAL'				=> '<strong>Portal: Allgemeine Einstellungen geändert</strong>',
	'LOG_CONFIG_NEWS'					=> '<strong>Portal: Einstellungen für Aktuelle Beiträge geändert</strong>',
	'LOG_CONFIG_ANNOUNCEMENTS'	=> '<strong>Portal: Einstellungen für Bekanntmachungen geändert</strong>',
	'LOG_CONFIG_WELCOME'				=> '<strong>Portal: Einstellungen für die Willkommens Nachricht geändert</strong>',
	'LOG_CONFIG_RECENT'				=> '<strong>Portal: Einstellungen für Aktuelles geändert</strong>',
	'LOG_CONFIG_WORDGRAPH'			=> '<strong>Portal: Einstellungen für den Wordgraph geändert</strong>',
	'LOG_CONFIG_PAYPAL'				=> '<strong>Portal: Einstellungen für PayPal Spenden geändert</strong>',
	'LOG_CONFIG_ATTACHMENTS'		=> '<strong>Portal: Einstellungen für Dateianhänge geändert</strong>',
	'LOG_CONFIG_MEMBERS'				=> '<strong>Portal: Einstellungen für die neuesten Mitglieder geändert</strong>',
	'LOG_CONFIG_POLLS'					=> '<strong>Portal: Einstellungen für die Umfragen geändert</strong>',
	'LOG_CONFIG_BOTS'					=> '<strong>Portal: Einstellungen für die letzten Bots geändert</strong>',
	'LOG_CONFIG_POSTER'				=> '<strong>Portal: Einstellungen für die Vielschreiber geändert</strong>',
	'LOG_CONFIG_MINICALENDAR'		=> '<strong>Portal: Einstellungen für den Mini Kalender geändert</strong>',

));

?>