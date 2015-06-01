<?php
/**
*
* @package Board3 Portal v2.1 - Calendar
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Estonian translation by phpBBeesti.com (http://www.phpbbeesti.com/)
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
	'PORTAL_CALENDAR'			=> 'Kalender',
	'VIEW_NEXT_MONTH'		=> 'järgmine kuu',
	'VIEW_PREVIOUS_MONTH'	=> 'Eelmine kuu',
	'EVENT_START'			=> 'Alates',
	'EVENT_END'				=> 'Kuni',
	'EVENT_TIME'			=> 'Aeg',
	'EVENT_ALL_DAY'			=> 'Kõik päeva sündmused',
	'CURRENT_EVENTS'		=> 'Hetke sündmused',
	'NO_CUR_EVENTS'			=> 'Hetkel sündmusi pole',
	'UPCOMING_EVENTS'		=> 'Tulevased sündmused',
	'NO_UPCOMING_EVENTS'	=> 'Hetkel tulevasi sündmusi pole',
	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'P',
			'2'	=> 'E',
			'3'	=> 'T',
			'4'	=> 'K',
			'5'	=> 'N',
			'6'	=> 'R',
			'7'	=> 'L',
		),
		'month'	=> array(
			'1'	=> 'Jaan.',
			'2'	=> 'Veeb.',
			'3'	=> 'Mär.',
			'4'	=> 'Apr.',
			'5'	=> 'Mai',
			'6'	=> 'Juun.',
			'7'	=> 'Juul.',
			'8'	=> 'Aug.',
			'9'	=> 'Sept.',
			'10'=> 'Okt.',
			'11'=> 'Nov.',
			'12'=> 'Dets.',
		),
		'long_month'=> array(
			'1'	=> 'Jaanuar',
			'2'	=> 'Veebruar',
			'3'	=> 'Märts',
			'4'	=> 'Aprill',
			'5'	=> 'Mai',
			'6'	=> 'Juuni',
			'7'	=> 'Juuli',
			'8'	=> 'August',
			'9'	=> 'September',
			'10'=> 'Oktoober',
			'11'=> 'November',
			'12'=> 'Detsember',
		),
	),
	// ACP => AJP
	'ACP_PORTAL_CALENDAR'					=> 'Kalendri seaded',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Siin on sul võimalik kohandada kalendri plokki foorumi portaalile.',
	'ACP_PORTAL_EVENTS'						=> 'Kalendri sündmused',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Aktiivse päeva värv',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'	=> 'HEX või värvi nimetus on lubatud, näiteks #FFFFFF valge jaoks või värvinimi nagu "violet".',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Värv pühapäeva jaoks',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'	=> 'HEX või värvi nimetus on lubatud, näiteks #FFFFFF valge jaoks või värvinimi nagu "violet".',
	'PORTAL_LONG_MONTH'						=> 'Näita kuude täielikku nimetust',
	'PORTAL_LONG_MONTH_EXP'				=> 'Kui keelatud, siis kuud lühendatakse, näiteks "Juuni" asemel on "juun." jne.',
	'PORTAL_SUNDAY_FIRST'					=> 'Nädala esimene päev',
	'PORTAL_SUNDAY_FIRST_EXP'			=> 'Kui keelatud, siis kalendris näidatakse E. --> P, muidu aga P. --> L.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Näita sündmusi',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Näita sündmusi, mis on loodud kalendrisse',
	'PORTAL_EVENTS_MANAGE'					=> 'Halda sündmusi',
	'NO_EVENT_TITLE'						=> 'Sa ei ole sisestanud sündmuse pealkirja.',
	'NO_EVENT_START'						=> 'Sa ei ole sisestanud sündmuse alguse aega.',
	'ADD_EVENT'								=> 'Lisa uus sündmus',
	'EVENT_UPDATED'							=> 'Sündmus uuendatud.',
	'EVENT_ADDED'							=> 'Sündmus lisatud.',
	'NO_EVENT'								=> 'Pole sündmusi.',
	'EVENT_TITLE'							=> 'Sündmuse pealkiri',
	'EVENT_DESC'							=> 'Sündmse kirjeldus',
	'EVENT_LINK'							=> 'Sündmuse link',
	'EVENT_LINK_EXP'						=> 'Sisesta link teemasse või veebilehele, sündmuse teadandele või arutlemiseks.',
	'NO_EVENTS'								=> 'Pole sündmusi',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'Alguse aeg, mille sisestasid on vigane. Palun järgi juhiseid hoolikalt.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'Lõppu aeg, mille sisestasid on vigane. Palun järgi juhiseid hoolikalt.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'Sündmuse algus aeg peab olema tulevikus.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Sündmuse algus aeg',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Sisesta kuupäev ja kellaaeg, millal sündmus algab. Kuupäev / kellaaeg peab olema umbes sellises formaadis: MM/DD/YYYY 3:00 PM',
	'ACP_PORTAL_EVENT_END_DATE'			=> 'Sündmuse lõppu aeg',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Sisesta kuupäev ja kellaaeg, millal sündmus lõpeb. Kuupäev / kellaaeg peab olema umbes sellises formaadis: MM/DD/YYYY 3:00 PM',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'Sündmuse lõppu aeg peab olema hilisem, kui selle algus aeg.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Sündmuse õigused',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Vali grupid, kellel on õigused vaadata seda sündmust. Kui sa soovid, et KÕIK kasutajad saaksid vaadata seda sündmust, siis ära vali mitte midagi.<br />Vali/Valik maha mitmelt grupilt korraga, hoides klaviatuuril klahvi <samp>CTRL</samp> ja klikides hiirt.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Ava sündmus uues aknas',
	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Sündmus uuendatud</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Sündmus lisatud</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Sündmus eemaldatud</strong><br />&raquo; %s',
));
