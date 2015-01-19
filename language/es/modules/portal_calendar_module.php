<?php
/**
*
* @package Board3 Portal v2.1 - Calendar
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
	'PORTAL_CALENDAR'			=> 'Calendario',
	'VIEW_NEXT_MONTH'		=> 'Mes siguiente',
	'VIEW_PREVIOUS_MONTH'	=> 'Mes anterior',
	'EVENT_START'			=> 'Desde',
	'EVENT_END'				=> 'Para',
	'EVENT_TIME'			=> 'Tiempo',
	'EVENT_ALL_DAY'			=> 'Todo el día',
	'CURRENT_EVENTS'		=> 'Eventos actuales',
	'NO_CUR_EVENTS'			=> 'No hay eventos',
	'UPCOMING_EVENTS'		=> 'Próximos eventos',
	'NO_UPCOMING_EVENTS'	=> 'No hay próximos eventos',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Do',
			'2'	=> 'Lu',
			'3'	=> 'Ma',
			'4'	=> 'Mi',
			'5'	=> 'Ju',
			'6'	=> 'Vi',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Ene.',
			'2'	=> 'Feb.',
			'3'	=> 'Mar.',
			'4'	=> 'Abr.',
			'5'	=> 'May',
			'6'	=> 'Jun.',
			'7'	=> 'Jul.',
			'8'	=> 'Ago.',
			'9'	=> 'Sep.',
			'10'=> 'Oct.',
			'11'=> 'Nov.',
			'12'=> 'Dic.',
		),

		'long_month'=> array(
			'1'	=> 'Enero',
			'2'	=> 'Febrero',
			'3'	=> 'Marzo',
			'4'	=> 'Abril',
			'5'	=> 'Mayo',
			'6'	=> 'Junio',
			'7'	=> 'Julio',
			'8'	=> 'Agosto',
			'9'	=> 'Septiembre',
			'10'=> 'Octubre',
			'11'=> 'Noviembre',
			'12'=> 'Diciembre',
		),
	),

	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Ajustes del calendario',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Aquí es donde puede personalizar el bloque de calendario.',
	'ACP_PORTAL_EVENTS'						=> 'Eventos del Calendario',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Color del día actual',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'	=> 'Se permiten colores en formato HEX como #FFFFFF para blanco, o el nombre del color como violet.',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Color para el Domingo',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'	=> 'Se permiten colores en formato HEX como #FFFFFF para blanco, o el nombre del color como violet.',
	'PORTAL_LONG_MONTH'						=> 'Mostrar nombres de los meses completos',
	'PORTAL_LONG_MONTH_EXP'				=> 'Si está desactivado, el nombre de los meses se reducirán por ejemplo, Ago. en lugar de Agosto.',
	'PORTAL_SUNDAY_FIRST'					=> 'Primer día de la semana',
	'PORTAL_SUNDAY_FIRST_EXP'			=> 'Si está desactivado el calendario mostrará Lu. --> Do., sino Sa. --> Do.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Mostrar eventos',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Mostrar los eventos que se han creado en el bloque de calendario',
	'PORTAL_EVENTS_MANAGE'					=> 'Gestionar eventos',
	'NO_EVENT_TITLE'						=> 'No ha especificado un título para el evento.',
	'NO_EVENT_START'						=> 'No ha especificado la hora de comienzo del evento.',
	'ADD_EVENT'								=> 'Añadir un nuevo evento',
	'EVENT_UPDATED'							=> 'Evento actualizado correctamente.',
	'EVENT_ADDED'							=> 'Evento añadido correctamente.',
	'NO_EVENT'								=> 'Sin eventos especificados.',
	'EVENT_TITLE'							=> 'Título del evento',
	'EVENT_DESC'							=> 'Descripción del evento',
	'EVENT_LINK'							=> 'Enlace del evento',
	'EVENT_LINK_EXP'						=> 'Introduzca el enlace a un tema o página web con el mensaje de publicación, o la discusión del evento.',
	'NO_EVENTS'								=> 'No hay eventos',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'La hora de inicio que ha introducido es incorrecta. Por favor, siga las instrucciones cuidadosamente.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'La hora de finalización que ha introducido es incorrecta. Por favor, siga las instrucciones cuidadosamente.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'El inicio del evento debe ser en el futuro.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Fecha de inicio del evento',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Introduzca la fecha en que comienza el evento. La fecha tiene que estar en este formato similar: DD-MM-AAAA 3:00 PM.',
	'ACP_PORTAL_EVENT_END_DATE'			=> 'Fecha de fin del evento',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Introduzca la fecha en que finaliza el evento. La fecha tiene que estar en este formato similar: DD-MM-AAAA 3:00 PM.',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'El final del evento tiene que ser posterior al inicio del evento.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Permisos de eventos',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Seleccione los grupos autorizados a ver el evento. Si ningún grupo es selecionado todos los usuarios podrán utilizar el evento.<br />Para seleccionar/deseleccionar multiples grupos simultaneamente, pulse <samp>CTRL</ samp> y haga clic.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Abrir enlaces de eventos externos en una ventana nueva',

	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Eventos actualizados</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Eventos añadidos</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Eventos eliminados</strong><br />&raquo; %s',
));
