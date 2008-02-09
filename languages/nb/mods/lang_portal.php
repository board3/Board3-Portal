<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( delta221 http://www.scannernytt.net )
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
	'WELCOME'				=> 'Velkommen',

	'PORTAL_ERROR'			=> 'Portal Feil',
	'PORTAL_DELETE_DIR'		=> 'Vær vennlig og slette portal installasjons katalogen: %s',
	'PORTAL_UPDATE'			=> 'Portal Oppdatering',
	'PORTAL_UPDATE_TEXT'	=> 'Det\'s er en oppdatering for portalen som venter på og bli innstallert! Installer <a href="%1$s">%2$s</a>!',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'Siste globale kunngjøringer',
	'GLOBAL_ANNOUNCEMENT'	=> 'Global annonsering',
	'LATEST_NEWS'			=> 'Siste nyheter',
	'READ_FULL'				=> 'Les alle',
	'NO_NEWS'				=> 'Ingen nyheter',
	'NO_ANNOUNCEMENTS'		=> 'Ingen globale kunngjøringer',
	'POSTED_BY'				=> 'Poster',
	'COMMENTS'				=> 'Kommentarer',
	'VIEW_COMMENTS'			=> 'Se kommentarer',
	'POST_REPLY'			=> 'Skriv kommentar',
	'TOPIC_VIEWS'			=> 'Lest av',
	'JUMP_NEWEST'			=> 'Hopp til nyeste innlegg',
	'JUMP_FIRST'			=> 'Hopp til første innlegg',
	'JUMP_TO_POST'			=> 'hopp til innlegg',
	'BACK'							=> 'Tilbake',

	// who is online
	'WIO_TOTAL'			=> 'Totalt',
	'WIO_REGISTERED'	=> 'Registrerte',
	'WIO_HIDDEN'		=> 'Skjulte',
	'WIO_GUEST'			=> 'Gjest',
	//'RECORD_ONLINE_USERS'=> 'View record: <strong>%1$s</strong><br />%2$s',

	// Birthday
	'BIRTHDAYS_AHEAD'              => 'I de neste %s dager',
	'NO_BIRTHDAYS_AHEAD'        => 'I denne perioden, har ingen medlemmer har bursdag.',

	// user menu
	'USER_MENU'			=> 'Brukermeny',
	'UM_LOG_ME_IN'		=> 'husk meg',
	'UM_HIDE_ME'		=> 'skjul meg',
	'UM_MAIN_SUBSCRIBED'=> 'Abonnement',
	'UM_BOOKMARKS'		=> 'Bokmerker',

	// statistics
	/*
	'ST_NEW'		=> 'New',
	'ST_NEW_POSTS'	=> 'New post',
	'ST_NEW_TOPICS'	=> 'New topic',
	'ST_NEW_ANNS'	=> 'New announcment',
	'ST_NEW_STICKYS'=> 'New sticky',
	*/
	'ST_TOP'		=> 'Totalt',
	'ST_TOP_ANNS'	=> 'Totale annonseringer',
	'ST_TOP_STICKYS'=> 'Totalt kleblige',
	'ST_TOT_ATTACH'	=> 'Totale vedlegg',

	// search
	'SH'		=> 'gå',
	'SH_SITE'	=> 'forum',
	'SH_POSTS'	=> 'Innlegg',
	'SH_AUTHOR'	=> 'forfatter',
	'SH_ENGINE'	=> 'søkemotorer',
	'SH_ADV'	=> 'advansert søk',
	
	// recent
	'RECENT_NEWS'		=> 'Siste',
	'RECENT_TOPIC'		=> 'Siste tema',
	'RECENT_ANN'		=> 'Nye kunngjøringer',
	'RECENT_HOT_TOPIC'	=> 'Siste populære tema',

	// random member
	'RND_MEMBER'	=> 'Tilfeldig medlem',
	'RND_JOIN'		=> 'Registert',
	'RND_POSTS'		=> 'Innlegg',
	'RND_OCC'		=> 'Yrke',
	'RND_FROM'		=> 'Bosted',
	'RND_WWW'		=> 'Hjemmeside',

	// top poster
	'TOP_POSTER'	=> 'Topp postere',
	
	// attachments
	'DOWNLOADS'	=> 'Nedlastninger',

	// links
	'LINKS'	=> 'Linker',

	// latest members
	'LATEST_MEMBERS'	=> 'Siste registrerte',

	// make donation
	'DONATION' 		=> 'Donér',
	'DONATION_TEXT'	=> 'er et konsept som forsyner massene uten baktanker om økonomisk profitt. Alle som ønsker å støtte driften av denne site kan gjøre det så utgifter til serverleie, doméne o.s.v. kan bli dekket.',
	'PAY_MSG'		=> 'Etter at du har valgt hvilket beløp du ønsker å donére fra menyen, så kan du klikke videre på PayPal-knappen.',
	'PAY_ITEM'		=> 'Donér', // paypal item

	// main menu
	'M_MENU' 	=> 'Meny',
	'M_CONTENT'	=> 'Innhold',
	'M_ACP'		=> 'Administratorpanel',
	'M_HELP'	=> 'Hjelp',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Betingelser for bruk',
	'M_PRV'		=> 'Taushetspolicy',
	'M_SEARCH'	=> 'Søk',

	// link us
	'LINK_US'		=> 'Link til oss',
	'LINK_US_TXT'	=> 'Link gjerne til <strong>%s</strong>. Bruk følgende HTML-kode:',

	// friends
	'FRIENDS'				=> 'Venner',
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'Ingen venner oppgitt',
	'NO_FRIENDS_OFFLINE'	=> 'Ingen venner offline',
	'NO_FRIENDS_ONLINE'		=> 'Ingen venner online',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'Siste %s besøkte boter',
	
	// wordgraph
	'WORDGRAPH'				=> 'Ordstokk',

		// change style
	'BOARD_STYLE'			=> 'Sidestil',
	'STYLE_CHOOSE'			=> 'Velg en stil',
	
	// team
	'NO_ADMINISTRATORS_P'	=> 'Ingen administratorer',
	'NO_MODERATORS_P'		=> 'Ingen moderatorer',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'	=> 'Tema pr dag: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Tema pr dag: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Innlegg pr dag: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Innlegg pr dag: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Brukere pr dag: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Brukere pr dag: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Tema pr bruker: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Tema pr bruker: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Innlegg pr bruker: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Innlegg pr bruker: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Innlegg pr tema: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Innlegg pr tema: <strong>0</strong>',

	
      // poll
	'LATEST_POLLS'			=> 'Siste avstemninger',
	'NO_OPTIONS'			=> 'Denne avstemningen har ingen tilgjenglige opsjoner.',
	'NO_POLL'				=> 'Ingen avstemninger tilgjengelige',
	'RETURN_PORTAL'			=> '%sReturner til portalen%s',

		// other
	'CLOCK'		=> 'Klokke',
	'SPONSOR'	=> 'Sponsorer',
	
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'Mini_Cal_calendar'		=> 'Kalender',
	'Mini_Cal_add_event'	=> 'Legg til Arrangement',
	'Mini_Cal_events'		=> 'Kommende Arrangement',
	'Mini_Cal_no_events'	=> 'Ingen',
	'Mini_cal_this_event'	=> 'Helligdager denne måneden',
	'View_next_month'		=> 'neste måned',
	'View_previous_month'	=> 'forrige måned',

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
			'2'	=> 'Man',
			'3'	=> 'Tir',
			'4'	=> 'Ons',
			'5'	=> 'Tor',
			'6'	=> 'Fre',
			'7'	=> 'Lør',
			'1'	=> 'Søn',
		),

		'month'	=> array(
			'1'	=> 'Jan',
			'2'	=> 'Feb',
			'3'	=> 'Mar',
			'4'	=> 'Apr',
			'5'	=> 'Mai',
			'6'	=> 'Jun',
			'7'	=> 'Jul',
			'8'	=> 'Aug',
			'9'	=> 'Sep',
			'10'=> 'Okt',
			'11'=> 'Nov',
			'12'=> 'Des',
		),

		'long_month'=> array(
			'1'	=> 'Januar',
			'2'	=> 'Februar',
			'3'	=> 'Mars',
			'4'	=> 'April',
			'5'	=> 'Mai',
			'6'	=> 'Juni',
			'7'	=> 'Juli',
			'8'	=> 'August',
			'9'	=> 'September',
			'10'=> 'Oktober',
			'11'=> 'November',
			'12'=> 'Desember',
		),
	),
));

?>