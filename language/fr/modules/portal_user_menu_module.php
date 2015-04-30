<?php
/**
*
* @package Board3 Portal v2.1 - User Menu
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @translated into French by Galixte (http://www.galixte.com)
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
	'USER_MENU'			=> 'Menu de l’utilisateur',
	'UM_LOG_ME_IN'		=> 'Se souvenir de moi',
	'UM_HIDE_ME'		=> 'Cacher mon statut en ligne',
	'UM_REGISTER_NOW'	=> 'M’enregistrer',
	'UM_MAIN_SUBSCRIBED'=> 'Surveillances',
	'UM_BOOKMARKS'		=> 'Favoris',
	'M_MENU' 			=> 'Menu',
	'M_ACP'				=> 'Panneau d’administration',
	'USER_MENU_SETTINGS'	=> 'Paramètres du menu de l’utilisateur',
	'USER_MENU_REGISTER'	=> 'Voir le lien d’inscription dans le menu de l’utilisateur',
));
