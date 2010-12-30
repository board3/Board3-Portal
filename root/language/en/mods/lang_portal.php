<?php

/**
*
* @package - Board3portal
* @version $Id: lang_portal.php 508 2009-06-09 14:02:54Z Christian_N $
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
	'WELCOME'				=> 'Welcome',
	
	'PORTAL_INSTALL'			=> 'Installation directory detected',
	'PORTAL_INSTALL_TEXT'		=> 'An installation file has been detected. If you want to update your portal (or any other mod), please execute the installer. If you have already done so, please remove or rename the directory for security reasons.',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'Latest global announcements',
	'GLOBAL_ANNOUNCEMENT'	=> 'Global announcement',
	'VIEW_LATEST_ANNOUNCEMENT'   => '1 announcement',
	'VIEW_LATEST_ANNOUNCEMENTS'   => '%d announcements',
	'LATEST_NEWS'			=> 'Latest news',
	'READ_FULL'				=> 'Read all',
	'NO_NEWS'				=> 'No news',
	'NO_ANNOUNCEMENTS'		=> 'No global announcements',
	'POSTED_BY'				=> 'Poster',
	'COMMENTS'				=> 'Comments',
	'VIEW_COMMENTS'			=> 'View comments',
	'POST_REPLY'			=> 'Write comments',
	'TOPIC_VIEWS'			=> 'Views',
	'JUMP_NEWEST'			=> 'Jump to newest post',
	'JUMP_FIRST'			=> 'Jump to first post',
	'JUMP_TO_POST'			=> 'Jump to post',
	'BACK'							=> 'Back',

	// Birthday
	'BIRTHDAYS_AHEAD'              => 'In the next %s days',
	'NO_BIRTHDAYS_AHEAD'        => 'No members have a birthday within this period of time.',

	// user menu
	'USER_MENU'			=> 'User menu',
	'UM_LOG_ME_IN'		=> 'Remember me',
	'UM_HIDE_ME'		=> 'Hide me',
	'UM_MAIN_SUBSCRIBED'=> 'Subscribed',
	'UM_BOOKMARKS'		=> 'Bookmarks',

	// statistics
	'ST_TOP'		=> 'Totals',
	'ST_TOP_ANNS'	=> 'Total Announcements:',
	'ST_TOP_STICKYS'=> 'Total Stickies:',
	'ST_TOT_ATTACH'	=> 'Total Attachments:',

	// search
	'SH'		=> 'Go',
	'SH_SITE'	=> 'Forums',
	'SH_POSTS'	=> 'Posts',
	'SH_AUTHOR'	=> 'Author',
	'SH_ENGINE'	=> 'Search engines',
	'SH_ADV'	=> 'Advanced search',
	
	// recent
	'RECENT_NEWS'		=> 'Recent',
	'RECENT_TOPIC'		=> 'Recent topics',
	'RECENT_ANN'		=> 'Recent announcements',
	'RECENT_HOT_TOPIC'	=> 'Recent popular topics',

	// random member
	'RND_MEMBER'	=> 'Random member',
	'RND_JOIN'		=> 'Join',
	'RND_POSTS'		=> 'Posts',
	'RND_OCC'		=> 'Occupation',
	'RND_FROM'		=> 'Location',
	'RND_WWW'		=> 'Web page',

	// top poster
	'TOP_POSTER'	=> 'Peak posters',
	
	// attachments
	'DOWNLOADS'			=> 'Downloads',
	'NO_ATTACHMENTS'	=> 'No attachments',

	// links
	'LINKS'				=> 'Links',
	'NO_LINKS'			=> 'No links', 
	
	// latest members
	'LATEST_MEMBERS'	=> 'Newest members',

	// make donation
	'DONATION' 		=> 'PayPal donations',
	'DONATION_TEXT'	=> 'is a group supplying services with no intention of any monetary profit. Your donations are welcome so that the cost of our server, domain name, etc. can be covered.',
	'PAY_MSG'       => 'Please use a decimal point (not a comma) as the separator, e.g. 3.50',
	'PAY_ITEM'		=> 'Donate!', // paypal item

	'AUD'						=> 'Australian Dollars (AUD)',
	'CAD'						=> 'Canadian Dollars (CAD)',
	'CZK'						=> 'Czech Koruna (CZK)',
	'DKK'						=> 'Danish Kroner (DKK)',
	'HKD'						=> 'Hong Kong Dollars (HKD)',
	'HUF'						=> 'Hungarian Forint (HUF)',
	'NZD'						=> 'New Zealand Dollars (NZD)',
	'NOK'						=> 'Norwegian Kroner (NOK)',
	'PLN'						=> 'Polish Zlotych (PLN)',
	'GBP'						=> 'British Pounds (GBP)',
	'SGD'						=> 'Singapore Dollars (SGD)',
	'SEK'						=> 'Swedish Kronor (SEK)',
	'CHF'						=> 'Swiss Francs (CHF)',
	'JPY'						=> 'Japanese Yen (JPY)',
	'USD'						=> 'U.S. Dollars (USD)',
	'EUR'						=> 'Euros (EUR)',
	'MXN'						=> 'Mexican Pesos (MXN)',
	'ILS'						=> 'Israeli New Shekels (ILS)',
	
	// main menu
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Content',
	'M_ACP'		=> 'ACP',
	'M_HELP'	=> 'Help',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Terms of use',
	'M_PRV'		=> 'Privacy policy',
	'M_SEARCH'	=> 'Search',

	// link us
	'LINK_US'		=> 'Link to us',
	'LINK_US_TXT'	=> 'Please feel free to link to <strong>%s</strong>. Use the following HTML:',

	// friends
	'FRIENDS'				=> 'Friends',
	'FRIENDS_OFFLINE'		=> 'Offline',
	'FRIENDS_ONLINE'		=> 'Online',
	'NO_FRIENDS'			=> 'No friends currently defined',
	'NO_FRIENDS_OFFLINE'	=> 'No friends offline',
	'NO_FRIENDS_ONLINE'		=> 'No friends online',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'Last %s visited bots',
	
	// wordgraph
	'WORDGRAPH'				=> 'Wordgraph',

	// change style
	'BOARD_STYLE'			=> 'Board style',
	'STYLE_CHOOSE'			=> 'Select a style',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'No Administrators',
	'NO_MODERATORS_P'		=> 'No Moderators',
	'NO_GROUPS_P'			=> 'No Groups',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'	=> 'Topics per day: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Topics per day: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Posts per day: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Posts per day: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Users per day: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Users per day: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Topics per user: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Topics per user: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Posts per user: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Posts per user: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Posts per topic: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Posts per topic: <strong>0</strong>',

	// Poll
	'POLL'					=> 'Poll',
	'LATEST_POLLS'			=> 'Latest Polls',
	'NO_OPTIONS'			=> 'This poll has no available options.',
	'NO_POLL'				=> 'No polls available',
	'RETURN_PORTAL'			=> '%sReturn to the portal%s',

	// other
	'VIEWING_PORTAL'         => 'Portal page',
	'CLOCK'		=> 'Clock',
	'SPONSOR'	=> 'Sponsors',
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'MINI_CALENDAR'			=> 'Calendar',
	'VIEW_NEXT_MONTH'		=> 'next month',
	'VIEW_PREVIOUS_MONTH'	=> 'Previous month',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Su',
			'2'	=> 'Mo',
			'3'	=> 'Tu',
			'4'	=> 'We',
			'5'	=> 'Th',
			'6'	=> 'Fr',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Jan.',
			'2'	=> 'Feb.',
			'3'	=> 'Mar.',
			'4'	=> 'Apr.',
			'5'	=> 'May',
			'6'	=> 'Jun.',
			'7'	=> 'Jul.',
			'8'	=> 'Aug.',
			'9'	=> 'Sep.',
			'10'=> 'Oct.',
			'11'=> 'Nov.',
			'12'=> 'Dec.',
		),

		'long_month'=> array(
			'1'	=> 'January',
			'2'	=> 'February',
			'3'	=> 'March',
			'4'	=> 'April',
			'5'	=> 'May',
			'6'	=> 'June',
			'7'	=> 'July',
			'8'	=> 'August',
			'9'	=> 'September',
			'10'=> 'October',
			'11'=> 'November',
			'12'=> 'December',
		),
	),
));

?>