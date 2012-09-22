<?php
/**
*
* @package Board3 Portal v2
* @copyright (c) Board3 Group ( www.board3.de )
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
	// Portal Modules
	'ACP_PORTAL_MODULES'			=> 'Portal Modules',
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
	'DELETE_MODULE_CONFIRM'			=> 'Are you sure you wish to delete the module "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Successfully reset the module settings.',
	'MODULE_RESET_CONFIRM'			=> 'Are you sure you wish to reset the settings of the module "%1$s"?',
	
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

	// general
	'ACP_PORTAL'							=> 'Portal',
	'ACP_PORTAL_GENERAL_INFO'				=> 'General settings',
	'ACP_PORTAL_CONFIG_INFO'				=> 'General settings',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portal Administration',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Thank you for choosing Board3 Portal! This is where you can manage your portal page. The options below let you customize the various general settings.',
	'PORTAL_ENABLE'							=> 'Enable Portal',
	'PORTAL_ENABLE_EXP'						=> 'Turns the whole portal on or off',
	'PORTAL_LEFT_COLUMN'					=> 'Enable left column',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Switch to no if you wish to turn off the left column',
	'PORTAL_RIGHT_COLUMN'					=> 'Enable right column',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Switch to no if you wish to turn off the right column',
	'PORTAL_VERSION_CHECK'					=> 'Versioncheck on Portal',
	'PORTAL_PHPBB_MENU'						=> 'phpBB menu',
	'PORTAL_PHPBB_MENU_EXP'					=> 'Display the phpBB Header on the portal.',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Display jumpbox',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Display the jumpbox on the portal. The jumpbox will only be displayed if it is also enabled in the board features.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Left and right column width settings',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Width of the left column',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Change the width of the left column in pixels; recommended value is 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Width of the right column',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Change the width of the right column in pixels; recommended value is 180',
	
	'LINK_ADDED'							=> 'The link has been successfully added',
	'LINK_UPDATED'							=> 'The link has been successfully updated',
	'LOG_PORTAL_LINK_ADDED'					=> '<strong>Altered Portal settings</strong><br />&raquo; Link added: %s ',
	'LOG_PORTAL_LINK_UPDATED'				=> '<strong>Altered Portal settings</strong><br />&raquo; Link updated: %s ',
	'LOG_PORTAL_LINK_REMOVED'				=> '<strong>Altered Portal settings</strong><br />&raquo; Link removed: %s ',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Altered Portal settings</strong><br />&raquo; Event added: %s ',
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Altered Portal settings</strong><br />&raquo; Event updated: %s ',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Altered Portal settings</strong><br />&raquo; Event removed: %s ',

	// Upload Module
	'ACP_PORTAL_UPLOAD'				=> 'Upload module',
	'MODULE_UPLOAD'					=> 'Upload a module',
	'MODULE_UPLOAD_EXP'				=> 'Choose the zip file of the module you want to upload:',
	'MODULE_UPLOAD_GO'				=> 'Upload',
	'NO_MODULE_UPLOAD'				=> 'Your server configuration does not allow file uploads.',
	'NO_FILE_B3P'					=> 'No file specified.',
	'MODULE_UPLOADED'				=> 'Module uploaded successfully.',
	'MODULE_UPLOAD_MKDIR_FAILURE'	=> 'Unable to create a folder.',
	'MODULE_COPY_FAILURE'			=> 'Unable to copy the following file: %1$s',
	'MODULE_CORRUPTED'				=> 'The module you are trying to upload seems to be corrupted.',
	'PORTAL_NEW_FILES'				=> 'New files',
	'PORTAL_MODULE_SOURCE'			=> 'Source',
	'PORTAL_MODULE_TARGET'			=> 'Target',
	'PORTAL_MODULE_STATUS'			=> 'Status',
	'PORTAL_MODULE_SUCCESS'			=> 'Success',
	'PORTAL_MODULE_ERROR'			=> 'Error',
	
	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Adding basic set of modules',
	'PORTAL_BASIC_UNINSTALL'		=> 'Removing modules from database',
	
	// Logs
	'LOG_PORTAL_CONFIG'			=> '<strong>Altered Portal settings</strong><br />&raquo; %s',
	
	/**
	* A copy of Handyman` s MOD version check, to view it on the portal overview
	*/
	'ANNOUNCEMENT_TOPIC'	=> 'Release Announcement',
	'CURRENT_VERSION'		=> 'Current Version',
	'DOWNLOAD_LATEST'		=> 'Download Latest Version',
	'LATEST_VERSION'		=> 'Latest Version',
	'NO_INFO'				=> 'Version server could not be contacted',
	'NOT_UP_TO_DATE'		=> '%s is not up to date',
	'RELEASE_ANNOUNCEMENT'	=> 'Annoucement Topic',
	'UP_TO_DATE'			=> '%s is up to date',
	'VERSION_CHECK'			=> 'MOD Version Check',
	
	// Adding the permissions
	'acl_a_manage_portal'		=> array('lang' => 'Can alter Portal settings', 'cat' => 'misc'),
	'acl_u_view_portal'			=> array('lang' => 'Can view the Portal', 'cat' => 'misc'),
));
