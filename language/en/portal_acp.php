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
	'ACP_PORTAL_MODULES_EXP'		=> 'You can manage your portal modules here. If you turn off all modules, please also disable the Portal.',

	'MODULE_POS_TOP'				=> 'Top',
	'MODULE_POS_LEFT'				=> 'Left column',
	'MODULE_POS_RIGHT'				=> 'Right column',
	'MODULE_POS_CENTER'				=> 'Center column',
	'MODULE_POS_BOTTOM'				=> 'Bottom',
	'ADD_MODULE'					=> 'Add module',
	'CHOOSE_MODULE'					=> 'Choose module',
	'CHOOSE_MODULE_EXP'				=> 'Choose a module from the drop-down list',
	'SUCCESS_ADD'					=> 'The module was added successfully.',
	'SUCCESS_DELETE'				=> 'The module was removed successfully.',
	'NO_MODULES'					=> 'No modules have been detected.',
	'MOVE_RIGHT'					=> 'Move right',
	'MOVE_LEFT'						=> 'Move left',
	'B3P_FILE_NOT_FOUND'			=> 'The requested file could not be found',
	'UNABLE_TO_MOVE'				=> 'It is not possible to move the block to the selected column.',
	'UNABLE_TO_MOVE_ROW'			=> 'It is not possible to move the block to the selected row.',
	'UNABLE_TO_ADD_MODULE'			=> 'It is not possible to add the module to the selected column.',
	'DELETE_MODULE_CONFIRM'			=> 'Are you sure you wish to delete the module "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Successfully reset the module settings.',
	'MODULE_RESET_CONFIRM'			=> 'Are you sure you wish to reset the settings of the module "%1$s"?',
	'MODULE_NOT_EXISTS'				=> 'The selected module does not exist.',

	'MODULE_OPTIONS'			=> 'Module options',
	'MODULE_NAME'				=> 'Module name',
	'MODULE_NAME_EXP'			=> 'Enter the name of the Module that should be displayed in the Module configuration.',
	'MODULE_IMAGE'				=> 'Module image',
	'MODULE_IMAGE_EXP'			=> 'Enter the filename of the module image. Images need to be in all styles/{yourstyle}/theme/images/portal/ folders',
	'MODULE_PERMISSIONS'		=> 'Module permissions',
	'MODULE_PERMISSIONS_EXP'	=> 'Select the groups that should be authorized to view the module. If you want all users to be able to view the module, don’t select anything.<br />Select/Deselect multiple groups by holding <samp>CTRL</samp> and clicking.',
	'MODULE_IMAGE_WIDTH'		=> 'Module image width',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Enter the width of the module image in pixels',
	'MODULE_IMAGE_HEIGHT'		=> 'Module image height',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Enter the height of the module image in pixels',
	'MODULE_RESET'				=> 'Reset module configuration',
	'MODULE_RESET_EXP'			=> 'This will reset all settings to the default!',
	'MODULE_STATUS'				=> 'Enable module',
	'MODULE_ADD_ONCE'			=> 'This module can only be added once.',
	'MODULE_IMAGE_ERROR'		=> 'There was an error while checking for the module image:',
	'UNKNOWN_MODULE_METHOD'		=> 'The %1$s module’s module method couldn’t be resolved.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'General settings',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portal Administration',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Thank you for choosing Board3 Portal! This is where you can manage your portal page. The options below let you customize the various general settings.',
	'ACP_PORTAL_SHOW_ALL'					=> 'Show portal on all pages',
	'ACP_PORTAL_SHOW_ALL_EXP'				=> 'Display the portal on all pages',
	'PORTAL_ENABLE'							=> 'Enable Portal',
	'PORTAL_ENABLE_EXP'						=> 'Turns the whole portal on or off',
	'PORTAL_LEFT_COLUMN'					=> 'Enable left column',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Switch to no if you wish to turn off the left column',
	'PORTAL_RIGHT_COLUMN'					=> 'Enable right column',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Switch to no if you wish to turn off the right column',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Display jumpbox',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Display the jumpbox on the portal. The jumpbox will only be displayed if it is also enabled in the board features.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Left and right column width settings',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Width of the left column',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Change the width of the left column in pixels; recommended value is 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Width of the right column',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Change the width of the right column in pixels; recommended value is 180',
	'PORTAL_SHOW_ALL_SIDE'					=> 'Column to display on all pages',
	'PORTAL_SHOW_ALL_SIDE_EXP'				=> 'Choose which column should be shown on all pages.',
	'PORTAL_SHOW_ALL_LEFT'					=> 'Left',
	'PORTAL_SHOW_ALL_RIGHT'					=> 'Right',

	'LINK_ADDED'							=> 'The link has been successfully added',
	'LINK_UPDATED'							=> 'The link has been successfully updated',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Adding basic set of modules',
	'PORTAL_BASIC_UNINSTALL'		=> 'Removing modules from database',
));
