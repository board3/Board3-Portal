<?php
/**
*
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Bloque personalizado',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Configuración de bloque personalizado',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'En esta página puede editar su bloque personalizado.',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'El código que has introducido no es lo suficientemente largo.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Vista previa',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Código del bloque personalizado',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Cambiar el código (HTML o BBCode) para el bloque personalizado aquí.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Permisos de bloque personalizado',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Seleccione los grupos autorizados a ver el bloque personalizado. Si ningún grupo es selecionado todos los usuarios podrán utilizar el módulo. <br />Para seleccionar/deseleccionar multiples grupos simultaneamente, pulse <samp>CTRL</ samp> y haga clic.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Activar BBCode para el bloque personalizado',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'Se puede utilizar BBCode en este cuadro. Si el uso de BBCode no está activado, se analizará código HTML​.',
));
