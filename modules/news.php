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
* @package News
*/
class news extends module_base
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
	public $name = 'LATEST_NEWS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_news_module';

	/** @var bool Can include this module multiple times */
	protected $multiple_includes = true;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_Interface */
	protected $db;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var \board3\portal\includes\modules_helper */
	protected $modules_helper;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/** @var \board3\portal\portal\fetch_posts */
	protected $fetch_posts;

	/**
	* Construct a news object
	*
	* @param \phpbb\auth\auth $auth phpBB auth
	* @param \phpbb\cache\service $cache phpBB cache system
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\db\driver\driver_interface $db phpBB db driver
	* @param \phpbb\pagination $pagination phpBB pagination
	* @param \board3\portal\includes\modules_helper $modules_helper Portal modules helper
	* @param \phpbb\request\request $request phpBB request
	* @param \phpbb\template\template $template phpBB template
	* @param string $phpbb_root_path phpBB root path
	* @param string $phpEx php file extension
	* @param \phpbb\user $user phpBB user object
	* @param \board3\portal\portal\fetch_posts $fetch_posts Fetch posts object
	*/
	public function __construct($auth, $cache, $config, $db, $pagination, $modules_helper, $request, $template, $phpbb_root_path, $phpEx, $user, $fetch_posts)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->pagination = $pagination;
		$this->modules_helper = $modules_helper;
		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
		$this->user = $user;
		$this->fetch_posts = $fetch_posts;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		$news = $this->request->variable('news_' . $module_id, -1);
		$news = ($news > $this->config['board3_number_of_news_' . $module_id] -1) ? -1 : $news;
		$this->user->add_lang('viewforum');
		$start = $this->request->variable('np_' . $module_id, 0);
		$start = ($start < 0) ? 0 : $start;
		$total_news = 1;

		// Fetch news from portal functions.php with check if "read full" is requested.
		$portal_news_length = ($news < 0 && !$this->config['board3_news_style_' . $module_id]) ? $this->config['board3_news_length_' . $module_id] : 0;
		$this->fetch_posts->set_module_id($module_id);
		$fetch_news = $this->fetch_posts->get_posts(
			$this->config['board3_news_forum_' . $module_id],
			$this->config['board3_news_permissions_' . $module_id],
			$this->config['board3_number_of_news_' . $module_id],
			$portal_news_length,
			0,
			($this->config['board3_show_all_news_' . $module_id]) ? 'news_all' : 'news',
			$start,
			(bool) $this->config['board3_news_exclude_' . $module_id]
		);

		$topic_icons = false;
		if (!empty($fetch_news['topic_icons']))
		{
			$topic_icons = true;
		}

		// Standard news row
		$news_row = array(
			'S_NEWEST_OR_FIRST'			=> ($this->config['board3_news_show_last_' . $module_id]) ? $this->user->lang['JUMP_NEWEST'] : $this->user->lang['JUMP_FIRST'],
			'POSTED_BY_TEXT'			=> ($this->config['board3_news_show_last_' . $module_id]) ? $this->user->lang['LAST_POST'] : $this->user->lang['POSTED'],
			'S_DISPLAY_NEWS_RVS'		=> ($this->config['board3_show_news_replies_views_' . $module_id]) ? true : false,
			'S_TOPIC_ICONS'				=> $topic_icons,
			'MODULE_ID'					=> $module_id,
		);

		// Any news present? If not terminate it here.
		if (sizeof($fetch_news) == 0)
		{
			// Create standard news row
			$this->template->assign_block_vars('news', $news_row);

			$this->template->assign_block_vars('news.news_row', array(
				'S_NO_TOPICS'	=> true,
				'S_NOT_LAST'	=> false,
			));
		}
		else
		{
			// Count number of posts for news archive, considering if permission check is dis- or enabled.
			if ($this->config['board3_news_archive_' . $module_id])
			{
				$permissions = $this->config['board3_news_permissions_' . $module_id];
				$forum_from = $this->config['board3_news_forum_' . $module_id];

				$forum_from = (strpos($forum_from, ',') !== false) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());

				$str_where = '';

				// Get disallowed forums
				$disallow_access = $this->modules_helper->get_disallowed_forums($permissions);

				if ($this->config['board3_news_exclude_' . $module_id] == true)
				{
					$disallow_access = array_merge($disallow_access, $forum_from);
					$forum_from = array();
				}

				if (sizeof($forum_from))
				{
					$disallow_access = array_diff($forum_from, $disallow_access);
					if (!sizeof($disallow_access))
					{
						return array();
					}

					foreach ($disallow_access as $acc_id)
					{
						$acc_id = (int) $acc_id;
						$str_where .= "forum_id = $acc_id OR ";
					}
				}
				else
				{
					foreach ($disallow_access as $acc_id)
					{
						$acc_id = (int) $acc_id;
						$str_where .= "forum_id <> $acc_id AND ";
					}
				}

				$str_where = (strlen($str_where) > 0) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';

				$topic_type = ($this->config['board3_show_all_news_' . $module_id]) ? '(topic_type <> ' . POST_ANNOUNCE . ') AND (topic_type <> ' . POST_GLOBAL . ')' : 'topic_type = ' . POST_NORMAL;

				$sql = 'SELECT COUNT(topic_id) AS num_topics
					FROM ' . TOPICS_TABLE . '
					WHERE ' . $topic_type . '
						AND topic_visibility = ' . ITEM_APPROVED . '
						AND topic_moved_id = 0
						' . $str_where;
					$result = $this->db->sql_query($sql, 30);
					$total_news = (int) $this->db->sql_fetchfield('num_topics');
					$this->db->sql_freeresult($result);
			}

			$topic_tracking_info = get_portal_tracking_info($fetch_news);

			// Create pagination if necessary
			if ($this->config['board3_news_archive_' . $module_id])
			{
				$pagination = generate_portal_pagination($this->modules_helper->route('board3_portal_controller'), $total_news, $this->config['board3_number_of_news_' . $module_id], $start, ($this->config['board3_show_all_news_' . $module_id]) ? 'news_all' : 'news', $module_id);
			}

			if ($this->config['board3_number_of_news_' . $module_id] <> 0 && $this->config['board3_news_archive_' . $module_id])
			{
				$news_row = array_merge($news_row, array(
					'NP_PAGINATION'		=> (!empty($pagination)) ? $pagination : '',
					'TOTAL_NEWS'		=> ($total_news == 1) ? sprintf($this->user->lang['VIEW_FORUM_TOPICS'][1], $total_news) : sprintf($this->user->lang['VIEW_FORUM_TOPICS'][2], $total_news),
					'NP_PAGE_NUMBER'	=> $this->pagination->on_page($total_news, $this->config['board3_number_of_news_' . $module_id], $start),
				));
			}

			// Create standard news row
			$this->template->assign_block_vars('news', $news_row);

			// Show the news overview
			if ($news < 0)
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

					$read_full_url = ($this->request->is_set('np_' . $module_id)) ? "np_$module_id=$start&amp;news_$module_id=$i#n_{$module_id}_$i" : "news_$module_id=$i#n_{$module_id}_$i";
					$view_topic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);

					$replies = ($this->auth->acl_get('m_approve', $forum_id)) ? $fetch_news[$i]['topic_replies_real'] : $fetch_news[$i]['topic_replies'];

					switch ($fetch_news[$i]['topic_type'])
					{
						case POST_STICKY:
							$folder = 'sticky_read';
							$folder_new = 'sticky_unread';
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

					$this->template->assign_block_vars('news.news_row', array(
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
						'N_ID'					=> $i,
						'TOPIC_FOLDER_IMG'		=> $this->user->img($folder_img, $folder_alt),
						'TOPIC_IMG_STYLE'		=> $folder_img,
						'TOPIC_FOLDER_IMG_SRC'  => $this->user->img($folder_img, $folder_alt, false, '', 'src'),
						'TOPIC_FOLDER_IMG_ALT'  => $this->user->lang[$folder_alt],
						'TOPIC_ICON_IMG'		=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['img'] : '',
						'TOPIC_ICON_IMG_WIDTH'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['width'] : '',
						'TOPIC_ICON_IMG_HEIGHT'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['height'] : '',
						'FOLDER_IMG'			=> $this->user->img('topic_read', 'NO_NEW_POSTS'),
						'U_VIEWFORUM'			=> append_sid("{$this->phpbb_root_path}viewforum.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id']),
						'U_LAST_COMMENTS'		=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id'] . '&amp;p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
						'U_VIEW_COMMENTS'		=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
						'U_VIEW_UNREAD'			=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id'] . '&amp;view=unread#unread'),
						'U_POST_COMMENT'		=> append_sid("{$this->phpbb_root_path}posting.{$this->php_ext}", 'mode=reply&amp;f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
						'U_READ_FULL'			=> $this->modules_helper->route('board3_portal_controller') . '?' . $read_full_url,
						'L_READ_FULL'			=> $read_full,
						'OPEN'					=> $open_bracket,
						'CLOSE'					=> $close_bracket,
						'S_NOT_LAST'			=> ($i < sizeof($fetch_news) - 1) ? true : false,
						'S_POLL'				=> $fetch_news[$i]['poll'],
						'S_UNREAD_INFO'			=> $unread_topic,
						'S_HAS_ATTACHMENTS'		=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
					));

					// Assign pagination
					$this->pagination->generate_template_pagination($view_topic_url, 'news.news_row.pagination', 'start', $fetch_news[$i]['topic_replies'] + 1, $this->config['posts_per_page'], 1);

					if (!empty($fetch_news[$i]['attachments']))
					{
						foreach ($fetch_news[$i]['attachments'] as $attachment)
						{
							$this->template->assign_block_vars('news.news_row.attachment', array(
								'DISPLAY_ATTACHMENT'	=> $attachment)
							);
						}
					}
				}
			}
			// Show "read full" page
			else
			{
				$i = $news;
				$forum_id = $fetch_news[$i]['forum_id'];
				$topic_id = $fetch_news[$i]['topic_id'];
				$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
				$open_bracket = '[ ';
				$close_bracket = ' ]';
				$read_full = $this->user->lang['BACK'];

				$read_full_url = ($this->request->is_set('np_' . $module_id)) ? $this->modules_helper->route('board3_portal_controller') . "?np_$module_id=$start#n_{$module_id}_$i" : $this->modules_helper->route('board3_portal_controller') . "#n_{$module_id}_$i";
				$view_topic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);

				$this->template->assign_block_vars('news.news_row', array(
					'ATTACH_ICON_IMG'	=> ($fetch_news[$i]['attachment'] && $this->config['allow_attachments']) ? $this->user->img('icon_topic_attach', $this->user->lang['TOTAL_ATTACHMENTS']) : '',
					'FORUM_NAME'		=> ($forum_id) ? $fetch_news[$i]['forum_name'] : '',
					'TITLE'				=> $fetch_news[$i]['topic_title'],
					'POSTER'			=> $fetch_news[$i]['username'],
					'POSTER_FULL'		=> $fetch_news[$i]['username_full'],
					'TIME'				=> $fetch_news[$i]['topic_time'],
					'TEXT'				=> $fetch_news[$i]['post_text'],
					'REPLIES'			=> $fetch_news[$i]['topic_replies'],
					'TOPIC_VIEWS'		=> $fetch_news[$i]['topic_views'],
					'N_ID'				=> $i,
					'U_VIEWFORUM'		=> append_sid("{$this->phpbb_root_path}viewforum.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id']),
					'U_LAST_COMMENTS'	=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
					'U_VIEW_COMMENTS'	=> append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
					'U_POST_COMMENT'	=> append_sid("{$this->phpbb_root_path}posting.{$this->php_ext}", 'mode=reply&amp;f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
					'S_POLL'			=> $fetch_news[$i]['poll'],
					'S_UNREAD_INFO'		=> $unread_topic,
					'U_READ_FULL'		=> $read_full_url,
					'L_READ_FULL'		=> $read_full,
					'OPEN'				=> $open_bracket,
					'CLOSE'				=> $close_bracket,
					'S_HAS_ATTACHMENTS'	=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
				));

				$this->pagination->generate_template_pagination($view_topic_url, 'news.news_row.pagination', 'start', $fetch_news[$i]['topic_replies'] + 1, $this->config['posts_per_page'], 1);

				if (!empty($fetch_news[$i]['attachments']))
				{
					foreach ($fetch_news[$i]['attachments'] as $attachment)
					{
						$this->template->assign_block_vars('news.news_row.attachment', array(
							'DISPLAY_ATTACHMENT'	=> $attachment)
						);
					}
				}
			}
		}

		$this->template->assign_vars(array(
			'NEWEST_POST_IMG'			=> $this->user->img('icon_topic_newest', 'VIEW_NEWEST_POST'),
			'READ_POST_IMG'				=> $this->user->img('icon_topic_latest', 'VIEW_LATEST_POST'),
			'GOTO_PAGE_IMG'				=> $this->user->img('icon_post_target', 'GOTO_PAGE'),
		));

		if ($this->config['board3_news_style_' . $module_id])
		{
			return 'news_compact_center.html';
		}
		else
		{
			return 'news_center.html';
		}
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_NEWS_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_NEWS_SETTINGS',
				'board3_news_style_' . $module_id					=> array('lang' => 'PORTAL_NEWS_STYLE',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
				'board3_show_all_news_' . $module_id				=> array('lang' => 'PORTAL_SHOW_ALL_NEWS',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
				'board3_number_of_news_' . $module_id				=> array('lang' => 'PORTAL_NUMBER_OF_NEWS',	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
				'board3_news_length_' . $module_id				=> array('lang' => 'PORTAL_NEWS_LENGTH',	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
				'board3_news_forum_' . $module_id					=> array('lang' => 'PORTAL_NEWS_FORUM',		'validate' => 'string',		'type' => 'custom',	 		'explain' => true,	'method' => array('board3.portal.modules_helper', 'generate_forum_select'), 'submit' => array('board3.portal.modules_helper', 'store_selected_forums')),
				'board3_news_exclude_' . $module_id				=> array('lang' => 'PORTAL_NEWS_EXCLUDE',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
				'board3_news_show_last_' . $module_id             => array('lang' => 'PORTAL_NEWS_SHOW_LAST',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_news_archive_' . $module_id               => array('lang' => 'PORTAL_NEWS_ARCHIVE',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_news_permissions_' . $module_id			=> array('lang' => 'PORTAL_NEWS_PERMISSIONS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_show_news_replies_views_' . $module_id	=> array('lang' => 'PORTAL_SHOW_REPLIES_VIEWS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
			)
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_news_length_' . $module_id, 250);
		$this->config->set('board3_news_forum_' . $module_id, '');
		$this->config->set('board3_news_permissions_' . $module_id, 1);
		$this->config->set('board3_number_of_news_' . $module_id, 5);
		$this->config->set('board3_show_all_news_' . $module_id, 1);
		$this->config->set('board3_news_exclude_' . $module_id, 0);
		$this->config->set('board3_news_archive_' . $module_id, 1);
		$this->config->set('board3_news_show_last_' . $module_id, 0);
		$this->config->set('board3_show_news_replies_views_' . $module_id, 1);
		$this->config->set('board3_news_style_' . $module_id, 1);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_news_length_' . $module_id,
			'board3_news_forum_' . $module_id,
			'board3_news_permissions_' . $module_id,
			'board3_number_of_news_' . $module_id,
			'board3_show_all_news_' . $module_id,
			'board3_news_exclude_' . $module_id,
			'board3_news_archive_' . $module_id,
			'board3_news_show_last_' . $module_id,
			'board3_show_news_replies_views_' . $module_id,
			'board3_news_style_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
