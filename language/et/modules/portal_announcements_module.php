<?php
/**
*
* @package Board3 Portal v2.1 - Announcements
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
	'LATEST_ANNOUNCEMENTS'		=> 'Viimased üldteadaanded',
	'GLOBAL_ANNOUNCEMENTS'		=> 'Üldteadaanded',
	'GLOBAL_ANNOUNCEMENT'		=> 'Üldteadaanne',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 teadaanne',
	'VIEW_LATEST_ANNOUNCEMENTS' => '%d teadaannet',
	'READ_FULL'					=> 'Loe kõiki',
	'NO_ANNOUNCEMENTS'			=> 'Pole ühtegi üldteadaannet',
	'POSTED_BY'					=> 'Postitas',
	'COMMENTS'					=> 'Kommentaare',
	'VIEW_COMMENTS'				=> 'Vaata kommentaare',
	'PORTAL_POST_REPLY'			=> 'Kirjuta kommentaar',
	'TOPIC_VIEWS'				=> 'Vaatamisi',
	'JUMP_NEWEST'				=> 'Hüppa uusimasse postitusse',
	'JUMP_FIRST'				=> 'Hüppa esimesse postitusse',
	'JUMP_TO_POST'				=> 'Hüppa postitusse',
	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Üldteadaannete seaded',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'Siin saad sa kohandada portaali üldteadaannete plokki.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Näita üldteadaandeid',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Näitab seda plokki portaalis.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Kompaktne kuju üldteadaannete plokkile',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> '"Jah" tähendab kompaktset kuju üldteadaannete plokile. "Ei" tähendab, et näidatakse üldteadaandeid suurelt (teksti vaade).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Teadaannete arv portaalis',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> '0 tähendab lõpmatut',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Päevade arv, kui teadaandeid näidatakse',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> '0 tähendab lõpmatut',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Maksimum suurus/pikkus üldteadaannetele',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> '0 tähendab lõpmatut',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Teadaannete foorumid',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Foorum(id), kust võetakse teadaanded. Jäta see tühjaks kui soovid, et teadaanded võetakse kõikidest foorumitest. Kui "Välistatud foorumid" on seadistatud "Jah", siis vali foorumid, mida soovid välistada.<br />Kui "Välistatud foorumid" on seadistatud "Ei", siis vali foorumid, mida soovid näidata.<br />Vali/Valik maha mitu foorumit korraga, hoides klaviatuuril klahvi <samp>CTRL</samp> all, ning klikides.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Välistatud foorumid',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Vali "Jah", kui soovid välistada valitud foorumid teadaannete plokist, ning vali "Ei", kui soovid näidata valituid foorumeid teadaannete plokis.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Luba/keela õigused',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'Kui näidatakse teadaandeid, siis arvestatakse ka kasutajate foorumi vaatamise õigustega.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Luba teadaannete arhiivi süsteem',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'Kui lubatud, siis teadaannete arhiivi süsteem ehk lehekülje numbreid näidatakse.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Näita vastuste ja vaatamiste arvu',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'See seade käib kompaktse plokki kohta.<br />Kui valitud Jah, siis vastuste ja vaatamiste arvu näidatakse kahes eraldi kolumnis. Kui valida Ei, siis vastuste ja vaatamiste arvu näidatakse foorumi nime kõrval. Vali EI, kui sul esineb probleeme näitamaks kahes eraldi kolumnis, mis nõuab lisa laiust juurde.',
));
