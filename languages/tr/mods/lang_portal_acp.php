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
	'ACP_PORTAL_INFO_SETTINGS'			=> 'Genel ayarlar',
	'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'	=> 'Board3 Portalı seçtiğiniz için teşekkürler. Bu sayfada forumunuzun portalını yönetebileceksiniz. Bu sayfadaki pencereler, portal ayarlarınızın özet bilgilerini verecektir. Ekranın solundaki bağlantılar ile portalınızın bütün özelliklerine ulaşabilirsiniz.',

	'ACP_PORTAL_SETTINGS'				=> 'Portal ayarları',
	'ACP_PORTAL_SETTINGS_EXPLAIN'		=> 'Board3 Portalı seçtiğiniz için teşekkürler. Bu sayfada forumunuzun portalını yönetebileceksiniz. Bu sayfadaki pencereler, portal ayarlarınızın özet bilgilerini verecektir. Ekranın solundaki bağlantılar ile portalınızın bütün özelliklerine ulaşabilirsiniz.',

	// general
	'ACP_PORTAL_GENERAL_INFO'				=> 'Portal yönetimi',
	'ACP_PORTAL_GENERAL_INFO_EXPLAIN'		=> 'Board3 Portalı seçtiğiniz için teşekkürler. Bu sayfada forumunuzun portalını yönetebileceksiniz. Bu sayfadaki pencereler, portal ayarlarınızın özet bilgilerini verecektir. Ekranın solundaki bağlantılar ile portalınızın bütün özelliklerine ulaşabilirsiniz.',
	'ACP_PORTAL_GENERAL_SETTINGS'			=> 'Genel ayarlar',
	'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'	=> 'Buradan, genel ve bazı özel seçenekleri değiştirebilirsiniz.',
	'ACP_PORTAL_VERSION'					=> '<strong>Board3 Portal Versiyon v%s</strong>',
	'PORTAL_ADVANCED_STAT'					=> 'Ayrıntılı İstatistik Bloğu',
	'PORTAL_ADVANCED_STAT_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',
	'PORTAL_LEADERS'						=> 'Lider Takım bloğu',
	'PORTAL_LEADERS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_CLOCK'							=> 'Saat bloğu',
	'PORTAL_CLOCK_EXPLAIN'					=> 'Bu bloğu portalda gösterir.',
	'PORTAL_LINK_US'						=> 'Bize link verin bloğu',
	'PORTAL_LINK_US_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_BIRTHDAYS'						=> 'Doğumgünü bloğu',
	'PORTAL_BIRTHDAYS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_BIRTHDAYS_AHEAD'				=> 'Yakındaki doğumgünleri bloğu',
	'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'		=> 'Doğumgünleri için kaç gün ileri bakılacak',
	'PORTAL_SEARCH'							=> 'Arama bloğu',
	'PORTAL_SEARCH_EXPLAIN'					=> 'Bu bloğu portalda gösterir.',
	'PORTAL_WELCOME'						=> 'Hoşgeldiniz bloğu',
	'PORTAL_WELCOME_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_WHOIS_ONLINE'							=> 'Hatta kim var ?',
	'PORTAL_WHOIS_ONLINE_EXPLAIN'					=> 'Bu bloğu portalda gösterir.',
	'PORTAL_CHANGE_STYLE'							=> 'Stil değiştir',
	'PORTAL_CHANGE_STYLE_EXPLAIN'					=> 'Bu bloğu portalda göster.<br /><span style="color:red">Dikkat :</span> forum genel ayarlarında "kullanıcı stil seçimi yapamaz" seçeneği etkin kıllınmış ise bu blok bundan bağımsız şekilde ayarlanamaz.',
	'PORTAL_FRIENDS'						=> 'Arkadaşlar bloğu',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Gösterilebilecek hatta olan arkadaş sayısı limiti',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Gösterilecek kayıtlı arkadaş sayısını seçtiğiniz azami sayı kadar sınırlar.',
	'PORTAL_MAIN_MENU'						=> 'Ana menü',
	'PORTAL_MAIN_MENU_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_USER_MENU'						=> 'Kullanıcı menüsü / Giriş yap kutusu',
	'PORTAL_USER_MENU_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_FORUM_INDEX'					=> 'Forum İndex (Forum listesi)',
	'PORTAL_FORUM_INDEX_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',

	// random member
	'PORTAL_RANDOM_MEMBER'					=> 'Rastgele üye bloğu',
	'PORTAL_RANDOM_MEMBER_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',

	// announcements
	'ACP_PORTAL_ANNOUNCE_INFO'					=> 'Genel Duyurular',
	'ACP_PORTAL_ANNOUNCE_SETTINGS'				=> 'Genel duyurular ayarları',
	'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'		=> 'Burada genel duyuruları bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_ANNOUNCEMENTS'						=> 'Genel duyuruları göster',
	'PORTAL_ANNOUNCEMENTS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_ANNOUNCEMENTS_STYLE'				=> 'Genel duyuruları bloğunu küçült',
	'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'		=> 'Evet(yes) seçilirse Genel Duyurular bloğu ufak görünecektir, hayır (no) seçilirse büyük görünecektir.',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS'			=> 'Portaldaki duyuru sayısı',
	'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'	=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_ANNOUNCEMENTS_DAY'					=> 'Duyurunun yayında kalacağı gün sayısı',
	'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'			=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_ANNOUNCEMENTS_LENGTH'				=> 'Genel duyuruların azami uzunluğu',
	'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'		=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'			=> 'Genel global announcements forum ID',
	'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'	=> 'Başlıkları alacağımız Forumu buraya yazabilirsiniz. Bütün forumları seçili hale getirmek için boş bırakın. Birkaç değişik forum yazmak için forum isimlerinin arasına virgül koyun, örnek : 1,2,5',
	'PORTAL_ANNOUNCEMENTS_PERMISSIONS'			=> 'İzinleri Aç/Kapa',
    'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXPLAIN'	=> 'Duyuruları gösterirken Ana Forumda kullanılan izin şablonlarını dikkate alır',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE'				=> 'Duyuru arşivleme sistemini aç',
	'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXPLAIN'		=> 'Arşivlemeye izin verilirse, sayfa numaraları gösterilecektir.',

	// news
	'ACP_PORTAL_NEWS_INFO'				=> 'Haberler',
	'ACP_PORTAL_NEWS_SETTINGS'			=> 'Haber ayarları',
	'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'	=> 'Burada haber bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_NEWS'						=> 'Haber bloğunu göster',
	'PORTAL_NEWS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_NEWS_STYLE'					=> 'Haber bloğunu küçült',
	'PORTAL_NEWS_STYLE_EXPLAIN'			=> 'Evet(yes) seçilirse Haber bloğu ufak görünecektir, hayır (no) seçilirse büyük görünecektir.',
	'PORTAL_SHOW_ALL_NEWS'				=> 'Bu forumdaki bütün başlıkları göster',
	'PORTAL_SHOW_ALL_NEWS_EXPLAIN'		=> 'Sabit (sticky) ve duyurular dahil.',
	'PORTAL_NUMBER_OF_NEWS'				=> 'Portaldaki haber başlığı sayısı',
	'PORTAL_NUMBER_OF_NEWS_EXPLAIN'		=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_NEWS_LENGTH'				=> 'Haber başlığının azami uzunluğu',
	'PORTAL_NEWS_LENGTH_EXPLAIN'		=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_NEWS_FORUM'					=> 'Haber forumu ID',
	'PORTAL_NEWS_FORUM_EXPLAIN'			=> 'Başlıkları alacağımız Forumu buraya yazabilirsiniz. Bütün forumları seçili hale getirmek için boş bırakın. Birkaç değişik forum yazmak için forum isimlerinin arasına virgül koyun, örnek : 1,2,5',
	'PORTAL_EXCLUDE_FORUM'				=> 'Exclude Forum ID',
	'PORTAL_EXCLUDE_FORUM_EXPLAIN'		=> 'Başlıkları alacağımız Forumu buraya yazabilirsiniz. Bütün forumları seçili hale getirmek için boş bırakın. Birkaç değişik forum yazmak için forum isimlerinin arasına virgül koyun, örnek : 1,2,5',
	'PORTAL_NEWS_PERMISSIONS'			=> 'İzinleri Aç/Kapa',
    'PORTAL_NEWS_PERMISSIONS_EXPLAIN'	=> 'Haberleri gösterirken Ana Forumda kullanılan izin şablonlarını dikkate alır',
	'PORTAL_NEWS_SHOW_LAST'				=> 'En yeni mesajı göster',
	'PORTAL_NEWS_SHOW_LAST_EXPLAIN'		=> 'Bu aktive edilirse, En yeni mesaj yazı halinde gösterilecektir. Bu seçenek kapatılırsa, ilgili başlığın ilk mesajı gösterilecek <br /> Küçük haber bloğunda gösterilen link en yeni mesaja yönlendirilecektir.',
	'PORTAL_NEWS_ARCHIVE'				=> 'Haber arşivleme sistemini aç',
	'PORTAL_NEWS_ARCHIVE_EXPLAIN'		=> 'Arşivlemeye izin verilirse, sayfa numaraları gösterilecektir.',

	// recent topics
	'ACP_PORTAL_RECENT_INFO'				=> 'En Yeni Başlıklar',
	'ACP_PORTAL_RECENT_SETTINGS'			=> 'En Yeni Başlıklar ayarı',
	'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'	=> 'Burada En Yeni Başlıklar bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_RECENT'							=> 'En Yeni Başlıklar bloğunu göster',
	'PORTAL_RECENT_EXPLAIN'					=> 'Bu bloğu portalda gösterir.',
	'PORTAL_MAX_TOPIC'						=> 'En son duyurular/En çok okunan başlıklar limiti',
	'PORTAL_MAX_TOPIC_EXPLAIN'				=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_RECENT_TITLE_LIMIT'				=> 'En yeni başlıklar için harf sayısı limiti',
	'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'		=> '0 (sıfır) sınırsız anlamına gelir',

	// paypal
	'ACP_PORTAL_PAYPAL_INFO'				=> 'Paypal',
	'ACP_PORTAL_PAYPAL_SETTINGS'			=> 'Paypal ayarları',
	'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'	=> 'Burada Paypal bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_PAY_C_BLOCK'					=> 'Paypal bloğunu göster',
	'PORTAL_PAY_C_BLOCK_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',
	'PORTAL_PAY_S_BLOCK'					=> 'Küçük Paypal bloğunu göster',
	'PORTAL_PAY_S_BLOCK_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',
	'PORTAL_PAY_ACC'						=> 'Kullanılacak Paypal hesabı',
	'PORTAL_PAY_ACC_EXPLAIN'				=> 'Paypal da kullandığınız e-mail adresini giriniz, örnek: abc@xyz.com',

	// last member
	'ACP_PORTAL_MEMBERS_INFO'				=> 'En yeni üyeler',
	'ACP_PORTAL_MEMBERS_SETTINGS'			=> 'En yeni üyeler ayarları',
	'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'	=> 'Burada En Son Üyeler bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_LATEST_MEMBERS'					=> 'En Yeni Üyeler bloğunu göster',
	'PORTAL_LATEST_MEMBERS_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',
	'PORTAL_MAX_LAST_MEMBER'				=> 'Gösterilecek En Yeni Üyeler sayısı',
	'PORTAL_MAX_LAST_MEMBER_EXPLAIN'		=> '0 (sıfır) sınırsız anlamına gelir',

	// bots
	'ACP_PORTAL_BOTS_INFO'						=> 'Ziyaret eden Botlar',
	'ACP_PORTAL_BOTS_SETTINGS'					=> 'Ziyaret eden Bot ayarları',
	'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'			=> 'Burada Ziyaret Eden Bot bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_LOAD_LAST_VISITED_BOTS'				=> 'Ziyaret eden Bot bloğunu göster',
	'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'		=> 'Bu bloğu portalda gösterir.',
	'PORTAL_LAST_VISITED_BOTS_NUMBER'			=> 'Gösterilecek Bot sayısı',
	'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'	=> '0 (sıfır) sınırsız anlamına gelir',

	// polls   
	'ACP_PORTAL_POLLS_INFO'				=> 'Anket',
	'ACP_PORTAL_POLLS_SETTINGS'			=> 'Anket ayarları',
	'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'	=> 'Burada Anket bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_POLL_TOPIC'					=> 'Anket bloğunu göster',
	'PORTAL_POLL_TOPIC_EXPLAIN'			=> 'Bu bloğu portalda gösterir.',
	'PORTAL_POLL_TOPIC_ID'				=> 'Anket forum başlıkları',
	'PORTAL_POLL_TOPIC_ID_EXPLAIN'		=> 'Anketlerin gösterileceği forumların başlıkları.Bütün forumları seçili hale getirmek için boş bırakın. Birkaç değişik forum yazmak için forum isimlerinin arasına virgül koyun, örnek : 1,2,5',
	'PORTAL_POLL_LIMIT'					=> 'Gösterilecek Anket sayısı',
	'PORTAL_POLL_LIMIT_EXPLAIN'			=> 'Portal sayfasında gösterilmesini istediğiniz anket sayısıdır.',
	'PORTAL_POLL_ALLOW_VOTE'			=> 'Oylamaya izin ver',
	'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'	=> 'Gerekli izinlere sahip kullanıcıların Portal sayfasından oy vermesini sağlar.',

	// most poster
	'ACP_PORTAL_MOST_POSTER_INFO'				=> 'En çok Mesaj Gönderenler',
	'ACP_PORTAL_MOST_POSTER_SETTINGS'			=> 'En çok mesaj gönderen ayarları',
	'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'	=> 'Burada En çok Mesaj Gönderenler bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_TOP_POSTERS'                  		=> 'En çok/En fazla mesaj gönderen bloğunu göster',
	'PORTAL_TOP_POSTERS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_MAX_MOST_POSTER'					=> 'Gösterilecek en çok mesaj gönderen sayısı',
	'PORTAL_MAX_MOST_POSTER_EXPLAIN'			=> '0 (sıfır) sınırsız anlamına gelir',

	// left and right column width 
	'ACP_PORTAL_column_WIDTH_INFO'				=> 'Kolon genişliği',
	'ACP_PORTAL_column_WIDTH_SETTINGS'			=> 'Sol ve sağ kolon genişliği ayarları',
	'PORTAL_LEFT_column_WIDTH'					=> 'Sol kolonun genişlik değeri',
	'PORTAL_LEFT_column_WIDTH_EXPLAIN'			=> 'Sol kolonun genişliğini değiştir X pixel olarak değiştir, tavsiye edilen genişlik 180 pixeldir',
	'PORTAL_RIGHT_column_WIDTH'				=> 'Sağ kolonun genişlik değeri',
	'PORTAL_RIGHT_column_WIDTH_EXPLAIN'		=> 'Sağ kolonun genişliğini değiştir X pixel olarak değiştir, tavsiye edilen genişlik 180 pixeldir',

	// attachments    
	'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'				=> 'Ekler',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'			=> 'Ek ayarları',
	'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'	=> 'Burada Mesaj Ekleri bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz',
	'PORTAL_ATTACHMENTS'								=> 'Ekler bloğunu göster',
	'PORTAL_ATTACHMENTS_EXPLAIN'						=> 'Bu bloğu portalda gösterir.',
	'PORTAL_ATTACHMENTS_NUMBER'							=> 'Gösterilecek Ek sayısı',
	'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'					=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_ATTACHMENTS_FORUM_IDS'						=> 'Eklenti Forum Numarası(s)',
    'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'				=> 'Eklentileri alacağımız Forumu buraya yazabilirsiniz. Bütün forumları seçili hale getirmek için boş bırakın. Birkaç değişik forum yazmak için forum isimlerinin arasına virgül koyun, örnek : 1,2,5',
	
	// friends
	'ACP_PORTAL_FRIENDS_INFO'				=> 'Arkadaşlar',
	'ACP_PORTAL_FRIENDS_SETTINGS'			=> 'Arkadaş ayarları',
	'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'	=> 'Burada Arkadaş bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_FRIENDS'						=> 'Arkadaşlar bloğunu göster',
	'PORTAL_FRIENDS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_MAX_ONLINE_FRIENDS'				=> 'Gösterilecek Arkadaş sayısı',
	'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'		=> 'Gösterilecek arkadaş sayısını buraya girilen rakam ile sınırlar.',

	// wordgraph
	'ACP_PORTAL_WORDGRAPH_INFO'				=> 'Kelime Bulutu',
	'ACP_PORTAL_WORDGRAPH_SETTINGS'			=> 'Kelime bulutu ayarları',
	'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'	=> 'Burada Kelime Bulutu bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz',
	'PORTAL_WORDGRAPH'						=> 'Kelime bulutu bloğunu göster',
	'PORTAL_WORDGRAPH_EXPLAIN'				=> 'Bu bloğu portalda gösterir.<br /><strong>Arama zemini olarak fulltext mysql seçilmiş ise kelime bulutu çalışmaz.</strong>',
	'PORTAL_WORDGRAPH_MAX_WORDS'			=> 'Gösterilecek kelime sayısı',
	'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'	=> '0 (sıfır) sınırsız anlamına gelir',
	'PORTAL_WORDGRAPH_WORD_COUNTS'			=> 'Kelime sayacını da göster',
	'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'	=> 'Kelimenin yanında giriş sayısı da gösterilir, örnek : (25).',
	'PORTAL_WORDGRAPH_RATIO'				=> 'Kelime boyutu oranı',
	'PORTAL_WORDGRAPH_RATIO_EXPLAIN'		=> 'Kelime boyutu oranını değiştirir (küçük/büyük), öndeğer=18',

	// welcome message
	'ACP_PORTAL_WELCOME_INFO'				=> 'Hoşgeldiniz',
	'ACP_PORTAL_WELCOME_SETTINGS'			=> 'Hoşgeldiniz ayarları',
	'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'	=> 'Burada Hoşgeldin bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_WELCOME_INTRO'					=> 'Hoşgeldin mesajı',
	'PORTAL_WELCOME_GUEST'					=> 'Hoşgeldiniz mesajını sadece ziyaretciler mi görsün ?',
	'PORTAL_WELCOME_INTRO_EXPLAIN'         => 'Hoşgeldin mesajını değiştirin (BBCode kullanabilirsiniz).',
	
	    // custom
	'ACP_PORTAL_CUSTOM_INFO'					=> 'Serbest Blok',
	'ACP_PORTAL_CUSTOM_SETTINGS'				=> 'Serbest blok ayarları',
	'ACP_PORTAL_CUSTOM_SETTINGS_EXPLAIN'		=> 'Serbest Blok ayarlarınızı buradan değiştirebilirsiniz. Bu bloğa, HTML, BBCode yerleştirebilirsiniz. Reklam, video, resimi flash veya yazı için kullanabilirsiniz. Gerekli kodu yerleştirmeniz yeterlidir.',
	'ACP_PORTAL_CUSTOM_SMALL_SETTINGS'			=> 'Serbest blok için küçültülmüş blok ayarları',
	'PORTAL_CUSTOM_SMALL_HEADLINE'				=> 'Küçük serbest blok için başlık',
	'PORTAL_CUSTOM_SMALL_HEADLINE_EXPLAIN'		=> 'Küçük serbest blok başlığını buradan değiştirebilirsiniz.',
	'PORTAL_CUSTOM_SMALL'						=> 'Küçük serbest bloğu göster',
	'PORTAL_CUSTOM_SMALL_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_CUSTOM_SMALL_BBCODE'				=> 'Küçük serbest blok için BBCode_lara izin ver',
	'PORTAL_CUSTOM_SMALL_BBCODE_EXPLAIN'		=> 'Bu kutuda BBCode kullanılabilir. BBCode aktif değilse yerine HTML kullanılacaktır.',
	'PORTAL_CUSTOM_CODE_SMALL'					=> 'Küçük serbest blok için kod',
	'PORTAL_CUSTOM_CODE_SMALL_EXPLAIN'			=> 'Küçük serbest blok kodlarını (HTML veya BBCode) buradan değiştirebilirsiniz.',
	'ACP_PORTAL_CUSTOM_CENTER_SETTINGS'			=> 'Orta bölge için Serbest Blok ayarları',
	'PORTAL_CUSTOM_CENTER'						=> 'Orta Bölge Serbest Bloğunu göster',
	'PORTAL_CUSTOM_CENTER_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_CUSTOM_CENTER_HEADLINE'				=> 'Orta  Bölge Serbest Blok için başlık',
	'PORTAL_CUSTOM_CENTER_HEADLINE_EXPLAIN'		=> 'Orta Bölge Serbest Blok başlığını buradan değiştirebilirsiniz.',
	'PORTAL_CUSTOM_CENTER_BBCODE'				=> 'Orta Bölge Serbest Blok için BBCode_lara izin ver',
	'PORTAL_CUSTOM_CENTER_BBCODE_EXPLAIN'		=> 'Bu kutuda BBCode kullanılabilir. BBCode aktif değilse yerine HTML kullanılacaktır.',
	'PORTAL_CUSTOM_CODE_CENTER'					=> 'Orta Bölge Serbest Blok için kod',
	'PORTAL_CUSTOM_CODE_CENTER_EXPLAIN'			=> 'Orta Bölge Serbest Blok kodlarını (HTML veya BBCode) buradan değiştirebilirsiniz.',
	
    // links
	'ACP_PORTAL_LINKS_INFO'				=> 'Bağlantılar',
	'ACP_PORTAL_LINKS_SETTINGS'			=> 'Bağlantı ayarları',
	'ACP_PORTAL_LINKS_SETTINGS_EXPLAIN'	=> 'Bağlantı bloğundaki bağlantıları ayarlar.',
	'PORTAL_LINKS'						=> 'Bağlatılar bloğu',
	'PORTAL_LINKS_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_LINK_TEXT'					=> 'Yazı/URL',
	'PORTAL_LINK_TEXT_EXPLAIN'			=> 'Yazıdan sonra bağlantı için gereki URL gelecek. Bağlantılarının sırasını değiştirmek için düğmleri kullanın. <strong>http://</strong> koymayı unutmayın !',
	'PORTAL_ADD_LINK_TEXT'				=> 'Bağlantı ekle',
	'PORTAL_ADD_LINK_TEXT_EXPLAIN'		=> 'Yeni bağlantı oluşturmak için yazıya tıkla.',
	'PORTAL_LINK_ADD'					=> '<strong>Ekle</strong>',


	// minicalendar
	'ACP_PORTAL_MINICALENDAR_INFO'				=> 'Küçük Takvim',
	'ACP_PORTAL_MINICALENDAR_SETTINGS'			=> 'Küçük takvim ayarları',
	'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'	=> 'Burada Küçük Takvim bilgilerinizi ve bazı özel seçenekleri değiştirebilirsiniz.',
	'PORTAL_MINICALENDAR'						=> 'Küçük Takvim bloğunu göster',
	'PORTAL_MINICALENDAR_EXPLAIN'				=> 'Bu bloğu portalda gösterir.',
	'PORTAL_MINICALENDAR_TODAY_COLOR'			=> 'Bugünün rengi',
	'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'	=> 'HEX (örnek, beyaz için :  #FFFFFF) veya rengin ingilizce ismini (örnek : violet) kullanabilirsiniz.',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR'		=> 'Day link color',
	'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'=> 'HEX (örnek, beyaz için :  #FFFFFF) veya rengin ingilizce ismini (örnek : violet) kullanabilirsiniz.',


));

?>