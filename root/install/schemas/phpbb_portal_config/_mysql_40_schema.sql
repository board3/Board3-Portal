#
# $Id: _mysql_40_schema.sql 443 2009-01-21 16:16:19Z Christian_N $
#

# Table: 'phpbb_portal_config'
CREATE TABLE phpbb_portal_config (
	config_name varbinary(255) DEFAULT '' NOT NULL,
	config_value mediumblob NOT NULL,
	PRIMARY KEY (config_name)
);


