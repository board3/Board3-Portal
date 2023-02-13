<?php
/**
*
* @package Board3 Portal v2.3 - Recent Module
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
	'PORTAL_RECENT'				=> 'Aktuelles',
	'PORTAL_RECENT_TOPIC'		=> 'Aktuelle Themen',
	'PORTAL_RECENT_ANN'			=> 'Aktuelle Bekanntmachungen',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Beliebte Themen',

	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'				=> 'Einstellungen für neueste Themen',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'			=> 'Hier können Sie die Einstellungen für die neuesten Themen ändern.',
	'PORTAL_MAX_TOPIC'							=> 'Anzahl der neuesten Themen auf dem Portal',
	'PORTAL_MAX_TOPIC_EXP'						=> '0 bedeutet unbegrenzt',
	'PORTAL_RECENT_TITLE_LIMIT'					=> 'Maximal angezeigte Länge der neuesten Themen',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'				=> '0 bedeutet unbegrenzt',
	'PORTAL_RECENT_FORUM'						=> 'Themen Foren',
	'PORTAL_RECENT_FORUM_EXP'					=> 'Die Foren, aus welchen die Themen angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren ausschließen" auf "Ja" steht, wählen Sie die Foren die Sie ausschließen möchten.<br />Falls "Foren ausschließen" auf "Nein" steht, wählen Sie die Foren die Sie sehen möchten.<br />Wählen Sie mehrere Foren aus/ab, indem Sie beim Klicken die <samp>Strg</samp>-Taste gedrückt halten.',
	'PORTAL_EXCLUDE_FORUM'						=> 'Foren ausschließen',
	'PORTAL_EXCLUDE_FORUM_EXP'					=> 'Wählen Sie "Ja" wenn Sie die ausgewählten Foren vom Aktuelle Themen-Block ausschließen möchten, und "Nein" wenn Sie nur die Themen aus den ausgewählten Foren im Aktuelle Themen-Block sehen möchten.',
]);
