<?php
/**
*
* @package Board3 Portal v2 - Latest Bots
* @copyright (c) Board3 Group ( www.board3.de )
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
	'LATEST_BOTS'			=> 'Latest Bots',
	'LAST_VISITED_BOTS'		=> 'Last visited bots',
	
	// ACP
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Visiting bots settings',
	'ACP_PORTAL_BOTS_SETTINGS_EXP'			=> 'This is where you customize the visiting bots block.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'How many bots to display',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXP'	=> '0 means infinite',
));
