<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
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
	// Portal Modules
	'ACP_PORTAL_MODULES_EXP'		=> 'من هنا تستطيع إدارة الموديلات الخاصة بمجلتك. نرجوا تعطيل المجلة إذا عطلت أيضاً جميع الموديلات ولم تفعل أي موديل.',

	'MODULE_POS_TOP'				=> 'الأعلى',
	'MODULE_POS_LEFT'				=> 'العمود اليسار',
	'MODULE_POS_RIGHT'				=> 'العمود اليمين',
	'MODULE_POS_CENTER'				=> 'العمود الوسط',
	'MODULE_POS_BOTTOM'				=> 'الأسفل',
	'ADD_MODULE'					=> 'إضافة موديل',
	'CHOOSE_MODULE'					=> 'اختار موديل',
	'CHOOSE_MODULE_EXP'				=> 'اختار الموديل من القائمة المُنسدلة',
	'SUCCESS_ADD'					=> 'تم إضافة الموديل بنجاح.',
	'SUCCESS_DELETE'				=> 'تم حذف الموديل بنجاح.',
	'NO_MODULES'					=> 'لم يتم الكشف عن أي موديلات.',
	'MOVE_RIGHT'					=> 'تحريك لليمين',
	'MOVE_LEFT'						=> 'تحريك لليسار',
	'B3P_FILE_NOT_FOUND'			=> 'لم يتم العثور على الملف المطلوب',
	'UNABLE_TO_MOVE'				=> 'لا يُمكن تحريك الموديل إلى العمود الذي حددته.',
	'UNABLE_TO_MOVE_ROW'			=> 'لا يُمكن تحريك الموديل إلى الصف الذي حددته.',
	'UNABLE_TO_ADD_MODULE'			=> 'لا يُمكن إضافة الموديل إلى العمود الذي حددته.',
	'DELETE_MODULE_CONFIRM'			=> 'هل أنت متأكد من حذف الموديل "%1$s" ?',
	'MODULE_RESET_SUCCESS'			=> 'تم إعادة ضبط إعدادت الموديل.',
	'MODULE_RESET_CONFIRM'			=> 'هل أنت متأكد من إعادة ضبط إعدادات الموديل "%1$s" ?',
	'MODULE_NOT_EXISTS'				=> 'الموديل المُحدد غير موجود.',

	'MODULE_OPTIONS'			=> 'خيارات الموديل',
	'MODULE_NAME'				=> 'الإسم ',
	'MODULE_NAME_EXP'			=> 'ادخل إسم الموديل الذي يجب عرضه في ضبط الموديل.',
	'MODULE_IMAGE'				=> 'الصورة ',
	'MODULE_IMAGE_EXP'			=> 'ادخل إسم صورة الموديل. يجب أن تكون الصور موجودة في المسار styles/{yourstyle}/theme/images/portal/. {yourstyle} يعني إسم مجلد الاستايل الذي تستخدمه.',
	'MODULE_PERMISSIONS'		=> 'الصلاحيات ',
	'MODULE_PERMISSIONS_EXP'	=> 'حدد المجموعات التي تستطيع مُشاهدة هذا الموديل. عدم تحديد أي مجموعة يعني عرض هذا الموديل لجميع الأعضاء.<br />تستطيع تحديد أو إلعاء التحديد لأكثر من مجموعة بالنقر باستمرار على زر الكنترول <samp>CTRL</samp> والنقر بنفس الوقت بالماوس على المجموعة المطلوبة.',
	'MODULE_IMAGE_WIDTH'		=> 'عرض الصورة ',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'ادخل مقاس العرض لصورة الموديل بالبيكسل',
	'MODULE_IMAGE_HEIGHT'		=> 'ارتفاع الصورة ',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'ادخل مقاس الإرتفاع لصورة الموديل بالبيكسل',
	'MODULE_RESET'				=> 'إعادة ضبط الإعدادات ',
	'MODULE_RESET_EXP'			=> 'سوف يتم إعادة ضبط الإعدادات إلى الإفتراضية !',
	'MODULE_STATUS'				=> 'تفعيل ',
	'MODULE_ADD_ONCE'			=> 'يُمكن إضافة هذا الموديل مرة واحدة فقط.',
	'MODULE_IMAGE_ERROR'		=> 'يوجد خطأ أثناء التحقق من صورة الموديل :',
	'UNKNOWN_MODULE_METHOD'		=> 'لا يُمكن مُعالجة طريقة الموديل %1$s.',

	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'إعدادات عامة',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'إدارة المجلة',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'شكراً لإستخدامك مجلة المنتدى Board3 ! من هنا تستطيع إدارة صفحة المجلة. الخيارات الموجود بالأسفل تعطيك إمكانية تخصيص العديد من الإعدادات العامة.',
	'ACP_PORTAL_SHOW_ALL'					=> 'إظهار المجلة على جميع الصفحات ',
	'ACP_PORTAL_SHOW_ALL_EXP'				=> 'عرض المجلة على جميع الصفحات',
	'PORTAL_ENABLE'							=> 'تفعيل ',
	'PORTAL_ENABLE_EXP'						=> 'تفعيل أو تعطيل المجلة',
	'PORTAL_LEFT_COLUMN'					=> 'تفعيل العمود اليسار ',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'عرض العمود اليسار فقط وإخفاء اليمين',
	'PORTAL_RIGHT_COLUMN'					=> 'تفعيل العمود اليمين ',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'عرض العمود اليمين فقط وإخفاء اليسار',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'إظهار صندوق التنقل السريع ',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'عرض صندوق التنقل السريع في المجلة. لن يعمل هذا الخيار إذا تم تعطيل صندوق التنقل السريع في خصائص المنتدى.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'إعدادات عرض الأعمدة',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'عرض العمود اليسار ',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'تغيير عرض العمود اليسار بالبيكسل ؛ ننصح بالقيمة 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'عرض العمود اليمين  ',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'تغيير عرض العمود اليمين بالبيكسل ؛ ننصح بالقيمة 180',
	'PORTAL_SHOW_ALL_SIDE'					=> 'اظهار العمود على جميع الصفحات ',
	'PORTAL_SHOW_ALL_SIDE_EXP'				=> 'اختار أحد الأعمدة لعرضه على جميع الصفحات.',
	'PORTAL_SHOW_ALL_LEFT'					=> 'يسار',
	'PORTAL_SHOW_ALL_RIGHT'					=> 'يمين',

	'LINK_ADDED'							=> 'تم إضافة الرابط بنجاح',
	'LINK_UPDATED'							=> 'تم تحديث الرابط بنجاح',

	// Install
	'PORTAL_BASIC_INSTALL'			=> 'جاري إضافة الموديلات الأساسية',
	'PORTAL_BASIC_UNINSTALL'		=> 'جاري حذف الموديلات من قاعدة البيانات',
));
