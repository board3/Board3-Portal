<?php
/**
*
* @package Board3 Portal v2.1 - Links
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
	'PORTAL_LINKS'		=> 'Enlaces',
	'LINKS_NO_LINKS'	=> 'No hay enlaces',

	// ACP
	'ACP_PORTAL_LINKS'				=> 'Configuración de enlaces',
	'ACP_PORTAL_LINKS_EXP'			=> 'Personalizar los enlaces que figuran en dicho bloque',
	'ACP_PORTAL_LINK_TITLE'			=> 'Título',
	'ACP_PORTAL_LINK_TYPE'			=> 'Tipo de enlace',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'Si tiene un enlace a una página del foro, seleccione "Enlace interno" para evitar desconexiones no deseadas.',
	'ACP_PORTAL_LINK_INT'			=> 'Enlace interno',
	'ACP_PORTAL_LINK_EXT'			=> 'Enlace externo',
	'ACP_PORTAL_LINK_ADD'			=> 'Agregar nuevo enlace de navegación',
	'ACP_PORTAL_LINK_URL'			=> 'URL del enlace',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'Enlaces externos:<br />Todos los enlaces deben ser introducidos con un http://<br /><br />Enlaces internos:<br />Solamente introducir el archivo .php como enlace, es decir. index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Permisos de Enlaces',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Seleccione los grupos autorizados a ver el enlace. Si ningún grupo es selecionado todos los usuarios podrán ver el enlace. <br />Para seleccionar/deseleccionar multiples grupos simultaneamente, pulse <samp>CTRL</ samp> y haga clic.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Abrir enlaces externos en una nueva ventana',

	// Errors
	'NO_LINK_TITLE'          => 'Debe introducir un título para este enlace.',
	'NO_LINK_URL'          => 'Debe introducir una URL para este enlace.',
));
