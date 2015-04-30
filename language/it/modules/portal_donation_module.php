<?php
/**
*
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
	'DONATION' 		=> 'Donazioni PayPal',
	'DONATION_TEXT'	=> 'è un fornitore di servizi non a scopo di lucro. Le tue donazioni sono ben accette: in questo modo potranno essere sostenuti i costi di mantenimento del sito.',
	'PAY_MSG'       => 'Usare il punto come separatore decimali (per esempio 3.50)',
	'PAY_ITEM'		=> 'Dona!', // paypal item

	'AUD'						=> 'Dollari australiani (AUD)',
	'CAD'						=> 'Collari canadesi (CAD)',
	'CZK'						=> 'Corona ceca (CZK)',
	'DKK'						=> 'Corona danese (DKK)',
	'HKD'						=> 'Dollari di Honk Kong (HKD)',
	'HUF'						=> 'Fiorino ungherese (HUF)',
	'NZD'						=> 'Dollari neozelandesi (NZD)',
	'NOK'						=> 'Corona norvegese (NOK)',
	'PLN'						=> 'Złoty polacco (PLN)',
	'GBP'						=> 'Sterline (GBP)',
	'SGD'						=> 'Dollari di Singapore (SGD)',
	'SEK'						=> 'Corona svedese (SEK)',
	'CHF'						=> 'Franco svizzero (CHF)',
	'JPY'						=> 'Yen (JPY)',
	'USD'						=> 'Dollari statunitensi (USD)',
	'EUR'						=> 'Euro (EUR)',
	'MXN'						=> 'Peso messicano (MXN)',
	'ILS'						=> 'Israeli New Shekels (ILS)',

	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Impostazioni PayPal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'		=> 'Qui è possibile personalizzare il blocco PayPal.',
	'PORTAL_PAY_ACC'						=> 'Profilo PayPal da utilizzare',
	'PORTAL_PAY_ACC_EXP'					=> 'Inserire l\'indirizzo e-mail del proprio profilo PayPal (per esempio xxx@xxx.com)',
	'PORTAL_PAY_CUSTOM'				=> 'Allega il nome utente alla donazione PayPal',
));
