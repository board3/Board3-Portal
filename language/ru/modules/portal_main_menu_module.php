<?php
/**
*
* @package Board3 Portal v2 - Main Menu
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
	'M_MENU' 	=> 'Меню',
	'M_CONTENT'	=> 'Содержание',
	'M_ACP'		=> 'Администраторский раздел',
	'M_HELP'	=> 'Помощь',
	'M_BBCODE'	=> 'Руководство по BBCode',
	'M_TERMS'	=> 'Общие правила',
	'M_PRV'		=> 'Соглашение о конфиденциальности',
	'M_SEARCH'	=> 'Поиск по форуму',
	'MENU_NO_LINKS'	=> 'Нет ссылок', 
	
	// ACP
	'ACP_PORTAL_MENU'				=> 'Настройки меню',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Настройки ссылки',
	'ACP_PORTAL_MENU_EXP'			=> 'Здесь настраивается основное меню портала',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Изменить меню',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Здесь можно управлять ссылками основного меню.',
	'ACP_PORTAL_MENU_CAT'			=> 'Категория',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Сделать категорией',
	'ACP_PORTAL_MENU_INT'			=> 'Внутренняя ссылка',
	'ACP_PORTAL_MENU_EXT'			=> 'Внешняя ссылка',
	'ACP_PORTAL_MENU_TITLE'			=> 'Заголовок',
	'ACP_PORTAL_MENU_URL'			=> 'Адрес ссылки (URL)',
	'ACP_PORTAL_MENU_ADD'			=> 'Добавить новую ссылку',
	'ACP_PORTAL_MENU_TYPE'			=> 'Тип ссылки',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Для ссылок в пределах форума используйте "Внутренняя ссылка" для избежания нежелательных логаутов.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'Сначала необходимо создать категорию.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Внешние ссылки:<br />Все ссылки должны содержать http://<br /><br />Внутренние ссылки:<br />Ссылки должны быть только на файлы php, например index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Права доступа к ссылке',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Выберите группы, которым разрешено видеть ссылку. Оставьте поле пустым для отображения всем пользователям.<br />Можно выбрать несколько групп, удерживая <samp>CTRL</samp>.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Открывать внешнюю ссылку в новом окне',
));
