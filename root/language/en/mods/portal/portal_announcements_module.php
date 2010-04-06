<?php
/**
* @package Portal - Topposters
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'LATEST_ANNOUNCEMENTS'	=> 'Latest global announcements',
	'GLOBAL_ANNOUNCEMENT'	=> 'Global announcement',
	'VIEW_LATEST_ANNOUNCEMENT'   => '1 announcement',
	'VIEW_LATEST_ANNOUNCEMENTS'   => '%d announcements',
	'READ_FULL'				=> 'Read all',
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
));

?>