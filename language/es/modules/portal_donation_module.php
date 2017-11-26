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
	'DONATION' 		=> 'Donaciones PayPal',
	'DONATION_TEXT'	=> 'es una comunidad sin ánimo de lucro, sin la intención de cualquier ganancia monetaria. Sus donaciones son bienvenidas y su proposito es lograr pagar alojamiento, dominio, etc. y así gracias a ustedes mantenernos en línea.',
	'PAY_MSG'       => 'Por favor, use un punto decimal (no una coma) como separador, por ejemplo 3.50',
	'PAY_ITEM'		=> '¡Donar!', // paypal item

	'AUD'						=> 'Dólares australianos (AUD)',
	'CAD'						=> 'Dólares canadienses (CAD)',
	'CZK'						=> 'Coronas checas (CZK)',
	'DKK'						=> 'Coronas danesas (DKK)',
	'HKD'						=> 'Dólares de Hong Kong (HKD)',
	'HUF'						=> 'Forintios húngaros (HUF)',
	'NZD'						=> 'Dólares de Nueva Zelanda (NZD)',
	'NOK'						=> 'Coronas noruegas (NOK)',
	'PLN'						=> 'Zlotys de Polonia (PLN)',
	'GBP'						=> 'Libras esterlinas (GBP)',
	'SGD'						=> 'Dólares de singapur (SGD)',
	'SEK'						=> 'Coronas suecas (SEK)',
	'CHF'						=> 'Francos suizos (CHF)',
	'JPY'						=> 'Yenes de Japón (JPY)',
	'USD'						=> 'Dólares USA (USD)',
	'EUR'						=> 'Euros (EUR)',
	'MXN'						=> 'Pesos mexicanos (MXN)',
	'ILS'						=> 'Shekel de Israel (ILS)',

	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Configuración Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'	=> 'Aquí es donde puede personalizar el bloque de Paypal.',
	'PORTAL_PAY_ACC'						=> 'Cuenta Paypal a utilizar',
	'PORTAL_PAY_ACC_EXP'				=> 'Introduzca su dirección de correo electrónico paypal, ej. xxx@xxx.com',
	'PORTAL_PAY_CUSTOM'				=> 'Anexar nombre de usuario a la donación de Paypal',
	'PORTAL_PAY_DEFAULT'					=> 'Moneda por defecto',
	'PORTAL_PAY_DEFAULT_EXP'				=> 'La moneda que saldrá seleccionada por defecto en la lista desplegable.'
));
