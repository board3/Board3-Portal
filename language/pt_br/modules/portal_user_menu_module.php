<?php
/**
*
* @package Board3 Portal v2.1 - User Menu
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Brazilian Portuguese  translation by null2 (c) 2015 [ver 2.1.0] (https://github.com/phpBBTraducoes)  
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
	'USER_MENU'			=> 'Menu do Usuário',
	'UM_LOG_ME_IN'		=> 'Lembrar',
	'UM_HIDE_ME'		=> 'Ocultar',
	'UM_REGISTER_NOW'	=> 'Registre-se agora!',
	'UM_MAIN_SUBSCRIBED'=> 'Subscrições',
	'UM_BOOKMARKS'		=> 'Favoritos',
	'M_MENU' 			=> 'Menu',
	'M_ACP'				=> 'ACP',
	'USER_MENU_SETTINGS'	=> 'Configuração do Menu do Usuário',
	'USER_MENU_REGISTER'	=> 'Mostrar o link de registro no menu do usuário',
));
