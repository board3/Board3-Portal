<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( You - http://www.yourdomain.com )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
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
	'LOG_CONFIG_GENERAL'			=> '<strong>Portal: Altered general settings</strong>',
	'LOG_CONFIG_NEWS'				=> '<strong>Portal: Altered news settings</strong>',
	'LOG_CONFIG_ANNOUNCEMENTS'		=> '<strong>Portal: Altered announcements settings</strong>',
	'LOG_CONFIG_WELCOME'			=> '<strong>Portal: Altered welcome message settings</strong>',
	'LOG_CONFIG_RECENT'				=> '<strong>Portal: Altered recent topics settings</strong>',
	'LOG_CONFIG_WORDGRAPH'			=> '<strong>Portal: Altered wordgraph settings</strong>',
	'LOG_CONFIG_PAYPAL'				=> '<strong>Portal: Altered paypal donations settings</strong>',
	'LOG_CONFIG_ATTACHMENTS'		=> '<strong>Portal: Altered attachments settings</strong>',
	'LOG_CONFIG_MEMBERS'			=> '<strong>Portal: Altered latest members settings</strong>',
	'LOG_CONFIG_POLLS'				=> '<strong>Portal: Altered poll settings</strong>',
	'LOG_CONFIG_BOTS'				=> '<strong>Portal: Altered last visited bots settings</strong>',
	'LOG_CONFIG_POSTER'				=> '<strong>Portal: Altered most posters settings</strong>',
	'LOG_CONFIG_MINICALENDAR'		=> '<strong>Portal: Altered mini calendar settings</strong>',
	'LOG_CONFIG_CUSTOMBLOCK'		=> '<strong>Portal: Altered custom block settings</strong>',
	'LOG_CONFIG_LINKS'				=> '<strong>Portal: Altered links block settings</strong>',

));

?>