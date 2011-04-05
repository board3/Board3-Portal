<?php
/**
*
* @package Board3 Portal v2 - Donation
* @copyright (c) Board3 Group ( www.board3.de )
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
	'DONATION' 		=> 'PayPal donations',
	'DONATION_TEXT'	=> 'is a group supplying services with no intention of any monetary profit. Your donations are welcome so that the cost of our server, domain name, etc. can be covered.',
	'PAY_MSG'       => 'Please use a decimal point (not a comma) as the separator, e.g. 3.50',
	'PAY_ITEM'		=> 'Donate!', // paypal item

	'AUD'						=> 'Australian Dollars (AUD)',
	'CAD'						=> 'Canadian Dollars (CAD)',
	'CZK'						=> 'Czech Koruna (CZK)',
	'DKK'						=> 'Danish Kroner (DKK)',
	'HKD'						=> 'Hong Kong Dollars (HKD)',
	'HUF'						=> 'Hungarian Forint (HUF)',
	'NZD'						=> 'New Zealand Dollars (NZD)',
	'NOK'						=> 'Norwegian Kroner (NOK)',
	'PLN'						=> 'Polish Zlotych (PLN)',
	'GBP'						=> 'British Pounds (GBP)',
	'SGD'						=> 'Singapore Dollars (SGD)',
	'SEK'						=> 'Swedish Kronor (SEK)',
	'CHF'						=> 'Swiss Francs (CHF)',
	'JPY'						=> 'Japanese Yen (JPY)',
	'USD'						=> 'U.S. Dollars (USD)',
	'EUR'						=> 'Euros (EUR)',
	'MXN'						=> 'Mexican Pesos (MXN)',
	'ILS'						=> 'Israeli New Shekels (ILS)',
	
	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypal settings',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'This is where you customize the Paypal block.',
	'PORTAL_PAY_C_BLOCK'					=> 'Display paypal center block',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_PAY_S_BLOCK'					=> 'Display paypal small block',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Display this block on the portal.',
	'PORTAL_PAY_ACC'						=> 'Paypal account to use',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Enter your Paypal e-mail address eg. xxx@xxx.com',
));
