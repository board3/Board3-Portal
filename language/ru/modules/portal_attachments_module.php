<?php
/**
*
* @package Board3 Portal v2 - Attachments
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
	'DOWNLOADS'				=> 'Скачиваний',
	'NO_ATTACHMENTS'		=> 'Нет вложений',
	'PORTAL_ATTACHMENTS'	=> 'Блок вложений',
	
	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Настройка вложений',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'Здесь настраивается блок вложений.',
	'PORTAL_ATTACHMENTS_EXP'						=> 'Отображать на портале.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Количество отображаемых вложений',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> '0 - без ограничений',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Форумы с вложениями',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'Форумы, откуда отображаются вложения.<br />Если в пункте "Исключить форумы" выбрано значение "Да", укажите форумы, вложения которых хотите исключить.<br />Если в пункте "Исключить форумы" выбрано значение "Нет", укажите форумы, вложения которых хотите видеть в блоке вложений.<br />Можно выбрать несколько типов файлов, удерживая <samp>CTRL</samp>.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Исключить форумы',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Выберите "Да", если хотите исключить темы из выбранных форумов в блоке вложений, и выберите "Нет", если хотите, чтобы вложения из выбранных форумов отображались в этом блоке.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Ограничение количества символов для каждого вложения',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> '0 - без ограничений',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Типы файлов',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> '>Если в пункте "Исключить типы файлов" выбрано значение "Да", укажите типы файлов, вложения которых хотите исключить.<br />Если в пункте "Исключить типы файлов" выбрано значение "Нет", укажите типы файлов, вложения которых хотите видеть в блоке вложений.<br />Можно выбрать несколько типов файлов, удерживая <samp>CTRL</samp>.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Исключить типы файлов',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Выберите "Да", если хотите исключить выбранные типы файлов в блоке вложений, и выберите "Нет", если хотите, чтобы вложения с выбранными типами файлов отображались в этом блоке.',
));
