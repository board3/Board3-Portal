<?php
/**
*
* @package Board3 Portal v2.1 - Calendar
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Brazilian Portuguese  translation by null2 (c) 2015 [ver 2.1.0] (https://github.com/phpBBTraducoes) 
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
	'PORTAL_CALENDAR'		=> 'Calendário',
	'VIEW_NEXT_MONTH'		=> 'Mês seguinte',
	'VIEW_PREVIOUS_MONTH'	=> 'Mês anterior',
	'EVENT_START'			=> 'Desde',
	'EVENT_END'				=> 'Para',
	'EVENT_TIME'			=> 'Quando',
	'EVENT_ALL_DAY'			=> 'Todo dia',
	'CURRENT_EVENTS'		=> 'Eventos atuais',
	'NO_CUR_EVENTS'			=> 'Não há eventos',
	'UPCOMING_EVENTS'		=> 'Próximos eventos',
	'NO_UPCOMING_EVENTS'	=> 'Não há eventos futuros',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Dom',
			'2'	=> 'Seg',
			'3'	=> 'Ter',
			'4'	=> 'Qua',
			'5'	=> 'Qui',
			'6'	=> 'Sex',
			'7'	=> 'Sab',
		),

		'month'	=> array(
			'1'	=> 'Jan.',
			'2'	=> 'Fev.',
			'3'	=> 'Mar.',
			'4'	=> 'Abr.',
			'5'	=> 'Maio',
			'6'	=> 'Jun.',
			'7'	=> 'Jul.',
			'8'	=> 'Ago.',
			'9'	=> 'Set.',
			'10'=> 'Out.',
			'11'=> 'Nov.',
			'12'=> 'Dez.',
		),

		'long_month'=> array(
			'1'	=> 'Janeiro',
			'2'	=> 'Fevereiro',
			'3'	=> 'Março',
			'4'	=> 'Abril',
			'5'	=> 'Maio',
			'6'	=> 'Junho',
			'7'	=> 'Julho',
			'8'	=> 'Agosto',
			'9'	=> 'Setembro',
			'10'=> 'Outubro',
			'11'=> 'Novembro',
			'12'=> 'Dezembro',
		),
	),

	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Configurações do Calendário',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Personalize o bloco de calendário.',
	'ACP_PORTAL_EVENTS'						=> 'Eventos do Calendário',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Cor do dia atual',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'		=> 'É permitido usar cores em formato HEX como #FFFFFF para branco, ou o nome da cor como "white".',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Cor para Domingo',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'		=> 'É permitido usar cores em formato HEX como #FFFFFF para branco, ou o nome da cor como "white".',
	'PORTAL_LONG_MONTH'						=> 'Mostrar nomes dos meses completos',
	'PORTAL_LONG_MONTH_EXP'					=> 'Se estiver desativado, o nome dos meses se reduzirão, por exemplo Ago. em lugar de Agosto.',
	'PORTAL_SUNDAY_FIRST'					=> 'Domingo é o primeiro dia da semana',
	'PORTAL_SUNDAY_FIRST_EXP'				=> 'Se "Sim" o calendário mostrará Dom --> Sáb, senão Seg --> Dom.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Mostrar eventos',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Mostra os eventos criados no bloco de calendário.',
	'PORTAL_EVENTS_MANAGE'					=> 'Gerenciar eventos',
	'NO_EVENT_TITLE'						=> 'Não foi especificado o título para o evento.',
	'NO_EVENT_START'						=> 'Não foi especificada a hora de começo do evento.',
	'ADD_EVENT'								=> 'Adcionar um evento',
	'EVENT_UPDATED'							=> 'Evento atualizado corretamente.',
	'EVENT_ADDED'							=> 'Evento adicionado corretamente.',
	'NO_EVENT'								=> 'Sem eventos especificados.',
	'EVENT_TITLE'							=> 'Título do evento',
	'EVENT_DESC'							=> 'Descrição do evento',
	'EVENT_LINK'							=> 'Link do evento',
	'EVENT_LINK_EXP'						=> 'Digite o link para a página da publicação ou discussão do evento.',
	'NO_EVENTS'								=> 'Não há eventos',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'A hora de início está incorreta. Por favor, siga as instruções cuidadosamente.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'A hora de término está incorreta. Por favor, siga as instruções cuidadosamente.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'O inicio do evento deve ser no futuro.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Data de inicio do evento',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Digite a data de início do evento. A data tem que estar neste formato: DD-MM-AAAA 3:00 PM.',
	'ACP_PORTAL_EVENT_END_DATE'				=> 'Data de término do evento',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Digite a data de término do evento. A data tem que estar neste formato: DD-MM-AAAA 3:00 PM.',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'A data de término do evento tem que ser posterior ao início.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Permissões de eventos',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Selecione os grupos autorizados a ver o evento. Se nenhum grupo for selecionado, todos os usuarios poderão utilizar o evento.<br />Para selecionar/deselecionar múltiplos grupos simultaneamente, pressione <samp>CTRL</ samp> e clique.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Abrir links externos em uma nova janela',

	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Eventos atualizados</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Eventos adicionados</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Eventos excluídos</strong><br />&raquo; %s',
));
