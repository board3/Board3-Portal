<?php
/**
*
* @package Board3 Portal v2 - Links
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
	'PORTAL_LINKS'		=> 'Ссылки',
	'LINKS_NO_LINKS'	=> 'Нет ссылок', 
	
	// ACP
	'ACP_PORTAL_LINKS'				=> 'Настройки ссылок',
	'ACP_PORTAL_LINKS_EXP'			=> 'Здесь настраиваются ссылки, отображаемые в блоке ссылок портала',
	'ACP_PORTAL_LINK_TITLE'			=> 'Заголовок',
	'ACP_PORTAL_LINK_TYPE'			=> 'Тип ссылки',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'Для ссылок в пределах форума используйте "Внутренняя ссылка" для избежания нежелательных логаутов.',
	'ACP_PORTAL_LINK_INT'			=> 'Внутренняя ссылка',
	'ACP_PORTAL_LINK_EXT'			=> 'Внешняя ссылка',
	'ACP_PORTAL_LINK_ADD'			=> 'Добавить новую ссылку',
	'ACP_PORTAL_LINK_URL'			=> 'Адрес ссылки (URL)',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'Внешние ссылки:<br />Все ссылки должны содержать http://<br /><br />Внутренние ссылки:<br />Ссылки должны быть только на файлы php, например index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Права доступа к ссылке',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Выберите группы, которым разрешено видеть ссылку. Оставьте поле пустым для отображения всем пользователям.<br />Можно выбрать несколько групп, удерживая <samp>CTRL</samp>.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Открывать внешнюю ссылку в новом окне',
));
