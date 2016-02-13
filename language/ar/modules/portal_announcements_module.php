<?php
/**
*
* @package Board3 Portal v2.1 - Announcements
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
	'LATEST_ANNOUNCEMENTS'		=> 'أحدث الإعلانات العامة',
	'GLOBAL_ANNOUNCEMENTS'		=> 'إعلانات عامة',
	'GLOBAL_ANNOUNCEMENT'		=> 'إعلان عام',
	'VIEW_LATEST_ANNOUNCEMENT'  => '1 إعلان',
	'VIEW_LATEST_ANNOUNCEMENTS' => '%d إعلانات',
	'READ_FULL'					=> 'اقرأ المزيد',
	'NO_ANNOUNCEMENTS'			=> 'لا توجد إعلانات عامة',
	'POSTED_BY'					=> 'كاتب المُشاركة',
	'COMMENTS'					=> 'التعليقات',
	'VIEW_COMMENTS'				=> 'مُشاهدة التعليقات',
	'PORTAL_POST_REPLY'			=> 'إضافة تعليق',
	'TOPIC_VIEWS'				=> 'المُشاهدات ',
	'JUMP_NEWEST'				=> 'انتقل إلى أحدث مُشاركة',
	'JUMP_FIRST'				=> 'انتقل إلى أول مُشاركة',
	'JUMP_TO_POST'				=> 'انتقل إلى المُشاركة',

	// ACP
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'إعدادات الإعلانات العامة',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXP'		=> 'من هنا تستطيع تخصيص موديل الإعلانات العامة.',
	'PORTAL_ANNOUNCEMENTS'						=> 'إظهار الإعلانات العامة',
	'PORTAL_ANNOUNCEMENTS_EXP'				=> 'عرض هذا الموديل في المجلة.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'التصميم الإفتراضي ',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXP'		=> 'اختيارك "نعم" يعني استخدام التصميم الإفتراضي لشكل المنتديات ( بدون محتوى الإعلانات ). اختيارك "لا" يعني استخدام التصميم الخاص بالمجلة ( عرض النص / محتوى الإعلانات ).',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'عدد الإعلانات في المجلة ',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXP'	=> 'القيمة صفر تعني عدد غير محدود',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'عدد الأيام لعرض الإعلان',
	'PORTAL_ANNOUNCEMENTS_DAY_EXP'			=> 'سيتم إخفاء الإعلانات بعد القيمة التي تحددها هنا. القيمة صفر تعني عدد غير محدود',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'الحد الأقصى لطول / عدد حروف الإعلانات العامة ',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXP'		=> 'القيمة صفر تعني عدد غير محدود',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'المنتديات ',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXP'	=> 'حدد المنتديات التي تريد إظهار الإعلانات منها. عدم التحديد يعني إظهار الإعلانات من جميع المنتديات. <br />تستطيع هنا كذلك تحديد المنتديات التي تريد استثنائها من الإعلانات بشرط أن تختار "نعم" في الخيار أدناه ( استثناء المنتديات ). <br />تستطيع تحديد أو إلغاء التحديد لأكثر من منتدى بواسطة النقر مطولاً على زر الكنترول <samp>CTRL</samp> والتحديد بالماوس على المنتديات المطلوبة.',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE'		=> 'استثناء المنتديات ',
	'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE_EXP'=> 'اختار "نعم" إذا تريد استثناء الإعلانات من المنتديات التي حددتها في الخيار أعلاه ( المنتديات ). اختار "لا" لتعطيل هذا الخيار.',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'تفعيل / تعطيل الصلاحيات ',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXP'	=> 'سيتم تطبيق نفس صلاحيات العضو لمًشاهدة المنتدى على هذا الموديل.',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'تفعيل نظام الأرشفة ',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXP'		=> 'اختيارك "نعم" يعني إظهار أرقام الصفحات / نظام الأرشفة للإعلانات.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'إظهار عدد الردود و المُشاهدات ',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'هذه الإعدادات متعلقة بالتصميم الإفتراضي.<br />سيتم عرض عدد الردود و المُشاهدات في 2 أعمدة إضافية عند اختيارك "نعم". سيتم عرض عدد الردود و المُشاهدات بجانب اسم المنتدى عند اختيارك "لا". <br />يُنصح بإختيار "لا" في حالة وجود مشاكل في ظهور الأعمدة الإضافية والتي تتطلب مساحة أكبر.',
));
