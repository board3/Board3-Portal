<?php
/**
*
* @package Board3 Portal v2.1 - Recent [Italian]
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
	'PORTAL_RECENT'				=> 'Recenti',
	'PORTAL_RECENT_TOPIC'		=> 'Topic recenti',
	'PORTAL_RECENT_ANN'			=> 'Annunci recenti',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Topic popolari recenti',

	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Impostazioni topic recenti',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'Qui è possibile personalizzare il blocco topic recenti.',
	'PORTAL_MAX_TOPIC'						=> 'Limite annunci recenti/topic popolari',
	'PORTAL_MAX_TOPIC_EXP'				=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Limite caratteri per ogni topic recente',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> 'Inserire 0 per rimuovere il limite',
	'PORTAL_RECENT_FORUM'					=> 'Forum topic recenti',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Specificare da quale forum recuperare i topic recenti. Lasciare in bianco per recuperare i topic recenti da tutti i forum. Se "Escludi forum" è impostato su "Sì". selezionare i forum da escludere.<br />Se "Escludi forum" è impostato su "No", selezionare i forum di cui vedere i topic recenti.<br />Selezionare/Deselezionare più forum tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Escludi forum',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Impostare su "Sì" per escludere i forum selezionati dal blocco topic recenti, "No" per vedere i topic recenti solo dai forum selezionati.',
));
