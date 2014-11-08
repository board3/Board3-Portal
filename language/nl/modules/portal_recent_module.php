<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1 - Recent
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
	'PORTAL_RECENT'				=> 'Recent',
	'PORTAL_RECENT_TOPIC'		=> 'Recente onderwerpen',
	'PORTAL_RECENT_ANN'			=> 'Recente aankondigingen',
	'PORTAL_RECENT_HOT_TOPIC'	=> 'Recente populaire onderwerpen',
	// ACP
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'Recente onderwerpen instellingen',
	'ACP_PORTAL_RECENT_SETTINGS_EXP'	=> 'Hier kan je het recente onderwerpen blok aanpassen.',
	'PORTAL_MAX_TOPIC'						=> 'Limiet voor het aantal recente aankondigingen / actieve onderwerpen',
	'PORTAL_MAX_TOPIC_EXP'				=> '0 betekend onbeperkt',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'Limiet aantal tekens voor elk recent onderwerp',
	'PORTAL_RECENT_TITLE_LIMIT_EXP'		=> '0 betekend onbeperkt',
	'PORTAL_RECENT_FORUM'					=> 'Recent topics forums',
	'PORTAL_RECENT_FORUM_EXP'			=> 'Forumonderdelen om de onderwerpen van weer te geven, laat dit leeg om alle forumonderdelen te gebruiken. Als "Forumonderdelen uitsluiten" is ingesteld op "Ja", selecteer dan de forumonderdelen die je wilt uitsluiten.<br />Als "Forumonderdelen uitsluiten" is ingesteld op "Nee" selecteer dan de forumonderdelen die je wilt weergeven.<br />Selecteer/Deselecteer meerdere forumonderdelen doormiddel van <samp>CTRL</samp> en door te klikken.',
	'PORTAL_EXCLUDE_FORUM'					=> 'Forumonderdelen uitsluiten',
	'PORTAL_EXCLUDE_FORUM_EXP'			=> 'Selecteer "Ja" als je de geselecteerde forumonderdelen wilt uitsluiuten van het recente onderwerpen blok, en "Nee" als je alleen de geselecteerde forumonderdelen wilt weergeven in het recente onderwerpen blok.',
));
