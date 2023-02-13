<?php
/**
*
* @package Board3 Portal v2.3 - Attachments
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
	'DOWNLOADS'				=> 'Downloads',
	'NO_ATTACHMENTS'		=> 'Keine Dateianhänge',
	'PORTAL_ATTACHMENTS'	=> 'Dateianhänge-Block',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Einstellungen für Dateianhänge',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'		=> 'Hier können Sie die Einstellungen für Dateianhänge ändern.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Anzahl der anzuzeigenden Dateianhänge',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'						=> '0 bedeutet unbegrenzt',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Dateianhänge Foren',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'					=> 'Die Foren, aus welchen die Dateianhänge angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren ausschließen" auf "Ja" steht, wählen Sie die Foren die Sie ausschließen möchten.<br />Falls "Foren ausschließen" auf "Nein" steht, wählen Sie die Foren aus, aus denen Sie die Dateianhänge sehen möchten.<br />Wählen Sie mehrere Foren aus/ab, indem Sie beim Klicken die <samp>Strg</samp>-Taste gedrückt halten.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Foren ausschließen',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'				=> 'Wählen Sie "Ja" wenn Sie die ausgewählten Foren vom Dateianhänge-Block ausschließen möchten, und "Nein" wenn Sie nur die Dateianhänge der ausgewählten Foren im Dateianhänge-Block sehen möchten.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Maximal angezeigte Länge der Dateianhänge',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'					=> '0 bedeutet unbegrenzt',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Dateitypen',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 					=> 'Falls "Dateitypen ausschließen" auf "Ja" steht, wählen Sie die Dateitypen die Sie ausschließen möchten.<br />Falls "Dateitypen ausschließen" auf "Nein" steht, wählen Sie die Dateitypen die Sie sehen möchten.<br />Wählen Sie mehrere Foren aus/ab, indem Sie beim Klicken die <samp>Strg</samp>-Taste gedrückt halten.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Dateitypen ausschließen',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'					=> 'Wählen Sie "Ja" wenn Sie die ausgewählten Dateitypen vom Dateianhänge-Block ausschließen möchten, und "Nein" wenn Sie nur die ausgewählten Dateitypen im Dateianhänge-Block sehen möchten.',
]);
