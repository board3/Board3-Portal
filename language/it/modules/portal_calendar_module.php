<?php
/**
*
* @package Board3 Portal v2.1 - Calendar [Italian]
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
	'PORTAL_CALENDAR'			=> 'Calendario',
	'VIEW_NEXT_MONTH'		=> 'mese successivo',
	'VIEW_PREVIOUS_MONTH'	=> 'Mese precedente',
	'EVENT_START'			=> 'Da',
	'EVENT_END'				=> 'a',
	'EVENT_TIME'			=> 'Tempo',
	'EVENT_ALL_DAY'			=> 'Tutta la giornata',
	'CURRENT_EVENTS'		=> 'Eventi correnti',
	'NO_CUR_EVENTS'			=> 'Nessun evento corrente',
	'UPCOMING_EVENTS'		=> 'Eventi in arrivo',
	'NO_UPCOMING_EVENTS'	=> 'Nessun evento in arrivo',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Do',
			'2'	=> 'Lu',
			'3'	=> 'Ma',
			'4'	=> 'Me',
			'5'	=> 'Gi',
			'6'	=> 'Ve',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Gen',
			'2'	=> 'Feb',
			'3'	=> 'Mar',
			'4'	=> 'Apr',
			'5'	=> 'Mag',
			'6'	=> 'Giu',
			'7'	=> 'Lug',
			'8'	=> 'Ago',
			'9'	=> 'Set',
			'10'=> 'Ott',
			'11'=> 'Nov',
			'12'=> 'Dic',
		),

		'long_month'=> array(
			'1'	=> 'Gennaio',
			'2'	=> 'Febbraio',
			'3'	=> 'Marzo',
			'4'	=> 'Aprile',
			'5'	=> 'Maggio',
			'6'	=> 'Giugno',
			'7'	=> 'Luglio',
			'8'	=> 'Agosto',
			'9'	=> 'Settembre',
			'10'=> 'Ottobre',
			'11'=> 'Novembre',
			'12'=> 'Dicembre',
		),
	),

	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Impostazioni calendario',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Qui è possibile personalizzare il blocco calendario.',
	'ACP_PORTAL_EVENTS'						=> 'Eventi calendario',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Colore giorno attivo',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'	=> 'Sono permessi nomi o codici esadecimali come "white" o #FFFFFF o nomi di colori come "violet".',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Colore per domenica',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'	=> 'Sono permessi nomi o codici esadecimali come "white" o #FFFFFF o nomi di colori come "violet".',
	'PORTAL_LONG_MONTH'						=> 'Mostra nomi estesi per i mesi',
	'PORTAL_LONG_MONTH_EXP'				=> 'Se disabilitato, i mesi saranno abbreviati (per esempio, Ago invece di Agosto).',
	'PORTAL_SUNDAY_FIRST'					=> 'Primo giorno della settimane',
	'PORTAL_SUNDAY_FIRST_EXP'			=> 'Se disabilitato, il calendario mostrerà Lu --> Do, altrimenti Do --> Sa.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Mostra eventi',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Mostra eventi creati nel blocco calendario',
	'PORTAL_EVENTS_MANAGE'					=> 'Gestisci eventi',
	'NO_EVENT_TITLE'						=> 'Non è stato specificato un titolo per l\'evento.',
	'NO_EVENT_START'						=> 'Non è stata specificata una data d\'inizio per l\'evento.',
	'ADD_EVENT'								=> 'Aggiungi nuovo evento',
	'EVENT_UPDATED'							=> 'Evento aggiornato con successo.',
	'EVENT_ADDED'							=> 'Event aggiunto con successo.',
	'NO_EVENT'								=> 'Nessun evento specificato.',
	'EVENT_TITLE'							=> 'Titolo evento',
	'EVENT_DESC'							=> 'Descrizione evento',
	'EVENT_LINK'							=> 'Collegamento evento',
	'EVENT_LINK_EXP'						=> 'Inserisci il collegamento al topic o al sito con l\'annuncio o il topic di discussione dell\'evento.',
	'NO_EVENTS'								=> 'Nessun evento',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'La data d\'inizio dell\'evento specificata non è valida. Seguire attentamente le istruzioni.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'La data di fine dell\'evento specificata non è valida. Seguire attentamente le istruzioni.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'La data d\'inizio dell\'evento dev\'essere nel futuro.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Data d\'inizio evento',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Inserire la data e l\'ora dell\'inizio evento. La data dev\'essere nel formato MM/DD/YYYY h:mm PM',
	'ACP_PORTAL_EVENT_END_DATE'			=> 'Data di fine evento',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Inserire la data e l\'ora di fine evento. La data dev\'essere nel formato MM/DD/YYYY h:mm PM',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'La fine dell\'evento deve avvenire dopo l\'inizio.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Permessi evento',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Selezionare i gruppi autorizzati a vedere l\'evento. Per permettere la visione a tutti, non selezionare alcun gruppo.<br />Selezionare/Deselezionare più gruppi tenendo premuto <samp>CTRL</samp> mentre si clicca.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Apri collegamenti esterni in una nuova finestra',

	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Evento aggiornato</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Evento aggiunto</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Evento rimosso</strong><br />&raquo; %s',
));
