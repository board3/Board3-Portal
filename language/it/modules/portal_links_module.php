<?php
/**
*
* @package Board3 Portal v2.1 - Links [Italian]
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
	'PORTAL_LINKS'		=> 'Collegamenti',
	'LINKS_NO_LINKS'	=> 'Nessun collegamento',

	// ACP
	'ACP_PORTAL_LINKS'				=> 'Impostazioni collegamenti',
	'ACP_PORTAL_LINKS_EXP'			=> 'Personalizza i collegamenti elencati nel blocco collegamenti',
	'ACP_PORTAL_LINK_TITLE'			=> 'Titolo',
	'ACP_PORTAL_LINK_TYPE'			=> 'Tipo di collegamento',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'Se il collegamento punta a una pagina di questo sito, usa "Collegamento interno" per evitare disconnessioni indesiderate.',
	'ACP_PORTAL_LINK_INT'			=> 'Collegamento interno',
	'ACP_PORTAL_LINK_EXT'			=> 'Collegamento esterno',
	'ACP_PORTAL_LINK_ADD'			=> 'Aggiungi nuovo collegamento di navigazione',
	'ACP_PORTAL_LINK_URL'			=> 'URL collegamento',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'Collegamenti esterni:<br />I collegamenti esterni devono contenere http://<br /><br />Collegamenti interni:<br />Inserire semplicemente il file php come collegamento (per esempio index.php?style=4).',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Permessi collegamenti',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Selezionare i gruppi autorizzati a vedere i collegamenti. Se si vuole che tutti possano vedere i collegamenti, non selezionare alcun gruppo.<br />Selezionare/Deselezionare più gruppi tenendo premuto <samp>CTRL</samp> e cliccando.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Apri collegamenti esterni in una nuova finestra',

	// Errors
	'NO_LINK_TITLE'					=> 'È necessario inserire un titolo per questo collegamento.',
	'NO_LINK_URL'					=> 'È necessario inserire l\'URL di un collegamento.',
));
