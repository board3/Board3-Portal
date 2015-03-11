<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'ACP_PORTAL_MODULES_EXP'		=> 'Здесь можно управлять модулями портала. Если выключаются все модули, необходимо выключить также и сам портал.',

	'MODULE_POS_TOP'				=> 'Верх',
	'MODULE_POS_LEFT'				=> 'Левая колонка',
	'MODULE_POS_RIGHT'				=> 'Правая колонкЦентральная колонкаCenter column',
	'MODULE_POS_BOTTOM'				=> 'Низ',
	'ADD_MODULE'					=> 'Добавить модуль',
	'CHOOSE_MODULE'					=> 'Выбрать модуль',
	'CHOOSE_MODULE_EXP'				=> 'выберите модуль из выпадающего списка',
	'SUCCESS_ADD'					=> 'Модуль успешно добавлен.',
	'SUCCESS_DELETE'				=> 'Модуль успешно удалён.',
	'NO_MODULES'					=> 'Модули не найдены.',
	'MOVE_RIGHT'					=> 'Переместить вправо',
	'MOVE_LEFT'						=> 'Переместить влево',
	'B3P_FILE_NOT_FOUND'			=> 'Запрашиваемый файл не найден',
	'UNABLE_TO_MOVE'				=> 'Невозможно переместить блок в выбранную колонку.',
	'UNABLE_TO_MOVE_ROW'			=> 'Невозможно переместить блок в выбранную строку.',
	'DELETE_MODULE_CONFIRM'			=> 'вы уверены, что хотите удалить модуль "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Настройки модуля успешно восстановлены.',
	'MODULE_RESET_CONFIRM'			=> 'Вы уверены, что хотите восстановить настройки модуля "%1$s"?',
	'MODULE_NOT_EXISTS'				=> 'Выбранный модуль не существует.',

	'MODULE_OPTIONS'			=> 'Настройки модуля',
	'MODULE_NAME'				=> 'Наименование модуля',
	'MODULE_NAME_EXP'			=> 'Введите имя модуля для отображения в настройках конфигурациии.',
	'MODULE_IMAGE'				=> 'Значок модуля',
	'MODULE_IMAGE_EXP'			=> 'Введите имя файла значка модуля. Изображения должны находиться в папках styles/{yourstyle}/theme/images/portal/ всех используемых стилей',
	'MODULE_PERMISSIONS'		=> 'Права доступа к модулю',
	'MODULE_PERMISSIONS_EXP'	=> 'Выберите группы, которым разрешен просмотр модуля. Если необходимо предоставить право просмотра модуля всем пользователям, не выбирайте ничего.<br />Отметить/снять отметку для нескольких групп сразу можно, удерживая клавишу <samp>CTRL</samp> при щелчке мышью.',
	'MODULE_IMAGE_WIDTH'		=> 'Ширина значка модуля',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Введите ширину значка модуля в пикселях',
	'MODULE_IMAGE_HEIGHT'		=> 'высота значка модуля',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Введите высоту значка модуля в пикселях',
	'MODULE_RESET'				=> 'Сбросить настройки конфигурации модуля',
	'MODULE_RESET_EXP'			=> 'Будут установлены настройки конфигурации модуля по умолчанию!',
	'MODULE_STATUS'				=> 'Включить модуль',
	'MODULE_ADD_ONCE'			=> 'Данный модуль может быть добавлен только один раз.',
	'MODULE_IMAGE_ERROR'		=> 'Произошла ошибка при проверке изображения значка модуля:',
	'UNKNOWN_MODULE_METHOD'		=> 'Не удалось распознать метод %1$s модуля.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Общие настройки',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Администрирование портала',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Спасибо за выбор Board3 Portal! Здесь можно управлять страницей портала. С помощью указанных ниже опций можно изменить различные общие настройки.',
	'PORTAL_ENABLE'							=> 'Включить портал',
	'PORTAL_ENABLE_EXP'						=> 'Включение и выключение портала',
	'PORTAL_LEFT_COLUMN'					=> 'Включить левую колонку',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Выберите Нет для выключения левой колонки',
	'PORTAL_RIGHT_COLUMN'					=> 'Включить правую колонку',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Выберите Нет для выключения правой колонки',
	'PORTAL_VERSION_CHECK'					=> 'Проверка версии портала',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Отображать быстрый переход',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Отображать список быстрого перехода на портале. Список быстрого перехода будет отображён только в случае, если данная функция включена на конференции.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Настройки ширины левой и правой колонок',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Ширина левой колонки',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Установите ширину левой колонки в пикселях; рекомендуется значение 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Ширина правой колонки',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Установите ширину правой колонки в пикселях; рекомендуется значение 180',

	'LINK_ADDED'							=> 'Ссылка успешно добавлена',
	'LINK_UPDATED'							=> 'Ссылка успешно обновлена',

	// Upload Module
	'MODULE_UPLOAD'					=> 'Загрузить модуль',
	'MODULE_UPLOAD_EXP'				=> 'Выберите zip файл модуля для загрузки на портал:',
	'MODULE_UPLOAD_GO'				=> 'Загрузка',
	'NO_MODULE_UPLOAD'				=> 'Настройки сервера не позволяют загружать файлы.',
	'NO_FILE_B3P'					=> 'Не указан zip файл.',
	'MODULE_UPLOADED'				=> 'Модуль успешно загружен.',
	'MODULE_UPLOAD_MKDIR_FAILURE'	=> 'Не удалось создать папку.',
	'MODULE_COPY_FAILURE'			=> 'Не удалось скопировать файл: %1$s',
	'MODULE_CORRUPTED'				=> 'Загружаемый модуль поврежден.',
	'PORTAL_NEW_FILES'				=> 'Новые файлы',
	'PORTAL_MODULE_SOURCE'			=> 'Откуда',
	'PORTAL_MODULE_TARGET'			=> 'Куда',
	'PORTAL_MODULE_STATUS'			=> 'Статус',
	'PORTAL_MODULE_SUCCESS'			=> 'Выполнено',
	'PORTAL_MODULE_ERROR'			=> 'Ошибка',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Добавление основного набора модулей',
	'PORTAL_BASIC_UNINSTALL'		=> 'Удаление модулей из базы данных',

	/**
	* A copy of Handyman` s MOD version check, to view it on the portal overview
	*/
	'ANNOUNCEMENT_TOPIC'	=> 'Анонс новой версии',
	'CURRENT_VERSION'		=> 'Текущая версия',
	'DOWNLOAD_LATEST'		=> 'Скачать последнюю версию',
	'LATEST_VERSION'		=> 'Последняя версия',
	'NO_INFO'				=> 'Отсутствует связь с сервером версий',
	'NOT_UP_TO_DATE'		=> '%s не самая последняя',
	'RELEASE_ANNOUNCEMENT'	=> 'Тема анонса',
	'UP_TO_DATE'			=> '%s самая последняя',
	'VERSION_CHECK'			=> 'Проверка версии расширения',
));
