<?php
/**
*
* install_gallery [Deutsch]
*
* @package phpBB Gallery
* @version $Id$
* @copyright (c) 2007 nickvergessen nickvergessen@gmx.de http://www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

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

$lang = array_merge($lang, array(
	'INSTALL_CONGRATS_EXPLAIN'		=> '<p>Du hast das board3 Portal v%s nun erfolgreich installiert.<br/><br/><strong>Bitte lösche oder verschiebe nun das Installations-Verzeichnis „install“ oder nenne es nun um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.</strong></p>',
	'INSTALL_INTRO_BODY'			=> 'Dieser Assistent ermöglicht dir die Installation des board3 Portal in deinem phpBB-Board.',

	'MISSING_CONSTANTS'				=> 'Bevor du das Installations-Skript aufrufen kannst, musst du deine geänderten Dateien hochladen, insbesondere die includes/constants.php.',
	'MODULES_CREATE_PARENT'			=> 'Übergeordnetes Standard-Modul erstellen',
	'MODULES_PARENT_SELECT'			=> 'Übergeordnetes Modul auswählen',
	'MODULES_SELECT_4ACP'			=> 'Übergeordnetes Modul für den "Administrations-Bereich"',
	'MODULES_SELECT_NONE'			=> 'kein übergeordnetes Modul',

	'STAGE_ADVANCED_EXPLAIN'		=> 'Bitte wähle die übergeordneten Module für die Module des board3 Portal aus. Im Normalfall solltest du diese Einstellungen nicht verändern.',
	'STAGE_CREATE_TABLE_EXPLAIN'	=> 'Die von des board3 Portal genutzten Datenbank-Tabellen wurden nun erstellt und mit einigen Ausgangswerten gefüllt. Geh weiter zum nächsten Schritt, um die Installation des board3 Portal abzuschließen.',
	'STAGE_ADVANCED_SUCCESSFUL'		=> 'Die von des board3 Portal genutzten Module wurden nun erstellt. Geh weiter um die Installation des board3 Portal abzuschließen.',
	'STAGE_UNINSTALL'				=> 'Deinstallieren',
	
	'FILES_EXISTS'					=> 'Datei existiert noch',
	'FILES_OUTDATED'				=> 'Veraltete Dateien',
	'FILES_OUTDATED_EXPLAIN'		=> '<strong>Veraltete Dateien</strong> - bitte entferne die folgenden Dateien um mögliche Sicherheitslücken zu entfernen.',
	'REQUIREMENTS_EXPLAIN'			=> 'Bitte entferne erst alle veraltete Dateien auf dein Webspace, bevor mit dem Update fortfährst.',
	'NOT_REQUIREMENTS_EXPLAIN'		=> 'Es wurden keine veraltete Dateien auf dein Webspace gefunden, du kannst nun mit dem Update fortfahren.',

	'UPDATE_INSTALLATION'			=> 'board3 Portal aktualisieren',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 'Mit dieser Option kannst du deine board3 Portal-Version auf den neuesten Stand bringen.',
	'UPDATE_CONGRATS_EXPLAIN'		=> '<p>Du hast das board3 Portal nun erfolgreich auf v%s aktualisiert.<br/><br/><strong>Bitte lösche oder verschiebe nun das Installations-Verzeichnis „install“ oder nenne es nun um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.</strong></p>',
	
	'UNINSTALL_INTRO'				=> 'Willkommen bei der Deinstallation',
	'UNINSTALL_INTRO_BODY'			=> 'Dieser Assistent ermöglicht dir die deinstallation des board3 Portal durchzuführen.',
	'CAT_UNINSTALL'					=> 'Deinstallieren',
	'UNINSTALL_CONGRATS'			=> '<h1>Board3 Portal deinstalliert.</h1>
										Du hast das board3 Portal nun erfolgreich deinstalliert.',
	'UNINSTALL_CONGRATS_EXPLAIN'	=> '<strong>Bitte lösche oder verschiebe nun das Installations-Verzeichnis „install“ oder nenne es nun um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.<br /><br />Denke daran die Portal-Dateien zu löschen und Dateiänderungen am Originalsystem rückgängig zu machen.</strong></p>',

	'SUPPORT_BODY'					=> 'Für die aktuelle, stabile Version des "board3 Portal" wird kostenloser Support gewährt. Dies umfasst:</p><ul><li>Installation</li><li>Technische Fragen</li><li>Probleme durch eventuelle Fehler in der Software</li><li>Aktualisierung von Release Candidates (RC) oder stabilen Versionen zur aktuellen stabilen Version</li></ul><p>Support gibt es in folgenden Foren:</p><ul><li><a href="http://www.board3.de/">board3.de - Homepage des MOD-Autor\'s Kevin</a></li><li><a href="http://www.phpbb.de/">phpbb.de</a></li><li><a href="http://www.phpbb.com/">phpbb.com</a></li></ul><p>',
	'GOTO_INDEX'					=> 'Gehe zum Forum',
	'GOTO_PORTAL'					=> 'Gehe zum Portal',

));

?>