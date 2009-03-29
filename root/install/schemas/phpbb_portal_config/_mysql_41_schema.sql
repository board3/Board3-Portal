#
# $Id: _mysql_41_schema.sql 443 2009-01-21 16:16:19Z Christian_N $
#

# Table: 'phpbb_portal_config'
CREATE TABLE phpbb_portal_config (
	config_name varchar(255) DEFAULT '' NOT NULL,
	config_value mediumtext NOT NULL,
	PRIMARY KEY (config_name)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


