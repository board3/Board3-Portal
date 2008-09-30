<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

$sql_update['0.2.0'] = array(
//	"ALTER TABLE phpbb_portal_config CHANGE config_value config_value text NOT NULL",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_limit', '3')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_allow_vote', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_birthdays_ahead', '7')",
);

$sql_update['0.2.2'] = array(
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments_forum_ids', '')",
);

// 0.3.0 was the internal release of 1.0.0RC1

$sql_update['0.3.0'] = array(
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_permissions', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_permissions', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center', '0')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small', '0')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_code_center', '')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_code_small', '')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center_bbcode', '0')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small_bbcode', '0')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center_headline', 'Headline center box')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small_headline', 'Headline small box')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_forum_index', '0')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_show_last', '0')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_archive', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_archive', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_links_array', 'a:2:{i:1;a:2:{s:4:\"text\";s:9:\"Board3.de\";s:3:\"url\";s:21:\"http://www.board3.de/\";}i:2;a:2:{s:4:\"text\";s:9:\"phpBB.com\";s:3:\"url\";s:21:\"http://www.phpbb.com/\";}}')",
);

$mod_update['0.3.0'] = array(
	'customblock' => array(
		'module_basename'   => 'portal',
		'module_enabled'   => 1,
		'module_display'   => 1,
		'module_class'      => 'acp',
		'module_langname'   => 'ACP_PORTAL_CUSTOM_INFO',
		'module_mode'      => 'customblock',
		'module_auth'      => ''
	),
	'linkblock' => array(
		'module_basename'   => 'portal',
		'module_enabled'   => 1,
		'module_display'   => 1,
		'module_class'      => 'acp',
		'module_langname'   => 'ACP_PORTAL_LINKS_INFO',
		'module_mode'      => 'links',
		'module_auth'      => ''
	),
);

$sql_update['1.0.0RC2'] = array(
	"UPDATE phpbb_portal_config SET config_name = 'portal_right_column_width' WHERE config_name = 'portal_right_collumn_width'",
	"UPDATE phpbb_portal_config SET config_name = 'portal_left_column_width' WHERE config_name = 'portal_left_collumn_width'",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_leaders_ext', '0');",
);

$sql_update['1.0.0RC3'] = array(
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_show_announcements_replies_views', '1');",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_show_news_replies_views', '1');",
);

$sql_update['1.0.3'] = array(
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_enable', '1');",
);

?>