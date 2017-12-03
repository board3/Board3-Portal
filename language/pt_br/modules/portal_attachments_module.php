<?php
/**
*
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'Downloads',
	'NO_ATTACHMENTS'		=> 'Não há arquivos anexos',
	'PORTAL_ATTACHMENTS'	=> 'Anexos',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'	=> 'Configuração de Arquivos Anexos',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'=> 'Personalize o bloco de arquivos anexos.',
	'PORTAL_ATTACHMENTS_NUMBER'					=> 'Número de arquivos anexos a mostrar',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'				=> '0 significa infinito.',
	'PORTAL_ATTACHMENTS_FORUM_IDS'				=> 'Anexos de fóruns',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'			=> 'Fóruns dos quais mostrar os arquivos anexos. Se a opção "Excluir fóruns" abaixo estiver como Sim", selecione os fóruns que deseja excluir. Se "Não", os que deseja ver.<br />Selecione/deselecione múltiplos fóruns pressionando <samp>CTRL</samp> e clique.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'			=> 'Excluir fóruns',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'		=> 'Leia o texto acima.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'				=> 'Tamanho máximo dos arquivos anexos',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'			=> '0 significa infinito.',
	'PORTAL_ATTACHMENTS_FILETYPE' 				=> 'Tipos de arquivos',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 			=> 'Se a opção "Excluir tipos de arquivo" abaixo estiver marcado como "Sim", selecione os tipos de arquivo que deseja excluir. Se "Não", os que deseja ver.<br />Selecione/deselecione múltiplos tipos de arquivos pressionando <samp>CTRL</samp> e clique.',
	'PORTAL_ATTACHMENTS_EXCLUDE'				=> 'Excluir tipos de arquivos',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'			=> 'Leia o texto acima.',
));
