<?php
/**
*
* @package Board3 Portal v2 - Latest Bots
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
	'LATEST_BOTS'			=> 'Последние боты',
	'LAST_VISITED_BOTS'		=> 'Последние посетившие боты',
	'LAST_VISITED_BOTS_CNT'	=> '%s последних посетивших ботов',
	'LAST_VISITED_BOT'		=> 'Последний посетивший бот',
	
	// ACP
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Настройки посетивших ботов',
	'ACP_PORTAL_BOTS_SETTINGS_EXP'			=> 'Здесь настраивается информация о посетивших ботах.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Сколько ботов отображать',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXP'	=> '0 - без ограничений',
));
