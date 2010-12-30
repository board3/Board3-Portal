<?php
/**
*
* @package - Board3portal
* @version $Id: install_update.php 661 2010-07-11 12:34:49Z marc1706 $
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

if (!empty($setmodules))
{
	if (!$this->installed_version || $this->installed_version == NEWEST_B3P_VERSION)
	{
		return;
	}

	$module[] = array(
		'module_type'		=> 'update',
		'module_title'		=> 'UPDATE',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 20,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'REQUIREMENTS', 'UPDATE_DB', 'ADVANCED', 'FINAL'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/
class install_update extends module
{
	function install_update(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($mode, $sub)
	{
		global $user, $template, $phpbb_root_path, $cache, $phpEx;

		$portal_config = load_portal_config();

		switch ($sub)
		{
			case 'intro':
				$this->page_title = $user->lang['SUB_INTRO'];

				$template->assign_vars(array(
					'TITLE'			=> $user->lang['UPDATE_INSTALLATION'],
					'BODY'			=> $user->lang['UPDATE_INSTALLATION_EXPLAIN'],
					'L_SUBMIT'		=> $user->lang['NEXT_STEP'],
					'U_ACTION'		=> $this->p_master->module_url . "?mode=$mode&amp;sub=requirements",
				));

			break;

			case 'requirements':
				$this->check_server_requirements($mode, $sub);

			break;

			case 'update_db':
				$this->update_db_schema($mode, $sub);

			break;

			case 'advanced':
				$this->obtain_advanced_settings($mode, $sub);

			break;

			case 'final':
				set_portal_config('portal_version', NEWEST_B3P_VERSION);
				$cache->purge();

				$template->assign_vars(array(
					'TITLE'		=> $user->lang['INSTALL_CONGRATS'],
					'BODY'		=> sprintf($user->lang['UPDATE_CONGRATS_EXPLAIN'], NEWEST_B3P_VERSION),
					'L_SUBMIT'	=> $user->lang['GOTO_PORTAL'],
					'U_ACTION'	=> append_sid($phpbb_root_path . 'portal.' . $phpEx),
				));


			break;
		}

		$this->tpl_name = 'install_install';
	}

	/**
	* Checks that the server we are installing on meets the requirements for running phpBB
	*/
	function check_server_requirements($mode, $sub)
	{
		global $user, $template, $phpbb_root_path, $phpEx;

		$this->page_title = $user->lang['STAGE_REQUIREMENTS'];

		$passed = array('files' => false,);

		// Check whether all old files are deleted
		include($phpbb_root_path . 'install/outdated_files.' . $phpEx);

		umask(0);

		$passed['files'] = true;
		foreach ($oudated_files as $file)
		{
			if (@file_exists($phpbb_root_path . $file))
			{
				if ($passed['files'])
				{
					$template->assign_block_vars('checks', array(
						'S_LEGEND'			=> true,
						'LEGEND'			=> $user->lang['FILES_OUTDATED'],
						'LEGEND_EXPLAIN'	=> $user->lang['FILES_OUTDATED_EXPLAIN'],
					));
				}
				$template->assign_block_vars('checks', array(
					'TITLE'		=> $file,
					'RESULT'	=> '<strong style="color:red">' . $user->lang['FILES_EXISTS'] . '</strong>',

					'S_EXPLAIN'	=> false,
					'S_LEGEND'	=> false,
				));
				$passed['files'] = false;
			}
		}

		$url = (!in_array(false, $passed)) ? $this->p_master->module_url . "?mode=$mode&amp;sub=update_db" : $this->p_master->module_url . "?mode=$mode&amp;sub=requirements";
		$submit = (!in_array(false, $passed)) ? $user->lang['INSTALL_START'] : $user->lang['INSTALL_TEST'];
		$body = (!in_array(false, $passed)) ? $user->lang['NOT_REQUIREMENTS_EXPLAIN'] : $user->lang['REQUIREMENTS_EXPLAIN'];

		$template->assign_vars(array(
			'TITLE'		=> $user->lang['REQUIREMENTS_TITLE'],
			'BODY'		=> $body,
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> '',
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Add some Tables, Columns and Index to the database-schema
	*/
	function update_db_schema($mode, $sub)
	{
		global $db, $user, $template, $portal_config, $table_prefix, $phpbb_root_path, $phpEx, $cache;
		include($phpbb_root_path . 'includes/acp/auth.' . $phpEx);

		$portal_config = load_portal_config();
		$this->page_title = $user->lang['STAGE_UPDATE_DB'];
		$reparse_modules = false;
	
		switch ($portal_config['portal_version'])
		{
			case '0.1.0':
			case '0.2.0':
			case '0.2.1':
				set_portal_config('portal_poll_limit', '3');
				set_portal_config('portal_poll_allow_vote', '1');
				set_portal_config('portal_birthdays_ahead', '7');
				b3p_change_column(PORTAL_CONFIG_TABLE,	'config_value',	array('MTEXT_UNI', ''));

			case '0.2.2':
				set_portal_config('portal_attachments_forum_ids', '');
				$reparse_modules = true;

			// 0.3.0 was the internal release of 1.0.0RC1
			case '0.3.0':
			case '1.0.0RC1':
				set_portal_config('portal_announcements_permissions', '1');
				set_portal_config('portal_news_permissions', '1');
				set_portal_config('portal_custom_center', '0');
				set_portal_config('portal_custom_small', '0');
				set_portal_config('portal_custom_code_center', '');
				set_portal_config('portal_custom_code_small', '');
				set_portal_config('portal_custom_center_bbcode', '0');
				set_portal_config('portal_custom_small_bbcode', '0');
				set_portal_config('portal_custom_center_headline', 'Headline center box');
				set_portal_config('portal_custom_small_headline', 'Headline small box');
				set_portal_config('portal_forum_index', '0');
				set_portal_config('portal_news_show_last', '0');
				set_portal_config('portal_news_archive', '1');
				set_portal_config('portal_announcements_archive', '1');
				set_portal_config('portal_links_array', 'a:2:{i:1;a:2:{s:4:"text";s:9:"Board3.de";s:3:"url";s:21:"http://www.board3.de/";}i:2;a:2:{s:4:"text";s:9:"phpBB.com";s:3:"url";s:21:"http://www.phpbb.com/";}}');

			case '1.0.0RC2':
				set_portal_config('portal_leaders_ext', '0');

				$sql = 'UPDATE ' . PORTAL_CONFIG_TABLE . "
					SET config_name = 'portal_right_column_width' 
					WHERE config_name = 'portal_right_collumn_width'";
				$result = $db->sql_query($sql);
				$sql = 'UPDATE ' . PORTAL_CONFIG_TABLE . "
					SET config_name = 'portal_left_column_width' 
					WHERE config_name = 'portal_left_collumn_width'";
				$result = $db->sql_query($sql);

				
			case '1.0.0RC3':
				set_portal_config('portal_show_announcements_replies_views', '1');
				set_portal_config('portal_show_news_replies_views', '1');

			case '1.0.0':
			case '1.0.1':
			case '1.0.2':
				set_portal_config('portal_enable', '1');
				set_portal_config('portal_phpbb_menu', '0');
				set_portal_config('portal_minicalendar_today_color', '#FF0000');
				set_portal_config('portal_minicalendar_day_link_color', '#006F00');
				set_portal_config('portal_poll_hide', '0');

				// Add permissions
				$auth_admin = new auth_admin();
				$auth_admin->acl_add_option(array(
					'local'			=> array(),
					'global'		=> array('a_portal_manage')
				));
				$cache->destroy('acl_options');

				$sql = 'SELECT auth_option_id FROM ' . ACL_OPTIONS_TABLE . "
					WHERE auth_option = 'a_portal_manage'";
				$result = $db->sql_query($sql);
				$auth_option_id = $db->sql_fetchfield('auth_option_id');
				$db->sql_freeresult($result);

				$sql = 'SELECT role_id FROM ' . ACL_ROLES_TABLE . "
					WHERE role_name = 'ROLE_ADMIN_FULL'";
				$result = $db->sql_query($sql);
				$role_id = (int) $db->sql_fetchfield('role_id');
				$db->sql_freeresult($result);

				// Give the wanted role its option
				$roles_data = array(
					'role_id'			=> $role_id,
					'auth_option_id'	=> $auth_option_id,
					'auth_setting'		=> 1,
				);

				$sql = 'INSERT INTO ' . ACL_ROLES_DATA_TABLE . ' ' . $db->sql_build_array('INSERT', $roles_data);
				$db->sql_query($sql);

				// Update the ACP-Modules permissions
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_GENERAL_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_NEWS_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage',
					module_langname = 'ACP_PORTAL_ANNOUNCEMENTS_INFO'
					WHERE module_langname = 'ACP_PORTAL_ANNOUNCE_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_WELCOME_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_RECENT_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_WORDGRAPH_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_PAYPAL_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage',
					module_langname = 'ACP_PORTAL_ATTACHMENTS_INFO'
					WHERE module_langname = 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_MEMBERS_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_POLLS_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_BOTS_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage',
					module_langname = 'ACP_PORTAL_POSTER_INFO'
					WHERE module_langname = 'ACP_PORTAL_MOST_POSTER_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_MINICALENDAR_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage',
					module_langname = 'ACP_PORTAL_CUSTOMBLOCK_INFO'
					WHERE module_langname = 'ACP_PORTAL_CUSTOM_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_LINKS_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_FRIENDS_INFO'";
				$db->sql_query($sql);
				$sql = 'UPDATE ' . MODULES_TABLE . " SET
					module_auth = 'acl_a_portal_manage'
					WHERE module_langname = 'ACP_PORTAL_BIRTHDAYS_INFO'";
				$db->sql_query($sql);
				
				$reparse_modules = true;
			case '1.0.3':
				//remove the columns
				$old_portal_configs = array('portal_minicalendar_day_link_color');
				$sql = 'DELETE FROM ' . PORTAL_CONFIG_TABLE . '
					WHERE ' . $db->sql_in_set('config_name', $old_portal_configs);
				$db->sql_query($sql);

				// Set default config
				set_portal_config('portal_minicalendar_today_color', '#000000');
				set_portal_config('portal_minicalendar_sunday_color', '#FF0000');
				set_portal_config('portal_sunday_first', '1');
				set_portal_config('portal_long_month', '0');
				set_portal_config('portal_attach_max_length', '15');
				set_portal_config('portal_version_check', '1');
				set_portal_config('version_check_time', '0');
				set_portal_config('version_check_version', '0.0.0');

			case '1.0.4RC1':
			case '1.0.4RC2':
			case '1.0.4RC3':
			case '1.0.4':
				set_portal_config('portal_left_column', '1');
				set_portal_config('portal_right_column', '1');
				set_portal_config('portal_news_exclude', '0');
				set_portal_config('portal_announcements_forum_exclude', '0');
				set_portal_config('portal_exclude_forums', '1');
				set_portal_config('portal_recent_forum', '');
				set_portal_config('portal_attachments_forum_exclude', '0');
				set_portal_config('portal_attachments_filetype', '');
				set_portal_config('portal_attachments_exclude', '0');
				set_portal_config('portal_poll_exclude_id', '0');
			break;
			
			case '1.0.5':
				// Nothing to update in the database
		}

		if (!$this->acp_parent_module)
		{
			$sql = 'SELECT module_id
				FROM ' . MODULES_TABLE . "
				WHERE module_langname = 'ACP_PORTAL_INFO'";
			$result = $db->sql_query($sql);
			while ($row = $db->sql_fetchrow($result))
			{
				set_portal_config('acp_parent_module', $row['module_id']);
			}
		}
		set_portal_config('portal_version', $portal_config['portal_version']);

		if ($reparse_modules)
		{
			$next_update_url = $this->p_master->module_url . "?mode=$mode&amp;sub=advanced";
		}
		else
		{
			$next_update_url = $this->p_master->module_url . "?mode=$mode&amp;sub=final";
		}
	
		$template->assign_vars(array(
			'TITLE'		=> $user->lang['STAGE_CREATE_TABLE'],
			'BODY'		=> $user->lang['STAGE_CREATE_TABLE_EXPLAIN'],
			'L_SUBMIT'	=> $user->lang['NEXT_STEP'],
			'S_HIDDEN'	=> '',
			'U_ACTION'	=> $next_update_url,
		));
	}

	/**
	* Provide an opportunity to customise some advanced settings during the install
	* in case it is necessary for them to be set to access later
	*/
	function obtain_advanced_settings($mode, $sub)
	{
		global $user, $template, $portal_config, $phpEx, $db;
		$portal_config = load_portal_config();
		
		$create = request_var('create', '');
		if ($create)
		{
			// Add modules
			$choosen_acp_module = request_var('acp_module', 0);

			switch ($portal_config['portal_version'])
			{
				case '0.1.0':
				case '0.2.0':
				case '0.2.1':
				case '0.2.2':
					$acp_portal_customblock = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $portal_config['acp_parent_module'],	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_CUSTOMBLOCK_INFO',	'module_mode' => 'customblock',	'module_auth' => 'acl_a_portal_manage');
					add_module($acp_portal_customblock);
					$acp_portal_linkblock = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $portal_config['acp_parent_module'],	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_LINKS_INFO',	'module_mode' => 'links',	'module_auth' => 'acl_a_portal_manage');
					add_module($acp_portal_linkblock);

				case '0.3.0':
				case '1.0.0RC1':
				case '1.0.0RC2':
				case '1.0.0RC3':
				case '1.0.0':
				case '1.0.1':
				case '1.0.2':
					$acp_portal_friends = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $portal_config['acp_parent_module'],	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_FRIENDS_INFO',	'module_mode' => 'friends',	'module_auth' => 'acl_a_portal_manage');
					add_module($acp_portal_friends);
					$acp_portal_birthdays = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $portal_config['acp_parent_module'],	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_BIRTHDAYS_INFO',	'module_mode' => 'birthdays',	'module_auth' => 'acl_a_portal_manage');
					add_module($acp_portal_birthdays);
				case '1.0.3':
				case '1.0.4RC1':
				case '1.0.4RC2':
				case '1.0.4RC3':
				case '1.0.4':
				case '1.0.5':
					// Nothing to update
				break;
			}

			$s_hidden_fields = '';
			$url = $this->p_master->module_url . "?mode=$mode&amp;sub=final";
		}
		else
		{
			$data = array(
				'acp_module'		=> 31,
			);

			$modules = $this->portal_config_options;

			foreach ($modules as $config_key => $vars)
			{
				if (!is_array($vars) && strpos($config_key, 'legend') === false)
				{
					continue;
				}

				if (strpos($config_key, 'legend') !== false)
				{
					$template->assign_block_vars('options', array(
						'S_LEGEND'		=> true,
						'LEGEND'		=> $user->lang[$vars])
					);

					continue;
				}

				$options = isset($vars['options']) ? $vars['options'] : '';
				$template->assign_block_vars('options', array(
					'KEY'			=> $config_key,
					'TITLE'			=> $user->lang[$vars['lang']],
					'S_EXPLAIN'		=> $vars['explain'],
					'S_LEGEND'		=> false,
					'TITLE_EXPLAIN'	=> ($vars['explain']) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '',
					'CONTENT'		=> $this->p_master->input_field($config_key, $vars['type'], $data[$config_key], $options),
					)
				);
			}
			$s_hidden_fields = '<input type="hidden" name="create" value="true" />';
			$url = $this->p_master->module_url . "?mode=$mode&amp;sub=advanced";
		}

		$submit = $user->lang['NEXT_STEP'];

		$template->assign_vars(array(
			'TITLE'		=> $user->lang['STAGE_ADVANCED'],
			'BODY'		=> (!$create) ? $user->lang['STAGE_ADVANCED_EXPLAIN'] : $user->lang['STAGE_ADVANCED_SUCCESSFUL'],
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> $s_hidden_fields,
			'U_ACTION'	=> $url,
		));
	}

	/**
	* The information below will be used to build the input fields presented to the user
	*/
	var $portal_config_options = array(
		'legend1'				=> 'MODULES_PARENT_SELECT',
		'acp_module'			=> array('lang' => 'MODULES_SELECT_4ACP', 'type' => 'select', 'options' => 'module_select(\'acp\', 31, \'ACP_CAT_DOT_MODS\')', 'explain' => false),
	);
}

?>