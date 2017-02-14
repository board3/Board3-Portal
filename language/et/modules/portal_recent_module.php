<?php
/**
*
* @package Board3 Portal v2.1 - Recent
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
	'PORTAL_RECENT'				=> 'Hiljutised',
	'PORTAL_RECENT_TOPIC'		=> 'Hiljutised teemad',
	'PORTAL_RECENT_ANN'			=> 'Hiljutised teadaanded',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Populaarseimad teemad',
	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Hiljutiste teemade seaded',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'Siin saad sa kohandada hiljutiste teemade plokki.',
	'PORTAL_MAX_TOPIC'						=> 'Piira hiljutiste teadaannete /populaarseimaid teemasi',
	'PORTAL_MAX_TOPIC_EXP'				=> '0 tähendab lõpmatut',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Sümbolite arv igale hiljutisele teemale',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> '0 tähendab lõpmatut',
	'PORTAL_RECENT_FORUM'					=> 'Hiljutiste teemade foorumid',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Foorumid, kust võetakse teemad, jättes tühjaks võetakse kõikidest foorumitest. Kui "Välistatud foorumid" on seadistatud "Jah", siis vali need foorumid, mida soovid välistada.<br />Kui "Välistatud foorumid" on seadistatud "Ei", siis vali need foorumid, mida sa soovid näidata.<br />Vali/Valik maha mitmelt korraga hoides klaviatuuril <samp>CTRL</samp> klahvi all, ning klikides.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Välistatud foorumid',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Vali "Jah", kui soovid välistada valitud foorumid hiljutised teemad plokist, ning vali "Ei", kui soovid näidata ainult valituid teemasi antud plokis.',
));
