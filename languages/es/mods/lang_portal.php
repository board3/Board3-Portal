<?php
/**
*
* mods_lang_portal.php [Spanish]
*
* @package language
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @author 2008-02-29 - HuanManwe
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'PORTAL'	=> 'Portal',
	'WELCOME'	=> 'Bienvenido',
	'PORTAL_ERROR'	=> 'Portal Error',
	'PORTAL_DELETE_DIR'	=> 'Por favor, elimine el directorio de instalación del portal: %s',
	'PORTAL_UPDATE'	=> 'Actualización del Portal',
	'PORTAL_UPDATE_TEXT'	=> 'Hay una actualización para el portal a la espera de ser instalado! Instale <a href="%1$s">%2$s</a>!',
	'LATEST_ANNOUNCEMENTS'	=> 'Últimos anuncios globales',
	'GLOBAL_ANNOUNCEMENT'	=> 'Anuncio global',
	'LATEST_NEWS'	=> 'Últimas noticias',
	'READ_FULL'	=> 'Leer todo',
	'NO_NEWS'	=> 'No hay noticias',
	'NO_ANNOUNCEMENTS'	=> 'No hay anuncios globales ',
	'POSTED_BY'	=> 'Escrito por',
	'COMMENTS'	=> 'Comentarios',
	'VIEW_COMMENTS'	=> 'Ver comentarios',
	'POST_REPLY'	=> 'Escribir comentarios',
	'TOPIC_VIEWS'	=> 'Vistas',
	'JUMP_NEWEST'	=> 'Ir a mensaje reciente',
	'JUMP_FIRST'	=> 'Ir al primer mensaje',
	'JUMP_TO_POST'	=> 'Ir al mensaje',
	'BACK'	=> 'Regresar',
	'WIO_TOTAL'	=> 'Total',
	'WIO_REGISTERED'	=> 'Registrado',
	'WIO_HIDDEN'	=> 'Oculto',
	'WIO_GUEST'	=> 'Invitado',
	'BIRTHDAYS_AHEAD'	=> 'En los siguientes %s días',
	'NO_BIRTHDAYS_AHEAD'	=> 'En este período, no hay miembros con cumpleaños.',
	'USER_MENU'	=> 'Menú del Usuario',
	'UM_LOG_ME_IN'	=> 'Recuerdame',
	'UM_HIDE_ME'	=> 'Ocultame',
	'UM_MAIN_SUBSCRIBED'	=> 'Suscripciones',
	'UM_BOOKMARKS'	=> 'Marcadores',
	'ST_TOP'	=> 'Total',
	'ST_TOP_ANNS'	=> 'Total anuncios',
	'ST_TOP_STICKYS'	=> 'Total fijos',
	'ST_TOT_ATTACH'	=> 'Total adjuntos',
	'SH'	=> 'ir',
	'SH_SITE'	=> 'foro',
	'SH_POSTS'	=> 'mensajes',
	'SH_AUTHOR'	=> 'Autor',
	'SH_ENGINE'	=> 'Motores de búsqueda',
	'SH_ADV'	=> 'Búsqueda avanzada',
	'RECENT_NEWS'	=> 'Recientes',
	'RECENT_TOPIC'	=> 'Mensajes recientes',
	'RECENT_ANN'	=> 'Anuncios recientes',
	'RECENT_HOT_TOPIC'	=> 'Recientes temas popular',
	'RND_MEMBER'	=> 'Usuario aleatorio',
	'RND_JOIN'	=> 'Unirse',
	'RND_POSTS'	=> 'Mensajes',
	'RND_OCC'	=> 'Ocupación',
	'RND_FROM'	=> 'Lugar',
	'RND_WWW'	=> 'Web page',
	'TOP_POSTER'	=> 'Mas escriben',
	'DOWNLOADS'	=> 'Descargas',
	'LINKS'	=> 'Enlaces',
	'LATEST_MEMBERS'	=> 'Últimos miembros',
	'DONATION'	=> 'Haz una donación',
	'DONATION_TEXT'	=> 'Es una formación que prestan servicios sin la intención de los eventuales ingresos. Todo aquel que quiera apoyar a esta formación pueden hacerlo donando a fin de que el costo del servidor, el dominio y se puede pagar, etc.',
	'PAY_MSG'	=> 'Después de seleccionar la cantidad que desea donar en el menú, puede ir haciendo clic en la imagen de PayPal.',
	'PAY_ITEM'	=> 'Haz una donación',
	'M_MENU'	=> 'Menu',
	'M_CONTENT'	=> 'Contenido',
	'M_ACP'	=> 'ACP',
	'M_HELP'	=> 'Ayuda',
	'M_BBCODE'	=> 'BBCode FAQ',
	'M_TERMS'	=> 'Terminos de uso',
	'M_PRV'	=> 'Política de privacidad',
	'M_SEARCH'	=> 'Buscar',
	'LINK_US'	=> 'Enlacese a nosotros',
	'LINK_US_TXT'	=> 'Por favor, siéntase libre para vincular a <strong>%s</strong>. Utilice el siguiente HTML:',
	'FRIENDS'	=> 'Amigos',
	'FRIENDS_OFFLINE'	=> 'Offline',
	'FRIENDS_ONLINE'	=> 'Online',
	'NO_FRIENDS'	=> 'No hay amigos definidos en la actualidad',
	'NO_FRIENDS_OFFLINE'	=> 'No hay amigos offline',
	'NO_FRIENDS_ONLINE'	=> 'No hay amigos online',
	'LAST_VISITED_BOTS'	=> 'Última %s visita de bots',
	'WORDGRAPH'	=> 'Wordgraph',
	'BOARD_STYLE'	=> 'Estilo del foro',
	'STYLE_CHOOSE'	=> 'Selecciona un estilo',
	'NO_ADMINISTRATORS_P'	=> 'No hay administradores',
	'NO_MODERATORS_P'	=> 'No hay moderadores',
	'TOPICS_PER_DAY_OTHER'	=> 'Temas por día: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Temas por día: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Mensajes por día: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Mensajes por día: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Usuarios por día: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Usuarios por día: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Temas por usuario: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Temas por usuario: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Mensajes por usuario: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Mensajes por usuario: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Mensajes por temas: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Mensajes por temas: <strong>0</strong>',
	'POLL'	=> 'Encuesta',
	'LATEST_POLLS'	=> 'Últimas encuestas',
	'NO_OPTIONS'	=> 'Esta encuesta no tiene opciones disponibles.',
	'NO_POLL'	=> 'No hay encuestas disponibles.',
	'RETURN_PORTAL'	=> '%sRegresar al portall%s',
	'CLOCK'	=> 'Reloj',
	'SPONSOR'	=> 'Patrocinadores',
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	'Mini_Cal_calendar'	=> 'Calendario',
	'Mini_Cal_add_event'	=> 'Agregar evento',
	'Mini_Cal_events'	=> 'Próximos eventos',
	'Mini_Cal_no_events'	=> 'Ninguno',
	'Mini_cal_this_event'	=> 'Este mes de vacaciones eventos',
	'View_next_month'	=> 'Mes siguiente',
	'View_previous_month'	=> 'Mes anterior',
	'Mini_Cal_date_format'	=> '%b %e',
	'Mini_Cal_date_format_Time'	=> '%H:%i',

	'mini_cal'	=> array(

		'day'	=> array(
			'1'	=> 'Lu',
			'2'	=> 'Ma',
			'3'	=> 'Mi',
			'4'	=> 'Ju',
			'5'	=> 'Vi',
			'6'	=> 'Sa',
			'7'	=> 'Do',
		),


		'month'	=> array(
			'1'	=> 'Ene',
			'2'	=> 'Feb',
			'3'	=> 'Mar',
			'4'	=> 'Abr',
			'5'	=> 'May',
			'6'	=> 'Jun',
			'7'	=> 'Jul',
			'8'	=> 'Ago',
			'9'	=> 'Sep',
			'10'	=> 'Oct',
			'11'	=> 'Nov',
			'12'	=> 'Dic',
		),


		'long_month'	=> array(
			'1'	=> 'Enero',
			'2'	=> 'Febrero',
			'3'	=> 'Marzo',
			'4'	=> 'Abril',
			'5'	=> 'Mayo',
			'6'	=> 'Junio',
			'7'	=> 'Julio',
			'8'	=> 'Agosto',
			'9'	=> 'Septiembre',
			'10'	=> 'Octubre',
			'11'	=> 'Noviembre',
			'12'	=> 'Diciembre',
		),

	),

));

?>