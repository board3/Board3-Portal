<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* This file creates new schema files for every database.
* The filenames will be prefixed with an underscore to not overwrite the current schema files.
*
* If you overwrite the original schema files please make sure you save the file with UNIX linefeeds.
*/

//die("Please read the first lines of this script for instructions on how to enable it");

@set_time_limit(0);

$schema_path = './schemas/';

if (!is_writable($schema_path))
{
	die('Schema path not writable');
}

$schema_data = get_schema_struct();
$dbms_type_map = array(
	'mysql_41'	=> array(
		'INT:'		=> 'int(%d)',
		'BINT'		=> 'bigint(20)',
		'UINT'		=> 'mediumint(8) UNSIGNED',
		'UINT:'		=> 'int(%d) UNSIGNED',
		'TINT:'		=> 'tinyint(%d)',
		'USINT'		=> 'smallint(4) UNSIGNED',
		'BOOL'		=> 'tinyint(1) UNSIGNED',
		'VCHAR'		=> 'varchar(255)',
		'VCHAR:'	=> 'varchar(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'text',
		'XSTEXT_UNI'=> 'varchar(100)',
		'STEXT'		=> 'text',
		'STEXT_UNI'	=> 'varchar(255)',
		'TEXT'		=> 'text',
		'TEXT_UNI'	=> 'text',
		'MTEXT'		=> 'mediumtext',
		'MTEXT_UNI'	=> 'mediumtext',
		'TIMESTAMP'	=> 'int(11) UNSIGNED',
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'varchar(255)',
		'VCHAR_UNI:'=> 'varchar(%d)',
		'VCHAR_CI'	=> 'varchar(255)',
		'VARBINARY'	=> 'varbinary(255)',
	),

	'mysql_40'	=> array(
		'INT:'		=> 'int(%d)',
		'BINT'		=> 'bigint(20)',
		'UINT'		=> 'mediumint(8) UNSIGNED',
		'UINT:'		=> 'int(%d) UNSIGNED',
		'TINT:'		=> 'tinyint(%d)',
		'USINT'		=> 'smallint(4) UNSIGNED',
		'BOOL'		=> 'tinyint(1) UNSIGNED',
		'VCHAR'		=> 'varbinary(255)',
		'VCHAR:'	=> 'varbinary(%d)',
		'CHAR:'		=> 'binary(%d)',
		'XSTEXT'	=> 'blob',
		'XSTEXT_UNI'=> 'blob',
		'STEXT'		=> 'blob',
		'STEXT_UNI'	=> 'blob',
		'TEXT'		=> 'blob',
		'TEXT_UNI'	=> 'blob',
		'MTEXT'		=> 'mediumblob',
		'MTEXT_UNI'	=> 'mediumblob',
		'TIMESTAMP'	=> 'int(11) UNSIGNED',
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'blob',
		'VCHAR_UNI:'=> array('varbinary(%d)', 'limit' => array('mult', 3, 255, 'blob')),
		'VCHAR_CI'	=> 'blob',
		'VARBINARY'	=> 'varbinary(255)',
	),

	'firebird'	=> array(
		'INT:'		=> 'INTEGER',
		'BINT'		=> 'DOUBLE PRECISION',
		'UINT'		=> 'INTEGER',
		'UINT:'		=> 'INTEGER',
		'TINT:'		=> 'INTEGER',
		'USINT'		=> 'INTEGER',
		'BOOL'		=> 'INTEGER',
		'VCHAR'		=> 'VARCHAR(255) CHARACTER SET NONE',
		'VCHAR:'	=> 'VARCHAR(%d) CHARACTER SET NONE',
		'CHAR:'		=> 'CHAR(%d) CHARACTER SET NONE',
		'XSTEXT'	=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'STEXT'		=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'TEXT'		=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'MTEXT'		=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'XSTEXT_UNI'=> 'VARCHAR(100) CHARACTER SET UTF8',
		'STEXT_UNI'	=> 'VARCHAR(255) CHARACTER SET UTF8',
		'TEXT_UNI'	=> 'BLOB SUB_TYPE TEXT CHARACTER SET UTF8',
		'MTEXT_UNI'	=> 'BLOB SUB_TYPE TEXT CHARACTER SET UTF8',
		'TIMESTAMP'	=> 'INTEGER',
		'DECIMAL'	=> 'DOUBLE PRECISION',
		'DECIMAL:'	=> 'DOUBLE PRECISION',
		'PDECIMAL'	=> 'DOUBLE PRECISION',
		'PDECIMAL:'	=> 'DOUBLE PRECISION',
		'VCHAR_UNI'	=> 'VARCHAR(255) CHARACTER SET UTF8',
		'VCHAR_UNI:'=> 'VARCHAR(%d) CHARACTER SET UTF8',
		'VCHAR_CI'	=> 'VARCHAR(255) CHARACTER SET UTF8',
		'VARBINARY'	=> 'CHAR(255) CHARACTER SET NONE',
	),

	'mssql'		=> array(
		'INT:'		=> '[int]',
		'BINT'		=> '[float]',
		'UINT'		=> '[int]',
		'UINT:'		=> '[int]',
		'TINT:'		=> '[int]',
		'USINT'		=> '[int]',
		'BOOL'		=> '[int]',
		'VCHAR'		=> '[varchar] (255)',
		'VCHAR:'	=> '[varchar] (%d)',
		'CHAR:'		=> '[char] (%d)',
		'XSTEXT'	=> '[varchar] (1000)',
		'STEXT'		=> '[varchar] (3000)',
		'TEXT'		=> '[varchar] (8000)',
		'MTEXT'		=> '[text]',
		'XSTEXT_UNI'=> '[varchar] (100)',
		'STEXT_UNI'	=> '[varchar] (255)',
		'TEXT_UNI'	=> '[varchar] (4000)',
		'MTEXT_UNI'	=> '[text]',
		'TIMESTAMP'	=> '[int]',
		'DECIMAL'	=> '[float]',
		'DECIMAL:'	=> '[float]',
		'PDECIMAL'	=> '[float]',
		'PDECIMAL:'	=> '[float]',
		'VCHAR_UNI'	=> '[varchar] (255)',
		'VCHAR_UNI:'=> '[varchar] (%d)',
		'VCHAR_CI'	=> '[varchar] (255)',
		'VARBINARY'	=> '[varchar] (255)',
	),

	'oracle'	=> array(
		'INT:'		=> 'number(%d)',
		'BINT'		=> 'number(20)',
		'UINT'		=> 'number(8)',
		'UINT:'		=> 'number(%d)',
		'TINT:'		=> 'number(%d)',
		'USINT'		=> 'number(4)',
		'BOOL'		=> 'number(1)',
		'VCHAR'		=> 'varchar2(255)',
		'VCHAR:'	=> 'varchar2(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'varchar2(1000)',
		'STEXT'		=> 'varchar2(3000)',
		'TEXT'		=> 'clob',
		'MTEXT'		=> 'clob',
		'XSTEXT_UNI'=> 'varchar2(300)',
		'STEXT_UNI'	=> 'varchar2(765)',
		'TEXT_UNI'	=> 'clob',
		'MTEXT_UNI'	=> 'clob',
		'TIMESTAMP'	=> 'number(11)',
		'DECIMAL'	=> 'number(5, 2)',
		'DECIMAL:'	=> 'number(%d, 2)',
		'PDECIMAL'	=> 'number(6, 3)',
		'PDECIMAL:'	=> 'number(%d, 3)',
		'VCHAR_UNI'	=> 'varchar2(765)',
		'VCHAR_UNI:'=> array('varchar2(%d)', 'limit' => array('mult', 3, 765, 'clob')),
		'VCHAR_CI'	=> 'varchar2(255)',
		'VARBINARY'	=> 'raw(255)',
	),

	'sqlite'	=> array(
		'INT:'		=> 'int(%d)',
		'BINT'		=> 'bigint(20)',
		'UINT'		=> 'INTEGER UNSIGNED', //'mediumint(8) UNSIGNED',
		'UINT:'		=> 'INTEGER UNSIGNED', // 'int(%d) UNSIGNED',
		'TINT:'		=> 'tinyint(%d)',
		'USINT'		=> 'INTEGER UNSIGNED', //'mediumint(4) UNSIGNED',
		'BOOL'		=> 'INTEGER UNSIGNED', //'tinyint(1) UNSIGNED',
		'VCHAR'		=> 'varchar(255)',
		'VCHAR:'	=> 'varchar(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'text(65535)',
		'STEXT'		=> 'text(65535)',
		'TEXT'		=> 'text(65535)',
		'MTEXT'		=> 'mediumtext(16777215)',
		'XSTEXT_UNI'=> 'text(65535)',
		'STEXT_UNI'	=> 'text(65535)',
		'TEXT_UNI'	=> 'text(65535)',
		'MTEXT_UNI'	=> 'mediumtext(16777215)',
		'TIMESTAMP'	=> 'INTEGER UNSIGNED', //'int(11) UNSIGNED',
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'varchar(255)',
		'VCHAR_UNI:'=> 'varchar(%d)',
		'VCHAR_CI'	=> 'varchar(255)',
		'VARBINARY'	=> 'blob',
	),

	'postgres'	=> array(
		'INT:'		=> 'INT4',
		'BINT'		=> 'INT8',
		'UINT'		=> 'INT4', // unsigned
		'UINT:'		=> 'INT4', // unsigned
		'USINT'		=> 'INT2', // unsigned
		'BOOL'		=> 'INT2', // unsigned
		'TINT:'		=> 'INT2',
		'VCHAR'		=> 'varchar(255)',
		'VCHAR:'	=> 'varchar(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'varchar(1000)',
		'STEXT'		=> 'varchar(3000)',
		'TEXT'		=> 'varchar(8000)',
		'MTEXT'		=> 'TEXT',
		'XSTEXT_UNI'=> 'varchar(100)',
		'STEXT_UNI'	=> 'varchar(255)',
		'TEXT_UNI'	=> 'varchar(4000)',
		'MTEXT_UNI'	=> 'TEXT',
		'TIMESTAMP'	=> 'INT4', // unsigned
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'varchar(255)',
		'VCHAR_UNI:'=> 'varchar(%d)',
		'VCHAR_CI'	=> 'varchar_ci',
		'VARBINARY'	=> 'bytea',
	),
);

