<?php
/**
*
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'Allalaadimised',
	'NO_ATTACHMENTS'		=> 'Pole ühtegi allalaadimist',
	'PORTAL_ATTACHMENTS'	=> 'Manused',
	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Manuste seaded',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'See on koht, kus saad kohandada manuste plokki.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Piira näidatavaid manuseid',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> '0 tähendab lõpmatut',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Manused foorumitest',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'Foorum(id), kust manuseid tuleks näidata. Kui "Välistatud foorumid" väärtuseks on seadistatud "Jah", siis vali need foorumid, mida sa soovid välistada.<br />Kui "Välistatud foorumid" väärtuseks on seadistatud "Ei", siis vali need foorumid, kust sa soovid neid näidata.<br />Vali/Valik maha mitut foorumit korraga, hoides <samp>CTRL</samp> klahvi all, ning klikides.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Välistatud foorumid',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Vali "Jah", kui soovid välistada valitud foorumid manuste plokist, ning vali "Ei", kui soovid näidata ainult manuseid valitutest foorumitest.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Sümbolite piirang igale manusele',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> '0 tähendab lõpmatut',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Failitüüp',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'Kui "Välistatud failitüüp" on seadistatud "Jah", siis vali need failitüübid, mida sa soovid välistada.<br />Kui aga "Välistatud failitüüp" on seadistatud "Ei", siis vali need failitüübid, mida sa soovid näidata.<br />Vali / Valik maha mitmelt failitüübilt korraga, hoides <samp>CTRL</samp> klahvi all, ning klikides.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Välista failitüübid',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Vali "Jah", kui soovid välistada valitud failitüübid manuste plokist, ning vali "Ei", kui soovid näidata ainult valituid failitüüpe manuste plokis.',
));
