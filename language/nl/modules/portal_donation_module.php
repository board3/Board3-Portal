<?php
/**
*
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
* @package Board3 Portal v2.1 - Donation
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'DONATION' 		=> 'PayPal donaties',
	'DONATION_TEXT'	=> 'is een groep die is gericht op het leveren van diensten en heeft geen enkele intentie om er zelf financieel beter van te worden. Je donatie is van harte welkom, zodat de kosten van onze server, domeinnaam, etc. kunnen worden gedekt.',
	'PAY_MSG'       => 'Gebruik een decimale punt (geen komma) als scheidingsteken, bijv: 3.50',
	'PAY_ITEM'		=> 'Doneer!', // paypal item
	'AUD'						=> 'Australische Dollars (AUD)',
	'CAD'						=> 'Canadese Dollars (CAD)',
	'CZK'						=> 'Tsjechische Kroon (CZK)',
	'DKK'						=> 'Deense Kronen (DKK)',
	'HKD'						=> 'Hong Kong Dollars (HKD)',
	'HUF'						=> 'Hongaarse Forint (HUF)',
	'NZD'						=> 'Nieuw-Zeelandse Dollars (NZD)',
	'NOK'						=> 'Noorse Kronen (NOK)',
	'PLN'						=> 'Poolse Zloty (PLN)',
	'GBP'						=> 'Britse Ponden (GBP)',
	'SGD'						=> 'Singaporese Dollars (SGD)',
	'SEK'						=> 'Zweedse Kronen (SEK)',
	'CHF'						=> 'Zwitserse Franken (CHF)',
	'JPY'						=> 'Japanse Yen (JPY)',
	'USD'						=> 'U.S. Dollars (USD)',
	'EUR'						=> 'Euros (EUR)',
	'MXN'						=> 'Mexicaanse Peso (MXN)',
	'ILS'						=> 'Israëlische Shekel (ILS)',
	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'PayPal instellingen',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'		=> 'Hier kan je het PayPal blok aanpassen.',
	'PORTAL_PAY_ACC'						=> 'PayPal account om te gebruiken',
	'PORTAL_PAY_ACC_EXP'					=> 'Vul je Paypal e-mailadres in bijv: xxx@xxx.com',
	'PORTAL_PAY_CUSTOM'						=> 'Voeg gebruikersnaam toe bij een PayPal donatie',
));
