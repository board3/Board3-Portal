<?php
/**
*
* @package Board3 Portal v2 - Statistics
* @copyright (c) Board3 Group (www.board3.de)
* @translator (c) Mac (www.belgut.by)
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
$lang = array_merge($lang, array(
	'ST_TOP'		=> 'Всего',
	'ST_TOP_ANNS'	=> 'Объявлений:',
	'ST_TOP_STICKYS'=> 'Прилепленных тем:',
	'ST_TOT_ATTACH'	=> 'Вложений:',
	'TOPICS_PER_DAY_OTHER'	=> 'Тем за день: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Тем за день: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Сообщений в день: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Сообщений в день: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Посетителей за день: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Посетителей за день: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Тем на участника: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Тем на участника: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Сообщений на участника: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Сообщений на участника: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Сообщений на тему: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Сообщений на тему: <strong>0</strong>',
));
