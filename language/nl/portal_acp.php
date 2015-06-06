<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'ACP_PORTAL_MODULES_EXP'		=> 'Je kan je portaalmodules hier beheren. Als je alle modules uitschakelt, schakel dan ook het portaal zelf uit.',
	'MODULE_POS_TOP'				=> 'Boven',
	'MODULE_POS_LEFT'				=> 'Linker kolom',
	'MODULE_POS_RIGHT'				=> 'Rechter kolom',
	'MODULE_POS_CENTER'				=> 'Midden kolom',
	'MODULE_POS_BOTTOM'				=> 'Onder',
	'ADD_MODULE'					=> 'Voeg module toe',
	'CHOOSE_MODULE'					=> 'Kies een module',
	'CHOOSE_MODULE_EXP'				=> 'Kies een module uit de drop-down lijst',
	'SUCCESS_ADD'					=> 'De module is succesvol toegevoegd.',
	'SUCCESS_DELETE'				=> 'De module is succesvol verwijderd.',
	'NO_MODULES'					=> 'Er zijn geen modules gedetecteerd.',
	'MOVE_RIGHT'					=> 'Verplaats naar rechts',
	'MOVE_LEFT'						=> 'verplaats naar links',
	'B3P_FILE_NOT_FOUND'			=> 'Het gevraagde bestand kan niet worden gevonden',
	'UNABLE_TO_MOVE'				=> 'Het is niet mogelijk om het blok naar de geselecteerde kolom te verplaatsen.',
	'UNABLE_TO_MOVE_ROW'			=> 'Het is niet mogelijk om het blok naar de geselecteerde rij te verplaatsen.',
	'UNABLE_TO_ADD_MODULE'                  => 'Het is niet mogelijk om een module toe te voegen aan de geselecteerde kolom.',
	'DELETE_MODULE_CONFIRM'			=> 'Weet je zeker dat je de module "%1$s" wilt verwijderen?',
	'MODULE_RESET_SUCCESS'			=> 'Module instellingen succesvol gereset.',
	'MODULE_RESET_CONFIRM'			=> 'Weet je zeker dat je de instellingen van de module "%1$s" wilt resetten?',
	'MODULE_NOT_EXISTS'				=> 'De geselecteerde module bestaat niet.',
	'MODULE_OPTIONS'			=> 'Module opties',
	'MODULE_NAME'				=> 'Module naam',
	'MODULE_NAME_EXP'			=> 'Vul hier de naam van de module in die moet worden weergegeven in de module configuratie.',
	'MODULE_IMAGE'				=> 'Module-afbeelding',
	'MODULE_IMAGE_EXP'			=> 'Vul hier de bestandsnaam in van de module afbeelding. Afbeeldingen moeten in alle styles/{jouwstijl}/theme/images/portal/ mappen staan',
	'MODULE_PERMISSIONS'		=> 'Module permissies',
	'MODULE_PERMISSIONS_EXP'	=> 'Selecteer de groepen die deze module mogen zien. Als alle groepen deze module mogen zien, selecteer dan niets.<br />Selecteer/Deselecteer meerdere groepen door middel van <samp>CTRL</samp> en door te klikken.',
	'MODULE_IMAGE_WIDTH'		=> 'Module-afbeeldingsbreedte',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Breedte module-afbeelding in pixels',
	'MODULE_IMAGE_HEIGHT'		=> 'Module-afbeldingshoogte',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Hoogte module-afbeelding in pixels',
	'MODULE_RESET'				=> 'Reset module configuratie',
	'MODULE_RESET_EXP'			=> 'Hierdoor worden alle instellingen teruggezet naar de standaard configuratie!',
	'MODULE_STATUS'				=> 'Module inschakelen',
	'MODULE_ADD_ONCE'			=> 'Deze module kan maar één keer worden toegevoegd.',
	'MODULE_IMAGE_ERROR'		=> 'Er is een fout opgetreden tijdens het controleren van de module afbeelding:',
	'UNKNOWN_MODULE_METHOD'		=> 'De methode van de %1$s module kan niet worden gevonden.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Algemene instellingen',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portaal beheer',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Dank je wel voor het kiezen van Board3 Portal! Dit is de plek waar jij je portaalpagina kan beheren. Onderstaande opties geven je de mogelijkheid verschillende algemene instellingen aan te passen.',
	'PORTAL_ENABLE'							=> 'Portaal inschakelen',
	'PORTAL_ENABLE_EXP'						=> 'Schakel het hele portaal in of uit',
	'PORTAL_LEFT_COLUMN'					=> 'Linkerkolom inschakelen',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Verander naar nee als je de linkerkolom wilt uitschakelen',
	'PORTAL_RIGHT_COLUMN'					=> 'Rechterkolom inschakelen',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Verander naar nee als je de rechterkolom wilt uitschakelen',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Jumpbox weergeven',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Jumpbox op de portaalpagina weergeven. De jumpbox wordt alleen zichtbaar als je hem hebt ingeschakeld bij de forumfuncties.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Linker en rechterkolom breedte instellingen',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Breedte van de linkerkolom',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Verander de breedte van de linkerkolom in pixels; aanbevolen waarde is 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Breedte van de rechterkolom',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Verander de breedte van de rechterkolom in pixels; aanbevolen waarde is 180',
	'LINK_ADDED'							=> 'De link is succesvol toegevoegd',
	'LINK_UPDATED'							=> 'De link is succesvol gewijzigd',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Basisset van modules toevoegen',
	'PORTAL_BASIC_UNINSTALL'		=> 'Modules verwijderen uit de database',
));
