<?php
/**
*
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
	'ACP_PORTAL_MODULES_EXP'		=> 'Puede administrar los módulos de portal desde aquí. Si desactiva todos los módulos, por favor, recuerde también desactivar el Portal.',

	'MODULE_POS_TOP'				=> 'Arriba',
	'MODULE_POS_LEFT'				=> 'Columna izquierda',
	'MODULE_POS_RIGHT'				=> 'Columna derecha',
	'MODULE_POS_CENTER'				=> 'Columna cental',
	'MODULE_POS_BOTTOM'				=> 'Abajo',
	'ADD_MODULE'					=> 'Agregar módulo',
	'CHOOSE_MODULE'					=> 'Seleccionar módulo',
	'CHOOSE_MODULE_EXP'				=> 'Elija un módulo de la lista desplegable.',
	'SUCCESS_ADD'					=> 'El módulo se ha añadido correctamente.',
	'SUCCESS_DELETE'				=> 'El módulo se ha eliminado correctamente.',
	'NO_MODULES'					=> 'No se han encontrado módulos.',
	'MOVE_RIGHT'					=> 'Mover a la derecha',
	'MOVE_LEFT'						=> 'Mover a la izquierda',
	'B3P_FILE_NOT_FOUND'			=> 'El archivo solicitado no se encontró',
	'UNABLE_TO_MOVE'				=> 'No es posible mover el bloque a la columna seleccionada.',
	'UNABLE_TO_MOVE_ROW'			=> 'No es posible mover el bloque a la fila seleccionada.',
	'UNABLE_TO_ADD_MODULE'			=> 'No es posible añadir el módulo a la columna seleccionada.',
	'DELETE_MODULE_CONFIRM'			=> '¿Está seguro que desea eliminar el módulo "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Se restableció la configuración del módulo correctamente.',
	'MODULE_RESET_CONFIRM'			=> '¿Estás seguro de que desea restablecer la configuración del módulo "%1$s"?',
	'MODULE_NOT_EXISTS'				=> 'No existe el módulo seleccionado.',

	'MODULE_OPTIONS'			=> 'Opciones de módulo',
	'MODULE_NAME'				=> 'Nombre del módulo',
	'MODULE_NAME_EXP'			=> 'Escriba el nombre que se debe mostrar en la configuración del módulo.',
	'MODULE_IMAGE'				=> 'Imagen del módulo',
	'MODULE_IMAGE_EXP'			=> 'Escriba el nombre del archivo correspondiente a la imagen del módulo. Las imágenes deben estar todas en la carpeta styles/{suestilo}/theme/images/portal/.',
	'MODULE_PERMISSIONS'		=> 'Permisos del módulo',
	'MODULE_PERMISSIONS_EXP'	=> 'Seleccione los grupos autorizados a ver el módulo. Si ningún grupo es selecionado todos los usuarios podrán utilizar el módulo. <br />Para seleccionar/deseleccionar multiples grupos simultaneamente, pulse <samp>CTRL</ samp> y haga clic.',
	'MODULE_IMAGE_WIDTH'		=> 'Ancho de la imagen del módulo',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Introduzca el ancho en pixeles de la imagen del módulo.',
	'MODULE_IMAGE_HEIGHT'		=> 'Alto de la imagen del módulo',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Introduzca el alto en pixeles de la imagen del módulo.',
	'MODULE_RESET'				=> 'Reiniciar configuración del módulo',
	'MODULE_RESET_EXP'			=> 'Esto restablecerá todos los ajustes por defecto!',
	'MODULE_STATUS'				=> 'Habilitar módulo',
	'MODULE_ADD_ONCE'			=> 'Este módulo sólo se puede añadir una vez.',
	'MODULE_IMAGE_ERROR'			=> 'Se ha producido un error al buscar la imagen del módulo:',
	'UNKNOWN_MODULE_METHOD'		=> 'Módulo %1$s usa un método del módulo que no se pudo resolver.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Ajustes generales',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Administración del Portal',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Gracias por elegir board3 Portal! Aquí es donde puede manejar el portal de su página. Las siguientes opciones permiten personalizar la configuración general.',
	'PORTAL_ENABLE'							=> 'Habilitar Portal',
	'PORTAL_ENABLE_EXP'						=> 'Activar o desactivar todo el Portal.',
	'PORTAL_LEFT_COLUMN'					=> 'Habilitar columna izquierda',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Cambie a No si desea deshabilitar la columna de la izquierda.',
	'PORTAL_RIGHT_COLUMN'					=> 'Habilitar columna derecha',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Cambie a No si desea deshabilitar la columna de la derecha.',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Mostrar Ir a',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Mostrar Ir a en el portal. El Ir a sólo se muestra si está activo también en las Características del sitio.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Configuración de ancho de columnas izquierda y derecha',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Ancho de la columna izquierda',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Cambiar el ancho en píxeles de la columna de la izquierda; valor recomendado es de 180.',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Ancho de la columna de la derecha',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Cambiar el ancho en píxeles de la columna de la derecha; valor recomendado es de 180.',

	'LINK_ADDED'							=> 'El enlace ha sido agregado correctamente',
	'LINK_UPDATED'							=> 'El enlace ha sido actualizado correctamente',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Agregando un conjunto básico de módulos',
	'PORTAL_BASIC_UNINSTALL'		=> 'Eliminando módulos de la base de datos',
));
