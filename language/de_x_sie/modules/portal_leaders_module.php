<?php
/**
*
* @package Board3 Portal v2.3 - Leaders
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
	'NO_ADMINISTRATORS_P'	=> 'Keine Administratoren',
	'NO_MODERATORS_P'		=> 'Keine Moderatoren',
	'NO_GROUPS_P'			=> 'Keine Gruppen',
	'ACP_PORTAL_LEADERS'	=> 'Das Team',

	// ACP
	'ACP_PORTAL_LEADERS'		=> 'Team Block Einstellungen',
	'ACP_PORTAL_LEADERS_EXP'	=> 'Hier können Sie den Team-Block anpassen',
	'PORTAL_LEADERS_EXT'		=> 'Erweiterter Team-Block',
	'PORTAL_LEADERS_EXT_EXP'	=> 'Der standard Block listet alle Admins und Moderatoren auf, der erweiterte Team-Block listet zusätzlich alle nicht-versteckten Gruppen inklusive Legende auf.',
]);
