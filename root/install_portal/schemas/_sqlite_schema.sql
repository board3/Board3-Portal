#
# $Id: $
#

BEGIN TRANSACTION;

# Table: 'phpbb_portal_config'
CREATE TABLE phpbb_portal_config (
	config_name varchar(255) NOT NULL DEFAULT '',
	config_value varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (config_name)
);



COMMIT;