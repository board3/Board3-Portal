#
# $Id: _sqlite_schema.sql 443 2009-01-21 16:16:19Z Christian_N $
#

BEGIN TRANSACTION;

# Table: 'phpbb_portal_config'
CREATE TABLE phpbb_portal_config (
	config_name varchar(255) NOT NULL DEFAULT '',
	config_value mediumtext(16777215) NOT NULL DEFAULT '',
	PRIMARY KEY (config_name)
);



COMMIT;