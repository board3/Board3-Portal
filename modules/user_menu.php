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
* @package User menu
*/
class user_menu extends module_base
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 10;

	/**
	* Default modulename
	*/
	public $name = 'USER_MENU';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_user.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_user_menu_module';

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\db\driver */
	protected $db;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/**
	* Construct a user menu object
	*
	* @param \phpbb\auth\auth $auth phpBB auth
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\controller\helper $controller_helper Controller helper
	* @param \phpbb\db\driver $db phpBB db driver
	* @param \phpbb\path_helper $path_helper phpBB path helper
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\user $user phpBB user
	* @param string $phpbb_root_path phpBB root path
	* @param string $phpEx php file extension
	*/
	public function __construct($auth, $config, $controller_helper, $db, $path_helper, $template, $user, $phpbb_root_path, $phpEx)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->controller_helper = $controller_helper;
		$this->db = $db;
		$this->path_helper = $path_helper;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		if (!function_exists('get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		if ($this->user->data['is_registered'])
		{
			//
			// + new posts since last visit & you post number
			//
			$ex_fid_ary = array_unique(array_merge(array_keys($this->auth->acl_getf('!f_read', true)), array_keys($this->auth->acl_getf('!f_search', true))));

			if ($this->auth->acl_get('m_approve'))
			{
				$m_approve_fid_sql = '';
			}
			else if ($this->auth->acl_getf_global('m_approve'))
			{
				$m_approve_fid_ary = array_diff(array_keys($this->auth->acl_getf('!m_approve', true)), $ex_fid_ary);
				$m_approve_fid_sql = ' AND (p.post_visibility = 1' . ((sizeof($m_approve_fid_ary)) ? ' OR ' . $this->db->sql_in_set('p.forum_id', $m_approve_fid_ary, true) : '') . ')';
			}
			else
			{
				$m_approve_fid_sql = ' AND p.post_visibility = 1';
			}

			$sql = 'SELECT COUNT(DISTINCT t.topic_id) as total
						FROM ' . TOPICS_TABLE . ' t
						WHERE t.topic_last_post_time > ' . (int) $this->user->data['user_lastvisit'] . '
							AND t.topic_moved_id = 0
							' . str_replace(array('p.', 'post_'), array('t.', 'topic_'), $m_approve_fid_sql) . '
							' . ((sizeof($ex_fid_ary)) ? 'AND ' . $this->db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '');
			$result = $this->db->sql_query($sql, 600);
			$new_posts_count = (int) $this->db->sql_fetchfield('total');
			$this->db->sql_freeresult($result);

			// unread posts
			$sql_where = 'AND t.topic_moved_id = 0
							' . str_replace(array('p.', 'post_'), array('t.', 'topic_'), $m_approve_fid_sql) . '
							' . ((sizeof($ex_fid_ary)) ? 'AND ' . $this->db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '');
			$unread_list = get_unread_topics($this->user->data['user_id'], $sql_where, 'ORDER BY t.topic_id DESC');
			$unread_posts_count = sizeof($unread_list);

			// Get user avatar and rank
			$user_id = $this->user->data['user_id'];
			$username = $this->user->data['username'];
			$colour = $this->user->data['user_colour'];
			$avatar_img = phpbb_get_avatar(\phpbb\avatar\manager::clean_row($this->user->data, 'user'), 'USER_AVATAR');
			$rank_title = $rank_img = $rank_img_src = '';
			\get_user_rank($this->user->data['user_rank'], $this->user->data['user_posts'], $rank_title, $rank_img, $rank_img_src);

			// Assign specific vars
			$this->template->assign_vars(array(
				'L_NEW_POSTS'	=> $this->user->lang['SEARCH_NEW'] . '&nbsp;(' . $new_posts_count . ')',
				'L_SELF_POSTS'	=> $this->user->lang['SEARCH_SELF'] . '&nbsp;(' . $this->user->data['user_posts'] . ')',
				'L_UNREAD_POSTS'=> $this->user->lang['SEARCH_UNREAD'] . '&nbsp;(' . $unread_posts_count . ')',

				'B3P_AVATAR_IMG'    => $avatar_img,
				'B3P_RANK_TITLE'    => $rank_title,
				'B3P_RANK_IMG'        => $rank_img,
				'RANK_IMG_SRC'    => $rank_img_src,

				'USERNAME_FULL'        => get_username_string('full', $user_id, $username, $colour),
				'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

				'U_NEW_POSTS'			=> append_sid("{$this->phpbb_root_path}search.{$this->php_ext}", 'search_id=newposts'),
				'U_SELF_POSTS'			=> append_sid("{$this->phpbb_root_path}search.{$this->php_ext}", 'search_id=egosearch'),
				'U_UNREAD_POSTS'		=> append_sid("{$this->phpbb_root_path}search.{$this->php_ext}", 'search_id=unreadposts'),
				'U_UM_BOOKMARKS'		=> ($this->config['allow_bookmarks']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'i=main&amp;mode=bookmarks') : '',
				'U_UM_MAIN_SUBSCRIBED'	=> append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'i=main&amp;mode=subscribed'),
				'U_UM_MCP'				=> ($this->auth->acl_get('m_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}mcp.{$this->php_ext}", 'i=main&amp;mode=front', true, $this->user->session_id) : '',
				'S_DISPLAY_SUBSCRIPTIONS' => ($this->config['allow_topic_notify'] || $this->config['allow_forum_notify']) ? true : false,
			));

			return 'user_menu_side.html';
		}
		else
		{
			/*
			* Assign specific vars
			* Need to remove web root path as ucp.php will do the
			* redirect
			*/
			$this->template->assign_vars(array(
				'U_PORTAL_REDIRECT'	=> $this->path_helper->remove_web_root_path($this->controller_helper->route('board3_portal_controller')),
				'S_DISPLAY_FULL_LOGIN'	=> true,
				'S_AUTOLOGIN_ENABLED'	=> ($this->config['allow_autologin']) ? true : false,
				'S_LOGIN_ACTION'	=> append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'mode=login'),
				'S_SHOW_REGISTER'	=> ($this->config['board3_user_menu_register_' . $module_id]) ? true : false,
			));

			return 'login_box_side.html';
		}
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'USER_MENU',
			'vars'	=> array(
				'legend1'					=> 'USER_MENU_SETTINGS',
				'board3_user_menu_register_' . $module_id	=> array('lang' => 'USER_MENU_REGISTER', 'validate' => 'bool', 'type' => 'radio:yes_no',	 'explain' => false),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_user_menu_register_' . $module_id, 1);

		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_user_menu_register_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
