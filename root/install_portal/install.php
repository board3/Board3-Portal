<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

$current_version = '2.0.0_alpha_1';

// If only checking version, exit.
if( defined('IN_PHPBB') )
{
	return;
}

define('IN_PHPBB', true);
define('IN_PORTAL_INSTALL', true);

$phpEx = substr(strrchr(__FILE__, '.'), 1);

$phpbb_root_path = '../';
$portal_root_path = $phpbb_root_path.'portal/';

include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/portal_install');

$mode = request_var('mode', '');

$page_title = 'Board3portal v' . $current_version;

if( $user->data['is_registered'] && $auth->acl_get('a_') ) 	 
{
	$version_array = array('0.1.0', '0.2.0', '0.2.1', '0.2.2', '0.3.0', '1.0.0RC1', '1.0.0RC2', '1.0.0RC3', '1.0.0', '1.0.1', 'p3p1.2.2', 'p3p1.2.1', 'p3p1.2.0', 'p3p1.1.0b');
	
	$old_version = 0;
	$phpbb3portal = false;
	$installed = $updated = $uninstalled =false;
	
	$sql = 'SELECT config_value as version 
			FROM ' . PORTAL_CONFIG_TABLE . "
			WHERE config_name = 'portal_version'";
	$result = @$db->sql_query_limit( $sql, 1 );
	$version = $db->sql_fetchrow( $result );
	if( sizeof( $version ) )
	{
		$old_version = strtolower($version['version']);
	}
	else
	{
		$db->sql_freeresult( $result );
		$sql = 'SELECT config_value as version 
				FROM ' . CONFIG_TABLE . "
				WHERE config_name = 'portal_version'";
		$result = @$db->sql_query_limit( $sql, 1 );
		$version = $db->sql_fetchrow( $result );
		if( sizeof( $version ) )
		{
			$phpbb3portal = true;
			$old_version = ( strtolower($version['version']) == '1.1.0.b' ) ? '1.1.0b' : strtolower($version['version']) ;
		}
	}
	$db->sql_freeresult( $result );
	
	$check_mode = 'none';
	
	if( $old_version == 0 )
	{
		$check_mode = 'install';
	}
	elseif( $phpbb3portal === TRUE || version_compare( strtolower($old_version), strtolower($current_version), "<" ) === TRUE )
	{
		$check_mode = 'update';
	}
	
	$confirm = request_var('confirm', 0);
	
	$error_array = array();
	
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
	
	function db_error( $error, $sql, $line, $file, $skip = false )
	{
		global $error, $lang, $db;
	
		if( $skip )
		{
			$error_array[] = 	'<b>' . $user->lang['GENERAL_ERROR'] . ': ' . basename($file) . ' [ ' . $line . ' ]</b><br />
						<b style="color:red">' . $error . '</b><br />&#187; SQL:' . $sql;
			return;
		} else {
			include $phpbb_root_path . 'install_portal/style/layout_header.php';
			echo '<div class="errorbox">
					<h3>'. $user->lang['GENERAL_ERROR'] .'</h3>
					<p><b>' . $error . '</b><br />&#187; SQL:' . $sql . '<br />
					' . basename($file) . ' [ ' . $line . ' ]</p>
				</div>';		
			include $phpbb_root_path . 'install_portal/style/layout_footer.php';
			exit;
		}
	}
	
	function remove_comments(&$output)
	{
		$lines = explode("\n", $output);
		$output = '';
	
		// try to keep mem. use down
		$linecount = sizeof($lines);
	
		$in_comment = false;
		for ($i = 0; $i < $linecount; $i++)
		{
			if (trim($lines[$i]) == '/*')
			{
				$in_comment = true;
			}
	
			if (!$in_comment)
			{
				$output .= $lines[$i] . "\n";
			}
	
			if (trim($lines[$i]) == '*/')
			{
				$in_comment = false;
			}
		}
	
		unset($lines);
		return $output;
	}
	
	function remove_remarks(&$sql)
	{
		$sql = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql));
	}
	
	// What sql_layer should we use?
	switch ($db->sql_layer)
	{
		case 'mysql':
			$db_schema = 'mysql_40';
			$delimiter = ';';
			$comments = 'remove_remarks';
		break;
	
		case 'mysql4':
			if (version_compare($db->mysql_version, '4.1.3', '>='))
			{
				$db_schema = 'mysql_41';
			}
			else
			{
				$db_schema = 'mysql_40';
			}
			$delimiter = ';';
			$comments = 'remove_remarks';
		break;
	
		case 'mysqli':
			$db_schema = 'mysql_41';
			$delimiter = ';';
			$comments = 'remove_remarks';
		break;
	
		case 'mssql':
		case 'mssql_odbc':
			$db_schema = 'mssql';
			$delimiter = 'GO';
			$comments = 'remove_comments';
		break;
	
		case 'postgres':
			$db_schema = 'postgres';
			$delimiter = ';';
			$comments = 'remove_comments';
		break;
	
		case 'sqlite':
			$db_schema = 'sqlite';
			$delimiter = ';';
			$comments = 'remove_remarks';
		break;
	
		case 'firebird':
			$db_schema = 'firebird';
			$delimiter = ';;';
			$comments = 'remove_remarks';
		break;
	
		case 'oracle':
			$db_schema = 'oracle';
			$delimiter = '/';
			$comments = 'remove_comments';
		break;
	
		default:
			trigger_error('Sorry, unsupported DBMS found: ' . $db->sql_layer);
		break;
	}
	
	// Get old version if it is installed.
	
	switch ($mode)
	{
	// Installing from scratch
	case 'install':
		if( $check_mode == 'install' )
		{
			if( $confirm == 1)
			{
				// Drop thes tables if existing
				switch( $db->sql_layer )
				{
					case 'mysql4':
					case 'mysqli':
					case 'oracle':
					case 'firebird':
					case 'sqlite':
					case 'mysql':
						$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
						$result = $db->sql_query($sql);
						$db->sql_freeresult($result);
					break;
					case '':
						$sql = 'SELECT version() as version';
						$result = $db->sql_query($sql);
						$data = $db->sql_fetchrow($result);
						if( version_compare($data['version'], '8.1.11', '>') === TRUE )
						{
							$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
							$result = $db->sql_query($sql);
							$db->sql_freeresult($result);
						} else {
							$sql = 'DROP TABLE ' . $table_prefix . 'portal_config';
							$result = @$db->sql_query($sql);
							$db->sql_freeresult($result);
						}
					break;
					case 'mssql':
						$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'portal_config)
						drop table ' . $table_prefix . 'portal_config';
						$result = $db->sql_query($sql);
						$db->sql_freeresult($result);
					break;
				}
		
				// locate the schema files
				$dbms_schema = $phpbb_root_path.'install_portal/schemas/_' . $db_schema . '_schema.sql';
				$sql_query = @file_get_contents($dbms_schema);
				$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
				$comments($sql_query);
				$sql_query = split_sql_file($sql_query, $delimiter);
		
				// Make tables
				foreach ($sql_query as $sql)
				{
					if (!$db->sql_query($sql))
					{
						$error = $db->sql_error();
						db_error($error['message'], $sql, __LINE__, __FILE__);
					}
				}
				unset($sql_query);
			
				// Now for the data
		
				$sql_query = @file_get_contents($phpbb_root_path.'install_portal/schemas/_schema_data.sql');
				switch ($db->sql_layer)
				{
					case 'mssql':
					case 'mssql_odbc':
						$sql_query = preg_replace('#\# MSSQL IDENTITY (phpbb_[a-z_]+) (ON|OFF) \##s', 'SET IDENTITY_INSERT \1 \2;', $sql_query);
					break;
					case 'postgres':
						$sql_query = preg_replace('#\# POSTGRES (BEGIN|COMMIT) \##s', '\1; ', $sql_query);
					break;
				}
		
				$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
				$sql_query = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql_query));
				$sql_query = split_sql_file($sql_query, ';');
	
				$sql_query[] = "INSERT INTO {$table_prefix}portal_config (config_name, config_value) VALUES ('portal_version', '{$current_version}')";
		
				foreach ($sql_query as $sql)
				{
					if (!$db->sql_query($sql))
					{
						$error = $db->sql_error();
						db_error($error['message'], $sql, __LINE__, __FILE__);
					}
				}
				unset($sql_query);
		
				// create the acp modules - Nickvergessen's code
				$modules = new acp_modules();
				$portal = array(
					'module_basename'	=> '',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> 31,
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_INFO',
					'module_mode'		=> '',
					'module_auth'		=> ''
				);
				$modules->update_module_data($portal);
				$general = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_GENERAL_INFO',
					'module_mode'		=> 'general',
					'module_auth'		=> ''
				);
				$modules->update_module_data($general);
				$news = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_NEWS_INFO',
					'module_mode'		=> 'news',
					'module_auth'		=> ''
				);
				$modules->update_module_data($news);
				$announcements = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_ANNOUNCE_INFO',
					'module_mode'		=> 'announcements',
					'module_auth'		=> ''
				);
				$modules->update_module_data($announcements);
				$welcome = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_WELCOME_INFO',
					'module_mode'		=> 'welcome',
					'module_auth'		=> ''
				);
				$modules->update_module_data($welcome);
				$recent = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_RECENT_INFO',
					'module_mode'		=> 'recent',
					'module_auth'		=> ''
				);
				$modules->update_module_data($recent);
				$wordgraph = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_WORDGRAPH_INFO',
					'module_mode'		=> 'wordgraph',
					'module_auth'		=> ''
				);
				$modules->update_module_data($wordgraph);
				$paypal = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_PAYPAL_INFO',
					'module_mode'		=> 'paypal',
					'module_auth'		=> ''
				);
				$modules->update_module_data($paypal);
				$attachments = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO',
					'module_mode'		=> 'attachments',
					'module_auth'		=> ''
				);
				$modules->update_module_data($attachments);
				$members = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_MEMBERS_INFO',
					'module_mode'		=> 'members',
					'module_auth'		=> ''
				);
				$modules->update_module_data($members);
				$polls = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_POLLS_INFO',
					'module_mode'		=> 'polls',
					'module_auth'		=> ''
				);
				$modules->update_module_data($polls);
				$bots = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_BOTS_INFO',
					'module_mode'		=> 'bots',
					'module_auth'		=> ''
				);
				$modules->update_module_data($bots);
				$poster = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_MOST_POSTER_INFO',
					'module_mode'		=> 'poster',
					'module_auth'		=> ''
				);
				$modules->update_module_data($poster);
				$minicalendar = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_MINICALENDAR_INFO',
					'module_mode'		=> 'minicalendar',
					'module_auth'		=> ''
				);
				$modules->update_module_data($minicalendar);
				$customblock = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_CUSTOM_INFO',
					'module_mode'		=> 'customblock',
					'module_auth'		=> ''
				);
				$modules->update_module_data($customblock);
				$linkblock = array(
					'module_basename'	=> 'portal',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_LINKS_INFO',
					'module_mode'		=> 'links',
					'module_auth'		=> ''
				);
				$modules->update_module_data($linkblock);
				$palletlist = array(
					'module_basename'	=> 'pallet',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PALLET_LIST_INFO',
					'module_mode'		=> 'list',
					'module_auth'		=> ''
				);
				$modules->update_module_data($palletlist);
				$portallayout = array(
					'module_basename'	=> 'pallet',
					'module_enabled'	=> 1,
					'module_display'	=> 1,
					'parent_id'			=> $portal['module_id'],
					'module_class'		=> 'acp',
					'module_langname'	=> 'ACP_PORTAL_LAYOUT_INFO',
					'module_mode'		=> 'layout',
					'module_auth'		=> ''
				);
				$modules->update_module_data($portallayout);				

				// clear cache and log what we did
				$cache->purge();
				add_log('admin', $page_title . ' installed');
				$installed = true;
			}
			include($phpbb_root_path . 'install_portal/style/layout_install.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'install_portal/style/layout_menu.'.$phpEx);
		}
	break;
	// Updating
	case 'update':
		if( $check_mode == 'update' )
		{
			$confirm = request_var('confirm', '');
			if( $confirm == 1 )
			{
				if( $phpbb3portal === TRUE )
				{
					// Drop thes tables if existing
					switch( $db->sql_layer )
					{
						case 'mysql4':
						case 'mysqli':
						case 'oracle':
						case 'firebird':
						case 'sqlite':
						case 'mysql':
							$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
							$result = $db->sql_query($sql);
							$db->sql_freeresult($result);
						break;
						case '':
							$sql = 'SELECT version() as version';
							$result = $db->sql_query($sql);
							$data = $db->sql_fetchrow($result);
							if( version_compare($data['version'], '8.1.11', '>') === TRUE )
							{
								$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
								$result = $db->sql_query($sql);
								$db->sql_freeresult($result);
							} else {
								$sql = 'DROP TABLE ' . $table_prefix . 'portal_config';
								$result = @$db->sql_query($sql);
								$db->sql_freeresult($result);
							}
						break;
						case 'mssql':
							$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'portal_config)
							drop table ' . $table_prefix . 'portal_config';
							$result = $db->sql_query($sql);
							$db->sql_freeresult($result);
						break;
					}
	
					// locate the schema files
					$dbms_schema = $phpbb_root_path.'install_portal/schemas/_' . $db_schema . '_schema.sql';
					$sql_query = @file_get_contents($dbms_schema);
					$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
					$comments($sql_query);
					$sql_query = split_sql_file($sql_query, $delimiter);
			
					// Make tables
					foreach ($sql_query as $sql)
					{
						if (!$db->sql_query($sql))
						{
							$error = $db->sql_error();
							db_error($error['message'], $sql, __LINE__, __FILE__);
						}
					}
					unset($sql_query);
				
					// Start by inserting default data
			
					$sql_query = @file_get_contents($phpbb_root_path.'install_portal/schemas/_schema_data.sql');
					switch ($db->sql_layer)
					{
						case 'mssql':
						case 'mssql_odbc':
							$sql_query = preg_replace('#\# MSSQL IDENTITY (phpbb_[a-z_]+) (ON|OFF) \##s', 'SET IDENTITY_INSERT \1 \2;', $sql_query);
						break;
						case 'postgres':
							$sql_query = preg_replace('#\# POSTGRES (BEGIN|COMMIT) \##s', '\1; ', $sql_query);
						break;
					}
			
					$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
					$sql_query = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql_query));
					$sql_query = split_sql_file($sql_query, ';');
			
					$sql_query[] = "INSERT INTO {$table_prefix}portal_config (config_name, config_value) VALUES ('portal_version', '{$current_version}')";
					foreach ($sql_query as $sql)
					{
						if (!$db->sql_query($sql))
						{
							$error = $db->sql_error();
							db_error($error['message'], $sql, __LINE__, __FILE__);
						}
					}
					unset($sql_query);
	
					// Set old settings.
					$sql = 'SELECT * FROM ' . PORTAL_CONFIG_TABLE;
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						if (isset($config[$row['config_name']]))
						{
							$sql2 = 'UPDATE ' . PORTAL_CONFIG_TABLE . " SET config_value = '" . $config[$row['config_name']] . "' WHERE config_name = '" . $row['config_name'] . "'";
							$db->sql_query_limit($sql2, 1);
							$sql3 = 'DELETE FROM ' . CONFIG_TABLE . " WHERE config_name = '" . $row['config_name'] . "'";
							$db->sql_query_limit($sql3, 1);
						}
					}
					$db->sql_freeresult($result);
					$sql = 'UPDATE ' . PORTAL_CONFIG_TABLE . " SET config_value = '{$current_version}' where config_name = 'portal_version'";
					$db->sql_query($sql);
	
					// Delete old portal stuff
					$sql = "ALTER TABLE {$table_prefix}config CHANGE config_value config_value varchar(255) NOT NULL";
					$db->sql_query($sql);
	
					$sql = 'SELECT right_id, module_id FROM ' . MODULES_TABLE . "
						WHERE module_langname = 'ACP_PORTAL_GENERAL_INFO'
							OR module_langname = 'ACP_PORTAL_NEWS_INFO'
							OR module_langname = 'ACP_PORTAL_ANNOUNCE_INFO'
							OR module_langname = 'ACP_PORTAL_WELCOME_INFO'
							OR module_langname = 'ACP_PORTAL_RECENT_INFO'
							OR module_langname = 'ACP_PORTAL_WORDGRAPH_INFO'
							OR module_langname = 'ACP_PORTAL_PAYPAL_INFO'
							OR module_langname = 'ACP_PORTAL_ADS_INFO'
							OR module_langname = 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'
							OR module_langname = 'ACP_PORTAL_MEMBERS_INFO'
							OR module_langname = 'ACP_PORTAL_POLLS_INFO'
							OR module_langname = 'ACP_PORTAL_BOTS_INFO'
							OR module_langname = 'ACP_PORTAL_MOST_POSTER_INFO'
							OR module_langname = 'ACP_PORTAL_MINICALENDAR_INFO'
							OR module_langname = 'ACP_PORTAL_CUSTOM_INFO'
							OR module_langname = 'ACP_PORTAL_LINKS_INFO'";
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$sql = 'DELETE FROM ' . MODULES_TABLE . " WHERE module_id = '{$row['module_id']}'";
						$db->sql_query($sql);
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET left_id = left_id - 2
							WHERE module_class = 'acp'
								AND left_id > {$row['right_id']}";
						$db->sql_query($sql);
		
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET right_id = right_id - 2
							WHERE module_class = 'acp'
								AND right_id > {$row['right_id']}";
						$db->sql_query($sql);
					}
					$db->sql_freeresult($result);
	
					$sql = 'SELECT right_id, module_id FROM ' . MODULES_TABLE . "
						WHERE module_langname = 'ACP_PORTAL_INFO'";
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$sql = 'DELETE FROM ' . MODULES_TABLE . " WHERE module_id = '{$row['module_id']}'";
						$db->sql_query($sql);
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET left_id = left_id - 2
							WHERE module_class = 'acp'
								AND left_id > {$row['right_id']}";
						$db->sql_query($sql);
		
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET right_id = right_id - 2
							WHERE module_class = 'acp'
								AND right_id > {$row['right_id']}";
						$db->sql_query($sql);
					}
					$db->sql_freeresult($result);
	
					// create the acp modules
					$modules = new acp_modules();
					$portal = array(
						'module_basename'	=> '',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> 31,
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_INFO',
						'module_mode'		=> '',
						'module_auth'		=> ''
					);
					$modules->update_module_data($portal);
					$general = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_GENERAL_INFO',
						'module_mode'		=> 'general',
						'module_auth'		=> ''
					);
					$modules->update_module_data($general);
					$news = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_NEWS_INFO',
						'module_mode'		=> 'news',
						'module_auth'		=> ''
					);
					$modules->update_module_data($news);
					$announcements = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_ANNOUNCE_INFO',
						'module_mode'		=> 'announcements',
						'module_auth'		=> ''
					);
					$modules->update_module_data($announcements);
					$welcome = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_WELCOME_INFO',
						'module_mode'		=> 'welcome',
						'module_auth'		=> ''
					);
					$modules->update_module_data($welcome);
					$recent = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_RECENT_INFO',
						'module_mode'		=> 'recent',
						'module_auth'		=> ''
					);
					$modules->update_module_data($recent);
					$wordgraph = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_WORDGRAPH_INFO',
						'module_mode'		=> 'wordgraph',
						'module_auth'		=> ''
					);
					$modules->update_module_data($wordgraph);
					$paypal = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_PAYPAL_INFO',
						'module_mode'		=> 'paypal',
						'module_auth'		=> ''
					);
					$modules->update_module_data($paypal);
					$attachments = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO',
						'module_mode'		=> 'attachments',
						'module_auth'		=> ''
					);
					$modules->update_module_data($attachments);
					$members = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_MEMBERS_INFO',
						'module_mode'		=> 'members',
						'module_auth'		=> ''
					);
					$modules->update_module_data($members);
					$polls = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_POLLS_INFO',
						'module_mode'		=> 'polls',
						'module_auth'		=> ''
					);
					$modules->update_module_data($polls);
					$bots = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_BOTS_INFO',
						'module_mode'		=> 'bots',
						'module_auth'		=> ''
					);
					$modules->update_module_data($bots);
					$poster = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_MOST_POSTER_INFO',
						'module_mode'		=> 'poster',
						'module_auth'		=> ''
					);
					$modules->update_module_data($poster);
					$minicalendar = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_MINICALENDAR_INFO',
						'module_mode'		=> 'minicalendar',
						'module_auth'		=> ''
					);
					$modules->update_module_data($minicalendar);
					$customblock = array(
						'module_basename'	=> 'portal',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_CUSTOM_INFO',
						'module_mode'		=> 'customblock',
						'module_auth'		=> ''
					);
					$modules->update_module_data($customblock);
					$linkblock = array(
						'module_basename'   => 'portal',
						'module_enabled'   => 1,
						'module_display'   => 1,
						'parent_id'         => $portal['module_id'],
						'module_class'      => 'acp',
						'module_langname'   => 'ACP_PORTAL_LINKS_INFO',
						'module_mode'      => 'links',
						'module_auth'      => ''
					);
					$modules->update_module_data($linkblock);
					$palletlist = array(
						'module_basename'	=> 'pallet',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PALLET_LIST_INFO',
						'module_mode'		=> 'list',
						'module_auth'		=> ''
					);
					$modules->update_module_data($palletlist);
					$portallayout = array(
						'module_basename'	=> 'pallet',
						'module_enabled'	=> 1,
						'module_display'	=> 1,
						'parent_id'			=> $portal['module_id'],
						'module_class'		=> 'acp',
						'module_langname'	=> 'ACP_PORTAL_LAYOUT_INFO',
						'module_mode'		=> 'layout',
						'module_auth'		=> ''
					);
					$modules->update_module_data($portallayout);						
		
					// clear cache and log what we did
					$cache->purge();
					add_log('admin', $page_title . ' updated');
					$updated = true;
				}
				else
				{
					$portal_update_array = array();
	
					include $phpbb_root_path.'install_portal/schemas/update_schema.'.$phpEx;

					foreach( $sql_update as $sql_ver => $sql_data )
					{
						if( version_compare(strtolower($old_version), strtolower($sql_ver), ">=") === TRUE )
						{
							continue;
						} else {
							$portal_update_array = array_merge($portal_update_array, $sql_data);
						}
					}
	
					$portal_update_array[] = 'UPDATE ' . PORTAL_CONFIG_TABLE . " SET config_value='{$current_version}' WHERE config_name = 'portal_version'";
					
					if( $old_version == '1.0.0' )
					{
						$chk_sql = 'SELECT config_value FROM ' . PORTAL_CONFIG_TABLE . "	WHERE config_name = 'portal_show_announcements_replies_views'";
						$chk_result = @$db->sql_query_limit( $chk_sql, 1 );
						$chk_config = $db->sql_fetchrow( $chk_result );
						if( !sizeof( $chk_config ) )
						{
							$portal_update_array[] = 'INSERT ' . PORTAL_CONFIG_TABLE . 	" (config_name, config_value) VALUES ('portal_show_announcements_replies_views', '1');";
						}
						
						$chk_sql = 'SELECT config_value FROM ' . PORTAL_CONFIG_TABLE . "	WHERE config_name = 'portal_show_news_replies_views'";
						$chk_result = @$db->sql_query_limit( $chk_sql, 1 );
						$chk_config = $db->sql_fetchrow( $chk_result );
						if( !sizeof( $chk_config ) )
						{
							$portal_update_array[] = 'INSERT ' . PORTAL_CONFIG_TABLE . 	" (config_name, config_value) VALUES ('portal_show_news_replies_views', '1');";
						}
						
						$chk_sql = 'SELECT config_value FROM ' . PORTAL_CONFIG_TABLE . "	WHERE config_name = 'portal_leaders_ext'";
						$chk_result = @$db->sql_query_limit( $chk_sql, 1 );
						$chk_config = $db->sql_fetchrow( $chk_result );
						if( !sizeof( $chk_config ) )
						{
							$portal_update_array[] = 'INSERT ' . PORTAL_CONFIG_TABLE . 	" (config_name, config_value) VALUES ('portal_leaders_ext', '0');";
						}
					}
	
					foreach($portal_update_array as $sql)
					{
						$sql = preg_replace('#phpbb_#i', $table_prefix, $sql);
						if (!$db->sql_query($sql))
						{
							$error = $db->sql_error();
							db_error($error['message'], $sql, __LINE__, __FILE__);
						}
					}
					unset($portal_update_array, $sql_update);
					
					// create new acp modules
					$modules = new acp_modules();
					$sql = 'SELECT module_id FROM ' . MODULES_TABLE . " WHERE module_langname = 'ACP_PORTAL_INFO' LIMIT 1";
					$result = $db->sql_query($sql);
					$portal = $db->sql_fetchrow($result);
					
					foreach( $mod_update as $mod_ver => $mod_data )
					{
						if( version_compare($old_version, $mod_ver, ">=") === TRUE )
						{
							continue;
						} else {
							foreach( $mod_data as $mod_config)
							{
								$mod_config['parent_id'] = $portal['module_id'];
								$modules->update_module_data($mod_config);
							}
						}
					}

					// clear cache and log what we did
					$cache->purge();
					add_log('admin', $page_title . ' updated');
					$updated = true;
				}
			}
			include($phpbb_root_path . 'install_portal/style/layout_update.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'install_portal/style/layout_menu.'.$phpEx);
		}
	
	break;
	// Uninstalling
	case 'uninstall':
		if( $old_version != 0 )
		{
			if( $confirm == 1)
			{
				if( $phpbb3portal === FALSE )
				{
					// Drop thes tables if existing
					switch( $db->sql_layer )
					{
						case 'mysql4':
						case 'mysqli':
						case 'oracle':
						case 'firebird':
						case 'sqlite':
						case 'mysql':
							$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
							$result = $db->sql_query($sql);
							$db->sql_freeresult($result);
						break;
						case '':
							$sql = 'SELECT version() as version';
							$result = $db->sql_query($sql);
							$data = $db->sql_fetchrow($result);
							if( version_compare($data['version'], '8.1.11', '>') === TRUE )
							{
								$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
								$result = $db->sql_query($sql);
								$db->sql_freeresult($result);
							} else {
								$sql = 'DROP TABLE ' . $table_prefix . 'portal_config';
								$result = @$db->sql_query($sql);
								$db->sql_freeresult($result);
							}
						break;
						case 'mssql':
							$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'portal_config)
							drop table ' . $table_prefix . 'portal_config';
							$result = $db->sql_query($sql);
							$db->sql_freeresult($result);
						break;
					}
	
					$sql = 'SELECT right_id, module_id FROM ' . MODULES_TABLE . "
						WHERE module_langname = 'ACP_PORTAL_GENERAL_INFO'
							OR module_langname = 'ACP_PORTAL_NEWS_INFO'
							OR module_langname = 'ACP_PORTAL_ANNOUNCE_INFO'
							OR module_langname = 'ACP_PORTAL_WELCOME_INFO'
							OR module_langname = 'ACP_PORTAL_RECENT_INFO'
							OR module_langname = 'ACP_PORTAL_WORDGRAPH_INFO'
							OR module_langname = 'ACP_PORTAL_PAYPAL_INFO'
							OR module_langname = 'ACP_PORTAL_ADS_INFO'
							OR module_langname = 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'
							OR module_langname = 'ACP_PORTAL_MEMBERS_INFO'
							OR module_langname = 'ACP_PORTAL_POLLS_INFO'
							OR module_langname = 'ACP_PORTAL_BOTS_INFO'
							OR module_langname = 'ACP_PORTAL_MOST_POSTER_INFO'
							OR module_langname = 'ACP_PORTAL_MINICALENDAR_INFO'
							OR module_langname = 'ACP_PORTAL_CUSTOM_INFO'
							OR module_langname = 'ACP_PORTAL_LINKS_INFO'
							OR module_langname = 'ACP_PALLET_LIST_INFO'
							OR module_langname = 'ACP_PORTAL_LAYOUT_INFO'
							";
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$sql = 'DELETE FROM ' . MODULES_TABLE . " WHERE module_id = '{$row['module_id']}'";
						$db->sql_query($sql);
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET left_id = left_id - 2
							WHERE module_class = 'acp'
								AND left_id > {$row['right_id']}";
						$db->sql_query($sql);
		
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET right_id = right_id - 2
							WHERE module_class = 'acp'
								AND right_id > {$row['right_id']}";
						$db->sql_query($sql);
					}
					$db->sql_freeresult($result);
	
					$sql = 'SELECT right_id, module_id FROM ' . MODULES_TABLE . "
						WHERE module_langname = 'ACP_PORTAL_INFO'";
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$sql = 'DELETE FROM ' . MODULES_TABLE . " WHERE module_id = '{$row['module_id']}'";
						$db->sql_query($sql);
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET left_id = left_id - 2
							WHERE module_class = 'acp'
								AND left_id > {$row['right_id']}";
						$db->sql_query($sql);
		
						$sql = 'UPDATE ' . MODULES_TABLE . "
							SET right_id = right_id - 2
							WHERE module_class = 'acp'
								AND right_id > {$row['right_id']}";
						$db->sql_query($sql);
					}
					$db->sql_freeresult($result);

					// clear cache and log what we did
					$cache->purge();
					add_log('admin', $page_title . ' uninstalled');
					$uninstalled = true;
				}
				else
				{
					include($phpbb_root_path . 'install_portal/style/layout_header.'.$phpEx);
					echo '<h1>' . $user->lang['INSTALLER_ERROR'] . '</h1>';
					echo '<p>' . $user->lang['INSTALLER_UNINSTALL_OLDVERSION'] . '</p>';
					include($phpbb_root_path . 'install_portal/style/layout_footer.'.$phpEx);
				}
			}
			include($phpbb_root_path . 'install_portal/style/layout_uninstall.'.$phpEx);
		} else {
			include($phpbb_root_path . 'install_portal/style/layout_menu.'.$phpEx);
		}
	
	break;
	// Welcome page!
	default:
	
		include($phpbb_root_path . 'install_portal/style/layout_menu.'.$phpEx);
	
	break;
	}
}	
else
{
	echo '<p>' . login_box('', $user->lang['INSTALLER_NEEDS_ADMIN']);
}

?>
