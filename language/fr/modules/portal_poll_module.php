<?php
/**
*
* @package Board3 Portal v2.1 - Poll
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
	'PORTAL_POLL'			=> 'Sondages',
	'LATEST_POLLS'			=> 'Derniers sondages',
	'NO_OPTIONS'			=> 'Ce sondage n’a pas d’option disponible.',
	'NO_POLL'				=> 'Aucun sondage disponible',
	'RETURN_PORTAL'			=> '%sRetour au portail%s',

	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Paramètres des sondages',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Ici vous personnalisez le bloc des sondages.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Forums des sondages',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'Forums depuis lesquels les sondages seront affichés. Laisser vide pour afficher tous les sondages de tous les forums. Si « Exclure des forums » est paramétré sur « Oui », sélectionner les forums souhaitant être exclus.<br />Si « Exclure des forums » est paramétré sur « Non », sélectionner les forums souhaités.<br />Pour sélectionner / désélectionner plusieurs forums maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Exclure des forums',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Sélectionner « Oui » pour exclure les sondages de certains forums et « Non » pour voir uniquement les sondages de certains forums.',
	'PORTAL_POLL_LIMIT'					=> 'Nombre de sondages',
	'PORTAL_POLL_LIMIT_EXP'			=> 'Nombre maximum de sondages affichés sur la page du portail.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Permettre de voter',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Tenir compte des autorisations des utilisateurs pour voter depuis la page du portail.',
	'PORTAL_POLL_HIDE'					=> 'Cacher les sondages périmés ?',
));
