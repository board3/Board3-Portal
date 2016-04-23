<?php
/**
*
* @package Board3 Portal v2.1 - Friends
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'FRIENDS'				=> 'الأصدقاء',
	'FRIENDS_OFFLINE'		=> 'الغير مُتصلين',
	'FRIENDS_ONLINE'		=> 'المُتصلين',
	'NO_FRIENDS'			=> 'لا يوجد أصدقاء معروفين حالياً',
	'NO_FRIENDS_OFFLINE'	=> 'لا يوجد أصدقاء غير مُتصلين',
	'NO_FRIENDS_ONLINE'		=> 'لا يوجد أصدقاء مُتصلين',

	// ACP
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'إعدادات الإصدقاء',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXP'	=> 'من هنا تستطيع تخصيص موديل الأصدقاء.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'عدد الأصدقاء ',
	'PORTAL_MAX_ONLINE_FRIENDS_EXP'		=> 'الحد الأقصى لعدد الأصدقاء الذين سيتم عرضهم في الموديل.',
));
