<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Brazilian Portuguese translation by eunaumtenhoid (c) 2017 [ver 2.1.0] (https://github.com/phpBBTraducoes)
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
	'ACP_PORTAL_MODULES_EXP'		=> 'Administre os módulos do Portal. Se desativar todos os módulos, lembre-se de desativar também o Portal, por favor.',

	'MODULE_POS_TOP'				=> 'Acima',
	'MODULE_POS_LEFT'				=> 'Coluna esquerda',
	'MODULE_POS_RIGHT'				=> 'Coluna direita',
	'MODULE_POS_CENTER'				=> 'Coluna central',
	'MODULE_POS_BOTTOM'				=> 'Abaixo',
	'ADD_MODULE'					=> 'Adicionar módulo',
	'CHOOSE_MODULE'					=> 'Selecionar módulo',
	'CHOOSE_MODULE_EXP'				=> 'Escolha um módulo da lista.',
	'SUCCESS_ADD'					=> 'O módulo foi adicionado.',
	'SUCCESS_DELETE'				=> 'O módulo foi excluído.',
	'NO_MODULES'					=> 'Não há módulos.',
	'MOVE_RIGHT'					=> 'Mover - direita',
	'MOVE_LEFT'						=> 'Mover - esquerda',
	'B3P_FILE_NOT_FOUND'			=> 'O arquivo solicitado não foi encontrado',
	'UNABLE_TO_MOVE'				=> 'Não é possível mover o bloco para a coluna selecionada.',
	'UNABLE_TO_MOVE_ROW'			=> 'Não é possível mover o bloco para a linha selecionada.',
	'UNABLE_TO_ADD_MODULE'			=> 'Não é possível adicionar o bloco selecionado',
	'DELETE_MODULE_CONFIRM'			=> 'Tem certeza que quer excluir o módulo "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Configuração padrão restabelecida.',
	'MODULE_RESET_CONFIRM'			=> 'Tem certeza que quer resetar o módulo "%1$s"?',
	'MODULE_NOT_EXISTS'				=> 'Não existe o módulo selecionado.',

	'MODULE_OPTIONS'			=> 'Opcões de módulo',
	'MODULE_NAME'				=> 'Nome do módulo',
	'MODULE_NAME_EXP'			=> 'Digite o nome que se deve mostrar na configuração do módulo.',
	'MODULE_IMAGE'				=> 'Imagem do módulo',
	'MODULE_IMAGE_EXP'			=> 'Digite o nome do arquivo correspondente à imagem do módulo. As imagens devem estar em styles/*seuestilo*/theme/images/portal/.',
	'MODULE_PERMISSIONS'		=> 'Permissões do módulo',
	'MODULE_PERMISSIONS_EXP'	=> 'Selecione os grupos autorizados a ver o módulo. Se nenhum grupo for selecionado, todos os usuarios poderão utilizar o módulo. <br />Para selecionar/deselecionar múltiplos grupos simultaneamente, pressione <samp>CTRL</ samp> e clique.',
	'MODULE_IMAGE_WIDTH'		=> 'Largura da imagem do módulo',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Digite a largura em pixels da imagem do módulo.',
	'MODULE_IMAGE_HEIGHT'		=> 'Altura da imagem do módulo',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Digite a altura em pixels da imagem do módulo.',
	'MODULE_RESET'				=> 'Configuração padrão do módulo',
	'MODULE_RESET_EXP'			=> 'Isto restabelecerá todos os ajustes para o padrão!',
	'MODULE_STATUS'				=> 'Habilitar módulo',
	'MODULE_ADD_ONCE'			=> 'Este módulo só se puede adicionar uma vez.',
	'MODULE_IMAGE_ERROR'		=> 'Houve um erro ao buscar a imagem do módulo:',
	'UNKNOWN_MODULE_METHOD'		=> 'Módulo %1$s usa um método de módulo que é desconhecido.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Ajustes gerais',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Administração do Portal',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Obrigado por escolher o Portal Board3! Aqui é onde você pode configurá-lo. As opções seguintes permitem personalizar a configuração geral.',
	'ACP_PORTAL_SHOW_ALL'					=> 'Mostra o Portal em todas as páginas',
	'ACP_PORTAL_SHOW_ALL_EXP'				=> 'Marque "Não" para mostrar somente na página do Portal',
	'PORTAL_ENABLE'							=> 'Habilitar Portal',
	'PORTAL_ENABLE_EXP'						=> 'Ative ou desative todo o Portal.',
	'PORTAL_LEFT_COLUMN'					=> 'Habilitar a coluna esquerda',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Marque "Não" para desabilitar a coluna esquerda.',
	'PORTAL_RIGHT_COLUMN'					=> 'Habilitar a coluna direita',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Marque "Não" para desabilitar a coluna direita.',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Mostrar "Ir a"',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Mostre "Ir a" no Portal. O "Ir a" só se mostra se esté também ativo nas características do site.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Configuração da largura das colunas esquerda e direita',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Largura da coluna esquerda',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Digite a largura em pixels da coluna esquerda. O valor recomendado é de 180.',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Largura da coluna direita',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Digite a largura em pixels da coluna direita. O valor recomendado é de 180.',
	'PORTAL_SHOW_ALL_SIDE'					=> 'Coluna a mostrar em todas as páginas',
	'PORTAL_SHOW_ALL_SIDE_EXP'				=> 'Escolhe qual coluna será mostrada em todas as páginas.',
	'PORTAL_SHOW_ALL_LEFT'					=> 'Esquerda',
	'PORTAL_SHOW_ALL_RIGHT'					=> 'Direita',
	
	'LINK_ADDED'							=> 'O link foi adicionado com sucesso.',
	'LINK_UPDATED'							=> 'O link foi alterado com sucesso.',

	// Install
	'PORTAL_BASIC_INSTALL'					=> 'Adicionando um conjunto básico de módulos',
	'PORTAL_BASIC_UNINSTALL'				=> 'Excluindo módulos da base de dados',
));
