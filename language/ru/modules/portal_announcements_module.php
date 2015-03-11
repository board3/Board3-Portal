<?php
/**
*
* @package Board3 Portal v2 - Announcements
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
	'LATEST_ANNOUNCEMENTS'		=> 'Последние объявления',
	'GLOBAL_ANNOUNCEMENTS'		=> 'Объявления',
	'GLOBAL_ANNOUNCEMENT'		=> 'Объявление',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 объявление',
	'VIEW_LATEST_ANNOUNCEMENTS' => 'Объявлений: %d',
	'READ_FULL'					=> 'Прочитать целиком',
	'NO_ANNOUNCEMENTS'			=> 'Нет объявлений',
	'POSTED_BY'					=> 'Автор',
	'COMMENTS'					=> 'Комментариев',
	'VIEW_COMMENTS'				=> 'Просмотреть комментарии',
	'PORTAL_POST_REPLY'			=> 'Комментировать',
	'TOPIC_VIEWS'				=> 'Просмотров',
	'JUMP_NEWEST'				=> 'Перейти к новому сообщению',
	'JUMP_FIRST'				=> 'Перейти к первому сообщению',
	'JUMP_TO_POST'				=> 'Перейти к сообщению',
	
	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Настройки объявлений',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'Здесь настраивается блок объявлений.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Отображать объявления',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Отображать на портале блок объявлений.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Компактный стиль блока объявлений',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> '"Да" для компактного стиля объявлений. "Нет" для развёрнутого стиля (добавлен текст темы).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Количество тем на портал',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> '0 - без ограничений',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Количество дней для отображения объявления',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> '0 - без ограничений',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Максимальное количество символов в объявлении',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> '0 - без ограничений',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Форумы с объявлениями',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Форумы, из которых берутся объявления. Оставьте пустым, чтобы брать темы из всех форумов. Если «Исключить форумы» = «Да», выберите исключаемые форумы.<br />Если «Исключить форумы» = «Нет», выберите форумы, темы из которых должны отображаться.<br />Можно выбрать несколько форумов, удерживая <samp>CTRL</samp>.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Исключить форумы',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Выберите «Да», чтобы исключить выбранные форумы из блока объявлений, и «Нет», чтобы отображались объявления только из выбранных форумов.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Права доступа',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'Учитывать права доступа пользователей к форумам при отображении объявлений.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Включить систему архивирования',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'Если «Да», новости отобразятся в несколько страниц и появятся ссылки для их пролистывания, если «Нет» — отобразится только одна страница.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Отображать число просмотров и ответов',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Это настройка для компактного режима блоков.<br />Если «Да», счётчики ответов и просмотров будут отображаться в двух дополнительных столбцах. Если «Нет», счётчики отобразятся перед названием форума. Выберите «Нет», если есть проблема с отображением из-за нехватки ширины для двух дополнительных столбцов.',
));
