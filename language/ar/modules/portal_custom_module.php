<?php
/**
*
* @package Board3 Portal v2.1 - Custom
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
	'PORTAL_CUSTOM'		=> 'Custom Block',

	// ACP
	'ACP_PORTAL_CUSTOM_SETTINGS'			=> 'إعدادات الموديل الخاص',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXP'		=> 'من هنا تستطيع تخصيص الموديل الخاص',
	'ACP_PORTAL_CUSTOM_PREVIEW'				=> 'استعراض',
	'ACP_PORTAL_CUSTOM_CODE'				=> 'المحتوى ',
	'ACP_PORTAL_CUSTOM_CODE_EXP'			=> 'أدخل الكود الذي سيظهر في هذا الموديل ( المسموح به هو HTML أو BBCode ).',
	'ACP_PORTAL_CUSTOM_PERMISSION'			=> 'الصلاحيات ',
	'ACP_PORTAL_CUSTOM_PERMISSION_EXP'		=> 'حدد المجموعات التي تستطيع مُشاهدة هذا الموديل. عدم تحديد أي مجموعة يعني عرض هذا الموديل لجميع الأعضاء.<br />تستطيع تحديد أو إلعاء التحديد لأكثر من مجموعة بالنقر باستمرار على زر الكنترول <samp>CTRL</samp> والنقر بنفس الوقت بالماوس على المجموعة المطلوبة.',
	'ACP_PORTAL_CUSTOM_BBCODE'				=> 'تفعيل أكواد البي بي ',
	'ACP_PORTAL_CUSTOM_BBCODE_EXP'			=> 'اختيارك "نعم" يعني استخدام أكواد الـBBCode في صندوق الكتابة أعلاه. اختيارك "لا" يعني استخدام أكواد ال HTML.',
));
