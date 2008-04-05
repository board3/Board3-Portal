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

	'INSTALLER_MENU'						=> 'PInUp Menu',
	'INSTALLER_MENU_START'				=> 'Start',
	'INSTALLER_UNINSTALL'					=> 'Programı Sil',
	'INSTALLER_UPDATE'						=> 'Güncelle',
	'INSTALLER_INSTALL'						=> 'Yükle',

	'INSTALLER_INTRO_TITLE'				=> 'Portal Yükleme/Güncelleme Programı',
	'INSTALLER_INTRO_NOTE'				=> 'PInUp olarak da bilinen Portal Yükleme/Güncelleme programına hoşgeldiniz',

	'INSTALLER_MENU_DONE'					=> 'En son versiyon',
	'INSTALLER_MENU_DONE_TEXT'			=> '%s versiyonu zaten yüklü, lütfen install_portal dosyasını silin ve  <a href="%s">forum</a> sayfanıza dönün.',

	'INSTALLER_INSTALL_TITLE'				=> 'PInUp Yükle',
	'INSTALLER_INSTALL_NOTE'				=> 'When you choose to install the MOD, any database of previous versions will be dropped.',
	'INSTALLER_INSTALL_MENU'				=> 'Yükleme menüsü',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'v%s MOD unun yüklemesi başarı ile tamamlanmıştır.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'v%s MOD u <strong>yüklenememiştir !</strong>.',
	'INSTALLER_INSTALL_VERSION'			=> 'v%s MOD unu Yükle',
	'INSTALLER_INSTALL_START'			=> 'Yükleme programını başlatmak için <a href="%s">buraya</a> tıklayın.',

	'INSTALLER_UPDATE_TITLE'				=> 'PInUp Güncelleme',
	'INSTALLER_UPDATE_NOTE'				=> ' v%s MOD undan v%s MOD una güncelle',

	'INSTALLER_UNINSTALL_TITLE'			=> 'PInUp Sil (uninstall)',
	'INSTALLER_UNINSTALL_NOTE'			=> 'Güncelleme menüsüne hoşgeldiniz',
	'INSTALLER_UNINSTALL_SUCCESSFUL'	=> 'v%s MOD unun silinmesi başarı ile tamamlanmıştır.',

	'INSTALLER_NEEDS_ADMIN'			=> 'Yönetici olarak giriş yapmanız gerekiyor.<br /><a href="../ucp.php?mode=login"><strong>buraya tıklayıp Giriş yapın</strong>',

	'INSTALLER_UPDATE'						=> 'Güncelleme',
	'INSTALLER_UPDATE_MENU'				=> 'Güncelleme Menüsü',
	'INSTALLER_UPDATE_NOTE'				=> 'v%s MOD undan v%s MOD una Güncelleme',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'v%s MOD undan v%s MOD una güncelleme başarı ile tamamlanmıştır.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'	=> 'v%s MOD undan v%s MOD una güncelleme <strong>başarılamamıştır</strong>.',
	'INSTALLER_UPDATE_VERSION'			=> 'v%s MOD undan güncelle',
	'INSTALLER_UPDATE_TO'					=> 'Buna güncelle',
	'INSTALLER_UPDATE_START'				=> 'Güncellemeyi bağlatmak için <a href="%s">buraya</a> tıklayın.',

	'INSTALLER_UNINSTALL_OLDVERSION'	=> 'Özür dileriz PlnUp orjinal phpBB3 Portal ının silinmesini desteklememektedir.',

	'INSTALLER_ERROR'						=> 'PInUp Hatası',

	'INSTALLER_USEFUL_INFO'				=> 'Lütfen /install_portal dosyasını silin.',

	'INSTALLER_UNINSTALL_USEFUL_INFO'	=> 'Portal dosyalarını ve diğer dosyalarda yapmış olduğunuz değişiklikleri silmeyi unutmayın.',

	'WARNING'									=> 'Dikkat',
));

?>