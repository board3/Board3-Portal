<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
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
	// Portal Modules
	'ACP_PORTAL_MODULES_EXP'		=> 'Ici vous pouvez gérer les modules de votre portail. Si vous désactivez tous les modules, veuillez désactiver aussi le portail.',

	'MODULE_POS_TOP'				=> 'En haut',
	'MODULE_POS_LEFT'				=> 'Colonne de gauche',
	'MODULE_POS_RIGHT'				=> 'Colonne de droite',
	'MODULE_POS_CENTER'				=> 'Colonne centrale',
	'MODULE_POS_BOTTOM'				=> 'En bas',
	'ADD_MODULE'					=> 'Ajouter un module',
	'CHOOSE_MODULE'					=> 'Choisir un module',
	'CHOOSE_MODULE_EXP'				=> 'Choisir un module dans la liste déroulante',
	'SUCCESS_ADD'					=> 'Le module a été ajouté avec succès.',
	'SUCCESS_DELETE'				=> 'Le module a été retiré avec succès.',
	'NO_MODULES'					=> 'Aucun module n’a été détecté.',
	'MOVE_RIGHT'					=> 'Déplacer vers la droite',
	'MOVE_LEFT'						=> 'Déplacer vers la gauche',
	'B3P_FILE_NOT_FOUND'			=> 'Le fichier demandé est introuvable',
	'UNABLE_TO_MOVE'				=> 'Il n’est pas possible de déplacer le bloc dans la colonne sélectionnée.',
	'UNABLE_TO_MOVE_ROW'			=> 'Il n’est pas possible de déplacer le bloc dans la rangée sélectionnée.',
	'UNABLE_TO_ADD_MODULE'			=> 'Il n’est pas possible d’ajouter le module dans la colonne sélectionnée.',
	'DELETE_MODULE_CONFIRM'			=> 'Êtes-vous sûr de vouloir supprimer le module « %1$s » ?',
	'MODULE_RESET_SUCCESS'			=> 'Les paramètres du module ont été réinitialisés avec succès.',
	'MODULE_RESET_CONFIRM'			=> 'Êtes-vous sûr de vouloir réinitialiser les paramètres du module « %1$s » ?',
	'MODULE_NOT_EXISTS'				=> 'Le module sélectionné n’existe pas.',

	'MODULE_OPTIONS'			=> 'Options des modules',
	'MODULE_NAME'				=> 'Nom du module',
	'MODULE_NAME_EXP'			=> 'Saisir le nom du module qui doit être affiché dans la configuration du module.',
	'MODULE_IMAGE'				=> 'Image du module',
	'MODULE_IMAGE_EXP'			=> 'Saisir le nom du fichier de l’image du module. Les images doivent être dans tous les répertoires : styles/{votre_style}/theme/images/portal/.',
	'MODULE_PERMISSIONS'		=> 'Permissions du module',
	'MODULE_PERMISSIONS_EXP'	=> 'Sélectionner les groupes qui doivent être autorisés à voir le module. Afin que tous les utilisateurs soient en mesure d’afficher le module, ne rien sélectionner.<br />Pour sélectionner / désélectionner plusieurs groupes maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'MODULE_IMAGE_WIDTH'		=> 'Largeur de l’image du module',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Saisir la largeur de l’image du module en pixels.',
	'MODULE_IMAGE_HEIGHT'		=> 'Hauteur de l’image du module',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Saisir la hauteur de l’image du module en pixels.',
	'MODULE_RESET'				=> 'Réinitialiser la configuration du module',
	'MODULE_RESET_EXP'			=> 'Ceci va réinitialiser tous les paramètres par défaut !',
	'MODULE_STATUS'				=> 'Activer le module',
	'MODULE_ADD_ONCE'			=> 'Ce module ne peut être ajouté qu’une seule fois.',
	'MODULE_IMAGE_ERROR'		=> 'Il y avait une erreur lors de la vérification de l’image du module:',
	'UNKNOWN_MODULE_METHOD'		=> 'Le système de module du module « %1$s » ne peut être résolu.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Paramètres généraux',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Administration du portail',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Merci d’avoir choisi le portail Board3 ! C’est ici que vous pouvez gérer la page de votre portail. Les options ci-dessous vous permettent de personnaliser les différents paramètres généraux.',
	'ACP_PORTAL_SHOW_ALL'					=> 'Afficher le portail sur toutes les pages',
	'ACP_PORTAL_SHOW_ALL_EXP'				=> 'Afficher le portail sur toutes les pages.',
	'PORTAL_ENABLE'							=> 'Activer le portail',
	'PORTAL_ENABLE_EXP'						=> 'Activer / désactiver tout le portail.',
	'PORTAL_LEFT_COLUMN'					=> 'Activer la colonne de gauche',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Changer sur « Non » si vous souhaitez désactiver la colonne de gauche.',
	'PORTAL_RIGHT_COLUMN'					=> 'Activer la colonne de droite',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Changer sur « Non » si vous souhaitez désactiver la colonne de droite.',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Afficher l’accès rapide aux forums',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Afficher l’accès rapide aux forums sur le portail. L’accès rapide aux forums ne sera affiché que si il est également activé dans les fonctionnalités du forum.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Paramètres de largeur des colonnes de gauche et de droite',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Largeur de la colonne de gauche',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Modifier la largeur de la colonne de gauche en pixels; la valeur recommandée est 180 pixels.',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Largeur de la colonne de droite',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Modifier la largeur de la colonne de droite en pixels; la valeur recommandée est 180 pixels.',
	'PORTAL_SHOW_ALL_SIDE'					=> 'Colonne à afficher sur toutes les pages',
	'PORTAL_SHOW_ALL_SIDE_EXP'				=> 'Choisir quelle colonne doit s’afficher sur toutes les pages.',
	'PORTAL_SHOW_ALL_LEFT'					=> 'Gauche',
	'PORTAL_SHOW_ALL_RIGHT'					=> 'Droite',

	'LINK_ADDED'							=> 'Le lien a été ajouté avec succès',
	'LINK_UPDATED'							=> 'Le lien a été mis à jour avec succès',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Ajout d’un ensemble de modules de base',
	'PORTAL_BASIC_UNINSTALL'		=> 'Suppression des modules de la base de données',
));
