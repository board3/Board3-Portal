<?php
/**
* @package Portal - Links
* @version $Id: portal_main_menu_module.php 700 2010-10-03 09:22:47Z marc1706 $
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'PORTAL_LINKS'		=> 'Links',
	'LINKS_NO_LINKS'	=> 'No links', 
	
	// ACP
	'ACP_PORTAL_LINKS'				=> 'Link Settings',
	'ACP_PORTAL_LINKS_EXP'			=> 'Customize the links listed in the links block',
	// @todo: Add necessary language variables
));

?>