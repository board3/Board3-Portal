<?php
/**
*
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'Últimas Notícias',
	'READ_FULL'				=> 'Ler tudo',
	'NO_NEWS'				=> 'Não há notícias',
	'POSTED_BY'				=> 'Escrito por',
	'COMMENTS'				=> 'Comentários',
	'VIEW_COMMENTS'			=> 'Ver comentários',
	'PORTAL_POST_REPLY'		=> 'Escrever comentário',
	'TOPIC_VIEWS'			=> 'Visitas',
	'JUMP_NEWEST'			=> 'Ir à última mensagem',
	'JUMP_FIRST'			=> 'Ir à primeira mensagem',
	'JUMP_TO_POST'			=> 'Ir à mensagem',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'		=> 'Configuração das Notícias',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Personalize o bloco de notícias.',
	'PORTAL_NEWS_STYLE'				=> 'Compactar o estilo do bloco de notícias',
	'PORTAL_NEWS_STYLE_EXP'			=> '"Sim" para usar o estilo compacto para as noticias. "Não" para usar o estilo grande (ver texto).',
	'PORTAL_SHOW_ALL_NEWS'			=> 'Mostrar todas as notícias novas',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Incluir tópicos fixos.',
	'PORTAL_NUMBER_OF_NEWS'			=> 'Número de notícias no Portal',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 significa infinito.',
	'PORTAL_NEWS_LENGTH'			=> 'Longitude máxima de cada notícia',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 significa infinito.',
	'PORTAL_NEWS_FORUM' 			=> 'Fóruns de notícias',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Fóruns dos quais queremos mostrar as notícias. Deixar em branco para mostrar de todos os fóruns. Se "Excluir fóruns" estiver como "Sim", selecione os fóruns que deseja excluir. Se "Não", aqueles que deseja ver.<br />Selecione/deselecione múltiplos fóruns pressionando <samp>CTRL</samp> clique.',
	'PORTAL_NEWS_EXCLUDE'			=> 'Excluir fóruns',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Selecione "Sim" se quiser excluir os fóruns selecionados do bloco de notícias e "Não" se deseja ver os selecionados.',
	'PORTAL_NEWS_PERMISSIONS'		=> 'Habilitar/Desabilitar permissões',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Tenha em conta as permissões de visualização dos fóruns para mostrar as notícias.',
	'PORTAL_NEWS_SHOW_LAST'			=> 'Organizar começando pela mensagem mais recente',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'Quando está ativada, as noticias serão organizadas segundo a mensagem mais recente. Quando está desativada, as noticias serão organizadas segundo o tópico mais recente.',
	'PORTAL_NEWS_ARCHIVE'			=> 'Habilitar o sistema de arquivamento de anúncios',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Se ativado, se mostrará o número de páginas.',
	'PORTAL_SHOW_REPLIES_VIEWS'		=> 'Mostrar o número de respostas e opiniões',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'	=> 'Configuração para bloco compacto.<br />Se a resposta é "Sim", o número de respostas e as opiniões se mostrarão em 2 colunas extras. Se a resposta é "Não", as respostas e opiniões se mostrarão junto ao nome do fórum. Selecione "Não" se tem problemas com a visualização das colunas extras devido à largura.',
));
