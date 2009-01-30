<?php
/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @installer based on: phpBB Gallery by nickvergessen, www.flying-bits.org
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

$lang = array_merge($lang, array(
	'INSTALL_CONGRATS_EXPLAIN'		=> '<p>Du hast das Board3 Portal v%s erfolgreich installiert.<br/><br/><strong>Bitte lösche oder verschiebe jetzt das Installations-Verzeichnis "install" oder benenne es um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.</strong></p>',
	'INSTALL_INTRO_BODY'			=> 'Dieser Assistent unterstützt dich bei der Installation des Board3 Portals in deinem phpBB-Forum.',

	'MISSING_CONSTANTS'				=> 'Bevor du das Installations-Skript aufrufen kannst, musst du die bearbeiteten Dateien hochladen, insbesondere /includes/constants.php.',
	'MODULES_CREATE_PARENT'			=> 'Übergeordnetes Standard-Modul erstellen',
	'MODULES_PARENT_SELECT'			=> 'Übergeordnetes Modul auswählen',
	'MODULES_SELECT_4ACP'			=> 'Übergeordnetes Modul für den "Administrations-Bereich"',
	'MODULES_SELECT_NONE'			=> 'kein übergeordnetes Modul',

	'STAGE_ADVANCED_EXPLAIN'		=> 'Bitte wähle die übergeordneten Module für die Module des Board3 Portals aus. Im Normalfall solltest du diese Einstellungen nicht verändern.',
	'STAGE_CREATE_TABLE_EXPLAIN'	=> 'Die vom Board3 Portal genutzten Datenbank-Tabellen wurden erstellt und mit einigen Ausgangswerten gefüllt. Gehe weiter zum nächsten Schritt, um die Installation des Board3 Portals abzuschließen.',
	'STAGE_ADVANCED_SUCCESSFUL'		=> 'Die vom Board3 Portal genutzten Module wurden erstellt. Gehe weiter um die Installation des Board3 Portals abzuschließen.',
	'STAGE_UNINSTALL'				=> 'Deinstallieren',
    
	'FILES_EXISTS'					=> 'Datei existiert noch',
	'FILES_OUTDATED'				=> 'Veraltete Dateien',
	'FILES_OUTDATED_EXPLAIN'		=> '<strong>Veraltete Dateien</strong> - bitte entferne die folgenden Dateien, um eventuelle Sicherheitslücken zu schließen.',
	'REQUIREMENTS_EXPLAIN'			=> 'Bitte entferne erst alle veralteten Dateien von deinem Server, bevor mit dem Update fortfährst.',
	'NOT_REQUIREMENTS_EXPLAIN'		=> 'Es wurden keine veraltete Dateien auf deinem Server gefunden, du kannst mit dem Update fortfahren.',

	'UPDATE_INSTALLATION'			=> 'Board3 Portal aktualisieren',
	'UPDATE_INSTALLATION_EXPLAIN' 	=> 'Mit dieser Option kannst du dein Board3 Portal auf den aktuellen Versionsstand bringen.',
	'UPDATE_CONGRATS_EXPLAIN'		=> '<p>Du hast das Board3 Portal erfolgreich auf v%s aktualisiert.<br/><br/><strong>Bitte lösche oder verschiebe jetzt das Installations-Verzeichnis "install" oder benenne es um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.</strong></p>',
    
	'UNINSTALL_INTRO'				=> 'Willkommen bei der Deinstallation',
	'UNINSTALL_INTRO_BODY'			=> 'Dieser Assistent unterstützt dich bei der De-Installation des Board3 Portals.',
	'CAT_UNINSTALL'					=> 'Deinstallieren',
	'UNINSTALL_CONGRATS'			=> '<h1>Board3 Portal deinstalliert.</h1>
                                        Du hast das Board3 Portal erfolgreich deinstalliert.',
	'UNINSTALL_CONGRATS_EXPLAIN'	=> '<strong>Bitte lösche oder verschiebe jetzt das Installations-Verzeichnis "install" oder benenne es um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.<br /><br />Denke daran die Portal-Dateien zu löschen und Dateiänderungen am Originalsystem rückgängig zu machen.</strong></p>',

	'SUPPORT_BODY'					=> 'Für die aktuelle, stabile Version des "Board3 Portal" wird kostenloser Support gewährt. Dieser umfasst:</p><ul><li>Installation</li><li>Technische Fragen</li><li>Probleme durch eventuelle Fehler in der Software</li><li>Aktualisierung von Release Candidates (RC) oder stabilen Versionen zur aktuellen stabilen Version</li></ul><p>Support gibt es in folgenden Foren:</p><ul><li><a href="http://www.board3.de/">board3.de - Homepage des MOD-Autor\'s Kevin</a></li><li><a href="http://www.phpbb.de/">phpbb.de</a></li><li><a href="http://www.phpbb.com/">phpbb.com</a></li></ul><p>',
	'GOTO_INDEX'					=> 'Gehe zum Forum',
	'GOTO_PORTAL'					=> 'Gehe zum Portal',

	'CAT_CONVERT'					=> 'phpBB3 Portal konvertieren',
	'CONVERT_P3P_INTRO'				=> 'Konverter vom „phpBB3 Portal“ zur „Board3 Portal“',
	'STAGE_REMOVE_P3P'				=> 'phpBB3 Portal entfernen',
	'STAGE_REMOVE_TABLE'			=> 'Datenbank-Tabellen entfernt',
	'STAGE_REMOVE_TABLE_EXPLAIN'	=> 'Die vom phpBB3 Portal genutzten Datenbank-Tabellen wurden erfolgreich entfernt. Gehe weiter um die Installation des Board3 Portals abzuschließen.',
	'CONVERT_COMPLETE_EXPLAIN'		=> 'Du hast nun dein phpBB3 Portal erfolgreich auf das Board3 Portal v%s konvertiert.<br /><br /><strong>Bitte lösche oder verschiebe jetzt das Installations-Verzeichnis "install" oder benenne es um, bevor du dein Board benutzt. Solange dieses Verzeichnis existiert, ist nur der Administrations-Bereich zugänglich.</strong>',
));

?>