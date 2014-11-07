<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
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
	'VIEW_NEXT_MONTH'		=> 'Volgende maand',
	'VIEW_PREVIOUS_MONTH'	=> 'Vorige maand',
	'EVENT_START'			=> 'Van',
	'EVENT_END'				=> 'Tot',
	'EVENT_TIME'			=> 'Tijd',
	'EVENT_ALL_DAY'			=> 'De hele dag',
	'CURRENT_EVENTS'		=> 'Huidige evenementen ',
	'NO_CUR_EVENTS'			=> 'Geen huidige evenementen ',
	'UPCOMING_EVENTS'		=> 'Aankomende evenementen ',
	'NO_UPCOMING_EVENTS'	=> 'Geen aankomende evenementen ',
	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Zo',
			'2'	=> 'Ma',
			'3'	=> 'Di',
			'4'	=> 'Wo',
			'5'	=> 'Do',
			'6'	=> 'Vr',
			'7'	=> 'Za',
		),
		'month'	=> array(
			'1'	=> 'Jan.',
			'2'	=> 'Feb.',
			'3'	=> 'Mar.',
			'4'	=> 'Apr.',
			'5'	=> 'Mei.',
			'6'	=> 'Jun.',
			'7'	=> 'Jul.',
			'8'	=> 'Aug.',
			'9'	=> 'Sep.',
			'10'=> 'Okt.',
			'11'=> 'Nov.',
			'12'=> 'Dec.',
		),
		'long_month'=> array(
			'1'	=> 'Januari',
			'2'	=> 'Februari',
			'3'	=> 'Maart',
			'4'	=> 'April',
			'5'	=> 'Mei',
			'6'	=> 'Juni',
			'7'	=> 'Juli',
			'8'	=> 'Augustus',
			'9'	=> 'September',
			'10'=> 'Oktober',
			'11'=> 'November',
			'12'=> 'December',
		),
	),
	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Kalender instellingen',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Hier kan je het Kalanderblok aanpassen.',
	'ACP_PORTAL_EVENTS'						=> 'Kalender evenementen',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Kleur voor de huidige dag',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'		=> 'HEX of kleurnamen zijn toegestaan, zoals #FFFFFF voor wit, of kleurnamen in het engels zoals violet.',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Kleur voor zondag',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'		=> 'HEX of kleurnamen zijn toegestaan, zoals #FFFFFF voor wit, of kleurnamen in het engels zoals violet.',
	'PORTAL_LONG_MONTH'						=> 'Laat volledige maand naam zien',
	'PORTAL_LONG_MONTH_EXP'					=> 'Als deze functie is uitgeschakeld wordt de maand verkort bijv: Aug. in plaats van Augustus.',
	'PORTAL_SUNDAY_FIRST'					=> 'Eerste dag van de week',
	'PORTAL_SUNDAY_FIRST_EXP'				=> 'Als deze functie is uitgeschakeld begint de week met, Ma. --> Zo., anders Zo. --> Za.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Laat evenementen zien',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Laat evenementen zien die zijn aangemaakt in het kalenderblok',
	'PORTAL_EVENTS_MANAGE'					=> 'Beheer evenementen',
	'NO_EVENT_TITLE'						=> 'Je hebt geen titel voor dit evenement opgegeven.',
	'NO_EVENT_START'						=> 'Je hebt geen startdatum voor dit evenement opgegeven.',
	'ADD_EVENT'								=> 'Voeg een nieuw evenement toe',
	'EVENT_UPDATED'							=> 'Evenement succesvol gewijzigd.',
	'EVENT_ADDED'							=> 'Evenement succesvol toegevoegd.',
	'NO_EVENT'								=> 'Geen evenement gespecificeerd .',
	'EVENT_TITLE'							=> 'Evenementtitel',
	'EVENT_DESC'							=> 'Evenementomschrijving',
	'EVENT_LINK'							=> 'Evenementlink',
	'EVENT_LINK_EXP'						=> 'Plaats hier een link naar het onderwerp of de website, met de aankondiging of discussieonderwerp van dit evenement.',
	'NO_EVENTS'								=> 'Geen evenementen',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'De startdatum die je hebt opgegeven was incorrect. Volg de instructies nauwkeurig.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'De einddatum die je hebt opgegeven was incorrect. Volg de instructies nauwkeurig.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'De startdatum van het evenement moet in de toekomst zijn.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Begindatum evenement',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Vul de datum en tijd in wanneer het evenement begint. De datum moet in een soortgelijke vorm: MM/DD/JJJJ 3:00 PM',
	'ACP_PORTAL_EVENT_END_DATE'				=> 'Einddatum evenement',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Vul de datum en tijd in wanneer het evenement eindigt. De datum moet in een soortgelijke vorm: MM/DD/JJJJ 3:00 PM',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'Het einde van het evenement moet na de start van het evenement zijn.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Evenementpermissies',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Selecteer de groepen die dit evenement mogen zien. Als je wilt dat alle gebruikers dit evenement mogen zien, selecteer dan niks.<br />>Selecteer/Deselecteer meerdere groepen door middel van <samp>CTRL</samp> en door te klikken.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Open externe evenementlinks in een nieuw venster',
	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Evenement gewijzigd</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Evenement toegevoegd</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Evenement verwijderd</strong><br />&raquo; %s',
));
