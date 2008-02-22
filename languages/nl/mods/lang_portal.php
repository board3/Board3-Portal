<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) Raimon ( http://www.phpBBservice.nl )
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
	'PORTAL'				=> 'Portaal',
	'WELCOME'				=> 'Welkom',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'Laatste forummededelingen',
	'LATEST_NEWS'			=> 'Laatste nieuws',
	'READ_FULL'				=> 'Lees alles',
	'NO_NEWS'				=> 'Er is geen nieuws',
	'NO_ANNOUNCEMENTS'		=> 'Er zijn geen forummededelingen',
	'POSTED_BY'				=> 'Auteur',
	'COMMENTS'				=> 'Reacties',
	'VIEW_COMMENTS'			=> 'Bekijk reacties',
	'POST_REPLY'			=> 'Schrijf reactie',
	'TOPIC_VIEWS'			=> 'Bekeken',
	'JUMP_NEWEST'			=> 'Ga naar het nieuwste bericht',
	'JUMP_FIRST'			=> 'Ga naar het eerste bericht',
	'JUMP_TO_POST'			=> 'Ga naar het bericht',
	'BACK'                        => 'Terug',

	// who is online
	'WIO_TOTAL'			=> 'Totaal',
	'WIO_REGISTERED'	=> 'Geregistreerd',
	'WIO_HIDDEN'		=> 'Verborgen',
	'WIO_GUEST'			=> 'Gasten',
	//'RECORD_ONLINE_USERS'=> 'Bekijk het record: <strong>%1$s</strong><br />%2$s',

	// Birthday 
	'BIRTHDAYS_AHEAD'              => 'In de komende %s dagen', 
	'NO_BIRTHDAYS_AHEAD'           => 'Zijn er geen jarigen.', 

	// user menu
	'USER_MENU'			=> 'Gebruikersmenu',
	'UM_LOG_ME_IN'		=> 'herriner mij',
	'UM_HIDE_ME'		=> 'Verberg mij',
	'UM_MAIN_SUBSCRIBED'=> 'Abonnementen',
	'UM_BOOKMARKS'		=> 'Favorieten',

	// statistics
	/*
	'ST_NEW'		=> 'Nieuw',
	'ST_NEW_POSTS'	=> 'Nieuw beircht',
	'ST_NEW_TOPICS'	=> 'Nieuw onderwerp',
	'ST_NEW_ANNS'	=> 'Nieuwe mededeling',
	'ST_NEW_STICKYS'=> 'Nieuw vastgepint',
	*/
	'ST_TOP'		=> 'Totaal',
	'ST_TOP_ANNS'	=> 'Aantal mededelingen',
	'ST_TOP_STICKYS'=> 'Aantal vastgepinde',
	'ST_TOT_ATTACH'	=> 'Aantal bijlagen',

	// search
	'SH'		=> 'ok',
	'SH_SITE'	=> 'forums',
	'SH_POSTS'	=> 'berichten',
	'SH_AUTHOR'	=> 'auteur',
	'SH_ENGINE'	=> 'zoekrobots',
	'SH_ADV'	=> 'Uitgebreid zoeken',
	
	// recent
	'RECENT_NEWS'		=> 'Recent',
	'RECENT_TOPIC'		=> 'Recent onderwerp',
	'RECENT_ANN'		=> 'Recente mededeling',
	'RECENT_HOT_TOPIC'	=> 'Recent populair onderwerp',

	// random member
	'RND_MEMBER'	=> 'Willekeurige gebruiker',
	'RND_JOIN'		=> 'Geregistreerd',
	'RND_POSTS'		=> 'Berichten',
	'RND_OCC'		=> 'Beroep',
	'RND_FROM'		=> 'Woonplaats',
	'RND_WWW'		=> 'Website',

	// top poster
	'TOP_POSTER'	=> 'Hoogste berichtenplaatsers',
	
	// attachments
	'DOWNLOADS'	=> 'Downloads',

	// links
	'LINKS'	=> 'Links',

	// latest members
	'LATEST_MEMBERS'	=> 'Laatste gebruikers',

	// make donation
	'DONATION' 		=> 'Maak een donatie',
	'DONATION_TEXT'	=> 'Is een formatiie van een service met geen doel om winst te maken. Iedereen wie dit forum wilt ondersteunen kan een donatie maken, zodat de kosten van de server, het domein betaald kan worden .',
	'PAY_MSG'		=> 'Nadat je het bedrag hebt gekozen dat je wilt doneren vanuit het menu, kan je doorgaan door op de afbeelding van PayPal te klikken.',
	'PAY_ITEM'		=> 'Maak een donatie', // paypal item

	// main menu
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Inhoud',
	'M_ACP'		=> 'Beheerderspaneel',
	'M_HELP'	=> 'Help',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Gebruiksvoorwaarden',
	'M_PRV'		=> 'Privacybeleid',
	'M_SEARCH'	=> 'Zoeken',

	// link us
	'LINK_US'		=> 'Link naar ons',
	'LINK_US_TXT'	=> 'Voel vrij om te linken naar <strong>%s</strong>. Gebruik dan de volgende HTML:',

	// friends
	'FRIENDS'				=> 'Vrienden',
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'Er zijn momenteel geen vrienden gekozen',
	'NO_FRIENDS_OFFLINE'	=> 'Er zijn geen vrienden offline',
	'NO_FRIENDS_ONLINE'		=> 'Er zijn geen vrienden online',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'Laatst %s bezochten zoekrobots',
	
	// wordgraph
	'WORDGRAPH'				=> 'Wordgraph',

	// change style
	'BOARD_STYLE'			=> 'Forumstijl',
	'STYLE_CHOOSE'			=> 'Selecteer een stijl',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'Er zijn geen beheerders',
	'NO_MODERATORS_P'		=> 'Er zijn geen moderators',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'	=> 'Onderwerpen per dag: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Onderwerpen per dag: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Berichten per dag: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Berichten per dag: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Gebruikers per dag: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Gebruikers per dag: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Onderwerpen per gebruiker: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Onderwerpen per gebruiker: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Berichten per gebruiker: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Berichten per gebruiker: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Berichten per onderwerp: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Berichten per onderwerp: <strong>0</strong>',

	// other
	'POLL'		=> 'Peiling',
	'CLOCK'		=> 'Klok',
	'SPONSOR'	=> 'Sponsors',
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a><br />
  Vertaald door <a href="http://www.phpBBservice.nl" title="phpBBservice.nl Nederlands supportforum">phpBBservice.nl</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'Mini_Cal_calendar'		=> 'Kalender',
	'Mini_Cal_add_event'	=> 'Toevoegen gebeurtenis',
	'Mini_Cal_events'		=> 'Aanstaande gebeurtenissen',
	'Mini_Cal_no_events'	=> 'Geen',
	'Mini_cal_this_event'	=> 'Deze vakantiemaand gebeurtenissen',
	'View_next_month'		=> 'volgende maand',
	'View_previous_month'	=> 'vorige maand',

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
			'1'	=> 'Ma',
			'2'	=> 'Di',
			'3'	=> 'Wo',
			'4'	=> 'Do',
			'5'	=> 'Vr',
			'6'	=> 'Za',
			'7'	=> 'Zo',
		),

		'month'	=> array(
			'1'	=> 'Jan',
			'2'	=> 'Feb',
			'3'	=> 'Mrt',
			'4'	=> 'Apr',
			'5'	=> 'Mei',
			'6'	=> 'Jun',
			'7'	=> 'Jul',
			'8'	=> 'Aug',
			'9'	=> 'Sep',
			'10'=> 'Okt',
			'11'=> 'Nov',
			'12'=> 'Dec',
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
));

?>