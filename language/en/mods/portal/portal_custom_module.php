<?php
/**
*
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Custom Block',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Custom Block Settings',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Here you can edit your custom block',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'The code you entered is not long enough.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Preview',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Custom Block Code',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Change the code for the small custom block (HTML or BBCode) here.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Custom Block permissions',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Select the groups that should be able to view the custom block. If you want all users to be able to view the custom block, don’t select anything.<br />Select/Deselect multiple groups by holding <samp>CTRL</samp> and clicking.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Activate BBCode for the custom block',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'BBCode could be used in this box. If BBCode is not activated, HTML will be parsed.',
));
