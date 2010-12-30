/*

 $Id: _mssql_schema.sql 447 2009-01-22 17:56:58Z Christian_N $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_portal_config'
*/
CREATE TABLE [phpbb_portal_config] (
	[config_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[config_value] [text] DEFAULT ('') NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_portal_config] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_portal_config] PRIMARY KEY  CLUSTERED 
	(
		[config_name]
	)  ON [PRIMARY] 
GO



COMMIT
GO

