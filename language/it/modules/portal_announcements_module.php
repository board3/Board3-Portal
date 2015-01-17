<?php
/**
*
* @package Board3 Portal v2.1 - Announcements [Italian]
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
	'LATEST_ANNOUNCEMENTS'		=> 'Annunci globali recenti',
	'GLOBAL_ANNOUNCEMENTS'		=> 'Annunci globali',
	'GLOBAL_ANNOUNCEMENT'		=> 'Annuncio globale',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 annuncio',
	'VIEW_LATEST_ANNOUNCEMENTS' => '%d annunci',
	'READ_FULL'					=> 'Leggi tutti',
	'NO_ANNOUNCEMENTS'			=> 'Nessun annuncio globale',
	'POSTED_BY'					=> 'Di',
	'COMMENTS'					=> 'Commenti',
	'VIEW_COMMENTS'				=> 'Visualizza commenti',
	'PORTAL_POST_REPLY'			=> 'Lascia un commento',
	'TOPIC_VIEWS'				=> 'Visite',
	'JUMP_NEWEST'				=> 'Salta al messaggio più recente',
	'JUMP_FIRST'				=> 'Salta al primo messaggio',
	'JUMP_TO_POST'				=> 'Salta al messaggio',

	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Impostazioni annunci globali',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'Qui è possibile personalizzare il blocco annunci globali.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Mostra annunci globali',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Mostra blocco nel portale.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Stile compatto per il blocco annunci globali',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> 'Se impostato su "Sì" sarà usato lo stile compatto per il blocco annunci globali; se impostato su "No" sarà mostrato l\'intero contenuto.',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Numero di annunci in portale',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Periodo di esposizione dell\'annuncio (in giorni)',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Lunghezza massima annunci globali',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Forum annunci',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Specificare da quale forum recuperare gli annunci. Lasciare in bianco per recuperare gli annunci da tutti i forum. Se "Escludi forum" è impostato su "Sì". selezionare i forum da escludere.<br />Se "Escludi forum" è impostato su "No", selezionare i forum di cui vedere gli annunci.<br />Selezionare/Deselezionare più forum tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'Escludi forum',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Impostare su "Sì" per escludere i forum selezionati dal blocco annunci, "No" per vedere gli annunci solo dai forum selezionati.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'Abilita/Disabilita permessi',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'Nel mostrare gli annunci, tenere conto dei permessi utente.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Abilita sistema di archivio annunci',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'Se attivato, il sistema di archivio annunci o i numeri di pagine saranno mostrati.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Mostra numero visite e risposte',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Quest\'impostazione riguarda il blocco compatto.<br />Se impostata su "Sì", saranno mostrati i numeri di visite e risposte in due colonne ulteriori; se impostato su "No", le visite e le risposte saranno mostrate di fianco al nome del forum. Impostare su "No" per risolvere i problemi dovuti alla larghezza delle due colonne extra.',
));
