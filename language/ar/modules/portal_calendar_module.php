<?php
/**
*
* @package Board3 Portal v2.1 - Calendar
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
	'PORTAL_CALENDAR'			=> 'التقويم',
	'VIEW_NEXT_MONTH'		=> 'الشهر التالي',
	'VIEW_PREVIOUS_MONTH'	=> 'الشهر السابق',
	'EVENT_START'			=> 'من ',
	'EVENT_END'				=> 'إلى ',
	'EVENT_TIME'			=> 'التوقيت ',
	'EVENT_ALL_DAY'			=> 'طوال اليوم ',
	'CURRENT_EVENTS'		=> 'الأحداث الحالية ',
	'NO_CUR_EVENTS'			=> 'لا توجد أحداث حالية',
	'UPCOMING_EVENTS'		=> 'الأحداث القادمة ',
	'NO_UPCOMING_EVENTS'	=> 'لا توجد أحداث قادمة',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'أح',
			'2'	=> 'أث',
			'3'	=> 'ثل',
			'4'	=> 'أر',
			'5'	=> 'خم',
			'6'	=> 'جم',
			'7'	=> 'سب',
		),

		'month'	=> array(
			'1'	=> 'ينا.',
			'2'	=> 'فبر.',
			'3'	=> 'مار.',
			'4'	=> 'أبر.',
			'5'	=> 'ماي',
			'6'	=> 'يول.',
			'7'	=> 'يون.',
			'8'	=> 'أغس.',
			'9'	=> 'سبت.',
			'10'=> 'أكت.',
			'11'=> 'نوف.',
			'12'=> 'ديس.',
		),

		'long_month'=> array(
			'1'	=> 'يناير',
			'2'	=> 'فبراير',
			'3'	=> 'مارس',
			'4'	=> 'أبريل',
			'5'	=> 'مايو',
			'6'	=> 'يونيو',
			'7'	=> 'يوليو',
			'8'	=> 'أغسطس',
			'9'	=> 'سبتمبر',
			'10'=> 'أكتوبر',
			'11'=> 'نوفمبر',
			'12'=> 'ديسمبر',
		),
	),

	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'إعدادات التقويم',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'من هنا تستطيع تخصيص موديل التقويم.',
	'ACP_PORTAL_EVENTS'						=> 'الأحداث',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'لون اليوم الحالي ',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'	=> 'تستطيع إضافة أكواد الألوان HEX مثل : #FFFFFF للون الأبيض , أو إضافة أسماء الألوان باللغة الإنجليزية مثل : violet ( البنفسجي ).',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'لون يوم الأحد ',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'	=> 'تستطيع إضافة أكواد الألوان HEX مثل : #FFFFFF للون الأبيض , أو إضافة أسماء الألوان باللغة الإنجليزية مثل : violet ( البنفسجي ).',
	'PORTAL_LONG_MONTH'						=> 'إظهار الإسم الكامل للشهور ',
	'PORTAL_LONG_MONTH_EXP'				=> 'أسماء الشهور ستكون مُختصرة عند اختيارك "لا". مثال : سيكون أغس بدلاً من أغسطس.',
	'PORTAL_SUNDAY_FIRST'					=> 'أول أيام الأسبوع ',
	'PORTAL_SUNDAY_FIRST_EXP'			=> 'سيبدأ الأسبوع في التقويم من ( الأثنين ) إلى ( الأحد ) عند اختيارك "لا". وسيكون من ( الأحد ) إلى ( السبت ) عند اختيارك "نعم".',
	'PORTAL_DISPLAY_EVENTS'					=> 'إظهار الأحداث ',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'سيتم عرض الأحداث التي تم إنشائها في موديل التقويم',
	'PORTAL_EVENTS_MANAGE'					=> 'إدارة الأحداث',
	'NO_EVENT_TITLE'						=> 'لم يتم إضافة عنوان للحدث.',
	'NO_EVENT_START'						=> 'لم يتم إضافة تاريخ البداية للحدث.',
	'ADD_EVENT'								=> 'إضافة حدث جديد',
	'EVENT_UPDATED'							=> 'تم تحديث الحدث بنجاح.',
	'EVENT_ADDED'							=> 'تم إضافة الحدث بنجاح.',
	'NO_EVENT'								=> 'لم يتم تحديد أي حدث.',
	'EVENT_TITLE'							=> 'عنوان الحدث ',
	'EVENT_DESC'							=> 'وصف الحدث ',
	'EVENT_LINK'							=> 'رابط الحدث ',
	'EVENT_LINK_EXP'						=> 'أدخل الرابط إلى الموضوع أو إلى موقع يحتوي على الإعلان / موضوع مناقشة الحدث.',
	'NO_EVENTS'								=> 'لا يوجد أحداث',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'توقيت البداية الذي أدخلته غير صحيح. الرجاء اتباع التعليمات بعناية.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'توقيت النهاية الذي أدخلته غير صحيح. الرجاء اتباع التعليمات بعناية.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'توقيت بداية الحدث يجب أن يكون في المستقبل.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'تاريخ بداية الحدث ',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'أدخل تاريخ و وقت بداية الحدث. يجب أن يكون التوقيت على هذا الشكل : MM/DD/YYYY 3:00 PM',
	'ACP_PORTAL_EVENT_END_DATE'			=> 'تاريخ نهاية الحدث ',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'أدخل تاريخ و وقت نهاية الحدث. يجب أن يكون التوقيت على هذا الشكل : MM/DD/YYYY 3:00 PM',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'نهاية الحدث يجب أن يكون بعد بداية الحدث.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'الصلاحيات ',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'حدد المجموعات التي تستطيع مُشاهدة موديل الأحداث. يجب عليك عدم تحديد أي مجموعة لو تريد عرض هذا الموديل لجميع الأعضاء. <br />تستطيع تحديد أو إلعاء التحديد لأكثر من مجموعة بالنقر باستمرار على زر الكنترول <samp>CTRL</samp> والنقر بنفس الوقت بالماوس على المجموعة المطلوبة.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'افتح الروابط الخارجية للحدث في نافذة جديدة ',

	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>تم تحديث الحدث في المجلة</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>تم إضافة الحدث في المجلة</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>تم حذف الحدث في المجلة</strong><br />&raquo; %s',
));
