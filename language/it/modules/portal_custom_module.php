<?php
/**
*
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Modulo personalizzato',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'Impostazioni modulo personalizzato',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'Qui è possibile modificare il proprio blocco personalizzato',
	'ACP_PORTAL_CUSTOM_CODE_SHORT'			=> 'Il codice inserito è troppo breve.',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'Anteprima',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'Codice blocco personalizzato',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'Change the code for the small custom block (HTML or BBCode) here.',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'Permessi blocco personalizzato',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'Selezionare i gruppi abilitati alla visualizzazione del blocco personalizzato. Per impostare la visione pubblica, non selezionare alcun gruppo.<br />Selezionare/Deselezionare più gruppi tenendo premuto <samp>CTRL</samp> e cliccando.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'Attiva BBCode per il blocco personalizzato',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'BBCode può essere usato in questo box; se non è attiva quest\'opzione, sarà invece interpretato il codice HTML.
	BBCode could be used in this box. If BBCode is not activated, HTML will be parsed.',
));
