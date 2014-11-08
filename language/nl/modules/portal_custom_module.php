<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Aangepast blok',
	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Aangepast blok Instelingen',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Hier kan je het aangepaste blok aanpassen',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'De code die je hebt ingevoerd is niet lang genoeg.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Voorbeeld',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Code aangepast blok',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Verander de code voor het smalle aangepaste blok (HTML of BBCode) hier.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Aangepast blok permissies',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Selecteer de groepen die het aangepaste blok mogen zien. Als je wilt dat alle gebruikers dit aangepaste blok mogen zien, selecteer dan niks.<br />Selecteer/Deselecteer meerdere groepen door middel van <samp>CTRL</samp> en door te klikken.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Activeer BBCode voor het aangepaste blok',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'Je kan BBcodes gebruiken in dit vak. Als BBCodes niet geactiveerd zijn, zal HTML verwerkt worden.',
));
