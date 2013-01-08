<?php
/**
*
* @package Board3 Portal v2 - Announcements
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
class portal_announcements_module
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

	public function get_template_center($module_id)
	{
		global $config, $template, $db, $user, $auth, $cache, $phpEx, $phpbb_root_path;

		$announcement = request_var('announcement', -1);
		$announcement = ($announcement > $config['board3_announcements_length_' . $module_id] -1) ? -1 : $announcement;
		$start = request_var('ap', 0);
		$start = ($start < 0) ? 0 : $start;

		// Fetch announcements from portal/includes/functions.php with check if "read full" is requested.
		$portal_announcement_length = ($announcement < 0) ? $config['board3_announcements_length_' . $module_id] : 0;
		$fetch_news = phpbb_fetch_posts($module_id, $config['board3_global_announcements_forum_' . $module_id], $config['board3_announcements_permissions_' . $module_id], $config['board3_number_of_announcements_' . $module_id], $portal_announcement_length, $config['board3_announcements_day_' . $module_id], 'announcements', $start, $config['board3_announcements_forum_exclude_' . $module_id]);

		// Any announcements present? If not terminate it here.
		if (sizeof($fetch_news) == 0)
		{
			$template->assign_block_vars('announcements_center_row', array(
				'S_NO_TOPICS'	=> true,
				'S_NOT_LAST'	=> false
			));

			$template->assign_var('S_CAN_READ', false);
		}
		else
		{
			// Count number of posts for announcements archive, considering if permission check is dis- or enabled.
			if ($config['board3_announcements_archive_' . $module_id])
			{
				$permissions = $config['board3_announcements_permissions_' . $module_id];
				$forum_from = $config['board3_global_announcements_forum_' . $module_id];
				$forum_from = (strpos($forum_from, ',') !== false) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());

				$time = ($config['board3_announcements_day_' . $module_id] == 0) ? 0 : $config['board3_announcements_day_' . $module_id];
				$post_time = ($time == 0) ? '' : 'AND topic_time > ' . (time() - $time * 86400);

				$str_where = '';

				if($permissions == true)
				{
					$disallow_access = array_unique(array_keys($auth->acl_getf('!f_read', true)));
				} 
				else
				{
					$disallow_access = array();
				}

				if($config['board3_announcements_forum_exclude_' . $module_id] == true)
				{
					$disallow_access = array_merge($disallow_access, $forum_from);
					$forum_from = array();
				}

				$global_f = 0;

				if(sizeof($forum_from))
				{
					$disallow_access = array_diff($forum_from, $disallow_access);		
					if(!sizeof($disallow_access))
					{
						return array();
					}

					foreach($disallow_access as $acc_id)
					{
						$acc_id = (int) $acc_id;
						$str_where .= "forum_id = $acc_id OR ";
						if($global_f < 1 && $acc_id > 0)
						{
							$global_f = $acc_id;
						}
					}
				}
				else
				{
					foreach($disallow_access as $acc_id)
					{
						$acc_id = (int) $acc_id;
						$str_where .= "forum_id <> $acc_id AND ";
					}
				}

				$str_where = (strlen($str_where) > 0) ? 'AND (forum_id = 0 OR (' . trim(substr($str_where, 0, -4)) . '))' : '';

				$sql = 'SELECT COUNT(topic_id) AS num_topics
					FROM ' . TOPICS_TABLE . '
					WHERE ((topic_type = ' . POST_GLOBAL . ')
						OR topic_type = ' . POST_ANNOUNCE . ')
						AND topic_approved = 1
						AND topic_moved_id = 0
						' . $post_time . '
						' . $str_where;
					$result = $db->sql_query($sql);
					$total_announcements = (int) $db->sql_fetchfield('num_topics');
					$db->sql_freeresult($result);
			}

			$topic_tracking_info = (get_portal_tracking_info($fetch_news));

			if($announcement < 0)
			// Show the announcements overview 
			{
				$count = $fetch_news['topic_count'];
				for ($i = 0; $i < $count; $i++)
				{
					if(isset($fetch_news[$i]['striped']) && $fetch_news[$i]['striped'] == true)
					{
						$open_bracket = '[ ';
						$close_bracket = ' ]';
						$read_full = $user->lang['READ_FULL'];
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
					//$topic_tracking_info = get_complete_topic_tracking($forum_id, $topic_id, $global_announce_list = false);
					$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
					$real_forum_id = ($forum_id == 0) ? $fetch_news['global_id']: $forum_id;
					$read_full_url = (isset($_GET['ap'])) ? 'ap='. $start . '&amp;announcement=' . $i . '#a' . $i : 'announcement=' . $i . '#a' . $i;
					$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);

					if ($config['board3_announcements_archive_' . $module_id])
					{
						$pagination = generate_portal_pagination(append_sid("{$phpbb_root_path}portal.$phpEx"), $total_announcements, $config['board3_number_of_announcements_' . $module_id], $start, 'announcements');
					}

					$replies = ($auth->acl_get('m_approve', $forum_id)) ? $fetch_news[$i]['topic_replies_real'] : $fetch_news[$i]['topic_replies'];
					$folder_img = $folder_alt = $topic_type = $folder = $folder_new = '';
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
							if ($config['hot_threshold'] && $replies >= $config['hot_threshold'] && $fetch_news[$i]['topic_status'] != ITEM_LOCKED)
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
				if ($fetch_news[$i]['topic_type'] == POST_GLOBAL)
				{
					$global_announce_list[$fetch_news[$i]['topic_id']] = true;
				}
				if ($fetch_news[$i]['topic_posted'])
				{
					$folder .= '_mine';
					$folder_new .= '_mine';
				}
				$folder_img = ($unread_topic) ? $folder_new : $folder;
				$folder_alt = ($unread_topic) ? 'NEW_POSTS' : (($fetch_news[$i]['topic_status'] == ITEM_LOCKED) ? 'TOPIC_LOCKED' : 'NO_NEW_POSTS');

				// Grab icons
				$icons = $cache->obtain_icons();

				$template->assign_block_vars('announcements_center_row', array(
					'ATTACH_ICON_IMG'		=> ($fetch_news[$i]['attachment'] && $config['allow_attachments']) ? $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']) : '',
					'FORUM_NAME'			=> ($forum_id) ? $fetch_news[$i]['forum_name'] : '',
					'TITLE'					=> $fetch_news[$i]['topic_title'],
					'POSTER'				=> $fetch_news[$i]['username'],
					'POSTER_FULL'			=> $fetch_news[$i]['username_full'],
					'USERNAME_FULL_LAST'	=> $fetch_news[$i]['username_full_last'],
					'U_USER_PROFILE'		=> (($fetch_news[$i]['user_type'] == USER_NORMAL || $fetch_news[$i]['user_type'] == USER_FOUNDER) && $fetch_news[$i]['user_id'] != ANONYMOUS) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $fetch_news[$i]['user_id']) : '',
					'TIME'					=> $fetch_news[$i]['topic_time'],
					'LAST_POST_TIME'		=> $user->format_date($fetch_news[$i]['topic_last_post_time']),
					'TEXT'					=> $fetch_news[$i]['post_text'],
					'REPLIES'				=> $fetch_news[$i]['topic_replies'],
					'TOPIC_VIEWS'			=> $fetch_news[$i]['topic_views'],
					'A_ID'					=> $i,
					'TOPIC_FOLDER_IMG'		=> $user->img($folder_img, $folder_alt),
					'TOPIC_FOLDER_IMG_SRC'	=> $user->img($folder_img, $folder_alt, false, '', 'src'),
					'TOPIC_FOLDER_IMG_ALT'	=> $user->lang[$folder_alt],
					'FOLDER_IMG'			=> $user->img('topic_read', 'NO_NEW_POSTS'),
					'TOPIC_ICON_IMG'		=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['img'] : '',
					'TOPIC_ICON_IMG_WIDTH'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['width'] : '',
					'TOPIC_ICON_IMG_HEIGHT'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['height'] : '',
					'U_VIEWFORUM'			=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $fetch_news[$i]['forum_id']),
					'U_LAST_COMMENTS'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id . '&amp;p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
					'U_VIEW_COMMENTS'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
					'U_VIEW_UNREAD'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id . '&amp;view=unread#unread'),
					'U_POST_COMMENT'		=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=reply&amp;' . (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
					'U_READ_FULL'			=> append_sid("{$phpbb_root_path}portal.$phpEx", $read_full_url),
					'L_READ_FULL'			=> $read_full,
					'OPEN'					=> $open_bracket,
					'CLOSE'					=> $close_bracket,
					'S_NOT_LAST'			=> ($i < sizeof($fetch_news) - 1) ? true : false,
					'S_POLL'				=> $fetch_news[$i]['poll'],
					'S_UNREAD_INFO'			=> $unread_topic,
					'PAGINATION'			=> topic_generate_pagination($fetch_news[$i]['topic_replies'], $view_topic_url),
					'S_HAS_ATTACHMENTS'		=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
				));

					if(!empty($fetch_news[$i]['attachments']))
					{
						foreach ($fetch_news[$i]['attachments'] as $attachment)
						{
							$template->assign_block_vars('announcements_center_row.attachment', array(
								'DISPLAY_ATTACHMENT'	=> $attachment)
							);
						}
					}
					if ($config['board3_number_of_announcements_' . $module_id] != 0 && $config['board3_announcements_archive_' . $module_id])
					{
						$template->assign_vars(array(
							'AP_PAGINATION'			=> $pagination,
							'TOTAL_ANNOUNCEMENTS'	=> ($total_announcements == 1) ? $user->lang['VIEW_LATEST_ANNOUNCEMENT'] : sprintf($user->lang['VIEW_LATEST_ANNOUNCEMENTS'], $total_announcements),
							'AP_PAGE_NUMBER'		=> on_page($total_announcements, $config['board3_number_of_announcements_' . $module_id], $start))
						);
					}
				}
			}
			else
			// Show "read full" page
			{ 
				$i = $announcement;

				/** 
				* redirect to portal page if the specified announcement does not exist
				* force #top anchor in order to get rid of the #a anchor
				*/
				if (!isset($fetch_news[$i]))
				{
					redirect(append_sid($phpbb_root_path . 'portal.' . $phpEx, '#top'));
				}

				$forum_id = $fetch_news[$i]['forum_id'];
				$topic_id = $fetch_news[$i]['topic_id'];
				$topic_tracking_info = get_complete_topic_tracking($forum_id, $topic_id, $global_announce_list = false);
				$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
				$open_bracket = '[ ';
				$close_bracket = ' ]';
				$read_full = $user->lang['BACK'];
				$real_forum_id = ($forum_id == 0) ? $fetch_news['global_id']: $forum_id;

				$read_full_url = (isset($_GET['ap'])) ? append_sid("{$phpbb_root_path}portal.$phpEx", "ap=$start#a$i") : append_sid("{$phpbb_root_path}portal.$phpEx#a$i");
				$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);
				if ($config['board3_announcements_archive_' . $module_id])
				{
					$pagination = generate_portal_pagination(append_sid("{$phpbb_root_path}portal.$phpEx"), $total_announcements, $config['board3_number_of_announcements_' . $module_id], $start, 'announcements');
				}	

				$template->assign_block_vars('announcements_center_row', array(
					'ATTACH_ICON_IMG'		=> ($fetch_news[$i]['attachment'] && $config['allow_attachments']) ? $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']) : '',
					'FORUM_NAME'			=> ($forum_id) ? $fetch_news[$i]['forum_name'] : '',
					'TITLE'					=> $fetch_news[$i]['topic_title'],
					'POSTER'				=> $fetch_news[$i]['username'],
					'POSTER_FULL'			=> $fetch_news[$i]['username_full'],
					'TIME'					=> $fetch_news[$i]['topic_time'],
					'TEXT'					=> $fetch_news[$i]['post_text'],
					'REPLIES'				=> $fetch_news[$i]['topic_replies'],
					'TOPIC_VIEWS'			=> $fetch_news[$i]['topic_views'],
					'A_ID'					=> $i,
					'U_VIEWFORUM'			=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $fetch_news[$i]['forum_id']),
					'U_LAST_COMMENTS'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id . '&amp;p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
					'U_VIEW_COMMENTS'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
					'U_POST_COMMENT'		=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=reply&amp;' . (($real_forum_id) ? 'f=' . $real_forum_id . '&amp;' : '') . 't=' . $topic_id),
					'S_POLL'				=> $fetch_news[$i]['poll'],
					'S_UNREAD_INFO'			=> $unread_topic,
					'U_READ_FULL'			=> $read_full_url,
					'L_READ_FULL'			=> $read_full,
					'OPEN'					=> $open_bracket,
					'CLOSE'					=> $close_bracket,
					'PAGINATION'			=> topic_generate_pagination($fetch_news[$i]['topic_replies'], $view_topic_url),
					'S_HAS_ATTACHMENTS'		=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
				));

				if(!empty($fetch_news[$i]['attachments']))
				{
					foreach ($fetch_news[$i]['attachments'] as $attachment)
					{
						$template->assign_block_vars('announcements_center_row.attachment', array(
							'DISPLAY_ATTACHMENT'	=> $attachment)
						);
					}
				}

				if ($config['board3_number_of_announcements_' . $module_id] <> 0 && $config['board3_announcements_archive_' . $module_id])
				{
					$template->assign_vars(array(
						'AP_PAGINATION'			=> $pagination,
						'TOTAL_ANNOUNCEMENTS'	=> ($total_announcements == 1) ? $user->lang['VIEW_LATEST_ANNOUNCEMENT'] : sprintf($user->lang['VIEW_LATEST_ANNOUNCEMENTS'], $total_announcements),
						'AP_PAGE_NUMBER'		=> on_page($total_announcements, $config['board3_number_of_announcements_' . $module_id], $start))
					);
				}
			}
		}

		$topic_icons = false;
		if(!empty($fetch_news['topic_icons']))
		{
			$topic_icons = true;
		}

		$template->assign_vars(array(
			'NEWEST_POST_IMG'				=> $user->img('icon_topic_newest', 'VIEW_NEWEST_POST'),
			'READ_POST_IMG'					=> $user->img('icon_topic_latest', 'VIEW_LATEST_POST'),
			'GOTO_PAGE_IMG'					=> $user->img('icon_post_target', 'GOTO_PAGE'),
			'S_DISPLAY_ANNOUNCEMENTS_RVS'	=> ($config['board3_show_announcements_replies_views_' . $module_id]) ? true : false,
			'S_TOPIC_ICONS'					=> $topic_icons,
		));

		if ($config['board3_announcements_style_' . $module_id])
		{
			return 'announcements_center_compact.html';
		}
		else
		{
			return 'announcements_center.html';
		}
	}

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
				'board3_global_announcements_forum_' . $module_id		=> array('lang' => 'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'	,	'validate' => 'string',	'type' => 'custom',			'explain' => true, 'method' => 'select_forums', 'submit' => 'store_selected_forums'),
				'board3_announcements_forum_exclude_' . $module_id		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE',	'validate' => 'string', 'type' => 'radio:yes_no',	'explain' => true),
				'board3_announcements_archive_' . $module_id			=> array('lang' => 'PORTAL_ANNOUNCEMENTS_ARCHIVE',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_announcements_permissions_' . $module_id		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_PERMISSIONS'	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
				'board3_show_announcements_replies_views_' . $module_id	=> array('lang' => 'PORTAL_SHOW_REPLIES_VIEWS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
			),
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_announcements_style_' . $module_id, 0);
		set_config('board3_number_of_announcements_' . $module_id, 1);
		set_config('board3_announcements_day_' . $module_id, 0);
		set_config('board3_announcements_length_' . $module_id, 200);
		set_config('board3_global_announcements_forum_' . $module_id, '');
		set_config('board3_announcements_forum_exclude_' . $module_id, 0);
		set_config('board3_announcements_archive_' . $module_id, 1);
		set_config('board3_announcements_permissions_' . $module_id, 1);
		set_config('board3_show_announcements_replies_views_' . $module_id, 1);

		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

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

	// Create forum select box
	public function select_forums($value, $key, $module_id)
	{
		global $user, $config;

		$forum_list = make_forum_select(false, false, true, true, true, false, true);

		$selected = array();
		if(isset($config[$key]) && strlen($config[$key]) > 0)
		{
			$selected = explode(',', $config[$key]);
		}
		// Build forum options
		$s_forum_options = '<select id="' . $key . '" name="' . $key . '[]" multiple="multiple">';
		foreach ($forum_list as $f_id => $f_row)
		{
			$s_forum_options .= '<option value="' . $f_id . '"' . ((in_array($f_id, $selected)) ? ' selected="selected"' : '') . (($f_row['disabled']) ? ' disabled="disabled" class="disabled-option"' : '') . '>' . $f_row['padding'] . $f_row['forum_name'] . '</option>';
		}
		$s_forum_options .= '</select>';

		return $s_forum_options;

	}

	// Store selected forums
	public function store_selected_forums($key, $module_id)
	{
		global $db, $cache;

		// Get selected forums
		$values = request_var($key, array(0 => ''));
		$news = implode(',', $values);
		set_config($key, $news);
	}
}
