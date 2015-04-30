<?php
/**
*
* @package Board3 Portal v2.1 - Attachments [Italian]
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
	'DOWNLOADS'				=> 'Download',
	'NO_ATTACHMENTS'		=> 'Nessun allegato',
	'PORTAL_ATTACHMENTS'	=> 'Allegati',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Impostazioni allegati',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'Qui è possibile personalizzare il blocco allegati.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limite allegati mostrati',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Forum allegati',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'Specificare da quale forum recuperare gli allegati. Lasciare in bianco per recuperare gli allegati da tutti i forum. Se "Escludi forum" è impostato su "Sì". selezionare i forum da escludere.<br />Se "Escludi forum" è impostato su "No", selezionare i forum di cui vedere gli allegati.<br />Selezionare/Deselezionare più forum tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Escludi forum',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Impostare su "Sì" per escludere i forum selezionati dal blocco allegati, "No" per vedere gli allegati solo dai forum selezionati.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Limite caratteri per ogni allegato',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Tipi di file',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'Se "Escludi tipi di file" è impostato su "Sì", selezionare i tipi di file da escludere.<br />Se "Escludi tipi di file" è impostato su "No", selezionare i tipi di file da mostrare.<br />Selezionare/Deselezionare più tipi di file tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Escludi tipi di file',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Impostare su "Sì" per escludere i tipi di file selezionati dal blocco allegati, "No" per mostrare i tipi di file selezionati nel blocco allegati.',
));
