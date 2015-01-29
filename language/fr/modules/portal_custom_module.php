<?php
/**
*
* @package Board3 Portal v2.1 - Custom
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @translated into French by Galixte (http://www.galixte.com)
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
	'PORTAL_CUSTOM'		=> 'Bloc personnalisé',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Paramètres du bloc personnalisé',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Ici vous personnalisez le bloc personnalisé.',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'Le code que vous avez entré n’est pas assez long.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Aperçu',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Code du bloc personnalisé',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Saisir le code pour le bloc personnalisé (HTML ou BBCode) ici.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Permissions du bloc personnalisé',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Sélectionner les groupes qui doivent être autorisés à voir le module. Afin que tous les utilisateurs soient en mesure d’afficher le module, ne rien sélectionner.<br />Pour sélectionner / désélectionner plusieurs groupes maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Activer les BBCode pour le bloc personnalisé',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'Les BBCode peuvent être utilisés dans ce cadre. Si les BBCode ne sont pas activés, le HTML sera analysé.',
));
