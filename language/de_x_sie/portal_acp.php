<?php
/**
*
* @package Board3 Portal v2.3
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
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
	$lang = [];
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


$lang = array_merge($lang, [
	// Portal Module
	'ACP_PORTAL_MODULES_EXP'		=> 'Sie können Ihre Portal Module hier verwalten. Falls Sie alle Module deaktivieren, dann deaktivieren Sie bitte auch das Portal.',

	'MODULE_POS_TOP'				=> 'Oben',
	'MODULE_POS_LEFT'				=> 'Linke Spalte',
	'MODULE_POS_RIGHT'				=> 'Rechte Spalte',
	'MODULE_POS_CENTER'				=> 'Mittlere Spalte',
	'MODULE_POS_BOTTOM'				=> 'Unten',
	'ADD_MODULE'					=> 'Modul Hinzufügen',
	'CHOOSE_MODULE'					=> 'Modul Auswählen',
	'CHOOSE_MODULE_EXP'				=> 'Wähle ein Modul von der Dropdown-Liste',
	'SUCCESS_ADD'					=> 'Das Modul wurde erfolgreich hinzugefügt.',
	'SUCCESS_DELETE'				=> 'Das Modul wurde erfolgreich entfernt.',
	'NO_MODULES'					=> 'Es wurden keine Module gefunden.',
	'MOVE_RIGHT'					=> 'Nach rechts',
	'MOVE_LEFT'						=> 'Nach links',
	'B3P_FILE_NOT_FOUND'			=> 'Die angegebene Datei konnte nicht gefunden werden',
	'UNABLE_TO_MOVE'				=> 'Es ist nicht möglich den Block in die gewählte Spalte zu verschieben.',
	'UNABLE_TO_MOVE_ROW'			=> 'Es ist nicht möglich den Block in die gewählte Reihe zu verschieben.',
	'UNABLE_TO_ADD_MODULE'			=> 'Es ist nicht möglich den Block in die gewählte Spalte hinzuzufügen.',
	'DELETE_MODULE_CONFIRM'			=> 'Sind Sie sicher, dass Sie das Modul "%1$s" löschen möchtest?',
	'MODULE_RESET_SUCCESS'			=> 'Modul Einstellungen erfolgreich zurückgesetzt.',
	'MODULE_RESET_CONFIRM'			=> 'Sind Sie sicher, dass Sie diese Einstellungen des Moduls "%1$s" zurücksetzen möchten?',
	'MODULE_NOT_EXISTS'				=> 'Das gewählte Modul existiert nicht.',

	'MODULE_OPTIONS'			=> 'Modul Optionen',
	'MODULE_NAME'				=> 'Modul Name',
	'MODULE_NAME_EXP'			=> 'Geben Sie hier den Namen ein der für das Modul in der Modul Konfiguration angezeigt werden soll.',
	'MODULE_IMAGE'				=> 'Modul Bild',
	'MODULE_IMAGE_EXP'			=> 'Geben Sie hier den Dateinamen des Modul Bildes ein. Das Bild muss sich im Verzeichnis styles/all/theme/images/portal/ befinden.',
	'MODULE_PERMISSIONS'		=> 'Modul Berechtigungen',
	'MODULE_PERMISSIONS_EXP'	=> 'Wählen Sie die Gruppen aus, die berechtigt sein sollen, das Modul zu sehen. Sollen alle Benutzer das Modul sehen können, wählen Sie nichts aus.<br />An- / abwählen mehrerer Gruppen indem man <samp>Strg</samp> gedrückt hält und klickt.',
	'MODULE_IMAGE_WIDTH'		=> 'Modul Bild Breite',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Geben Sie hier die Breite des Modul Bildes in Pixeln ein.<br>Wenn kein Modul Bild gewünscht, geben Sie <strong>0</strong> als Wert ein.',
	'MODULE_IMAGE_HEIGHT'		=> 'Modul Bild Höhe',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Geben Sie hier die Höhe des Modul Bildes in Pixeln ein.',
	'MODULE_RESET'				=> 'Modul Einstellungen zurücksetzen',
	'MODULE_RESET_EXP'			=> 'Dies wird alle Einstellungen des Moduls auf die Standardeinstellungen zurücksetzen!<br>Aus technischen Gründen muss nach dem Zurücksetzen auf die Standardeinstellungen, das FA Icon erneut eingeben werden!<br>Passende Icons können der <a href="https://github.com/board3/Board3-Portal/wiki#empfohlene-fa-icons--recommended-fa-icons" target="_blank" rel="noopener noreferrer"><strong>Liste empfohlener FA-Icons</strong></a> entnommen werden.',
	'MODULE_STATUS'				=> 'Aktiviere Modul',
	'MODULE_ADD_ONCE'			=> 'Diese Modul kann nur ein Mal hinzugefügt werden.',
	'MODULE_IMAGE_ERROR'		=> 'Während dem Prüfen des Modul Bildes sind ein oder mehrere Fehler aufgetreten:',
	'UNKNOWN_MODULE_METHOD'		=> 'Die Modul Methode des %1$s Moduls konnte nicht gefunden werden.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Allgemeine Einstellungen',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portal Verwaltung',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Danke, dass Sie sich für board3 Portal entschieden haben. Auf dieser Seite können Sie Ihr Portal verwalten. Diese Anzeige gibt Ihnen einen schnellen Überblick über die verschiedenen Portal-Einstellungen.',
	'ACP_PORTAL_SHOW_ALL'					=> 'Zeige portal auf allen Seiten',
	'ACP_PORTAL_SHOW_ALL_EXP'				=> 'Zeigt das Portal auf allen Seiten des Forums an.',
	'PORTAL_ENABLE'							=> 'Portal aktivieren',
	'PORTAL_ENABLE_EXP'						=> 'Wenn deaktiviert, wird das komplette Portal abgeschaltet.',
	'PORTAL_LEFT_COLUMN'					=> 'Linke Spalte aktivieren',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Die Linke Spalte auf dem Portal anzeigen',
	'PORTAL_RIGHT_COLUMN'					=> 'Rechte Spalte aktivieren',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Die Rechte Spalte auf dem Portal anzeigen',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Breiteneinstellung der rechten und linken Spalte',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Breite der linken Spalte',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Änderen Sie hier die Breite der linken Spalte in Pixel, empfohlener Wert 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Breite der rechten Spalte',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Änderen Sie hier die Breite der rechten Spalte in Pixel, empfohlener Wert 180',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Zeige Jumpbox',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Die Jumpbox auf dem Portal anzeigen. Die Jumpbox wird nur angezeigt, wenn sie gleichzeitig unter Server-Konfiguration/Serverlast aktiviert ist.',
	'PORTAL_SHOW_ALL_SIDE'					=> 'Spalte die auf allen Seiten angezeigt werden soll',
	'PORTAL_SHOW_ALL_SIDE_EXP'				=> 'Wählen Sie aus welche Spalte auf allen seiten des Portals angezeigt werden soll.',
	'PORTAL_SHOW_ALL_LEFT'					=> 'Links',
	'PORTAL_SHOW_ALL_RIGHT'					=> 'Rechts',

	'LINK_ADDED'							=> 'Der Link wurde erfolgreich eingetragen',
	'LINK_UPDATED'							=> 'Der Link wurde erfolgreich geändert',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Füge Basismodule hinzu',
	'PORTAL_BASIC_UNINSTALL'		=> 'Entferne Module von Datenbank',

	// Font Awesome
	'ACP_FA'				=> 'Font Awesome Styles',
	'ACP_FA_EXP'			=> 'Hier können Sie einstellen welche Styles Font Awesome Icons nutzen sollen.',
	'MODULE_FA'				=> 'Font Awesome Icon',
	'MODULE_FA_EXP'			=> 'Hier können Sie ein <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener noreferrer"><strong>Font Awesome</strong></a> Icon einstellen. Dieses wird verwendet wenn der Style Font Awesome verwendet.',
	'MODULE_FA_SIZE'		=> 'Font Awesome Icongröße',
	'MODULE_FA_SIZE_EXP'	=> 'Hier können Sie die Größe des Font Awesome Icons einstellen (in Pixel).',
]);
