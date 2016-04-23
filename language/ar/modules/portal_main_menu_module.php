<?php
/**
*
* @package Board3 Portal v2.1 - Main Menu
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
	'M_MENU' 	=> 'القائمة',
	'M_CONTENT'	=> 'المحتوى',
	'M_ACP'		=> 'لوحة تحكم المدير',
	'M_HELP'	=> 'مساعدة',
	'M_BBCODE'	=> 'دليل BBCode',
	'M_TERMS'	=> 'شروط الإستخدام',
	'M_PRV'		=> 'سياسة الخصوصية',
	'M_SEARCH'	=> 'بحث',
	'MENU_NO_LINKS'	=> 'لا يوجد روابط',

	// ACP
	'ACP_PORTAL_MENU'				=> 'إعدادات القائمة',
	'ACP_PORTAL_MENU_LINK_SETTINGS'	=> 'إعدادات الرابط',
	'ACP_PORTAL_MENU_EXP'			=> 'من هنا تستطيع تخصيص القائمة الرئيسية',
	'ACP_PORTAL_MENU_MANAGE'		=> 'إدارة القائمة',
	'ACP_PORTAL_MENU_MANAGE_EXP'	=> 'من هنا تستطيع إدارة الروابط في القائمة الرئيسية.',
	'ACP_PORTAL_MENU_CAT'			=> 'القسم',
	'ACP_PORTAL_MENU_IS_CAT'		=> 'اجعله قسم خاص ',
	'ACP_PORTAL_MENU_INT'			=> 'داخلي',
	'ACP_PORTAL_MENU_EXT'			=> 'خارجي',
	'ACP_PORTAL_MENU_TITLE'			=> 'العنوان ',
	'ACP_PORTAL_MENU_URL'			=> 'عنوان الرابط ',
	'ACP_PORTAL_MENU_ADD'			=> 'إضافة رابط تنقل جديد',
	'ACP_PORTAL_MENU_TYPE'			=> 'نوع الرابط ',
	'ACP_PORTAL_MENU_TYPE_EXP'		=> 'اختار "داخلي" لو لديك رابط إلى صفحة موجودة في منتداك من أجل منع الخروج الغبر مرغوب به خارج منتداك.',
	'ACP_PORTAL_MENU_CREATE_CAT'	=> 'يجب عليك أولاً إنشاء قسم.',
	'ACP_PORTAL_MENU_URL_EXP'		=> 'الروابط الخارجية :<br />يجب أن تحتوي جميع الروابط على http://<br /><br />الروابط الداخلية :<br />يجب أن تضيف فقط ملف الـ php كرابط. مثال : index.php?style=4.',
	'ACP_PORTAL_MENU_PERMISSION'	=> 'صلاحيات الرابط ',
	'ACP_PORTAL_MENU_PERMISSION_EXP'=> 'حدد المجموعات التي تستطيع مُشاهدة هذا الرابط. عدم تحديد أي مجموعة يعني عرض هذا الرابط لجميع الأعضاء.<br />تستطيع تحديد أو إلعاء التحديد لأكثر من مجموعة بالنقر باستمرار على زر الكنترول <samp>CTRL</samp> والنقر بنفس الوقت بالماوس على المجموعة المطلوبة.',
	'ACP_PORTAL_MENU_EXT_NEW_WINDOW'=> 'فتح الروابط الخارجية في نافذة جديدة ',

	// Errors
	'NO_LINK_TITLE'					=> 'يجب عليك إضافة عنوان لهذا الرابط.',
	'NO_LINK_URL'					=> 'يجب عليك إضافة الرابط.',
));
