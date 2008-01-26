<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
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
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	// General
	'PORTAL'				=> 'Portal',
	'WELCOME'				=> 'Willkommen',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'Letzte Bekanntmachung',
	'LATEST_NEWS'			=> 'Aktuelle Beiträge',
	'READ_FULL'				=> 'alles lesen',
	'NO_NEWS'				=> 'Keine neuen Beiträge',
	'NO_ANNOUNCEMENTS'		=> 'Keine Bekanntmachung',
	'POSTED_BY'				=> 'Autor',
	'COMMENTS'				=> 'Antworten',
	'VIEW_COMMENTS'			=> 'Antworten anzeigen',
	'POST_REPLY'			=> 'Antwort schreiben',
	'TOPIC_VIEWS'			=> 'Zugriffe',
	'JUMP_NEWEST'			=> 'Zum letzten Beitrag springen',
	'JUMP_FIRST'			=> 'Zum ersten Beitrag springen',
	'JUMP_TO_POST'			=> 'Rufe den Beitrag auf',

	// who is online
	'WIO_TOTAL'			=> 'Insgesamt',
	'WIO_REGISTERED'	=> 'Registrierte Benutzer',
	'WIO_HIDDEN'		=> 'Unsichtbare Benutzer',
	'WIO_GUEST'			=> 'Gäste',
	//'RECORD_ONLINE_USERS'=> 'View record: <strong>%1$s</strong><br />%2$s',

	// user menu
	'USER_MENU'			=> 'Benutzer Menü',
	'UM_LOG_ME_IN'		=> 'Mich bei jedem Besuch automatisch anmelden',
	'UM_HIDE_ME'		=> 'Meinen Online-Status während dieser Sitzung verbergen',
	'UM_MAIN_SUBSCRIBED'=> 'Benachrichtigungen verwalten',
	'UM_BOOKMARKS'		=> 'Lesezeichen verwalten',

	// statistics
	'ST_TOP'		=> 'Insgesamt',
	'ST_TOP_ANNS'	=> 'Bekanntmachungen insgesamt',
	'ST_TOP_STICKYS'=> 'Wichtig insgesamt',
	'ST_TOT_ATTACH'	=> 'Dateianhänge insgesamt',

	// search
	'SH'		=> 'Los',
	'SH_SITE'	=> 'Foren',
	'SH_POSTS'	=> 'Beiträge',
	'SH_AUTHOR'	=> 'Autor',
	'SH_ENGINE'	=> 'Suchmaschinen',
	'SH_ADV'	=> 'erweiterte Suche',
	
	// recent
	'RECENT_NEWS'		=> 'Aktuelles',
	'RECENT_TOPIC'		=> 'Aktuelle Themen',
	'RECENT_ANN'		=> 'Aktuelle Bekanntmachungen',
	'RECENT_HOT_TOPIC'	=> 'Beliebte Themen',

	// random member
	'RND_MEMBER'	=> 'Zufälliges Profil',
	'RND_JOIN'		=> 'Registriert',
	'RND_POSTS'		=> 'Beiträge',
	'RND_OCC'		=> 'Tätigkeit',
	'RND_FROM'		=> 'Wohnort',
	'RND_WWW'		=> 'Webseite',

	// top poster
	'TOP_POSTER'	=> 'Die Vielschreiber',
	
	// attachments
	'DOWNLOADS'	=> 'Downloads',

	// links
	'LINKS'	=> 'Links',

	// latest members
	'LATEST_MEMBERS'	=> 'Neue Mitglieder',

	// make donation
	'DONATION' 		=> 'Spenden',
	'DONATION_TEXT' => 'ist eine Webseite ohne jedes Gewinninteresse. Jeder, der dieses Projekt unterstützen möchte, kann dies mit einer kleinen Spende tun, damit die Rechnungen für den Server, die Domain, etc. bezahlt werden können.',
	'PAY_MSG'		=> 'Klicke auf das PayPal Bild, nachdem Du den Betrag, den Du spenden möchtest, aus dem Menü ausgewählt hast.',
	'PAY_ITEM' 		=> 'Freiwillige Foren Spende',

	// main menu
	'M_MENU' 	=> 'Menü',
	'M_CONTENT'	=> 'Inhalt',
	'M_ACP'		=> 'Administrations-Bereich',
	'M_HELP'	=> 'Hilfe',
	'M_BBCODE'	=> 'BBCode-Anleitung',
	'M_TERMS'	=> 'Nutzungsbedingungen',
	'M_PRV'		=> 'Datenschutzrichtlinie',
	'M_SEARCH'	=> 'Suche',

	// link us
	'LINK_US'		=> 'Link zu uns ',
	'LINK_US_TXT'	=> 'Benutze bitte diesen Link zum  <strong>%s</strong>',

	// friends
	'FRIENDS'				=> 'Freunde',
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'Derzeit sind keine Freunde definiert',
	'NO_FRIENDS_OFFLINE'	=> 'Keine Freunde offline',
	'NO_FRIENDS_ONLINE'		=> 'Keine Freunde online',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'Die letzten %s Bot-Besuche',
	
	// wordgraph
	'WORDGRAPH'				=> 'Wordgraph',

	// change style
	'BOARD_STYLE'			=> 'Mein Board-Style',
	'STYLE_CHOOSE'			=> 'Wähle einen Style',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'Keine Administratoren',
	'NO_MODERATORS_P'		=> 'Keine Moderatoren',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'	=> 'Themen pro Tag: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Themen pro Tag: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Beiträge pro Tag: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Beiträge pro Tag: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Benutzer pro Tag: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Benutzer pro Tag: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Themen pro Benutzer: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Themen pro Benutzer: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Beiträge pro Benutzer: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Beiträge pro Benutzer: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Beiträge pro Thema: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Beiträge pro Thema: <strong>0</strong>',

	// other
	'POLL'		=> 'Umfrage',
	'CLOCK'		=> 'Uhr',
	'SPONSOR'	=> 'Sponsoren',
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'Mini_Cal_calendar'		=> 'Kalender',
	'Mini_Cal_add_event'	=> 'Termin eintragen',
	'Mini_Cal_events'		=> 'Kommende Termine',
	'Mini_Cal_no_events'	=> 'Keine',
	'Mini_cal_this_event'	=> 'Ferientermine',
	'View_next_month'		=> 'nächster Monat',
	'View_previous_month'	=> 'voriger Monat',

// uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
// see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
// currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
	'Mini_Cal_date_format'		=> '%b %e',
	'Mini_Cal_date_format_Time'	=> '%H:%i',

// if you change the first day of the week in constants.php, you should change values for the short day names accordingly
// e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Su'; ... $lang['mini_cal']['day'][7] = 'Sa'; 
//      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Mo'; ... $lang['mini_cal']['day'][7] = 'Su'; 
	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Mo',
			'2'	=> 'Di',
			'3'	=> 'Mi',
			'4'	=> 'Do',
			'5'	=> 'Fr',
			'6'	=> 'Sa',
			'7'	=> 'So',
		),

		'month'	=> array(
			'1'	=> 'Jan',
			'2'	=> 'Feb',
			'3'	=> 'Mär',
			'4'	=> 'Apr',
			'5'	=> 'Mai',
			'6'	=> 'Jun',
			'7'	=> 'Jul',
			'8'	=> 'Aug',
			'9'	=> 'Sep',
			'10'=> 'Okt',
			'11'=> 'Nov',
			'12'=> 'Dez',
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
));

?>