<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( JirkaX)
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
	'PORTAL'				=> 'Portál',
	'WELCOME'				=> 'Vítejte',

	'PORTAL_ERROR'			=> 'Chyba portálu',
	'PORTAL_DELETE_DIR'		=> 'Prosím, smažte instalační adresář portálu: %s',
	'PORTAL_UPDATE'			=> 'Update portálu',
	'PORTAL_UPDATE_TEXT'	=> 'Existuje update portálu, který čeká na nainstalování! Instalace <a href="%1$s">%2$s</a>!',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'Poslední globální oznámení',
	'GLOBAL_ANNOUNCEMENT'	=> 'Globální oznámení',
	'LATEST_NEWS'			=> 'Poslední příspěvky',
	'READ_FULL'				=> 'Přečíst celé',
	'NO_NEWS'				=> 'Žádné novinky',
	'NO_ANNOUNCEMENTS'		=> 'Žádná globální oznámení',
	'POSTED_BY'				=> 'Uživatel',
	'COMMENTS'				=> 'Odpovědi',
	'VIEW_COMMENTS'			=> 'Prohlédnout si odpovědi',
	'POST_REPLY'			=> 'Napsat odpověď',
	'TOPIC_VIEWS'			=> 'Zobrazení',
	'JUMP_NEWEST'			=> 'Přejít na nejnovější příspěvek',
	'JUMP_FIRST'			=> 'Přejít na první příspěvek',
	'JUMP_TO_POST'			=> 'Přejít na příspěvek',
	'BACK'							=> 'Zpět na zkrácenou verzi',

	// who is online
	'WIO_TOTAL'			=> 'Celkově',
	'WIO_REGISTERED'	=> 'Registrovaných',
	'WIO_HIDDEN'		=> 'Skrytých',
	'WIO_GUEST'			=> 'Návštěvníků',
	//'RECORD_ONLINE_USERS'=> 'View record: <strong>%1$s</strong><br />%2$s',

	// Birthday
	'BIRTHDAYS_AHEAD'              => 'Během příštích %s dní',
	'NO_BIRTHDAYS_AHEAD'        => 'Během této doby nemá žádný uživatel narozeniny.',

	// user menu
	'USER_MENU'			=> 'Uživatelské menu',
	'UM_LOG_ME_IN'		=> 'Zapamatovat',
	'UM_HIDE_ME'		=> 'Skrýt mě',
	'UM_MAIN_SUBSCRIBED'=> 'Přihlásit ke sledování fór',
	'UM_BOOKMARKS'		=> 'Záložky',

	// statistics
	/*
	'ST_NEW'		=> 'New',
	'ST_NEW_POSTS'	=> 'New post',
	'ST_NEW_TOPICS'	=> 'New topic',
	'ST_NEW_ANNS'	=> 'New announcment',
	'ST_NEW_STICKYS'=> 'New sticky',
	*/
	'ST_TOP'		=> 'Celkové údaje',
	'ST_TOP_ANNS'	=> 'Celkem oznámení',
	'ST_TOP_STICKYS'=> 'Celkem důležitých',
	'ST_TOT_ATTACH'	=> 'Celkem příloh',

	// search
	'SH'		=> 'hledej',
	'SH_SITE'	=> 'fóra',
	'SH_POSTS'	=> 'příspěvky',
	'SH_AUTHOR'	=> 'autor',
	'SH_ENGINE'	=> 'vyhledávače',
	'SH_ADV'	=> 'pokročilé hledání',
	
	// recent
	'RECENT_NEWS'		=> 'Poslední články',
	'RECENT_TOPIC'		=> 'Poslední témata',
	'RECENT_ANN'		=> 'Poslední oznámení',
	'RECENT_HOT_TOPIC'	=> 'Poslední oblíbená témata',

	// random member
	'RND_MEMBER'	=> 'Náhodný uživatel',
	'RND_JOIN'		=> 'Registrace',
	'RND_POSTS'		=> 'Příspěvky',
	'RND_OCC'		=> 'Zaměstnání',
	'RND_FROM'		=> 'Bydliště',
	'RND_WWW'		=> 'Webové stránky',

	// top poster
	'TOP_POSTER'	=> 'Nejaktivnější uživatelé',
	'USERNAMEPORTAL'	=> 'Uživ. jméno',
	
	// attachments
	'DOWNLOADS'	=> 'Počet stažení',
	'FILESIZEPORTAL'	=> 'Velikost',

	// links
	'LINKS'	=> 'Odkazy',

	// latest members
	'LATEST_MEMBERS'	=> 'Poslední uživatelé',

	// make donation
	'DONATION' 		=> 'Poskytněte příspěvek',
	'DONATION_TEXT'	=> 'bylo vytvořeno poskytovat služby bez potřeby zisku. Kdokoliv chce podpořit tento projekt,  může přispět na provoz hostingu, domény apod.',
	'PAY_MSG'		=> 'Po výběru částky, kterou chcete přispět, pokračujte kliknutím na obrázek PayPalu.',
	'PAY_ITEM'		=> 'Poskytněte příspěvek', // paypal item

	// main menu
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Obsah',
	'M_GALLERY'		=> 'Galerie',
	'M_ACP'		=> 'Administrace',
	'M_HELP'	=> 'Nápověda',
	'M_BBCODE'	=> 'Průvodce BBCode',
	'M_TERMS'	=> 'Podmínky pro užívání',
	'M_PRV'		=> 'Ochrana soukromí',
	'M_SEARCH'	=> 'Hledej',

	// link us
	'LINK_US'		=> 'Odkaz na naše stránky',
	'LINK_US_TXT'	=> 'Prosím, odkazujte na naše stránky <strong>%s</strong>. Použijte k tomu následující HTML kód:',

	// friends
	'FRIENDS'				=> 'Přátelé',
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'Nejsou definováni žádní přátelé',
	'NO_FRIENDS_OFFLINE'	=> 'Žádní přátelé offline',
	'NO_FRIENDS_ONLINE'		=> 'Žádní přátelé online',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'Návštěvy posledních %s botů',
	
	// wordgraph
	'WORDGRAPH'				=> 'Graf slov',

	// change style
	'BOARD_STYLE'			=> 'Styl boardu',
	'STYLE_CHOOSE'			=> 'Vyber styl',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'Žádní administrátoři',
	'NO_MODERATORS_P'		=> 'Žádní moderátoři',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'	=> 'Témat za den <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Témat za den <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Příspěvků za den <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Příspěvků za den <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Uživatelů za den <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Uživatelů za den <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Témat na uživatele <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Témat na uživatele <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Příspěvků na uživatele <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Příspěvků na uživatele <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Příspěvků na téma <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Příspěvků na téma <strong>0</strong>',

	// Poll
	'POLL'					=> 'Ankety',
	'LATEST_POLLS'			=> 'Nejnovější ankety',
	'NO_OPTIONS'			=> 'tato anketa nemá žádné možnosti k výběru.',
	'NO_POLL'				=> 'Nejsou dostupné žádné ankety',
	'RETURN_PORTAL'			=> '%sNávrat na portál%s',

	// other
	'CLOCK'		=> 'Hodiny',
	'SPONSOR'	=> 'Sponzoři',
	
	// new version of the portal
	'VIEWING_PORTAL'         => 'Stránka portálu',
	'VIEW_LATEST_ANNOUNCEMENT'   => '1 oznámení',
  'VIEW_LATEST_ANNOUNCEMENTS'   => '%d oznámení',
  'NO_ATTACHMENTS'                  => 'Žádné přílohy',
  'NO_LINKS' => 'No links',
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'Mini_Cal_calendar'		=> 'Kalendář',
	'Mini_Cal_add_event'	=> 'Přidej událost',
	'Mini_Cal_events'		=> 'Blížící se události',
	'Mini_Cal_no_events'	=> 'Nic',
	'Mini_cal_this_event'	=> 'Tento měsíc dovolená',
	'View_next_month'		=> 'následující měsíc',
	'View_previous_month'	=> 'předchozí měsíc',

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
			'1'	=> 'Po',
			'2'	=> 'Út',
			'3'	=> 'St',
			'4'	=> 'Čt',
			'5'	=> 'Pá',
			'6'	=> 'So',
			'7'	=> 'Ne',
		),

		'month'	=> array(
			'1'	=> 'Led',
			'2'	=> 'Úno',
			'3'	=> 'Bře',
			'4'	=> 'Dub',
			'5'	=> 'Kvě',
			'6'	=> 'Čer',
			'7'	=> 'Črv',
			'8'	=> 'Srp',
			'9'	=> 'Zář',
			'10'=> 'Říj',
			'11'=> 'Lis',
			'12'=> 'Pro',
		),

		'long_month'=> array(
			'1'	=> 'Leden',
			'2'	=> 'Únor',
			'3'	=> 'Březen',
			'4'	=> 'Duben',
			'5'	=> 'Květen',
			'6'	=> 'Červen',
			'7'	=> 'Červenec',
			'8'	=> 'Srpen',
			'9'	=> 'Září',
			'10'=> 'Říjen',
			'11'=> 'Listopad',
			'12'=> 'Prosinec',
		),
	),
));

?>