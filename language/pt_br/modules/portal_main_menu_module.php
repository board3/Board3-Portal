<?php
/**
*
* @package Board3 Portal v2.1 - Main Menu
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
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Conteúdo',
	'M_ACP'		=> 'ACP',
	'M_HELP'	=> 'Ajuda',
	'M_BBCODE'	=> 'FAQ de BBCode',
	'M_TERMS'	=> 'Termos de uso',
	'M_PRV'		=> 'Política de privacidade',
	'M_SEARCH'	=> 'Pesquisar',
	'MENU_NO_LINKS'	=> 'Não há links',

	// ACP
	'ACP_PORTAL_MENU'				=> 'Configuração do Menu',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Configuração de Links',
	'ACP_PORTAL_MENU_EXP'			=> 'Administre seu menu principal',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Administrar menu',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Administre os links do menu principal.',
	'ACP_PORTAL_MENU_CAT'			=> 'Categoria',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Estabelecer como categoria de links especiais',
	'ACP_PORTAL_MENU_INT'			=> 'Link interno',
	'ACP_PORTAL_MENU_EXT'			=> 'Link externo',
	'ACP_PORTAL_MENU_TITLE'			=> 'Título',
	'ACP_PORTAL_MENU_URL'			=> 'URL do link',
	'ACP_PORTAL_MENU_ADD'			=> 'Adicionar novo link',
	'ACP_PORTAL_MENU_TYPE'			=> 'Tipo de link',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Se tem um link para o fórum, selecione "Link interno" para evitar desconexões não desejadas.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'É necessário criar primeiro uma categoria.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Links externos:<br />Todos os links devem ser precedidos de http://<br /><br />Link internos:<br />Somente digitar o arquivo .php como link, por exemplo: index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Permissões de links',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Selecione os grupos autorizados a ver o link. Se nenhum grupo for selecionado, todos os usuários poderão ver o link. <br />Para selecionar/deselecionar múltiplos grupos simultaneamente, pressione <samp>CTRL</ samp> e clique.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Abrir links externos em uma nova janela',

	// Errors
	'NO_LINK_TITLE'          		=> 'Digite um título para este link.',
	'NO_LINK_URL'          			=> 'Digite uma URL para este link.',
));
