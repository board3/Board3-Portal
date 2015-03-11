<?php
/**
*
* @package Board3 Portal v2 - Poll
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
	'PORTAL_POLL'			=> 'Голосование',
	'LATEST_POLLS'			=> 'Последние голосования',
	'NO_OPTIONS'			=> 'У этого голосования нет доступных вариантов.',
	'NO_POLL'				=> 'Нет доступных голосований',
	'RETURN_PORTAL'			=> '%sВернуться к порталу%s',
	
	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Настройки голосований',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Здесь настраиваются голосования.',
	'PORTAL_POLL_TOPIC'					=> 'Отображать блок голосований',
	'PORTAL_POLL_TOPIC_EXP'			=> 'Отображать блок голосований на страницах портала.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Форумы с голосованиями',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'Укажите форумы, голосования из которых должны быть отображены порталом. Оставьте поле пустым для отображения голосований из всех форумов. Если «Исключить форумы» = «Да», выберите исключаемые форумы.<br />Если «Исключить форумы» = «Нет», выберите форумы, голосования которых хотите видеть.<br />Можно выбрать несколько форумов, удерживая <samp>CTRL</samp>.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Исключить форумы',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Выберите «Да», чтобы исключить выбранные форумы из блока голосований, и «Нет», чтобы отображались голосования только из выбранных форумов.',
	'PORTAL_POLL_LIMIT'					=> 'Количество отображаемых голосований',
	'PORTAL_POLL_LIMIT_EXP'			=> 'Количество голосований, которые будут отображаться на страницах портала.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Разрешить голосование',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Разрешить пользователям с достаточным количеством прав голосовать со страницы портала.',
	'PORTAL_POLL_HIDE'					=> 'Скрывать законченные голосования',
));
