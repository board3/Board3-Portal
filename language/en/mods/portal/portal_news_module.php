<?php
/**
*
* @package Board3 Portal v2.1 - News
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
$lang = array_merge($lang, array(
	'LATEST_NEWS'			=> 'Latest news',
	'READ_FULL'				=> 'Read all',
	'NO_NEWS'				=> 'No news',
	'POSTED_BY'				=> 'Poster',
	'COMMENTS'				=> 'Comments',
	'VIEW_COMMENTS'			=> 'View comments',
	'PORTAL_POST_REPLY'		=> 'Write comments',
	'TOPIC_VIEWS'			=> 'Views',
	'JUMP_NEWEST'			=> 'Jump to newest post',
	'JUMP_FIRST'			=> 'Jump to first post',
	'JUMP_TO_POST'			=> 'Jump to post',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'News settings',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'This is where you customize the news block.',
	'PORTAL_NEWS_STYLE'					=> 'Compact news block style',
	'PORTAL_NEWS_STYLE_EXP'			=> '"Yes" means use the compact style for news. "No" means use the large style (text view).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Show all of the articles in this forum',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Includes stickies.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Number of news articles on the portal',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 means infinite',
	'PORTAL_NEWS_LENGTH'				=> 'Max length of news article',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 means infinite',
	'PORTAL_NEWS_FORUM' 				=> 'News Forums',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Forum(s) we pull the articles from, leave blank to pull from all forums. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Exclude forums',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Select "Yes" if you want to exlude the selected forums from the news block, and "No" if you want to see only the selected forums in the news block.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Enable/disable permissions',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Take forum viewing permissions into account when displaying news',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Sort in order to the newest posts',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'When activated, the newest will be sorted in order to the newest posts. When deactivated, the news will be sorted in order to the newest topic.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Enable the news archive system',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'If enabled the news archive system / page numbers will be displayed.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Display the number of replies and views',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'This setting pertains to the compact block.<br />When Yes, the number of replies and views are shown in 2 extra columns. When No, replies and views will be shown beside the forum name. Select No if you have problems with the display of the extra columns due to the extra width required.',
));
