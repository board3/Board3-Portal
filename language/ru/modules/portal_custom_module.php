<?php
/**
*
* @package Board3 Portal v2 - Custom
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
	'PORTAL_CUSTOM'		=> 'Настраиваемый блок',
	
	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Настройки настраиваемого блока',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Здесь можно настроить настраиваемый блок',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'Введённый код недостаточно длинный.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Предпросмотр',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Код настраиваемого блока',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Измените код для настраиваемого блока (HTML или BBCode).',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Права доступа к настраиваемому блоку',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Выберите группы, которым разрешено видеть настраиваемый блок. Оставьте поле пустым для отображения всем пользователям.<br />Можно выбрать несколько групп, удерживая <samp>CTRL</samp>.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Использовать BBCode',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'Можно использовать BBCode. Если BBCode не включен, то будут распознаны тэги HTML.',
));