// A list of types being unsigned for better reference in some db's
$unsigned_types = array('UINT', 'UINT:', 'USINT', 'BOOL', 'TIMESTAMP');
$supported_dbms = array('firebird', 'mssql', 'mysql_40', 'mysql_41', 'oracle', 'postgres', 'sqlite');

foreach ($supported_dbms as $dbms)
{
	$fp = fopen($schema_path . '_' . $dbms . '_schema.sql', 'wt');

	$line = '';

	// Write Header
	switch ($dbms)
	{
		case 'mysql_40':
		case 'mysql_41':
			$line = "#\n# \$I" . "d: $\n#\n\n";
		break;

		case 'firebird':
			$line = "#\n# \$I" . "d: $\n#\n\n";
			$line .= custom_data('firebird') . "\n";
		break;

		case 'sqlite':
			$line = "#\n# \$I" . "d: $\n#\n\n";
			$line .= "BEGIN TRANSACTION;\n\n";
		break;

		case 'mssql':
			$line = "/*\n\n \$I" . "d: $\n\n*/\n\n";
			$line .= "BEGIN TRANSACTION\nGO\n\n";
		break;

		case 'oracle':
			$line = "/*\n\n \$I" . "d: $\n\n*/\n\n";
			$line .= custom_data('oracle') . "\n";
		break;

		case 'postgres':
			$line = "/*\n\n \$I" . "d: $\n\n*/\n\n";
			$line .= "BEGIN;\n\n";
			$line .= custom_data('postgres') . "\n";
		break;
	}

	fwrite($fp, $line);

	foreach ($schema_data as $table_name => $table_data)
	{
		// Write comment about table
		switch ($dbms)
		{
			case 'mysql_40':
			case 'mysql_41':
			case 'firebird':
			case 'sqlite':
				fwrite($fp, "# Table: '{$table_name}'\n");
			break;

			case 'mssql':
			case 'oracle':
			case 'postgres':
				fwrite($fp, "/*\n\tTable: '{$table_name}'\n*/\n");
			break;
		}

		// Create Table statement
		$generator = $textimage = false;
		$line = '';

		switch ($dbms)
		{
			case 'mysql_40':
			case 'mysql_41':
			case 'firebird':
			case 'oracle':
			case 'sqlite':
			case 'postgres':
				$line = "CREATE TABLE {$table_name} (\n";
			break;

			case 'mssql':
				$line = "CREATE TABLE [{$table_name}] (\n";
			break;
		}

		// Table specific so we don't get overlap
		$modded_array = array(); 

		// Write columns one by one...
		foreach ($table_data['COLUMNS'] as $column_name => $column_data)
		{
			// Get type
			if (strpos($column_data[0], ':') !== false)
			{
				list($orig_column_type, $column_length) = explode(':', $column_data[0]);
				if (!is_array($dbms_type_map[$dbms][$orig_column_type . ':']))
				{
					$column_type = sprintf($dbms_type_map[$dbms][$orig_column_type . ':'], $column_length);
				}
				else
				{
					if (isset($dbms_type_map[$dbms][$orig_column_type . ':']['rule']))
					{
						switch ($dbms_type_map[$dbms][$orig_column_type . ':']['rule'][0])
						{
							case 'div':
								$column_length /= $dbms_type_map[$dbms][$orig_column_type . ':']['rule'][1];
								$column_length = ceil($column_length);
								$column_type = sprintf($dbms_type_map[$dbms][$orig_column_type . ':'][0], $column_length);
							break;
						}
					}

					if (isset($dbms_type_map[$dbms][$orig_column_type . ':']['limit']))
					{
						switch ($dbms_type_map[$dbms][$orig_column_type . ':']['limit'][0])
						{
							case 'mult':
								$column_length *= $dbms_type_map[$dbms][$orig_column_type . ':']['limit'][1];
								if ($column_length > $dbms_type_map[$dbms][$orig_column_type . ':']['limit'][2])
								{
									$column_type = $dbms_type_map[$dbms][$orig_column_type . ':']['limit'][3];
									$modded_array[$column_name] = $column_type;
								}
								else
								{
									$column_type = sprintf($dbms_type_map[$dbms][$orig_column_type . ':'][0], $column_length);
								}
							break;
						}
					}
				}
				$orig_column_type .= ':';
			}
			else
			{
				$orig_column_type = $column_data[0];
				$column_type = $dbms_type_map[$dbms][$column_data[0]];
				if ($column_type == 'text' || $column_type == 'blob')
				{
					$modded_array[$column_name] = $column_type;
				}
			}

			// Adjust default value if db-dependant specified
			if (is_array($column_data[1]))
			{
				$column_data[1] = (isset($column_data[1][$dbms])) ? $column_data[1][$dbms] : $column_data[1]['default'];
			}

			switch ($dbms)
			{
				case 'mysql_40':
				case 'mysql_41':
					$line .= "\t{$column_name} {$column_type} ";

					// For hexadecimal values do not use single quotes
					if (!is_null($column_data[1]) && substr($column_type, -4) !== 'text' && substr($column_type, -4) !== 'blob')
					{
						$line .= (strpos($column_data[1], '0x') === 0) ? "DEFAULT {$column_data[1]} " : "DEFAULT '{$column_data[1]}' ";
					}
					$line .= 'NOT NULL';

					if (isset($column_data[2]))
					{
						if ($column_data[2] == 'auto_increment')
						{
							$line .= ' auto_increment';
						}
						else if ($dbms === 'mysql_41' && $column_data[2] == 'true_sort')
						{
							$line .= ' COLLATE utf8_unicode_ci';
						}
					}

					$line .= ",\n";
				break;

				case 'sqlite':
					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$line .= "\t{$column_name} INTEGER PRIMARY KEY ";
						$generator = $column_name;
					}
					else
					{
						$line .= "\t{$column_name} {$column_type} ";
					}

					$line .= 'NOT NULL ';
					$line .= (!is_null($column_data[1])) ? "DEFAULT '{$column_data[1]}'" : '';
					$line .= ",\n";
				break;

				case 'firebird':
					$line .= "\t{$column_name} {$column_type} ";

					if (!is_null($column_data[1]))
					{
						$line .= 'DEFAULT ' . ((is_numeric($column_data[1])) ? $column_data[1] : "'{$column_data[1]}'") . ' ';
					}

					$line .= 'NOT NULL';

					// This is a UNICODE column and thus should be given it's fair share
					if (preg_match('/^X?STEXT_UNI|VCHAR_(CI|UNI:?)/', $column_data[0]))
					{
						$line .= ' COLLATE UNICODE';
					}

					$line .= ",\n";

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$generator = $column_name;
					}
				break;

				case 'mssql':
					if ($column_type == '[text]')
					{
						$textimage = true;
					}

					$line .= "\t[{$column_name}] {$column_type} ";

					if (!is_null($column_data[1]))
					{
						// For hexadecimal values do not use single quotes
						if (strpos($column_data[1], '0x') === 0)
						{
							$line .= 'DEFAULT (' . $column_data[1] . ') ';
						}
						else
						{
							$line .= 'DEFAULT (' . ((is_numeric($column_data[1])) ? $column_data[1] : "'{$column_data[1]}'") . ') ';
						}
					}

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$line .= 'IDENTITY (1, 1) ';
					}

					$line .= 'NOT NULL';
					$line .= " ,\n";
				break;

				case 'oracle':
					$line .= "\t{$column_name} {$column_type} ";
					$line .= (!is_null($column_data[1])) ? "DEFAULT '{$column_data[1]}' " : '';

					// In Oracle empty strings ('') are treated as NULL.
					// Therefore in oracle we allow NULL's for all DEFAULT '' entries
					$line .= ($column_data[1] === '') ? ",\n" : "NOT NULL,\n";

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$generator = $column_name;
					}
				break;

				case 'postgres':
					$line .= "\t{$column_name} {$column_type} ";

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$line .= "DEFAULT nextval('{$table_name}_seq'),\n";

						// Make sure the sequence will be created before creating the table
						$line = "CREATE SEQUENCE {$table_name}_seq;\n\n" . $line;
					}
					else
					{
						$line .= (!is_null($column_data[1])) ? "DEFAULT '{$column_data[1]}' " : '';
						$line .= "NOT NULL";

						// Unsigned? Then add a CHECK contraint
						if (in_array($orig_column_type, $unsigned_types))
						{
							$line .= " CHECK ({$column_name} >= 0)";
						}

						$line .= ",\n";
					}
				break;
			}
		}

		switch ($dbms)
		{
			case 'firebird':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);;\n\n";
			break;

			case 'mssql':
				$line = substr($line, 0, -2);
				$line .= "\n) ON [PRIMARY]" . (($textimage) ? ' TEXTIMAGE_ON [PRIMARY]' : '') . "\n";
				$line .= "GO\n\n";
			break;
		}

		// Write primary key
		if (isset($table_data['PRIMARY_KEY']))
		{
			if (!is_array($table_data['PRIMARY_KEY']))
			{
				$table_data['PRIMARY_KEY'] = array($table_data['PRIMARY_KEY']);
			}

			switch ($dbms)
			{
				case 'mysql_40':
				case 'mysql_41':
				case 'postgres':
					$line .= "\tPRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . "),\n";
				break;

				case 'firebird':
					$line .= "ALTER TABLE {$table_name} ADD PRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . ");;\n\n";
				break;

				case 'sqlite':
					if ($generator === false || !in_array($generator, $table_data['PRIMARY_KEY']))
					{
						$line .= "\tPRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . "),\n";
					}
				break;

				case 'mssql':
					$line .= "ALTER TABLE [{$table_name}] WITH NOCHECK ADD \n";
					$line .= "\tCONSTRAINT [PK_{$table_name}] PRIMARY KEY  CLUSTERED \n";
					$line .= "\t(\n";
					$line .= "\t\t[" . implode("],\n\t\t[", $table_data['PRIMARY_KEY']) . "]\n";
					$line .= "\t)  ON [PRIMARY] \n";
					$line .= "GO\n\n";
				break;

				case 'oracle':
					$line .= "\tCONSTRAINT pk_{$table_name} PRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . "),\n";
				break;
			}
		}

		switch ($dbms)
		{
			case 'oracle':
				// UNIQUE contrains to be added?
				if (isset($table_data['KEYS']))
				{
					foreach ($table_data['KEYS'] as $key_name => $key_data)
					{
						if (!is_array($key_data[1]))
						{
							$key_data[1] = array($key_data[1]);
						}

						if ($key_data[0] == 'UNIQUE')
						{
							$line .= "\tCONSTRAINT u_phpbb_{$key_name} UNIQUE (" . implode(', ', $key_data[1]) . "),\n";
						}
					}
				}

				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n)\n/\n\n";
			break;

			case 'postgres':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);\n\n";
			break;

			case 'sqlite':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);\n\n";
			break;
		}

		// Write Keys
		if (isset($table_data['KEYS']))
		{
			foreach ($table_data['KEYS'] as $key_name => $key_data)
			{
				if (!is_array($key_data[1]))
				{
					$key_data[1] = array($key_data[1]);
				}

				switch ($dbms)
				{
					case 'mysql_40':
					case 'mysql_41':
						$line .= ($key_data[0] == 'INDEX') ? "\tKEY" : '';
						$line .= ($key_data[0] == 'UNIQUE') ? "\tUNIQUE" : '';
						foreach ($key_data[1] as $key => $col_name)
						{
							if (isset($modded_array[$col_name]))
							{
								switch ($modded_array[$col_name])
								{
									case 'text':
									case 'blob':
										$key_data[1][$key] = $col_name . '(255)';
									break;
								}
							}
						}
						$line .= ' ' . $key_name . ' (' . implode(', ', $key_data[1]) . "),\n";
					break;

					case 'firebird':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE UNIQUE INDEX' : '';

						$line .= ' ' . $table_name . '_' . $key_name . ' ON ' . $table_name . '(' . implode(', ', $key_data[1]) . ");;\n";
					break;

					case 'mssql':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE  INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE  UNIQUE  INDEX' : '';
						$line .= " [{$key_name}] ON [{$table_name}]([" . implode('], [', $key_data[1]) . "]) ON [PRIMARY]\n";
						$line .= "GO\n\n";
					break;

					case 'oracle':
						if ($key_data[0] == 'UNIQUE')
						{
							continue;
						}

						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						
						$line .= " {$table_name}_{$key_name} ON {$table_name} (" . implode(', ', $key_data[1]) . ")\n";
						$line .= "/\n";
					break;

					case 'sqlite':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE UNIQUE INDEX' : '';

						$line .= " {$table_name}_{$key_name} ON {$table_name} (" . implode(', ', $key_data[1]) . ");\n";
					break;

					case 'postgres':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE UNIQUE INDEX' : '';

						$line .= " {$table_name}_{$key_name} ON {$table_name} (" . implode(', ', $key_data[1]) . ");\n";
					break;
				}
			}
		}

		switch ($dbms)
		{
			case 'mysql_40':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);\n\n";
			break;

			case 'mysql_41':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n) CHARACTER SET `utf8` COLLATE `utf8_bin`;\n\n";
			break;

			// Create Generator
			case 'firebird':
				if ($generator !== false)
				{
					$line .= "\nCREATE GENERATOR {$table_name}_gen;;\n";
					$line .= 'SET GENERATOR ' . $table_name . "_gen TO 0;;\n\n";

					$line .= 'CREATE TRIGGER t_' . $table_name . ' FOR ' . $table_name . "\n";
					$line .= "BEFORE INSERT\nAS\nBEGIN\n";
					$line .= "\tNEW.{$generator} = GEN_ID({$table_name}_gen, 1);\nEND;;\n\n";
				}
			break;

			case 'oracle':
				if ($generator !== false)
				{
					$line .= "\nCREATE SEQUENCE {$table_name}_seq\n/\n\n";

					$line .= "CREATE OR REPLACE TRIGGER t_{$table_name}\n";
					$line .= "BEFORE INSERT ON {$table_name}\n";
					$line .= "FOR EACH ROW WHEN (\n";
					$line .= "\tnew.{$generator} IS NULL OR new.{$generator} = 0\n";
					$line .= ")\nBEGIN\n";
					$line .= "\tSELECT {$table_name}_seq.nextval\n";
					$line .= "\tINTO :new.{$generator}\n";
					$line .= "\tFROM dual;\nEND;\n/\n\n";
				}
			break;
		}

		fwrite($fp, $line . "\n");
	}

	$line = '';

	// Write custom function at the end for some db's
	switch ($dbms)
	{
		case 'mssql':
			$line = "\nCOMMIT\nGO\n\n";
		break;

		case 'sqlite':
			$line = "\nCOMMIT;";
		break;

		case 'postgres':
			$line = "\nCOMMIT;";
		break;
	}

	fwrite($fp, $line);
	fclose($fp);
}


