<?php
/**
*
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'Viimased uudised',
	'READ_FULL'				=> 'Loe kõiki',
	'NO_NEWS'				=> 'Uudiseid pole',
	'POSTED_BY'				=> 'Postitas',
	'COMMENTS'				=> 'Kommentaare',
	'VIEW_COMMENTS'			=> 'Vaata kommentaare',
	'PORTAL_POST_REPLY'		=> 'Kirjuta kommentaar',
	'TOPIC_VIEWS'			=> 'Vaatamisi',
	'JUMP_NEWEST'			=> 'Hüppa uusimasse postitusse',
	'JUMP_FIRST'			=> 'Hüppa esimesse postitusse',
	'JUMP_TO_POST'			=> 'Hüppa postitusse',
	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Uudiste seaded',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Siin on sul võimalik kohandada uudiste plokki.',
	'PORTAL_NEWS_STYLE'					=> 'Kompaktne uudiste plokki stiil',
	'PORTAL_NEWS_STYLE_EXP'			=> '"Jah" tähendab, et kasutatakse kompaktset stiili uudistele. "Ei" tähendab, et kasutatakse suurt stiili (teksti vaade).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Näita kõiki artikleid sellest foorumist',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Samuti kleebised.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Näidatavate uudiste artiklite arv portaalis',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 tähendab lõpmatut',
	'PORTAL_NEWS_LENGTH'				=> 'Maksimaalne pikkus artiklil',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 tähendab lõpmatut',
	'PORTAL_NEWS_FORUM' 				=> 'Uudiste foorum',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Foorum(id), kust võetakse artiklid, jättes tühjaks võetakse kõikidest foorumitest. Kui "Välistatud foorumid" on seadistatud "Jah", siis vali foorumid mida sa soovid välistada.<br />Kui "Välistatud foorumid" on seadistatud "Ei", siis vali foorumid, mida sa soovid näidata.<br />Vali/Valik maha mitmelt foorumilt korraga hoides klaviatuuril <samp>CTRL</samp> klahvi all, ning klikides.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Välistatud foorumid',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Vali "Jah", kui soovid välistada valitud foorumid uudiste plokist, ning vali "Ei", kui soovid näidata ainult valituid foorumeid uudiste plokis.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Luba/keela õigused',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Võta foorumi vaatamise õigused kaasa, kui näidatakse uudiseid',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Sorteeri uusimate postituste järgi',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'Kui lubatud, siis uusimad sorteeritakse uusimate postituste järgi teemas. Kui keelatud, siis uudised sorteeritakse uusima teema järgi.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Luba uudiste arhiivi süsteem',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Kui lubatud, siis uudiste arhiivi süsteem / lehekülje numbreid näidatakse.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Näita vastuste ja vaatamiste arvu',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'See seade puudutab kompaktset plokki.<br />Kui valitud Jah, siis vastuste ja vaatamiste arv on näidatud kahes eraldi kolumnis. Kui valitud Ei, siis vastuste ja vaatamiste arv on näidatud foorumi nime kõrval. Vali EI, kui sul esineb probleeme eraldi kolumni näitamisel, mis nõuab juurde lisa laiust.',
));
