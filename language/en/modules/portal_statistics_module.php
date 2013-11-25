<?php
/**
*
* @package Board3 Portal v2.1 - Statistics
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
	'ST_TOP'		=> 'Totals',
	'ST_TOP_ANNS'	=> 'Total Announcements:',
	'ST_TOP_STICKYS'=> 'Total Stickies:',
	'ST_TOT_ATTACH'	=> 'Total Attachments:',
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
));
