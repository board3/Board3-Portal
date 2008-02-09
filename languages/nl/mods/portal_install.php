<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) Raimon ( http://www.phpBBservice.nl  )
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

	'INSTALLER_MENU'						=> 'PInUpmenu',
	'INSTALLER_MENU_START'				=> 'Start',
	'INSTALLER_UNINSTALL'					=> 'de-installeren',
	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_INSTALL'						=> 'Installeren',

	'INSTALLER_INTRO_TITLE'				=> 'Portaal Installatie/update hulpmiddel',
	'INSTALLER_INTRO_NOTE'				=> 'Welkom op de portaal installeer/update hulpmiddel, ookwel PInUp genoemt.',

	'INSTALLER_MENU_DONE'					=> 'Laatste versie',
	'INSTALLER_MENU_DONE_TEXT'			=> 'Je hebt al versie %s geïnstalleerd, verwijder de install_portal map en keer terug naar de <a href="%s">indexpagina</a>.',

	'INSTALLER_INSTALL_TITLE'				=> 'PInUp Installatie',
	'INSTALLER_INSTALL_NOTE'				=> 'Wanneer je kiest om deze MOD te installeren, zullen vorige versies van de database worden verwijderd.',
	'INSTALLER_INSTALL_MENU'				=> 'Installatiemenu',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Installatie van de MOD v%s is succesvol gelukt.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Installatie van de MOD v%s is <strong>niet</strong> succesvol gelukt.',
	'INSTALLER_INSTALL_VERSION'			=> 'Installeer MOD v%s',
	'INSTALLER_INSTALL_START'			=> 'Klik op <a href="%s">Installatie</a> om te starten met de installatie.',

	'INSTALLER_UPDATE_TITLE'				=> 'PInUp update',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD van v%s naar v%s',

	'INSTALLER_UNINSTALL_TITLE'			=> 'PInUp de-installeren',
	'INSTALLER_UNINSTALL_NOTE'			=> 'Welkom bij het updatemenu',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'Installatie van de MOD v%s is succesvol gelukt.',

	'INSTALLER_NEEDS_ADMIN'			=> 'Je moet aangemeld zijn als beheerder.<br /><a href="../ucp.php?mode=login"><strong>ga je aanmelden</strong>.',

	'INSTALLER_UPDATE'						=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Updatemenu',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD van v%s naar v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update van de MOD van v%s naar v%s is succesvol gelukt.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'Update van de MOD van v%s naar v%s is <strong>niet</strong> succesvol gelukt.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MOD van v%s',
	'INSTALLER_UPDATE_TO'					=> 'Update naar',
	'INSTALLER_UPDATE_START'				=> 'Klik op <a href="%s">update</a> om te beginnen met de update.',

	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Sorry, PInUp ondersteunt niet de de-installatie van de orginele phpBB3 Portal.',

	'INSTALLER_ERROR'						=> 'PInUp fout',

	'INSTALLER_USEFUL_INFO'				=> 'Verwijder de /install_portal map.',

	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Vergeet niet om de portal bestanden en de aanpassingen van bestanden te verwijderen.',

	'WARNING'									=> 'Waarschuwing',
));

?>