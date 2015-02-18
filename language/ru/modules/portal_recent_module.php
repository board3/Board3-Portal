<?php
/**
*
* @package Board3 Portal v2 - Recent
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
	'PORTAL_RECENT'				=> 'Свежие темы',
	'PORTAL_RECENT_TOPIC'		=> 'Обсуждения',
	'PORTAL_RECENT_ANN'			=> 'Объявления',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Популярные',
	
	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Настройки блока «Свежие темы»',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'Здесь вы можете управлять свежими темами.',
	'PORTAL_MAX_TOPIC'						=> 'Количество свежих тем в блоке',
	'PORTAL_MAX_TOPIC_EXP'				=> '0 — без ограничений',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Ограничение количества символов',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> '0 — без ограничений',
	'PORTAL_RECENT_FORUM'					=> 'Форумы со свежими темами',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Форумы, из которых извлекаются свежие темы. Оставьте пустым, чтобы брать темы из всех форумов. Если «Исключить форумы» = «Да», выберите исключаемые форумы.<br />Если «Исключить форумы» = «Нет», выберите форумы, темы из которых должны отображаться.<br />Можно выбрать несколько форумов, удерживая <samp>CTRL</samp>.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Исключить форумы',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Выберите «Да», чтобы исключить выбранные форумы из блока свежих тем, и «Нет», чтобы отображались свежие темы только из выбранных форумов.',
));
