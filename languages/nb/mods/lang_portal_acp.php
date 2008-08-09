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
	'ACP_PORTAL_INFO_SETTINGS'			=> 'Generelle innstillinger',
	'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'	=> 'Takk for at du valgte board3 Portalen.På denne siden kan du gjøre innstillinger på portalen din.Linken på venstre side gir deg mulighet til og gjøre innstillnger i portalen.',

	'ACP_PORTAL_SETTINGS'				=> 'Portal innstillinger',
	'ACP_PORTAL_SETTINGS_EXPLAIN'		=> 'Takk for at du valgte board3 Portalen.På denne siden kan du gjøre innstillinger på portalen din. Linken på venstre side gir deg mulighet til og gjøre innstillnger i portalen.',

	// general
	'ACP_PORTAL_GENERAL_INFO'				=> 'Portal administrasjon',
	'ACP_PORTAL_GENERAL_INFO_EXPLAIN'		=> 'Takk for at du valgte board3 Portalen.På denne siden kan du gjøre innstillinger på portalen din. Linken på venstre side gir deg mulighet til og gjøre innstillnger i portalen.',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'Generelle innstillinger',
	'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'	=> 'Her kan du editere blokker og andre ting i portalen.',
	'ACP_PORTAL_VERSION'                  => '<strong>Board3 Portal Versjon v%s</strong>',
	'PORTAL_ADVANCED_STAT'					=> 'Avansert statistikk',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Vis denne blokken i portalen.',
	'PORTAL_LEADERS'						=> 'Ledere / admin',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_CLOCK'							=> 'Klokke',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Vis denne blokken i portalen.',
	'PORTAL_LINK_US'						=> 'Link til oss',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_BIRTHDAYS'						=> 'Bursdager',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Bursdager som venter',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'Hvor mange dager forover for bursdager.',
	'PORTAL_SEARCH'							=> 'Søk',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Vis denne blokken i portalen.',
	'PORTAL_WELCOME'						=> 'Velkommen',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_WHOIS_ONLINE'							=> 'Hvem er pålogget?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'					=> 'Vis denne blokken i portalen.',
	'PORTAL_CHANGE_STYLE'							=> 'Skift stil',
	'PORTAL_CHANGE_STYLE_EXPLAIN'					=> 'Vis denne blokken i portalen.<br /><span style="color:red">Please note:</span> if "Override user style:" in the board settings is set to "Yes", this block <u>wont be displayed</u>, independent of this settings.',
	'PORTAL_FRIENDS'						=> 'Venner',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Antall venner du vil vise i blokken i portalen',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Hvor mange venner vil du vise i potal blokken?.',
	'PORTAL_MAIN_MENU'						=> 'Hovedmeny',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_USER_MENU'						=> 'Brukermeny / Login boks',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Vis denne blokken i portalen.',
 
 // custom
   'ACP_PORTAL_CUSTOM_INFO'             => 'Egendefinert blokk',
   'ACP_PORTAL_CUSTOM_SETTINGS'         => 'Egendefinerte blokk innstillinger',
   'ACP_PORTAL_CUSTOM_SETTINGS_EXPLAIN' => 'Her kan du editere dine engendefinerte blokker. Disse blokkene kan fylles med HTML eller BBCode for mange bruksområder som annonseringer, videoer, bilder, flash eller tekst. Bare legg inn nødvendige koden.',
   'ACP_PORTAL_CUSTOM_CENTER_SETTINGS'  => 'Her kan du endre innstillinger for senter blokken',
   'PORTAL_CUSTOM_SMALL_HEADLINE'       => 'Overskrift for liten egendefinert blokk',
   'PORTAL_CUSTOM_SMALL_HEADLINE_EXPLAIN' => 'Her kan du endre overskrift for liten egendefinert blokk.',
   'PORTAL_CUSTOM_SMALL'                 => 'Vis liten egendefinert blokk',
   'PORTAL_CUSTOM_SMALL_EXPLAIN'         => 'Vis denne blokken i portalen.',
   'PORTAL_CUSTOM_SMALL_BBCODE'          => 'Aktiver BBCode for liten egendefinert blokk',
   'PORTAL_CUSTOM_SMALL_BBCODE_EXPLAIN'  => 'BBCode kan brukes i denne blokken. Hvis ikke BBCode er aktivert, vil HTML bli parsed.',
   'PORTAL_CUSTOM_CODE_SMALL'            => 'Kode for liten egendefinert blokk',
   'PORTAL_CUSTOM_CODE_SMALL_EXPLAIN'    => 'Skift kode for liten egendefinert blokk (HTML eller BBCode) her.',
   'PORTAL_CUSTOM_CENTER'                => 'Vis senter egendefinert blokk',
   'PORTAL_CUSTOM_CENTER_EXPLAIN'        => 'Vis denne blokken i portalen.',
   'PORTAL_CUSTOM_CENTER_HEADLINE'       => 'Overskrift for senter egendefinert blokk',
   'PORTAL_CUSTOM_CENTER_HEADLINE_EXPLAIN' => 'Her kan du endre overskrift for senter egendefinert blokk.',
   'PORTAL_CUSTOM_CENTER_BBCODE'         => 'Aktiver BBCode for egendefinert senter blokk',
   'PORTAL_CUSTOM_CENTER_BBCODE_EXPLAIN' => 'BBCode kan brukes i denne boksen. hvis ikke BBCode er aktivert, vil HTML bli parsed.',
   'PORTAL_CUSTOM_CODE_CENTER'           => 'Kode for senter egendefinert blokk',
   'PORTAL_CUSTOM_CODE_CENTER_EXPLAIN'   => 'Skift kode for liten egendefinert blokk (HTML eller BBCode) her.',

	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Tilfeldig medlem',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Vis denne blokken i portalen.',

	// global announcements
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Globale annonseringer',
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Globale annonseringer innstillinger',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'Her kan du editere den globale annonserings informasjonen.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Vis globale anonnseringer',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Kompakt global annonserings blokk stil',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> 'Hvis du velger ja for og bruke kompakt stil for global annonseringer, nei er stor stil',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Antall annonseringer i portalen',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 betyr ubegrenset',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Antall dager og vise annonseringent',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 betyr ubegrenset',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Max lengde på globale annonseringer',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 betyr ubegrenset',
	 'PORTAL_ANNOUNCEMENTS_PERMISSIONS'         => 'Aktiver/Deaktiver tillatelser',
   'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXPLAIN'   => 'Ta hensyn til forumrettigheter for visning av annonseringer',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Globale annonseringer forum ID',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Skriv inn ID til forumet du vil ha globale annonseringer i fra, ikke skriv inn noe hvis du vil ha artikkler fra alle forum, separer med komma for og bruke flere forum, eg. 1,2,5.',

	// news
	'ACP_PORTAL_NEWS_INFO'				=> 'Nyheter',
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Nyhets innstillinger',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'Her kan du editere nyhets informasjonen.',
	'PORTAL_NEWS'						=> 'Vis nyheter',
	'PORTAL_NEWS_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_NEWS_STYLE'					=> 'Kompakt nyhets blokk stil',
	'PORTAL_NEWS_STYLE_EXPLAIN'			=> 'Hvis du velger ja for og bruke kompakt stil for nyheter, nei er stor stil',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Via alle artikkler i dette forumet',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'		=> 'Inkluder kleblige og annonseringer.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Antall nyhets artikkler i portalen',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'		=> '0 betyr ubegrenset',
	'PORTAL_NEWS_LENGTH'				=> 'Max lengde for nyhets artikkel',
	'PORTAL_NEWS_LENGTH_EXPLAIN'		=> '0 betyr ubegrenset',
	'PORTAL_NEWS_FORUM'					=> 'Nyhets Forum ID',
	'PORTAL_NEWS_FORUM_EXPLAIN'			=> 'Skriv inn ID til forumet du vil ha nyheter i fra, ikke skriv inn noe hvis du vil ha artikkler fra alle forum, separer med komma for og bruke flere forum, eg. 1,2,5.',
  'PORTAL_NEWS_PERMISSIONS'         => 'Aktiver/Deaktiver tillatelser',
  'PORTAL_NEWS_PERMISSIONS_EXPLAIN'   => 'Ta hensyn til forumrettigheter for visning av nyheter',
	'PORTAL_EXCLUDE_FORUM'				=> 'Ekskluder Forum ID',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'		=> 'Skriv inn ID til forumet du vil ha siste emner i fra, ikke skriv inn noe hvis du vil ha artikkler fra alle forum, separer med komma for og bruke flere forum, eg. 1,2,5.',

	// recent topics
	'ACP_PORTAL_RECENT_INFO'				=> 'Siste emner',
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Siste emner innstillinger',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'Her kan du editere siste emner informasjon.',
	'PORTAL_RECENT'							=> 'Vis siste emner',
	'PORTAL_RECENT_EXPLAIN'					=> 'Vis denne blokken i portalen.',
	'PORTAL_MAX_TOPIC'						=> 'Antall emner som skal vises i portalen',
	'PORTAL_MAX_TOPIC_EXPLAIN'				=> '0 betyr ubegrenset',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Karater begrensning for siste emner',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'		=> '0 betyr ubegrenset',

	// paypal
	'ACP_PORTAL_PAYPAL_INFO'				=> 'Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypal innstillinger',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Her kan du editere Paypal informasjon.',
	'PORTAL_PAY_C_BLOCK'					=> 'Vis paypal senter blokk',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Vis denne blokken i portalen.',
	'PORTAL_PAY_S_BLOCK'					=> 'Vis paypal liten blokk',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Vis denne blokken i portalen.',
	'PORTAL_PAY_ACC'						=> 'Paypal konto og bruke',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Skriv inn din Paypal e-mail addresse eg. xxx@xxx.com',

	// last member
	'ACP_PORTAL_MEMBERS_INFO'				=> 'Siste registrerte',
	'ACP_PORTAL_MEMBERS_SETTINGS'			=> 'Siste registrerte medlemer innstillinger',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'Her kan du editere siste registrerte medlemmer.',
	'PORTAL_LATEST_MEMBERS'					=> 'Vis sist registrerte medlemer',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'			=> 'Vis denne blokken i portalen.',
	'PORTAL_MAX_LAST_MEMBER'				=> 'Antall viste siste medlemer',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'		=> '0 betyr ubegrenset',

	// bots
	'ACP_PORTAL_BOTS_INFO'						=> 'Besøkende boter',
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Bot innstillinger',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'Her kan du editere siste boter.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Vis besøkende boter',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Vis denne blokken i portalen.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Hvor mange boter skal vises',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 betyr ubegrenset',

	// polls   
	'ACP_PORTAL_POLLS_INFO'				=> 'Avstemninger',
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Avstemnings innstillinger',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'Her kan du editere siste avstemninger.',
	'PORTAL_POLL_TOPIC'					=> 'Vis avstemninger',
	'PORTAL_POLL_TOPIC_EXPLAIN'			=> 'Vis denne blokken i portalen.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Avstemnings forum id(s)',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'		=> 'Skriv inn ID til forumet hvor avstemningene er. bruk komma for og separere flere forum, eller ikke skriv inn noe for og bruke alle tilgjengelige forum.',
	'PORTAL_POLL_LIMIT'					=> 'Antall avstemninger',
	'PORTAL_POLL_LIMIT_EXPLAIN'			=> 'Antall avstemninger du vil vise i portalen.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Tilatt avstemning',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Tillat brukere med riktig tillatellse og stemme fra portal siden.',

	// most poster
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Topp postere',
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'Topp postere innstillinger',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> ' Her kan du editere topp postere.',
	'PORTAL_TOP_POSTERS'                  		=> 'Vis topp postere',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_MAX_MOST_POSTER'					=> 'Hvor mange postere vil du vise',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 betyr ubegrenset',

	// left and right column width 
	'ACP_PORTAL_column_WIDTH_INFO'				=> 'Kolonne bredde',
	'ACP_PORTAL_column_WIDTH_SETTINGS'			=> 'Venstre og høyre kolonne bredde innstillinger',
	'PORTAL_LEFT_column_WIDTH'					=> 'Bredde verdi for venstre kolonne',
	'PORTAL_LEFT_column_WIDTH_EXPLAIN'			=> 'Skift bredde i venstre kolonne i pixel, rekommandert verdi 180',
	'PORTAL_RIGHT_column_WIDTH'				=> 'Høyde verdi for høyre kolonne',
	'PORTAL_RIGHT_column_WIDTH_EXPLAIN'		=> 'Skift høyde i høyre kolonne i pixel, rekommandert verdi 180',

	// attachments    
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'				=> 'Vedlegg',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Vedleggs innstillinger',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Her kan du editere vedleggs informasjon.',
	'PORTAL_ATTACHMENTS'								=> 'Vis vedlegg',
	'PORTAL_ATTACHMENTS_EXPLAIN'						=> 'Vis denne blokken i portalen.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Antall viste vedlegg',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 betyr ubegrenset',
	'PORTAL_ATTACHMENTS_FORUM_IDS'         => 'Veleggs forum id(er)',
  'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'  => 'Skriv inn ID(er) til forumene du vil vise vedlegg i fra, ikke skriv inn noe hvis du vil ha vedlegg fra alle forum, separer med komma for og bruke flere forum, eg.1,2,5.',

	// friends
	'ACP_PORTAL_FRIENDS_INFO'				=> 'Venner',
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Venner innstillinger',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'Her kan du editere dine venner blokk.',
	'PORTAL_FRIENDS'						=> 'Vis venner',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Vis denne blokken i portalen',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Antall viste venner',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Antall venner du vil vise i blokken.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_INFO'				=> 'Ordstokk',
	'ACP_PORTAL_WORDGRAPH_SETTINGS'			=> 'Ordstokk innstillinger',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'Her kan du editere ordstokk informasjon.',
	'PORTAL_WORDGRAPH'						=> 'Vis ordstokk',
	'PORTAL_WORDGRAPH_EXPLAIN'				=> 'Vis denne blokken i portalen.<br /><strong>Ordstokk virker ikke hvis fulltekst mysql er valg som søke backend.</strong>',
	'PORTAL_WORDGRAPH_MAX_WORDS'			=> 'Hvor mange ord vil du vise',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 betyr ubegrenset',
	'PORTAL_WORDGRAPH_WORD_COUNTS'			=> 'Inkluder telle verdier og vise',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Vis telle verdier pr ord eg. (25).',
	'PORTAL_WORDGRAPH_RATIO'				=> 'Bruk ord forhold - ord størrelse',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'		=> 'Skift ord forhold (større/mindre) ord størrelse (standard=18)',

	// welcome message
	'ACP_PORTAL_WELCOME_INFO'				=> 'Velkommen',
	'ACP_PORTAL_WELCOME_SETTINGS'			=> 'Velkommen innstillinger',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'Her kan du editere velkomst meldingen.',
	'PORTAL_WELCOME_INTRO'					=> 'Velkomst melding',
	'PORTAL_WELCOME_GUEST'					=> 'Velkomst melding kun for gjester?',
  'PORTAL_WELCOME_INTRO_EXPLAIN' => 'Editer velkomst meldingen (BBCode er tilatt). Max. 600 bokstaver!',

	// minicalendar
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini kalender',
	'ACP_PORTAL_MINICALENDAR_SETTINGS'			=> 'Mini kalender innstillinger',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> ' Her kan du editere mini kalender informasjon.',
	'PORTAL_MINICALENDAR'						=> 'Vis mini kalender',
	'PORTAL_MINICALENDAR_EXPLAIN'				=> 'Vis denne blokken i portalen.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'			=> 'Aktiv dag farge',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'HEX eller navngitte farger er tillatt slik som #FFFFFF for vit, eller fargenavn som f.eks blå.',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR'		=> 'Dag link farge',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'=> 'HEX eller navngitte farger er tillatt slik som #FFFFFF for vit, eller fargenavn som f.eks blå.',

