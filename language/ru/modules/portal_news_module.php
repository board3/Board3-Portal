<?php
/**
*
* @package Board3 Portal v2 - News
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
	'LATEST_NEWS'			=> 'Последние новости',
	'READ_FULL'				=> 'Прочитать целиком',
	'NO_NEWS'				=> 'Нет новостей',
	'POSTED_BY'				=> 'Автор',
	'COMMENTS'				=> 'Комментариев',
	'VIEW_COMMENTS'			=> 'Просмотреть комментарии',
	'PORTAL_POST_REPLY'		=> 'Комментировать',
	'TOPIC_VIEWS'			=> 'Просмотров',
	'JUMP_NEWEST'			=> 'Перейти к новому сообщению',
	'JUMP_FIRST'			=> 'Перейти к первому сообщению',
	'JUMP_TO_POST'			=> 'Перейти к сообщению',
	'BACK'					=> 'Назад',
	
	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Настройки новостей',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Здесь настраивается блок новостей.',
	'PORTAL_NEWS_STYLE'					=> 'Компактный стиль блока новостей',
	'PORTAL_NEWS_STYLE_EXP'			=> '"Да" для компактного стиля новостей. "Нет" для развёрнутого стиля (добавлен текст темы).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Показывать все темы форума',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Включая прилепленные.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Количество тем на портал',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 - без ограничений',
	'PORTAL_NEWS_LENGTH'				=> 'Максимальное количество символов в новости',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 - без ограничений',
	'PORTAL_NEWS_FORUM' 				=> 'Форумы с новостями',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Форумы, из которых берутся новости. Оставьте пустым, чтобы брать темы из всех форумов. Если «Исключить форумы» = «Да», выберите исключаемые форумы.<br />Если «Исключить форумы» = «Нет», выберите форумы, темы из которых должны отображаться.<br />Можно выбрать несколько форумов, удерживая <samp>CTRL</samp>.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Исключить форумы',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Выберите «Да», чтобы исключить выбранные форумы из блока новостей, и «Нет», чтобы отображались новости только из выбранных форумов.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Права доступа',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Учитывать права доступа пользователей к форумам при отображении новостей',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Сортировать по последним комментариям',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> '«Да» — новости сортируются по последнему комментарию (сообщению). «Нет» — новости сортируются по последней теме.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Включить систему архивирования',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Если «Да», новости отобразятся в несколько страниц и появятся ссылки для их пролистывания, если «Нет» — отобразится только одна страница.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Отображать количество просмотров и ответов',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Это настройка для компактного режима блоков.<br />Если «Да», счётчики ответов и просмотров будут отображаться в двух дополнительных столбцах. Если «Нет», счётчики отобразятся перед названием форума. Выберите «Нет», если есть проблема с отображением из-за нехватки ширины для двух дополнительных столбцов.',
));
