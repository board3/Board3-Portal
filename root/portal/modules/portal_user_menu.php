<?php
/**
*
* @package Board3 Portal v2 - User Menu
* @copyright (c) Board3 Group ( www.board3.de )
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

/**
* @package Modulname
*/
class portal_user_menu_module
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

	public function get_template_side($module_id)
	{
		global $config, $template, $user, $auth, $db, $phpEx, $phpbb_root_path;

		if (!function_exists('display_forums'))
		{
			include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
		}

		if ($user->data['is_registered'])
		{
			//
			// + new posts since last visit & you post number
			//
			$ex_fid_ary = array_unique(array_merge(array_keys($auth->acl_getf('!f_read', true)), array_keys($auth->acl_getf('!f_search', true))));

			if ($auth->acl_get('m_approve'))
			{
				$m_approve_fid_ary = array(-1);
				$m_approve_fid_sql = '';
			}
			else if ($auth->acl_getf_global('m_approve'))
			{
				$m_approve_fid_ary = array_diff(array_keys($auth->acl_getf('!m_approve', true)), $ex_fid_ary);
				$m_approve_fid_sql = ' AND (p.post_approved = 1' . ((sizeof($m_approve_fid_ary)) ? ' OR ' . $db->sql_in_set('p.forum_id', $m_approve_fid_ary, true) : '') . ')';
			}
			else
			{
				$m_approve_fid_ary = array();
				$m_approve_fid_sql = ' AND p.post_approved = 1';
			}

			$sql = 'SELECT COUNT(distinct t.topic_id) as total
						FROM ' . TOPICS_TABLE . ' t
						WHERE t.topic_last_post_time > ' . $user->data['user_lastvisit'] . '
							AND t.topic_moved_id = 0
							' . str_replace(array('p.', 'post_'), array('t.', 'topic_'), $m_approve_fid_sql) . '
							' . ((sizeof($ex_fid_ary)) ? 'AND ' . $db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '');
			$result = $db->sql_query($sql);
			$new_posts_count = (int) $db->sql_fetchfield('total');
			$db->sql_freeresult($result);

			// unread posts
			$sql_where = 'AND t.topic_moved_id = 0
							' . str_replace(array('p.', 'post_'), array('t.', 'topic_'), $m_approve_fid_sql) . '
							' . ((sizeof($ex_fid_ary)) ? 'AND ' . $db->sql_in_set('t.forum_id', $ex_fid_ary, true) : '');
			$unread_list = array();
			$unread_list = get_unread_topics($user->data['user_id'], $sql_where, 'ORDER BY t.topic_id DESC');
			$unread_posts_count = sizeof($unread_list);


			// Get user avatar and rank
			$user_id = $user->data['user_id'];
			$username = $user->data['username'];
			$colour = $user->data['user_colour'];
			$avatar_img = get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type'], $user->data['user_avatar_width'], $user->data['user_avatar_height']);
			$rank_title = $rank_img = '';
			get_user_rank($user->data['user_rank'], $user->data['user_posts'], $rank_title, $rank_img, $rank_img_src);

			// Assign specific vars
			$template->assign_vars(array(
				'L_NEW_POSTS'	=> $user->lang['SEARCH_NEW'] . '&nbsp;(' . $new_posts_count . ')',
				'L_SELF_POSTS'	=> $user->lang['SEARCH_SELF'] . '&nbsp;(' . $user->data['user_posts'] . ')',
				'L_UNREAD_POSTS'=> $user->lang['SEARCH_UNREAD'] . '&nbsp;(' . $unread_posts_count . ')',

				'B3P_AVATAR_IMG'    => $avatar_img,
				'B3P_RANK_TITLE'    => $rank_title,
				'B3P_RANK_IMG'        => $rank_img,
				'RANK_IMG_SRC'    => $rank_img_src,

				'USERNAME_FULL'        => get_username_string('full', $user_id, $username, $colour),
				'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

				'U_NEW_POSTS'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=newposts'),
				'U_SELF_POSTS'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=egosearch'),
				'U_UNREAD_POSTS'		=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unreadposts'),
				'U_UM_BOOKMARKS'		=> ($config['allow_bookmarks']) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&amp;mode=bookmarks') : '',
				'U_UM_MAIN_SUBSCRIBED'	=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&amp;mode=subscribed'),
				'U_UM_MCP'				=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '',
				'S_DISPLAY_SUBSCRIPTIONS' => ($config['allow_topic_notify'] || $config['allow_forum_notify']) ? true : false,
			));

			return 'user_menu_side.html';
		}
		else
		{
			// Assign specific vars
			$template->assign_vars(array(
				'U_PORTAL'				=> append_sid("{$phpbb_root_path}portal.$phpEx"),
				'S_DISPLAY_FULL_LOGIN'	=> true,
				'S_AUTOLOGIN_ENABLED'	=> ($config['allow_autologin']) ? true : false,
				'S_LOGIN_ACTION'		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login'),
				'S_SHOW_REGISTER'	=> ($config['board3_user_menu_register_' . $module_id]) ? true : false,
			));

			return 'login_box_side.html';
		}
	}

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
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_user_menu_register_' . $module_id, 1);

		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_user_menu_register_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
