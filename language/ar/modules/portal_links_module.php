<?php
/**
*
* @package Board3 Portal v2.1 - Links
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
	'PORTAL_LINKS'		=> 'الروابط',
	'LINKS_NO_LINKS'	=> 'لا يوجد روابط',

	// ACP
	'ACP_PORTAL_LINKS'				=> 'إعدادات الروابط',
	'ACP_PORTAL_LINKS_EXP'			=> 'من هنا تستطيع تخصيص قائمة الروابط في موديل الروابط',
	'ACP_PORTAL_LINK_TITLE'			=> 'العنوان',
	'ACP_PORTAL_LINK_TYPE'			=> 'نوع الرابط ',
	'ACP_PORTAL_LINK_TYPE_EXP'		=> 'حدد الخيار "رابط داخلي" اذا لديك رابط لأحد صفحات منتداك ولكي تمنع الخروج من منتداك.',
	'ACP_PORTAL_LINK_INT'			=> 'رابط داخلي',
	'ACP_PORTAL_LINK_EXT'			=> 'رابط خارجي',
	'ACP_PORTAL_LINK_ADD'			=> 'إضافة رابط جديد ',
	'ACP_PORTAL_LINK_URL'			=> 'عنوان الرابط ',
	'ACP_PORTAL_LINK_URL_EXP'		=> 'الروابط الخارجية :<br />يجب أن تحتوي جميع الروابط على http://<br /><br />الروابط الداخلية :<br />فقط أدخل الملف php file كعنوان رابط , مثال : index.php?style=4.',
	'ACP_PORTAL_LINK_PERMISSION'	=> 'صلاحيات الرابط ',
	'ACP_PORTAL_LINK_PERMISSION_EXP'=> 'حدد المجموعات التي تستطيع مُشاهدة الرابط. يجب عليك عدم تحديد أي مجموعة لو تريد عرض هذا الرابط لجميع الأعضاء.<br />تستطيع تحديد أو إلعاء التحديد لأكثر من مجموعة بالنقر باستمرار على زر الكنترول <samp>CTRL</samp> والنقر بنفس الوقت بالماوس على المجموعة المطلوبة.',
	'ACP_PORTAL_LINKS_NEW_WINDOW'	=> 'فتح الروابط الخارجية في نافذة جديدة ',

	// Errors
	'NO_LINK_TITLE'					=> 'يجب عليك إضافة عنوان لهذا الرابط.',
	'NO_LINK_URL'					=> 'يجب عليك إضافة عنوان الرابط.',
));
