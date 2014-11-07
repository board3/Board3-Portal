<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
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
	'PORTAL_POLL'			=> 'Poll',
	'LATEST_POLLS'			=> 'Laatste Polls',
	'NO_OPTIONS'			=> 'Deze poll heeft geen beschikbare opties.',
	'NO_POLL'				=> 'Geen polls beschikbaar',
	'RETURN_PORTAL'			=> '%sGa terug naar het portaal%s',
	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Poll instellingen',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'Hier kan je het poll blok aanpassen.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Poll forum(s)',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'De forumonderdelen waarvan je de polls wilt weergeven. Als "Forumonderdelen uitsluiten" is ingesteld op "Ja", selecteer dan de forumonderdelen die je wilt uitsluiten.<br />Als "Forumonderdelen uitsluiten" is ingesteld op "Nee" selecteer dan de forumonderdelen die je wilt weergeven.<br />Selecteer/Deselecteer meerdere forumonderdelen doormiddel van <samp>CTRL</samp> en door te klikken.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'Forumonderdelen uitsluiten',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'Selecteer "Ja" als je de geselecteerde forumonderdelen wilt uitsluiten in het poll blok, en "Nee" als je alleen de geselecteerde forumonderdelen wilt weergeven in het poll blok.',
	'PORTAL_POLL_LIMIT'					=> 'Aantal polls weergeven',
	'PORTAL_POLL_LIMIT_EXP'			=> 'Het aantal polls dat je wilt weergeven op de portaalpagina.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Sta stemmen toe',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'Sta gebruikers met de vereiste permissies toe om te stemmen vanaf de portaalpagina.',
	'PORTAL_POLL_HIDE'					=> 'Verberg verlopen polls?',
));
