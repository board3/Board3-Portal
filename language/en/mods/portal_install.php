<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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
	'INSTALLER_CONVERT'					=> 'Convert',
	'INSTALLER_CONVERT_MENU'			=> 'Convertmenu',
	'INSTALLER_CONVERT_NOTE'			=> 'Convert MOD to v%s',
	'INSTALLER_CONVERT_PREFIX'			=> 'Prefix of phpBB2-installation',
	'INSTALLER_CONVERT_SUCCESSFUL'		=> 'Convert of the MOD to v%s was successful.<br />Now copy the image-files of album/upload and album/upload/cache of your phpbb2-Installation into the one\'s of the phpBB3',
	'INSTALLER_CONVERT_UNSUCCESSFUL'	=> 'Convert of the MOD to v%s was <strong>not</strong> successful.',
	'INSTALLER_CONVERT_UNSUCCESSFUL2'	=> 'You didn\'t insert a prefix of your phpBB2-installation.',
	'INSTALLER_CONVERT_WELCOME'			=> 'Welcome to the Convertmenu',
	'INSTALLER_CONVERT_WELCOME_NOTE'	=> 'When you choose to convert the MOD, we try to copy the data of your older phpBB2 Installation.',

	'INSTALLER_INTRO'					=> 'Intro',
	'INSTALLER_INTRO_WELCOME'			=> 'Welcome to the MOD Installation',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Please choose what you want to do.',

	'INSTALLER_INSTALL'					=> 'Install',
	'INSTALLER_INSTALL_MENU'			=> 'Installmenu',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Installation of the MOD v%s was successful.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Installation of the MOD v%s was <strong>not</strong> successful.',
	'INSTALLER_INSTALL_VERSION'			=> 'Install MOD v%s',
	'INSTALLER_INSTALL_WELCOME'			=> 'Welcome to the Installationmenu',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'When you choose to install the MOD, any database of previous versions will be dropped.',

	'INSTALLER_NEEDS_FOUNDER'			=> 'You must be logged in as a founder.',

	'INSTALLER_UPDATE'					=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Updatemenu',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD from v%s to v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update of the MOD from v%s to v%s was successful.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'Update of the MOD from v%s to v%s was <strong>not</strong> successful.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MOD from v',
	'INSTALLER_UPDATE_WELCOME'			=> 'Welcome to the Updatemenu',

	'WARNING'							=> 'Warning',
));

?>