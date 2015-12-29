<?php
/**
*
* @package Board3 Portal v2.1 - Attachments
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
	'DOWNLOADS'				=> 'عدد التحميلات ',
	'NO_ATTACHMENTS'		=> 'لا توجد ملفات مُرفقة',
	'PORTAL_ATTACHMENTS'	=> 'المرفقات',

	// ACP
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'إعدادات المرفقات',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXP'	=> 'من هنا تستطيع تخصيص موديل المرفقات.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'عدد المرفقات ',
	'PORTAL_ATTACHMENTS_NUMBER_EXP'					=> 'الحد الأقصى لعدد المرفقات التي سيتم عرضها في الموديل. القيمة صفر يعني عدد غير محدود',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'المنتديات ',
	'PORTAL_ATTACHMENTS_FORUM_IDS_EXP'				=> 'حدد المنتديات التي تريد إظهار المرفقات منها. عدم التحديد يعني إظهار المرفقات من جميع المنتديات. <br />تستطيع هنا كذلك تحديد المنتديات التي تريد استثنائها من المرفقات بشرط أن تختار "نعم" في الخيار أدناه ( استثناء المنتديات ). <br />تستطيع تحديد أو إلغاء التحديد لأكثر من منتدى بواسطة النقر مطولاً على زر الكنترول <samp>CTRL</samp> والتحديد بالماوس على المنتديات المطلوبة.',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE'					=> 'استثناء المنتديات ',
	'PORTAL_ATTACHMENTS_FORUM_EXCLUDE_EXP'			=> 'اختار "نعم" إذا تريد استثناء المرفقات من المنتديات التي حددتها في الخيار أعلاه ( المنتديات ). اختار "لا" لتعطيل هذا الخيار.',
	'PORTAL_ATTACHMENTS_MAX_LENGTH'						=> 'عدد حروف أسماء المرفقات ',
	'PORTAL_ATTACHMENTS_MAX_LENGTH_EXP'				=> 'القيمة صفر تعني غير محدود',
	'PORTAL_ATTACHMENTS_FILETYPE' 						=> 'أنواع الملفات ',
	'PORTAL_ATTACHMENTS_FILETYPE_EXP' 				=> 'حدد أنواع الملفات التي تريد عرضها في المرفقات. تستطيع هنا كذلك تحديد أنواع الملفات التي تريد استثنائها من المرفقات بشرط أن تختار "نعم" في الخيار أدناه ( استثناء أنواع الملفات ). <br />تستطيع تحديد أو إلغاء التحديد لأكثر من أنواع الملفات بواسطة النقر مطولاً على زر الكنترول <samp>CTRL</samp> والتحديد بالماوس على الأنواع المطلوبة.',
	'PORTAL_ATTACHMENTS_EXCLUDE'						=> 'استثناء أنواع الملفات ',
	'PORTAL_ATTACHMENTS_EXCLUDE_EXP'				=> 'اختار "نعم" إذا تريد استثناء أنواع الملفات التي حددتها في الخيار أعلاه ( أنواع الملفات ). اختار "لا" لتعطيل هذا الخيار.',
));
