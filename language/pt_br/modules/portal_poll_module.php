<?php
/**
*
* @package Board3 Portal v2.1 - Poll
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
	'PORTAL_POLL'			=> 'Enquetes',
	'LATEST_POLLS'			=> 'Últimas Enquetes',
	'NO_OPTIONS'			=> 'Esta enquete não tem opções disponíveis.',
	'NO_POLL'				=> 'Não há enquetes disponíveis',
	'RETURN_PORTAL'			=> '%sVoltar ao portal%s',

	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'		=> 'Configuração de Enquetes',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Personalize o bloco de enquetes.',
	'PORTAL_POLL_TOPIC_ID'			=> 'Fóruns de enquetes',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'Fóruns do quais se quer mostrar as enquetes. Deixe em branco para mostrar enquetes de todos os fóruns. Se a opção "Excluir fóruns" abaixo estiver marcado como "Sim", selecione todos os fóruns a excluir. Se "Não", os que deseja ver.<br />Selecione/deselecione múltiplos fóruns pressionando <samp>CTRL</samp> e clique.',
	'PORTAL_POLL_EXCLUDE_ID'		=> 'Excluir fóruns',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Leia o texto acima.',
	'PORTAL_POLL_LIMIT'				=> 'Limite de enquetes a mostrar',
	'PORTAL_POLL_LIMIT_EXP'			=> 'Número de enquetes a mostrar no portal.',
	'PORTAL_POLL_ALLOW_VOTE'		=> 'Permitir votar',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Permite aos usuários com permissão necessária para votar a partir do portal.',
	'PORTAL_POLL_HIDE'				=> 'Ocultar enquetes quando expiram?',
));
