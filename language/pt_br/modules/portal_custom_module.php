<?php
/**
*
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Bloco Personalizado',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Configuração de Blocos Personalizados',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Personalize os blocos personalizados.',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'O código introduzido é muito curto.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Prévia',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Código do bloco personalizado',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Use códigos BBCode ou HTML para o bloco personalizado.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Permisões do bloco personalizado',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Selecione os grupos autorizados a ver o bloco personalizado. Se nenhum grupo for selecionado, todos os usuários poderão utilizar o módulo. <br />Para selecionar/deselecionar múltiplos grupos simultaneamente, pressione <samp>CTRL</ samp> e clique.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Ativar BBCode para o bloco personalizado',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'É permitido utilizar BBCode neste quadro. Se o uso de BBCode não está ativado, se utilizará código HTML​.',
));
