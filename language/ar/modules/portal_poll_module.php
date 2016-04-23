<?php
/**
*
* @package Board3 Portal v2.1 - Poll
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
	'PORTAL_POLL'			=> 'التصويت',
	'LATEST_POLLS'			=> 'أحدث التصويتات',
	'NO_OPTIONS'			=> 'لا توجد خيارات في هذا التصويت.',
	'NO_POLL'				=> 'لا يوجد أي تصويت',
	'RETURN_PORTAL'			=> '%sالعودة إلى المجلة%s',

	// ACP
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'إعدادات التصويت',
	'ACP_PORTAL_POLLS_SETTINGS_EXP'	=> 'من هنا تستطيع تخصيص موديل التصويت.',
	'PORTAL_POLL_TOPIC_ID'				=> 'المنتديات ',
	'PORTAL_POLL_TOPIC_ID_EXP'		=> 'حدد المنتديات التي تريد إظهار التصويتات منها. عدم التحديد يعني إظهار التصويتات من جميع المنتديات. <br />تستطيع هنا كذلك تحديد المنتديات التي تريد استثنائها من التصويتات بشرط أن تختار "نعم" في الخيار أدناه ( استثناء المنتديات ). <br />تستطيع تحديد أو إلغاء التحديد لأكثر من منتدى بواسطة النقر مطولاً على زر الكنترول <samp>CTRL</samp> والتحديد بالماوس على المنتديات المطلوبة.',
	'PORTAL_POLL_EXCLUDE_ID'			=> 'استثناء المنتديات ',
	'PORTAL_POLL_EXCLUDE_ID_EXP'	=> 'اختار "نعم" إذا تريد استثناء التصويتات من المنتديات التي حددتها في الخيار أعلاه ( المنتديات ). اختار "لا" لتعطيل هذا الخيار.',
	'PORTAL_POLL_LIMIT'					=> 'عدد التصويتات ',
	'PORTAL_POLL_LIMIT_EXP'			=> 'عدد التصويتات التي تريد عرضها في صفحة المجلة.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'السماح بالتصويت ',
	'PORTAL_POLL_ALLOW_VOTE_EXP'	=> 'السماح للأعضاء الذين يملكون الصلاحيات المطلوبة بالتصويت بواسطة صفحة المجلة.',
	'PORTAL_POLL_HIDE'					=> 'إخفاء التصويتات المُنتهية ',
));
