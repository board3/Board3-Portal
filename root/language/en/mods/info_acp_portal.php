<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// @todo: check for unneeded language variables
// @todo: change language variables to English ones

$lang = array_merge($lang, array(
	// Manage blocks
	'ACP_PORTAL_BLOCKS'				=> 'Block-Verwaltung',
	'ACP_PORTAL_BLOCKS_EXPLAIN'		=> 'Du kannst hier Blöcke anlegen, bearbeiten und löschen.',
	'ADD_BLOCK'						=> 'Neuer Block hinzufügen',
	'ACP_PORTAL_MANAGE_BLOCKS'		=> 'Blöcke verwalten',

	// general
	'ACP_PORTAL'							=> 'Portal',
	'ACP_PORTAL_GENERAL_INFO'				=> 'Allgemeine Einstellungen',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portal Administration',
	'ACP_PORTAL_GENERAL_TITLE_EXPLAIN'		=> 'Hier kannst du allgemeine Einstellungen vornehmen.',
	
	'BLOCK_ADDED'					=> 'The block was successfully added.',
	'BLOCK_FILENAME'				=> 'Block template file',
	'BLOCK_FILENAME_EXPLAIN'		=> 'Use this to define a tempalte file used for the block. The path is relative to the root phpBB directory.',
	'BLOCK_ICON'					=> 'Block icon',
	'BLOCK_ICON_EXPLAIN'			=> 'Use this to define a small icon associated with the block. The path is relative to the root phpBB directory.',
	'BLOCK_POSITION'				=> 'Display position',
	'BLOCK_POSITION_EXPLAIN'		=> 'Select the display position on index page.',
	'BLOCK_POSITION_BOTTOM'			=> 'Bottom',
	'BLOCK_POSITION_LEFT'			=> 'Left',
	'BLOCK_POSITION_MIDDLE_BOTTOM'	=> 'Middle - Bottom',
	'BLOCK_POSITION_MIDDLE_TOP'		=> 'Middle - Top',
	'BLOCK_POSITION_NONE'			=> 'Not display',
	'BLOCK_POSITION_RIGHT'			=> 'Right',
	'BLOCK_POSITION_TOP'			=> 'Top',
	'BLOCK_REMOVED'					=> 'The block was successfully deleted.',
	'BLOCK_TEXT'					=> 'Text',
	'BLOCK_TEXT_EXPLAIN'			=> 'Enter here the content of the block text.',
	'BLOCK_TITLE'					=> 'Block title',
	'BLOCK_TITLE_EXPLAIN'			=> 'Enter the displayed block title. Use language constant if name is served from language file: <samp>language/en/mods/portal.php</samp>',
	'BLOCK_TYPE'					=> 'Block type',
	'BLOCK_TYPE_EXPLAIN'			=> 'Select the block type.',
	'BLOCK_UPDATED'					=> 'The block was successfully updated.',

	'MUST_SELECT_BLOCK'		=> 'You must select a block.',

	'NO_BLOCK_HTML'		=> 'You have created block with template file but haven’t selected a template file for this block.',
	'NO_BLOCK_TEXT'		=> 'You have created custom text block but haven’t entered the content for this block.',
	'NO_BLOCK_TITLE'	=> 'You haven’t specified a title for the block.',

	'SELECT_BLOCK_FILE'		=> 'Select a template file…',
	'SELECT_BLOCK_ICON'		=> 'Select an icon…',
	'SELECT_BLOCK_CLOCK'		=> 'Select an clock…',
	'SELECT_BLOCK_POSITION'	=> 'Select a position…',
	'SELECT_BLOCK_TYPE'		=> 'Select a type…',
	
	// Portal Modules
	'ACP_PORTAL_MODULES'			=> 'Portal Modules',
	'ACP_PORTAL_MODULES_EXPLAIN'	=> 'You can manage your portal modules here',
	
	'MODULE_POS_TOP'				=> 'Top',
	'MODULE_POS_LEFT'				=> 'Left column',
	'MODULE_POS_RIGHT'				=> 'Right column',
	'MODULE_POS_CENTER'				=> 'Center column',
	'MODULE_POS_BOTTOM'				=> 'Bottom',
	'ADD_MODULE'					=> 'Add module',
	'CHOOSE_MODULE'					=> 'Choose module',
	'CHOOSE_MODULE_EXPLAIN'			=> 'Choose a module from the drop-down list',
	'SUCCESS'						=> 'The module was added successfully',

	// Manage links
	'ACP_EXPRESS_LINKS_EXPLAIN'	=> 'Using this form you can add, edit, view and delete navigation links on the index page. You can also create special navigation links as categories which aren’t clickable links.',
	'ADD_LINK'					=> 'Add new navigation link',
	'ACP_PORTAL_MANAGE_LINKS'	=> 'Links verwalten',

	'LINK_ADDED'		=> 'The navigation link was successfully added.',
	'LINK_CAT'			=> 'Navigation link category',
	'LINK_ICON'			=> 'Link icon',
	'LINK_ICON_EXPLAIN'	=> 'Use this to define a small icon associated with the navigation link. The path is relative to the root phpBB directory.',
	'LINK_IS_CAT'		=> 'Set as special link category',
	'LINK_REMOVED'		=> 'The navigation link was successfully deleted.',
	'LINK_TITLE'		=> 'Link title',
	'LINK_UPDATED'		=> 'The navigation link was successfully updated.',
	'LINK_URL'			=> 'Link URL',

	'MUST_SELECT_LINK'	=> 'You must select a link.',
	
	'NO_LINK_TITLE'	=> 'You haven’t specified a title for the navigation link.',
	'NO_LINK_URL'	=> 'You have created clickable navigation link but haven’t entered the URL for this navigation link.',

	'SELECT_LINK_ICON'	=> 'Select an icon…',

	// paypal
	'PORTAL_PAY_ACC'							=> 'Paypal Account',
	'PORTAL_PAY_ACC_EXPLAIN'					=> 'Gib deine e-mail-Adresse an, die du bei Paypal benutzt, z.B. xxx@xxx.com',
));

