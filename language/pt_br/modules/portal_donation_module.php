<?php
/**
*
* @package Board3 Portal v2.1 - Donation
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Brazilian Portuguese  translation by null2 (c) 2015 [ver 2.1.0] (https://github.com/phpBBTraducoes)  
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
	'DONATION' 		=> 'Doações via PayPal',
	'DONATION_TEXT'	=> 'é uma comunidade sem fins lucrativos, sem a intenção de qualquer ganho monetário. Doações são bem-vindas e a finalidade é o pagamento da hospedagem, domínio, etc. Assim, obrigado por manternos online.',
	'PAY_MSG'       => 'Por favor, use um ponto decimal (não use vírgula) como separador, por exemplo: 20.50',
	'PAY_ITEM'		=> 'Support', // paypal item

	'AUD'						=> 'Dólar Australiano (AUD)',
	'CAD'						=> 'Dólar Canadense (CAD)',
	'CZK'						=> 'Coroa Tcheca (CZK)',
	'DKK'						=> 'Coroa Dinamarquesa (DKK)',
	'HKD'						=> 'Dólar de Hong Kong (HKD)',
	'HUF'						=> 'Forim Húngaro (HUF)',
	'NZD'						=> 'Dólar da Nova Zelândia (NZD)',
	'NOK'						=> 'Coroa Norueguesa (NOK)',
	'PLN'						=> 'Zloti Polonês (PLN)',
	'GBP'						=> 'Pound Britânico (GBP)',
	'SGD'						=> 'Dólar de Singapura (SGD)',
	'SEK'						=> 'Coroa Sueca (SEK)',
	'CHF'						=> 'Franco Suíço (CHF)',
	'JPY'						=> 'Iene Japones (JPY)',
	'USD'						=> 'Dólar Estado-Unidense (USD)',
	'EUR'						=> 'Euro (EUR)',
	'MXN'						=> 'Peso Mexicano (MXN)',
	'ILS'						=> 'Novo Shekel de Israel (ILS)',

	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'	=> 'Configuração Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'=> 'Personalize o bloco do Paypal.',
	'PORTAL_PAY_ACC'				=> 'Conta Paypal a utilizar',
	'PORTAL_PAY_ACC_EXP'			=> 'Digite o endereço de email usado no Paypal',
	'PORTAL_PAY_CUSTOM'				=> 'Anexar o nome do usuário na doação via Paypal',
	'PORTAL_PAY_DEFAULT'			=> 'Moeda padrão',
	'PORTAL_PAY_DEFAULT_EXP'		=> 'Escolha a moeda que será a padrão.'
));
