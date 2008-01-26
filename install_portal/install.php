<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->add_lang('mods/portal_install');
$new_mod_version = '0.1.0';
$page_title = 'Board3portal v' . $new_mod_version;

$mode = request_var('mode', 'else', true);
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
// What sql_layer should we use?
switch ($db->sql_layer)
{
	case 'mysql':
		$db_schema = 'mysql_40';
		$delimiter = ';';
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
	break;

	case 'mysqli':
		$db_schema = 'mysql_41';
		$delimiter = ';';
	break;

	case 'mssql':
		$db_schema = 'mssql';
		$delimiter = 'GO';
	break;

	case 'postgres':
		$db_schema = 'postgres';
		$delimiter = ';';
	break;

	case 'sqlite':
		$db_schema = 'sqlite';
		$delimiter = ';';
	break;

	case 'firebird':
		$db_schema = 'firebird';
		$delimiter = ';;';
	break;

	case 'oracle':
		$db_schema = 'oracle';
		$delimiter = '/';
	break;

	default:
		trigger_error('Sorry, unsupportet Databases found.');
	break;
}
switch ($mode)
{
	case 'install':
		$install = request_var('install', 0);
		$installed = false;
		if ($install == 1)
		{
			// Drop thes tables if existing
			if ($db->sql_layer != 'mssql')
			{
				$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			else
			{
				$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'portal_config)
				drop table ' . $table_prefix . 'portal_config';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			// locate the schema files
			$dbms_schema = 'schemas/_' . $db_schema . '_schema.sql';
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

			// Tadaa! Fill all data in ;-)
			$sql_query = file_get_contents('schemas/_schema_data.sql');
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

			foreach ($sql_query as $sql)
			{
				if (!$db->sql_query($sql))
				{
					$error = $db->sql_error();
					$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
				}
			}
			unset($sql_query);

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
			// clear cache and log what we did
			$cache->purge();
			add_log('admin', $page_title . ' installed');
			$installed = true;
		}
	break;
	case 'update110b':
		$update = request_var('update', 0);
		$version = request_var('v', '0', true);
		$updated = false;
		if ($update == 1)
		{
			// Drop thes tables if existing
			if ($db->sql_layer != 'mssql')
			{
				$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'portal_config';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			else
			{
				$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'portal_config)
				drop table ' . $table_prefix . 'portal_config';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			// locate the schema files
			$dbms_schema = 'schemas/_' . $db_schema . '_schema.sql';
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

			// Tadaa! Fill all data in ;-)
			$sql_query = file_get_contents('schemas/_schema_data.sql');
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

			foreach ($sql_query as $sql)
			{
				if (!$db->sql_query($sql))
				{
					$error = $db->sql_error();
					$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
				}
			}
			unset($sql_query);
			

			//fill the table, but with the old settings
			$sql = 'SELECT * FROM ' . PORTAL_CONFIG_TABLE;
			$result = $db->sql_query($sql);
			while ($row = $db->sql_fetchrow($result))
			{
				if (isset($config[$row['config_name']]))
				{
					$sql2 = 'UPDATE ' . PORTAL_CONFIG_TABLE . " SET config_value = '" . $config[$row['config_name']] . "' WHERE config_name = '" . $row['config_name'] . "' LIMIT 1";
					$db->sql_query($sql2);
				}
			}
			$db->sql_freeresult($result);
			$sql = 'UPDATE ' . PORTAL_CONFIG_TABLE . " SET config_value = '" . $new_mod_version . "' WHERE config_name = 'portal_version' LIMIT 1";
			$db->sql_query($sql);


			//set back the config_table Oo
			$sql = "ALTER TABLE {$table_prefix}config CHANGE config_value config_value varchar(255) NOT NULL";
			$db->sql_query($sql);
			$sql = 'DELETE FROM ' . CONFIG_TABLE . " WHERE config_name = 'portal_welcome_intro'
				OR config_name = 'portal_max_online_friends'
				OR config_name = 'portal_max_most_poster'
				OR config_name = 'portal_max_last_member'
				OR config_name = 'portal_welcome'
				OR config_name = 'portal_links'
				OR config_name = 'portal_link_us'
				OR config_name = 'portal_clock'
				OR config_name = 'portal_random_member'
				OR config_name = 'portal_latest_members'
				OR config_name = 'portal_top_posters'
				OR config_name = 'portal_leaders'
				OR config_name = 'portal_advanced_stat'
				OR config_name = 'portal_version'
				OR config_name = 'portal_right_collumn_width'
				OR config_name = 'portal_left_collumn_width'
				OR config_name = 'portal_poll_topic'
				OR config_name = 'portal_poll_topic_id'
				OR config_name = 'portal_last_visited_bots_number'
				OR config_name = 'portal_load_last_visited_bots'
				OR config_name = 'portal_pay_acc'
				OR config_name = 'portal_pay_s_block'
				OR config_name = 'portal_pay_c_block'
				OR config_name = 'portal_recent'
				OR config_name = 'portal_recent_title_limit'
				OR config_name = 'portal_max_topics'
				OR config_name = 'portal_exclude_forums'
				OR config_name = 'portal_news_forum'
				OR config_name = 'portal_news_length'
				OR config_name = 'portal_number_of_news'
				OR config_name = 'portal_show_all_news'
				OR config_name = 'portal_news'
				OR config_name = 'portal_news_style'
				OR config_name = 'portal_announcements'
				OR config_name = 'portal_announcements_style'
				OR config_name = 'portal_number_of_announcements'
				OR config_name = 'portal_announcements_day'
				OR config_name = 'portal_announcements_length'
				OR config_name = 'portal_global_announcements_forum'
				OR config_name = 'portal_wordgraph_word_counts'
				OR config_name = 'portal_wordgraph_max_words'
				OR config_name = 'portal_wordgraph'
				OR config_name = 'portal_wordgraph_ratio'
				OR config_name = 'portal_minicalendar'
				OR config_name = 'portal_minicalendar_today_color'
				OR config_name = 'portal_minicalendar_day_link_color'
				OR config_name = 'portal_attachments'
				OR config_name = 'portal_attachments_number'";
			$db->sql_query($sql);

			$sql = 'SELECT right_id, module_id FROM ' . MODULES_TABLE . "
				WHERE module_langname = 'ACP_PORTAL_GENERAL_INFO'
					OR module_langname = 'ACP_PORTAL_NEWS_INFO'
					OR module_langname = 'ACP_PORTAL_ANNOUNCE_INFO'
					OR module_langname = 'ACP_PORTAL_WELCOME_INFO'
					OR module_langname = 'ACP_PORTAL_RECENT_INFO'
					OR module_langname = 'ACP_PORTAL_WORDGRAPH_INFO'
					OR module_langname = 'ACP_PORTAL_PAYPAL_INFO'
					OR module_langname = 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'
					OR module_langname = 'ACP_PORTAL_MEMBERS_INFO'
					OR module_langname = 'ACP_PORTAL_POLLS_INFO'
					OR module_langname = 'ACP_PORTAL_BOTS_INFO'
					OR module_langname = 'ACP_PORTAL_MOST_POSTER_INFO'
					OR module_langname = 'ACP_PORTAL_MINICALENDAR_INFO'";
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

			// clear cache and log what we did
			$cache->purge();
			add_log('admin', $page_title . ' updated');
			$updated = true;
		}
	break;
	default:
		//we had a little cheater
	break;
}

include($phpbb_root_path . 'install_portal/layout.'.$phpEx);
?>