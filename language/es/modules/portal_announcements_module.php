<?php
/**
*
* @package Board3 Portal v2.1 - Announcements
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
	'LATEST_ANNOUNCEMENTS'		=> 'Últimos Anuncios Globales',
	'GLOBAL_ANNOUNCEMENTS'		=> 'Anuncios Globales',
	'GLOBAL_ANNOUNCEMENT'		=> 'Anuncio Global',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 anuncio',
	'VIEW_LATEST_ANNOUNCEMENTS' => '%d anuncios',
	'READ_FULL'					=> 'Leer todo',
	'NO_ANNOUNCEMENTS'			=> 'No hay Anuncios Globales',
	'POSTED_BY'					=> 'Publicado por:',
	'COMMENTS'					=> 'Comentarios',
	'VIEW_COMMENTS'				=> 'Ver comentarios',
	'PORTAL_POST_REPLY'			=> 'Escribir comentario',
	'TOPIC_VIEWS'				=> 'Visitas',
	'JUMP_NEWEST'				=> 'Ir al último mensaje',
	'JUMP_FIRST'				=> 'Ir al primer mensaje',
	'JUMP_TO_POST'				=> 'Ir al mensaje',

	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Configuración de Anuncios globales',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'Aquí es donde puede personalizar el bloque de anuncios globales.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Mostrar anuncios globales',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Mostrar este bloque en el portal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Compactar el estilo del bloque Anuncio Globales',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> '"Sí" significa usar el estilo compacto para los anuncios globales. "No" significa usar el estilo grande (ver texto).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Número de anuncios en el portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> '0 significa infinito.',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Número de días a mostrar el anuncio',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> '0 significa infinito.',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Tamaño máximo de los Anuncios Globales',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> '0 significa infinito.',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Anuncios de los foros',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Foro(s) del cual queremos mostrar los anuncios. Dejar en blanco para mostrar los anuncios de todos los foros. Si "Excluir foros" se establece en "Si", seleccione el/los foro(s) que desea excluir.<br />Si "Excluir foros" se establece en "No" seleccione el/los foro(s) que desea ver.<br />Seleccione/Deseleccione múltiples foros manteniendo la tecla <samp>CTRL</samp> presionada y haciendo clic.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Excluir foros',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Seleccione "Sí" si quiere excluir los foros seleccionados del bloque de anuncios, y "No" si desea ver sólo los foros seleccionados en el bloque de anuncios.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Habilitar/Deshabilitar permisos',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'Tener en cuenta Permisos de foros de los usuarios a la hora de mostrar anuncios.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Habilitar el sistema de archivo de anuncios',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'Si se activa el sistema de archivo de anuncios, se mostrarán los números de página.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Mostrar el número de respuestas y opiniones',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Configuración para bloque compacto.<br />Si la respuesta es Si­, el número de respuestas y las opiniones se muestran en 2 columnas extra. Si la respuesta es No, las respuestas y opiniones se mostrará junto al nombre de foro. Seleccione No si tiene problemas con la visualización de las columnas extras debido a la anchura.',
));
