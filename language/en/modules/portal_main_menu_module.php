<?php
/**
*
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
	'M_CONTENT'	=> 'Content',
	'M_ACP'		=> 'ACP',
	'M_HELP'	=> 'Help',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Terms of use',
	'M_PRV'		=> 'Privacy policy',
	'M_SEARCH'	=> 'Search',
	'MENU_NO_LINKS'	=> 'No links',

	// ACP
	'ACP_PORTAL_MENU'				=> 'Menu settings',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Link Settings',
	'ACP_PORTAL_MENU_EXP'			=> 'Manage your main menu',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Manage menu',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'You can manage the links of your main menu here.',
	'ACP_PORTAL_MENU_CAT'			=> 'Category',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Set as special link category',
	'ACP_PORTAL_MENU_INT'			=> 'Internal link',
	'ACP_PORTAL_MENU_EXT'			=> 'External link',
	'ACP_PORTAL_MENU_TITLE'			=> 'Title',
	'ACP_PORTAL_MENU_URL'			=> 'Link URL',
	'ACP_PORTAL_MENU_ADD'			=> 'Add new navigation link',
	'ACP_PORTAL_MENU_TYPE'			=> 'Link type',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'If you have a link to a page of your board, choose "Internal link" in order to prevent unwanted logouts.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'You need to create a category first.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'External links:<br />All links should be entered with a http://<br /><br />Internal links:<br />Only enter the php file as link url, i.e. index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Link permissions',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Select the groups that should be authorized to view the link. If you want all users to be able to view the link, don’t select anything.<br />Select/Deselect multiple groups by holding <samp>CTRL</samp> and clicking.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Open external links in a new window',

	// Errors
	'NO_LINK_TITLE'					=> 'You must enter a title for this link.',
	'NO_LINK_URL'					=> 'You must enter a link URL.',
));
