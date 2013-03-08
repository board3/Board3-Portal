<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/

class phpbb_ext_board3_portal_migrations_210_beta1 extends phpbb_db_migration
{
	/**
	* Portal config table
	* @var $portal_config
	*/
	private $portal_config = array();

	public function effectively_installed()
	{
		return $this->db_tools->sql_table_exists($this->table_prefix . 'portal_modules');
	}

	static public function depends_on()
	{
		return array('phpbb_db_migration_data_310_extensions');
	}

	public function update_schema()
	{
		return array(
			'add_tables' => array(
				$this->table_prefix . 'portal_modules' => array(
					'COLUMNS' => array(
						'module_id' => array('UINT:3', NULL, 'auto_increment'),
						'module_classname' => array('VCHAR:64', ''),
						'module_column' => array('TINT:3', 0),
						'module_order' => array('TINT:3', 0),
						'module_name' => array('VCHAR', ''),
						'module_image_src' => array('VCHAR', ''),
						'module_image_width' => array('INT:3', 0),
						'module_image_height' => array('INT:3', 0),
						'module_group_ids' => array('VCHAR', ''),
						'module_status' => array('TINT:1', 1),
					),

					'PRIMARY_KEY'	=> 'module_id',
				),
				$this->table_prefix . 'portal_config' => array(
					'COLUMNS' => array(
						'config_name' => array('VCHAR:255', ''),
						'config_value'=> array('MTEXT', ''),
					),

					'PRIMARY_KEY'	=> 'config_name',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'portal_modules',
				$this->table_prefix . 'portal_config',
			),
		);
	}

	public function update_data()
	{
		return array(
			array('config.add', array('board3_portal_version', '2.1.0b1'));
			array('config.add', array('board3_enable', 1)),
			array('config.add', array('board3_left_column', 1)),
			array('config.add', array('board3_right_column', 1)),
			array('config.add', array('board3_version_check', 1)),
			array('config.add', array('board3_forum_index', 1)),
			array('config.add', array('board3_left_column_width', 180)),
			array('config.add', array('board3_right_column_width', 180)),
			array('config.add', array('board3_phpbb_menu', 0)),
			array('config.add', array('board3_display_jumpbox', 1)),
			array('config.add', array('board3_menu_1', '')),
			array('config.add', array('board3_menu_url_new_window_1', '')),
			array('config.add', array('board3_birthdays_ahead_3', 30)),
			array('config.add', array('board3_attachments_number_6', 8)),
			array('config.add', array('board3_attach_max_length_6', 15)),
			array('config.add', array('board3_attachments_forum_ids_6', '')),
			array('config.add', array('board3_attachments_forum_exclude_6', '')),
			array('config.add', array('board3_attachments_filetype_6', '')),
			array('config.add', array('board3_attachments_exclude_6', '')),
			array('config.add', array('board3_topposters_7', 5)),
			array('config.add', array('board3_max_last_member_8', 8)),
			array('config.add', array('board3_welcome_message_10', '')),
			array('config.add', array('board3_welcome_message_uid_10', '')),
			array('config.add', array('board3_welcome_message_bitfield_10', '')),
			array('config.add', array('board3_max_topics_11', 10)),
			array('config.add', array('board3_recent_title_limit_11', 100)),
			array('config.add', array('board3_recent_forum_11', '')),
			array('config.add', array('board3_recent_exclude_forums_11', 1)),
			array('config.add', array('board3_announcements_style_12', '')),
			array('config.add', array('board3_number_of_announcements_12', 1)),
			array('config.add', array('board3_announcements_day_12', '')),
			array('config.add', array('board3_announcements_length_12', 200)),
			array('config.add', array('board3_global_announcements_forum_12', '')),
			array('config.add', array('board3_announcements_forum_exclude_12', '')),
			array('config.add', array('board3_announcements_archive_12', 1)),
			array('config.add', array('board3_announcements_permissions_12', 1)),
			array('config.add', array('board3_show_announcements_replies_views_12', 1)),
			array('config.add', array('board3_news_length_13', 250)),
			array('config.add', array('board3_news_forum_13', '')),
			array('config.add', array('board3_news_permissions_13', 1)),
			array('config.add', array('board3_number_of_news_13', 5)),
			array('config.add', array('board3_show_all_news_13', 1)),
			array('config.add', array('board3_news_exclude_13', '')),
			array('config.add', array('board3_news_archive_13', 1)),
			array('config.add', array('board3_news_show_last_13', '')),
			array('config.add', array('board3_show_news_replies_views_13', 1)),
			array('config.add', array('board3_news_style_13', 1)),
			array('config.add', array('board3_poll_allow_vote_14', 1)),
			array('config.add', array('board3_poll_topic_id_14', '')),
			array('config.add', array('board3_poll_exclude_id_14', '')),
			array('config.add', array('board3_poll_hide_14', '')),
			array('config.add', array('board3_poll_limit_14', 3)),
			array('config.add', array('board3_user_menu_register_16', 1)),
			array('config.add', array('board3_sunday_first_18', 1)),
			array('config.add', array('board3_calendar_today_color_18', '#000000')),
			array('config.add', array('board3_calendar_sunday_color_18', '#FF0000')),
			array('config.add', array('board3_long_month_18', '')),
			array('config.add', array('board3_display_events_18', '')),
			array('config.add', array('board3_events_18', '')),
			array('config.add', array('board3_events_url_new_window_18', '')),
			array('config.add', array('board3_leaders_ext_19', '')),
			array('config.add', array('board3_last_visited_bots_number_20', 1)),
			array('config.add', array('board3_links_21', '')),
			array('config.add', array('board3_links_url_new_window_21', '')),
			array('permission.add', array('u_view_portal', true)),
			array('permission.add', array('a_manage_portal', true)),
			array('permission.permission_set', array('GUESTS', 'u_view_portal', 'group')),
			array('permission.permission_set', array('REGISTERED_COPPA', 'u_view_portal', 'group')),
			array('permission.permission_set', array('GLOBAL_MODERATORS', 'u_view_portal', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_view_portal', 'group')),
			array('permission.permission_set', array('BOTS', 'u_view_portal', 'group')),
			array('permission.permission_set', array('NEWLY_REGISTERED', 'u_view_portal', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_manage_portal', 'group')),
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PORTAL',
			)),
			array('module.add', array(
				'acp',
				'ACP_PORTAL',
				array(
					'module_basename'	=> 'portal',
					'modes'				=> array('config'),
					'module_auth'		=> 'acl_a_manage_portal',
					'module_langname'	=> 'ACP_PORTAL_GENERAL_INFO',
				),
			)),
			array('module.add', array(
				'acp',
				'ACP_PORTAL',
				array(
					'module_basename'	=> 'portal',
					'modes'				=> array('modules'),
					'module_auth'		=> 'acl_a_manage_portal',
					'module_langname'	=> 'ACP_PORTAL_MODULES',
				),
			)),
			array('module.add', array(
				'acp',
				'ACP_PORTAL',
				array(
					'module_basename'	=> 'portal',
					'modes'				=> array('upload_module'),
					'module_auth'		=> 'acl_a_manage_portal',
					'module_langname'	=> 'ACP_PORTAL_UPLOAD',
				),
			)),

			array('custom', array(array($this, 'add_portal_data'))),
		);
	}

	public function add_portal_data()
	{
		// get the correct group IDs from the database
		$in_ary = array('GUESTS', 'REGISTERED', 'REGISTERED_COPPA');
		$groups_ary = array();

		$sql = 'SELECT group_id, group_name FROM ' . $this->table_prefix . 'groups
			WHERE ' . $this->db->sql_in_set('group_name', $in_ary);
		$result = $this->db->sql_query($sql);
		while($row = $this->db->sql_fetchrow($result))
		{
			$groups_ary[$row['group_name']] = $row['group_id'];
		}

		// set portal config
		$this->set_portal_config('board3_menu_array_1', serialize(array(
			array(
				'title'		=> 'M_CONTENT',
				'url'		=> '',
				'type'		=> '',
				'permission'		=> '',
			),
			array(
				'title'		=> 'INDEX',
				'url'		=> 'index.php',
				'type'		=> 1,
				'permission'		=> '',
			),
			array(
				'title'		=> 'SEARCH',
				'url'		=> 'search.php',
				'type'		=> 1,
				'permission'		=> '',
			),
			array(
				'title'		=> 'REGISTER',
				'url'		=> 'ucp.php?mode=register',
				'type'		=> 1,
				'permission'		=> $groups_ary['GUESTS'],
			),
			array(
				'title'		=> 'MEMBERLIST',
				'url'		=> 'memberlist.php',
				'type'		=> 1,
				'permission'		=> $groups_ary['REGISTERED'] . ',' . $groups_ary['REGISTERED_COPPA'],
			),
			array(
				'title'		=> 'THE_TEAM',
				'url'		=> 'memberlist.php?mode=leaders',
				'type'		=> 1,
				'permission'		=> $groups_ary['REGISTERED'] . ',' . $groups_ary['REGISTERED_COPPA'],
			),
			array(
				'title'		=> 'M_HELP',
				'url'		=> '',
				'type'		=> '',
				'permission'		=> '',
			),
			array(
				'title'		=> 'FAQ',
				'url'		=> 'faq.php',
				'type'		=> 1,
				'permission'		=> '',
			),
			array(
				'title'		=> 'M_BBCODE',
				'url'		=> 'faq.php?mode=bbcode',
				'type'		=> 1,
				'permission'		=> '',
			),
			array(
				'title'		=> 'M_TERMS',
				'url'		=> 'ucp.php?mode=terms',
				'type'		=> 1,
				'permission'		=> '',
			),
			array(
				'title'		=> 'M_PRV',
				'url'		=> 'ucp.php?mode=privacy',
				'type'		=> 1,
				'permission'		=> '',
			),
		)));
		$this->set_portal_config('board3_welcome_message_10', 'Welcome to my Community!');
		$this->set_portal_config('board3_calendar_events_18', '');
		$this->set_portal_config('board3_links_array_21', serialize(array(
			array(
				'title'		=> 'Board3.de',
				'url'		=> 'http://www.board3.de/',
				'type'		=> 2,
				'permission'		=> '',
			),
			array(
				'title'		=> 'phpBB.com',
				'url'		=> 'http://www.phpbb.com/',
				'type'		=> 2,
				'permission'		=> '',
			),
		)));

		// Populate module table
		$board3_sql_query = array(
			array(
				'module_classname'		=> 'main_menu',
				'module_column'		=> 1,
				'module_order'		=> 1,
				'module_name'		=> 'M_MENU',
				'module_image_src'		=> 'portal_menu.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'stylechanger',
				'module_column'		=> 1,
				'module_order'		=> 2,
				'module_name'		=> 'BOARD_STYLE',
				'module_image_src'		=> 'portal_style.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'birthday_list',
				'module_column'		=> 1,
				'module_order'		=> 3,
				'module_name'		=> 'BIRTHDAYS',
				'module_image_src'		=> 'portal_birthday.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'clock',
				'module_column'		=> 1,
				'module_order'		=> 4,
				'module_name'		=> 'CLOCK',
				'module_image_src'		=> 'portal_clock.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'search',
				'module_column'		=> 1,
				'module_order'		=> 5,
				'module_name'		=> 'PORTAL_SEARCH',
				'module_image_src'		=> 'portal_search.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'attachments',
				'module_column'		=> 1,
				'module_order'		=> 6,
				'module_name'		=> 'PORTAL_ATTACHMENTS',
				'module_image_src'		=> 'portal_attach.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'topposters',
				'module_column'		=> 1,
				'module_order'		=> 7,
				'module_name'		=> 'TOPPOSTERS',
				'module_image_src'		=> 'portal_top_poster.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'latest_members',
				'module_column'		=> 1,
				'module_order'		=> 8,
				'module_name'		=> 'LATEST_MEMBERS',
				'module_image_src'		=> 'portal_members.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'link_us',
				'module_column'		=> 1,
				'module_order'		=> 9,
				'module_name'		=> 'LINK_US',
				'module_image_src'		=> 'portal_link_us.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'welcome',
				'module_column'		=> 2,
				'module_order'		=> 1,
				'module_name'		=> 'PORTAL_WELCOME',
				'module_image_src'		=> '',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'recent',
				'module_column'		=> 2,
				'module_order'		=> 2,
				'module_name'		=> 'PORTAL_RECENT',
				'module_image_src'		=> '',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'announcements',
				'module_column'		=> 2,
				'module_order'		=> 3,
				'module_name'		=> 'GLOBAL_ANNOUNCEMENTS',
				'module_image_src'		=> '',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'news',
				'module_column'		=> 2,
				'module_order'		=> 4,
				'module_name'		=> 'LATEST_NEWS',
				'module_image_src'		=> '',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'poll',
				'module_column'		=> 2,
				'module_order'		=> 5,
				'module_name'		=> 'PORTAL_POLL',
				'module_image_src'		=> 'portal_poll.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'whois_online',
				'module_column'		=> 2,
				'module_order'		=> 6,
				'module_name'		=> 'PORTAL_WHOIS_ONLINE',
				'module_image_src'		=> 'portal_friends.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'user_menu',
				'module_column'		=> 3,
				'module_order'		=> 1,
				'module_name'		=> 'USER_MENU',
				'module_image_src'		=> 'portal_user.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'statistics',
				'module_column'		=> 3,
				'module_order'		=> 2,
				'module_name'		=> 'STATISTICS',
				'module_image_src'		=> 'portal_statistics.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'calendar',
				'module_column'		=> 3,
				'module_order'		=> 3,
				'module_name'		=> 'PORTAL_CALENDAR',
				'module_image_src'		=> 'portal_calendar.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'leaders',
				'module_column'		=> 3,
				'module_order'		=> 4,
				'module_name'		=> 'THE_TEAM',
				'module_image_src'		=> 'portal_team.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'latest_bots',
				'module_column'		=> 3,
				'module_order'		=> 5,
				'module_name'		=> 'LATEST_BOTS',
				'module_image_src'		=> 'portal_bots.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
			array(
				'module_classname'		=> 'links',
				'module_column'		=> 3,
				'module_order'		=> 6,
				'module_name'		=> 'PORTAL_LINKS',
				'module_image_src'		=> 'portal_links.png',
				'module_group_ids'		=> '',
				'module_image_width'		=> 16,
				'module_image_height'		=> 16,
				'module_status'		=> 1,
			),
		);
		$this->db->sql_multi_insert($this->table_prefix . 'portal_modules', $board3_sql_query);
	}

	/**
	* Set config value. Creates missing config entry.
	* Only use this if your config value might exceed 255 characters, otherwise please use set_config
	*/
	private function set_portal_config($config_name, $config_value)
	{
		$portal_config = $this->portal_config;

		$sql = 'UPDATE ' . $this->table_prefix . "portal_config
			SET config_value = '" . $this->db->sql_escape($config_value) . "'
			WHERE config_name = '" . $this->db->sql_escape($config_name) . "'";
		$this->db->sql_query($sql);

		if (!$this->db->sql_affectedrows() && !isset($portal_config[$config_name]))
		{
			$sql = 'INSERT INTO ' . $this->table_prefix . 'portal_config ' . $this->db->sql_build_array('INSERT', array(
				'config_name'	=> $config_name,
				'config_value'	=> $config_value));
			$this->db->sql_query($sql);
		}

		$this->portal_config[$config_name] = $config_value;
	}
}
