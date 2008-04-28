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
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	// General
	'PORTAL'				=> 'Portal',
	'WELCOME'				=> 'Hoş Geldiniz',

	'PORTAL_ERROR'			=> 'Portal Hatası',
	'PORTAL_DELETE_DIR'		=> 'Lütfen Portal yükleme (/install) dosyasını silin  %s',
	'PORTAL_UPDATE'			=> 'Portal Güncelleme',
	'PORTAL_UPDATE_TEXT'	=> 'Portal için bekleyen bir güncelleme var! Yükle (Install) <a href="%1$s">%2$s</a>!',

	// news & global announcements
	'LATEST_ANNOUNCEMENTS'	=> 'En Son Genel Duyurular',
	'GLOBAL_ANNOUNCEMENT'	=> 'Genel Duyurular',
	'VIEW_LATEST_ANNOUNCEMENT'   => '1 duyuru',
	'VIEW_LATEST_ANNOUNCEMENTS'   => '%d duyuru',
	'LATEST_NEWS'			=> 'En Son Haberler',
	'READ_FULL'				=> 'Hepsini Oku',
	'NO_NEWS'				=> 'Haber Yok',
	'NO_ANNOUNCEMENTS'		=> 'Genel Duyuru Yok',
	'POSTED_BY'				=> 'Mesaj Gönderenler',
	'COMMENTS'				=> 'Yorumlar',
	'VIEW_COMMENTS'			=> 'Yorumları Oku',
	'POST_REPLY'			=> 'Yorum Yaz',
	'TOPIC_VIEWS'			=> 'Görüşler',
	'JUMP_NEWEST'			=> 'En Yeni Mesaja Git',
	'JUMP_FIRST'			=> 'Birinci Mesaja Git',
	'JUMP_TO_POST'			=> 'Mesaja Git',
	'BACK'							=> 'Geri',

	// who is online
	'WIO_TOTAL'			=> 'Toplam',
	'WIO_REGISTERED'	=> 'Kayıtlı',
	'WIO_HIDDEN'		=> 'Gizli',
	'WIO_GUEST'			=> 'Misafir',
	//'RECORD_ONLINE_USERS'=> '<strong>%1$s</strong><br />%2$s numaralı kayıdı gör',
	'VIEWING_PORTAL'         => 'Portal sayfası',

	// Birthday
	'BIRTHDAYS_AHEAD'              => 'Takip eden %s günde',
	'NO_BIRTHDAYS_AHEAD'        => 'Bu zaman diliminde doğumgünü olan üye yok.',

	// user menu
	'USER_MENU'			=> 'Kullanıcı menüsü',
	'UM_LOG_ME_IN'		=> 'Beni hatırla',
	'UM_HIDE_ME'		=> 'Beni gizle',
	'UM_MAIN_SUBSCRIBED'=> 'Abone olundu',
	'UM_BOOKMARKS'		=> 'Bookmarks',

	// statistics
	/*
	'ST_NEW'		=> 'Yeni',
	'ST_NEW_POSTS'	=> 'Yeni mesaj',
	'ST_NEW_TOPICS'	=> 'Yeni başlık',
	'ST_NEW_ANNS'	=> 'Yeni duyuru',
	'ST_NEW_STICKYS'=> 'Yeni sabit duyuru',
	*/
	'ST_TOP'		=> 'Toplam',
	'ST_TOP_ANNS'	=> 'Toplam duyuru',
	'ST_TOP_STICKYS'=> 'Toplam sabit duyuru',
	'ST_TOT_ATTACH'	=> 'Toplam ekler',

	// search
	'SH'		=> 'git',
	'SH_SITE'	=> 'forumlar',
	'SH_POSTS'	=> 'mesajlar',
	'SH_AUTHOR'	=> 'yazar',
	'SH_ENGINE'	=> 'arama motorları',
	'SH_ADV'	=> 'ayrıntılı arama',
	
	// recent
	'RECENT_NEWS'		=> 'En son',
	'RECENT_TOPIC'		=> 'En son başlık',
	'RECENT_ANN'		=> 'En son duyuru',
	'RECENT_HOT_TOPIC'	=> 'En son popüler başlık',

	// random member
	'RND_MEMBER'	=> 'Rastgele üye',
	'RND_JOIN'		=> 'Katıl',
	'RND_POSTS'		=> 'Mesajlar',
	'RND_OCC'		=> 'Meslek',
	'RND_FROM'		=> 'Konum',
	'RND_WWW'		=> 'Web sayfası',

	// top poster
	'TOP_POSTER'	=> 'En çok mesaj gönderenler',
	
	// attachments
	'DOWNLOADS'			=> 'Downloads',
	'NO_ATTACHMENTS'	=> 'Ek yok',

	// links
	'LINKS'	=> 'Linkler',
	'NO_LINKS' => 'Bağlantı yok',

	// latest members
	'LATEST_MEMBERS'	=> 'En yeni üyeler',

	// make donation
	'DONATION' 		=> 'Bağış yap',
	'DONATION_TEXT'	=> 'Sadece bilgi vermeyi amaçlayan , kâr amacı gütmeyen forumumuzun masraflarına katkıda bulunmak isteyenler buradan bağış yapabilirler.',
	'PAY_MSG'		=> 'Bağış yapmak istediğiniz miktarı seçtikten sonra Paypal logosuna tıklayarak devam ediniz.',
	'PAY_ITEM'		=> 'Bağış yap', // paypal item

	// main menu
	'M_MENU' 	=> 'Menü',
	'M_CONTENT'	=> 'İçerik',
	'M_ACP'		=> 'ACP',
	'M_HELP'	=> 'Yardım',
	'M_BBCODE'	=> 'BBCode SSS',
	'M_TERMS'	=> 'Kullanım şartları',
	'M_PRV'		=> 'Gizlilik politikası',
	'M_SEARCH'	=> 'Ara',

	// link us
	'LINK_US'		=> 'Bize link verin',
	'LINK_US_TXT'	=> '<strong>%s</strong> . Aşağıdaki HTML i kullanabilirsiniz. :',

	// friends
	'FRIENDS'				=> 'Arkadaşlar',
	'FRIENDS_OFFLINE'		=> 'Hatta değil',
	'FRIENDS_ONLINE'		=> 'Bağlı',
	'NO_FRIENDS'			=> 'Herhangi bir arkadaş belirtilmemiş',
	'NO_FRIENDS_OFFLINE'	=> 'Hatta olmayan arkadaş yok',
	'NO_FRIENDS_ONLINE'		=> 'Bağlı olan arkadaş yok',
	
	// last bots
	'LAST_VISITED_BOTS'		=> 'En son bağlanan botlar %s ',
	
	// wordgraph
	'WORDGRAPH'				=> 'Kelime bulutu',

	// change style
	'BOARD_STYLE'			=> 'Forum stili',
	'STYLE_CHOOSE'			=> 'Bir stil seç',
		
	// team
	'NO_ADMINISTRATORS_P'	=> 'Yönetici yok',
	'NO_MODERATORS_P'		=> 'Moderatör yok',

	// average Statistics
	'TOPICS_PER_DAY_OTHER'	=> 'Günlük ortalama başlık: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Günlük ortalama başlık: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Günlük ortalama mesaj: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Günlük ortalama mesaj: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Günlük ortalama kullanıcı: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Günlük ortalama kullanıcı: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Kullanıcı başına başlık sayısı: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Kullanıcı başına başlık sayısı: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Kullanıcı başına mesaj sayısı: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Kullanıcı başına mesaj sayısı: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Başlık başına ortalama mesaj sayısı: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Başlık başına ortalama mesaj sayısı: <strong>0</strong>',

	// Poll
	'POLL'					=> 'Anket',
	'LATEST_POLLS'			=> 'En son anket',
	'NO_OPTIONS'			=> 'Bu ankette seçenek yok.',
	'NO_POLL'				=> 'Anket yok',
	'RETURN_PORTAL'			=> '%sPortal a geri dön%s',

	// other
	'CLOCK'		=> 'Saat',
	'SPONSOR'	=> 'Sponsor',
	
	/**
	* DO NOT REMOVE or CHANGE
	*/
	'PORTAL_COPY'	=> '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
	)
);

