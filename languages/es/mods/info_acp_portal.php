<?php
/**
*
* mods_info_acp_portal.php [Spanish]
*
* @package language
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @author 2008-02-28 - HuanManwe
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
	'ACP_PORTAL_INFO'	=> 'Portal',
	'ACP_PORTAL_GENERAL_INFO'	=> 'Configuración general',
	'ACP_PORTAL_ANNOUNCE_INFO'	=> 'Anuncio global',
	'ACP_PORTAL_NEWS_INFO'	=> 'Noticias',
	'ACP_PORTAL_RECENT_INFO'	=> 'Temas recientes',
	'ACP_PORTAL_WORDGRAPH_INFO'	=> 'Wordgraph',
	'ACP_PORTAL_PAYPAL_INFO'	=> 'Donaciones Paypal',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'	=> 'Adjuntos',
	'ACP_PORTAL_MEMBERS_INFO'	=> 'Últimos miembros',
	'ACP_PORTAL_POLLS_INFO'	=> 'Encuesta',
	'ACP_PORTAL_BOTS_INFO'	=> 'Última visita bots',
	'ACP_PORTAL_MOST_POSTER_INFO'	=> 'Mas escriben',
	'ACP_PORTAL_WELCOME_INFO'	=> 'Mensaje de bienvenida',
	'ACP_PORTAL_ADS_INFO'	=> 'Publicidad',
	'ACP_PORTAL_MINICALENDAR_INFO'	=> 'Mini calendario',
));

?>