<?php
/**
*
* @package Board3 Portal v2.1 - Main Menu
* @copyright (c) 2013 Board3 Group ( www.board3.de )
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
	'M_MENU' 	=> 'Menú',
	'M_CONTENT'	=> 'Contenido',
	'M_ACP'		=> 'ACP',
	'M_HELP'	=> 'Ayuda',
	'M_BBCODE'	=> 'FAQ de BBCode',
	'M_TERMS'	=> 'Terminos de uso',
	'M_PRV'		=> 'Política de privacidad',
	'M_SEARCH'	=> 'Buscar',
	'MENU_NO_LINKS'	=> 'No hay enlaces',

	// ACP
	'ACP_PORTAL_MENU'				=> 'Configuración de Menú',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Configuración de Enlaces',
	'ACP_PORTAL_MENU_EXP'			=> 'Administre su menú principal',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Administrar menú',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Puede administrar los enlaces del menú principal aquí.',
	'ACP_PORTAL_MENU_CAT'			=> 'Categoría',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Establecer como categoría de enlaces especiales',
	'ACP_PORTAL_MENU_INT'			=> 'Enlace intero',
	'ACP_PORTAL_MENU_EXT'			=> 'Enlace externo',
	'ACP_PORTAL_MENU_TITLE'			=> 'Título',
	'ACP_PORTAL_MENU_URL'			=> 'URL del enlace',
	'ACP_PORTAL_MENU_ADD'			=> 'Agregar nuevo enlace de navegación',
	'ACP_PORTAL_MENU_TYPE'			=> 'Tipo de enlace',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Si tiene un enlace a una página del foro, seleccione "Enlace interno" para evitar desconexiones no deseadas.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'Es necesario primero crear una categoría.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Enlaces externos:<br />Todos los enlaces deben ser introducidos con un http://<br /><br />Enlaces internos:<br />Solamente introducir el archivo .php como enlace, es decir. index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Permisos de Enlaces',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Seleccione los grupos autorizados a ver el enlace. Si ningún grupo es selecionado todos los usuarios podrán ver el enlace. <br />Para seleccionar/deseleccionar multiples grupos simultaneamente, pulse <samp>CTRL</ samp> y haga clic.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Abrir enlaces externos en una nueva ventana',

	// Errors
	'NO_LINK_TITLE'          		=> 'Debe introducir un título para este enlace.',
	'NO_LINK_URL'          			=> 'Debe introducir una URL para este enlace.',
));
