<?php
/**
*
* @package Board3 Portal v2.1 - Donation
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
	'DONATION' 		=> 'تبرعات الـPaypal',
	'DONATION_TEXT'	=> 'التبرعات هي عبارة عن دعم للخدمات التي نقدمها في موقعنا ولا توجد أي نية للحصول على مكاسب مالية منها. نرحب بتبرعاتكم التي ستساعد في تغطية تكاليف السيرفر والإستضافة , إسم النطاق...الخ.',
	'PAY_MSG'       => 'الرجاء استخدام النقطة العشرية ( . ) وعدم استخدام علامة الفاصلة ( , ). مثال 3.50',
	'PAY_ITEM'		=> 'تبرع !', // paypal item

	'AUD'						=> 'دولار استرالي (AUD)',
	'CAD'						=> 'دولار كندي (CAD)',
	'CZK'						=> 'الكورونا التشيكية (CZK)',
	'DKK'						=> 'الكرونة الدنماركي (DKK)',
	'HKD'						=> 'دولار هونج كونج (HKD)',
	'HUF'						=> 'فورينت هنجاري / مجري (HUF)',
	'NZD'						=> 'دولار نيوزلاندي (NZD)',
	'NOK'						=> 'كرونه نرويجي (NOK)',
	'PLN'						=> 'زلوتي بولندي (PLN)',
	'GBP'						=> 'جنيه استرليني (GBP)',
	'SGD'						=> 'دولار سينغافوري (SGD)',
	'SEK'						=> 'كرونه سويدي (SEK)',
	'CHF'						=> 'فرنك سويسري (CHF)',
	'JPY'						=> 'ين ياباني (JPY)',
	'USD'						=> 'دولار أمريكي (USD)',
	'EUR'						=> 'يورو (EUR)',
	'MXN'						=> 'بيزو مكسيكي (MXN)',
	'ILS'						=> 'شيكل اسرائيلي (ILS)',

	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'إعدادات الـ Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'		=> 'من هنا تستطيع تخصيص موديل التبرعات Paypal.',
	'PORTAL_PAY_ACC'						=> 'حسابك في الـ Paypal ',
	'PORTAL_PAY_ACC_EXP'					=> 'أدخل البريد الإلكتروني الخاص بك في موقع الـ Paypal. مثال : xxx@xxx.com',
	'PORTAL_PAY_CUSTOM'						=> 'إضافة إسم المستخدم إلى تبرعات الـ Paypal',
	'PORTAL_PAY_DEFAULT'					=> 'العُملة الإفتراضية ',
	'PORTAL_PAY_DEFAULT_EXP'				=> 'العُملة التي سيتم تحديدها افتراضياً في القائمة المُنسدلة للعُملات.'
));
