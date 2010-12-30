<?php
/**
*
* @package - Board3portal
* @version $Id: outdated_files.php 544 2009-09-10 12:35:25Z christian_n $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @installer based on: phpBB Gallery by nickvergessen, www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (!defined('IN_INSTALL'))
{
	exit;
}

$oudated_files = array(
	'/install_portal.php',
	'language/de/mods/portal_install.php',
	'language/en/mods/portal_install.php',
	'language/de/mods/lang_portal_acp_logs.php',
	'language/en/mods/lang_portal_acp_logs.php',
	'language/de/acp/portal.php',
	'language/de/portal.php',
	'language/en/acp/portal.php',
	'language/en/portal.php',
	'portal/images/bullet.gif',
	'portal/images/clock.swf',
	'portal/images/dot.gif',
	'portal/images/icon_topic_attach.gif',
	'portal/images/index.html',
	'portal/images/link.png',
	'portal/images/member.gif',
	'portal/images/mini_cal_icon_left_arrow.png',
	'portal/images/mini_cal_icon_right_arrow.png',
	'portal/images/paypal.gif',
	'portal/images/board3clock.swf',
	'portal/includes/functions_poll.php',
	'portal/includes/lang_adm_additional_blocks.php',
	'portal/includes/mini_cal/calendarSuite.php',
	'portal/includes/mini_cal/index.html',
	'portal/includes/mini_cal/mini_cal_common.php',
	'portal/includes/mini_cal/mini_cal_config.php',
	'portal/includes/mini_cal/mini_cal_topic.php',
	'styles/prosilver/template/portal/block/_sample_block_design.html',
	'styles/prosilver/template/portal/block/active.html',
	'styles/prosilver/template/portal/block/ads_center.html',
	'styles/prosilver/template/portal/block/ads_small.html',
	'styles/prosilver/template/portal/block/donation/donation.html',
	'styles/prosilver/template/portal/block/donation/donation_small.html',
	'styles/prosilver/template/portal/block/donation/index.html',
	'styles/prosilver/template/portal/block/donation/paypal.html',
	'styles/prosilver/template/portal/block/main_menu_bu.html',
	'styles/prosilver/theme/images/portal/arrowbullet.png',
	'styles/prosilver/theme/images/portal/bg_list.gif',
	'styles/prosilver/theme/images/portal/bg_portalmenu.gif',
	'styles/prosilver/theme/images/portal/bg_portalmenu1.gif',
	'styles/prosilver/theme/images/portal/bullet.gif',
	'styles/prosilver/theme/images/portal/clock.swf',
	'styles/prosilver/theme/images/portal/corners_left.gif',
	'styles/prosilver/theme/images/portal/corners_left.png',
	'styles/prosilver/theme/images/portal/corners_left1.gif',
	'styles/prosilver/theme/images/portal/corners_left1.png',
	'styles/prosilver/theme/images/portal/corners_right.gif',
	'styles/prosilver/theme/images/portal/corners_right.png',
	'styles/prosilver/theme/images/portal/corners_right1.gif',
	'styles/prosilver/theme/images/portal/corners_right1.png',
	'styles/prosilver/theme/images/portal/dot.gif',
	'styles/prosilver/theme/images/portal/link.png',
	'styles/prosilver/theme/images/portal/member.gif',
	'styles/prosilver/theme/images/portal/portal_attach.gif',
	'styles/prosilver/theme/images/portal/portal_birthday.gif',
	'styles/prosilver/theme/images/portal/portal_calendar.gif',
	'styles/prosilver/theme/images/portal/portal_clock.gif',
	'styles/prosilver/theme/images/portal/portal_friends.gif',
	'styles/prosilver/theme/images/portal/portal_hr.gif',
	'styles/prosilver/theme/images/portal/portal_link_us.gif',
	'styles/prosilver/theme/images/portal/portal_linklist.gif',
	'styles/prosilver/theme/images/portal/portal_login.gif',
	'styles/prosilver/theme/images/portal/portal_menu.gif',
	'styles/prosilver/theme/images/portal/portal_newmember.gif',
	'styles/prosilver/theme/images/portal/portal_paypal.gif',
	'styles/prosilver/theme/images/portal/portal_random.gif',
	'styles/prosilver/theme/images/portal/portal_search.gif',
	'styles/prosilver/theme/images/portal/portal_statistic.gif',
	'styles/prosilver/theme/images/portal/portal_style.gif',
	'styles/prosilver/theme/images/portal/portal_team.gif',
	'styles/prosilver/theme/images/portal/portal_topposter.gif',
	'styles/subsilver2/template/portal/block/donation/donation.html',
	'styles/subsilver2/template/portal/block/donation/donation_small.html',
	'styles/subsilver2/template/portal/block/donation/index.html',
	'styles/subsilver2/template/portal/block/donation/paypal.html',
	'styles/subsilver2/theme/images/portal/bullet.gif',
	'styles/subsilver2/theme/images/portal/clock.swf',
	'styles/subsilver2/theme/images/portal/dot.gif',
	'styles/subsilver2/theme/images/portal/link.png',
	'styles/subsilver2/theme/images/portal/member.gif',
	'styles/subsilver2/theme/images/portal/portal_attach.gif',
	'styles/subsilver2/theme/images/portal/portal_birthday.gif',
	'styles/subsilver2/theme/images/portal/portal_calendar.gif',
	'styles/subsilver2/theme/images/portal/portal_clock.gif',
	'styles/subsilver2/theme/images/portal/portal_friends.gif',
	'styles/subsilver2/theme/images/portal/portal_hr.gif',
	'styles/subsilver2/theme/images/portal/portal_linklist.gif',
	'styles/subsilver2/theme/images/portal/portal_link_us.gif',
	'styles/subsilver2/theme/images/portal/portal_login.gif',
	'styles/subsilver2/theme/images/portal/portal_menu.gif',
	'styles/subsilver2/theme/images/portal/portal_newmember.gif',
	'styles/subsilver2/theme/images/portal/portal_paypal.gif',
	'styles/subsilver2/theme/images/portal/portal_random.gif',
	'styles/subsilver2/theme/images/portal/portal_search.gif',
	'styles/subsilver2/theme/images/portal/portal_statistic.gif',
	'styles/subsilver2/theme/images/portal/portal_style.gif',
	'styles/subsilver2/theme/images/portal/portal_team.gif',
	'styles/subsilver2/theme/images/portal/portal_topposter.gif',
);

?>