<?php
/**
*
* @package Board3 Portal v2 - Calendar
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
	'PORTAL_CALENDAR'			=> 'Календарь',
	'VIEW_NEXT_MONTH'		=> 'Следующий месяц',
	'VIEW_PREVIOUS_MONTH'	=> 'Предыдущий месяц',
	'EVENT_START'			=> 'От',
	'EVENT_END'				=> 'До',
	'EVENT_TIME'			=> 'Время',
	'EVENT_ALL_DAY'			=> 'Событие на весь день',
	'CURRENT_EVENTS'		=> 'Текущие события',
	'NO_CUR_EVENTS'			=> 'Нет текущих событий',
	'UPCOMING_EVENTS'		=> 'Предстоящие события',
	'NO_UPCOMING_EVENTS'	=> 'Нет предстоящих событий',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Вс',
			'2'	=> 'Пн',
			'3'	=> 'Вт',
			'4'	=> 'Ср',
			'5'	=> 'Чт',
			'6'	=> 'Пт',
			'7'	=> 'Сб',
		),

		'month'	=> array(
			'1'	=> 'Янв',
			'2'	=> 'Фев',
			'3'	=> 'Мар',
			'4'	=> 'Апр',
			'5'	=> 'Май',
			'6'	=> 'Июн',
			'7'	=> 'Июл',
			'8'	=> 'Авг',
			'9'	=> 'Сен',
			'10'=> 'Окт',
			'11'=> 'Ноя',
			'12'=> 'Дек',
		),

		'long_month'=> array(
			'1'	=> 'Январь',
			'2'	=> 'Февраль',
			'3'	=> 'Март',
			'4'	=> 'Апрель',
			'5'	=> 'Май',
			'6'	=> 'Июнь',
			'7'	=> 'Июль',
			'8'	=> 'Август',
			'9'	=> 'Сентябрь',
			'10'=> 'Октябрь',
			'11'=> 'Ноябрь',
			'12'=> 'Декабрь',
		),
	),
	
	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Настройки календаря',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Здесь настраивается календарь.',
	'ACP_PORTAL_EVENTS'						=> 'События календаря',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Цвет текущего дня',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'	=> 'Код или допустимое в HTML название цвета, например #FFFFFF для белого или имя цвета, например violet.',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Цвет для воскресенья',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'	=> 'Код или допустимое в HTML название цвета, например #FFFFFF для белого или имя цвета, например violet.',
	'PORTAL_LONG_MONTH'						=> 'Показывать полные названия месяцев',
	'PORTAL_LONG_MONTH_EXP'				=> 'Если «Нет», названия будут сокращены до трёх букв.',
	'PORTAL_SUNDAY_FIRST'					=> 'Первый день недели - воскресенье',
	'PORTAL_SUNDAY_FIRST_EXP'			=> 'Если «Нет», неделя будет начинаться с понедельника.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Отображать события',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Показывать события, которые были созданы в календаре',
	'PORTAL_EVENTS_MANAGE'					=> 'Изменять события',
	'NO_EVENT_TITLE'						=> 'Не указано название события.',
	'NO_EVENT_START'						=> 'Не указано время начала события.',
	'ADD_EVENT'								=> 'Добавить новое событие',
	'EVENT_UPDATED'							=> 'Событие обновлено.',
	'EVENT_ADDED'							=> 'Событие добавлено.',
	'NO_EVENT'								=> 'Нет выбранного события.',
	'EVENT_TITLE'							=> 'Заголовок события',
	'EVENT_DESC'							=> 'Описание события',
	'EVENT_LINK'							=> 'Ссылка на событие',
	'EVENT_LINK_EXP'						=> 'Введите ссылку на тему или сайт с анонсом или обсуждением события.',
	'NO_EVENTS'								=> 'Нет событий',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'Время начала события введено неверно. Следуйте инструкциям внимательнее.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'Время окончания события введено неверно. Следуйте инструкциям внимательнее.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'Время начала события должно быть в будущем.',
	'ACP_PORTAL_EVENT_START_DAY'			=> 'Дата начала события',
	'ACP_PORTAL_EVENT_START_DAY_EXP'		=> 'Введите дату, когда событие начнется. Дата должна быть в формате: ДД-ММ-ГГГГ',
	'ACP_PORTAL_EVENT_START_TIME'			=> 'Время начала события',
	'ACP_PORTAL_EVENT_START_TIME_EXP'		=> 'Введите время, когда событие начнется. Время должно быть в 24-х часовом формате, например 23:12',
	'ACP_PORTAL_EVENT_END_DAY'				=> 'Дата окончания события',
	'ACP_PORTAL_EVENT_END_DAY_EXP'			=> 'Введите дату, когда событие закончится. Дата должна быть в формате: ДД-ММ-ГГГГ',
	'ACP_PORTAL_EVENT_END_TIME'				=> 'Время окончания события',
	'ACP_PORTAL_EVENT_END_TIME_EXP'			=> 'Введите время, когда событие закончится. Время должно быть в 24-х часовом формате, например 23:12',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'Окончание события должно быть после начала события.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Права доступа к событию',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Выберите группы, которым можно просматривать событие. Если никого не выбрано, то видеть будут все.<br />Можно выбрать несколько групп, удерживая <samp>CTRL</samp>.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Открывать внешние ссылки в событии в новом окне',
	
	
	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Обновленное событие</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Добавленное событие</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Удаленное событие</strong><br />&raquo; %s',
));
