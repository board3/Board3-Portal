<?php
/**
*
* @package Board3 Portal v2.1 - Recent
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
	'PORTAL_RECENT'				=> 'Recent',
	'PORTAL_RECENT_TOPIC'		=> 'Recent topics',
	'PORTAL_RECENT_ANN'			=> 'Recent announcements',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Recent popular topics',

	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Recent topics settings',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'This is where you customize the recent topics block.',
	'PORTAL_MAX_TOPIC'						=> 'Limit of recent announcements/hot topics',
	'PORTAL_MAX_TOPIC_EXP'				=> '0 means infinite',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Character limit for each recent topic',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> '0 means infinite',
	'PORTAL_RECENT_FORUM'					=> 'Recent topics forums',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Forum(s) we pull the topics from, leave blank to pull from all forums. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Exclude Forums',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Select "Yes" if you want to exlude the selected forums from the recent topics block, and "No" if you want to see only the selected forums in the recent topics block.',
));
