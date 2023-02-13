<?php
/**
*
* @package Board3 Portal v2.3 - Links
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
	'PORTAL_LINKS'		=> 'Links',
	'LINKS_NO_LINKS'	=> 'Keine Links vorhanden',

	// ACP
	'ACP_PORTAL_LINKS'				=> 'Links-Einstellungen',
	'ACP_PORTAL_LINKS_EXP'			=> 'Einstellungen für die Links ändern.',
	'ACP_PORTAL_LINK_TITLE'			=> 'Titel',
	'ACP_PORTAL_LINK_TYPE'			=> 'Link Typ',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'Falls Ihr Link auf Ihr Forum verweist, dann wählen Sie bitte "Interner Link" um ungewollte Logouts zu verhindern.',
	'ACP_PORTAL_LINK_INT'			=> 'Interner Link',
	'ACP_PORTAL_LINK_EXT'			=> 'Externer Link',
	'ACP_PORTAL_LINK_ADD'			=> 'Link erstellen',
	'ACP_PORTAL_LINK_URL'			=> 'Link URL',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'Externe Links:<br />Alle Links sollten mit einem http:// eingegeben werden.<br /><br />Interne Links:<br />Geben Sie nur die PHP Datei als Link URL ein, z.B. index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Link Berechtigungen',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Wählen Sie die Gruppen aus die berechtigt sein sollen den Link zu sehen. Falls alle Benutzer den Link sehen sollen, dann wählen Sie nichts aus.<br />Wählen Sie mehrere Gruppen aus/ab indem Sie <samp>STRG</samp> gedrückt halten und klicken.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Öffne externe Verknüpfungen in einem neuen Fenster/Tab',

	// Errors
	'NO_LINK_TITLE'					=> 'Sie müssen einen Titel für diesen Link angeben.',
	'NO_LINK_URL'					=> 'Sie müssen eine Link URL eingeben.',
]);
