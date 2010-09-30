<?php
/**
* @package Portal - Main Menu
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	
	// ACP
	'ACP_PORTAL_MENU'				=> 'Menu settings',
	'ACP_PORTAL_MENU_EXP'			=> 'Manage your main menu',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Manage menu',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'You can manage the links of your main menu here.<br />Change the type of link by changing the selected option in the drop-down list next to the link.',
	'ACP_PORTAL_MENU_CAT'			=> 'Category',
	'ACP_PORTAL_MENU_INT'			=> 'Internal link',
	'ACP_PORTAL_MENU_EXT'			=> 'External link',
	'ACP_PORTAL_MENU_TITLE'			=> 'Title',
	'ACP_PORTAL_MENU_URL'			=> 'Link URL',
	'ACP_PORTAL_MENU_TYPE'			=> 'Link type',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'If you have a link to a page of your board, choose "Internal link" in order to prevent unwanted logouts.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'You need to create a category first.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'External links:<br />All links should be entered with a http://<br /><br />Internal links:<br />Only enter the php file as link url, i.e. index.php.<br />If you would like to add a query string, then define the values below.<br />If your link is index.php?style=4, then enter index.php as link url and style=4 in the textfield for the first post variable.',
	'ACP_PORTAL_MENU_QUERY1'		=> 'First post variable',
	'ACP_PORTAL_MENU_QUERY1_EXP'	=> 'Enter the first post variable. Example: style=4',
	'ACP_PORTAL_MENU_QUERY2'		=> 'Second post variable',
	'ACP_PORTAL_MENU_QUERY2_EXP'	=> 'Enter the second post variable. Example: style=4',
	'ACP_PORTAL_MENU_QUERY3'		=> 'Third post variable',
	'ACP_PORTAL_MENU_QUERY3_EXP'	=> 'Enter the third post variable. Example: style=4',
	'ACP_PORTAL_MENU_LINK'			=> 'Link settings',
	'ACP_PORTAL_MENU_INT_OPTIONS'	=> 'Internal links options',
));

?>