<?php
/**
*
* @package - Board3portal
* @version $Id: install_convert.php 588 2009-12-04 17:16:46Z marc1706 $
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
	if ($this->installed_version || !$this->installed_p3p_version)
	{
		return;
	}

	$module[] = array(
		'module_type'		=> 'convert',
		'module_title'		=> 'CONVERT',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 30,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'REQUIREMENTS', 'REMOVE_P3P', 'CREATE_TABLE', 'ADVANCED', 'FINAL'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/
class install_convert extends module
{
	function install_convert(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($mode, $sub)
	{
		global $user, $template, $phpbb_root_path, $cache, $phpEx;

		switch ($sub)
		{
			case 'intro':
				$this->page_title = $user->lang['SUB_INTRO'];

				$template->assign_vars(array(
					'TITLE'			=> $user->lang['CONVERT_P3P_INTRO'],
					'BODY'			=> '',
					'L_SUBMIT'		=> $user->lang['NEXT_STEP'],
					'U_ACTION'		=> $this->p_master->module_url . "?mode=$mode&amp;sub=requirements",
				));

			break;

			case 'requirements':
				$this->check_server_requirements($mode, $sub);

			break;

			case 'remove_p3p':
				$this->remove_phpbb3_portal($mode, $sub);

			break;

			case 'create_table':
				$this->load_schema($mode, $sub);
			break;

			case 'advanced':
				$this->obtain_advanced_settings($mode, $sub);

			break;

			case 'final':
				set_portal_config('portal_version', NEWEST_B3P_VERSION);
				$cache->purge();

				$template->assign_vars(array(
					'TITLE'		=> $user->lang['INSTALL_CONGRATS'],
					'BODY'		=> sprintf($user->lang['CONVERT_COMPLETE_EXPLAIN'], NEWEST_B3P_VERSION),
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

		$url = (!in_array(false, $passed)) ? $this->p_master->module_url . "?mode=$mode&amp;sub=remove_p3p" : $this->p_master->module_url . "?mode=$mode&amp;sub=requirements";
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
	* Remove phpBB3 Portal a.k.a Canver Portal first....
	*/
	function remove_phpbb3_portal($mode, $sub)
	{
		global $db, $user, $template, $table_prefix, $phpbb_root_path, $phpEx, $cache;

		$this->page_title = $user->lang['STAGE_REMOVE_P3P'];
		
		$old_configs = array('portal_welcome_intro', 'portal_max_online_friends', 'portal_max_most_poster', 'portal_max_last_member', 'portal_welcome', 'portal_links', 'portal_link_us', 'portal_clock', 'portal_random_member', 'portal_latest_members', 'portal_top_posters', 'portal_leaders', 'portal_advanced_stat', 'portal_version', 'portal_right_collumn_width', 'portal_left_collumn_width', 'portal_poll_topic', 'portal_poll_topic_id', 'portal_last_visited_bots_number',
			'portal_load_last_visited_bots', 'portal_pay_acc', 'portal_pay_s_block', 'portal_pay_c_block', 'portal_recent', 'portal_recent_title_limit', 'portal_max_topics', 'portal_exclude_forums', 'portal_active', 'portal_news_forum', 'portal_news_length', 'portal_number_of_news', 'portal_show_all_news', 'portal_news', 'portal_news_style', 'portal_announcements', 'portal_announcements_style', 'portal_number_of_announcements', 'portal_announcements_day', 'portal_announcements_length',
			'portal_global_announcements_forum', 'portal_wordgraph_word_counts', 'portal_wordgraph_max_words', 'portal_wordgraph', 'portal_wordgraph_ratio', 'portal_minicalendar', 'portal_minicalendar_today_color', 'portal_minicalendar_day_link_color', 'portal_attachments', 'portal_attachments_number', 'portal_ads_small', 'portal_ads_small_box', 'portal_ads_center', 'portal_ads_center_box', 'portal_poll_limit', 'portal_poll_allow_vote');
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $old_configs);
		$db->sql_query($sql);
	
		b3p_change_column(CONFIG_TABLE,	'config_value',	array('VCHAR_UNI', ''));
	
		$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
			WHERE module_langname = 'ACP_PORTAL_GENERAL_INFO'
				OR module_langname = 'ACP_PORTAL_NEWS_INFO'
				OR module_langname = 'ACP_PORTAL_ANNOUNCE_INFO'
				OR module_langname = 'ACP_PORTAL_ANNOUNCEMENTS_INFO'
				OR module_langname = 'ACP_PORTAL_WELCOME_INFO'
				OR module_langname = 'ACP_PORTAL_RECENT_INFO'
				OR module_langname = 'ACP_PORTAL_WORDGRAPH_INFO'
				OR module_langname = 'ACP_PORTAL_PAYPAL_INFO'
				OR module_langname = 'ACP_PORTAL_ADS_INFO'
				OR module_langname = 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'
				OR module_langname = 'ACP_PORTAL_ATTACHMENTS_INFO'
				OR module_langname = 'ACP_PORTAL_MEMBERS_INFO'
				OR module_langname = 'ACP_PORTAL_POLLS_INFO'
				OR module_langname = 'ACP_PORTAL_BOTS_INFO'
				OR module_langname = 'ACP_PORTAL_MOST_POSTER_INFO'
				OR module_langname = 'ACP_PORTAL_POSTER_INFO'
				OR module_langname = 'ACP_PORTAL_MINICALENDAR_INFO'
				OR module_langname = 'ACP_PORTAL_CUSTOM_INFO'
				OR module_langname = 'ACP_PORTAL_CUSTOMBLOCK_INFO'
				OR module_langname = 'ACP_PORTAL_LINKS_INFO'
				OR module_langname = 'ACP_PORTAL_BIRTHDAYS_INFO'
				OR module_langname = 'ACP_PORTAL_FRIENDS_INFO'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			remove_module($row['module_id'], 'acp');
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
	
		$template->assign_vars(array(
			'TITLE'		=> $user->lang['STAGE_REMOVE_TABLE'],
			'BODY'		=> $user->lang['STAGE_REMOVE_TABLE_EXPLAIN'],
			'L_SUBMIT'	=> $user->lang['NEXT_STEP'],
			'S_HIDDEN'	=> '',
			'U_ACTION'	=> $this->p_master->module_url . "?mode=$mode&amp;sub=create_table",
		));
	}

	/**
	* Load the contents of the schema into the database and then alter it based on what has been input during the installation
	*/
	function load_schema($mode, $sub)
	{
		global $db, $user, $template, $phpbb_root_path, $phpEx, $cache;
		include($phpbb_root_path . 'includes/acp/auth.' . $phpEx);

		$this->page_title = $user->lang['STAGE_CREATE_TABLE'];
		$s_hidden_fields = '';

		$dbms_data = get_dbms_infos();
		$db_schema = $dbms_data['db_schema'];
		$delimiter = $dbms_data['delimiter'];

		// Create the tables
		b3p_create_table('phpbb_portal_config', $dbms_data);

		// Set default config
		set_portal_config('portal_welcome_intro', 'Welcome to my community!');
		set_portal_config('portal_max_online_friends', '8');
		set_portal_config('portal_max_most_poster', '8');
		set_portal_config('portal_max_last_member', '8');
		set_portal_config('portal_welcome', '1');
		set_portal_config('portal_links', '1');
		set_portal_config('portal_link_us', '1');
		set_portal_config('portal_clock', '1');
		set_portal_config('portal_random_member', '1');
		set_portal_config('portal_latest_members', '1');
		set_portal_config('portal_top_posters', '1');
		set_portal_config('portal_leaders', '1');
		set_portal_config('portal_advanced_stat', '1');
		set_portal_config('portal_welcome_guest', '1');
		set_portal_config('portal_birthdays', '1');
		set_portal_config('portal_search', '1');
		set_portal_config('portal_friends', '1');
		set_portal_config('portal_whois_online', '1');
		set_portal_config('portal_change_style', '0');
		set_portal_config('portal_main_menu', '1');
		set_portal_config('portal_user_menu', '1');
		set_portal_config('portal_right_column_width', '180');
		set_portal_config('portal_left_column_width', '180');
		set_portal_config('portal_poll_topic', '1');
		set_portal_config('portal_poll_topic_id', '');
		set_portal_config('portal_last_visited_bots_number', '1');
		set_portal_config('portal_load_last_visited_bots', '1');
		set_portal_config('portal_pay_acc', 'your@paypal.com');
		set_portal_config('portal_pay_s_block', '0');
		set_portal_config('portal_pay_c_block', '0');
		set_portal_config('portal_recent', '1');
		set_portal_config('portal_recent_title_limit', '100');
		set_portal_config('portal_max_topics', '10');
		set_portal_config('portal_exclude_forums', '');
		set_portal_config('portal_news_forum', '');
		set_portal_config('portal_news_length', '250');
		set_portal_config('portal_number_of_news', '5');
		set_portal_config('portal_show_all_news', '1');
		set_portal_config('portal_news', '1');
		set_portal_config('portal_news_style', '1');
		set_portal_config('portal_announcements', '1');
		set_portal_config('portal_announcements_style', '0');
		set_portal_config('portal_number_of_announcements', '1');
		set_portal_config('portal_announcements_day', '0');
		set_portal_config('portal_announcements_length', '200');
		set_portal_config('portal_global_announcements_forum', '');
		set_portal_config('portal_wordgraph_word_counts', '0');
		set_portal_config('portal_wordgraph_max_words', '80');
		set_portal_config('portal_wordgraph', '0');
		set_portal_config('portal_wordgraph_ratio', '18');
		set_portal_config('portal_minicalendar', '1');
		set_portal_config('portal_minicalendar_today_color', '#000000');
		set_portal_config('portal_attachments', '1');
		set_portal_config('portal_attachments_number', '8');

		// Added 0.2.1
		set_portal_config('portal_poll_limit', '3');
		set_portal_config('portal_poll_allow_vote', '1');
		set_portal_config('portal_birthdays_ahead', '7');

		// Added 0.2.2
		set_portal_config('portal_attachments_forum_ids', '');

		// Added  0.3.0 A.K.A 1.0.0RC1
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

		// Added 1.0.0RC2
		set_portal_config('portal_leaders_ext', '0');

		// Added 1.0.0RC3
		set_portal_config('portal_show_announcements_replies_views', '1');
		set_portal_config('portal_show_news_replies_views', '1');

		// Added 1.0.3
		set_portal_config('portal_enable', '1');
		set_portal_config('portal_phpbb_menu', '0');
		set_portal_config('portal_poll_hide', '0');
		
		// Added 1.0.4RC1 A.K.A 1.0.4
		set_portal_config('portal_minicalendar_sunday_color', '#FF0000');
		set_portal_config('portal_sunday_first', '1');
		set_portal_config('portal_long_month', '0');
		set_portal_config('portal_attach_max_length', '15');
		set_portal_config('portal_version_check', '1');
		set_portal_config('version_check_time', '0');
		set_portal_config('version_check_version', '0.0.0');
		
		// Added 1.0.5
		set_portal_config('portal_news_exclude', '0');
		set_portal_config('portal_attachments_filetype', '');
		set_portal_config('portal_attachments_exclude', '0');

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

		$submit = $user->lang['NEXT_STEP'];

		$url = $this->p_master->module_url . "?mode=$mode&amp;sub=advanced";

		$template->assign_vars(array(
			'TITLE'		=> $user->lang['STAGE_CREATE_TABLE'],
			'BODY'		=> $user->lang['STAGE_CREATE_TABLE_EXPLAIN'],
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> '',
			'U_ACTION'	=> $url,
		));
	}

	/**
	* Provide an opportunity to customise some advanced settings during the install
	* in case it is necessary for them to be set to access later
	*/
	function obtain_advanced_settings($mode, $sub)
	{
		global $user, $template, $phpEx, $db;

		$create = request_var('create', '');
		if ($create)
		{
			// Add modules
			$choosen_acp_module = request_var('acp_module', 0);
			if ($choosen_acp_module < 0)
			{
				$acp_mods_tab = array('module_basename' => '',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => 0,	'module_class' => 'acp',	'module_langname'=> 'ACP_CAT_DOT_MODS',	'module_mode' => '',	'module_auth' => '');
				add_module($acp_mods_tab);
				$choosen_acp_module = $db->sql_nextid();
			}
			// ACP
			$acp_portal = array('module_basename' => '',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $choosen_acp_module,	'module_class' => 'acp',	'module_langname'=> 'ACP_PORTAL_INFO',	'module_mode' => '',	'module_auth' => '');
			add_module($acp_portal);
			$acp_module_id = $db->sql_nextid();
			set_portal_config('acp_parent_module', $acp_module_id);

			$acp_portal_general = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_GENERAL_INFO',	'module_mode' => 'general',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_general);
			$acp_portal_news = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_NEWS_INFO',	'module_mode' => 'news',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_news);
			$acp_portal_announcements = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_ANNOUNCEMENTS_INFO',	'module_mode' => 'announcements',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_announcements);
			$acp_portal_welcome = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_WELCOME_INFO',	'module_mode' => 'welcome',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_welcome);
			$acp_portal_recent = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_RECENT_INFO',	'module_mode' => 'recent',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_recent);
			$acp_portal_wordgraph = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_WORDGRAPH_INFO',	'module_mode' => 'wordgraph',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_wordgraph);
			$acp_portal_paypal = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_PAYPAL_INFO',	'module_mode' => 'paypal',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_paypal);
			$acp_portal_attachments = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_ATTACHMENTS_INFO',	'module_mode' => 'attachments',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_attachments);
			$acp_portal_members = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_MEMBERS_INFO',	'module_mode' => 'members',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_members);
			$acp_portal_polls = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_POLLS_INFO',	'module_mode' => 'polls',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_polls);
			$acp_portal_bots = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_BOTS_INFO',	'module_mode' => 'bots',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_bots);
			$acp_portal_poster = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_POSTER_INFO',	'module_mode' => 'poster',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_poster);
			$acp_portal_minicalendar = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_MINICALENDAR_INFO',	'module_mode' => 'minicalendar',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_minicalendar);
			$acp_portal_customblock = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_CUSTOMBLOCK_INFO',	'module_mode' => 'customblock',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_customblock);
			$acp_portal_linkblock = array('module_basename'	=> 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_LINKS_INFO',	'module_mode' => 'links',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_linkblock);
			$acp_portal_friends = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_FRIENDS_INFO',	'module_mode' => 'friends',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_friends);
			$acp_portal_birthdays = array('module_basename' => 'portal',	'module_enabled' => 1,	'module_display' => 1,	'parent_id' => $acp_module_id,	'module_class' => 'acp',	'module_langname' => 'ACP_PORTAL_BIRTHDAYS_INFO',	'module_mode' => 'birthdays',	'module_auth' => 'acl_a_portal_manage');
			add_module($acp_portal_birthdays);

			$s_hidden_fields = '';
			$url = $this->p_master->module_url . "?mode=$mode&amp;sub=final";
		}
		else
		{
			$data = array(
				'acp_module'		=> 31,
			);

			foreach ($this->portal_config_options as $config_key => $vars)
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