/**
* Define the basic structure
* The format:
*		array('{TABLE_NAME}' => {TABLE_DATA})
*		{TABLE_DATA}:
*			COLUMNS = array({column_name} = array({column_type}, {default}, {auto_increment}))
*			PRIMARY_KEY = {column_name(s)}
*			KEYS = array({key_name} = array({key_type}, {column_name(s)})),
*
*	Column Types:
*	INT:x		=> SIGNED int(x)
*	BINT		=> BIGINT
*	UINT		=> mediumint(8) UNSIGNED
*	UINT:x		=> int(x) UNSIGNED
*	TINT:x		=> tinyint(x)
*	USINT		=> smallint(4) UNSIGNED (for _order columns)
*	BOOL		=> tinyint(1) UNSIGNED
*	VCHAR		=> varchar(255)
*	CHAR:x		=> char(x)
*	XSTEXT_UNI	=> text for storing 100 characters (topic_title for example)
*	STEXT_UNI	=> text for storing 255 characters (normal input field with a max of 255 single-byte chars) - same as VCHAR_UNI
*	TEXT_UNI	=> text for storing 3000 characters (short text, descriptions, comments, etc.)
*	MTEXT_UNI	=> mediumtext (post text, large text)
*	VCHAR:x		=> varchar(x)
*	TIMESTAMP	=> int(11) UNSIGNED
*	DECIMAL		=> decimal number (5,2)
*	DECIMAL:	=> decimal number (x,2)
*	PDECIMAL	=> precision decimal number (6,3)
*	PDECIMAL:	=> precision decimal number (x,3)
*	VCHAR_UNI	=> varchar(255) BINARY
*	VCHAR_CI	=> varchar_ci for postgresql, others VCHAR
*/
function get_schema_struct()
{
	$schema_data = array();

	// Create formel_config table
	$schema_data['phpbb_portal_config'] = array(
		'COLUMNS'		=> array(
			'config_name'		=> array('VCHAR', ''),
			'config_value'		=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'config_name',
	);

	return $schema_data;
}


/**
* Data put into the header for various dbms
*/
function custom_data($dbms)
{
	switch ($dbms)
	{
		case 'oracle':
			return <<<EOF
/*
  This first section is optional, however its probably the best method
  of running phpBB on Oracle. If you already have a tablespace and user created
  for phpBB you can leave this section commented out!

  The first set of statements create a phpBB tablespace and a phpBB user,
  make sure you change the password of the phpBB user before you run this script!!
*/

/*
CREATE TABLESPACE "PHPBB"
	LOGGING 
	DATAFILE 'E:\ORACLE\ORADATA\LOCAL\PHPBB.ora' 
	SIZE 10M
	AUTOEXTEND ON NEXT 10M
	MAXSIZE 100M;

CREATE USER "PHPBB" 
	PROFILE "DEFAULT" 
	IDENTIFIED BY "phpbb_password" 
	DEFAULT TABLESPACE "PHPBB" 
	QUOTA UNLIMITED ON "PHPBB" 
	ACCOUNT UNLOCK;

GRANT ANALYZE ANY TO "PHPBB";
GRANT CREATE SEQUENCE TO "PHPBB";
GRANT CREATE SESSION TO "PHPBB";
GRANT CREATE TABLE TO "PHPBB";
GRANT CREATE TRIGGER TO "PHPBB";
GRANT CREATE VIEW TO "PHPBB";
GRANT "CONNECT" TO "PHPBB";

COMMIT;
DISCONNECT;

CONNECT phpbb/phpbb_password;
*/
EOF;

		break;

		case 'postgres':
			return <<<EOF
/*
	Domain definition
*/
CREATE DOMAIN varchar_ci AS varchar(255) NOT NULL DEFAULT ''::character varying;

/*
	Operation Functions
*/
CREATE FUNCTION _varchar_ci_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) = LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_not_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) != LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_less_than(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) < LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_less_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) <= LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_greater_than(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) > LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_greater_equals(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) >= LOWER($2)' LANGUAGE SQL STRICT;

