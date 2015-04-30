<?php
/**
*
* @package Board3 Portal v2.1 - Poll
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'PORTAL_POLL'			=> 'Umfrage',
	'LATEST_POLLS'			=> 'Neueste Umfragen',
	'NO_OPTIONS'			=> 'Diese Umfrage verfügt über keine Optionen.',
	'NO_POLL'				=> 'Derzeit gibt es keine aktuellen Umfragen',
	'RETURN_PORTAL'			=> '%sZurück zum Portal%s',

	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'				=> 'Einstellungen für Umfragen',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'			=> 'Hier kannst du die Einstellungen für Umfragen ändern.',
	'PORTAL_POLL_TOPIC_ID'					=> 'Umfragen Foren',
	'PORTAL_POLL_TOPIC_ID_EXP'				=> 'Die Foren, aus welchen die Umfragen angezeigt werden sollen. Frei lassen, um aus allen Foren anzeigen zu lassen. Falls "Foren ausschließen" auf "Ja" steht, wähle die Foren die du ausschließen willst.<br />Falls "Foren ausschließen" auf "Nein" steht, wähle die Foren die du sehen willst.<br />Wähle mehrere Foren aus/ab, indem du beim Klicken die <samp>Strg</samp>-Taste drückst.',
	'PORTAL_POLL_EXCLUDE_ID'				=> 'Foren ausschließen',
	'PORTAL_POLL_EXCLUDE_ID_EXP'			=> 'Wähle "Ja" wenn du die ausgewählten Foren vom Umfragen-Block ausschließen willst, und "Nein" wenn du nur die Themen aus den ausgewählten Foren im Umfragen-Block sehen willst.',
	'PORTAL_POLL_LIMIT'						=> 'Maximale Anzahl der Umfragen',
	'PORTAL_POLL_LIMIT_EXP'					=> 'Die Anzahl der Umfragen, die auf dem Portal angezeigt werden sollen.',
	'PORTAL_POLL_ALLOW_VOTE'				=> 'Abstimmen erlauben',
	'PORTAL_POLL_ALLOW_VOTE_EXP'			=> 'Verfügt der Benutzer über entsprechende Berechtigungen, kann er direkt auf der Portal-Seite abstimmen.',
	'PORTAL_POLL_HIDE'						=> 'Abgelaufene Umfragen verbergen?',
));
