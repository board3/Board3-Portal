<?php
/**
*
* @package Board3 Portal v2.1 - Announcements
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
	'LATEST_ANNOUNCEMENTS'			=> 'Letzte Bekanntmachung',
	'GLOBAL_ANNOUNCEMENTS'			=> 'Global Bekanntmachungen',
	'GLOBAL_ANNOUNCEMENT'			=> 'Globale Bekanntmachung',
	'VIEW_LATEST_ANNOUNCEMENT' 		=> '1 Bekanntmachung',
	'VIEW_LATEST_ANNOUNCEMENTS'	 	=> '%d Bekanntmachungen',
	'READ_FULL'						=> 'alles lesen',
	'NO_ANNOUNCEMENTS'				=> 'Keine Bekanntmachung',
	'POSTED_BY'						=> 'Autor',
	'COMMENTS'						=> 'Kommentare',
	'VIEW_COMMENTS'					=> 'Kommentare anzeigen',
	'PORTAL_POST_REPLY'				=> 'Kommentar schreiben',
	'TOPIC_VIEWS'					=> 'Zugriffe',
	'JUMP_NEWEST'					=> 'Zum letzten Beitrag springen',
	'JUMP_FIRST'					=> 'Zum ersten Beitrag springen',
	'JUMP_TO_POST'					=> 'Rufe den Beitrag auf',

	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Einstellungen für Bekanntmachungen',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'Hier kannst du die Einstellungen für die Bekanntmachungen ändern.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Bekanntmachungen anzeigen',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Kompakter Bekanntmachungen-Block-Stil',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> 'Wenn "ja" ausgewählt ist, wird die kompakte Ansicht für die Bekanntmachungen angezeigt, bei "nein" die große Ansicht.',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Anzahl der Bekanntmachungen auf dem Portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> '0 bedeutet unbegrenzt',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Die Anzahl der Tage, während der die Bekanntmachung angezeigt werden soll',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> '0 bedeutet unbegrenzt',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maximale Länge der Bekanntmachungen',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> '0 bedeutet unbegrenzt',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Foren der Bekanntmachungen',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Die ID des Forums, aus welchem die Bekanntmachungen angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren ausschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren ausschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Foren ausschließen',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Bekanntmachungen-Block ausschließen willst, und "Nein" wenn du nur die Bekanntmachungen aus den ausgewählten Foren im Bekanntmachungen-Block sehen willst.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Berechtigungen prüfen anschalten?',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'Berücksichtigt Berechtigungen beim Anzeigen der Bekanntmachungen',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Das Archivsystem für die Bekanntmachungen aktivieren',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'Wenn aktiviert, wird das Archivsystem und ggf. Seitenzahlen angezeigt.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> '"Antworten" und "Zugriffe" in Extraspalten',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Einstellung für den kompakter Bekanntmachungen-Block-Stil.<br />Wenn aktiviert, wird die Anzahl der Antworten und Zugriffe in gesonderten Spalten angezeigt. Wenn deaktiviert gibt es nur zwei Spalten und die Antworten und Zugriffe werden neben "Forum" angezeigt. Bei Darstellungsproblemen mit z.B. schmalen Styles bitte deaktivieren.',
));
