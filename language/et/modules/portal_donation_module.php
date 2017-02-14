<?php
/**
*
* @package Board3 Portal v2.1 - Donation
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Estonian translation by phpBBeesti.com (http://www.phpbbeesti.com/) 
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
	'DONATION' 		=> 'PayPal toetused',
	'DONATION_TEXT'	=> 'on grupp, mis pakub teenuseid ilma mingisuguseta rahalise kasumita. Sinu toetus on alati oodatud, ning seda kasutatakse meie serveri ja domeeninime kateks.',
	'PAY_MSG'       => 'Palun kasuta punkti (mitte koma) sentide eraldamiseks, näiteks: 3.50',
	'PAY_ITEM'		=> 'Toeta!', // paypal item
	'AUD'						=> 'Austraalia Dollar (AUD)',
	'CAD'						=> 'Kanada Dollar (CAD)',
	'CZK'						=> 'Tšehhi Kroon (CZK)',
	'DKK'						=> 'Taani Kroon (DKK)',
	'HKD'						=> 'Hong Kongi Dollar (HKD)',
	'HUF'						=> 'Ungari Forint (HUF)',
	'NZD'						=> 'Uus-Meremaa Dollar (NZD)',
	'NOK'						=> 'Norra Kroon (NOK)',
	'PLN'						=> 'Poola Zlott (PLN)',
	'GBP'						=> 'Briti Naelad (GBP)',
	'SGD'						=> 'Singapuri Dollar (SGD)',
	'SEK'						=> 'Rootsi Kroon (SEK)',
	'CHF'						=> 'Šveitsi Frank (CHF)',
	'JPY'						=> 'Jaapani Yen (JPY)',
	'USD'						=> 'USA Dollar (USD)',
	'EUR'						=> 'Euro (EUR)',
	'MXN'						=> 'Mehhiko Peesod (MXN)',
	'ILS'						=> 'Iisreali Uus seekel (ILS)',
	// ACP => AJP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypal seaded',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'		=> 'Siin leheküljel saad sa kohandada oma portaali Paypali plokki.',
	'PORTAL_PAY_ACC'						=> 'Paypal kasutajakonto, mida kasutatakse',
	'PORTAL_PAY_ACC_EXP'					=> 'Sisesta siia oma paypal.com e-posti aadress, näiteks xxx@xxx.com',
	'PORTAL_PAY_CUSTOM'				=> 'Lisa kasutajanimi Paypal toetaja',
));
