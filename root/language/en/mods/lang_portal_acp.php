<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( You - http://www.yourdomain.com )
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
	'ACP_PORTAL_INFO_SETTINGS'			=> 'General settings',
	'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'	=> 'Thank you for choosing board3 Portal. On this page you can manage the portal of your board. The screens inhere will give you a quick overview of all the various portal settings. The links on the left hand side of this screen allow you to control every aspect of your portal experience.',

	'ACP_PORTAL_SETTINGS'				=> 'Portal settings',
	'ACP_PORTAL_SETTINGS_EXPLAIN'		=> 'Thank you for choosing board3 Portal. On this page you can manage the portal of your board. The screens inhere will give you a quick overview of all the various portal settings. The links on the left hand side of this screen allow you to control every aspect of your portal experience.',

	// general
	'ACP_PORTAL_GENERAL_INFO'				=> 'Portal administration',
	'ACP_PORTAL_GENERAL_INFO_EXPLAIN'		=> 'Thank you for choosing board3 Portal. On this page you can manage the portal of your board. The screens inhere will give you a quick overview of all the various portal settings. The links on the left hand side of this screen allow you to control every aspect of your portal experience.',
	'ACP_PORTAL_VERSION'						=> '<strong>Board3 Portal Version v%s</strong>',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'General settings',
	'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'	=> 'Here you can change your general and certain specific options.',
	'PORTAL_ADVANCED_STAT'					=> 'Advanced statistics block',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Display this block on portal.',
	'PORTAL_LEADERS'						=> 'Leaders / team block',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_CLOCK'							=> 'Clock block',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Display this block on portal.',
	'PORTAL_LINK_US'						=> 'Link us block',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_LINKS'							=> 'Links block',
	'PORTAL_LINKS_EXPLAIN'					=> 'Display this block on portal.',
	'PORTAL_BIRTHDAYS'						=> 'Birthday block',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Birthdays ahead days',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'How many days to look ahead for birthdays.',
	'PORTAL_SEARCH'							=> 'Search block',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Display this block on portal.',
	'PORTAL_WELCOME'						=> 'Welcome center block',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_WHOIS_ONLINE'							=> 'Who is online?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'					=> 'Display this block on portal.',
	'PORTAL_CHANGE_STYLE'							=> 'Styleswitcher',
	'PORTAL_CHANGE_STYLE_EXPLAIN'					=> 'Display this block on portal.<br /><span style="color:red">Please note:</span> if "Override user style:" in the board settings is set to "Yes", this block <u>wont be displayed</u>, independent of this settings.',
	'PORTAL_FRIENDS'						=> 'Friends block',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limit of displayed online friends',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Limit display of online friends in portal block to a certain value.',
	'PORTAL_MAIN_MENU'						=> 'Main menu',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_USER_MENU'						=> 'User menu / Login box',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Display this block on portal.',

	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Random member block',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Display this block on portal.',

	// global announcements
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Global announcements',
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Global announcements settings',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'Here you can change your global announcment information and certain specific options.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Display global announcements',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Compact global announcements block style',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> 'If select yes use compact style for global announcements, no is large style',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Number of announcements on portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 means infinite',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Number of days to display the announcement',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 means infinite',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Max length of global announcements',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 means infinite',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Global global announcements forum ID',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Forum we pull the articles from, leave blank to pull from all forums, separate by comma for multi-forums, eg. 1,2,5',

	// news
	'ACP_PORTAL_NEWS_INFO'				=> 'News',
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'News settings',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'Here you can change your news information and certain specific options.',
	'PORTAL_NEWS'						=> 'Display news block',
	'PORTAL_NEWS_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_NEWS_STYLE'					=> 'Compact news block style',
	'PORTAL_NEWS_STYLE_EXPLAIN'			=> 'If select yes use compact style for news, no is large style.',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Show all of the articles in this forum',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'		=> 'Including stickies.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Number of news articles on portal',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'		=> '0 means infinite',
	'PORTAL_NEWS_LENGTH'				=> 'Max length of news article',
	'PORTAL_NEWS_LENGTH_EXPLAIN'		=> '0 means infinite',
	'PORTAL_NEWS_FORUM'					=> 'News Forum ID',
	'PORTAL_NEWS_FORUM_EXPLAIN'			=> 'Forum we pull the articles from, leave blank to pull from all forums, separate by comma for multi-forums, eg. 1,2,5',
	'PORTAL_EXCLUDE_FORUM'				=> 'Exclude Forum ID',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'		=> 'Forum we pull the articles from, leave blank to pull from all forums, separate by comma for multi-forums, eg. 1,2,5',

	// recent topics
	'ACP_PORTAL_RECENT_INFO'				=> 'Recent topics',
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Recent topics settings',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'Here you can change your recent topics information and certain specific options.',
	'PORTAL_RECENT'							=> 'Display recent topics block',
	'PORTAL_RECENT_EXPLAIN'					=> 'Display this block on portal.',
	'PORTAL_MAX_TOPIC'						=> 'Limit of recent announcements/hot topics',
	'PORTAL_MAX_TOPIC_EXPLAIN'				=> '0 means infinite',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Character limit for recent topic',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'		=> '0 means infinite',

	// paypal
	'ACP_PORTAL_PAYPAL_INFO'				=> 'Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypal settings',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Here you can change your Paypal information and certain specific options.',
	'PORTAL_PAY_C_BLOCK'					=> 'Display paypal center block',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Display this block on portal.',
	'PORTAL_PAY_S_BLOCK'					=> 'Display paypal small block',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Display this block on portal.',
	'PORTAL_PAY_ACC'						=> 'Paypal account to use',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Enter your on Paypal used e-mail address eg. xxx@xxx.com',

	// last member
	'ACP_PORTAL_MEMBERS_INFO'				=> 'Latest members',
	'ACP_PORTAL_MEMBERS_SETTINGS'			=> 'Latest members settings',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'Here you can change your latest members information and certain specific options.',
	'PORTAL_LATEST_MEMBERS'					=> 'Display latest members block',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'			=> 'Display this block on portal.',
	'PORTAL_MAX_LAST_MEMBER'				=> 'Limit of displayed latest members',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'		=> '0 means infinite',

	// bots
	'ACP_PORTAL_BOTS_INFO'						=> 'Visiting bots',
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Visiting bots settings',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'Here you can change your visiting bots information and certain specific options.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Display visiting bots block',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Display this block on portal.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'How many bots to display',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 means infinite',

	// polls   
	'ACP_PORTAL_POLLS_INFO'				=> 'Poll',
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Poll settings',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'Here you can change your poll information and certain specific options.',
	'PORTAL_POLL_TOPIC'					=> 'Display poll blocks',
	'PORTAL_POLL_TOPIC_EXPLAIN'			=> 'Display this block on portal.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Poll forum id(s)',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'		=> 'The id(s) of the forums from which the polls should be displayed. Use a comma to separate multiple forums, or leave blank to use all available forums.',
	'PORTAL_POLL_LIMIT'					=> 'Poll display limit',
	'PORTAL_POLL_LIMIT_EXPLAIN'			=> 'The number of polls you would like to display on the portal page.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Allow voting',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Allow users with the required permissions to vote from the portal page.',

	// most poster
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'Most poster',
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'Most poster settings',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'Here you can change your most poster information and certain specific options.',
	'PORTAL_TOP_POSTERS'                  		=> 'Display most/top posters block',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_MAX_MOST_POSTER'					=> 'How many most posters to display',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 means infinite',

	// left and right collumn width 
	'ACP_PORTAL_COLLUMN_WIDTH_INFO'				=> 'Collumn width',
	'ACP_PORTAL_COLLUMN_WIDTH_SETTINGS'			=> 'Left and right collumn width settings',
	'PORTAL_LEFT_COLLUMN_WIDTH'					=> 'Width value of the left collumn',
	'PORTAL_LEFT_COLLUMN_WIDTH_EXPLAIN'			=> 'Change the width of left collumn in pixel, recommended value 180',
	'PORTAL_RIGHT_COLLUMN_WIDTH'				=> 'Width value of the right collumn',
	'PORTAL_RIGHT_COLLUMN_WIDTH_EXPLAIN'		=> 'Change the width of right collumn in pixel, recommended value 180',

	// attachments    
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'				=> 'Attachments',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Attachments settings',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Here you can change your attachments information and certain specific options.',
	'PORTAL_ATTACHMENTS'								=> 'Display attachments block',
	'PORTAL_ATTACHMENTS_EXPLAIN'						=> 'Display this block on portal.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limit of displayed attachments',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 means infinite',
	'PORTAL_ATTACHMENTS_FORUM_IDS'							=> 'Attachments forum id(s)',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'				=> 'The id(s) of the forums from which the attachments should be displayed. Use a comma to separate multiple forums, or leave blank to use all available forums.',
	
	// friends
	'ACP_PORTAL_FRIENDS_INFO'				=> 'Friends',
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Friends Settings',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'Here you can change your friends information and certain specific options.',
	'PORTAL_FRIENDS'						=> 'Display friends block',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Display attachments block',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limit of displayed friends',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Limits the amound of displayed friends to the given value.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_INFO'				=> 'Wordgraph',
	'ACP_PORTAL_WORDGRAPH_SETTINGS'			=> 'Wordgraph settings',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'Here you can change your wordgraph information and certain specific options.',
	'PORTAL_WORDGRAPH'						=> 'Display wordgraph block',
	'PORTAL_WORDGRAPH_EXPLAIN'				=> 'Display this block on portal.<br /><strong>Wordgraph does not work when fulltext mysql is selected as the search backend.</strong>',
	'PORTAL_WORDGRAPH_MAX_WORDS'			=> 'How many words to display',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 means infinite',
	'PORTAL_WORDGRAPH_WORD_COUNTS'			=> 'Include count values to display',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Display count values per word eg. (25).',
	'PORTAL_WORDGRAPH_RATIO'				=> 'Used aspect ratio word size',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'		=> 'Change the aspect ratio (bigger/smaler) word size (default=18)',

	// welcome message
	'ACP_PORTAL_WELCOME_INFO'				=> 'Welcome',
	'ACP_PORTAL_WELCOME_SETTINGS'			=> 'Welcome settings',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'Here you can change welcome messages and certain specific options.',
	'PORTAL_WELCOME_INTRO'					=> 'Welcome message',
	'PORTAL_WELCOME_GUEST'					=> 'Welcome message only for guests?',
	'PORTAL_WELCOME_INTRO_EXPLAIN'			=> 'Change the welcome message (BBCode is allowed). Max. 600 characters!',

	// minicalendar
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini calendar',
	'ACP_PORTAL_MINICALENDAR_SETTINGS'			=> 'Mini calendar settings',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> 'Here you can change your mini calendar information and certain specific options.',
	'PORTAL_MINICALENDAR'						=> 'Display mini calendar block',
	'PORTAL_MINICALENDAR_EXPLAIN'				=> 'Display this block on portal.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'			=> 'Active day color',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'HEX or named colors are allowed such as #FFFFFF for white, or color names like vilolet.',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR'		=> 'Day link color',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'=> 'HEX or named colors are allowed such as #FFFFFF for white, or color names like vilolet.',


));

?>