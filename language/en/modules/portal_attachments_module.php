<?php
/**
*
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'Downloads',
	'NO_ATTACHMENTS'		=> 'No attachments',
	'PORTAL_ATTACHMENTS'	=> 'Attachments',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Attachments settings',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'This is where you customize the attachments block.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limit of displayed attachments',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> '0 means infinite',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Attachments forums',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'The forum(s) from which the attachments should be displayed. If "Exclude forums" is set to "Yes", select the forums you want to exclude.<br />If "Exclude forums" is set to "No" select the forums you want to see.<br />Select/Deselect multiple forums by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Exclude forums',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Select "Yes" if you want to exlude the selected forums from the attachments block, and "No" if you want to see only the attachments of the selected forums in the attachments block.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Character limit for each attachments',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> '0 means infinite',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Filetypes',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'If "Exclude filetypes" is set to "Yes", select the filetypes you want to exclude.<br />If "Exclude filetypes" is set to "No" select the filetypes you want to see.<br />Select/Deselect multiple filetypes by holding <samp>CTRL</samp> and clicking.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Exclude filetypes',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Select "Yes" if you want to exlude the selected filetypes from the attachments block, and "No" if you want to see only the selected filetypes in the attachments block.',
));
