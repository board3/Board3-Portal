<?php

/**
*
* @package - Board3portal
* @version $Id: lang_portal_acp.php 666 2010-07-28 14:40:39Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
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
	// general
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portal administration',
	'ACP_PORTAL_GENERAL_TITLE_EXPLAIN'		=> 'Thank you for choosing Board3 Portal! This is where you can manage your portal page. The options below let you customize the various general settings. The links on the left-hand side allow you to customize in detail every aspect of your portal experience.',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'General settings',
	'PORTAL_ENABLE'							=> 'Enable Portal',
	'PORTAL_ENABLE_EXPLAIN'					=> 'Turns the whole portal on or off.',
	'PORTAL_LEFT_COLUMN'					=> 'Enable left column',
	'PORTAL_LEFT_COLUMN_EXPLAIN'			=> 'Switch to no if you wish to turn off the left column',
	'PORTAL_RIGHT_COLUMN'					=> 'Enable right column',
	'PORTAL_RIGHT_COLUMN_EXPLAIN'			=> 'Switch to no if you wish to turn off the right column',
	'PORTAL_VERSION_CHECK'					=> 'Versioncheck on Portal',
	'PORTAL_ADVANCED_STAT'					=> 'Advanced statistics block',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_LEADERS'						=> 'Leaders / Team block',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_LEADERS_EXT'					=> 'Extended Leaders / Team',
	'PORTAL_LEADERS_EXT_EXPLAIN'			=> 'The "Leaders / Team" block must be activated in order to display this extended block.<br />The standard block lists all admins/mods, while the extended block includes all non-hidden groups with a legend.',
	'PORTAL_CLOCK'							=> 'Clock block',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Display this block on the portal.',
	'PORTAL_LINK_US'						=> 'Link us block',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_SEARCH'							=> 'Search block',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Display this block on the portal.',
	'PORTAL_WELCOME'						=> 'Welcome center block',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_WHOIS_ONLINE'					=> 'Who is online?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_CHANGE_STYLE'					=> 'Styleswitcher',
	'PORTAL_CHANGE_STYLE_EXPLAIN'			=> 'Display this block on the portal.<br /><span style="color:red;">Please note:</span> If "Override user style:" in the board settings is set to "Yes", this block will <strong>not</strong> be displayed, regardless of this setting.',
	'PORTAL_MAIN_MENU'						=> 'Main menu',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_PHPBB_MENU'						=> 'phpBB menu',
	'PORTAL_PHPBB_MENU_EXPLAIN'				=> 'Display the phpBB Header on the portal.',
	'PORTAL_USER_MENU'						=> 'User menu / Login box',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_FORUM_INDEX'					=> 'Forum Index (Forum list)',
	'PORTAL_FORUM_INDEX_EXPLAIN'			=> 'Display this block on the portal.',
	'BLOCK_CHANGE_WARN'						=> 'Please be aware that turning off all blocks will leave your portal page empty.<br />Also, if you are disabling all blocks in one side column please just turn off that column. Else you will have an empty space on your portal.',
	
	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Random member block',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Display this block on the portal.',
	
	// news and announcements
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Display the number of replies and views',
	'PORTAL_SHOW_REPLIES_VIEWS_EXPLAIN'		=> 'This setting pertains to the compact block.<br />When Yes, the number of replies and views are shown in 2 extra columns. When No, replies and views will be shown beside the forum name. Select No if you have problems with the display of the extra columns due to the extra width required.',

	// birthdays
	'ACP_PORTAL_BIRTHDAYS_SETTINGS'			=> 'Birthdays Settings',
	'ACP_PORTAL_BIRTHDAYS_SETTINGS_EXPLAIN'	=> 'This is where you customize the birthday block.',
	'PORTAL_BIRTHDAYS'						=> 'Birthday block',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Birthdays ahead days',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'How many days to look ahead for future birthdays.<br />"0" will disable the ahead birthdays list.',
	
	// global announcements
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Global announcements settings',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'This is where you customize the global announcements block.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Display global announcements',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Compact global announcements block style',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> '"Yes" means use the compact style for for global announcements. "No" means use the large style (text view).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Number of announcements on the portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 means infinite',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Number of days to display the announcement',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 means infinite',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maximum size/length of global announcements',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 means infinite',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Announcements forums',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Forum(s) from which we retrieve the announcements. Leave this blank to retrieve announcements from all the forums. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Exclude forums',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXPLAIN'=> 'Select "Yes" if you want to exlude the selected forums from the announcements block, and "No" if you want to see only the selected forums in the announcements block.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Enable/disable permissions',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXPLAIN'	=> 'When displaying announcements, consider a user&apos;s forum-viewing permissions.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Enable the announcements archive system',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXPLAIN'		=> 'If enabled the announcements archive system / page numbers will be displayed.',

	// news
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'News settings',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'This is where you customize the news block.',
	'PORTAL_NEWS'						=> 'Display news block',
	'PORTAL_NEWS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_NEWS_STYLE'					=> 'Compact news block style',
	'PORTAL_NEWS_STYLE_EXPLAIN'			=> '"Yes" means use the compact style for news. "No" means use the large style (text view).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Show all of the articles in this forum',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'		=> 'Includes stickies.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Number of news articles on the portal',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'		=> '0 means infinite',
	'PORTAL_NEWS_LENGTH'				=> 'Max length of news article',
	'PORTAL_NEWS_LENGTH_EXPLAIN'		=> '0 means infinite',
	'PORTAL_NEWS_FORUM' 				=> 'News Forums',
	'PORTAL_NEWS_FORUM_EXPLAIN' 		=> 'Forum(s) we pull the articles from, leave blank to pull from all forums. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Exclude forums',
	'PORTAL_NEWS_EXCLUDE_EXPLAIN'		=> 'Select "Yes" if you want to exlude the selected forums from the news block, and "No" if you want to see only the selected forums in the news block.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Enable/disable permissions',
	'PORTAL_NEWS_PERMISSIONS_EXPLAIN'	=> 'Take forum viewing permissions into account when displaying news',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Sort in order to the newest posts',
	'PORTAL_NEWS_SHOW_LAST_EXPLAIN'		=> 'When activated, the newest will be sorted in order to the newest posts. When deactivated, the news will be sorted in order to the newest topic.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Enable the news archive system',
	'PORTAL_NEWS_ARCHIVE_EXPLAIN'		=> 'If enabled the news archive system / page numbers will be displayed.',

	// recent topics
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Recent topics settings',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'This is where you customize the recent topics block.',
	'PORTAL_RECENT'							=> 'Display recent topics block',
	'PORTAL_RECENT_EXPLAIN'					=> 'Display this block on the portal.',
	'PORTAL_MAX_TOPIC'						=> 'Limit of recent announcements/hot topics',
	'PORTAL_MAX_TOPIC_EXPLAIN'				=> '0 means infinite',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Character limit for each recent topic',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'		=> '0 means infinite',
	'PORTAL_RECENT_FORUM'					=> 'Recent topics forums',
	'PORTAL_RECENT_FORUM_EXPLAIN'			=> 'Forum(s) we pull the topics from, leave blank to pull from all forums. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Exclude Forums',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'			=> 'Select "Yes" if you want to exlude the selected forums from the recent topics block, and "No" if you want to see only the selected forums in the recent topics block.',

	// paypal
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypal settings',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'This is where you customize the Paypal block.',
	'PORTAL_PAY_C_BLOCK'					=> 'Display paypal center block',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_PAY_S_BLOCK'					=> 'Display paypal small block',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_PAY_ACC'						=> 'Paypal account to use',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Enter your Paypal e-mail address eg. xxx@xxx.com',

	// newest members
	'ACP_PORTAL_MEMBERS_SETTINGS'			=> 'Newest members settings',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'This is where you customize the newest members block.',
	'PORTAL_LATEST_MEMBERS'					=> 'Display newest members block',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_MAX_LAST_MEMBER'				=> 'Maximum number of newest members shown',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'		=> '0 means infinite',

	// bots
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Visiting bots settings',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'This is where you customize the visiting bots block.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Display visiting bots block',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Display this block on the portal.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'How many bots to display',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 means infinite',

	// polls   
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Poll settings',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'This is where you customize the poll block.',
	'PORTAL_POLL_TOPIC'					=> 'Display poll blocks',
	'PORTAL_POLL_TOPIC_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Poll forum(s)',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'		=> 'The forum(s) from which the polls should be displayed. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Exclude Forums',
	'PORTAL_POLL_EXCLUDE_ID_EXPLAIN'	=> 'Select "Yes" if you want to exlude the selected forums from the polls block, and "No" if you only want to see the polls from the selected forums in the polls block.',
	'PORTAL_POLL_LIMIT'					=> 'Poll display limit',
	'PORTAL_POLL_LIMIT_EXPLAIN'			=> 'The number of polls you would like to display on the portal page.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Allow voting',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Allow users with the required permissions to vote from the portal page.',
	'PORTAL_POLL_HIDE'					=> 'Hide expired polls?',

	// peak posters
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'Peak posters settings',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'This is where you customize the peak posters block.',
	'PORTAL_TOP_POSTERS'                  		=> 'Display peak/top posters block',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_MAX_MOST_POSTER'					=> 'How many users to display',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 means infinite',

	// left and right column width 
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'	=> 'Left and right column width settings',
	'PORTAL_LEFT_COLUMN_WIDTH'			=> 'Width of the left column',
	'PORTAL_LEFT_COLUMN_WIDTH_EXPLAIN'	=> 'Change the width of the left column in pixels; recommended value is 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'			=> 'Width of the right column',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXPLAIN'	=> 'Change the width of the right column in pixels; recommended value is 180',

	// attachments    
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Attachments settings',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'This is where you customize the attachments block.',
	'PORTAL_ATTACHMENTS'								=> 'Display attachments block',
	'PORTAL_ATTACHMENTS_EXPLAIN'						=> 'Display this block on the portal.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limit of displayed attachments',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 means infinite',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Attachments forums',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'				=> 'The forum(s) from which the attachments should be displayed. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Exclude forums',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXPLAIN'			=> 'Select "Yes" if you want to exlude the selected forums from the attachments block, and "No" if you want to see only the attachments of the selected forums in the attachments block.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Character limit for each attachments',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXPLAIN'				=> '0 means infinite',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Filetypes',
	'PORTAL_ATTACHMENTS_FILETYPE_EXPLAIN' 				=> 'If "Exclude filetypes" is set to "Yes", select the filetypes you want to exclude.<br />If "Exclude filetypes" is set to "No" select the filetypes you want to see.<br />Select/Deselect multiple filetypes by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Exclude filetypes',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXPLAIN'				=> 'Select "Yes" if you want to exlude the selected filetypes from the attachments block, and "No" if you want to see only the selected filetypes in the attachments block.',

	// friends
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Friends Settings',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'This is where you customize the friends block.',
	'PORTAL_FRIENDS'						=> 'Display friends block',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Limit of displayed friends',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'The maximum number of friends displayed.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_SETTINGS'			=> 'Wordgraph settings',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'This is where you customize the wordgraph block.',
	'PORTAL_WORDGRAPH'						=> 'Display wordgraph block',
	'PORTAL_WORDGRAPH_EXPLAIN'				=> 'Display this block on the portal.<br /><strong>Wordgraph does not work when fulltext mysql is selected as the search backend.</strong>',
	'PORTAL_WORDGRAPH_MAX_WORDS'			=> 'How many words to display',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 means infinite',
	'PORTAL_WORDGRAPH_WORD_COUNTS'			=> 'Display word count',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Display the number of occurrences of each word, eg. (25).',
	'PORTAL_WORDGRAPH_RATIO'				=> 'Text size aspect ratio',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'		=> 'Change the aspect ratio (bigger/smaller) for the words, based on their popularity (default=18).',

	// welcome message
	'ACP_PORTAL_WELCOME_SETTINGS'			=> 'Welcome settings',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'This is where you customize the welcome message block.',
	'PORTAL_WELCOME_INTRO'					=> 'Welcome message',
	'PORTAL_WELCOME_GUEST'					=> 'Welcome message only for guests?',
	'PORTAL_WELCOME_INTRO_EXPLAIN'			=> 'Change the welcome message (BBCode is allowed).',
	
	// links
	'ACP_PORTAL_LINKS_SETTINGS' 		=> 'Link Settings',
	'ACP_PORTAL_LINKS_SETTINGS_EXPLAIN'	=> 'Customize the links listed in the links block.',
	'PORTAL_LINKS'						=> 'Links block',
	'PORTAL_LINKS_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_LINK_TEXT'					=> 'Text/URL',
	'PORTAL_LINK_TEXT_EXPLAIN'			=> 'The text, followed by the url for the link. Use the buttons to delete and reorder the links. Don’t forget the http:// !',
	'PORTAL_ADD_LINK_TEXT'				=> 'Add link',
	'PORTAL_ADD_LINK_TEXT_EXPLAIN'		=> 'Click the text to create a new link.',
	'PORTAL_LINK_ADD'					=> '<strong>Add</strong>',

	// custom
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Custom blocks settings',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXPLAIN'	=> 'Here you can change your custom blocks. These blocks could be filled with HTML or BBCode for several purposes like advertisements, videos, images, flash or text. Just insert the desired code.',
	'ACP_PORTAL_CUSTOM_SMALL_SETTINGS'		=> 'Custom blocks settings for the small block',
	'PORTAL_CUSTOM_SMALL_HEADLINE'			=> 'Headline for the small custom block',
	'PORTAL_CUSTOM_SMALL_HEADLINE_EXPLAIN'	=> 'Here you can change the headline for the small custom block.',
	'PORTAL_CUSTOM_SMALL'					=> 'Display the small custom block',
	'PORTAL_CUSTOM_SMALL_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_CUSTOM_SMALL_BBCODE'			=> 'Activate BBCode for the small custom block',
	'PORTAL_CUSTOM_SMALL_BBCODE_EXPLAIN'	=> 'BBCode could be used in this box. If BBCode is not activated, HTML will be parsed.',
	'PORTAL_CUSTOM_CODE_SMALL'				=> 'Code for the small custom block',
	'PORTAL_CUSTOM_CODE_SMALL_EXPLAIN'		=> 'Change the code for the small custom block (HTML or BBCode) here.',
	'ACP_PORTAL_CUSTOM_CENTER_SETTINGS'		=> 'Custom blocks settings for the center block',
	'PORTAL_CUSTOM_CENTER'					=> 'Display the center custom block',
	'PORTAL_CUSTOM_CENTER_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_CUSTOM_CENTER_HEADLINE'			=> 'Headline for the center custom block',
	'PORTAL_CUSTOM_CENTER_HEADLINE_EXPLAIN'	=> 'Here you can change the headline for the center custom block.',
	'PORTAL_CUSTOM_CENTER_BBCODE'			=> 'Activate BBCode for the center custom block',
	'PORTAL_CUSTOM_CENTER_BBCODE_EXPLAIN'	=> 'BBCode could be used in this box. If BBCode is not activated, HTML will be parsed.',
	'PORTAL_CUSTOM_CODE_CENTER'				=> 'Code for the center custom block',
	'PORTAL_CUSTOM_CODE_CENTER_EXPLAIN'		=> 'Change the code for the small custom block (HTML or BBCode) here.',

	// minicalendar
	'ACP_PORTAL_MINICALENDAR_SETTINGS'			=> 'Mini calendar settings',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> 'This is where you customize the mini calendar block.',
	'PORTAL_MINICALENDAR'						=> 'Display mini calendar block',
	'PORTAL_MINICALENDAR_EXPLAIN'				=> 'Display this block on the portal.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'			=> 'Active day color',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'HEX or named colors are allowed such as #FFFFFF for white, or color names like violet.',
	'PORTAL_MINICALENDAR_SUNDAY_COLOR'			=> 'Color for sunday',
	'PORTAL_MINICALENDAR_SUNDAY_COLOR_EXPLAIN'	=> 'HEX or named colors are allowed such as #FFFFFF for white, or color names like violet.',
	'PORTAL_LONG_MONTH'							=> 'Show full month names',
	'PORTAL_LONG_MONTH_EXPLAIN'					=> 'If disabled the months will be shortened e.g. Aug. instead of August.',
	'PORTAL_SUNDAY_FIRST'						=> 'First day of the week',
	'PORTAL_SUNDAY_FIRST_EXPLAIN'				=> 'If disabled the calendar will show Mo. --> Su., else Su. --> Sa.',
));

/**
* A copy of Handyman` s MOD version check, to view it on the portal general settings
*/
$lang = array_merge($lang, array(
	'ANNOUNCEMENT_TOPIC'	=> 'Release Announcement',
	'CURRENT_VERSION'		=> 'Current Version',
	'DOWNLOAD_LATEST'		=> 'Download Latest Version',
	'LATEST_VERSION'		=> 'Latest Version',
	'NO_INFO'				=> 'Version server could not be contacted',
	'NOT_UP_TO_DATE'		=> '%s is not up to date',
	'RELEASE_ANNOUNCEMENT'	=> 'Annoucement Topic',
	'UP_TO_DATE'			=> '%s is up to date',
	'VERSION_CHECK'			=> 'MOD Version Check',
));

?>