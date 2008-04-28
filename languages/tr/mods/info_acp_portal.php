<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @translator (c) ( Kaan Uslu - http://www.uslu.net )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_PORTAL_INFO'							=> 'Portal',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Genel',
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Genel Duyurular',
	'ACP_PORTAL_NEWS_INFO'						=> 'Haberler',
	'ACP_PORTAL_RECENT_INFO'					=> 'En Yeni Başlıklar',
	'ACP_PORTAL_WORDGRAPH_INFO'					=> 'Kelime Bulutu',
	'ACP_PORTAL_GENERAL_INFO'					=> 'Genel Ayarlar',
	'ACP_PORTAL_PAYPAL_INFO'					=> 'Paypal Bağışı',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'		=> 'Ekler',
	'ACP_PORTAL_MEMBERS_INFO'					=> 'En Yeni Üyeler',
	'ACP_PORTAL_POLLS_INFO'						=> 'Anket',
	'ACP_PORTAL_BOTS_INFO'						=> 'En Son Bots',
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'En Çok Mesaj Gönderenler',
	'ACP_PORTAL_WELCOME_INFO'					=> 'Hoşgeldiniz Mesajı',
	'ACP_PORTAL_ADS_INFO'						=> 'Reklam',
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Mini Takvim',
	'ACP_PORTAL_LINKS_INFO'						=> 'Bağlantılar',
	'ACP_PORTAL_CUSTOM_INFO'					=> 'Serbest Blok',
));

?>