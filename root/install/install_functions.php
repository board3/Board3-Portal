<?php
/**
*
* @package - Board3portal
* @version $Id: install_functions.php 588 2009-12-04 17:16:46Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @installer based on: phpBB Gallery by nickvergessen, www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (!defined('IN_INSTALL'))
{
	exit;
}

function get_dbms_infos()
{
	global $db;

	switch ($db->sql_layer)
	{
		case 'mysql':
			$return['db_schema'] = 'mysql_40';
			$return['delimiter'] = ';';
		break;

		case 'mysql4':
			if (version_compare($db->sql_server_info(true), '4.1.3', '>='))
			{
				$return['db_schema'] = 'mysql_41';
			}
			else
			{
				$return['db_schema'] = 'mysql_40';
			}
			$return['delimiter'] = ';';
		break;

		case 'mysqli':
			$return['db_schema'] = 'mysql_41';
			$return['delimiter'] = ';';
		break;

		case 'mssql':
		case 'mssql_odbc':
			$return['db_schema'] = 'mssql';
			$return['delimiter'] = 'GO';
		break;

		case 'postgres':
			$return['db_schema'] = 'postgres';
			$return['delimiter'] = ';';
		break;

		case 'sqlite':
			$return['db_schema'] = 'sqlite';
			$return['delimiter'] = ';';
		break;

		case 'firebird':
			$return['db_schema'] = 'firebird';
			$return['delimiter'] = ';;';
		break;

		case 'oracle':
			$return['db_schema'] = 'oracle';
			$return['delimiter'] = '/';
		break;

		default:
			trigger_error('Sorry, unsupported Databases found.');
		break;
	}

	return $return;
}

/*
* Needed to handle the creating of the db-tables out of the schema-files
*/
function split_sql_file($sql, $delimiter)
{
	$sql = str_replace("\r" , '', $sql);
	$data = preg_split('/' . preg_quote($delimiter, '/') . '$/m', $sql);

	$data = array_map('trim', $data);

	// The empty case
	$end_data = end($data);

	if (empty($end_data))
	{
		unset($data[key($data)]);
	}

	return $data;
}

/*
* Creates a new db-table
*	Note: we don't check for it on anyother way, so it might return a SQL-Error,
*	if you create the same table twice without this!
* @param	string	$table	table-name
* @param	bool	$drop	drops the table if it exist.
*/
function b3p_create_table($table, $dbms_data, $drop = true)
{
	global $db, $table_prefix, $db_schema, $delimiter;

	$table_name = substr($table . '#', 6, -1);
	$db_schema = $dbms_data['db_schema'];
	$delimiter = $dbms_data['delimiter'];

	if ($drop)
	{
		b3p_drop_table($table);
	}

	// locate the schema files
	$dbms_schema = 'schemas/' . $table . '/_' . $db_schema . '_schema.sql';
	$sql_query = @file_get_contents($dbms_schema);
	$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
	$sql_query = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql_query));
	$sql_query = split_sql_file($sql_query, $delimiter);
	// make the new one's
	foreach ($sql_query as $sql)
	{
		if (!$db->sql_query($sql))
		{
			$error = $db->sql_error();
			$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
		}
	}
	unset($sql_query);
}

/*
* Drops a db-table
* Note: you will loose all data!
* @param	string	$table	table-name
*/
function b3p_drop_table($table)
{
	global $db, $table_prefix, $db_schema;

	$table_name = substr($table . '#', 6, -1);

	if ($db->sql_layer != 'mssql' && $db->sql_layer != 'mssql_odbc')
	{
		$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . $table_name;
		$result = $db->sql_query($sql);
		$db->sql_freeresult($result);
	}
	else
	{
		$sql = "IF EXISTS(SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '{$table_prefix}{$table_name}')
			DROP TABLE {$table_prefix}{$table_name}";
		$result = $db->sql_query($sql);
		$db->sql_freeresult($result);
	}
}

