<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// Manage categories
$lang = array_merge($lang, array(
	'BIRTHDAYS_AHEAD'				=> 'In den nächsten %s Tagen',
	'NO_BIRTHDAYS_AHEAD'			=> 'In diesem Zeitraum hat kein Mitglied Geburtstag',
));

// Common
$lang = array_merge($lang, array(
	// ACP - General Settings
	'ACP_PORTAL_GENERAL_TITLE'			=> 'Portal administration',
	'ACP_PORTAL_GENERAL_TITLE_EXP'		=> 'Thank you for choosing Board3 Portal! This is where you can manage your portal page. The options below let you customize the various general settings. The links on the left-hand side allow you to customize in detail every aspect of your portal experience.',
	'ACP_PORTAL_GENERAL_SETTINGS'		=> 'General settings',
	'PORTAL_ENABLE'						=> 'Enable Portal',
	'PORTAL_ENABLE_EXP'					=> 'Turns the whole portal on or off.',
	'PORTAL_LEFT_COLUMN'				=> 'Enable left column',
	'PORTAL_LEFT_COLUMN_EXP'			=> 'Switch to no if you wish to turn off the left column',
	'PORTAL_RIGHT_COLUMN'				=> 'Enable right column',
	'PORTAL_RIGHT_COLUMN_EXP'			=> 'Switch to no if you wish to turn off the right column',
	'PORTAL_VERSION_CHECK'				=> 'Versioncheck on Portal',
	'PORTAL_FORUM_INDEX'				=> 'Forum Index (Forum list)',
	'PORTAL_FORUM_INDEX_EXP'			=> 'Display this block on the portal.',
	
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'	=> 'Left and right column width settings',
	'PORTAL_LEFT_COLUMN_WIDTH'			=> 'Width of the left column',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'		=> 'Change the width of the left column in pixels; recommended value is 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'			=> 'Width of the right column',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'		=> 'Change the width of the right column in pixels; recommended value is 180',
	

	'POSTERS'		=> 'Posters',

	// Search engine names
	'SEARCH_A9'					=> 'A9.com',
	'SEARCH_ACRONYM_FINDER'		=> 'AcronymFinder',
	'SEARCH_ALEXA'				=> 'Alexa',
	'SEARCH_ALTA_VISTA'			=> 'AltaVista',
	'SEARCH_AMAZON'				=> 'Amazon',
	'SEARCH_AOL'				=> 'AOL',
	'SEARCH_ASK'				=> 'Ask.com',
	'SEARCH_BAAMBOO'			=> 'BaamBoo',
	'SEARCH_BIT_TORRENT'		=> 'BitTorrent',
	'SEARCH_CREATIVE_COMMONS'	=> 'Crative Commons',
	'SEARCH_EBAY'				=> 'Ebay',
	'SEARCH_GOOGLE'				=> 'Google',
	'SEARCH_LIVE'				=> 'Bing',
	'SEARCH_LYCOS'				=> 'Lycos',
	'SEARCH_MININOVA'			=> 'Mininova',
	'SEARCH_REFERENCE'			=> 'Reference.com',
	'SEARCH_SOURCE_FORGE'		=> 'SourceForge',
	'SEARCH_TORRENT_PORTAL'		=> 'TorrentPortal',
	'SEARCH_TORRENT_SPY'		=> 'TorrentSpy',
	'SEARCH_TORRENTZ'			=> 'TorrentZ',
	'SEARCH_VDICT'				=> 'VDict',
	'SEARCH_WIKI_PEDIA'			=> 'WikiPedia',
	'SEARCH_YAHOO'				=> 'Yahoo! Search',

	'WELCOME_YOU'	=> 'Welcome you',

	// paypal
	'PORTAL_PAY_ACC'							=> 'Paypal Account',
	'PORTAL_PAY_ACC_EXP'					=> 'Gib deine e-mail-Adresse an, die du bei Paypal benutzt, z.B. xxx@xxx.com',

// User menu
	'UM_LOG_ME_IN'					=> 'Mich bei jedem Besuch automatisch anmelden',
	'UM_HIDE_ME'					=> 'Meinen Online-Status während dieser Sitzung verbergen',
	'UM_MAIN_SUBSCRIBED'			=> 'Benachrichtigungen verwalten',
	'UM_BOOKMARKS'					=> 'Lesezeichen verwalten',
	'M_MENU' 						=> 'Menü',
	'M_ACP'							=> 'Administrations-Bereich',

	// search
	'GO'								=> 'Los',
	'SEARCH_BOARD'						=> 'Foren',
	'SEARCH_SERVICE'					=> 'Suchmaschinen',
	'SEARCH_LOOKUP'						=> 'Lookup',
	'SEARCH_TORRENT'					=> 'Torrent',
	'SEARCH_ADV'						=> 'erweiterte Suche',
	
// Styles
	'STYLE_CHOOSE'			=> '',
	
// Friends
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'Derzeit sind keine Freunde definiert',
	'NO_FRIENDS_OFFLINE'	=> 'Keine Freunde offline',
	'NO_FRIENDS_ONLINE'		=> 'Keine Freunde online',
	
// Statistics
	'ST_TOP'					=> 'Insgesamt',
	'ST_TOP_ANNS'				=> 'Bekanntmachungen insgesamt:',
	'ST_TOP_STICKYS'			=> 'Wichtig insgesamt:',
	'ST_TOT_ATTACH'				=> 'Dateianhänge insgesamt:',
	
	'TOPICS_PER_DAY_OTHER'		=> 'Themen pro Tag: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'		=> 'Themen pro Tag: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'		=> 'Beiträge pro Tag: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'		=> 'Beiträge pro Tag: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'		=> 'Benutzer pro Tag: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'		=> 'Benutzer pro Tag: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'		=> 'Themen pro Benutzer: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'		=> 'Themen pro Benutzer: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'		=> 'Beiträge pro Benutzer: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'		=> 'Beiträge pro Benutzer: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'		=> 'Beiträge pro Thema: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'		=> 'Beiträge pro Thema: <strong>0</strong>',

	
// PayPal
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
));
?>