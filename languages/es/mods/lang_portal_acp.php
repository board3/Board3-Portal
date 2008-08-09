<?php
/**
*
* mods_lang_portal_acp.php [Spanish]
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
	'ACP_PORTAL_INFO_SETTINGS'	=> 'Configuración general',
	'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'	=> 'Gracias por elegir board3 Portal. En esta página usted puede administrar el portal de su foro. Las pantallas de aquí le dará un panorama general de todos los distintos ajustes del portal. Los enlaces en la parte izquierda de esta pantalla le permiten controlar cada aspecto de su experiencia con el portal.',
	'ACP_PORTAL_SETTINGS'	=> 'Configuración del Portal',
	'ACP_PORTAL_SETTINGS_EXPLAIN'	=> 'Gracias por elegir board3 Portal. En esta página usted puede administrar el portal de su foro. Las pantallas de aquí le dará un panorama general de todos los distintos ajustes del portal. Los enlaces en la parte izquierda de esta pantalla le permiten controlar cada aspecto de su experiencia con el portal.',
	'ACP_PORTAL_GENERAL_INFO'	=> 'Administración del Portal',
	'ACP_PORTAL_GENERAL_INFO_EXPLAIN'	=> 'Gracias por elegir board3 Portal. En esta página usted puede administrar el portal de su foro. Las pantallas de aquí le dará un panorama general de todos los distintos ajustes del portal. Los enlaces en la parte izquierda de esta pantalla le permiten controlar cada aspecto de su experiencia con el portal.',
	'ACP_PORTAL_GENERAL_SETTINGS'	=> 'Configuración general',
	'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'	=> 'Aquí tu puedes cambiar la configuración general y ciertas opciones especificas.',
	'PORTAL_ADVANCED_STAT'	=> 'Bloque de estadísticas avanzadas.',
	'PORTAL_ADVANCED_STAT_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_LEADERS'	=> 'Bloque de Lideres / equipo',
	'PORTAL_LEADERS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_CLOCK'	=> 'Bloque del reloj',
	'PORTAL_CLOCK_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_LINK_US'	=> 'Bloque de enlácese con nosotros',
	'PORTAL_LINK_US_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_LINKS'	=> 'Bloque de enlaces',
	'PORTAL_LINKS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_BIRTHDAYS'	=> 'Bloque de cumpleaños',
	'PORTAL_BIRTHDAYS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_BIRTHDAYS_AHEAD'	=> 'Cumpleaños próximos días',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'	=> '¿Cuántos días para mostrar los cumpleaños por delante?',
	'PORTAL_SEARCH'	=> 'Bloque de búsqueda',
	'PORTAL_SEARCH_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_WELCOME'	=> 'Bloque de Centro de Bienvenida',
	'PORTAL_WELCOME_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_WHOIS_ONLINE'	=> '¿Quién está conectado?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_CHANGE_STYLE'	=> 'Cambiar estilos',
	'PORTAL_CHANGE_STYLE_EXPLAIN'	=> 'Mostrar este bloque en el portal.<br /><span style="color:red">Porfavor tome nota:</span> Si "Sobreescribe el estilo de usuario:" en la configuración del foro is esta puesto en "Si", este bloque <u>no sera mostrado</u>, independientemente de esta configuración.',
	'PORTAL_FRIENDS'	=> 'Mostrar bloque de amigos',
	'PORTAL_FRIENDS_EXPLAIN'	=> 'Muestra bloque de adjuntos',
	'PORTAL_MAX_ONLINE_FRIENDS'	=> 'Límite de amigos a mostrar',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'	=> 'Límite de la cantidad a mostrar amigos dale un valor.',
	'PORTAL_MAIN_MENU'	=> 'Menú principal',
	'PORTAL_MAIN_MENU_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_USER_MENU'	=> 'Menú del Usuario / caja de logueo',
	'PORTAL_USER_MENU_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_RANDOM_MEMBER'	=> 'Bloque de miembro aleatorio',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'ACP_PORTAL_ANNOUNCE_INFO'	=> 'Anuncio global',
	'ACP_PORTAL_ANNOUNCE_SETTINGS'	=> 'Configuración de anuncio global',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'	=> 'Aquí tu puedes cambiar la configuración e información de anuncio global y ciertas opciones especificas.',
	'PORTAL_ANNOUNCEMENTS'	=> 'Mostrar anuncios globales',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'	=> 'Compactar el estilo del bloque anuncio global',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'	=> 'Si selecciona si use el estilo compacto para anuncio global, no es estilo grande',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'	=> 'Número de anuncios en el portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_ANNOUNCEMENTS_DAY'	=> 'Número de días para mostrar el anuncio',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_ANNOUNCEMENTS_LENGTH'	=> 'Max longitud de anuncio global',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'	=> 'Global anuncio global de la ID de los foros',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Nosotros jalaremos artículos de los foros, dejar en blanco para jalar de todos los foros, separar con coma para multi-foros, ej. 1,2,5',
	'ACP_PORTAL_NEWS_INFO'	=> 'Noticias',
	'ACP_PORTAL_NEWS_SETTINGS'	=> 'Configuración de noticias',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'Aquí usted puede cambiar su información de noticias y algunas opciones específicas.',
	'PORTAL_NEWS'	=> 'Mostrar bloque de noticias',
	'PORTAL_NEWS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_NEWS_STYLE'	=> 'Compactar estilo de bloque de noticias',
	'PORTAL_NEWS_STYLE_EXPLAIN'	=> 'Si selecciona si use el estilo compacto para noticias, no es estilo grande',
	'PORTAL_SHOW_ALL_NEWS'	=> 'Mostrar todos los artículos en este foro',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'	=> 'Incluyendo fijos y anuncios.',
	'PORTAL_NUMBER_OF_NEWS'	=> 'Número de artículos de noticias en el portal',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_NEWS_LENGTH'	=> 'Max longitud de un artículo de noticias',
	'PORTAL_NEWS_LENGTH_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_NEWS_FORUM'	=> 'Noticias Foro ID',
	'PORTAL_NEWS_FORUM_EXPLAIN'	=> 'Nosotros jalaremos artículos de los foros, dejar en blanco para jalar de todos los foros, separar con coma para multi-foros, ej. 1,2,5',
	'PORTAL_EXCLUDE_FORUM'	=> 'Excluir Foro ID',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'	=> 'Nosotros jalaremos artículos de los foros, dejar en blanco para jalar de todos los foros, separar con coma para multi-foros, ej. 1,2,5',
	'ACP_PORTAL_RECENT_INFO'	=> 'Los temas más recientes',
	'ACP_PORTAL_RECENT_SETTINGS'	=> 'La configuración de los temas más recientes',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'Aquí usted puede cambiar su información de los últimos temas y algunas opciones específicas.',
	'PORTAL_RECENT'	=> 'Mostrar bloque de los últimos temas',
	'PORTAL_RECENT_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_MAX_TOPIC'	=> 'Límite de los recientes anuncios / temas candentes',
	'PORTAL_MAX_TOPIC_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_RECENT_TITLE_LIMIT'	=> 'Límite de caracteres de los últimos tema',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'	=> '0 significa infinito',
	'ACP_PORTAL_PAYPAL_INFO'	=> 'Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS'	=> 'Configuración Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Aquí usted puede cambiar su información de Paypal y ciertas opciones específicas.',
	'PORTAL_PAY_C_BLOCK'	=> 'Mostrar bloque de centro paypal',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_PAY_S_BLOCK'	=> 'Mostrar bloque pequeño paypal',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_PAY_ACC'	=> 'Paypal cuenta a utilizar',
	'PORTAL_PAY_ACC_EXPLAIN'	=> 'Ingrese su dirección de correo electrónico utilizado en paypal ej. xxx@xxx.com',
	'ACP_PORTAL_MEMBERS_INFO'	=> 'Últimos miembros',
	'ACP_PORTAL_MEMBERS_SETTINGS'	=> 'Configuración de últimos miembros',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'Aquí usted puede cambiar su información de los miembros más recientes y algunas opciones específicas.',
	'PORTAL_LATEST_MEMBERS'	=> 'Mostrar bloque de los miembros más recientes',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_MAX_LAST_MEMBER'	=> 'Límite de mostrar de miembros más recientes ',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'	=> '0 significa infinito',
	'ACP_PORTAL_BOTS_INFO'	=> 'Bots visitandonos',
	'ACP_PORTAL_BOTS_SETTINGS'	=> 'Configuración de bots visitando',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar la información de bots visitando, y ciertas opciones específicas.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'	=> 'Mostrar bloque visitar bots ',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'	=> '¿Cuantos bots para mostrar?',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 significa infinito',
	'ACP_PORTAL_POLLS_INFO'	=> 'Encuesta',
	'ACP_PORTAL_POLLS_SETTINGS'	=> 'Configuración de encuesta',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar su información de la encuesta y algunas opciones específicas.',
	'PORTAL_POLL_TOPIC'	=> 'Mostrar bloques de encuesta ',
	'PORTAL_POLL_TOPIC_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_POLL_TOPIC_ID'	=> 'Encuesta foro id(s)',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'	=> 'Las id(s) de los foros donde cuales encuestas deberian ser mostradas.Use una coma para separar varios foros, o deje en blanco para utilizar todos los foros disponibles.',
	'PORTAL_POLL_LIMIT'	=> 'Mostrar límite de encuesta',
	'PORTAL_POLL_LIMIT_EXPLAIN'	=> 'El número de encuestas que le gustaría mostrar en la página del portal.',
	'PORTAL_POLL_ALLOW_VOTE'	=> 'Permitir votar',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Permitir a los usuarios con los permisos necesarios para votar desde la página del portal.',
	'ACP_PORTAL_MOST_POSTER_INFO'	=> 'Mas escriben',
	'ACP_PORTAL_MOST_POSTER_SETTINGS'	=> 'Configuración de mas escriben',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar su información de mas escriben y algunas opciones específicas.',
	'PORTAL_TOP_POSTERS'	=> 'Mostrar bloque más / top escriben',
	'PORTAL_TOP_POSTERS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_MAX_MOST_POSTER'	=> 'Cuántos más escriben para mostrar',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'	=> '0 significa infinito',
	'ACP_PORTAL_column_WIDTH_INFO'	=> 'Ancho de columna',
	'ACP_PORTAL_column_WIDTH_SETTINGS'	=> 'Izquierda y derecha la configuración de ancho de columna',
	'PORTAL_LEFT_column_WIDTH'	=> 'Ancho valor de la columna de la izquierda',
	'PORTAL_LEFT_column_WIDTH_EXPLAIN'	=> 'Cambiar el ancho de la columna de la izquierda en píxel, valor recomendado 180',
	'PORTAL_RIGHT_column_WIDTH'	=> 'Ancho valor de la columna derecha',
	'PORTAL_RIGHT_column_WIDTH_EXPLAIN'	=> 'Cambiar el ancho de columna derecha de píxel, valor recomendado 180',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'	=> 'Adjuntos',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'	=> 'La configuración de los archivos adjuntos',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar sus archivos adjuntos de información y ciertas opciones específicas.',
	'PORTAL_ATTACHMENTS'	=> 'Mostrar el bloque de adjuntos ',
	'PORTAL_ATTACHMENTS_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_ATTACHMENTS_NUMBER'	=> 'Límite de archivos adjuntos a mostrar',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'	=> '0 significa infinito',
	'ACP_PORTAL_FRIENDS_INFO'	=> 'Amigos',
	'ACP_PORTAL_FRIENDS_SETTINGS'	=> 'Configuración de amigos',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'Aquí usted puede cambiar su información de amigos y de algunas opciones específicas.',
	'ACP_PORTAL_WORDGRAPH_INFO'	=> 'Wordgraph',
	'ACP_PORTAL_WORDGRAPH_SETTINGS'	=> 'Configuración de Wordgraph',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar su información de wordgraph  y ciertas opciones específicas.',
	'PORTAL_WORDGRAPH'	=> 'Mostrar el bloque de wordgraph',
	'PORTAL_WORDGRAPH_EXPLAIN'	=> 'Mostrar este bloque en el portal.<br /><strong>Wordgraph no funciona con texto completo mysql es seleccionada como la búsqueda de backend.</strong>',
	'PORTAL_WORDGRAPH_MAX_WORDS'	=> '¿Cuantas palabras a mostrar?',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 significa infinito',
	'PORTAL_WORDGRAPH_WORD_COUNTS'	=> 'Incluir contar con valores para mostrar',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Mostrar contar valores por palabra ej. (25).',
	'PORTAL_WORDGRAPH_RATIO'	=> 'Usado relación de aspecto palabra tamaño',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'	=> 'Cambio de la relación de aspecto (grande/pequeño) Tamaño de la palabra (Por defecto=18)',
	'ACP_PORTAL_WELCOME_INFO'	=> 'Bienvenido',
	'ACP_PORTAL_WELCOME_SETTINGS'	=> 'Configuración de bienvenido',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar los mensajes de bienvenida y algunas opciones específicas',
	'PORTAL_WELCOME_INTRO'	=> 'Mensaje de bievenida',
	'PORTAL_WELCOME_GUEST'	=> '¿Mensaje de bienvenida solo para invitados??',
	'PORTAL_WELCOME_INTRO_EXPLAIN'	=> 'Cambie el mensaje de bienvenida (Sólo texto plano). Max. 600 characteres!',
	'ACP_PORTAL_MINICALENDAR_INFO'	=> 'Mini calendario',
	'ACP_PORTAL_MINICALENDAR_SETTINGS'	=> 'Configuración de Mini calendario',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> 'Aquí puede cambiar información de su mini calendario  y ciertas opciones específicas.',
	'PORTAL_MINICALENDAR'	=> 'Mostrar el bloque de mini calendario ',
	'PORTAL_MINICALENDAR_EXPLAIN'	=> 'Mostrar este bloque en el portal.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'	=> 'Activo día de colores',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'HEX o colores con nombre se permiten tales como # FFFFFF para blanco, el color o nombres como violeta.',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR'	=> 'Colo de enlace día',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'	=> 'HEX o colores con nombre se permiten tales como # FFFFFF para blanco, el color o nombres como violeta.',
));

?>