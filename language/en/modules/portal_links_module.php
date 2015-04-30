<?php
/**
*
* @package Board3 Portal v2.1 - Links
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
	'PORTAL_LINKS'		=> 'Links',
	'LINKS_NO_LINKS'	=> 'No links',

	// ACP
	'ACP_PORTAL_LINKS'				=> 'Link Settings',
	'ACP_PORTAL_LINKS_EXP'			=> 'Customize the links listed in the links block',
	'ACP_PORTAL_LINK_TITLE'			=> 'Title',
	'ACP_PORTAL_LINK_TYPE'			=> 'Link type',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'If you have a link to a page of your board, choose "Internal link" in order to prevent unwanted logouts.',
	'ACP_PORTAL_LINK_INT'			=> 'Internal link',
	'ACP_PORTAL_LINK_EXT'			=> 'External link',
	'ACP_PORTAL_LINK_ADD'			=> 'Add new navigation link',
	'ACP_PORTAL_LINK_URL'			=> 'Link URL',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'External links:<br />All links should be entered with a http://<br /><br />Internal links:<br />Only enter the php file as link url, i.e. index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Link permissions',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Select the groups that should be authorized to view the link. If you want all users to be able to view the link, don’t select anything.<br />Select/Deselect multiple groups by holding <samp>CTRL</samp> and clicking.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Open external links in a new window',

	// Errors
	'NO_LINK_TITLE'					=> 'You must enter a title for this link.',
	'NO_LINK_URL'					=> 'You must enter a link URL.',
));