// Gallery
'ACP_PORTAL_GALLERY_SETTINGS' => 'Innstillinger for galleri',
'ACP_PORTAL_GALLERY_SETTINGS_EXPLAIN' => 'Her kan du se innstillinger for galleri blokken.',
'ACP_PORTAL_GALLERY_SETTINGS_RIGHT' => 'Instillinger for høyre galleri blokk',
'ACP_PORTAL_GALLERY_SETTINGS_CENTER' => 'Innstilling for midtre galleri blokk',
'PORTAL_GALLERY' => 'Vis galleri blokk',
'PORTAL_GALLERY_EXPLAIN' => 'Vis denne blokken i portalen.',
'PORTAL_IMAGES_NUMBER' => 'Antall bilder og vise',
'PORTAL_IMAGES_SORT' => 'Tilfeldige bilder Show',
'PORTAL_IMAGES_SORT_EXPLAIN' => 'For siste bilde velg "nei"',
'PORTAL_ALBUM_ID' => 'ID på albumene',
'PORTAL_ALBUM_ID_EXPLAIN' => 'Skriv inn ID til albumet du vil ha siste bilder i fra, ikke skriv inn noe hvis du vil ha bilder fra alle album, separer med komma for og bruke flere album, eg.1,2,5.',

  // links
   'ACP_PORTAL_LINKS_INFO'          => 'Link',
   'ACP_PORTAL_LINKS_SETTINGS'       => 'Link Innstillinger',
   'ACP_PORTAL_LINKS_SETTINGS_EXPLAIN' => 'Sett opp link blokk linker.',
   'PORTAL_LINKS'                  => 'Link blokk',
   'PORTAL_LINKS_EXPLAIN'            => 'Vis denne blokken i portalen.',
   'PORTAL_LINK_TEXT'               => 'Tekst/URL',
   'PORTAL_LINK_TEXT_EXPLAIN'         => 'Tekst og URL for linken.Bruk knappene for og slette og reorganisere linkene. Ikke glem http:// !',
   'PORTAL_ADD_LINK_TEXT'            => 'Legg til link',
   'PORTAL_ADD_LINK_TEXT_EXPLAIN'      => 'Klikk på teksten for og lage en ny link.',
   'PORTAL_LINK_ADD'               => '<strong>Legg til</strong>',
));

?>