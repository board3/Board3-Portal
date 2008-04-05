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
	'LOG_CONFIG_GENERAL'				=> '<strong>Portal: Değiştirilmiş genel ayarlar</strong>',
	'LOG_CONFIG_NEWS'					=> '<strong>Portal: Değiştirilmiş haber ayarları</strong>',
	'LOG_CONFIG_ANNOUNCEMENTS'	=> '<strong>Portal: Değiştirilmiş duyuru ayarları</strong>',
	'LOG_CONFIG_WELCOME'				=> '<strong>Portal: Değiştirilmiş hoşgeldiniz ayarları</strong>',
	'LOG_CONFIG_RECENT'				=> '<strong>Portal: Değiştirilmiş en son başlıklar ayarı</strong>',
	'LOG_CONFIG_WORDGRAPH'			=> '<strong>Portal: Değiştirilmiş kelimem bulutu (wordgraph) ayarları</strong>',
	'LOG_CONFIG_PAYPAL'				=> '<strong>Portal: Değiştirilmiş Paypal bağış ayarı</strong>',
	'LOG_CONFIG_ATTACHMENTS'		=> '<strong>Portal: Değiştirilmiş eklenti ayarları</strong>',
	'LOG_CONFIG_MEMBERS'				=> '<strong>Portal: Değiştirilmiş en son üye olanlar ayarları</strong>',
	'LOG_CONFIG_POLLS'					=> '<strong>Portal: Değiştirilmiş anket ayarı</strong>',
	'LOG_CONFIG_BOTS'					=> '<strong>Portal: Değiştirilmiş bots ayarları</strong>',
	'LOG_CONFIG_POSTER'				=> '<strong>Portal:Değiştirilmiş en çok mesaj gönderenler ayarı</strong>',
	'LOG_CONFIG_MINICALENDAR'		=> '<strong>Portal: Değiştirilmiş takvim ayarları</strong>',

));

?>