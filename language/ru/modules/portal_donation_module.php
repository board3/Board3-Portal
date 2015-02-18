<?php
/**
*
* @package Board3 Portal v2 - Donation
* @copyright (c) Board3 Group (www.board3.de)
* @translator (c) Mac (www.belgut.by)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
	'DONATION' 		=> 'PayPal пожертвование',
	'DONATION_TEXT'	=> '— некоммерческий сайт, он существует на энтузиазме нашей команды. Хотите нас поддержать? Вы можете нам очень помочь, пожертвовав немного на содержание сайта.',
	'PAY_MSG'       => 'Для отделения дробной части используйте точку, например 3.50',
	'PAY_ITEM'		=> 'Пожертвовать!', // paypal item

	'AUD'						=> 'Австралийские доллары (AUD)',
	'CAD'						=> 'Канадские доллары (CAD)',
	'CZK'						=> 'Чешские кроны (CZK)',
	'DKK'						=> 'Датские кроны (DKK)',
	'HKD'						=> 'Гонконгские доллары (HKD)',
	'HUF'						=> 'Венгерские форинты (HUF)',
	'NZD'						=> 'Новозеландские доллары (NZD)',
	'NOK'						=> 'Норвежские кроны (NOK)',
	'PLN'						=> 'Польские злотые (PLN)',
	'GBP'						=> 'Британские фунты (GBP)',
	'SGD'						=> 'Сингапуские доллары (SGD)',
	'SEK'						=> 'Шведские кроны (SEK)',
	'CHF'						=> 'Швейцарские франки (CHF)',
	'JPY'						=> 'Японские йены (JPY)',
	'USD'						=> 'Доллары США (USD)',
	'EUR'						=> 'Евро (EUR)',
	'MXN'						=> 'Мексиканские песо (MXN)',
	'ILS'						=> 'Новые израильские шекели (ILS)',
	
	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Настройки Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Здесь настраивается блок Paypal.',
	'PORTAL_PAY_C_BLOCK'					=> 'Отображать центральный блок «Пожертвование»',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Отображать на портале этот блок.',
	'PORTAL_PAY_S_BLOCK'					=> 'Отображать малый блок «Пожертвование»',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Отображать на портале этот блок.',
	'PORTAL_PAY_ACC'						=> 'Учётная запись Paypal',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Введите ваш e-mail, используемый в Paypal, например хxx@xxx.com',
));
