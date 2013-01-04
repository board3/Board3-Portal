<?php
/**
*
* @package Board3 Portal v2 - Custom
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
	'PORTAL_CUSTOM'		=> 'Eigener Block',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Custom Block Settings',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Einstellungen für den eigenen Block',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'Der eingegebene Code ist nicht lang genug.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Vorschau',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Code für den eigenen Block',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Ändere den Code für deinen eigenen Block (HTML oder BBCode).',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Berechtigungen für den eigenen Block',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Wähle die Gruppen aus, die den eigenen Block sehen dürfen. <br />Wähle mehrere Gruppen aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'BBCode für den eigenen Block aktivieren',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'BBCode kann dann in diesem Block benutzt werden. Ansonsten wird HTML direkt geparst.',
));
