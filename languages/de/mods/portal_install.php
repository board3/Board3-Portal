<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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
	
	'INSTALLER_MENU'						=> 'PInUp Menü',
	'INSTALLER_MENU_START'				=> 'Start',
	'INSTALLER_UNINSTALL'					=> 'Deinstallieren',
	'INSTALLER_UPDATE'						=> 'Aktualisieren',
	'INSTALLER_INSTALL'						=> 'Installiere',

	'INSTALLER_INTRO_TITLE'				=> 'Portal Install/Update Utility (PInUp)',
	'INSTALLER_INTRO_NOTE'				=> 'Willkommen in der Portal Installation von Board3, wir begrüßen Sie herzlich an Board',

	'INSTALLER_MENU_DONE'					=> 'Aktuelle Version',
	'INSTALLER_MENU_DONE_TEXT'			=> 'Du hast bereits Version %s installiert, bitte lösche das Verzeichnis install_portal folder. Zurück zu deinem <a href="%s">Forum</a>.',

	'INSTALLER_INSTALL_TITLE'				=> 'PInUp Installation',
	'INSTALLER_INSTALL_NOTE'				=> 'Sobald du die Installation dieses Mods startest, werden eventuelle vorige Versionen aus der Datenbank entfernt.',
	'INSTALLER_INSTALL_MENU'				=> 'Installations Menü',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Die Installation des MOD v%s war erfolgreich.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Die Installation des MOD v%s war <strong>nicht</strong> erfolgreich.',
	'INSTALLER_INSTALL_VERSION'			=> 'Installiere MOD v%s',
	'INSTALLER_INSTALL_START'			=> 'Bitte klicke auf <a href="%s">"Installieren"</a> um die Installation zu starten.',

	'INSTALLER_UPDATE_TITLE'				=> 'PInUp Aktualisierung',
	'INSTALLER_UPDATE_NOTE'				=> 'Aktualisiere MOD von v%s to v%s',

	'INSTALLER_UNINSTALL_TITLE'			=> 'PInUp Deinstallation',
	'INSTALLER_UNINSTALL_NOTE'			=> 'Wikommen im Aktualisierungs Menü',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'Die Deinstallation des MODs v%s war erfolgreich.',



	'INSTALLER_NEEDS_FOUNDER'			=> 'Du musst als Gründer eingeloggt sein.',

	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Updatemenü',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD von v%s nach v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update der MOD von v%s nach v%s war erfolgreich.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'Update der MOD von v%s nach v%s war <strong>nicht</strong> erfolgreich.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MOD von v',
	'INSTALLER_UPDATE_TO'					=> 'Aktualisiere auf',
	'INSTALLER_UPDATE_START'				=> 'Bitte klicke <a href="%s">"Aktualisieren"</a> um die Aktualisierung zu starten.',

	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Tut mir leid, PInUp unterstützt nicht die Deinstallierung des original phpBB3 Portals.',
	
	'INSTALLER_ERROR'						=> 'PInUp Fehler',

	'INSTALLER_USEFUL_INFO'				=> 'Bitte lösche das /install_portal Verzeichnis.',

	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Denke daran die Portal Dateien und Dateiänderungen am Originalsystem zu löschen.',

	'WARNING'									=> 'Warnung',
));

?>