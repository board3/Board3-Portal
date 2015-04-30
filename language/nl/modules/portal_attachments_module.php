<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'Downloads',
	'NO_ATTACHMENTS'		=> 'Geen bijlagen',
	'PORTAL_ATTACHMENTS'	=> 'Bijlagen',
	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'		=> 'Bijlageninstellingen',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'Hier kan je het bijlagen blok aanpassen.',
	'PORTAL_ATTACHMENTS_NUMBER'						=> 'Limiet van getoonde bijlagen',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> '0 betekend onbeperkt',
	'PORTAL_ATTACHMENTS_FORUM_IDS'					=> 'Bijlagen forums',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'De forumonderdelen waarvan de bijlagen moeten worden weergegeven. Als "Forumonderdelen uitsluiten" is ingesteld op "Ja", selecteer dan de forumonderdelen die je wilt uitsluiten.<br />Als "Forumonderdelen uitsluiten" is ingesteld op "Nee" selecteer dan de forumonderdelen die je wilt weergeven.<br />Selecteer/Deselecteer meerdere forums doormiddel van <samp>CTRL</samp> en door te klikken.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'				=> 'Forumonderdelen uitsluiten',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'Selecteer "Ja" als je de geselecteerde forumondedelen wilt uitsluiten uit het bijlagenblok, en "Nee" als je alleen de bijlages van de geselecteerde forumonderdelen wilt zien in het bijlagenblok.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'					=> 'Limiet voor het aantal tekens voor bijlagen',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> '0 betekend onbeperkt',
	'PORTAL_ATTACHMENTS_FILETYPE' 					=> 'Bestandstypen',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'Als "Bestandstypen uitsluiten" is ingesteld op "Ja", selecteer dan de bestandstypen die je wilt uitsluiten.<br />Als "Bestandstypen uitsluiten" is ingesteld op "Nee" selecteer dan de bestandstypen die je wilt weergeven.<br />Selecteer/Deselecteer meerdere bestandstypen doormiddel van <samp>CTRL</samp> en door te klikken.',
	'PORTAL_ATTACHMENTS_EXCLUDE'					=> 'Bestandstypen uitsluiten',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'Selecteer "Ja" als je de geselecteerde bestandstypen wilt uitsluiten uit het bijlagenblok, en "Nee" ls je alleen de bijlages van de geselecteerde bestandstypen wilt zien in het bijlagenblok.',
));
