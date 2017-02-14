<?php
/**
*
* @package Board3 Portal v2.1 - Main Menu
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Estonian translation by phpBBeesti.com (http://www.phpbbeesti.com/)
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
	'M_MENU' 	=> 'Menüü',
	'M_CONTENT'	=> 'Sisu',
	'M_ACP'		=> 'AJP',
	'M_HELP'	=> 'Abi',
	'M_BBCODE'	=> 'BBkoodi KKK',
	'M_TERMS'	=> 'Kasutamistingimused',
	'M_PRV'		=> 'Privaatsuspoliis',
	'M_SEARCH'	=> 'Otsi',
	'MENU_NO_LINKS'	=> 'Linke pole',
	// ACP
	'ACP_PORTAL_MENU'				=> 'Menüü seaded',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Lingi seaded',
	'ACP_PORTAL_MENU_EXP'			=> 'Halda oma peamist menüüd',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Halda menüüd',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Siin saad hallata linke oma peamenüüs.',
	'ACP_PORTAL_MENU_CAT'			=> 'Kategooria',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Set as special link category',
	'ACP_PORTAL_MENU_INT'			=> 'Sisemine link',
	'ACP_PORTAL_MENU_EXT'			=> 'Väline link',
	'ACP_PORTAL_MENU_TITLE'			=> 'Pealkiri',
	'ACP_PORTAL_MENU_URL'			=> 'Lingi URL',
	'ACP_PORTAL_MENU_ADD'			=> 'Lisa uus navigatsiooni link',
	'ACP_PORTAL_MENU_TYPE'			=> 'Lingi tüüp',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Kui sul on link, mis suunab edasi sinu foorumi, siis vali "Sisemine link", vältimaks mitte soovituid väljalogimisi.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'Sa pead looma esmalt kategooria.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Välised lingid:<br />Kõik lingid peaksid olema sisestatud koos http://<br /><br />Sisemised lingid:<br />Sisesta ainult php fail lingi url väljale, näiteks: index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Lingi õigused',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Vali grupid, kellel on õigus näha linki. Kui aga soovid, et kõik kasutajad näeksid linki, siis ära vali mitte kui midagi.<br />Vali/Valik maha mitmelt grupilt korraga, hoides klaviatuuril <samp>CTRL</samp> klahvi, ning klikides hiirt.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Ava välised lingid uues aknas',
	// Errors
	'NO_LINK_TITLE'					=> 'Sa pead sisestama pealkirja sellele lingile.',
	'NO_LINK_URL'					=> 'Sa pead sisestama lingile URL\'i.',
));
