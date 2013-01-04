<?php
/**
*
* @package Board3 Portal v2 - Clock
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'CLOCK'		=> 'Uhr',

	// ACP
	'ACP_PORTAL_CLOCK_SETTINGS'		=> 'Uhr Einstellungen',
	'ACP_PORTAL_CLOCK_SETTINGS_EXP'	=> 'Hier kannst du die Einstellungen für die Uhr ändern',
	'ACP_PORTAL_CLOCK_SRC'			=> 'Uhr',
	'ACP_PORTAL_CLOCK_SRC_EXP'		=> 'Gebe den Dateinamen der Uhr  ein. Die Uhr muss unter folgendem Pfad gespeichert sein: styles/*yourstyle*/theme/images/portal/.',
));
