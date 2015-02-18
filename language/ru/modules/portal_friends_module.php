<?php
/**
*
* @package Board3 Portal v2 - Friends
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
	'FRIENDS'				=> 'Друзья',
	'FRIENDS_OFFLINE'		=> 'Не в сети',
	'FRIENDS_ONLINE'		=> 'В сети',
	'NO_FRIENDS'			=> 'Список друзей пуст',
	'NO_FRIENDS_OFFLINE'	=> 'Нет друзей не в сети',
	'NO_FRIENDS_ONLINE'		=> 'Нет друзей в сети',
	
	// ACP
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Настройки друзей',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXP'	=> 'Здесь настраиваются друзья.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Ограничение отображаемых друзей',
	'PORTAL_MAX_ONLINE_FRIENDS_EXP'		=> 'Максимальное количество друзей, которых можно отображать.',
));
