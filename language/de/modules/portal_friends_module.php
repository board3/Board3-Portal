<?php
/**
*
* @package Board3 Portal v2.1 - Friends
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
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
	'FRIENDS'							=> 'Freunde',
	'FRIENDS_OFFLINE'				=> 'Offline',
	'FRIENDS_ONLINE'					=> 'Online',
	'NO_FRIENDS'						=> 'Derzeit sind keine Freunde definiert',
	'NO_FRIENDS_OFFLINE'			=> 'Keine Freunde offline',
	'NO_FRIENDS_ONLINE'			=> 'Keine Freunde online',

	// ACP
	'ACP_PORTAL_FRIENDS_SETTINGS'				=> 'Einstellungen für den Freunde-Block',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXP'		=> 'Hier kannst du die Einstellungen für den Freunde-Block ändern.',
	'PORTAL_MAX_ONLINE_FRIENDS'					=> 'Limitierung der Anzeige Freunde online',
	'PORTAL_MAX_ONLINE_FRIENDS_EXP'			=> 'Limitiert die Anzeige Freunde online auf den angegebenen Wert.',
));
