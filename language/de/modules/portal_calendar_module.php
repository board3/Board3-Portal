<?php
/**
*
* @package Board3 Portal v2.1 - Calendar
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
	'PORTAL_CALENDAR'		=> 'Kalender',
	'VIEW_NEXT_MONTH'		=> 'nächster Monat',
	'VIEW_PREVIOUS_MONTH'	=> 'voriger Monat',
	'EVENT_START'			=> 'Von',
	'EVENT_END'				=> 'Bis',
	'EVENT_TIME'			=> 'Zeit',
	'EVENT_ALL_DAY'			=> 'Ganztägig',
	'CURRENT_EVENTS'		=> 'Aktuelle Veranstaltungen',
	'NO_CUR_EVENTS'			=> 'Keine aktuellen Veranstaltungen',
	'UPCOMING_EVENTS'		=> 'Bevorstehende Veranstaltungen',
	'NO_UPCOMING_EVENTS'	=> 'Keine bevorstehenden Veranstaltungen',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'So',
			'2'	=> 'Mo',
			'3'	=> 'Di',
			'4'	=> 'Mi',
			'5'	=> 'Do',
			'6'	=> 'Fr',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Jan.',
			'2'	=> 'Feb.',
			'3'	=> 'Mär.',
			'4'	=> 'Apr.',
			'5'	=> 'Mai',
			'6'	=> 'Jun.',
			'7'	=> 'Jul.',
			'8'	=> 'Aug.',
			'9'	=> 'Sep.',
			'10'=> 'Okt.',
			'11'=> 'Nov.',
			'12'=> 'Dez.',
		),

		'long_month'=> array(
			'1'	=> 'Januar',
			'2'	=> 'Februar',
			'3'	=> 'März',
			'4'	=> 'April',
			'5'	=> 'Mai',
			'6'	=> 'Juni',
			'7'	=> 'Juli',
			'8'	=> 'August',
			'9'	=> 'September',
			'10'=> 'Oktober',
			'11'=> 'November',
			'12'=> 'Dezember',
		),
	),

	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Kalender Einstellungen',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Hier kannst du die Einstellungen für den Kalender ändern.',
	'ACP_PORTAL_EVENTS'						=> 'Kalender Veranstaltungen',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Farbe für den aktuellen Tag',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'		=> 'HEX oder Farbennamen sind erlaubt (Englisch!) wie z.B. #FFFFFF für Weiß oder (englische!) Farbennamen wie z.B. violet.',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Farbe für Sonntage',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'		=> 'HEX oder Farbennamen sind erlaubt (Englisch!) wie z.B. #FFFFFF für Weiß oder (englische!) Farbennamen wie z.B. violet.',
	'PORTAL_LONG_MONTH'						=> 'Langen Monatsname anzeigen',
	'PORTAL_LONG_MONTH_EXP'					=> 'Wenn deaktiviert, wird der Monat gekürzt z.B. Aug. statt August.',
	'PORTAL_SUNDAY_FIRST'					=> 'Erster Tag der Woche',
	'PORTAL_SUNDAY_FIRST_EXP'				=> 'Wenn deaktiviert, wird von Mo. --> So. angezeigt, ansonsten So. --> Sa.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Veranstaltungen anzeigen',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Zeige Veranstaltungen an, die im Kalender Block erstellt wurden.',
	'PORTAL_EVENTS_MANAGE'					=> 'Veranstaltungen verwalten',
	'NO_EVENT_TITLE'						=> 'Du hast keinen Titel für die Veranstaltung angegeben.',
	'NO_EVENT_START'						=> 'Du hast keine Start-Zeit für die Veranstaltung angegeben.',
	'ADD_EVENT'								=> 'Veranstaltung hinzufügen',
	'EVENT_UPDATED'							=> 'Veranstaltung erfolgreich aktualisiert.',
	'EVENT_ADDED'							=> 'Veranstaltung erfolgreich hinzugefügt.',
	'NO_EVENT'								=> 'Keine Veranstaltung.',
	'EVENT_TITLE'							=> 'Titel der Veranstaltung',
	'EVENT_DESC'							=> 'Beschreibung',
	'EVENT_LINK'							=> 'Link zur Veranstaltung',
	'EVENT_LINK_EXP'						=> 'Gebe den Link zu einem Thema oder einer Website mit der Ankündigung oder dem Diskussionsthema der Veranstaltung ein.',
	'NO_EVENTS'								=> 'Keine Veranstaltungen',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'Die eingegebene Start-Zeit ist nicht korrekt. Bitte folge genau den Anweisungen.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'Die eingegebene End-Zeit ist nicht korrekt. Bitte folge genau den Anweisungen.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'Die Start-zeit der Veranstaltung muss in der Zukunft liegen.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Start-Datum der Veranstaltung',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Gebe das Datum und Uhrzeit ein, zu der die Veranstaltung beginnt. Datum und Uhrzeit sollten in einem ähnlichen Format sein: TT.MM.JJJJ SS:MM',
	'ACP_PORTAL_EVENT_END_DATE'				=> 'End-Datum der Veranstaltung',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Gebe das Datum und Uhrzeit ein, zu der die Veranstaltung endet. Datum und Uhrzeit sollten in einem ähnlichen Format sein: TT.MM.JJJJ',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'Das Ende der Veranstaltung muss nach dem Beginn der Veranstaltung liegen.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Berechtigungen für die Veranstaltung',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Wähle die Gruppen aus, denen es erlaubt sein soll die Veranstaltung zu sehen. Falls alle Benutzer die Veranstaltung sehen sollen, dann wähle nichts aus.<br />Wähle mehrere Gruppen aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Öffne externe Veranstaltungsverknüpfungen in einem neuen Fenster',

	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Veranstaltung aktualisiert</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Veranstaltung hinzugefügt</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Veranstaltung entfernt</strong><br />&raquo; %s',
));
