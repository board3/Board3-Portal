<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
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
	'PORTAL'					=> 'Portal',
	'WELCOME'					=> 'Willkommen',
	'PORTAL_INSTALL'			=> 'Installations Verzeichnis erkannt',
	'PORTAL_INSTALL_TEXT'		=> 'Eine Installationsdatei wurde erkannt. Wenn Du dein Portal aktualisieren möchtest (oder einen anderen Mod), dann führe den Installer bitte aus. Wenn Du das bereits getan hast, entferne bitte aus Sicherheitsgründen das Verzeichnis oder benenne es um.',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'		=> 'Letzte Bekanntmachung',
	'GLOBAL_ANNOUNCEMENT'		=> 'Globale Bekanntmachung',
	'VIEW_LATEST_ANNOUNCEMENT'   => '1 Bekanntmachung',
	'VIEW_LATEST_ANNOUNCEMENTS'   => '%d Bekanntmachungen',
	'LATEST_NEWS'					=> 'Aktuelle Beiträge',
	'READ_FULL'						=> 'alles lesen',
	'NO_NEWS'						=> 'Keine neuen Beiträge',
	'NO_ANNOUNCEMENTS'			=> 'Keine Bekanntmachung',
	'POSTED_BY'						=> 'Autor',
	'COMMENTS'						=> 'Antworten',
	'VIEW_COMMENTS'				=> 'Antworten anzeigen',
	'PORTAL_POST_REPLY'				=> 'Antwort schreiben',
	'TOPIC_VIEWS'					=> 'Zugriffe',
	'JUMP_NEWEST'					=> 'Zum letzten Beitrag springen',
	'JUMP_FIRST'						=> 'Zum ersten Beitrag springen',
	'JUMP_TO_POST'					=> 'Rufe den Beitrag auf',
	'BACK'								=> 'Zurück',

	// Birthdays
	 'BIRTHDAYS_AHEAD'				=> 'In den nächsten %s Tagen',
	 'NO_BIRTHDAYS_AHEAD'			=> 'In diesem Zeitraum hat kein Mitglied Geburtstag',

	// user menu
	'USER_MENU'					=> 'Benutzer-Menü',
	'UM_LOG_ME_IN'					=> 'Mich bei jedem Besuch automatisch anmelden',
	'UM_HIDE_ME'						=> 'Meinen Online-Status während dieser Sitzung verbergen',
	'UM_MAIN_SUBSCRIBED'			=> 'Benachrichtigungen verwalten',
	'UM_BOOKMARKS'					=> 'Lesezeichen verwalten',

	// statistics
	'ST_TOP'							=> 'Insgesamt',
	'ST_TOP_ANNS'					=> 'Bekanntmachungen insgesamt:',
	'ST_TOP_STICKYS'				=> 'Wichtig insgesamt:',
	'ST_TOT_ATTACH'				=> 'Dateianhänge insgesamt:',

	// search
	'SH'								=> 'Los',
	'SH_SITE'							=> 'Foren',
	'SH_POSTS'						=> 'Beiträge',
	'SH_AUTHOR'						=> 'Autor',
	'SH_ENGINE'						=> 'Suchmaschinen',
	'SH_ADV'							=> 'erweiterte Suche',
	
	// recent
	'RECENT_NEWS'					=> 'Aktuelles',
	'RECENT_TOPIC'					=> 'Aktuelle Themen',
	'RECENT_ANN'						=> 'Aktuelle Bekanntmachungen',
	'RECENT_HOT_TOPIC'				=> 'Beliebte Themen',

	// random member
	'RND_MEMBER'						=> 'Zufälliges Profil',
	'RND_JOIN'							=> 'Registriert',
	'RND_POSTS'						=> 'Beiträge',
	'RND_OCC'							=> 'Tätigkeit',
	'RND_FROM'						=> 'Wohnort',
	'RND_WWW'						=> 'Webseite',

	// top poster
	'TOP_POSTER'						=> 'Die Vielschreiber',
	
	// attachments
	'DOWNLOADS'						=> 'Downloads',
	'NO_ATTACHMENTS'                => 'Keine Dateianhänge',

	// links
	'LINKS'							=> 'Links',
	'NO_LINKS'						=> 'Keine Links vorhanden', 

	// latest members
	'LATEST_MEMBERS'				=> 'Neue Mitglieder',

	// make donation
	'DONATION' 					=> 'PayPal-Spenden',
	'DONATION_TEXT'				=> 'ist eine Webseite ohne jedes Gewinninteresse. Jeder der dieses Projekt unterstützen möchte, kann dies mit einer kleinen PayPal-Spende tun, damit die Rechnungen für den Server, die Domain, etc. bezahlt werden können.',
	'PAY_MSG'					=> 'Betrag bitte mit Punkt statt Komma trennen, z.B. 3.50',
	'PAY_ITEM' 					=> 'Freiwillige Foren-Spende',

	'AUD'						=> 'Australische Dollar (AUD)',
	'CAD'						=> 'Kanadische Dollar (CAD)',
	'CZK'						=> 'Tschechische Kronen (CZK)',
	'DKK'						=> 'Dänische Kronen (DKK)',
	'HKD'						=> 'Hongkong-Dollar (HKD)',
	'HUF'						=> 'Ungarische Forint (HUF)',
	'NZD'						=> 'Neuseeland-Dollar (NZD)',
	'NOK'						=> 'Norwegische Kronen (NOK)',
	'PLN'						=> 'Polnische Zloty (PLN)',
	'GBP'						=> 'Britische Pfund (GBP)',
	'SGD'						=> 'Singapur-Dollar (SGD)',
	'SEK'						=> 'Schwedische Kronen (SEK)',
	'CHF'						=> 'Schweizer Franken (CHF)',
	'JPY'						=> 'Japanische Yen (JPY)',
	'USD'						=> 'US-Dollar (USD)',
	'EUR'						=> 'Euro (EUR)',
	'MXN'						=> 'Mexikanische Pesos (MXN)',
	'ILS'						=> 'Neue Israelische Schekel (ILS)',

	// main menu
	'M_MENU' 							=> 'Menü',
	'M_CONTENT'						=> 'Inhalt',
	'M_ACP'							=> 'Administrations-Bereich',
	'M_HELP'							=> 'Hilfe',
	'M_BBCODE'						=> 'BBCode-Anleitung',
	'M_TERMS'							=> 'Nutzungsbedingungen',
	'M_PRV'							=> 'Datenschutzrichtlinie',
	'M_SEARCH'						=> 'Suche',

	// link us
	'LINK_US'							=> 'Link zu uns ',
	'LINK_US_TXT'					=> 'Benutze bitte diesen Link um <strong>%s</strong> bei dir zu verlinken:',

	// friends
	'FRIENDS'							=> 'Freunde',
	'FRIENDS_OFFLINE'				=> 'Offline',
	'FRIENDS_ONLINE'					=> 'Online',
	'NO_FRIENDS'						=> 'Derzeit sind keine Freunde definiert',
	'NO_FRIENDS_OFFLINE'			=> 'Keine Freunde offline',
	'NO_FRIENDS_ONLINE'			=> 'Keine Freunde online',
	
	// last bots
	'LAST_VISITED_BOTS'			=> 'Die letzten %s Bots',
	
	// wordgraph
	'WORDGRAPH'						=> 'Wordgraph',

	// change style
	'BOARD_STYLE'					=> 'Mein Board-Style',
	'STYLE_CHOOSE'					=> 'Wähle einen Style',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'Keine Administratoren',
	'NO_MODERATORS_P'		=> 'Keine Moderatoren',
	'NO_GROUPS_P'			=> 'Keine Gruppen',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'		=> 'Themen pro Tag: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'			=> 'Themen pro Tag: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'		=> 'Beiträge pro Tag: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'			=> 'Beiträge pro Tag: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'		=> 'Benutzer pro Tag: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'			=> 'Benutzer pro Tag: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'		=> 'Themen pro Benutzer: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'		=> 'Themen pro Benutzer: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'		=> 'Beiträge pro Benutzer: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'		=> 'Beiträge pro Benutzer: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'		=> 'Beiträge pro Thema: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'		=> 'Beiträge pro Thema: <strong>0</strong>',

	// Poll
	'POLL'		=> 'Umfrage',
	'LATEST_POLLS'					=> 'Neueste Umfragen',
	'NO_OPTIONS'						=> 'Diese Umfrage verfügt über keine Optionen.',
	'NO_POLL'							=> 'Derzeit gibt es keine aktuellen Umfragen',
	'RETURN_PORTAL'					=> '%sZurück zum Portal%s',

	// other
	'VIEWING_PORTAL'         => 'Betrachtet das Portal',
	'CLOCK'		=> 'Uhr',
	'SPONSOR'	=> 'Sponsoren',
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'					=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'MINI_CALENDAR'					=> 'Kalender',
	'VIEW_NEXT_MONTH'				=> 'nächster Monat',
	'VIEW_PREVIOUS_MONTH'			=> 'voriger Monat',

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
));

?>