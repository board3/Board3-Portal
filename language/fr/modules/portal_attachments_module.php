<?php
/**
*
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'Téléchargements',
	'NO_ATTACHMENTS'		=> 'Aucun fichier joint',
	'PORTAL_ATTACHMENTS'	=> 'Fichiers joints',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Paramètres des fichiers joints',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'Ici vous personnalisez le bloc des fichiers joints.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Limite d’affichage des fichiers joints',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> '0 signifie un nombre infini.',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Forums des fichiers joints',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'Forums depuis lesquels les fichiers joints seront affichés. Laisser vide pour afficher tous les fichiers joints de tous les forums. Si « Exclure des forums » est paramétré sur « Oui », sélectionner les forums souhaitant être exclus.<br />Si « Exclure des forums » est paramétré sur « Non », sélectionner les forums souhaités.<br />Pour sélectionner / désélectionner plusieurs forums maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'Exclure des forums',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Sélectionner « Oui » pour exclure les fichiers joints de certains forums et « Non » pour voir uniquement les fichiers joints de certains forums.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'Limite de caractères pour chaque fichier joint',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> '0 signifie un nombre infini.',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'Types de fichiers',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'Type de fichiers qui seront affichés. Laisser vide pour afficher tous les types de fichiers joints. Si « Exclure des types de fichiers » est paramétré sur « Oui », sélectionner les types de fichiers souhaitant être exclus.<br />Si « Exclure des types de fichiers » est paramétré sur « Non », sélectionner les types de fichiers souhaités.<br />Pour sélectionner / désélectionner plusieurs types de fichiers maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'Exclure des types de fichiers',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Sélectionner « Oui » pour exclure certains types de fichiers joints et « Non » pour voir uniquement certains types fichiers joints.',
));
