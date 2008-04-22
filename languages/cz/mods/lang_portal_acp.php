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
	'ACP_PORTAL_INFO_SETTINGS'			=> 'Základní nastavení',
	'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'	=> 'Děkujeme pro výběr řešení board3 Portal. Na této stránce můžete nastavovat portál Vašeho boardu. Obrázky Vám poskytnou přehled o všech možných nastaveních. Odkazy na levé straně obrazovky Vám umožňují kontrolovat každý aspekt Vašeho portálu.',

	'ACP_PORTAL_SETTINGS'				=> 'Nastavení portálu',
	'ACP_PORTAL_SETTINGS_EXPLAIN'		=> 'Děkujeme pro výběr řešení board3 Portal. Na této stránce můžete nastavovat portál Vašeho boardu. Obrázky Vám poskytnou přehled o všech možných nastaveních. Odkazy na levé straně obrazovky Vám umožňují kontrolovat každý aspekt Vašeho portálu.',

	// general
	'ACP_PORTAL_GENERAL_INFO'				=> 'Administrace portálu',
	'ACP_PORTAL_GENERAL_INFO_EXPLAIN'		=> 'Děkujeme pro výběr řešení board3 Portal. Na této stránce můžete nastavovat portál Vašeho boardu. Obrázky Vám poskytnou přehled o všech možných nastaveních. Odkazy na levé straně obrazovky Vám umožňují kontrolovat každý aspekt Vašeho portálu.',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'Základní nastavení',
	'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit hlavní nastavení i určitá specifická nastavení.',
	'PORTAL_ADVANCED_STAT'					=> 'Blok Pokročilé statistiky',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Zobrazit tento blok na portálu.',
	'PORTAL_LEADERS'						=> 'Blok Vedoucí / tým',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_CLOCK'							=> 'Blok Hodiny',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Zobrazit tento blok na portálu.',
	'PORTAL_LINK_US'						=> 'Blok Odkaz na naše stránky',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_LINKS'							=> 'Blok Odkazy',
	'PORTAL_LINKS_EXPLAIN'					=> 'Zobrazit tento blok na portálu.',
	'PORTAL_BIRTHDAYS'						=> 'Blok Narozeniny',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Počet dní',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'Kolik dní dopředu se má informace o narozeninách zobrazovat.',
	'PORTAL_SEARCH'							=> 'Blok Hledej',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Zobrazit tento blok na portálu.',
	'PORTAL_WELCOME'						=> 'Blok Vítejte',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_WHOIS_ONLINE'							=> 'Blok Kdo je online?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'					=> 'Zobrazit tento blok na portálu.',
	'PORTAL_CHANGE_STYLE'							=> 'Změna stylu',
	'PORTAL_CHANGE_STYLE_EXPLAIN'					=> 'Zobrazit tento blok na portálu.<br /><span style="color:red">Prosím, mějte na mysli:</span> if "Přepsat uživatelský styl:" v nastavení boardu na "Ano", tento blok <u>nebude zobrazen</u>, nazávisle na tomto nastavení.',
	'PORTAL_FRIENDS'						=> 'Blok Přátelé',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limit počtu zobrazených přátel',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Limit počtu přátel, kteří se na portálu zobrazují.',
	'PORTAL_MAIN_MENU'						=> 'Hlavní menu',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_USER_MENU'						=> 'Blok Uživatelské menu / Přihlášení',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',

	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Blok Náhodný uživatel',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Zobrazit tento blok na portálu.',

	// global announcements
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Globální oznámení',
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Nastavení globálních oznámení',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'Zde můžete změnit nastavení Globálních oznámení a další specifická nastavení.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Zobrazit globální oznámení',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Blok kompaktního stylu pro globální oznámení',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> 'Když je vybráno Ano, bude pro globální oznámení použit kompaktní styl, v případě vybrání Ne bude použit objemný styl',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Počet oznámení na portálu',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 znamená neomezený počet',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Počet dní, po které se bude oznámení zobrazovat',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 znamená neomezený počet',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maximální délka globálních oznámení',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 znamená neomezený počet',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'ID globálních oznámení fóra',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Články se berou z fóra, nechte prázdné pro všechna fóra, oddělte čárkou pro více fór, např. 1,2,5',

	// news
	'ACP_PORTAL_NEWS_INFO'				=> 'Novinky',
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Nastaveni novinek',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Novinek a další specifická nastavení.',
	'PORTAL_NEWS'						=> 'Blok zobrazení Novinek',
	'PORTAL_NEWS_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_NEWS_STYLE'					=> 'Blok kompaktního stylu novinek',
	'PORTAL_NEWS_STYLE_EXPLAIN'			=> 'Když je vybráno Ano, bude pro novinky použit kompaktní styl, v případě vybrání Ne bude použit objemný styl.',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Zobrazit všechny články v tomto fóru',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'		=> 'Včetně důležitých a oznámení.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Počet článků s novinkami na portálu',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'		=> '0 znamená neomezený počet',
	'PORTAL_NEWS_LENGTH'				=> 'Maximální délka článku s novinkami',
	'PORTAL_NEWS_LENGTH_EXPLAIN'		=> '0 znamená neomezený počet',
	'PORTAL_NEWS_FORUM'					=> 'ID novinek z fóra',
	'PORTAL_NEWS_FORUM_EXPLAIN'			=> 'Články se berou z fóra, nechte prázdné pro všechna fóra, oddělte čárkou pro více fór, např. 1,2,5',
	'PORTAL_EXCLUDE_FORUM'				=> 'Vyloučit ID fóra',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'		=> 'Články se berou z fóra, nechte prázdné pro všechna fóra, oddělte čárkou pro více fór, např. 1,2,5',

	// recent topics
	'ACP_PORTAL_RECENT_INFO'				=> 'Poslední témata',
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Nastavení Posledních témat',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Posledních témat a další specifická nastavení.',
	'PORTAL_RECENT'							=> 'Blok zobrazení Posledních témat',
	'PORTAL_RECENT_EXPLAIN'					=> 'Zobrazit tento blok na portálu.',
	'PORTAL_MAX_TOPIC'						=> 'Omezení počtu posledních oznámení/vzrušujících témat',
	'PORTAL_MAX_TOPIC_EXPLAIN'				=> '0 znamená neomezený počet',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Limit počtu znaků pro poslední téma',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'		=> '0 znamená neomezený počet',

	// paypal
	'ACP_PORTAL_PAYPAL_INFO'				=> 'Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Nastaveni Paypalu',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Paypalu a další specifická nastavení.',
	'PORTAL_PAY_C_BLOCK'					=> 'Blok zobrazení Paypalu',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Zobrazit tento blok na portálu.',
	'PORTAL_PAY_S_BLOCK'					=> 'Blok zobrazení malého paypalu',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Zobrazit tento blok na portálu.',
	'PORTAL_PAY_ACC'						=> 'Účet na Paypalu, který se má použít',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Zadejte Váš e-mail používaný na Paypalu, např. xxx@xxx.com',

	// last member
	'ACP_PORTAL_MEMBERS_INFO'				=> 'Poslední uživatelé',
	'ACP_PORTAL_MEMBERS_SETTINGS'			=> 'Nastavení Posledních uživatelů',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Posledních uživatelů a další specifická nastavení.',
	'PORTAL_LATEST_MEMBERS'					=> 'Blok zobrazení Posledních uživatelů',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'			=> 'Zobrazit tento blok na portálu.',
	'PORTAL_MAX_LAST_MEMBER'				=> 'Limit počtu zobrazených posledních uživatelů',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'		=> '0 znamená neomezený počet',

	// bots
	'ACP_PORTAL_BOTS_INFO'						=> 'Návštěvy botů',
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Nastavení Návštěv botů',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'Zde můžete změnit nastavení Návštěv botů a další specifická nastavení.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Blok zobrazení Návštěv botů',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Zobrazit tento blok na portálu.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Kolik botů se má zobrazit',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 znamená neomezený počet',

	// polls   
	'ACP_PORTAL_POLLS_INFO'				=> 'Anketa',
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Nastavení anket',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Anket a další specifická nastavení.',
	'PORTAL_POLL_TOPIC'					=> 'Blok zobrazení Anket',
	'PORTAL_POLL_TOPIC_EXPLAIN'			=> 'Zobrazit tento blok na portálu.',
	'PORTAL_POLL_TOPIC_ID'				=> 'ID anket z fóra',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'		=> 'IDčka fór, jejichž ankety by měly být zobrazeny. Pro použití více IDček fór použijte pro jejich oddělení čárku nebo nechte prázdné pro použití všech fór.',
	'PORTAL_POLL_LIMIT'					=> 'Limit počtu zobrazených anket',
	'PORTAL_POLL_LIMIT_EXPLAIN'			=> 'Počet anket, které by se měly na portále zobrazit.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Umožnit hlasování',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Umožnit uživatelům s potřebnými právy hlasovat ze stránek portálu.',

	// most poster
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Největší přispěvovatelé',
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'Nastavení Největších přispěvovatelů',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Největších přispěvovatelů a další specifická nastavení.',
	'PORTAL_TOP_POSTERS'                  		=> 'Blok zobrazení Největších přispěvovatelů',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_MAX_MOST_POSTER'					=> 'Kolik největších přispěvovatelů se má zobrazit',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 znamená neomezený počet',

	// left and right collumn width 
	'ACP_PORTAL_COLLUMN_WIDTH_INFO'				=> 'Šířka sloupce',
	'ACP_PORTAL_COLLUMN_WIDTH_SETTINGS'			=> 'Nastavení šířky levého a pravého sloupce',
	'PORTAL_LEFT_COLLUMN_WIDTH'					=> 'Hodnota šířky levého sloupce',
	'PORTAL_LEFT_COLLUMN_WIDTH_EXPLAIN'			=> 'Nastavte šířku levého sloupce v pixelech, doporučená hodnota je 180',
	'PORTAL_RIGHT_COLLUMN_WIDTH'				=> 'Hodnota šířky pravého sloupce',
	'PORTAL_RIGHT_COLLUMN_WIDTH_EXPLAIN'		=> 'Nastavte šířku pravého sloupce v pixelech, doporučená hodnota je 180',

	// attachments    
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'				=> 'Přílohy',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Nastavení Příloh',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Příloh a další specifická nastavení.',
	'PORTAL_ATTACHMENTS'								=> 'Blok zobrazení Příloh',
	'PORTAL_ATTACHMENTS_EXPLAIN'						=> 'Zobrazit tento blok na portálu.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limit počtu zobrazených příloh',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 znamená neomezený počet',
	
	// friends
	'ACP_PORTAL_FRIENDS_INFO'				=> 'Přátelé',
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Nastavení Přátel',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Přátel a další specifická nastavení.',
	'PORTAL_FRIENDS'						=> 'Blok zobrazení Přátel',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Zobrazit tento blok na portálu',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limit počtu zobrazených přátel',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Maximální počet přátel, kteří se můžou zobrazit.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_INFO'				=> 'Graf slov',
	'ACP_PORTAL_WORDGRAPH_SETTINGS'			=> 'Nastavení Grafu slov',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Wordgraph a další specifická nastavení.',
	'PORTAL_WORDGRAPH'						=> 'Blok zobrazení Grafu slov',
	'PORTAL_WORDGRAPH_EXPLAIN'				=> 'Zobrazit tento blok na portálu.<br /><strong>Graf slov není funkční, jestiže fulltextové mysql je vybráno jako prohledávací proces.</strong>',
	'PORTAL_WORDGRAPH_MAX_WORDS'			=> 'Kolik slov se má zobrazit',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 znamená neomezený počet',
	'PORTAL_WORDGRAPH_WORD_COUNTS'			=> 'Zahrnout počet hodnot k zobrazení',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Zobrazit počet hodnot na slovo, např. (25).',
	'PORTAL_WORDGRAPH_RATIO'				=> 'Použít velikost slov založenou na četnosti',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'		=> 'Změnit poměr (větší/menší) velikost slova (defaultně=18)',

	// welcome message
	'ACP_PORTAL_WELCOME_INFO'				=> 'Vítejte',
	'ACP_PORTAL_WELCOME_SETTINGS'			=> 'Nastavení Vítejte',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Vítejte a další specifická nastavení.',
	'PORTAL_WELCOME_INTRO'					=> 'Uvítací zpráva',
	'PORTAL_WELCOME_GUEST'					=> 'Uvítací zpráva pouze pro návštěvníky?',
	'PORTAL_WELCOME_INTRO_EXPLAIN'			=> 'Změňte uvítání (jen obyčejný text). Max. 600 znaků!',

	// minicalendar
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Kalendář',
	'ACP_PORTAL_MINICALENDAR_SETTINGS'			=> 'Nastavení Kalendáře',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> 'Zde můžete změnit nastavení Kalendáře a další specifická nastavení.',
	'PORTAL_MINICALENDAR'						=> 'Blok zobrazení Kalendáře',
	'PORTAL_MINICALENDAR_EXPLAIN'				=> 'Zobrazit tento blok na portálu.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'			=> 'Aktivovat jinou barvu pro každý den',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'Barvy se zadávají v HEXa tvaru jako např. #FFFFFF pro bílou, nebo anglickým pojmenováním, např. vilolet.',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR'		=> 'Barva odkazu na den',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'=> 'Barvy se zadávají v HEXa tvaru jako např. #FFFFFF pro bílou, nebo anglickým pojmenováním, např. vilolet.',


));

?>