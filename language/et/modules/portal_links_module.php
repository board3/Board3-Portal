<?php
/**
*
* @package Board3 Portal v2.1 - Links
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
	'PORTAL_LINKS'		=> 'Lingid',
	'LINKS_NO_LINKS'	=> 'Pole linke',
	// ACP => AJP
	'ACP_PORTAL_LINKS'				=> 'Lingi seaded',
	'ACP_PORTAL_LINKS_EXP'			=> 'Kohanda linke, mis asuvad linkide plokis',
	'ACP_PORTAL_LINK_TITLE'			=> 'Pealkiri',
	'ACP_PORTAL_LINK_TYPE'			=> 'Lingi tüüp',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'Kui soovid kasutada linki oma foorumi leheküljele, siis vali "Sisemine link", see hoiab ära tahtmatuid väljalogimisi.',
	'ACP_PORTAL_LINK_INT'			=> 'Sisemine link',
	'ACP_PORTAL_LINK_EXT'			=> 'Väline link',
	'ACP_PORTAL_LINK_ADD'			=> 'Lisa uus navigatsiooni link',
	'ACP_PORTAL_LINK_URL'			=> 'Lingi URL',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'Välised lingid:<br />Kõik lingid peaksid olema sisestatud koos http://<br /><br />Sisemine link:<br />Sisesta ainult  php fail lingi URL\'iks, näiteks index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Lingi õigused',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Vali grupid, kellel on õigused vaadata linki. Kui soovid, et kõik kasutajad näeksid linki, siis ära vali mitte midagi.<br />Vali/Valik maha mitmelt grupilt hoides klaviatuuril <samp>CTRL</samp> klahvi all, ning klikides.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Ava välised lingid uues aknas',
	// Errors => Vead
	'NO_LINK_TITLE'					=> 'Sa pead sisestama pealkirja sellele lingile.',
	'NO_LINK_URL'					=> 'Sa pead sisestama lingi URL\'i.',
));
