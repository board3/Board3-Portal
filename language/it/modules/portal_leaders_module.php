<?php
/**
*
* @package Board3 Portal v2.1 - Leaders [Italian]
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
	'NO_ADMINISTRATORS_P'	=> 'Nessun amministratore',
	'NO_MODERATORS_P'		=> 'Nessun moderatore',
	'NO_GROUPS_P'			=> 'Nessun gruppo',

	// ACP
	'ACP_PORTAL_LEADERS'		=> 'Impostazioni staff',
	'ACP_PORTAL_LEADERS_EXP'	=> 'Qui è possibile personalizzare il blocco staff',
	'PORTAL_LEADERS_EXT'		=> 'Blocco esteso',
	'PORTAL_LEADERS_EXT_EXP'	=> 'Il blocco standard mostra tutti gli amministratori e moderatori mentre il blocco esteso mostra tutti i gruppi non nascosti in una legenda.
	The standard block lists all admins/mods, while the extended block includes all non-hidden groups with a legend.',
));
