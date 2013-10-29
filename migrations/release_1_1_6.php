<?php
/**
*
* @package phpBB Gallery Core
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/

namespace phpbbgallery\core\migrations;

class release_1_1_6 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT config_value
			FROM ' . $this->table_prefix . "config
			WHERE config_name = 'phpbb_gallery_version'";
		$result = $this->db->sql_query($sql);
		$version = $this->db->sql_fetchfield('config_value');
		$this->db->sql_freeresult($result);

		return $version && (version_compare($version, '1.1.6') >= 0);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
			'add_tables'		=> array(
				$this->table_prefix . 'gallery_albums'	=> array(
					'COLUMNS'		=> array(
						'album_id'				=> array('UINT', NULL, 'auto_increment'),
						'parent_id'				=> array('UINT', 0),
						'left_id'				=> array('UINT', 1),
						'right_id'				=> array('UINT', 2),
						'album_parents'			=> array('MTEXT_UNI', ''),
						'album_type'			=> array('UINT:3', 1),
						'album_status'			=> array('UINT:1', 1),
						'album_contest'			=> array('UINT', 0),
						'album_name'			=> array('VCHAR:255', ''),
						'album_desc'			=> array('MTEXT_UNI', ''),
						'album_desc_options'	=> array('UINT:3', 7),
						'album_desc_uid'		=> array('VCHAR:8', ''),
						'album_desc_bitfield'	=> array('VCHAR:255', ''),
						'album_user_id'			=> array('UINT', 0),
						'album_images'				=> array('UINT', 0),
						'album_images_real'			=> array('UINT', 0),
						'album_last_image_id'		=> array('UINT', 0),
						'album_image'				=> array('VCHAR', ''),
						'album_last_image_time'		=> array('INT:11', 0),
						'album_last_image_name'		=> array('VCHAR', ''),
						'album_last_username'		=> array('VCHAR', ''),
						'album_last_user_colour'	=> array('VCHAR:6', ''),
						'album_last_user_id'		=> array('UINT', 0),
						'album_watermark'			=> array('UINT:1', 1),
						'album_sort_key'			=> array('VCHAR:8', ''),
						'album_sort_dir'			=> array('VCHAR:8', ''),
						'display_in_rrc'			=> array('UINT:1', 1),
						'display_on_index'			=> array('UINT:1', 1),
						'display_subalbum_list'		=> array('UINT:1', 1),
						'album_auth_access'			=> array('TINT:1', 0),
					),
					'PRIMARY_KEY'	=> 'album_id',
				),
				$this->table_prefix . 'gallery_albums_track'	=> array(
					'COLUMNS'		=> array(
						'user_id'				=> array('UINT', 0),
						'album_id'				=> array('UINT', 0),
						'mark_time'				=> array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY'	=> array('user_id', 'album_id'),
				),
				$this->table_prefix . 'gallery_comments'	=> array(
					'COLUMNS'		=> array(
						'comment_id'			=> array('UINT', NULL, 'auto_increment'),
						'comment_image_id'		=> array('UINT', NULL),
						'comment_user_id'		=> array('UINT', 0),
						'comment_username'		=> array('VCHAR', ''),
						'comment_user_colour'	=> array('VCHAR:6', ''),
						'comment_user_ip'		=> array('VCHAR:40', ''),
						'comment_signature'		=> array('BOOL', 0),
						'comment_time'			=> array('UINT:11', 0),
						'comment'				=> array('MTEXT_UNI', ''),
						'comment_uid'			=> array('VCHAR:8', ''),
						'comment_bitfield'		=> array('VCHAR:255', ''),
						'comment_edit_time'		=> array('UINT:11', 0),
						'comment_edit_count'	=> array('USINT', 0),
						'comment_edit_user_id'	=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'comment_id',
					'KEYS'		=> array(
						'id'			=> array('INDEX', 'comment_image_id'),
						'uid'			=> array('INDEX', 'comment_user_id'),
						'ip'			=> array('INDEX', 'comment_user_ip'),
						'time'			=> array('INDEX', 'comment_time'),
					),
				),
				$this->table_prefix . 'gallery_contests'	=> array(
					'COLUMNS'		=> array(
						'contest_id'			=> array('UINT', NULL, 'auto_increment'),
						'contest_album_id'		=> array('UINT', 0),
						'contest_start'			=> array('UINT:11', 0),
						'contest_rating'		=> array('UINT:11', 0),
						'contest_end'			=> array('UINT:11', 0),
						'contest_marked'		=> array('TINT:1', 0),
						'contest_first'			=> array('UINT', 0),
						'contest_second'		=> array('UINT', 0),
						'contest_third'			=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'contest_id',
				),
				$this->table_prefix . 'gallery_favorites'	=> array(
					'COLUMNS'		=> array(
						'favorite_id'			=> array('UINT', NULL, 'auto_increment'),
						'user_id'				=> array('UINT', 0),
						'image_id'				=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'favorite_id',
					'KEYS'		=> array(
						'uid'		=> array('INDEX', 'user_id'),
						'id'		=> array('INDEX', 'image_id'),
					),
				),
				$this->table_prefix . 'gallery_images'	=> array(
					'COLUMNS'		=> array(
						'image_id'				=> array('UINT', NULL, 'auto_increment'),
						'image_filename'		=> array('VCHAR:255', ''),
						'image_name'			=> array('VCHAR:255', ''),
						'image_name_clean'		=> array('VCHAR:255', ''),
						'image_desc'			=> array('MTEXT_UNI', ''),
						'image_desc_uid'		=> array('VCHAR:8', ''),
						'image_desc_bitfield'	=> array('VCHAR:255', ''),
						'image_user_id'			=> array('UINT', 0),
						'image_username'		=> array('VCHAR:255', ''),
						'image_username_clean'	=> array('VCHAR:255', ''),
						'image_user_colour'		=> array('VCHAR:6', ''),
						'image_user_ip'			=> array('VCHAR:40', ''),
						'image_time'			=> array('UINT:11', 0),
						'image_album_id'		=> array('UINT', 0),
						'image_view_count'		=> array('UINT:11', 0),
						'image_status'			=> array('UINT:3', 0),
						'image_contest'			=> array('UINT:1', 0),
						'image_contest_end'		=> array('TIMESTAMP', 0),
						'image_contest_rank'	=> array('UINT:3', 0),
						'image_filemissing'		=> array('UINT:3', 0),
						'image_rates'			=> array('UINT', 0),
						'image_rate_points'		=> array('UINT', 0),
						'image_rate_avg'		=> array('UINT', 0),
						'image_comments'		=> array('UINT', 0),
						'image_last_comment'	=> array('UINT', 0),
						'image_allow_comments'	=> array('TINT:1', 1),
						'image_favorited'		=> array('UINT', 0),
						'image_reported'		=> array('UINT', 0),
						'filesize_upload'		=> array('UINT:20', 0),
						'filesize_medium'		=> array('UINT:20', 0),
						'filesize_cache'		=> array('UINT:20', 0),
					),
					'PRIMARY_KEY'				=> 'image_id',
					'KEYS'		=> array(
						'aid'			=> array('INDEX', 'image_album_id'),
						'uid'			=> array('INDEX', 'image_user_id'),
						'time'			=> array('INDEX', 'image_time'),
					),
				),
				$this->table_prefix . 'gallery_modscache'	=> array(
					'COLUMNS'		=> array(
						'album_id'				=> array('UINT', 0),
						'user_id'				=> array('UINT', 0),
						'username'				=> array('VCHAR', ''),
						'group_id'				=> array('UINT', 0),
						'group_name'			=> array('VCHAR', ''),
						'display_on_index'		=> array('TINT:1', 1),
					),
					'KEYS'		=> array(
						'doi'		=> array('INDEX', 'display_on_index'),
						'aid'		=> array('INDEX', 'album_id'),
					),
				),
				$this->table_prefix . 'gallery_permissions'	=> array(
					'COLUMNS'		=> array(
						'perm_id'			=> array('UINT', NULL, 'auto_increment'),
						'perm_role_id'		=> array('UINT', 0),
						'perm_album_id'		=> array('UINT', 0),
						'perm_user_id'		=> array('UINT', 0),
						'perm_group_id'		=> array('UINT', 0),
						'perm_system'		=> array('INT:3', 0),
					),
					'PRIMARY_KEY'			=> 'perm_id',
				),
				$this->table_prefix . 'gallery_rates'	=> array(
					'COLUMNS'		=> array(
						'rate_image_id'		=> array('UINT', 0),
						'rate_user_id'		=> array('UINT', 0),
						'rate_user_ip'		=> array('VCHAR:40', ''),
						'rate_point'		=> array('UINT:3', 0),
					),
					'PRIMARY_KEY'	=> array('rate_image_id', 'rate_user_id'),
				),
				$this->table_prefix . 'gallery_reports'	=> array(
					'COLUMNS'		=> array(
						'report_id'				=> array('UINT', NULL, 'auto_increment'),
						'report_album_id'		=> array('UINT', 0),
						'report_image_id'		=> array('UINT', 0),
						'reporter_id'			=> array('UINT', 0),
						'report_manager'		=> array('UINT', 0),
						'report_note'			=> array('MTEXT_UNI', ''),
						'report_time'			=> array('UINT:11', 0),
						'report_status'			=> array('UINT:3', 0),
					),
					'PRIMARY_KEY'	=> 'report_id',
				),
				$this->table_prefix . 'gallery_roles'	=> array(
					'COLUMNS'		=> array(
						'role_id'			=> array('UINT', NULL, 'auto_increment'),
						'a_list'			=> array('UINT:3', 0),
						'i_view'			=> array('UINT:3', 0),
						'i_watermark'		=> array('UINT:3', 0),
						'i_upload'			=> array('UINT:3', 0),
						'i_edit'			=> array('UINT:3', 0),
						'i_delete'			=> array('UINT:3', 0),
						'i_rate'			=> array('UINT:3', 0),
						'i_approve'			=> array('UINT:3', 0),
						'i_lock'			=> array('UINT:3', 0),
						'i_report'			=> array('UINT:3', 0),
						'i_count'			=> array('UINT', 0),
						'i_unlimited'		=> array('UINT:3', 0),
						'c_read'			=> array('UINT:3', 0),
						'c_post'			=> array('UINT:3', 0),
						'c_edit'			=> array('UINT:3', 0),
						'c_delete'			=> array('UINT:3', 0),
						'm_comments'		=> array('UINT:3', 0),
						'm_delete'			=> array('UINT:3', 0),
						'm_edit'			=> array('UINT:3', 0),
						'm_move'			=> array('UINT:3', 0),
						'm_report'			=> array('UINT:3', 0),
						'm_status'			=> array('UINT:3', 0),
						'a_count'			=> array('UINT', 0),
						'a_unlimited'		=> array('UINT:3', 0),
						'a_restrict'		=> array('UINT:3', 0),
					),
					'PRIMARY_KEY'		=> 'role_id',
				),
				$this->table_prefix . 'gallery_users'	=> array(
					'COLUMNS'		=> array(
						'user_id'			=> array('UINT', 0),
						'watch_own'			=> array('UINT:3', 0),
						'watch_favo'		=> array('UINT:3', 0),
						'watch_com'			=> array('UINT:3', 0),
						'user_images'		=> array('UINT', 0),
						'personal_album_id'	=> array('UINT', 0),
						'user_lastmark'		=> array('TIMESTAMP', 0),
						'user_last_update'	=> array('TIMESTAMP', 0),
						'user_permissions'	=> array('MTEXT_UNI', ''),
						'user_permissions_changed'	=> array('TIMESTAMP', 0),
						'user_allow_comments'		=> array('TINT:1', 1),
						'subscribe_pegas'			=> array('TINT:1', 0),
					),
					'PRIMARY_KEY'		=> 'user_id',
					'KEYS'		=> array(
						'pega'			=> array('INDEX', array('personal_album_id')),
					),
				),
				$this->table_prefix . 'gallery_watch'	=> array(
					'COLUMNS'		=> array(
						'watch_id'		=> array('UINT', NULL, 'auto_increment'),
						'album_id'		=> array('UINT', 0),
						'image_id'		=> array('UINT', 0),
						'user_id'		=> array('UINT', 0),
					),
					'PRIMARY_KEY'		=> 'watch_id',
					'KEYS'		=> array(
						'uid'			=> array('INDEX', 'user_id'),
						'id'			=> array('INDEX', 'image_id'),
						'aid'			=> array('INDEX', 'album_id'),
					),
				),
			),
			'add_columns'	=> array(
				$this->table_prefix . 'log'			=> array(
					'album_id'				=> array('UINT', 0),
					'image_id'				=> array('UINT', 0),
				),
				$this->table_prefix . 'sessions'	=> array(
					'session_album_id'		=> array('UINT', 0),
				),
			),
			'add_index' => array(
				$this->table_prefix . 'sessions' => array(
					'session_aid' => array('session_album_id'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_keys' => array(
				$this->table_prefix . 'sessions' => array(
					'session_aid',
				),
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'log'			=> array(
					'album_id',
					'image_id',
				),
				$this->table_prefix . 'sessions'			=> array(
					'session_album_id',
				),
			),
			'drop_tables'		=> array(
				$this->table_prefix . 'gallery_albums',
				$this->table_prefix . 'gallery_albums_track',
				$this->table_prefix . 'gallery_comments',
				$this->table_prefix . 'gallery_contests',
				$this->table_prefix . 'gallery_favorites',
				$this->table_prefix . 'gallery_images',
				$this->table_prefix . 'gallery_modscache',
				$this->table_prefix . 'gallery_permissions',
				$this->table_prefix . 'gallery_rates',
				$this->table_prefix . 'gallery_reports',
				$this->table_prefix . 'gallery_roles',
				$this->table_prefix . 'gallery_users',
				$this->table_prefix . 'gallery_watch',
			),
		);
	}

	public function update_data()
	{
		return array(
			array('permission.add', array('a_gallery_manage', true, 'a_board')),
			array('permission.add', array('a_gallery_albums', true, 'a_board')),
			array('permission.add', array('a_gallery_import', true, 'a_board')),
			array('permission.add', array('a_gallery_cleanup', true, 'a_board')),

			// ACP
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'PHPBB_GALLERY')),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\main_module',
				'module_langname'	=> 'ACP_GALLERY_OVERVIEW',
				'module_mode'		=> 'overview',
				'module_auth'		=> 'acl_a_gallery_manage',
			))),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\config_module',
				'module_langname'	=> 'ACP_GALLERY_CONFIGURE_GALLERY',
				'module_mode'		=> 'main',
				'module_auth'		=> 'acl_a_gallery_manage',
			))),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\albums_module',
				'module_langname'	=> 'ACP_GALLERY_MANAGE_ALBUMS',
				'module_mode'		=> 'manage',
				'module_auth'		=> 'acl_a_gallery_albums',
			))),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\permissions_module',
				'module_langname'	=> 'ACP_GALLERY_ALBUM_PERMISSIONS',
				'module_mode'		=> 'manage',
				'module_auth'		=> 'acl_a_gallery_albums',
			))),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\permissions_module',
				'module_langname'	=> 'ACP_GALLERY_ALBUM_PERMISSIONS_COPY',
				'module_mode'		=> 'copy',
				'module_auth'		=> 'acl_a_gallery_albums',
			))),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\gallery_module',
				'module_langname'	=> 'ACP_IMPORT_ALBUMS',
				'module_mode'		=> 'import_images',
				'module_auth'		=> 'acl_a_gallery_import',
			))),
			array('module.add', array('acp', 'PHPBB_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\acp\gallery_module',
				'module_langname'	=> 'ACP_GALLERY_CLEANUP',
				'module_mode'		=> 'cleanup',
				'module_auth'		=> 'acl_a_gallery_cleanup',
			))),

			// UCP
			array('module.add', array('ucp', '', 'UCP_GALLERY')),
			array('module.add', array('ucp', 'UCP_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\ucp\gallery_module',
				'module_langname'	=> 'UCP_GALLERY_SETTINGS',
				'module_mode'		=> 'manage_settings',
				'module_auth'		=> '',
			))),
			array('module.add', array('ucp', 'UCP_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\ucp\gallery_module',
				'module_langname'	=> 'UCP_GALLERY_PERSONAL_ALBUMS',
				'module_mode'		=> 'manage_albums',
				'module_auth'		=> '',
			))),
			array('module.add', array('ucp', 'UCP_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\ucp\gallery_module',
				'module_langname'	=> 'UCP_GALLERY_WATCH',
				'module_mode'		=> 'manage_subscriptions',
				'module_auth'		=> '',
			))),
			array('module.add', array('ucp', 'UCP_GALLERY', array(
				'module_basename'	=> '\phpbbgallery\core\ucp\gallery_module',
				'module_langname'	=> 'UCP_GALLERY_FAVORITES',
				'module_mode'		=> 'manage_favorites',
				'module_auth'		=> '',
			))),

			// Logs
			array('module.add', array('acp', 'ACP_FORUM_LOGS', array(
				'module_basename'	=> 'logs',
				'module_langname'	=> 'ACP_GALLERY_LOGS',
				'module_mode'		=> 'gallery',
				'module_auth'		=> 'acl_a_viewlogs',
			))),

			// @todo: ADD BBCODE
			array('custom', array(array(&$this, 'install_config'))),
		);
	}

	public function install_config()
	{
		global $config;

		foreach (self::$configs as $name => $value)
		{
			if (isset(self::$is_dynamic[$name]))
			{
				$config->set('phpbb_gallery_' . $name, $value, true);
			}
			else
			{
				$config->set('phpbb_gallery_' . $name, $value);
			}
		}

		return true;
	}

	static public $is_dynamic = array(
		'mvc_time',
		'mvc_version',

		'num_comments',
		'num_images',
		'num_pegas',

		'current_upload_dir_size',
	);

	static public $configs = array(
		'album_columns'		=> 3,
		'album_display'		=> 254,
		'album_images'		=> 2500,
		'album_rows'		=> 4,
		'allow_comments'	=> true,
		'allow_gif'			=> true,
		'allow_hotlinking'	=> true,
		'allow_jpg'			=> true,
		'allow_png'			=> true,
		'allow_rates'		=> true,
		'allow_resize'		=> true,
		'allow_rotate'		=> true,
		'allow_zip'			=> false,

		'captcha_comment'		=> true,
		'captcha_upload'		=> true,
		'comment_length'		=> 2000,
		'comment_user_control'	=> true,
		'contests_ended'		=> 0,
		'current_upload_dir_size'	=> 0,
		'current_upload_dir'	=> 0,

		'default_sort_dir'	=> 'd',
		'default_sort_key'	=> 't',
		'description_length'=> 2000,
		'disp_birthdays'			=> false,
		'disp_image_url'			=> true,
		'disp_login'				=> true,
		'disp_nextprev_thumbnail'	=> false,
		'disp_statistic'			=> true,
		'disp_total_images'			=> true,
		'disp_whoisonline'			=> true,

		'gdlib_version'		=> 2,

		'hotlinking_domains'	=> 'flying-bits.org',

		'jpg_quality'			=> 100,

		'link_thumbnail'		=> 'image_page',
		'link_imagepage'		=> 'image',
		'link_image_name'		=> 'image_page',
		'link_image_icon'		=> 'image_page',

		'max_filesize'			=> 512000,
		'max_height'			=> 1024,
		'max_rating'			=> 10,
		'max_width'				=> 1280,
		'medium_cache'			=> true,
		'medium_height'			=> 600,
		'medium_width'			=> 800,
		'mini_thumbnail_disp'	=> true,
		'mini_thumbnail_size'	=> 70,
		'mvc_ignore'			=> 0,
		'mvc_time'				=> 0,
		'mvc_version'			=> '',

		'newest_pega_user_id'	=> 0,
		'newest_pega_username'	=> '',
		'newest_pega_user_colour'	=> '',
		'newest_pega_album_id'	=> 0,
		'num_comments'			=> 0,
		'num_images'			=> 0,
		'num_pegas'				=> 0,
		'num_uploads'			=> 10,

		'pegas_index_album'		=> false,
		'pegas_per_page'		=> 15,
		'profile_user_images'	=> true,
		'profile_pega'			=> true,
		'prune_orphan_time'		=> 0,

		'rrc_gindex_columns'	=> 4,
		'rrc_gindex_comments'	=> false,
		'rrc_gindex_contests'	=> 1,
		'rrc_gindex_crows'		=> 5,
		'rrc_gindex_display'	=> 173,
		'rrc_gindex_mode'		=> 7,
		'rrc_gindex_pegas'		=> true,
		'rrc_gindex_rows'		=> 1,
		'rrc_profile_columns'	=> 4,
		'rrc_profile_display'	=> 141,
		'rrc_profile_mode'		=> 3,
		'rrc_profile_pegas'		=> true,
		'rrc_profile_rows'		=> 1,

		'search_display'		=> 45,
		'shortnames'			=> 25,

		'thumbnail_cache'		=> true,
		'thumbnail_height'		=> 160,
		'thumbnail_infoline'	=> false,
		'thumbnail_quality'		=> 50,
		'thumbnail_width'		=> 240,

		'version'				=> '',
		'viewtopic_icon'		=> true,
		'viewtopic_images'		=> true,
		'viewtopic_link'		=> false,

		'watermark_changed'		=> 0,
		'watermark_enabled'		=> true,
		'watermark_height'		=> 50,
		'watermark_position'	=> 20,
		'watermark_source'		=> 'gallery/images/watermark.png',
		'watermark_width'		=> 200,
	);
}