// BLOCK TITLES
// Set additional block titles here...
// @todo: I think we need to remove this as it has become obsolete
// Example:
// 'BLOCK_TOP_POSTERS'		=> 'Top posters',	/* Main block title */
// 'BLOCK_TOP_POSTERS_SUB'	=> 'Posted',		/* Legend, block sub-title */
//
$lang = array_merge($lang, array(
	'BLOCK_BIRTHDAY'				=> 'Geburtstage',	
	'BLOCK_EXPRESS_LINKS'			=> 'Navigation',
	'BLOCK_SEARCH'					=> 'Suche',
	'BLOCK_CLOCK'					=> 'Uhr',
	'BLOCK_USER_MENU'				=> 'Benutzer-Menü',
	'BLOCK_MAIN_MENU'				=> '',
	'BLOCK_CHANGE_STYLE'			=> 'Mein Board-Style',
	'BLOCK_ONLINE'					=> 'Wer ist Online?',
	'BLOCK_DONATION'				=> 'Paypal-Spenden',
	'BLOCK_LINKS'					=> 'Links',
	'BLOCK_LATEST_BOTS'				=> 'Bots',
	'BLOCK_LATEST_MEMBERS'			=> 'Neueste Mitglieder',
	'BLOCK_MINI_CALENDAR'			=> 'Kalender',
	'BLOCK_ONLINE_FRIENDS'			=> 'Freunde',
	'BLOCK_STATISTICS'				=> 'Statistik',
	'BLOCK_TOP_POSTER'				=> 'Top Poster',
	'BLOCK_CUSTOM'					=> 'Custom',
	'BLOCK_BOTS'					=> 'Letzten Bots',
));

// CUSTOM PAGE TITLES
// Set custom page titles here...
//
// @todo: I think we need to remove this as it has become obsolete
// Example:
// 'PAGE_ABOUT'			=> 'About us',					/* Main page title */
// 'PAGE_ABOUT_EXPLAIN'	=> 'Contact information here.',	/* Explanation, page sub-title */
//
$lang = array_merge($lang, array(
));

/**
* A copy of Handyman` s MOD version check, to view it on the gallery overview
*/
$lang = array_merge($lang, array(
	'ANNOUNCEMENT_TOPIC'	=> 'Release Ankündigung',
	'CURRENT_VERSION'		=> 'Derzeitige Version',
	'DOWNLOAD_LATEST'		=> 'Neueste Version herunterladen',
	'LATEST_VERSION'		=> 'Neueste Version',
	'NO_INFO'					=> 'Der Server konnte nicht erreicht werden',
	'NOT_UP_TO_DATE'			=> '%s ist nicht aktuell',
	'RELEASE_ANNOUNCEMENT'	=> 'Ankündigungsthema',
	'UP_TO_DATE'			=> '%s ist aktuell',
	'VERSION_CHECK'			=> 'MOD Version Check',
));

?>