/*
	Operators
*/
CREATE OPERATOR <(
  PROCEDURE = _varchar_ci_less_than,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = >,
  NEGATOR = >=,
  RESTRICT = scalarltsel,
  JOIN = scalarltjoinsel);

CREATE OPERATOR <=(
  PROCEDURE = _varchar_ci_less_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = >=,
  NEGATOR = >,
  RESTRICT = scalarltsel,
  JOIN = scalarltjoinsel);

CREATE OPERATOR >(
  PROCEDURE = _varchar_ci_greater_than,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <,
  NEGATOR = <=,
  RESTRICT = scalargtsel,
  JOIN = scalargtjoinsel);

CREATE OPERATOR >=(
  PROCEDURE = _varchar_ci_greater_equals,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <=,
  NEGATOR = <,
  RESTRICT = scalargtsel,
  JOIN = scalargtjoinsel);

CREATE OPERATOR <>(
  PROCEDURE = _varchar_ci_not_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <>,
  NEGATOR = =,
  RESTRICT = neqsel,
  JOIN = neqjoinsel);

CREATE OPERATOR =(
  PROCEDURE = _varchar_ci_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = =,
  NEGATOR = <>,
  RESTRICT = eqsel,
  JOIN = eqjoinsel,
  HASHES,
  MERGES,
  SORT1= <);

EOF;
		break;
	}

	return '';
}

?>