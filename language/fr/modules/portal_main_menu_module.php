<?php
/**
*
* @package Board3 Portal v2.1 - Main Menu
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
	'M_MENU' 	=> 'Menu',
	'M_CONTENT'	=> 'Sommaire',
	'M_ACP'		=> 'Panneau d’administration',
	'M_HELP'	=> 'Aide',
	'M_BBCODE'	=> 'Guide du BBCode',
	'M_TERMS'	=> 'Conditions d’utilisation',
	'M_PRV'		=> 'Politique de vie privée',
	'M_SEARCH'	=> 'Rechercher',
	'MENU_NO_LINKS'	=> 'Aucun lien',

	// ACP
	'ACP_PORTAL_MENU'				=> 'Paramètres du menu',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'Paramètres du lien',
	'ACP_PORTAL_MENU_EXP'			=> 'Ici vous gérez votre menu principal.',
	'ACP_PORTAL_MENU_MANAGE'		=> 'Gérer votre menu',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'Ici vous pouvez gérer les liens de votre menu principal.',
	'ACP_PORTAL_MENU_CAT'			=> 'Catégorie',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'Définir comme une catégorie de liens spéciaux',
	'ACP_PORTAL_MENU_INT'			=> 'Lien interne',
	'ACP_PORTAL_MENU_EXT'			=> 'Lien externe',
	'ACP_PORTAL_MENU_TITLE'			=> 'Titre',
	'ACP_PORTAL_MENU_URL'			=> 'Adresse URL du lien',
	'ACP_PORTAL_MENU_ADD'			=> 'Ajouter un nouveau lien',
	'ACP_PORTAL_MENU_TYPE'			=> 'Type de lien',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'Pour un lien vers une page de votre forum, choisir "Lien interne" afin d’éviter des déconnexions indésirables.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'En premier lieu vous devez créer une catégorie.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'Les liens externes :<br />Ils doivent contenir http://<br /><br />Les liens internes :<br />Ils doivent contenir le fichier PHP comme adresse URL, comme par exemple index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'Permissions du lien',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'Sélectionner les groupes qui doivent être autorisés à voir le lien. Afin que tous les utilisateurs soient en mesure de voir le lien, ne rien sélectionner.<br />Pour sélectionner / désélectionner plusieurs groupes maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'Ouvrir les liens externes dans une nouvelle fenêtre',

	// Errors
	'NO_LINK_TITLE'					=> 'Vous devez saisir un titre pour ce lien.',
	'NO_LINK_URL'					=> 'Vous devez saisir une adresse URL pour ce lien.',
));
