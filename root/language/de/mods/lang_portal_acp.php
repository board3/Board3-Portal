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
	// general
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portal Administration',
	'ACP_PORTAL_GENERAL_TITLE_EXPLAIN'		=> 'Danke, dass du dich für board3 Portal entschieden hast. Auf dieser Seite kannst du dein Portal verwalten. Diese Anzeige gibt dir einen schnellen Überblick über die verschiedenen Portal-Einstellungen. Die Links auf der linken Seite dieser Anzeige ermöglichen dir alle Einstellungen vorzunehmen, welche das Portal betreffen.',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'Allgemeine Einstellungen',
	'PORTAL_ENABLE'							=> 'Portal aktivieren',
	'PORTAL_ENABLE_EXPLAIN'					=> 'Wenn deaktiviert, wird das komplette Portal abgeschaltet.',
	'PORTAL_LEFT_COLUMN'					=> 'Linke Spalte aktivieren',
	'PORTAL_LEFT_COLUMN_EXPLAIN'			=> 'Die Linke Spalte auf dem Portal anzeigen',
	'PORTAL_RIGHT_COLUMN'					=> 'Rechte Spalte aktivieren',
	'PORTAL_RIGHT_COLUMN_EXPLAIN'			=> 'Die Rechte Spalte auf dem Portal anzeigen',
	'PORTAL_VERSION_CHECK'					=> 'Versioncheck auf Portal',
	'PORTAL_ADVANCED_STAT'					=> 'Erweiterte Statistik',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_LEADERS'						=> 'Team',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_LEADERS_EXT'					=> 'Erweiterter Team-Block',
	'PORTAL_LEADERS_EXT_EXPLAIN'            => 'Damit dieser Block angezeigt wird, muss der Standard-Team-Block aktiviert sein.<br />Der erweiterte Team-Block listet zusätzlich alle nicht-versteckten Gruppen inklusive Legende auf.',
	'PORTAL_CLOCK'							=> 'Uhr',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Die Uhr auf dem Portal anzeigen.',
	'PORTAL_LINK_US'						=> 'Verlink uns',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_SEARCH'							=> 'Suche',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_WELCOME'						=> 'Willkommen',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_WHOIS_ONLINE'					=> 'Wer ist online?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'			=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_CHANGE_STYLE'					=> 'Style-Umschalter',
	'PORTAL_CHANGE_STYLE_EXPLAIN'			=> 'Diesen Block auf dem Portal anzeigen.<br /><span style="color:red">Achtung:</span> wenn in den Board-Einstellungen "Benutzer-Style überschreiben:" auf "ja" gesetzt ist, wird dieser Block unabhängig von seinen Einstellungen <strong>nicht angezeigt</strong>.',
	'PORTAL_MAIN_MENU'						=> 'Hauptmenü',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_PHPBB_MENU'						=> 'phpBB-Menü',
	'PORTAL_PHPBB_MENU_EXPLAIN'				=> 'Den phpBB Header auf dem Portal anzeigen.',
	'PORTAL_USER_MENU'						=> 'Benutzer-Menü / Login Box',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_FORUM_INDEX'					=> 'Foren Index (Foren Liste)',
	'PORTAL_FORUM_INDEX_EXPLAIN'			=> 'Diesen Block auf dem Portal anzeigen.',
	
	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Zufälliges Profil',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Diesen Block auf dem Portal anzeigen.',

	// news and announcements
	'PORTAL_SHOW_REPLIES_VIEWS'				=> '"Antworten" und "Zugriffe" in Extraspalten',
	'PORTAL_SHOW_REPLIES_VIEWS_EXPLAIN'		=> 'Einstellung für den kompakter Bekanntmachungen-Block-Stil.<br />Wenn aktiviert, wird die Anzahl der Antworten und Zugriffe in gesonderten Spalten angezeigt. Wenn deaktiviert gibt es nur zwei Spalten und die Antworten und Zugriffe werden neben "Forum" angezeigt. Bei Darstellungsproblemen mit z.B. schmalen Styles bitte deaktivieren.', 
	
	// birthdays
	'ACP_PORTAL_BIRTHDAYS_SETTINGS'			=> 'Einstellungen für den Geburtstage-Block',
	'ACP_PORTAL_BIRTHDAYS_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für den Geburtstage-Block ändern.',
	'PORTAL_BIRTHDAYS'						=> 'Geburtstage',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Anstehende Geburtstage',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'Zeitraum für die Geburtstagsvorschau (Tage)',	
	
	// announcements
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Einstellungen für Bekanntmachungen',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für die Bekanntmachungen ändern.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Bekanntmachungen anzeigen',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Kompakter Bekanntmachungen-Block-Stil',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> 'Wenn "ja" ausgewählt ist, wird die kompakte Ansicht für die Bekanntmachungen angezeigt, bei "nein" die große Ansicht.',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Anzahl der Bekanntmachungen auf dem Portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 bedeutet unbegrenzt',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Die Anzahl der Tage, während der die Bekanntmachung angezeigt werden soll',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 bedeutet unbegrenzt',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maximale Länge der Bekanntmachungen',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 bedeutet unbegrenzt',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Foren der Bekanntmachungen',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Die ID des Forums, aus welchem die Bekanntmachungen angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren aussschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren aussschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Foren aussschließen',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXPLAIN'=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Bekanntmachungen-Block ausschließen willst, und "Nein" wenn du nur die Bekanntmachungen aus den ausgewählten Foren im Bekanntmachungen-Block sehen willst.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Berechtigungen prüfen anschalten?',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXPLAIN'	=> 'Berücksichtigt Berechtigungen beim Anzeigen der Bekanntmachungen',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Das Archivsystem für die Bekanntmachungen aktivieren',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXPLAIN'		=> 'Wenn aktiviert, wird das Archivsystem und ggf. Seitenzahlen angezeigt.',

	// news
	'ACP_PORTAL_NEWS_SETTINGS'					=> 'Aktuelle Beiträge  Einstellungen',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'			=> 'Hier kannst du die Einstellungen für die aktuellen Beiträge ändern.',
	'PORTAL_NEWS'								=> 'Aktuelle Beiträge anzeigen',
	'PORTAL_NEWS_EXPLAIN'						=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_NEWS_STYLE'							=> 'Kompakter Block-Stil',
	'PORTAL_NEWS_STYLE_EXPLAIN'					=> 'Wenn "ja" ausgewählt ist, wird die kompakte Ansicht für die aktuellen Beiträge angezeigt, bei "nein" die Textansicht.',
	'PORTAL_SHOW_ALL_NEWS'						=> 'Zeige alle Beiträge dieses Forums',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'				=> 'Auch Wichtige Beiträge.',
	'PORTAL_NUMBER_OF_NEWS'						=> 'Anzahl der Beiträge auf dem Portal',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'				=> '0 bedeutet unbegrenzt',
	'PORTAL_NEWS_LENGTH'						=> 'Maximal angezeigte Länge der Beiträge',
	'PORTAL_NEWS_LENGTH_EXPLAIN'				=> '0 bedeutet unbegrenzt',
	'PORTAL_NEWS_FORUM'							=> 'Beiträge Foren',
	'PORTAL_NEWS_FORUM_EXPLAIN'					=> 'Die Foren, aus welchen die Beiträge angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren aussschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren aussschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_NEWS_EXCLUDE'						=> 'Foren aussschließen',
	'PORTAL_NEWS_EXCLUDE_EXPLAIN'				=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Aktuelle Beiträge-Block ausschließen willst, und "Nein" wenn du nur die Beiträge aus den ausgewählten Foren im Aktuelle Beiträge-Block sehen willst.',
	'PORTAL_NEWS_PERMISSIONS'					=> 'Berechtigungen prüfen anschalten?',
	'PORTAL_NEWS_PERMISSIONS_EXPLAIN'			=> 'Berücksichtigt Berechtigungen beim Anzeigen der aktuellen Beiträge',
	'PORTAL_NEWS_SHOW_LAST'						=> 'Nach neuesten Beiträgen sortieren',
	'PORTAL_NEWS_SHOW_LAST_EXPLAIN'				=> 'Wenn aktiviert, wird nach den neuesten Beiträgen sortiert. Wenn deaktiviert, wird nach den neuesten Themen sortiert.',
	'PORTAL_NEWS_ARCHIVE'						=> 'Das Archivsystem für die aktuellen Beiträge aktivieren',
	'PORTAL_NEWS_ARCHIVE_EXPLAIN'				=> 'Wenn aktiviert, wird das Archivsystem und ggf. Seitenzahlen angezeigt.',

	// recent topics
	'ACP_PORTAL_RECENT_SETTINGS'				=> 'Einstellungen für neueste Themen',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für die neuesten Themen ändern.',
	'PORTAL_RECENT'								=> 'Aktuell-Block anzeigen',
	'PORTAL_RECENT_EXPLAIN'						=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_MAX_TOPIC'							=> 'Anzahl der neuesten Themen auf dem Portal',
	'PORTAL_MAX_TOPIC_EXPLAIN'					=> '0 bedeutet unbegrenzt',
	'PORTAL_RECENT_TITLE_LIMIT'					=> 'Maximal angezeigte Länge der neuesten Themen',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'			=> '0 bedeutet unbegrenzt',
	'PORTAL_RECENT_FORUM'						=> 'Themen Foren',
	'PORTAL_RECENT_FORUM_EXPLAIN'				=> 'Die Foren, aus welchen die Themen angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren aussschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren aussschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_EXCLUDE_FORUM'						=> 'Foren aussschließen',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'				=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Aktuelle Themen-Block ausschließen willst, und "Nein" wenn du nur die Themen aus den ausgewählten Foren im Aktuelle Themen-Block sehen willst.',

	// paypal
	'ACP_PORTAL_PAYPAL_SETTINGS'				=> 'Paypal Einstellungen',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Paypal Einstellungen ändern.',
	'PORTAL_PAY_C_BLOCK'						=> 'Normalen Paypal-Block anzeigen',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_PAY_S_BLOCK'						=> 'Paypal als kleinen Block anzeigen',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_PAY_ACC'							=> 'Paypal Account',
	'PORTAL_PAY_ACC_EXPLAIN'					=> 'Gib deine e-mail-Adresse an, die du bei Paypal benutzt, z.B. xxx@xxx.com',

	// last member
	'ACP_PORTAL_MEMBERS_SETTINGS'				=> 'Einstellungen für neue Mitglieder',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für neue Mitglieder ändern.',
	'PORTAL_LATEST_MEMBERS'						=> 'Neue Mitglieder-Block anzeigen',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_MAX_LAST_MEMBER'					=> 'Anzahl der anzuzeigenden Mitglieder',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'			=> '0 bedeutet unbegrenzt',

	// bots
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Einstellungen für Bot-Besuche',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'Hier kannst du die Einstellungen für Bot-Besuche ändern.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Bot-Block anzeigen',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Anzahl der anzuzeigenden Bots',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 bedeutet unbegrenzt',

	// polls   
	'ACP_PORTAL_POLLS_SETTINGS'					=> 'Einstellungen für Umfragen',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'			=> 'Hier kannst du die Einstellungen für Umfragen ändern.',
	'PORTAL_POLL_TOPIC'							=> 'Umfragen-Block anzeigen',
	'PORTAL_POLL_TOPIC_EXPLAIN'					=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_POLL_TOPIC_ID'						=> 'Umfragen Foren',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'				=> 'Die Foren, aus welchen die Umfragen angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren aussschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren aussschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_POLL_EXCLUDE_ID'					=> 'Foren ausschließen',
	'PORTAL_POLL_EXCLUDE_ID_EXPLAIN'			=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Umfragen-Block ausschließen willst, und "Nein" wenn du nur die Themen aus den ausgewählten Foren im Umfragen-Block sehen willst.',
	'PORTAL_POLL_LIMIT'							=> 'Maximale Anzahl der Umfragen',
	'PORTAL_POLL_LIMIT_EXPLAIN'					=> 'Die Anzahl der Umfragen, die auf dem Portal angezeigt werden sollen.',
	'PORTAL_POLL_ALLOW_VOTE'					=> 'Abstimmen erlauben',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'			=> 'Verfügt der Benutzer über entsprechende Berechtigungen, kann er direkt auf der Portal-Seite abstimmen.',
	'PORTAL_POLL_HIDE'							=> 'Abgelaufene Umfragen verbergen?',
	
	// most poster
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'Einstellungen für die Vielschreiber',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für die Vielschreiber ändern.',
	'PORTAL_TOP_POSTERS'				  		=> 'Vielschreiber-Block anzeigen',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_MAX_MOST_POSTER'					=> 'Anzahl der anzuzeigenden Vielschreiber',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 bedeutet unbegrenzt',

	// left and right column width 
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'			=> 'Breiteneinstellung der rechten und linken Spalte',
	'PORTAL_LEFT_COLUMN_WIDTH'					=> 'Breite der linken Spalte',
	'PORTAL_LEFT_COLUMN_WIDTH_EXPLAIN'			=> 'Ändere hier die Breite der linken Spalte in Pixel, empfohlener Wert 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'					=> 'Breite der rechten Spalte',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXPLAIN'			=> 'Ändere hier die Breite der rechten Spalte in Pixel, empfohlener Wert 180',

	// attachments	
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Einstellungen für Dateianhänge',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für Dateianhänge ändern.',
	'PORTAL_ATTACHMENTS'				  				=> 'Dateianhänge-Block anzeigen',
	'PORTAL_ATTACHMENTS_EXPLAIN'				  		=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Anzahl der anzuzeigenden Dateianhänge',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 bedeutet unbegrenzt',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Dateianhänge Foren',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'				=> 'Die Foren, aus welchen die Dateianhänge angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren aussschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren aussschließen" auf "Nein" steht, wähle die Foren aus, aus denen du die Dateianhänge sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Foren aussschließen',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXPLAIN'			=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Dateianhänge-Block ausschließen willst, und "Nein" wenn du nur die Dateianhänge der ausgewählten Foren im Dateianhänge-Block sehen willst.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Maximal angezeigte Länge der Dateianhänge',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXPLAIN'				=> '0 bedeutet unbegrenzt',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Dateitypen',
	'PORTAL_ATTACHMENTS_FILETYPE_EXPLAIN' 				=> 'Falls "Dateitypen ausschließen" auf "Ja" steht, wähle die Dateitypen die du ausschließen willst.<br />Falls "Dateitypen ausschließen" auf "Nein" steht, wähle die Dateitypen die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Dateitypen aussschließen',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXPLAIN'				=> 'Wähle "Ja" wenn du die ausgewählten Dateitypen vom Dateianhänge-Block ausschließen willst, und "Nein" wenn du nur die ausgewählten Dateitypen im Dateianhänge-Block sehen willst.',

	// friends
	'ACP_PORTAL_FRIENDS_SETTINGS'				=> 'Einstellungen für den Freunde-Block',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für den Freunde-Block ändern.',
	'PORTAL_FRIENDS'							=> 'Freunde-Block',
	'PORTAL_FRIENDS_EXPLAIN'					=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_MAX_ONLINE_FRIENDS'					=> 'Limitierung der Anzeige Freunde online',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'			=> 'Limitiert die Anzeige Freunde online auf den angegebenen Wert.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_SETTINGS'				=> 'Wordgraph Einstellungen',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für den Wordgraph ändern.',
	'PORTAL_WORDGRAPH'							=> 'Wordgraph-Block anzeigen',
	'PORTAL_WORDGRAPH_EXPLAIN'					=> 'Diesen Block auf dem Portal anzeigen.<br /><b>Achtung: läuft nicht, wenn "Fulltext MySQL" im Such-Backend ausgewählt wurde!</b>',
	'PORTAL_WORDGRAPH_MAX_WORDS'				=> 'Anzahl der anzuzeigenden Wörter',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'		=> '0 bedeutet unbegrenzt',
	'PORTAL_WORDGRAPH_WORD_COUNTS'				=> 'Anzeigen wie häufig das Wort vorkommmt',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'		=> 'Zeigt pro Wort an, wie häufig es verwendet wurde. Z.B. (25).',
	'PORTAL_WORDGRAPH_RATIO'					=> 'Faktor für die Wort-Größe',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'			=> 'Ändere hier den Faktor, der die Größe in Beziehung zur Häufigkeit bestimmt, in welcher das Wort vorkommt (Empfohlen=18)',

	// welcome message
	'ACP_PORTAL_WELCOME_SETTINGS'				=> 'Einstellungen für die Willkommens-Nachricht',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für die Willkommens-Nachricht ändern.',
	'PORTAL_WELCOME_INTRO'						=> 'Willkommens-Nachricht',
	'PORTAL_WELCOME_GUEST'						=> 'Willkommens-Nachricht nur für Gäste?',
	'PORTAL_WELCOME_INTRO_EXPLAIN'				=> 'Ändere hier die Willkommens-Nachricht (BBCode ist erlaubt).',
	
	// links
	'ACP_PORTAL_LINKS_SETTINGS' 		=> 'Links-Einstellungen',
	'ACP_PORTAL_LINKS_SETTINGS_EXPLAIN' => 'Einstellungen für die Links ändern.',
	'PORTAL_LINKS'						=> 'Links',
	'PORTAL_LINKS_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_LINK_TEXT'					=> 'Text/URL',
	'PORTAL_LINK_TEXT_EXPLAIN'			=> 'Im oberen Feld den Text eingeben, im unteren den Link. Benutze die Buttons, um Links zu löschen oder zu ordnen. Vergiss nicht das http:// !',
	'PORTAL_ADD_LINK_TEXT'				=> 'Neuen Link erstellen',
	'PORTAL_ADD_LINK_TEXT_EXPLAIN'		=> 'Klicke auf den Text, um einen neuen Link zu erstellen.',
	'PORTAL_LINK_ADD'					=> '<strong>Link erstellen</strong>',

	// custom
	'ACP_PORTAL_CUSTOM_SETTINGS'				=> 'Einstellungen für die eigenen Blöcke',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXPLAIN'		=> 'Einstellungen für eigenen Blöcke ändern. Diese Blöcke können mit HTML oder BBCode für verschiedene Zwecke, wie z.B. Werbung, Videos, Flash oder Text genutzt werden. Gib einfach den gewünschten Code ein.',
	'ACP_PORTAL_CUSTOM_SMALL_SETTINGS'			=> 'Einstellungen für den kleinen eigenen Block',
	'PORTAL_CUSTOM_SMALL_HEADLINE'				=> 'Überschrift für den kleinen eigenen Block',
	'PORTAL_CUSTOM_SMALL_HEADLINE_EXPLAIN'		=> 'Hier kannst du die Überschrift der Box ändern.',
	'PORTAL_CUSTOM_SMALL'						=> 'Kleinen eigenen Block anzeigen',
	'PORTAL_CUSTOM_SMALL_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen (links oder rechts).',
	'PORTAL_CUSTOM_SMALL_BBCODE'				=> 'BBCode für die kleine Box aktivieren',
	'PORTAL_CUSTOM_SMALL_BBCODE_EXPLAIN'		=> 'BBCode kann dann in dieser Box benutzt werden. Ansonsten wird HTML direkt ausgegeben.',
	'PORTAL_CUSTOM_CODE_SMALL'					=> 'Code für den kleinen eigenen Block',
	'PORTAL_CUSTOM_CODE_SMALL_EXPLAIN'			=> 'Ändere den Code für die kleine Box (HTML oder BBCode).',
	'ACP_PORTAL_CUSTOM_CENTER_SETTINGS'			=> 'Einstellungen für den mittleren eigenen Block',
	'PORTAL_CUSTOM_CENTER'						=> 'Mittleren eigenen Block anzeigen',
	'PORTAL_CUSTOM_CENTER_EXPLAIN'				=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_CUSTOM_CENTER_HEADLINE'				=> 'Überschrift für den mittleren eigenen Block',
	'PORTAL_CUSTOM_CENTER_HEADLINE_EXPLAIN'		=> 'Hier kannst du die Überschrift der Box ändern.',
	'PORTAL_CUSTOM_CENTER_BBCODE'				=> 'BBCode für die mittlere Box aktivieren',
	'PORTAL_CUSTOM_CENTER_BBCODE_EXPLAIN'		=> 'BBCode kann dann in dieser Box benutzt werden. Ansonsten wird HTML direkt ausgegeben.',
	'PORTAL_CUSTOM_CODE_CENTER'					=> 'Code für den mittleren eigenen Block',
	'PORTAL_CUSTOM_CODE_CENTER_EXPLAIN'			=> 'Ändere den Code für die mittlere Box (HTML oder BBCode).',

	// minicalendar
	'ACP_PORTAL_MINICALENDAR_SETTINGS'				=> 'Einstellungen für den Mini-Kalender',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'		=> 'Hier kannst du die Einstellungen für den Mini-Kalender ändern.',
	'PORTAL_MINICALENDAR'							=> 'Mini-Kalender-Block anzeigen',
	'PORTAL_MINICALENDAR_EXPLAIN'					=> 'Diesen Block auf dem Portal anzeigen.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'				=> 'Farbe für den aktuellen Tag',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'		=> 'HEX oder Farbennamen sind erlaubt (Englisch!) wie z.B. #FFFFFF für Weiß oder (englische!) Farbennamen wie z.B. violet.',
	'PORTAL_MINICALENDAR_SUNDAY_COLOR'				=> 'Farbe für Sonntage',
	'PORTAL_MINICALENDAR_SUNDAY_COLOR_EXPLAIN'		=> 'HEX oder Farbennamen sind erlaubt (Englisch!) wie z.B. #FFFFFF für Weiß oder (englische!) Farbennamen wie z.B. violet.',
	'PORTAL_LONG_MONTH'								=> 'Langen Monatsname anzeigen',
	'PORTAL_LONG_MONTH_EXPLAIN'						=> 'Wenn deaktiviert, wird der Monat gekürzt z.B. Aug. statt August.',
	'PORTAL_SUNDAY_FIRST'						  	=> 'Erster Tag der Woche',
	'PORTAL_SUNDAY_FIRST_EXPLAIN'					=> 'Wenn deaktiviert, wird von Mo. --> So. angezeigt, ansonsten So. --> Sa.',
));

/**
* A copy of Handyman` s MOD version check, to view it on the portal general settings
*/
$lang = array_merge($lang, array(
	'ANNOUNCEMENT_TOPIC'	=> 'Release Ankündigung',
	'CURRENT_VERSION'		=> 'Derzeitige Version',
	'DOWNLOAD_LATEST'		=> 'Neueste Version herunterladen',
	'LATEST_VERSION'		=> 'Neueste Version',
	'NO_INFO'				=> 'Der Server konnte nicht erreicht werden',
	'NOT_UP_TO_DATE'		=> '%s ist nicht aktuell',
	'RELEASE_ANNOUNCEMENT'	=> 'Ankündigungsthema',
	'UP_TO_DATE'			=> '%s ist aktuell',
	'VERSION_CHECK'			=> 'MOD Version Check',
));

?>