// mini calendar
$lang = array_merge($lang, array(
	'Mini_Cal_calendar'		=> 'Takvim',
	'Mini_Cal_add_event'	=> 'Etkinlik Ekle',
	'Mini_Cal_events'		=> 'Yaklaşan Etkinlikler',
	'Mini_Cal_no_events'	=> 'Hiçbiri',
	'Mini_cal_this_event'	=> 'Bu ayın tatilleri',
	'View_next_month'		=> 'sonraki ay',
	'View_previous_month'	=> 'önceki ay',

// uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
// see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
// currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
	'Mini_Cal_date_format'		=> '%b %e',
	'Mini_Cal_date_format_Time'	=> '%H:%i',

// if you change the first day of the week in constants.php, you should change values for the short day names accordingly
// e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Su'; ... $lang['mini_cal']['day'][7] = 'Sa'; 
//      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Mo'; ... $lang['mini_cal']['day'][7] = 'Su'; 
	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Pt',
			'2'	=> 'Sa',
			'3'	=> 'Ça',
			'4'	=> 'Pe',
			'5'	=> 'Cu',
			'6'	=> 'Ct',
			'7'	=> 'Pz',
		),

		'month'	=> array(
			'1'	=> 'Oca',
			'2'	=> 'Şub',
			'3'	=> 'Mar',
			'4'	=> 'Nis',
			'5'	=> 'May',
			'6'	=> 'Haz',
			'7'	=> 'Tem',
			'8'	=> 'Ağu',
			'9'	=> 'Eyl',
			'10'=> 'Eki',
			'11'=> 'Kas',
			'12'=> 'Ara',
		),

		'long_month'=> array(
			'1'	=> 'Ocak',
			'2'	=> 'Şubat',
			'3'	=> 'Mart',
			'4'	=> 'Nisan',
			'5'	=> 'Mayıs',
			'6'	=> 'Haziran',
			'7'	=> 'Temmuz',
			'8'	=> 'Ağustos',
			'9'	=> 'Eylül',
			'10'=> 'Ekim',
			'11'=> 'Kasım',
			'12'=> 'Aralık',
		),
	),
));

?>