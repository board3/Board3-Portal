/*

 $Id: _postgres_schema.sql 447 2009-01-22 17:56:58Z Christian_N $

*/

BEGIN;


/*
	Table: 'phpbb_portal_config'
*/
CREATE TABLE phpbb_portal_config (
	config_name varchar(255) DEFAULT '' NOT NULL,
	config_value TEXT DEFAULT '' NOT NULL,
	PRIMARY KEY (config_name)
);



COMMIT;