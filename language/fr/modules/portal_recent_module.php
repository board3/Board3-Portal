<?php
/**
*
* @package Board3 Portal v2.1 - Recent
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
	'PORTAL_RECENT'				=> 'Sujets récents',
	'PORTAL_RECENT_TOPIC'		=> 'Sujets récents',
	'PORTAL_RECENT_ANN'			=> 'Annonces récentes',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Sujets actifs récents',

	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Paramètres des sujets récents',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'Ici vous personnalisez le bloc des sujets récents.',
	'PORTAL_MAX_TOPIC'						=> 'Nombre d’annonces récentes / sujets actifs récents',
	'PORTAL_MAX_TOPIC_EXP'				=> '0 signifie un nombre infini.',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Limite de caractères pour chaque titre des sujets récents',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> '0 signifie un nombre infini.',
	'PORTAL_RECENT_FORUM'					=> 'Forums des sujets récents',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Forums depuis lesquels les sujets récents seront affichés. Laisser vide pour afficher les sujets récents de tous les forums. Si « Exclure des forums » est paramétré sur « Oui », sélectionner les forums souhaitant être exclus.<br />Si « Exclure des forums » est paramétré sur « Non », sélectionner les forums souhaités.<br />Pour sélectionner / désélectionner plusieurs forums maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Exclure des forums',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Sélectionner « Oui » pour exclure les sujets récents de certains forums et « Non » pour voir uniquement les sujets récents de certains forums.',
));
