<?php
/**
*
* @package Board3 Portal v2.1 - Announcements
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
	'LATEST_ANNOUNCEMENTS'		=> 'Latest global announcements',
	'GLOBAL_ANNOUNCEMENTS'		=> 'Global announcements',
	'GLOBAL_ANNOUNCEMENT'		=> 'Global announcement',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 announcement',
	'VIEW_LATEST_ANNOUNCEMENTS' => '%d announcements',
	'READ_FULL'					=> 'Read all',
	'NO_ANNOUNCEMENTS'			=> 'No global announcements',
	'POSTED_BY'					=> 'Poster',
	'COMMENTS'					=> 'Comments',
	'VIEW_COMMENTS'				=> 'View comments',
	'PORTAL_POST_REPLY'			=> 'Write comments',
	'TOPIC_VIEWS'				=> 'Views',
	'JUMP_NEWEST'				=> 'Jump to newest post',
	'JUMP_FIRST'				=> 'Jump to first post',
	'JUMP_TO_POST'				=> 'Jump to post',

	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Global announcements settings',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'This is where you customize the global announcements block.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Display global announcements',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Display this block on the portal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Compact global announcements block style',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> '"Yes" means use the compact style for global announcements. "No" means use the large style (text view).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Number of announcements on the portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> '0 means infinite',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Number of days to display the announcement',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> '0 means infinite',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maximum size/length of global announcements',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> '0 means infinite',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Announcements forums',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Forum(s) from which we retrieve the announcements. Leave this blank to retrieve announcements from all the forums. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Exclude forums',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Select "Yes" if you want to exlude the selected forums from the announcements block, and "No" if you want to see only the selected forums in the announcements block.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Enable/disable permissions',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'When displaying announcements, consider a user&apos;s forum-viewing permissions.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Enable the announcements archive system',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'If enabled the announcements archive system / page numbers will be displayed.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Display the number of replies and views',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'This setting pertains to the compact block.<br />When Yes, the number of replies and views are shown in 2 extra columns. When No, replies and views will be shown beside the forum name. Select No if you have problems with the display of the extra columns due to the extra width required.',
));
