<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( delta221 http://www.scannernytt.net )
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

	'INSTALLER_MENU'						=> 'PInUp Meny',
	'INSTALLER_MENU_START'				=> 'Start',
	'INSTALLER_UNINSTALL'					=> 'Avinnstaller',
	'INSTALLER_UPDATE'						=> 'Oppdater',
	'INSTALLER_INSTALL'						=> 'Install',

	'INSTALLER_INTRO_TITLE'				=> 'Portal Innstallasjons/Oppdaterings Utility',
	'INSTALLER_INTRO_NOTE'				=> 'Velkommen til portal Innstallasjons/Oppdaterings Utility, heretter kallt PInUp',

	'INSTALLER_MENU_DONE'					=> 'Siste versjon',
	'INSTALLER_MENU_DONE_TEXT'			=> 'You already have version %s installed, please delete the install_portal folder and return to your <a href="%s">forums</a>.',

	'INSTALLER_INSTALL_TITLE'				=> 'PInUp Innstallasjon',
	'INSTALLER_INSTALL_NOTE'				=> 'When you choose to install the MOD, any database of previous versions will be dropped.',
	'INSTALLER_INSTALL_MENU'				=> 'Installasjonsmeny',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Innstallasjonen av MOD v%s er fullført.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Innstallasjon av MOD v%s er <strong>not</strong> fullført.',
	'INSTALLER_INSTALL_VERSION'			=> 'Installer MOD v%s',
	'INSTALLER_INSTALL_START'			=> 'Vær vennlig klikk <a href="%s">Install</a> for og starte innstallasjonen.',

	'INSTALLER_UPDATE_TITLE'				=> 'PInUp Oppdatering',
	'INSTALLER_UPDATE_NOTE'				=> 'Oppdatere MOD fra v%s til v%s',

	'INSTALLER_UNINSTALL_TITLE'			=> 'PInUp Avinnstallere',
	'INSTALLER_UNINSTALL_NOTE'			=> 'Velkommen til Oppdaterings meny',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'Innstallasjonen av MOD v%s er fullført.',

	'INSTALLER_NEEDS_ADMIN'			=> 'Du må være innlogget som admin.<br /><a href="../ucp.php?mode=login"><strong>Gå til innlogging</strong>',

	'INSTALLER_UPDATE'						=> 'Oppdater',
	'INSTALLER_UPDATE_MENU'				=> 'Oppdateringsmeny',
	'INSTALLER_UPDATE_NOTE'				=> 'Oppdatere MOD fra v%s til v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Oppdateringen av MOD fra v%s til v%s er fullført.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'Oppdatering av MOD fra v%s til v%s er <strong>ikke</strong> fullført.',
	'INSTALLER_UPDATE_VERSION'			=> 'Oppdatere MOD fra v%s',
	'INSTALLER_UPDATE_TO'					=> 'Oppdater til',
	'INSTALLER_UPDATE_START'				=> 'Vær vennlig og klikk <a href="%s">Update</a> for og starte oppdateringen.',

	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Beklager, PInUp støtter ikke avinnstallering av den orgiale phpBB3 Portal.',

	'INSTALLER_ERROR'						=> 'PInUp Feil',

	'INSTALLER_USEFUL_INFO'				=> 'Vær vennlig og slette /install_portal katalogen.',

	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Husk og slett portal filene og fjerne fil editeringene.',

	'WARNING'									=> 'Advarsel',
));

?>