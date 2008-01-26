#
# $Id: $
#

# Table: 'phpbb_portal_config'
CREATE TABLE phpbb_portal_config (
	config_name varbinary(255) DEFAULT '' NOT NULL,
	config_value varbinary(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (config_name)
);


