<?php
/**
*
* mods_portal_install.php [Spanish]
*
* @package language
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @author 2008-02-29 - HuanManwe
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
	'INSTALLER_MENU'	=> 'PInUp Menú',
	'INSTALLER_MENU_START'	=> 'Iniciar',
	'INSTALLER_UNINSTALL'	=> 'Desinstalar',
	'INSTALLER_UPDATE'	=> 'Actualizar',
	'INSTALLER_INSTALL'	=> 'Instalar',
	'INSTALLER_INTRO_TITLE'	=> 'Portal de Instalación/Utilidad de actualización',
	'INSTALLER_INTRO_NOTE'	=> 'Bienvenido al Portal de Instalación / utilidad de actualización, conocida como PInUp',
	'INSTALLER_MENU_DONE'	=> 'Última version',
	'INSTALLER_MENU_DONE_TEXT'	=> 'Usted ya tiene instalada la versión %s , porfavor elimine la carpeta install_portal y regrese a su <a href="%s">foro</a>.',
	'INSTALLER_INSTALL_TITLE'	=> 'PInUp Instalador',
	'INSTALLER_INSTALL_NOTE'	=> 'Cuando usted elige instalar el MOD, cualquier base de datos de versiones anteriores, se eliminará.',
	'INSTALLER_INSTALL_MENU'	=> 'Menú de Instalación',
	'INSTALLER_INSTALL_SUCCESSFUL'	=> 'La instalación del MOD v%s tuvo éxito.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'La instalación del MOD v%s <strong>no</strong> fue exitosa.',
	'INSTALLER_INSTALL_VERSION'	=> 'Instalar MOD v%s',
	'INSTALLER_INSTALL_START'	=> 'Por favor, haga clic <a href="%s">Instalar</a> para iniciar la utilidad de instalación.',
	'INSTALLER_UPDATE_TITLE'	=> 'PInUp Actualizar',
	'INSTALLER_UPDATE_NOTE'	=> 'Actualiza el MOD de v%s hacia v%s',
	'INSTALLER_UNINSTALL_TITLE'	=> 'PInUp Desinstalar',
	'INSTALLER_UNINSTALL_NOTE'	=> 'Bienvenido al menú de actualización',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'La instalación del MOD v%s fue un éxito.',
	'INSTALLER_NEEDS_ADMIN'	=> 'Debe iniciar sesión como administrador. <br /><a href="../ucp.php?mode=login"><strong>Ir al inicio de sesión</strong>',
	'INSTALLER_UPDATE_MENU'	=> 'Menú de actualización',
	'INSTALLER_UPDATE_SUCCESSFUL'	=> 'Actualización del MOD de v%s hacia v%s tuvo éxito.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'Actualización del MOD de v%s hacia v%s <strong>no</strong> fue exitosa.',
	'INSTALLER_UPDATE_VERSION'	=> 'Actualización del MOD de v%s',
	'INSTALLER_UPDATE_TO'	=> 'Actualizar a',
	'INSTALLER_UPDATE_START'	=> 'Por favor, haga clic  <a href="%s">Actualizar</a> para iniciar la utilidad de actualizar.',
	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Lo siento, PInUp No admite la desinstalación de la versión original del phpBB3 Portal.',
	'INSTALLER_ERROR'	=> 'PInUp Error',
	'INSTALLER_USEFUL_INFO'	=> 'Por favor, borrar el directorio o carpeta  /install_portal',
	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Recuerde eliminar los archivos del portal y remover los archivos editados.',
	'WARNING'	=> 'Advertencia',
));

?>