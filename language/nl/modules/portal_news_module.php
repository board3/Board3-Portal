<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'Laatste Nieuws',
	'READ_FULL'				=> 'Lees alles',
	'NO_NEWS'				=> 'Geen nieuws',
	'POSTED_BY'				=> 'Geplaatst door',
	'COMMENTS'				=> 'Reacties',
	'VIEW_COMMENTS'			=> 'Laat reacties zien',
	'PORTAL_POST_REPLY'		=> 'Schrijf een reactie',
	'TOPIC_VIEWS'			=> 'Weergaves',
	'JUMP_NEWEST'			=> 'Ga naar nieuwste bericht',
	'JUMP_FIRST'			=> 'Ga naar eerste bericht',
	'JUMP_TO_POST'			=> 'Ga naar bericht',
	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Nieuws instellingen',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'Hier kan je het nieuwsblok aanpassen.',
	'PORTAL_NEWS_STYLE'					=> 'Compacte nieuwsblok stijl',
	'PORTAL_NEWS_STYLE_EXP'			=> '"Ja" betekend dat je gebruik wilt maken van de compate stijl. "Nee" betekend dat je gebruik wilt maken van de grote stijl (tekstweergave).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Alle artikelen tonen in dit forum',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'inclusief stickies.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Het aantal nieuwsberichten weergeven op het portaal',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> '0 betekend onbeperkt',
	'PORTAL_NEWS_LENGTH'				=> 'Maximale lengte nieuwsberichten',
	'PORTAL_NEWS_LENGTH_EXP'		=> '0 betekend onbeperkt',
	'PORTAL_NEWS_FORUM' 				=> 'Nieuws forums',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'Forumonderdeel om te gebruiken voor nieuwsberichten, laat dit leeg om alle forumonderdelen te gebruiken. Als "Forumonderdelen uitsluiten" is ingesteld op "Ja", selecteer dan de forumonderdelen die je wilt uitsluiten.<br />Als "Forumonderdelen uitsluiten" is ingesteld op "Nee" selecteer dan de forumonderdelen die je wilt weergeven.<br />Selecteer/Deselecteer meerdere forumonderdelen doormiddel van <samp>CTRL</samp> en door te klikken.',
	'PORTAL_NEWS_EXCLUDE'				=> 'Forumonderdelen uitsluiten',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'Selecteer "Ja" als je de geselecteerde forumonderdelen wilt uitsluiuten van het nieuwsblok, selecteer "Nee" als je alleen de geselecteerde forumonderdelen wilt weergeven in het nieuwsblok.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'Inschakelen/uitschakelen permissies',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'Take forum viewing permissions into account when displaying news',
	'PORTAL_NEWS_SHOW_LAST'				=> 'Sorteeren op laatste berichten',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> ',Indien ingeschakelt, wordt het nieuws gesorteerd op laatste berichten. Indien uitgeschakeklt, wordt het nieuws gesorteerd op het laatst geplaatste onderwerp.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Het nieuwsarchief systeem inschakelen',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'Als het nieuwsarchief systeem is ingeschakelt, worden er paginanummers weergegeven.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'Laat het aantal reacties en weergaves zien',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'Deze instelling betreft het compacte blok.<br />Als "Ja" is ingesteld, wordt het aantal reacties en weergaves weergegeven in 2 extra kolommen. Als "Nee" is ingesteld, worden reacties en weergaves weergegeven naast de forumnaam. Selecteer Nee, als je problemen hebt met de weergave van de extra kolommen doordat er extra breedte nodig is.',
));
