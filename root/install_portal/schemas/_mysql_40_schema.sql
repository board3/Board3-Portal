#
# $Id$
#

# Table: 'phpbb_portal_config'
CREATE TABLE phpbb_portal_config (
	config_name varbinary(255) DEFAULT '' NOT NULL,
	config_value mediumblob NOT NULL,
	PRIMARY KEY (config_name)
);

# Table: 'phpbb_portal_blocks'
CREATE TABLE phpbb_portal_blocks (
	block_name varbinary(64) NOT NULL,
	block_type tinyint(1) DEFAULT '0' NOT NULL,
	block_enabled tinyint(1) DEFAULT '0' NOT NULL,
	block_position tinyint(1) DEFAULT '0' NOT NULL,
	block_order int(11) NOT NULL,
	PRIMARY KEY (block_name, block_type),
	UNIQUE block_pos (block_position, block_order)
);