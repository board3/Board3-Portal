<?php
/**
*
* @package Board3 Portal v2.1 - Announcements
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
	'LATEST_ANNOUNCEMENTS'		=> 'Últimos Anúncios Globais',
	'GLOBAL_ANNOUNCEMENTS'		=> 'Anúncios Globais',
	'GLOBAL_ANNOUNCEMENT'		=> 'Anúncio Global',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 anúncio',
	'VIEW_LATEST_ANNOUNCEMENTS' => '%d anúncios',
	'READ_FULL'					=> 'Ler tudo',
	'NO_ANNOUNCEMENTS'			=> 'Não há anúncios globais',
	'POSTED_BY'					=> 'Publicado por:',
	'COMMENTS'					=> 'Comentários',
	'VIEW_COMMENTS'				=> 'Ver comentários',
	'PORTAL_POST_REPLY'			=> 'Escrever comentario',
	'TOPIC_VIEWS'				=> 'Visitas',
	'JUMP_NEWEST'				=> 'Ir à última mensagem',
	'JUMP_FIRST'				=> 'Ir à primeira mensagem',
	'JUMP_TO_POST'				=> 'Ir à mensagem',

	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'			=> 'Configuração de Anúncios Globais',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'Personalize o bloco de anúncios globais.',
	'PORTAL_ANNOUNCEMENTS'					=> 'Mostrar anúncios globais',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'Mostre este bloco no Portal.',
	'PORTAL_ANNOUNCEMENTS_STYLE'			=> 'Compactar o estilo de bloco anúncios globais',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> '"Sim" significa usar o estilo compacto para os anúncios globais. "Não" significa usar o estilo grande (ver texto).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'		=> 'Número de anúncios no portal',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> '0 significa infinito.',
	'PORTAL_ANNOUNCEMENTS_DAY'				=> 'Número de dias a mostrar nos anúncios gloabais',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> '0 significa infinito.',
	'PORTAL_ANNOUNCEMENTS_LENGTH'			=> 'Tamanho máximo dos anúncios globais',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> '0 significa infinito.',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'		=> 'Anúncios dos fóruns',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'Fóruns dos quais queremos mostrar os anúncios. Deixe em branco para mostrar os anúncios de todos os fóruns. Se a opção "Excluir fóruns" abaixo estiver como "Sim", selecione os fóruns que deseja excluir. Se "Não", os que deseja ver.<br />Selecione/deselecione múltiplos fóruns pressionando <samp>CTRL</samp> e clique.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'	=> 'Excluir fóruns',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'Leia o texto acima.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'		=> 'Habilitar/Desabilitar permissões',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'Tenha em mente as permissões de fóruns dos usuários no momento de mostrar os anúncios.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'			=> 'Habilitar o sistema de arquivamento de anúncios',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'Se ativar o sistema de arquivamento de anúncios, se mostrará o número de páginas.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Mostrar o número de respostas e opiniões',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'			=> 'Configuração para bloco compacto.<br />Se a resposta é "Sim", o número de respostas e opiniões se mostrarão em 2 colunas extras. Se a resposta é "Não", as respostas e opiniões se mostrarão junto ao nome do fórum. Selecione "Não" se tem problemas com a visualização das colunas extras devido à largura.',
));
