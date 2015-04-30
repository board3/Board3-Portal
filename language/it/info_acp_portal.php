<?php
/**
*
* @package Board3 Portal v2.1 [Italian]
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
	'ACP_PORTAL_MODULES'		=> 'Moduli portale',
	'ACP_PORTAL'			=> 'Portale',
	'ACP_PORTAL_GENERAL_INFO'	=> 'Impostazioni generali',
	'ACP_PORTAL_UPLOAD'		=> 'Carica modulo',

	// Portal logs
	'LOG_PORTAL_LINK_ADDED'				=> '<strong>Impostazioni portale modificate</strong><br />&raquo; Collegamento aggiunto: %s ',
	'LOG_PORTAL_LINK_UPDATED'			=> '<strong>Impostazioni portale modificate</strong><br />&raquo; Collegamento aggiornato: %s ',
	'LOG_PORTAL_LINK_REMOVED'			=> '<strong>Impostazioni portale modificate</strong><br />&raquo; Collegamento rimosso: %s ',
	'LOG_PORTAL_EVENT_ADDED'			=> '<strong>Impostazioni portale modificate</strong><br />&raquo; Evento aggiunto: %s ',
	'LOG_PORTAL_EVENT_UPDATED'			=> '<strong>Impostazioni portale modificate</strong><br />&raquo; Evento aggiornato: %s ',
	'LOG_PORTAL_EVENT_REMOVED'			=> '<strong>Impostazioni portale modificate</strong><br />&raquo; Evento rimosso: %s ',
	'LOG_PORTAL_CONFIG'					=> '<strong>Impostazioni portale modificate</strong><br />&raquo; %s',

	// Adding the permissions
	'ACL_A_MANAGE_PORTAL'		=> 'Può modificare le impostazioni del portale',
	'ACL_U_VIEW_PORTAL'			=> 'Può visualizzare il portale',
));
