<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package Modulname
*/
class announcements extends module_base
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 21;

	/**
	* Default modulename
	*/
	public $name = 'GLOBAL_ANNOUNCEMENTS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_announcements_module';

	/** @var bool Can include this module multiple times */
	protected $multiple_includes = true;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var \board3\portal\includes\modules_helper */
	protected $modules_helper;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string php file extension */
	protected $php_ext;

	/** @var string phpbb root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/** @var \board3\portal\portal\fetch_posts */
	protected $fetch_posts;

	/**
	* Construct an announcements object
	*
	* @param \phpbb\auth\auth $auth phpBB auth service
	* @param \phpbb\cache\service $cache phpBB cache driver
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\template\template $template phpBB template
	* @param \phpbb\db\driver\driver_interface $db Database driver
	* @param \phpbb\pagination $pagination phpBB pagination
	* @param \board3\portal\includes\modules_helper $modules_helper Portal modules helper
	* @param \phpbb\request\request $request phpBB request
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	* @param \board3\portal\portal\fetch_posts $fetch_posts Fetch posts object
	*/
	public function __construct($auth, $cache, $config, $template, $db, $pagination, $modules_helper, $request, $phpEx, $phpbb_root_path, $user, $fetch_posts)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->template = $template;
		$this->db = $db;
		$this->pagination = $pagination;
		$this->modules_helper = $modules_helper;
		$this->request = $request;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
		$this->fetch_posts = $fetch_posts;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		$announcement = $this->request->variable('announcement_' . $module_id, -1);
		$announcement = ($announcement > $this->config['board3_announcements_length_' . $module_id] -1) ? -1 : $announcement;
		$start = $this->request->variable('ap_' . $module_id, 0);
		$start = ($start < 0) ? 0 : $start;
		$total_announcements = 1;

		// Fetch announcements from portal functions.php with check if "read full" is requested.
		$portal_announcement_length = ($announcement < 0 && !$this->config['board3_announcements_style_' . $module_id]) ? $this->config['board3_announcements_length_' . $module_id] : 0;
		$this->fetch_posts->set_module_id($module_id);
		$fetch_news = $this->fetch_posts->get_posts(
			$this->config['board3_global_announcements_forum_' . $module_id],
			$this->config['board3_announcements_permissions_' . $module_id],
			$this->config['board3_number_of_announcements_' . $module_id],
			$portal_announcement_length,
			$this->config['board3_announcements_day_' . $module_id],
			'announcements',
			$start,
			(bool) $this->config['board3_announcements_forum_exclude_' . $module_id]
		);

		$topic_icons = false;
		if (!empty($fetch_news['topic_icons']))
		{
			$topic_icons = true;
		}

		// Standard announcements row
		$announcements_row = array(
			'NEWEST_POST_IMG'				=> $this->user->img('icon_topic_newest', 'VIEW_NEWEST_POST'),
			'READ_POST_IMG'					=> $this->user->img('icon_topic_latest', 'VIEW_LATEST_POST'),
			'GOTO_PAGE_IMG'					=> $this->user->img('icon_post_target', 'GOTO_PAGE'),
			'S_DISPLAY_ANNOUNCEMENTS_RVS'	=> ($this->config['board3_show_announcements_replies_views_' . $module_id]) ? true : false,
			'S_TOPIC_ICONS'					=> $topic_icons,
			'MODULE_ID'						=> $module_id,
		);

		// Any announcements present? If not terminate it here.
		if (sizeof($fetch_news) < 3)
		{
			$this->template->assign_block_vars('announcements', $announcements_row);

			$this->template->assign_block_vars('announcements.center_row', array(
				'S_NO_TOPICS'	=> true,
				'S_NOT_LAST'	=> false
			));

			$this->template->assign_var('S_CAN_READ', false);
		}
		else
		{
			// Count number of posts for announcements archive, considering if permission check is dis- or enabled.
			if ($this->config['board3_announcements_archive_' . $module_id])
			{
				$permissions = $this->config['board3_announcements_permissions_' . $module_id];
				$forum_from = $this->config['board3_global_announcements_forum_' . $module_id];
				$forum_from = (strpos($forum_from, ',') !== false) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());

				$time = ($this->config['board3_announcements_day_' . $module_id] == 0) ? 0 : $this->config['board3_announcements_day_' . $module_id];
				$post_time = ($time == 0) ? '' : 'AND topic_time > ' . (time() - $time * 86400);

				$str_where = '';

				// Get disallowed forums
				$disallow_access = $this->modules_helper->get_disallowed_forums($permissions);

				if ($this->config['board3_announcements_forum_exclude_' . $module_id] == true)
				{
					$disallow_access = array_merge($disallow_access, $forum_from);
					$forum_from = array();
				}

				$global_f = 0;

				if (sizeof($forum_from))
				{
					$disallow_access = array_diff($forum_from, $disallow_access);
					if (!sizeof($disallow_access))
					{
						return array();
					}

					foreach ($disallow_access as $acc_id)
					{
						$str_where .= 'forum_id = ' . (int) $acc_id . ' OR ';
						if ($global_f < 1 && $acc_id > 0)
						{
							$global_f = $acc_id;
						}
					}
				}
				else
				{
					foreach ($disallow_access as $acc_id)
					{
						$str_where .= 'forum_id <> ' . (int) $acc_id . ' AND ';
					}
				}

				$str_where = (strlen($str_where) > 0) ? 'AND (forum_id = 0 OR (' . trim(substr($str_where, 0, -4)) . '))' : '';

				$sql = 'SELECT COUNT(topic_id) AS num_topics
					FROM ' . TOPICS_TABLE . '
					WHERE ((topic_type = ' . POST_GLOBAL . ')
						OR topic_type = ' . POST_ANNOUNCE . ')
						AND topic_visibility = 1
						AND topic_moved_id = 0
						' . $post_time . '
						' . $str_where;
					$result = $this->db->sql_query($sql, 30);
					$total_announcements = (int) $this->db->sql_fetchfield('num_topics');
					$this->db->sql_freeresult($result);
			}

			$topic_tracking_info = (get_portal_tracking_info($fetch_news));

			if ($this->config['board3_number_of_announcements_' . $module_id] != 0 && $this->config['board3_announcements_archive_' . $module_id])
			{
				$pagination = generate_portal_pagination($this->modules_helper->route('board3_portal_controller'), $total_announcements, $this->config['board3_number_of_announcements_' . $module_id], $start, 'announcements', $module_id);

				$announcements_row = array_merge($announcements_row, array(
						'AP_PAGINATION'			=> (isset($pagination)) ? $pagination : '',
						'TOTAL_ANNOUNCEMENTS'	=> ($total_announcements == 1) ? $this->user->lang['VIEW_LATEST_ANNOUNCEMENT'] : sprintf($this->user->lang['VIEW_LATEST_ANNOUNCEMENTS'], $total_announcements),
						'AP_PAGE_NUMBER'		=> $this->pagination->on_page($total_announcements, $this->config['board3_number_of_announcements_' . $module_id], $start),
					));
			}

			// Assign announcements row
			$this->template->assign_block_vars('announcements', $announcements_row);

			// Show the announcements overview
			if ($announcement < 0)
			{
				$count = $fetch_news['topic_count'];
				for ($i = 0; $i < $count; $i++)
				{
					if (isset($fetch_news[$i]['striped']) && $fetch_news[$i]['striped'] == true)
					{
						$open_bracket = '[ ';
						$close_bracket = ' ]';
						$read_full = $this->user->lang['READ_FULL'];
					}
					else
					{
						$open_bracket = '';
						$close_bracket = '';
						$read_full = '';
					}
					// unread?
					$forum_id = $fetch_news[$i]['forum_id'];
					$topic_id = $fetch_news[$i]['topic_id'];

					$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
					$real_forum_id = ($forum_id == 0) ? $fetch_news['global_id']: $forum_id;
					$read_full_url = ($this->request->is_set('ap_' . $module_id)) ? "ap_{$module_id}=$start&amp;announcement_{$module_id}=$i#a_{$module_id}_$i" : "announcement_{$module_id}=$i#a_{$module_id}_$i";
					$view_topic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);

					$replies = ($this->auth->acl_get('m_approve', $forum_id)) ? $fetch_news[$i]['topic_replies_real'] : $fetch_news[$i]['topic_replies'];

					switch ($fetch_news[$i]['topic_type'])
					{
						case POST_GLOBAL:
							$folder = 'global_read';
							$folder_new = 'global_unread';
						break;
						case POST_ANNOUNCE:
							$folder = 'announce_read';
							$folder_new = 'announce_unread';
						break;
						default:
							$folder = 'topic_read';
							$folder_new = 'topic_unread';
							if ($this->config['hot_threshold'] && $replies >= $this->config['hot_threshold'] && $fetch_news[$i]['topic_status'] != ITEM_LOCKED)
							{
								$folder .= '_hot';
								$folder_new .= '_hot';
							}
						break;
					}

					if ($fetch_news[$i]['topic_status'] == ITEM_LOCKED)
					{
						$folder .= '_locked';
						$folder_new .= '_locked';
					}

					if ($fetch_news[$i]['topic_posted'])
					{
						$folder .= '_mine';
						$folder_new .= '_mine';
					}
					$folder_img = ($unread_topic) ? $folder_new : $folder;
					$folder_alt = ($unread_topic) ? 'NEW_POSTS' : (($fetch_news[$i]['topic_status'] == ITEM_LOCKED) ? 'TOPIC_LOCKED' : 'NO_NEW_POSTS');

					// Grab icons
					$icons = $this->cache->obtain_icons();

					$this->template->assign_block_vars('announcements.center_row', array(
						'ATTACH_ICON_IMG'		=> ($fetch_news[$i]['attachment'] && $this->config['allow_attachments']) ? $this->user->img('icon_topic_attach', $this->user->lang['TOTAL_ATTACHMENTS']) : '',
						'FORUM_NAME'			=> ($forum_id) ? $fetch_news[$i]['forum_name'] : '',
						'TITLE'					=> $fetch_news[$i]['topic_title'],
						'POSTER'				=> $fetch_news[$i]['username'],
						'POSTER_FULL'			=> $fetch_news[$i]['username_full'],
						'USERNAME_FULL_LAST'	=> $fetch_news[$i]['username_full_last'],
						'U_USER_PROFILE'		=> (($fetch_news[$i]['user_type'] == USER_NORMAL || $fetch_news[$i]['user_type'] == USER_FOUNDER) && $fetch_news[$i]['user_id'] != ANONYMOUS) ? append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=viewprofile&amp;u=' . $fetch_news[$i]['user_id']) : '',
						'TIME'					=> $fetch_news[$i]['topic_time'],
						'LAST_POST_TIME'		=> $this->user->format_date($fetch_news[$i]['topic_last_post_time']),
						'TEXT'					=> $fetch_news[$i]['post_text'],
						'REPLIES'				=> $fetch_news[$i]['topic_replies'],
						'TOPIC_VIEWS'			=> $fetch_news[$i]['topic_views'],
						'A_ID'					=> $i,
						'TOPIC_IMG_STYLE'		=> $folder_img,
						'TOPIC_FOLDER_IMG'		=> $this->user->img($folder_img, $folder_alt),
						'TOPIC_FOLDER_IMG_SRC'	=> $this->user->img($folder_img, $folder_alt, false, '', 'src'),
						'TOPIC_FOLDER_IMG_ALT'	=> $this->user->lang[$folder_alt],
						'FOLDER_IMG'			=> $this->user->img('topic_read', 'NO_NEW_POSTS'),
						'TOPIC_ICON_IMG'		=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['img'] : '',
						'TOPIC_ICON_IMG_WIDTH'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['width'] : '',
						'TOPIC_ICON_IMG_HEIGHT'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['height'] : '',
						'U_VIEWFORUM'			=> append_sid("{$this->phpbb_root_path}viewforum.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id']),
						'U_LAST_COMMENTS'		=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id . '&amp;p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
						'U_VIEW_COMMENTS'		=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
						'U_VIEW_UNREAD'			=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id . '&amp;view=unread#unread'),
						'U_POST_COMMENT'		=> append_sid("{$this->phpbb_root_path}posting.{$this->php_ext}", 'mode=reply&amp;' . (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
						'U_READ_FULL'			=> $this->modules_helper->route('board3_portal_controller') . '?' . $read_full_url,
						'L_READ_FULL'			=> $read_full,
						'OPEN'					=> $open_bracket,
						'CLOSE'					=> $close_bracket,
						'S_NOT_LAST'			=> ($i < sizeof($fetch_news) - 1) ? true : false,
						'S_POLL'				=> $fetch_news[$i]['poll'],
						'S_UNREAD_INFO'			=> $unread_topic,
						'S_HAS_ATTACHMENTS'		=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
					));

					$this->pagination->generate_template_pagination($view_topic_url, 'announcements.center_row.pagination', 'start', $fetch_news[$i]['topic_replies'] + 1, $this->config['posts_per_page'], 1, true, true);

					if (!empty($fetch_news[$i]['attachments']))
					{
						foreach ($fetch_news[$i]['attachments'] as $attachment)
						{
							$this->template->assign_block_vars('announcements.center_row.attachment', array(
								'DISPLAY_ATTACHMENT'	=> $attachment)
							);
						}
					}
				}
			}
			// Show "read full" page
			else
			{
				$i = $announcement;

				/**
				* redirect to portal page if the specified announcement does not exist
				* force #top anchor in order to get rid of the #a anchor
				*/
				if (!isset($fetch_news[$i]))
				{
					redirect($this->modules_helper->route('board3_portal_controller') . '#top');
				}

				$forum_id = $fetch_news[$i]['forum_id'];
				$topic_id = $fetch_news[$i]['topic_id'];
				$topic_tracking_info = get_complete_topic_tracking($forum_id, $topic_id);
				$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
				$open_bracket = '[ ';
				$close_bracket = ' ]';
				$read_full = $this->user->lang['BACK'];
				$real_forum_id = ($forum_id == 0) ? $fetch_news['global_id']: $forum_id;

				$read_full_url = ($this->request->is_set('ap_' . $module_id)) ? $this->modules_helper->route('board3_portal_controller') . "?ap_{$module_id}=$start#a_{$module_id}_$i" : $this->modules_helper->route('board3_portal_controller') . "#a_{$module_id}_$i";
				$view_topic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);

				$this->template->assign_block_vars('announcements.center_row', array(
					'ATTACH_ICON_IMG'		=> ($fetch_news[$i]['attachment'] && $this->config['allow_attachments']) ? $this->user->img('icon_topic_attach', $this->user->lang['TOTAL_ATTACHMENTS']) : '',
					'FORUM_NAME'			=> ($forum_id) ? $fetch_news[$i]['forum_name'] : '',
					'TITLE'					=> $fetch_news[$i]['topic_title'],
					'POSTER'				=> $fetch_news[$i]['username'],
					'POSTER_FULL'			=> $fetch_news[$i]['username_full'],
					'TIME'					=> $fetch_news[$i]['topic_time'],
					'TEXT'					=> $fetch_news[$i]['post_text'],
					'REPLIES'				=> $fetch_news[$i]['topic_replies'],
					'TOPIC_VIEWS'			=> $fetch_news[$i]['topic_views'],
					'A_ID'					=> $i,
					'U_VIEWFORUM'			=> append_sid("{$this->phpbb_root_path}viewforum.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id']),
					'U_LAST_COMMENTS'		=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id . '&amp;p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
					'U_VIEW_COMMENTS'		=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
					'U_POST_COMMENT'		=> append_sid("{$this->phpbb_root_path}posting.{$this->php_ext}", 'mode=reply&amp;' . (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
					'S_POLL'				=> $fetch_news[$i]['poll'],
					'S_UNREAD_INFO'			=> $unread_topic,
					'U_READ_FULL'			=> $read_full_url,
					'L_READ_FULL'			=> $read_full,
					'OPEN'					=> $open_bracket,
					'CLOSE'					=> $close_bracket,
					'S_HAS_ATTACHMENTS'		=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
				));

				$this->pagination->generate_template_pagination($view_topic_url, 'announcements.center_row.pagination', 'start', $fetch_news[$i]['topic_replies'] + 1, $this->config['posts_per_page'], 1, true, true);

				if (!empty($fetch_news[$i]['attachments']))
				{
					foreach ($fetch_news[$i]['attachments'] as $attachment)
					{
						$this->template->assign_block_vars('announcements.center_row.attachment', array(
							'DISPLAY_ATTACHMENT'	=> $attachment)
						);
					}
				}
			}
		}

		if ($this->config['board3_announcements_style_' . $module_id])
		{
			return 'announcements_center_compact.html';
		}
		else
		{
			return 'announcements_center.html';
		}
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_ANNOUNCE_SETTINGS',
			'vars'	=> array(
				'legend1'									=> 'ACP_PORTAL_ANNOUNCE_SETTINGS',
				'board3_announcements_style_' . $module_id				=> array('lang' => 'PORTAL_ANNOUNCEMENTS_STYLE'		 	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_number_of_announcements_' . $module_id			=> array('lang' => 'PORTAL_NUMBER_OF_ANNOUNCEMENTS'		,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
				'board3_announcements_day_' . $module_id				=> array('lang' => 'PORTAL_ANNOUNCEMENTS_DAY'			,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
				'board3_announcements_length_' . $module_id				=> array('lang' => 'PORTAL_ANNOUNCEMENTS_LENGTH'		,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
				'board3_global_announcements_forum_' . $module_id		=> array('lang' => 'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'	,	'validate' => 'string',	'type' => 'custom',			'explain' => true, 'method' => array('board3.portal.modules_helper', 'generate_forum_select'), 'submit' => array('board3.portal.modules_helper', 'store_selected_forums')),
				'board3_announcements_forum_exclude_' . $module_id		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE',	'validate' => 'string', 'type' => 'radio:yes_no',	'explain' => true),
				'board3_announcements_archive_' . $module_id			=> array('lang' => 'PORTAL_ANNOUNCEMENTS_ARCHIVE',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_announcements_permissions_' . $module_id		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_PERMISSIONS'	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_show_announcements_replies_views_' . $module_id	=> array('lang' => 'PORTAL_SHOW_REPLIES_VIEWS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_announcements_style_' . $module_id, 0);
		$this->config->set('board3_number_of_announcements_' . $module_id, 1);
		$this->config->set('board3_announcements_day_' . $module_id, 0);
		$this->config->set('board3_announcements_length_' . $module_id, 200);
		$this->config->set('board3_global_announcements_forum_' . $module_id, '');
		$this->config->set('board3_announcements_forum_exclude_' . $module_id, 0);
		$this->config->set('board3_announcements_archive_' . $module_id, 1);
		$this->config->set('board3_announcements_permissions_' . $module_id, 1);
		$this->config->set('board3_show_announcements_replies_views_' . $module_id, 1);

		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_announcements_style_' . $module_id,
			'board3_number_of_announcements_' . $module_id,
			'board3_announcements_day_' . $module_id,
			'board3_announcements_length_' . $module_id,
			'board3_global_announcements_forum_' . $module_id,
			'board3_announcements_forum_exclude_' . $module_id,
			'board3_announcements_archive_' . $module_id,
			'board3_announcements_permissions_' . $module_id,
			'board3_show_announcements_replies_views_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
