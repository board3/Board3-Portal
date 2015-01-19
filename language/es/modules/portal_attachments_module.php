<?php
/**
*
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'Descargas',
	'NO_ATTACHMENTS'		=> 'No hay archivos adjuntos',
	'PORTAL_ATTACHMENTS'	=> 'Adjuntos',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Configuración de los archivos adjuntos',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'Aquí es donde puede personalizar el bloque de archivos adjuntos.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Límite de archivos adjuntos a mostrar',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> '0 significa infinito.',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Adjuntos de foros',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'Foro(s) del cual queremos mostrar los archivos adjuntos. Si "Excluir foros" se establece en "Si", seleccione el/los foro(s) que desea excluir.<br />Si "Excluir foros" se establece en "No" seleccione el/los foro(s) que desea ver.<br />Seleccione/Deseleccione múltiples foros manteniendo la tecla <samp>CTRL</samp> presionada y haciendo clic.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Excluir foros',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Seleccione "Sí" si quiere exluir los adjuntos de los foros seleccionados del bloque de archivos adjuntos, y "No " si desea ver sólo los adjuntos de los foros seleccionados en el bloque de archivos adjuntos.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Límite de caracteres para los archivos adjuntos',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> '0 significa infinito.',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Tipos de Archivos',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'Si "Excluir tipos de archivo" está establecida en "Sí", seleccione los tipos de archivo que desea excluir.<br />Si "Excluir tipos de archivo" está establecida en "No", seleccione los tipos de archivos que desea ver.<br />Seleccione/Deseleccione múltiples tipos de archivos manteniendo la tecla <samp>CTRL</samp> presionada y haciendo clic.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Excluir tipos de Archivos',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Seleccione "Si" si desea de excluir los tipos de archivos seleccionados en el bloque de archivos adjuntos, y "No" si desea ver sólo los tipos de archivos seleccionados en el bloque de archivos adjuntos.',
));
