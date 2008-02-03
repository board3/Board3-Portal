<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
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

	'INSTALLER_MENU'						=> 'PInUp Menu',
	'INSTALLER_MENU_START'				=> 'Start',
	'INSTALLER_UNINSTALL'					=> 'Uninstall',
	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_INSTALL'						=> 'Install',

	'INSTALLER_INTRO_TITLE'				=> 'Portal Install/Update Utility',
	'INSTALLER_INTRO_NOTE'				=> 'Welcome to the Portal Install/Update Utility, hereby known as PInUp',

	'INSTALLER_MENU_DONE'					=> 'Latest Version',
	'INSTALLER_MENU_DONE_TEXT'			=> 'You already have version %s installed, please delete the install_portal folder and return to your <a href="%s">forums</a>.',

	'INSTALLER_INSTALL_TITLE'				=> 'PInUp Install',
	'INSTALLER_INSTALL_NOTE'				=> 'When you choose to install the MOD, any database of previous versions will be dropped.',
	'INSTALLER_INSTALL_MENU'				=> 'Installmenu',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Installation of the MOD v%s was successful.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Installation of the MOD v%s was <strong>not</strong> successful.',
	'INSTALLER_INSTALL_VERSION'			=> 'Install MOD v%s',
	'INSTALLER_INSTALL_START'			=> 'Please click <a href="%s">Install</a> to start the install utility.',

	'INSTALLER_UPDATE_TITLE'				=> 'PInUp Update',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD from v%s to v%s',

	'INSTALLER_UNINSTALL_TITLE'			=> 'PInUp Uninstall',
	'INSTALLER_UNINSTALL_NOTE'			=> 'Welcome to the Updatemenu',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'Installation of the MOD v%s was successful.',

	'INSTALLER_NEEDS_ADMIN'			=> 'You must be logged in as an admin.<br /><a href="../ucp.php?mode=login"><strong>Go to login</strong>',

	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Updatemenu',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD from v%s to v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update of the MOD from v%s to v%s was successful.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'Update of the MOD from v%s to v%s was <strong>not</strong> successful.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MOD from v%s',
	'INSTALLER_UPDATE_TO'					=> 'Update to',
	'INSTALLER_UPDATE_START'				=> 'Please click <a href="%s">Update</a> to start the update utility.',

	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Sorry, PInUp does not support the uninstallation of the origonal phpBB3 Portal.',

	'INSTALLER_ERROR'						=> 'PInUp Error',

	'INSTALLER_USEFUL_INFO'				=> 'Please delete the /install_portal directory.',

	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Remember to delete the portal files and remove the file edits.',

	'WARNING'									=> 'Warning',
));

?>