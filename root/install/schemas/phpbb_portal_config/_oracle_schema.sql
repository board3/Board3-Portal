/*

 $Id: _oracle_schema.sql 447 2009-01-22 17:56:58Z Christian_N $

*/


/*
	Table: 'phpbb_portal_config'
*/
CREATE TABLE phpbb_portal_config (
	config_name varchar2(255) DEFAULT '' ,
	config_value clob DEFAULT '' ,
	CONSTRAINT pk_phpbb_portal_config PRIMARY KEY (config_name)
)
/


