<?php
/**
*
* @package Board3 Portal v2.3 - Custom
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
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
	$lang = [];
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
$lang = array_merge($lang, [
	'PORTAL_CUSTOM'		=> 'Eigener Block',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Custom Block Settings',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Einstellungen für den eigenen Block',
	'TOO_FEW_CHARS'							=> 'Der eingegebene Code ist nicht lang genug.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Vorschau',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Code für den eigenen Block',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Änderen Sie den Code für Ihre eigenen Block (HTML oder BBCode).',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Berechtigungen für den eigenen Block',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Wählen Sie die Gruppen aus, die den eigenen Block sehen dürfen. <br />Wählen Sie mehrere Gruppen aus/ab, indem Sie beim Klicken die <samp>Strg</samp>-Taste gedrückt halten.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'BBCode für den eigenen Block aktivieren',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'BBCode kann dann in diesem Block benutzt werden. Ansonsten wird HTML direkt geparst.',
]);
