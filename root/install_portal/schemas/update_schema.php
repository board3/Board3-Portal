<?php

$sql_update['0.2.0'] = array(
//	"ALTER TABLE phpbb_portal_config CHANGE config_value config_value text NOT NULL",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_limit', '3')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_allow_vote', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_birthdays_ahead', '7')",
);

$sql_update['0.2.2'] = array(
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments_forum_ids', '')",
);

$sql_update['0.2.3'] = array(
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_permissions', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_permissions', '1')",
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center', '0')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small', '0')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_code_center', '')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_code_small', '')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center_bbcode', '0')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small_bbcode', '0')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center_headline', 'Headline center box')";
	"INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small_headline', 'Headline small box')";
);

?>