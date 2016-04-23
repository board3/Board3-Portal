<?php
/**
*
* @package Board3 Portal v2.1 - News
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
	'LATEST_NEWS'			=> 'آخر الأخبار',
	'READ_FULL'				=> 'اقرأ المزيد',
	'NO_NEWS'				=> 'لا يوجد أخبار',
	'POSTED_BY'				=> 'كاتب المُشاركة',
	'COMMENTS'				=> 'التعليقات',
	'VIEW_COMMENTS'			=> 'مُشاهدة التعليقات',
	'PORTAL_POST_REPLY'		=> 'إضافة تعليق',
	'TOPIC_VIEWS'			=> 'المُشاهدات',
	'JUMP_NEWEST'			=> 'انتقل إلى أحدث مُشاركة',
	'JUMP_FIRST'			=> 'انتقل إلى أول مُشاركة',
	'JUMP_TO_POST'			=> 'انتقل إلى المُشاركة',

	// ACP
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'إعدادات الأخبار',
	'ACP_PORTAL_NEWS_SETTINGS_EXP'	=> 'من هنا تستطيع تخصيص موديل الأخبار.',
	'PORTAL_NEWS_STYLE'					=> 'التصميم الإفتراضي ',
	'PORTAL_NEWS_STYLE_EXP'			=> 'اختيارك "نعم" يعني استخدام التصميم الإفتراضي لشكل المنتديات ( بدون محتوى الأخبار ). اختيارك "لا" يعني استخدام التصميم الخاص بالمجلة ( عرض النص / محتوى الأخبار ).',
	'PORTAL_SHOW_ALL_NEWS'				=> 'عرض جميع الأخبار ',
	'PORTAL_SHOW_ALL_NEWS_EXP'		=> 'عرض جميع الأخبار في هذا المنتدى ( يشمل المواضيع المُثبتة ).',
	'PORTAL_NUMBER_OF_NEWS'				=> 'عدد الأخبار في المجلة ',
	'PORTAL_NUMBER_OF_NEWS_EXP'		=> 'القيمة صفر تعني عدد غير محدود',
	'PORTAL_NEWS_LENGTH'				=> 'الحد الأقصى لطول / عدد حروف الأخبار ',
	'PORTAL_NEWS_LENGTH_EXP'		=> 'القيمة صفر تعني عدد غير محدود',
	'PORTAL_NEWS_FORUM' 				=> 'المنتديات ',
	'PORTAL_NEWS_FORUM_EXP' 		=> 'حدد المنتديات التي تريد إظهار الأخبار منها. عدم التحديد يعني إظهار الأخبار من جميع المنتديات. <br />تستطيع هنا كذلك تحديد المنتديات التي تريد استثنائها من الأخبار بشرط أن تختار "نعم" في الخيار أدناه ( استثناء المنتديات ). <br />تستطيع تحديد أو إلغاء التحديد لأكثر من منتدى بواسطة النقر مطولاً على زر الكنترول <samp>CTRL</samp> والتحديد بالماوس على المنتديات المطلوبة.',
	'PORTAL_NEWS_EXCLUDE'				=> 'استثناء المنتديات ',
	'PORTAL_NEWS_EXCLUDE_EXP'		=> 'اختار "نعم" إذا تريد استثناء الأخبار من المنتديات التي حددتها في الخيار أعلاه ( المنتديات ). اختار "لا" لتعطيل هذا الخيار.',
	'PORTAL_NEWS_PERMISSIONS'			=> 'تفعيل / تعطيل الصلاحيات ',
	'PORTAL_NEWS_PERMISSIONS_EXP'	=> 'سيتم تطبيق نفس صلاحيات العضو لمًشاهدة المنتدى على هذا الموديل.',
	'PORTAL_NEWS_SHOW_LAST'				=> 'الترتيب بحسب آخر مُشاركة ',
	'PORTAL_NEWS_SHOW_LAST_EXP'		=> 'اختار "نعم" إذا تريد ترتيب آخر الأخبار بحسب آخر مُشاركة. اختار "لا" إذا تريد الترتيب بحسب آخر موضوع.',
	'PORTAL_NEWS_ARCHIVE'				=> 'تفعيل نظام الأرشفة ',
	'PORTAL_NEWS_ARCHIVE_EXP'		=> 'اختيارك "نعم" يعني إظهار أرقام الصفحات / نظام الأرشفة للأخبار.',
	'PORTAL_SHOW_REPLIES_VIEWS'				=> 'إظهار عدد الردود و المُشاهدات ',
	'PORTAL_SHOW_REPLIES_VIEWS_EXP'		=> 'هذه الإعدادات متعلقة بالتصميم الإفتراضي.<br />سيتم عرض عدد الردود و المُشاهدات في 2 أعمدة إضافية عند اختيارك "نعم". سيتم عرض عدد الردود و المُشاهدات بجانب اسم المنتدى عند اختيارك "لا". <br />يُنصح بإختيار "لا" في حالة وجود مشاكل في ظهور الأعمدة الإضافية والتي تتطلب مساحة أكبر.',
));
