<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( You - http://www.yourdomain.com )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
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
	'ACP_PALLET_LAYOUT'		=>	'Block Verwaltung',
	'TITLE'		 			=>	'Block Verwaltung',
	'TITLE_EXPLAIN' 		=>	'Hier kannst Du deine Blöcke verwalten, verschieben, hinzufügen und löschen.',
	'PALLET_LAYOUT' 		=>	'Block Anordnung',
	'COLUMN_LEFT' 			=>	'Linke Spalte',
	'COLUMN_CENTER'			=>	'Mittlere Spalte',
	'COLUMN_RIGHT'			=>	'Rechte Spalte',
	'PALLET_KEY'			=>	'Legende',
	'KEY'					=>	'Funktion',
	'ENABLE'				=>	'Aktivieren',
	'DISABLE'				=>	'Deaktivieren',
	'MOVE_LEFT' 			=>	'Nach links',
	'MOVE_RIGHT' 			=>	'Nach rechts',
));

?>