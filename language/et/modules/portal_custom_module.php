<?php
/**
*
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Kohandatud plokk',
	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Kohandatud plokki seaded',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Siin on sul võimalik seadistada oma portaalile mõni kohandatud plokk',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'Sisestatud kood mille sisestasid ei ole piisavalt pikk.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Eelvaade',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Kohandatud plokki kood',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Muuda koodi kohandatud väikese plokki jaoks (HTML või BBkood) siin.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Kohandatud plokki õigused',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Vali grupid, kellel on õigus seda kohandatud plokki näha. Kui soovid, et kõik kasutajad näeksid seda kohandatud plokki, siis ära vali midagi.<br />Vali/Valik maha grupidelt hoides  klahvi <samp>CTRL</samp> all, ning klikides.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Aktiveeri BBkood kohandatud plokile',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'BBkoodi kasutatakse selles kastis. Kui, BBkood ei ole aktiveeritud, saab kasutada HTML koodi.',
));
