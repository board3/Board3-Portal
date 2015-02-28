<?php
/**
*
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'Nouveaux messages',
	'READ_FULL'				=> 'Tout lire',
	'NO_NEWS'				=> 'Aucun nouveau message',
	'POSTED_BY'				=> 'Écrit par',
	'COMMENTS'				=> 'Réponses',
	'VIEW_COMMENTS'			=> 'Voir les réponses',
	'PORTAL_POST_REPLY'		=> 'Répondre',
	'TOPIC_VIEWS'			=> 'Vus',
	'JUMP_NEWEST'			=> 'Voir le dernier message',
	'JUMP_FIRST'			=> 'Voir le premier message',
	'JUMP_TO_POST'			=> 'Voir le message',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Paramètres des nouveaux messages',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Ici vous personnalisez le bloc des nouveaux messages.',
	'PORTAL_NEWS_STYLE'					=> 'Affichage compact du bloc des nouveaux messages',
	'PORTAL_NEWS_STYLE_EXP'			=> '« Oui » affiche de manière compacte le bloc des nouveaux messages. « Non » affiche ce bloc de manière plus large (affichage du texte).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Afficher tous les messages dans ce forum',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'Inclure les post-it.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Nombre de nouveaux messages sur le portail',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 signifie un nombre infini.',
	'PORTAL_NEWS_LENGTH'				=> 'Longueur maximale en caractères des nouveaux messages',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 signifie un nombre infini.',
	'PORTAL_NEWS_FORUM' 				=> 'Forums des messages',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Forums depuis lesquels les nouveaux messages seront affichés. Laisser vide pour afficher les nouveaux messages de tous les forums. Si « Exclure des forums » est paramétré sur « Oui », sélectionner les forums souhaitant être exclus.<br />Si « Exclure des forums » est paramétré sur « Non », sélectionner les forums souhaités.<br />Pour sélectionner / désélectionner plusieurs forums maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Exclure des forums',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Sélectionner sur « Oui » pour exclure les nouveaux messages de certains forums et « Non » pour voir uniquement les nouveaux messages de certains forums.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Activer / désactiver les permissions',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Lors de l’affichage des nouveaux messages prendre en compte les permissions utilisateurs / forums.',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Classer suivant l’ordre des nouveaux messages',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'Si activé, les nouveaux messages seront classés dans l’ordre des derniers messages. Si désactivé,  les nouveaux messages seront classés dans l’ordre des derniers sujets.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Activer le système d’archivage des nouveaux messages',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Si activé, le système d’archivage des nouveaux messages sera affiché par numéro de page.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Afficher le nombre de réponses et de vus',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Ce paramètre se rapporte au bloc compact.<br />Lorsqu’il est paramétré à « Oui », le nombre de réponses et de vus sont affichés dans deux colonnes supplémentaires. Lorsqu’il est paramétré sur « Non », le nombre de réponses et de vus sont affichés à côté du nom du forum. Sélectionner sur « Non » si il y a un problème d’affichage avec les deux colonnes supplémentaires (du fait de la largeur supplémentaire requise).',
));
