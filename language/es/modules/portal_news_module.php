<?php
/**
*
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'Últimas noticias',
	'READ_FULL'				=> 'Leer todo',
	'NO_NEWS'				=> 'No hay noticias',
	'POSTED_BY'				=> 'Escrito por',
	'COMMENTS'				=> 'Comentarios',
	'VIEW_COMMENTS'			=> 'Ver comentarios',
	'PORTAL_POST_REPLY'		=> 'Escribir comentario',
	'TOPIC_VIEWS'			=> 'Vistas',
	'JUMP_NEWEST'			=> 'Ir a último mensaje',
	'JUMP_FIRST'			=> 'Ir al primer mensaje',
	'JUMP_TO_POST'			=> 'Ir al mensaje',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Configuración de noticias',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Aquí es donde puede personalizar el bloque de noticias.',
	'PORTAL_NEWS_STYLE'					=> 'Compactar el estilo del bloque Noticias',
	'PORTAL_NEWS_STYLE_EXP'			=> '"Sí" significa usar el estilo compacto para las Noticias. "No" significa usar el estilo grande (ver texto).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Mostrar todos los artículos en este foro',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Incluye temas fijos.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Número de noticias en el Portal',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 significa infinito.',
	'PORTAL_NEWS_LENGTH'				=> 'Longitud máxima de cada noticia',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 significa infinito.',
	'PORTAL_NEWS_FORUM' 				=> 'Foros de Noticias',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Foro(s) del cual queremos mostrar las noticias. Dejar en blanco para mostrar las noticias de todos los foros. Si "Excluir foros" se establece en "Si", seleccione el/los foro(s) que desea excluir.<br />Si "Excluir foros" se establece en "No" seleccione el/los foro(s) que desea ver.<br />Seleccione/Deseleccione múltiples foros manteniendo la tecla <samp>CTRL</samp> presionada y haciendo clic.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Excluir foros',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Seleccione "Sí" si quiere excluir los foros seleccionados del bloque de noticias, y "No" si desea ver sólo los foros seleccionados en el bloque de noticias.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Habilitar/Deshabilitar permisos',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Tener en cuenta permisos de visualización de foros para mostrar las noticias.',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Ordenar empezando por el mensaje mas reciente',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'Cuando está activada, las noticias serán ordenadas según el mensaje mas reciente. Cuando está desactivada, las noticias serán ordenadas según el tema mas reciente.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Habilitar el sistema de archivo de anuncios',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Si se activa el sistema de archivo de anuncios, se mostrarán los números de página.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Mostrar el número de respuestas y opiniones',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Configuración para bloque compacto.<br />Si la respuesta es Si­, el número de respuestas y las opiniones se muestran en 2 columnas extra. Si la respuesta es No, las respuestas y opiniones se mostrará junto al nombre de foro. Seleccione No si tiene problemas con la visualización de las columnas extras debido a la anchura.',
));
