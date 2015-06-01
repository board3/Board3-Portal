<?php
/**
*
* @package Board3 Portal v2.1 - Poll
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Estonian translation by phpBBeesti.com (http://www.phpbbeesti.com/)
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
	'PORTAL_POLL'			=> 'Hääletus',
	'LATEST_POLLS'			=> 'Viimased hääletused',
	'NO_OPTIONS'			=> 'Sellel hääletusel pole saadavail valikuid.',
	'NO_POLL'				=> 'Pole hääletust saadaval',
	'RETURN_PORTAL'			=> '%sMine tagasi portaali%s',
	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Hääletuse seaded',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Siin sa saad kohandada hääletuse plokki.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Hääletuste foorumid',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'Foorumid, kust hääletused võetakse näitamiseks. Kui "Välistatud foorumid" on seadistatud "Jah", siis vali need foorumid, mida sa soovid välistada.<br />Kui "Välistatud foorumid" on seadistatud "Ei", siis vali need foorumid, kust sa soovid hääletusi näidata.<br />Vali/Valik maha mitmelt korraga, hoides klaviatuuril klahvi <samp>CTRL</samp> all ja klikides.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Välistatud foorumid',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Vali "Jah", kui soovid välistada valitud foorumid hääletuse plokist, ning vali "Ei", kui soovid näidata ainult valituid foorumeid hääletuse plokis.',
	'PORTAL_POLL_LIMIT'					=> 'Näidatavate hääletuste arv',
	'PORTAL_POLL_LIMIT_EXP'			=> 'Hääletuste arv, mida sa soovid näidata portaalis.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Luba hääletamine',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Luba kasutajatel hääletada otse portaalis, nõutud õigustega.',
	'PORTAL_POLL_HIDE'					=> 'Peida aegunud hääletused?',
));
