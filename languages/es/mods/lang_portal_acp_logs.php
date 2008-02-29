<?php
/**
*
* mods_lang_portal_acp_logs.php [Spanish]
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
	'LOG_CONFIG_GENERAL'	=> '<strong>Portal: Altereda la configuración general</strong>',
	'LOG_CONFIG_NEWS'	=> '<strong>Portal: Altereda la configuración de noticias</strong>',
	'LOG_CONFIG_ANNOUNCEMENTS'	=> '<strong>Portal: Altereda la configuración de anuncios</strong>',
	'LOG_CONFIG_WELCOME'	=> '<strong>Portal: Altereda la configuración de mensajes de bienvenida</strong>',
	'LOG_CONFIG_RECENT'	=> '<strong>Portal: Altereda la configuración de mensajes recientes</strong>',
	'LOG_CONFIG_WORDGRAPH'	=> '<strong>Portal: Altereda la configuración de wordgraph</strong>',
	'LOG_CONFIG_PAYPAL'	=> '<strong>Portal: Altereda la configuración de donaciones paypal</strong>',
	'LOG_CONFIG_ATTACHMENTS'	=> '<strong>Portal: Altereda la configuración de adjuntos</strong>',
	'LOG_CONFIG_MEMBERS'	=> '<strong>Portal: Altereda la configuración Últimos miembros</strong>',
	'LOG_CONFIG_POLLS'	=> '<strong>Portal: Altereda la configuración de encuesta</strong>',
	'LOG_CONFIG_BOTS'	=> '<strong>Portal: Altereda la configuración Últimas visitas de bots</strong>',
	'LOG_CONFIG_POSTER'	=> '<strong>Portal: Altereda la configuración Mas escriben</strong>',
	'LOG_CONFIG_MINICALENDAR'	=> '<strong>Portal: Altereda configuración del mini calendario</strong>',
));

?>