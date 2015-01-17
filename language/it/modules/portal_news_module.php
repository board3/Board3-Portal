<?php
/**
*
* @package Board3 Portal v2.1 - News
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'LATEST_NEWS'			=> 'Ultime notizie',
	'READ_FULL'				=> 'Leggi tutto',
	'NO_NEWS'				=> 'Nessuna notizia',
	'POSTED_BY'				=> 'Da',
	'COMMENTS'				=> 'Commenti',
	'VIEW_COMMENTS'			=> 'Vedi commenti',
	'PORTAL_POST_REPLY'		=> 'Lascia un commento',
	'TOPIC_VIEWS'			=> 'Visite',
	'JUMP_NEWEST'			=> 'Salta al messaggio più recente',
	'JUMP_FIRST'			=> 'Salta al primo messaggio',
	'JUMP_TO_POST'			=> 'Salta al messaggio',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Impostazioni notizie',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Qui è possibile personalizzare il blocco notizie',
	'PORTAL_NEWS_STYLE'					=> 'Stile blocco notizie compatto',
	'PORTAL_NEWS_STYLE_EXP'			=> 'Impostando "Sì" sarà usato lo stile compatto; impostando "No" sarà usato lo stile esteso.',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Mostra tutti gli articoli in questo forum',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Includi importanti.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Numero di articoli in portale',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_NEWS_LENGTH'				=> 'Lunghezza massima articoli',
	'PORTAL_NEWS_LENGTH_EXP'		=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_NEWS_FORUM' 				=> 'Forum notizie',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Specificare da quale forum recuperare le notizie. Lasciare in bianco per recuperare le notizie da tutti i forum. Se "Escludi forum" è impostato su "Sì". selezionare i forum da escludere.<br />Se "Escludi forum" è impostato su "No", selezionare i forum di cui vedere le notizie.<br />Selezionare/Deselezionare più forum tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Escludi forum',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Impostare su "Sì" per escludere i forum selezionati dal blocco notizie, "No" per vedere le notizie solo dai forum selezionati.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Abilita/Disabilita permessi',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Nel mostrare le notizie, tenere conto dei permessi utente.',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Mostra i messaggi più recenti',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'Se attivato, saranno mostrate come recenti le notizie col messaggio più recente, altrimenti saranno mostrate le notizie più recenti.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Abilita sistema di archivio notizie',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Se attivato, il sistema di archivio notizie o i numeri di pagine saranno mostrati.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Mostra numero visite e risposte',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Quest\'impostazione riguarda il blocco compatto.<br />Se impostata su "Sì", saranno mostrati i numeri di visite e risposte in due colonne ulteriori; se impostato su "No", le visite e le risposte saranno mostrate di fianco al nome del forum. Impostare su "No" per risolvere i problemi dovuti alla larghezza delle due colonne extra.',
));
