<?php
/**
*
* @package Board3 Portal v2.1 - Main Menu [Italian]
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
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Contenuto',
	'M_ACP'		=> 'PCA',
	'M_HELP'	=> 'Aiuto',
	'M_BBCODE'	=> 'FAQ BBCode',
	'M_TERMS'	=> 'Termini di Servizio',
	'M_PRV'		=> 'Informativa sulla privacy',
	'M_SEARCH'	=> 'Cerca',
	'MENU_NO_LINKS'	=> 'Nessun collegamento',

	// ACP
	'ACP_PORTAL_MENU'				=> 'Impostazioni menù',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Impostazioni collegamento',
	'ACP_PORTAL_MENU_EXP'			=> 'Gestisci il menù principale',
	'ACP_PORTAL_MENU_MANAGE'		=> 'gestisci menù',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Qui è possibile cambiare i collegamenti del proprio menù principale.',
	'ACP_PORTAL_MENU_CAT'			=> 'Categoria',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Imposta come categoria di collegamento speciale',
	'ACP_PORTAL_MENU_INT'			=> 'Collegamento interno',
	'ACP_PORTAL_MENU_EXT'			=> 'Collegamento esterno',
	'ACP_PORTAL_MENU_TITLE'			=> 'Titolo',
	'ACP_PORTAL_MENU_URL'			=> 'URL collegamento',
	'ACP_PORTAL_MENU_ADD'			=> 'Aggiungi nuovo collegamento di navigazione',
	'ACP_PORTAL_MENU_TYPE'			=> 'Tipo di collegamento',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Se il collegamento punta a una pagina di questo sito, usa "Collegamento interno" per evitare disconnessioni indesiderate.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'È necessario prima creare una categoria.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Collegamenti esterni:<br />I collegamenti esterni devono contenere http://<br /><br />Collegamenti interni:<br />Inserire semplicemente il file php come collegamento (per esempio index.php?style=4).',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Permessi collegamenti',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Selezionare i gruppi autorizzati a vedere i collegamenti. Se si vuole che tutti possano vedere i collegamenti, non selezionare alcun gruppo.<br />Selezionare/Deselezionare più gruppi tenendo premuto <samp>CTRL</samp> e cliccando.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Apri collegamenti esterni in una nuova finestra',

	// Errors
	'NO_LINK_TITLE'					=> 'You must enter a title for this link.',
	'NO_LINK_URL'					=> 'You must enter a link URL.',
));
