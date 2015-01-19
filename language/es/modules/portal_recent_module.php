<?php
/**
*
* @package Board3 Portal v2.1 - Recent
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
	'PORTAL_RECENT'				=> 'Recientes',
	'PORTAL_RECENT_TOPIC'		=> 'Temas recientes',
	'PORTAL_RECENT_ANN'			=> 'Anuncios recientes',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Temas recientes populares',

	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Configuración de temas recientes',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'Aquí es donde puede personalizar el bloque de temas recientes.',
	'PORTAL_MAX_TOPIC'						=> 'Límite de anuncios recientes/temas de actualidad',
	'PORTAL_MAX_TOPIC_EXP'				=> '0 significa infinito.',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Límite de caracteres para cada tema reciente',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> '0 significa infinito.',
	'PORTAL_RECENT_FORUM'					=> 'Temas recientes de los foros',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Foro(s) del cual queremos mostrar los temas recientes. Dejar en blanco para mostrar los temas recientes de todos los foros. Si "Excluir foros" se establece en "Si", seleccione el/los foro(s) que desea excluir.<br />Si "Excluir foros" se establece en "No" seleccione el/los foro(s) que desea ver.<br />Seleccione/Deseleccione múltiples foros manteniendo la tecla <samp>CTRL</samp> presionada y haciendo clic.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Excluir foros',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Seleccione "Sí" si quiere excluir los foros seleccionados del bloque de temas recientes, y "No" si desea ver sólo los foros seleccionados en el bloque de temas recientes.',
));
