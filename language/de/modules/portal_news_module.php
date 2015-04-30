<?php
/**
*
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'Aktuelle Beiträge',
	'READ_FULL'				=> 'alles lesen',
	'NO_NEWS'				=> 'Keine neuen Beiträge',
	'POSTED_BY'				=> 'Autor',
	'COMMENTS'				=> 'Kommentare',
	'VIEW_COMMENTS'			=> 'Kommentare anzeigen',
	'PORTAL_POST_REPLY'		=> 'Kommentar schreiben',
	'TOPIC_VIEWS'			=> 'Zugriffe',
	'JUMP_NEWEST'			=> 'Zum letzten Beitrag springen',
	'JUMP_FIRST'			=> 'Zum ersten Beitrag springen',
	'JUMP_TO_POST'			=> 'Rufe den Beitrag auf',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'				=> 'Aktuelle Beiträge  Einstellungen',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'			=> 'Hier kannst du die Einstellungen für die aktuellen Beiträge ändern.',
	'PORTAL_NEWS_STYLE'						=> 'Kompakter Block-Stil',
	'PORTAL_NEWS_STYLE_EXP'					=> 'Wenn "ja" ausgewählt ist, wird die kompakte Ansicht für die aktuellen Beiträge angezeigt, bei "nein" die Textansicht.',
	'PORTAL_SHOW_ALL_NEWS'					=> 'Zeige alle Beiträge dieses Forums',
	'PORTAL_SHOW_ALL_NEWS_EXP'				=> 'Auch Wichtige Beiträge.',
	'PORTAL_NUMBER_OF_NEWS'					=> 'Anzahl der Beiträge auf dem Portal',
	'PORTAL_NUMBER_OF_NEWS_EXP'				=> '0 bedeutet unbegrenzt',
	'PORTAL_NEWS_LENGTH'					=> 'Maximal angezeigte Länge der Beiträge',
	'PORTAL_NEWS_LENGTH_EXP'				=> '0 bedeutet unbegrenzt',
	'PORTAL_NEWS_FORUM'						=> 'Beiträge Foren',
	'PORTAL_NEWS_FORUM_EXP'					=> 'Die Foren, aus welchen die Beiträge angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren ausschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren ausschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_NEWS_EXCLUDE'					=> 'Foren ausschließen',
	'PORTAL_NEWS_EXCLUDE_EXP'				=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Aktuelle Beiträge-Block ausschließen willst, und "Nein" wenn du nur die Beiträge aus den ausgewählten Foren im Aktuelle Beiträge-Block sehen willst.',
	'PORTAL_NEWS_PERMISSIONS'				=> 'Berechtigungen prüfen anschalten?',
	'PORTAL_NEWS_PERMISSIONS_EXP'			=> 'Berücksichtigt Berechtigungen beim Anzeigen der aktuellen Beiträge',
	'PORTAL_NEWS_SHOW_LAST'					=> 'Nach neuesten Beiträgen sortieren',
	'PORTAL_NEWS_SHOW_LAST_EXP'				=> 'Wenn aktiviert, wird nach den neuesten Beiträgen sortiert. Wenn deaktiviert, wird nach den neuesten Themen sortiert.',
	'PORTAL_NEWS_ARCHIVE'					=> 'Das Archivsystem für die aktuellen Beiträge aktivieren',
	'PORTAL_NEWS_ARCHIVE_EXP'				=> 'Wenn aktiviert, wird das Archivsystem und ggf. Seitenzahlen angezeigt.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> '"Antworten" und "Zugriffe" in Extraspalten',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'			=> 'Einstellung für den kompakter Bekanntmachungen-Block-Stil.<br />Wenn aktiviert, wird die Anzahl der Antworten und Zugriffe in gesonderten Spalten angezeigt. Wenn deaktiviert gibt es nur zwei Spalten und die Antworten und Zugriffe werden neben "Forum" angezeigt. Bei Darstellungsproblemen mit z.B. schmalen Styles bitte deaktivieren.',
));
