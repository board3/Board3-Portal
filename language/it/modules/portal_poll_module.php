<?php
/**
*
* @package Board3 Portal v2.1 - Poll [Italian]
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
	'PORTAL_POLL'			=> 'Sondaggio',
	'LATEST_POLLS'			=> 'Ultimi sondaggi',
	'NO_OPTIONS'			=> 'Questo sondaggio non ha opzioni disponibili.',
	'NO_POLL'				=> 'Nessun sondaggio disponibile',
	'RETURN_PORTAL'			=> '%sTorna al portale%s',

	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Impostazioni sondaggio',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Qui è possibile personalizzare il blocco sondaggio.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Forum sondaggio',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'Specificare da quale forum recuperare i sondaggi. Lasciare in bianco per recuperare i sondaggi da tutti i forum. Se "Escludi forum" è impostato su "Sì". selezionare i forum da escludere.<br />Se "Escludi forum" è impostato su "No", selezionare i forum di cui vedere i sondaggi.<br />Selezionare/Deselezionare più forum tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Escludi forum',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Impostare su "Sì" per escludere i forum selezionati dal blocco sondaggi, "No" per vedere i sondaggi solo dai forum selezionati.',
	'PORTAL_POLL_LIMIT'					=> 'Limite sondaggi visualizzabili',
	'PORTAL_POLL_LIMIT_EXP'			=> 'Il numero di sondaggi visualizzabili nel portale.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Permetti voto',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Allow users with the required permissions to vote from the portal page.',
	'PORTAL_POLL_HIDE'					=> 'Nascondi sondaggi conclusi',
));
