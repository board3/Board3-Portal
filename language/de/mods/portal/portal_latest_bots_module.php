<?php
/**
*
* @package Board3 Portal v2.1 - Latest Bots
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
	'LATEST_BOTS'			=> 'Letzte Bots',
	'LAST_VISITED_BOTS'		=> 'Die letzten Bots',

	// ACP
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Einstellungen für Bot-Besuche',
	'ACP_PORTAL_BOTS_SETTINGS_EXP'			=> 'Hier kannst du die Einstellungen für Bot-Besuche ändern.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Anzahl der anzuzeigenden Bots',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXP'	=> '0 bedeutet unbegrenzt',
));
