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
	'INSTALLER_UNINSTALL'					=> 'Odinstalace',
	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_INSTALL'						=> 'Instalace',

	'INSTALLER_INTRO_TITLE'				=> 'Utilita pro Instalování/Update portálu',
	'INSTALLER_INTRO_NOTE'				=> 'Vítejte v utilitě pro Instalování/Update portálu, která je známá jako PInUp',

	'INSTALLER_MENU_DONE'					=> 'Poslední verze',
	'INSTALLER_MENU_DONE_TEXT'			=> 'Už máte verzi %s nainstalovanou, smažte adresář s instalací portálu a vraťte se na <a href="%s">fórum</a>.',

	'INSTALLER_INSTALL_TITLE'				=> 'PInUp Instalace',
	'INSTALLER_INSTALL_NOTE'				=> 'Když si vyberete instalaci MODu, všechny databáze s předchozími verzemi budou smazány.',
	'INSTALLER_INSTALL_MENU'				=> 'Menu instalace',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Instalace MODu v%s byla úspěšná.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Instalace MODu v%s <strong>nebyla</strong> úspěšná.',
	'INSTALLER_INSTALL_VERSION'			=> 'Instalace MODu v%s',
	'INSTALLER_INSTALL_START'			=> 'Prosím, klikněte na <a href="%s">Install</a> pro zahájení instalace.',

	'INSTALLER_UPDATE_TITLE'				=> 'PInUp Update',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MODu z v%s na v%s',

	'INSTALLER_UNINSTALL_TITLE'			=> 'PInUp Odinstalace',
	'INSTALLER_UNINSTALL_NOTE'			=> 'Vítejte v menu Update',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'Instalace MODu v%s byla úspěšná.',

	'INSTALLER_NEEDS_ADMIN'			=> 'Musíte být přihlášen jako administrátor.<br /><a href="../ucp.php?mode=login"><strong>Jděte na přihlášení</strong>',

	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Menu Update',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MODu z v%s na v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update MODu z v%s na v%s byla úspěšná.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'Update MODu z v%s na v%s <strong>nebyla</strong> úspěšná.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MODu z v%s',
	'INSTALLER_UPDATE_TO'					=> 'Update na',
	'INSTALLER_UPDATE_START'				=> 'Prosím, klikněte na <a href="%s">Update</a> pro start updatovací utility.',

	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Omlouváme se, PInUp nepodporuje odinstalaci oridinálního phpBB3 portálu.',

	'INSTALLER_ERROR'						=> 'PInUp chyba',

	'INSTALLER_USEFUL_INFO'				=> 'Prosím, smažte /install_portal adresář.',

	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Nezapomeňte smazat soubory portálu a odstranit změny v souborech.',

	'WARNING'									=> 'Varování',
));

?>