<?php
/**
*
* @package Board3 Portal v2.1 - Donation
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @translated into French by Galixte (http://www.galixte.com)
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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'DONATION' 		=> 'Dons PayPal',
	'DONATION_TEXT'	=> 'est un groupe fournissant des services sans intention de faire du bénéfice. Vos dons sont les bienvenus, pour nous aider à couvrir les différents frais liés à notre serveur, notre nom de domaine, etc..',
	'PAY_MSG'       => 'Veuillez utiliser un point décimal (et non une virgule) comme séparateur, comme par exemple : 3.50',
	'PAY_ITEM'		=> 'Faire un don !', // paypal item

	'AUD'						=> 'Dollar australien (AUD)',
	'CAD'						=> 'Dollar canadien (CAD)',
	'CZK'						=> 'Couronne tchèque (CZK)',
	'DKK'						=> 'Couronne danoise (DKK)',
	'HKD'						=> 'Dollar de Hong Kong (HKD)',
	'HUF'						=> 'Forint hongrois (HUF)',
	'NZD'						=> 'Dollar néo-zélandais (NZD)',
	'NOK'						=> 'Couronne norvégienne (NOK)',
	'PLN'						=> 'Złoty polonais (PLN)',
	'GBP'						=> 'Livre sterling (GBP)',
	'SGD'						=> 'Dollar de Singapour (SGD)',
	'SEK'						=> 'Couronne suédoise (SEK)',
	'CHF'						=> 'Franc suisse (CHF)',
	'JPY'						=> 'Yen (JPY)',
	'USD'						=> 'Dollar américain (USD)',
	'EUR'						=> 'Euro (EUR)',
	'MXN'						=> 'Peso mexicain (MXN)',
	'ILS'						=> 'Shekel (ILS)',

	// ACP
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paramètres PayPal',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXP'		=> 'Ici vous personnalisez le bloc PayPal.',
	'PORTAL_PAY_ACC'						=> 'Compte PayPal à utiliser',
	'PORTAL_PAY_ACC_EXP'					=> 'Saisir l’email de votre compte PayPal, comme par exemple : prenom.nom@mail.fr.',
	'PORTAL_PAY_CUSTOM'						=> 'Ajouter le nom d’utilisateur pour le don PayPal',
	'PORTAL_PAY_DEFAULT'					=> 'Devise par défaut',
	'PORTAL_PAY_DEFAULT_EXP'				=> 'Devise sélectionnée par défaut dans la liste des devises.'
));
