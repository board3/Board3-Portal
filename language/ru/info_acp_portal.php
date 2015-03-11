<?php
/**
*
* @package Board3 Portal v2
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
	// Portal Modules
	'ACP_PORTAL_MODULES'			=> 'Модули портала',
	'ACP_PORTAL_MODULES_EXP'		=> 'Здесь вы можете управлять модулями портала.',
	
	'MODULE_POS_TOP'				=> 'Верхнее меню',
	'MODULE_POS_LEFT'				=> 'Левая колонка',
	'MODULE_POS_RIGHT'				=> 'Правая колонка',
	'MODULE_POS_CENTER'				=> 'Центральная колонка',
	'MODULE_POS_BOTTOM'				=> 'Нижнее меню',
	'ADD_MODULE'					=> 'Добавить модуль',
	'CHOOSE_MODULE'					=> 'Выбрать модуль',
	'CHOOSE_MODULE_EXP'				=> 'Выберите модуль из выпадающего списка',
	'SUCCESS_ADD'					=> 'Модуль добавлен успешно.',
	'SUCCESS_DELETE'				=> 'Модуль удален успешно.',
	'NO_MODULES'					=> 'Модулей не обнаружено.',
	'MOVE_RIGHT'					=> 'Сдвинуть вправо',
	'MOVE_LEFT'						=> 'Сдвинуть влево',
	'B3P_FILE_NOT_FOUND'			=> 'Запрашиваемый файл не найден.',
	'UNABLE_TO_MOVE'				=> 'Невозможно переместить блок в выбранную колонку.',
	'UNABLE_TO_MOVE_ROW'			=> 'Невозможно переместить блок в выбранную строку.',
	'DELETE_MODULE_CONFIRM'			=> 'Вы уверены, что хотите удалить модуль "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Настройки сброшены успешно.',
	'MODULE_RESET_CONFIRM'			=> 'Вы уверены, что хотите сбросить настройки модуля "%1$s"?',
	
	'MODULE_OPTIONS'			=> 'Настройки модуля',
	'MODULE_NAME'				=> 'Имя модуля',
	'MODULE_NAME_EXP'			=> 'Введите имя модуля, которое будет отображаться в настройках.',
	'MODULE_IMAGE'				=> 'Изображение модуля',
	'MODULE_IMAGE_EXP'			=> 'Укажите имя файла с изображением модуля. Изображение должно быть размещено  в styles/*yourstyle*/theme/images/portal/ folders',
	'MODULE_PERMISSIONS'		=> 'Права доступа к модулю',
	'MODULE_PERMISSIONS_EXP'	=> 'Выберите группы, которые будут иметь право на просмотр модуля. Если вы хотите предоставить право видеть модуль всем, ничего не выбирайте.<br />Для множественного выбора удерживайте клавишу <b>CTRL</b>.',
	'MODULE_IMAGE_WIDTH'		=> 'Ширина изображения модуля',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Введите ширину изображения в пикселях',
	'MODULE_IMAGE_HEIGHT'		=> 'Высота изображения модуля',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Введите высоту изображения в пикселях',
	'MODULE_RESET'				=> 'Сбросить настройки модуля',
	'MODULE_RESET_EXP'			=> 'Все настройки будут сброшены к настройкам по умолчанию',
	'MODULE_STATUS'				=> 'Активировать модуль',
	'MODULE_ADD_ONCE'			=> 'Модуль может быть подключен только 1 раз.',
	'MODULE_IMAGE_ERROR'		=> 'Ошибка при проверке изображения модуля:',

	// general
	'ACP_PORTAL'							=> 'Портал',
	'ACP_PORTAL_GENERAL_INFO'				=> 'Основные настройки',
	'ACP_PORTAL_CONFIG_INFO'				=> 'Основные настройки',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Администрирование портала',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Спасибо за выбор Board3 Portal! Здесь вы можете управлять страницей портала. Следующие настройки помогут вам сконфигурировать отображение портала.',
	'PORTAL_ENABLE'							=> 'Включить портал',
	'PORTAL_ENABLE_EXP'						=> 'Полностью включить или отключить портал',
	'PORTAL_LEFT_COLUMN'					=> 'Включить левую колонку',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Выберите нет, если хотите отключить левую колонку',
	'PORTAL_RIGHT_COLUMN'					=> 'Включить правую колонку',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Выберите нет, если хотите отключить правую колонку',
	'PORTAL_VERSION_CHECK'					=> 'Проверка версии на портале',
	'PORTAL_PHPBB_MENU'						=> 'phpBB меню',
	'PORTAL_PHPBB_MENU_EXP'					=> 'Отображать phpbb шапку на портале',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Отображать jumpbox',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Отображать jumpbox на портале',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Настройки ширины левой и правой колонок',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Ширина левой колонки',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Укажите ширину левой колонки в пикселях: рекомендуемое значение 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Ширина правой колонки',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Укажите ширину правоц колонки в пикселях: рекомендуемое значение 180',
	
	'LINK_ADDED'							=> 'Ссылка успешно добавлена',
	'LINK_UPDATED'							=> 'Ссылка успешно обновлена',
	'LOG_PORTAL_LINK_ADDED'					=> '<strong>Измененные настройки портала</strong><br />&raquo; Добавлена ссылка: %s ',
	'LOG_PORTAL_LINK_REMOVED'				=> '<strong>Измененные настройки портала</strong><br />&raquo; Удалена ссылка: %s ',
	'LOG_PORTAL_LINK_UPDATED'				=> '<strong>Измененные настройки портала</strong><br />&raquo; Обновлена ссылка: %s ',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Измененные настройки портала</strong><br />&raquo; Добавлено событие: %s ',
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Измененные настройки портала</strong><br />&raquo; Обновлено событие: %s ',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Измененные настройки портала</strong><br />&raquo; Удалено событие: %s ',
	
	// Upload Module
	'ACP_PORTAL_UPLOAD'				=> 'Загрузка модуля',
	'MODULE_UPLOAD'					=> 'Загрузить модуль',
	'MODULE_UPLOAD_EXP'				=> 'Выберите zip архив модуля, которого хотите загрузить:',
	'MODULE_UPLOAD_GO'				=> 'Загрузить',
	'NO_MODULE_UPLOAD'				=> 'Настройки вашего сервера не позволяют загружать файлы.',
	'NO_FILE_B3P'					=> 'zip архив не найден.',	
	'MODULE_UPLOADED'				=> 'Модуль успешно загружен.',
	'MODULE_UPLOAD_MKDIR_FAILURE'	=> 'Невозможно создать папку',
	'MODULE_COPY_FAILURE'			=> 'Невозможно скопировать слудующий файл: %1$s',
	'MODULE_CORRUPTED'				=> 'Модуль, который вы пытаетесь загрузить, вероятно поврежден.',
	'PORTAL_NEW_FILES'				=> 'Новые файлы',
	'PORTAL_MODULE_SOURCE'			=> 'Источник',
	'PORTAL_MODULE_TARGET'			=> 'Цель',
	'PORTAL_MODULE_STATUS'			=> 'Статус',
	'PORTAL_MODULE_SUCCESS'			=> 'Успех',
	'PORTAL_MODULE_ERROR'			=> 'Ошибка',
	
	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Добавление стандартного набора модулей',
	'PORTAL_BASIC_UNINSTALL'		=> 'Удаление модулей из БД',
	
	// Logs
	'LOG_PORTAL_CONFIG'			=> '<strong>Измененные настройки портала</strong><br />&raquo; %s',
	
	/**
	* A copy of Handyman` s MOD version check, to view it on the portal overview
	*/
	'ANNOUNCEMENT_TOPIC'	=> 'Объявление о новой версии',
	'CURRENT_VERSION'		=> 'Текущая версия',
	'DOWNLOAD_LATEST'		=> 'Загрузить последнюю версию',
	'LATEST_VERSION'		=> 'Последняя версия',
	'NO_INFO'				=> 'Невозможно подключиться к серверу для проверки версии.',
	'NOT_UP_TO_DATE'		=> '%s устарел',
	'RELEASE_ANNOUNCEMENT'	=> 'Тема с объявлением',
	'UP_TO_DATE'			=> '%s актуален',
	'VERSION_CHECK'			=> 'MOD - Проверка версий',
	
	// Adding the permissions
	'acl_a_manage_portal'		=> array('lang' => 'Может изменять настройки портала', 'cat' => 'misc'),
	'acl_u_view_portal'			=> array('lang' => 'Может просматривать портал', 'cat' => 'misc'),
));
