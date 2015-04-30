<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1 - Main Menu
* @copyright (c) 2013 Board3 Group ( www.board3.de )
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
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Inhoud',
	'M_ACP'		=> 'ACP',
	'M_HELP'	=> 'Help',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Gebruikersvoorwaarden',
	'M_PRV'		=> 'Privacybeleid',
	'M_SEARCH'	=> 'Zoek',
	'MENU_NO_LINKS'	=> 'Geen links',
	// ACP
	'ACP_PORTAL_MENU'				=> 'Menu instellingen',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Link instellingen',
	'ACP_PORTAL_MENU_EXP'			=> 'Beheer je hoofdmenu',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Beheer menu',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Hier kan je de links van je hoofdmenu beheren.',
	'ACP_PORTAL_MENU_CAT'			=> 'Categorie',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Stel in als speciale linkcategorie',
	'ACP_PORTAL_MENU_INT'			=> 'Interne link',
	'ACP_PORTAL_MENU_EXT'			=> 'Externe link',
	'ACP_PORTAL_MENU_TITLE'			=> 'Titel',
	'ACP_PORTAL_MENU_URL'			=> 'Link-URL',
	'ACP_PORTAL_MENU_ADD'			=> 'Nieuwe navigatielink toevoegen',
	'ACP_PORTAL_MENU_TYPE'			=> 'Linktype',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Als je een link naar een pagina op je forum hebt, selecteer dan "Interne link" om ongewenst afmelden te voorkomen.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'Je moet eerst een categorie aanmaken.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Externe links:<br />Alle links moeten worden ingevoerd met http://<br /><br />Interne link:<br />Voer alleen het php-bestand in als link, d.w.z. index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Link permissies',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Selecteer de groepen die de link mogen bekijken. Als alle gebruikers de link mogen bekijken, selecteer dan niets.<br />Selecteer/Deselecteer meerdere groepen doormiddel van <samp>CTRL</samp> en door te klikken.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Open externe links in een nieuw venster',
	// Errors
	'NO_LINK_TITLE'					=> 'Je moet een titel opgeven voor deze link.',
	'NO_LINK_URL'					=> 'Je moet een link opgeven.',
));
