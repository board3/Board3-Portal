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
?>