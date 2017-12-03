<?php
/**
*
* @package Board3 Portal v2.1 - Links
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
	'PORTAL_LINKS'		=> 'Links',
	'LINKS_NO_LINKS'	=> 'Não há links',

	// ACP
	'ACP_PORTAL_LINKS'				=> 'Configuração de Links',
	'ACP_PORTAL_LINKS_EXP'			=> 'Personalize os links que figuram em determinado bloco',
	'ACP_PORTAL_LINK_TITLE'			=> 'Título',
	'ACP_PORTAL_LINK_TYPE'			=> 'Tipo de link',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'Se tem um link para o fórum, selecione "Link interno" para evitar desconexões na desejadas.',
	'ACP_PORTAL_LINK_INT'			=> 'Link interno',
	'ACP_PORTAL_LINK_EXT'			=> 'Link externo',
	'ACP_PORTAL_LINK_ADD'			=> 'Adicionar novo link',
	'ACP_PORTAL_LINK_URL'			=> 'URL do link',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'Links externos:<br />Todos os links devem ser precedidos de http://<br /><br />Link internos:<br />Somente digitar o arquivo .php como link, por exemplo: index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'Permissões de Links',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'Selecione os grupos autorizados a ver o link. Se nenhum grupo é selecionado, todos os usuários poderão ver o link. <br />Para selecionar/deselecionar múltiplos grupos simultaneamente, pressione <samp>CTRL</ samp> e clique.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'Abrir links externos em uma nova janela',

	// Errors
	'NO_LINK_TITLE'					=> 'Digite um título para este link.',
	'NO_LINK_URL'					=> 'Digite uma URL para este link.',
));
