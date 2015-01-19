<?php
/**
*
* @package Board3 Portal v2.1 - Poll
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
	'PORTAL_POLL'			=> 'Encuestas',
	'LATEST_POLLS'			=> 'Las últimas encuestas',
	'NO_OPTIONS'			=> 'Esta encuesta no tiene opciones disponibles.',
	'NO_POLL'				=> 'No hay encuestas disponibles',
	'RETURN_PORTAL'			=> '%sVolver al portal%s',

	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Configuración de encuentas',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Aquí es donde puede personalizar el bloque de encuestas.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Foro(s) de encuestas',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'Foro(s) del cual queremos mostrar las encuestas. Dejar en blanco para mostrar las encuestas de todos los foros. Si "Excluir foros" se establece en "Si", seleccione el/los foro(s) que desea excluir.<br />Si "Excluir foros" se establece en "No" seleccione el/los foro(s) que desea ver.<br />Seleccione/Deseleccione múltiples foros manteniendo la tecla <samp>CTRL</samp> presionada y haciendo clic.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Excluir foros',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Seleccione "Sí" si quiere excluir los foros seleccionados del bloque de encuestas, y "No" si desea ver sólo los foros seleccionados en el bloque de encuestas.',
	'PORTAL_POLL_LIMIT'					=> 'Límite de encuestas a mostrar',
	'PORTAL_POLL_LIMIT_EXP'			=> 'El número de encuestas que le gustaría mostrar en la página del portal.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Permitir votar',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Permitir a los usuarios con los permisos necesarios votar desde el portal.',
	'PORTAL_POLL_HIDE'					=> '¿Ocultar encuestas cuando caduquen?',
));
