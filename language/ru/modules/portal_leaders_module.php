<?php
/**
*
* @package Board3 Portal v2 - Leaders
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
	'NO_ADMINISTRATORS_P'	=> 'Нет администраторов',
	'NO_MODERATORS_P'		=> 'Нет модераторов',
	'NO_GROUPS_P'			=> 'Нет групп',
	'ACP_PORTAL_LEADERS'	=> 'Наша команда',
	
	// ACP
	'ACP_PORTAL_LEADERS'		=> 'Настройки команды',
	'ACP_PORTAL_LEADERS_EXP'	=> 'Здесь настраивается блок команды',
	'PORTAL_LEADERS_EXT'		=> 'Команда сайта',
	'PORTAL_LEADERS_EXT_EXP'	=> 'Стандартный блок перечисляет администраторов и модераторов; расширенный блок добавляет отображение групп.',
));