/*
* Advanced: Add/update a portal-config value
*/
function set_portal_config($column, $value, $update = false)
{
	global $db;

	$sql = 'SELECT * FROM ' . PORTAL_CONFIG_TABLE . " WHERE config_name = '$column'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	if (!$row)
	{
		$sql_ary = array(
			'config_name'				=> $column,
			'config_value'				=> $value,
		);
		$db->sql_query('INSERT INTO ' . PORTAL_CONFIG_TABLE . $db->sql_build_array('INSERT', $sql_ary));
	}
	else
	{
		$sql_ary = array(
			'config_name'				=> $column,
			'config_value'				=> $value,
		);
		$db->sql_query('UPDATE ' . PORTAL_CONFIG_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE config_name = '$column'");
	}
}

/*
* Changes a column to a table
*	Note: it's not allowed to change the name of the column!
* @param	string	$table	table-name
* @param	string	$column	column-name
* @param	array	$values	column-type
*							array({column_type}, {default}, {auto_increment})
*							for explanation see: create_schema_files.php "*	Column Types:"
*/
function b3p_change_column($table, $column_name, $column_data)
{
	global $db;

	$phpbb_db_tools = new phpbb_db_tools($db);
	if ($phpbb_db_tools->sql_column_exists($table, $column_name))
	{
		$phpbb_db_tools->sql_column_change($table, $column_name, $column_data);
	}
}

/*
* Creates a dropdown box with all modules to choose a parent-module for a new module to avoid "PARENT_NO_EXIST"
* Note: you will loose all data of this column!
* @param	string	$module_class	'acp' or 'mcp' or 'ucp'
* @param	int		$default_id		the "standard" id of the module: enter 0 if not available, Exp: 31
* @param	string	$default_langname	language-less name Exp for 31 (.MODs): ACP_CAT_DOT_MODS
*/
function module_select($module_class, $default_id, $default_langname)
{
	global $db, $user;

	$module_options = '<option value="0">' . $user->lang['MODULES_SELECT_NONE'] . '</option>';
	$found_selected = false;

	$sql = 'SELECT module_id, module_langname, module_class
		FROM ' . MODULES_TABLE . "
		WHERE module_class = '$module_class'";
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$selected = '';
		if (($row['module_id'] == $default_id) || ($row['module_langname'] == $default_langname))
		{
			$selected = ' selected="selected"';
			$found_selected = true;
		}
		$module_options .= '<option value="' . $row['module_id'] . '"' . $selected .'>' . ((isset($user->lang[$row['module_langname']])) ? $user->lang[$row['module_langname']] : $row['module_langname']) . '</option>';
	}
	if (!$found_selected && $default_id)
	{
		$module_options = '<option value="-1">' . $user->lang['MODULES_CREATE_PARENT'] . '</option>' . $module_options;
	}

	return $module_options;
}

/*
* Adds a module to the phpbb_modules-table
* @param	array	$array	Exp:	array('module_basename' => '',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $choosen_acp_module,	'module_class' => 'acp',	'module_langname'=> 'PHPBB_GALLERY',	'module_mode' => '',	'module_auth' => '')
*/
function add_module($array)
{
	global $user;
	$modules = new acp_modules();
	$failed = $modules->update_module_data($array, true);
}

/*
* Removes a module of the phpbb_modules-table
*	Note: Be sure that the module exists, otherwise it may give an error message
*/
function remove_module($module_id, $module_class)
{
	global $user;
	$modules = new acp_modules();
	$modules->module_class = $module_class;
	$failed = $modules->delete_module($module_id);
}

/*
* Advanced: Load portal-config values
*/
function load_portal_config()
{
	global $db;

	$portal_config = array();

	$sql = 'SELECT * FROM ' . PORTAL_CONFIG_TABLE;
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result))
	{
		$portal_config[$row['config_name']] = $row['config_value'];
	}
	$db->sql_freeresult($result);

	return $portal_config;
}

/*
* Create a back-link
*	Note: just like phpbb3's adm_back_link
* @param	string	$u_action	back-link-url
*/
function adm_back_link($u_action)
{
	global $user;
	return '<br /><br /><a href="' . $u_action . '">&laquo; ' . $user->lang['BACK_TO_PREV'] . '</a>';
}

?>