<?php
/**
*
* @package Board3 Portal v2.1 [Italian]
* @copyright (c) 2014 Board3 Group ( www.board3.de )
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
	// Portal Modules
	'ACP_PORTAL_MODULES_EXP'		=> 'Il proprio portale può essere gestito da qui. Si consiglia di disabilitarlo qualora vengano disattivati tutti i moduli.',

	'MODULE_POS_TOP'				=> 'Cima',
	'MODULE_POS_LEFT'				=> 'Colonna sinistra',
	'MODULE_POS_RIGHT'				=> 'Colonna destra',
	'MODULE_POS_CENTER'				=> 'Colonna centrale',
	'MODULE_POS_BOTTOM'				=> 'Fondo',
	'ADD_MODULE'					=> 'Aggiungi modulo',
	'CHOOSE_MODULE'					=> 'Scegli modulo',
	'CHOOSE_MODULE_EXP'				=> 'Scegli un modulo dal menu a tendina',
	'SUCCESS_ADD'					=> 'Il modulo è stato aggiunto.',
	'SUCCESS_DELETE'				=> 'Il modulo è stato rimosso.',
	'NO_MODULES'					=> 'Nessun modulo rilevato.',
	'MOVE_RIGHT'					=> 'Sposta a destra',
	'MOVE_LEFT'						=> 'Sposta a sinistra',
	'B3P_FILE_NOT_FOUND'			=> 'Il file richiesto non è stato trovato',
	'UNABLE_TO_MOVE'				=> 'Impossibile spostare il blocco nella colonna scelta.',
	'UNABLE_TO_MOVE_ROW'			=> 'Imposssibile spostare il blocco nella riga scelta.',
	'UNABLE_TO_ADD_MODULE'			=> 'Impossibile aggiungere il modulo nella colonna scelta.',
	'DELETE_MODULE_CONFIRM'			=> 'Sei sicuro di voler rimuovere il modulo "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Le impostazioni del modulo sono state ripristinate.',
	'MODULE_RESET_CONFIRM'			=> 'Sei sicuro di voler ripristinare le impostazioni del modulo "%1$s"?',
	'MODULE_NOT_EXISTS'				=> 'Il modulo selezionato non esiste.',

	'MODULE_OPTIONS'			=> 'Opzioni modulo',
	'MODULE_NAME'				=> 'Nome modulo',
	'MODULE_NAME_EXP'			=> 'Inserire il nome del modulo da mostrare nella configurazione modulo.',
	'MODULE_IMAGE'				=> 'Immagine modulo',
	'MODULE_IMAGE_EXP'			=> 'Inserire il nome del file dell’immagine modulo. Le immagini devono trovarsi in tutte le cartelle styles/{propriostile}/theme/images/portal/',
	'MODULE_PERMISSIONS'		=> 'Permessi modulo',
	'MODULE_PERMISSIONS_EXP'	=> 'Selezionare i gruppi autorizzati alla visione del modulo. Per rendere il modulo visibile a tutti i gruppi è sufficiente non selezionare alcun gruppo.<br />Selezionare/Deselezionare più gruppi tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'MODULE_IMAGE_WIDTH'		=> 'Larghezza immagine modulo',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Inserire la larghezza dell’immagine modulo in pixel',
	'MODULE_IMAGE_HEIGHT'		=> 'Altezza immagine modulo',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Inserire l’altezza dell’immagine modulo in pixel',
	'MODULE_RESET'				=> 'Remposta modulo',
	'MODULE_RESET_EXP'			=> 'Il modulo sarà ripristinato ai valori originali!',
	'MODULE_STATUS'				=> 'Abilita modulo',
	'MODULE_ADD_ONCE'			=> 'Questo modulo può essere aggiunto una sola volta.',
	'MODULE_IMAGE_ERROR'		=> 'Errore nel controllo dell’immagine modulo:',
	'UNKNOWN_MODULE_METHOD'		=> 'Il metodo modulo del modulo %1$s non può essere risolto.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Impostazioni generali',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Gestione portale',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Grazie per aver scelto Board3 Portal! Qui è possibile gestire il proprio portale. Le opzioni in basso permettono di personalizzare le diverse impostazioni generali.',
	'ACP_PORTAL_SHOW_ALL'					=> 'Mostra portale in tutte le pagine',
	'ACP_PORTAL_SHOW_ALL_EXP'				=> 'Il portale sarà mostrato in tutte le pagine',
	'PORTAL_ENABLE'							=> 'Abilita portale',
	'PORTAL_ENABLE_EXP'						=> 'Abilita o disabilita l’intero portale',
	'PORTAL_LEFT_COLUMN'					=> 'Abilita colonna sinistra',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Impostare su "No" per nascondere la colonna sinistra',
	'PORTAL_RIGHT_COLUMN'					=> 'Abilita colonna destra',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Impostare su "No" per nascondere la colonna destra',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Mostra jumpbox',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Mostra la jumpbox nel portale. La jumpbox sarà mostrata se abilitata nelle impostazioni della board.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Impostazioni larghezza colonna sinistra e destra',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Larghezza colonna sinistra',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Cambia la larghezza della colonna destra (in pixel); il valore consigliato è 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Larghezza colonna destra',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Cambia la larghezza della colonna destra (in pixel); il valore consigliato è 180',
	'PORTAL_SHOW_ALL_SIDE'					=> 'Colonna da mostrare in tutte le pagine',
	'PORTAL_SHOW_ALL_SIDE_EXP'				=> 'Scegliere la colonna da mostrare in tutte le pagine.',
	'PORTAL_SHOW_ALL_LEFT'					=> 'Sinistra',
	'PORTAL_SHOW_ALL_RIGHT'					=> 'Destra',

	'LINK_ADDED'							=> 'Il collegamento è stato aggiunto',
	'LINK_UPDATED'							=> 'Il collegamento è stato aggiornato',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Aggiunta moduli base',
	'PORTAL_BASIC_UNINSTALL'		=> 'Rimozione dei moduli dal database',
));
