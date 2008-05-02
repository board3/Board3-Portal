<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) Raimon ( http://www.phpBBservice.nl  )
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
	'ACP_PORTAL_INFO_SETTINGS'			=> 'Algemene instellingen',
	'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'	=> 'Dank je dat je gekozen hebt voor phpBB3 portaal. Op deze pagina kan je de portaal beheren van je forum. De schermen hier geven je een snelle kijk op alle portaal instellingen. De links aan de linkerkant van dit scherm  geven je de mogelijkheid om elk onderdeel te beheren.',

	'ACP_PORTAL_SETTINGS'				=> 'Algemene instellingen',
	'ACP_PORTAL_SETTINGS_EXPLAIN'		=> 'Dank je dat je gekozen hebt voor phpBB3 portaal. Op deze pagina kan je de portaal beheren van je forum. De schermen hier geven je een snelle kijk op alle portaal instellingen. De links aan de linkerkant van dit scherm  geven je de mogelijkheid om elk onderdeel te beheren.',

	// general
	'ACP_PORTAL_GENERAL_INFO'				=> 'Portaal beheer',
	'ACP_PORTAL_GENERAL_INFO_EXPLAIN'		=> 'Dank je dat je gekozen hebt voor phpBB3 portaal. Op deze pagina kan je de portaal beheren van je forum. De schermen hier geven je een snelle kijk op alle portaal instellingen. De links aan de linkerkant van dit scherm  geven je de mogelijkheid om elk onderdeel te beheren.',
	'ACP_PORTAL_VERSION'					=> '<strong>Board3 Portal versie v%s</strong>',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'Algemene instellingen',
	'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'	=> 'Hier kan je de algemene instellingen aanpassen en specifieke instellingen aanpassen.',
	'PORTAL_ADVANCED_STAT'					=> 'Uitgebreide statistieken blok',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Dit blok weergeven op het portaal.',
	'PORTAL_LEADERS'						=> 'Leiders / Team-blok',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_CLOCK'							=> 'Klokblok',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Dit blok weergeven op het portaal.',
	'PORTAL_LINK_US'						=> 'Link ons-blok',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_BIRTHDAYS'						=> 'Verjaardagsblok',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Aantal dagen voor de volgende verjaardagen',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'Hoeveel dagen voor de volgende verjaardagen wordt terug gekeken',
	'PORTAL_SEARCH'							=> 'Zoekenblok',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Dit blok weergeven op het portaal.',
	'PORTAL_WELCOME'						=> 'Welkom midden blok',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_WHOIS_ONLINE'							=> 'Wie is er online?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'					=> 'Dit blok weergeven op het portaal.',
	'PORTAL_CHANGE_STYLE'							=> 'Stijlveranderaar',
	'PORTAL_CHANGE_STYLE_EXPLAIN'					=> 'Dit blok weergeven op het portaal.<br /><span style="color:red">Notitie:</span> Als "overschrijf gebruikerstijl:" in de foruminstellingen is ingeschakeld naar "Ja", wordt dit blok <em>niet weergegeven</em>, afhankelijk van deze instellingen.',
	'PORTAL_FRIENDS'						=> 'Vriendenblok',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limiet van de weergeven online vrienden',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Limiet weergeven van de online vrienden in de portaal blok om een waarde te bepaalen.',
	'PORTAL_MAIN_MENU'						=> 'Hoofdmenu',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_USER_MENU'						=> 'Gebruikersmenu /aanmeldmenu',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_FORUM_INDEX'                    => 'Forumindex (Forumlijst)',
    'PORTAL_FORUM_INDEX_EXPLAIN'            => 'Dit blok weergeven op het portaal.',

	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Willekeurig gebruikerblok',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Dit blok weergeven op het portaal.',

	// global announcements
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Forummededelingen',
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Forummededelingen instellingen',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'Hier kan je jouw forummededelingen informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Weergeven forummededelingen',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Compacte forummededelingen blokstijl',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> 'Als je ja kiest word er een compacte stijl gebruikt voor forummededelingen, nee is een groote stijl',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Aantal mededelingen op de portaal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 betekend geen limiet',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Aantal dagen dat de mededelingen worden weergegeven',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 betekend geen limiet',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maximale lengte van de forummededelingen',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 betekend geen limiet',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Forummededelingen forum-ID',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Het forum waar we de forummededelingen ophalen, laat dit leeg als we alle gegevens moeten ophalen uit alle forums, bij meerdere forums kan je een komma gebruiken, b.v. 1,2,5',
    'PORTAL_ANNOUNCEMENTS_PERMISSIONS'          => 'In/uit-schakelen permissies',
    'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXPLAIN'  => 'Neem forumpermissies mee wanneer er een forummededelingen worden weergegeven',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'              => 'Het mededelingen archiefsysteem inschakelen',
    'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXPLAIN'      => 'Als het is ingeschakeld zullen de mededelingen archiefsysteem / paginanummers weergegeven worden.',
	
	// news
	'ACP_PORTAL_NEWS_INFO'				=> 'Nieuws',
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Nieuwsinstellingen',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'Hier kan je de nieuws informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_NEWS'						=> 'Weergeven nieuwsblok',
	'PORTAL_NEWS_EXPLAIN'				=> 'Dit blok weergeven op de portaal.',
	'PORTAL_NEWS_STYLE'					=> 'Compacte nieuws blok stijl',
	'PORTAL_NEWS_STYLE_EXPLAIN'			=> 'Als je ja selecteerd word er een compacte stijl gebruikt voor het nieuws, bij nee is het een groote stijl.',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Weergeven alle artikellen in dit forum',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'		=> 'inclusief vastegepinde en mededelingen.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Aantal nieuws artikelen op de portaal.',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'		=> '0 betekend geen limiet',
	'PORTAL_NEWS_LENGTH'				=> 'Maximale lengte van een nieuws artikel',
	'PORTAL_NEWS_LENGTH_EXPLAIN'		=> '0 betekend geen limiet',
	'PORTAL_NEWS_FORUM'					=> 'Nieuws Forum-ID',
	'PORTAL_NEWS_FORUM_EXPLAIN'			=> 'Het forum waar we de artikelen ophalen, laat dit leeg als we alle gegevens moeten ophalen uit alle forums, bij meerdere forums kan je een komma gebruiken, b.v. 1,2,5',
	'PORTAL_EXCLUDE_FORUM'				=> 'Exclusief Forum-ID',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'		=> 'Het forum waar we de artikelen ophalen, laat dit leeg als we alle gegevens moeten ophalen uit alle forums, bij meerdere forums kan je een komma gebruiken, b.v. 1,2,5',
    'PORTAL_NEWS_PERMISSIONS'           => 'In/uit-schaken permissies',
    'PORTAL_NEWS_PERMISSIONS_EXPLAIN'   => 'Neem de forumpermissies om forums te kunnen weergeven mee, wanneer nieuws wordt weergegeven',
	'PORTAL_NEWS_SHOW_LAST'             => 'Weergeef het nieuwste bericht',
    'PORTAL_NEWS_SHOW_LAST_EXPLAIN'     => 'Wanneer het is geaktiveerd, de nieuwste berichten zullen worden weergegeven in een tekstweergave. Wanneer het is gedeaktiveerd, het nieuwste bericht zal worden weergegeven als een onderwerp.<br />In het compacte nieuwsblok stijl, zal de link , linken naar het eerste nieuwste bericht.',
    'PORTAL_NEWS_ARCHIVE'               => 'Het nieuws archiefsysteem inschakelen',
    'PORTAL_NEWS_ARCHIVE_EXPLAIN'       => 'Als het is ingeschakeld zullen de mededelingen archiefsysteem / paginanummers weergegeven worden.',
   
	// recent topics
	'ACP_PORTAL_RECENT_INFO'				=> 'Recente onderwerpen',	
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Recente onderwerpen-instellingen',	
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'Hier kan je de recente onderwerpen informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_RECENT'							=> 'Recent onderwerpen-blok weergeven',
	'PORTAL_RECENT_EXPLAIN'					=> 'Dit blok weergeven op het portaal.',
	'PORTAL_MAX_TOPIC'						=> 'Limiet van recente mededelingen/populaire onderwerpen',
	'PORTAL_MAX_TOPIC_EXPLAIN'				=> '0 betekend geen limiet',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Teken limiet voor recent onderwerp',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'		=> '0 betekend geen limiet',

	// paypal
	'ACP_PORTAL_PAYPAL_INFO'				=> 'Paypal',	
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypalinstellingen',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Hier kan je de jouw paypal informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_PAY_C_BLOCK'					=> 'Paypal midden blok weergeven',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Dit blok weergeven op het portaal.',
	'PORTAL_PAY_S_BLOCK'					=> 'Weergeven van het smalle paypalblok',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Dit blok weergeven op het portaal.',
	'PORTAL_PAY_ACC'						=> 'Paypal accountend om te gebruiken',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Typ het gebruikte paypal email adres in. b.v. xxx@xxx.nl',

	// last member
	'ACP_PORTAL_MEMBERS_INFO'				=> 'Laatste gebruikers',
	'ACP_PORTAL_MEMBERS_SETTINGS'			=> 'Laatste gebruikersinstellingen',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'Hier kan je jouw laatste gebruikers informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_LATEST_MEMBERS'					=> 'Weergeven van de laatste gebruikersblok',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'			=> 'Dit blok weergeven op het portaal.',
	'PORTAL_MAX_LAST_MEMBER'				=> 'Limiet van het aantal weergeven laatste gebruikers',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'		=> '0 betekend geen limiet',

	// bots
	'ACP_PORTAL_BOTS_INFO'						=> 'Bezoeken van zoekrobots',
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Bezoeken zoekrobotsinstellingen',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'Hier kan je de bezoeken zoekrobots informatie aantepassen, en bepaalde opties ervoor instellen.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Weergeven van de Bezoeken zoekrobotsblok',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Dit blok weergeven op het portaal.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Hoeveel zoekrobots wil je laten weergeven',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 betekend geen limiet',

	// polls   
	'ACP_PORTAL_POLLS_INFO'				=> 'Peiling',	
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'peilinginstellingen',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'Hier kan je de peiling informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_POLL_TOPIC'					=> 'weergeven van het peilingblok',
	'PORTAL_POLL_TOPIC_EXPLAIN'			=> 'Dit blok weergeven op het portaal.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Peiling onderwerp van het forum met ID',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'		=> 'Het forum waar we de peilingen ophalen, laat dit leeg als we alle gegevens moeten ophalen uit alle forums, bij meerdere forums kan je een komma gebruiken, b.v. 1,2,5',
	'PORTAL_POLL_LIMIT'					=> 'Weergeven van peilingen limiet',
	'PORTAL_POLL_LIMIT_EXPLAIN'			=> 'Het aantal peilingen die je wilt weergeven op de portal.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Sta stemmen toe',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Gebruikers kunnen stemmen op de portaal met de juiste permissies.',
	
	// most poster
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Meeste berichtenplaatser',
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'Meeste berichtenplaatser',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'Hier kan je de Beste berichtenplaatser informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_TOP_POSTERS'                  		=> 'Weergeven dan de meeste/beste berichtenplaatserblok',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_MAX_MOST_POSTER'					=> 'Hoeveel meeste berichtenplaatsers wil je weergeven',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 betekend geen limiet',

	// left and right collumn width 
	'ACP_PORTAL_COLLUMN_WIDTH_INFO'				=> 'Tabel-breedte',
	'ACP_PORTAL_COLLUMN_WIDTH_SETTINGS'			=> 'Links en rechter tabel-breedte instellingen',	
	'PORTAL_LEFT_COLLUMN_WIDTH'					=> 'Breedte waarde van de linker-tabel',
	'PORTAL_LEFT_COLLUMN_WIDTH_EXPLAIN'			=> 'Verander de breedte van de linker-tabel in pixels, de waarde 180 is aanbevolen',
	'PORTAL_RIGHT_COLLUMN_WIDTH'				=> 'Breedte waarde van de rechter-tabel',
	'PORTAL_RIGHT_COLLUMN_WIDTH_EXPLAIN'		=> 'Verander de breedte van de rechter-tabel in pixels, de waarde 180 is aanbevolen',

	// attachments    
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'				=> 'Bijlagen',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Bijlagen instellingen',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Hier kan je de bijlagen informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_ATTACHMENTS'                  				=> 'Weergeven bijlagen blok',
	'PORTAL_ATTACHMENTS_EXPLAIN'                  		=> 'Dit blok weergeven op het portaal.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limiet van het aantal teweergeven bijlagen',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 betekend geen limiet',
	'PORTAL_ATTACHMENTS_FORUM_IDS'                      => 'Bijlagen forum-id(s)',
    'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'              => 'Het forum waar we de bijlagen ophalen, laat dit leeg als we alle gegevens moeten ophalen uit alle forums, bij meerdere forums kan je een komma gebruiken, b.v. 1,2,5 ',

	// friends
	'ACP_PORTAL_FRIENDS_INFO'				=> 'Vrienden',
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Vriendeninstellingen',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'Hier kan je de vrienden informatie aanpassen en diverse opties ervoor.',
	'PORTAL_FRIENDS'						=> 'Weergeef vriendenblok',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Weergeef bijlagenblok',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limiet van te weergegeven vrienden',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Limieten van de te weergeven vrienden met de ingevoerde waarde.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_INFO'				=> 'Woordgrafiek',
	'ACP_PORTAL_WORDGRAPH_SETTINGS'			=> 'Woordgrafiekinstellingen',	
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'Hier kan je jouw woordgrafiek informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_WORDGRAPH'						=> 'Weergeven woordgrafiekblok',
	'PORTAL_WORDGRAPH_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_WORDGRAPH_MAX_WORDS'			=> 'Hoeveel worden moeten er worden weergeven',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 betekend geen limiet',
	'PORTAL_WORDGRAPH_WORD_COUNTS'			=> 'Inclusief teller waarde om weertegeven',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Weergeven teller waarde per woord b.v. (25).',
	'PORTAL_WORDGRAPH_RATIO'				=> 'Gebruikt aspect woordengroote',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'		=> 'Veranderd het de woordengroote (default=18)',

	// welcome message
	'ACP_PORTAL_WELCOME_INFO'				=> 'Welkom',
	'ACP_PORTAL_WELCOME_SETTINGS'			=> 'Welkomsinstellingen',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'Hier kan je , je eigen welkomstbericht en diverse opties ervoor instellen.',
	'PORTAL_WELCOME_INTRO'					=> 'Welkomstbericht',
	'PORTAL_WELCOME_GUEST'					=> 'Welkomstbericht alleen voor gasten?',
	'PORTAL_WELCOME_INTRO_EXPLAIN'			=> 'veranderd de welkomstekst (BBCodes zijn toegestaan). Max. 600 tekens!',
	
	// links
   'ACP_PORTAL_LINKS_INFO'                  => 'Links',
   'ACP_PORTAL_LINKS_SETTINGS'              => 'Linkinstellingen',
   'ACP_PORTAL_LINKS_SETTINGS_EXPLAIN'      => 'Stel de linkblok links in.',
   'PORTAL_LINKS'                           => 'Linksblok',
   'PORTAL_LINKS_EXPLAIN'                   => 'Dit blok weergeven op het portaal.',
   'PORTAL_LINK_TEXT'                       => 'Tekst/URL',
   'PORTAL_LINK_TEXT_EXPLAIN'               => 'De tekst die wordt gevolgd door de link. Gebruik de knoppen om de links te verwijderen, of te herrangschikken. Vergeet niet de http:// !',
   'PORTAL_ADD_LINK_TEXT'                   => 'Link toevoegen',
   'PORTAL_ADD_LINK_TEXT_EXPLAIN'           => 'Klik op de tekst om een nieuwe link te creëren.',
   'PORTAL_LINK_ADD'                        => '<strong>Toevoegen</strong>',
	
	// custom
   'ACP_PORTAL_CUSTOM_INFO'                     => 'Aangepasteblok',
   'ACP_PORTAL_CUSTOM_SETTINGS'                 => 'Aangepasteblok-instellingen',
   'ACP_PORTAL_CUSTOM_SETTINGS_EXPLAIN'         => 'Hier kan je jouw aangepasteblok veranderen. Deze blokken kunnen worden toegevoegd  met HTML of BBCode voor diverse doeleindes zoals advertenties, videos, afbeeldingen, flash of tekst. Voeg de code toe die nodig is.',
   'ACP_PORTAL_CUSTOM_SMALL_SETTINGS'           => 'Aangepasteblokken-instellingen voor het smalle blok',
   'PORTAL_CUSTOM_SMALL_HEADLINE'               => 'Hoofdregel voor het smalle-aangepasteblok',
   'PORTAL_CUSTOM_SMALL_HEADLINE_EXPLAIN'       => 'Hier kan je de hoofdregel veranderen voor het smalle aangepasteblok.',
   'PORTAL_CUSTOM_SMALL'                        => 'Weergeef het smalle-aangepasteblok',
   'PORTAL_CUSTOM_SMALL_EXPLAIN'                => 'Dit blok weergeven op het portaal.',
   'PORTAL_CUSTOM_SMALL_BBCODE'                 => 'Aktiveer BBCode voor het smalle-aangepasteblok',
   'PORTAL_CUSTOM_SMALL_BBCODE_EXPLAIN'         => 'BBCode kan gebruikt worden in deze box. Als BBCode niet is geactiveerd zal HTML geparst worden.',
   'PORTAL_CUSTOM_CODE_SMALL'                   => 'Code voor het smalle-aangepasteblok',
   'PORTAL_CUSTOM_CODE_SMALL_EXPLAIN'           => 'Verander de code voor de smalle-aangepasteblok (HTML of BBCode) hier.',
   'ACP_PORTAL_CUSTOM_CENTER_SETTINGS'          => 'Aangepasteblokken-instellingen voor het middenblok',
   'PORTAL_CUSTOM_CENTER'                       => 'Weergeef het midden-aangepasteblok',
   'PORTAL_CUSTOM_CENTER_EXPLAIN'               => 'Dit blok weergeven op het portaal.',
   'PORTAL_CUSTOM_CENTER_HEADLINE'              => 'Hoofdregel voor het midden-aangepasteblok',
   'PORTAL_CUSTOM_CENTER_HEADLINE_EXPLAIN'      => 'Hier kan je de hoofdregel veranderen voor het midden-aangepasteblok.',
   'PORTAL_CUSTOM_CENTER_BBCODE'                => 'Aktiveer BBCode voor het miden-aangepasteblok',
   'PORTAL_CUSTOM_CENTER_BBCODE_EXPLAIN'        => 'BBCode kan gebruikt worden in deze box. Als BBCode niet is geactiveerd zal HTML geparst worden.',
   'PORTAL_CUSTOM_CODE_CENTER'                  => 'Code voor het midden-aangepasteblok',
   'PORTAL_CUSTOM_CODE_CENTER_EXPLAIN'          => 'Verander de code voor de midden-aangepasteblok (HTML of BBCode) hier.',
	
	// minicalendar
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Kleine kalender',
	'ACP_PORTAL_MINICALENDAR_SETTINGS'			=> 'Kleine kalender instellingen',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> 'Hier kan je de kleine kalender informatie aanpassen, en bepaalde opties ervoor instellen.',
	'PORTAL_MINICALENDAR'						=> 'Weergeven kleine kalenderblok',
	'PORTAL_MINICALENDAR_EXPLAIN'				=> 'Dit blok weergeven op het portaal.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'			=> 'Aktieve dag kleur',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'HEX of naam kleuren zijn toegestaan zoals #FFFFFF voor wit, of kleuren namen zoals violet.',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR'		=> 'Dag link kleur',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'=> 'HEX of naam kleuren zijn toegestaan zoals #FFFFFF voor wit, of kleuren namen zoals violet.',


));

?>