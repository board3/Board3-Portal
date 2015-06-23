<?php
// @codingStandardsIgnoreFile
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

// Get portal config
function obtain_portal_config()
{
	global $db, $cache, $portal_config;

	if (($portal_config = $cache->get('portal_config')) === false)
	{
		$portal_config = $portal_cached_config = array();

		$sql = 'SELECT config_name, config_value
			FROM ' . PORTAL_CONFIG_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$portal_cached_config[$row['config_name']] = $row['config_value'];

			$portal_config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		$cache->put('portal_config', $portal_cached_config);
	}

	return $portal_config;
}

/**
* Set config value. Creates missing config entry.
* Only use this if your config value might exceed 255 characters, otherwise please use set_config
*/
function set_portal_config($config_name, $config_value)
{
	global $db, $cache, $portal_config;

	$sql = 'UPDATE ' . PORTAL_CONFIG_TABLE . "
		SET config_value = '" . $db->sql_escape($config_value) . "'
		WHERE config_name = '" . $db->sql_escape($config_name) . "'";
	$db->sql_query($sql);

	if (!$db->sql_affectedrows() && !isset($portal_config[$config_name]))
	{
		$sql = 'INSERT INTO ' . PORTAL_CONFIG_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'config_name'	=> $config_name,
			'config_value'	=> $config_value));
		$db->sql_query($sql);
	}

	$portal_config[$config_name] = $config_value;

	$cache->destroy('portal_config');
}

/**
 * Get portal modules
 *
 * @return array Portal modules array
 */
function obtain_portal_modules()
{
	global $db;

	$portal_modules = array();

	$sql = 'SELECT *
		FROM ' . PORTAL_MODULES_TABLE . '
		ORDER BY module_order ASC';
	$result = $db->sql_query($sql, 3600);

	while ($row = $db->sql_fetchrow($result))
	{
		$portal_modules[] = $row;
	}
	$db->sql_freeresult($result);
	return $portal_modules;
}

/**
* Fetch post for news & announce
*
* @deprecated 2.1.0-b1 (To be removed: 2.2.0)
*/
function phpbb_fetch_posts($module_id, $forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start = 0, $invert = false)
{
	global $phpbb_container;

	$fetch_posts = $phpbb_container->get('board3.portal.fetch_posts');
	$fetch_posts->set_module_id($module_id);

	return $fetch_posts->get_posts($forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start, $invert);
}

/**
* Censor title, return short title
*
* @param $title string title to censor
* @param $limit int short title character limit
*
*/
function character_limit(&$title, $limit = 0)
{
	$title = censor_text($title);
	if ($limit > 0)
	{
		return (strlen(utf8_decode($title)) > $limit + 3) ? truncate_string($title, $limit) . '...' : $title;
	}
	else
	{
		return $title;
	}
}

function ap_validate($str)
{
	$s = str_replace('<br />', '<br/>', $str);
	return str_replace('</li><br/>', '</li>', $s);
}

/**
* Pagination routine, generates archive number sequence
*/
function generate_portal_pagination($base_url, $num_items, $per_page, $start_item, $type, $module_id = 0, $add_prevnext_text = false, $tpl_prefix = '')
{
	global $template, $user;

	switch ($type)
	{
		case "announcements":
			$pagination_type = 'ap_' . $module_id;
			$anker = '#a_' . $module_id;
		break;
		case "news":
		case "news_all":
			$pagination_type = 'np_' . $module_id;
			$anker = '#n_' . $module_id;
		break;

		default:
			// this shouldn't happen but default to announcements
			$pagination_type = 'ap_' . $module_id;
			$anker = '#a_' . $module_id;
	}

	// Make sure $per_page is a valid value
	$per_page = ($per_page <= 0) ? 1 : $per_page;

	$seperator = '<li>&nbsp;</li>';
	$total_pages = ceil($num_items / $per_page);

	if ($total_pages == 1 || !$num_items)
	{
		return false;
	}

	$on_page = floor($start_item / $per_page) + 1;
	$url_delim = (strpos($base_url, '?') === false) ? '?' : '&amp;';

	$page_string = ($on_page == 1) ? '<ul><li class="active"><span>1</span></li>' : '<ul><li><a href="' . $base_url . $anker .'" role="button">1</a></li>';

	if ($total_pages > 5)
	{
		$start_cnt = min(max(1, $on_page - 4), $total_pages - 5);
		$end_cnt = max(min($total_pages, $on_page + 4), 6);

		// Add ... separator to pagination
		$page_string .= ($start_cnt > 1) ? '<li class="ellipsis" role="separator"><span>' . $user->lang['ELLIPSIS'] . '</span></li>' : $seperator;

		for ($i = $start_cnt + 1; $i < $end_cnt; ++$i)
		{
			$page_string .= ($i == $on_page) ? '<li class="active"><span>' . $i . '</span></li>' : '<li><a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($i - 1) * $per_page) . $anker . '" role="button">' . $i . '</a></li>';
			if ($i < $end_cnt - 1)
			{
				$page_string .= $seperator;
			}
		}

		// Add ... separator to pagination
		$page_string .= ($end_cnt < $total_pages) ? '<li class="ellipsis" role="separator"><span>' . $user->lang['ELLIPSIS'] . '</span></li>' : $seperator;
	}
	else
	{
		$page_string .= $seperator;

		for ($i = 2; $i < $total_pages; ++$i)
		{
			$page_string .= ($i == $on_page) ? '<li class="active"><span>' . $i . '</span></li>' : '<li><a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($i - 1) * $per_page) . $anker . '" role="button">' . $i . '</a></li>';
			if ($i < $total_pages)
			{
				$page_string .= $seperator;
			}
		}
	}
	$page_string .= ($on_page == $total_pages) ? '<li class="active"><span>' . $total_pages . '</span></li></ul>' : '<li><a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($total_pages - 1) * $per_page) . $anker . '" role="button">' . $total_pages . '</a></li></ul>';

	if ($add_prevnext_text)
	{
		if ($on_page != 1)
		{
			$page_string = '<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($on_page - 2) * $per_page) . $anker . '" role="button">' . $user->lang['PREVIOUS'] . '</a>&nbsp;&nbsp;' . $page_string;
		}

		if ($on_page != $total_pages)
		{
			$page_string .= '&nbsp;&nbsp;<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . ($on_page * $per_page) . $anker . '" role="button">' . $user->lang['NEXT'] . '</a>';
		}
	}

	$template->assign_vars(array(
		$tpl_prefix . 'BASE_URL'      => $base_url,
		'A_' . $tpl_prefix . 'BASE_URL'   => is_string($base_url) ? $base_url : '',
		$tpl_prefix . 'PER_PAGE'      => $per_page,

		$tpl_prefix . 'PREVIOUS_PAGE'   => ($on_page == 1) ? '' : $base_url . "{$url_delim}" . $pagination_type . '=' . (($on_page - 2) * $per_page) . $anker,
		$tpl_prefix . 'NEXT_PAGE'      => ($on_page == $total_pages) ? '' : $base_url . "{$url_delim}" . $pagination_type . '=' . ($on_page * $per_page) . $anker,
		$tpl_prefix . 'TOTAL_PAGES'      => $total_pages,
	));

	return $page_string;
}

/**
* get topic tracking info for news
* based on get_complete_tracking_info of phpBB3
* this should reduce the queries for the news and announcements block
*/
function get_portal_tracking_info($fetch_news)
{
	global $config, $request, $user;

	$last_read = $topic_ids = $forum_ids = $tracking_info = $rev_forum_ids = $user_lastmark = array();

	/**
	* group everything by the forum IDs
	*/
	$count = $fetch_news['topic_count'];
	for ($i = 0; $i < $count; ++$i)
	{
		$tracking_info[$fetch_news[$i]['forum_id']][] = $fetch_news[$i]['topic_id'];
		$topic_ids[] = $fetch_news[$i]['topic_id'];
		$forum_ids[] = $fetch_news[$i]['forum_id'];
		$rev_forum_ids[$fetch_news[$i]['topic_id']] = $fetch_news[$i]['forum_id']; // the other way round also helps
	}

	foreach ($tracking_info as $forum_id => $current_forum)
	{
		if ($config['load_db_lastread'] && $user->data['is_registered'])
		{
			global $db;

			$mark_time = array();

			$sql = 'SELECT topic_id, mark_time
				FROM ' . TOPICS_TRACK_TABLE . '
				WHERE user_id =  ' . (int) $user->data['user_id'] . '
					AND ' . $db->sql_in_set('topic_id', $current_forum);
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$last_read[$row['topic_id']] = $row['mark_time'];
			}
			$db->sql_freeresult($result);

			$current_forum = array_diff($current_forum, array_keys($last_read));

			if (sizeof($topic_ids))
			{
				$sql = 'SELECT forum_id, mark_time
					FROM ' . FORUMS_TRACK_TABLE . '
					WHERE user_id =  ' . (int) $user->data['user_id'] . '
						AND ' . $db->sql_in_set('forum_id', $forum_ids);
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$mark_time[$row['forum_id']] = $row['mark_time'];
				}
				$db->sql_freeresult($result);

				// Set user last mark time
				foreach ($forum_ids as $current_forum_id)
				{
					$user_lastmark[$current_forum_id] = (isset($mark_time[$current_forum_id])) ? $mark_time[$current_forum_id] : $user->data['user_lastmark'];
				}

				// @todo: also check if $user_lastmark has been defined for this specific forum_id
				foreach ($topic_ids as $topic_id)
				{
					if (!isset($last_read[$topic_id]) || (isset($user_lastmark[$rev_forum_ids[$topic_id]]) && $user_lastmark[$rev_forum_ids[$topic_id]] > $last_read[$topic_id]))
					{
						$last_read[$topic_id] =  $user_lastmark[$rev_forum_ids[$topic_id]];
					}
				}
			}
		}
		else if ($config['load_anon_lastread'] || $user->data['is_registered'])
		{
			global $tracking_topics;

			if (!isset($tracking_topics) || !sizeof($tracking_topics))
			{
				if ($request->is_set($config['cookie_name'] . '_track', \phpbb\request\request_interface::COOKIE))
				{
					$tracking_topics = $request->variable($config['cookie_name'] . '_track', '', true, \phpbb\request\request_interface::COOKIE);
				}
				else
				{
					$tracking_topics = '';
				}
				$tracking_topics = ($tracking_topics) ? tracking_unserialize($tracking_topics) : array();
			}

			if (!$user->data['is_registered'])
			{
				$user_lastmark = (isset($tracking_topics['l'])) ? base_convert($tracking_topics['l'], 36, 10) + $config['board_startdate'] : 0;
			}
			else
			{
				$user_lastmark = $user->data['user_lastmark'];
			}

			foreach ($topic_ids as $topic_id)
			{
				$topic_id36 = base_convert($topic_id, 10, 36);

				if (isset($tracking_topics['t'][$topic_id36]))
				{
					$last_read[$topic_id] = base_convert($tracking_topics['t'][$topic_id36], 36, 10) + $config['board_startdate'];
				}
			}

			$topic_ids = array_diff($topic_ids, array_keys($last_read));

			if (sizeof($topic_ids))
			{
				$mark_time = array();

				if (isset($tracking_topics['f'][$forum_id]))
				{
					$mark_time[$forum_id] = base_convert($tracking_topics['f'][$forum_id], 36, 10) + $config['board_startdate'];
				}

				$user_lastmark = (isset($mark_time[$forum_id])) ? $mark_time[$forum_id] : $user_lastmark;

				foreach ($topic_ids as $topic_id)
				{
					$last_read[$topic_id] = $user_lastmark;
				}
			}
		}
	}

	return $last_read;
}

/**
* Check if the entered source file actually exists
*
* @param string	$value		Filename of file to check
* @param string	$key		Key of the acp setting (unused here)
* @param int	$module_id	Module ID of this module
* @param bool	$force_error	Whether an error message should be triggered on
*				errors.
* @return bool|string False if file exists, an error string if file doesn't exist.
*/
function check_file_src($value, $key, $module_id, $force_error = true)
{
	global $phpbb_admin_path, $portal_root_path, $phpEx, $user;

	$error = '';

	// We check if the chosen file is present in the styles/all/ folder
	if (!file_exists($portal_root_path . 'styles/all/theme/images/portal/' . $value))
	{
		$error .= $user->lang['B3P_FILE_NOT_FOUND'] . ': styles/all/theme/images/portal/' . $value . '<br />';
	}

	if (!empty($error))
	{
		if ($force_error)
		{
			trigger_error($error . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\board3\portal\acp\portal_module&amp;mode=config&amp;module_id=' . $module_id)), E_USER_WARNING);
		}

		return $error;
	}
	else
	{
		return false;
	}
}

/**
* Get the groups a user is in
*
* @return array Array containing the user's groups
*/
function get_user_groups()
{
	global $cache, $db, $user;

	$groups_ary = $cache->get('_user_groups_' . $user->data['user_id']);

	if ($groups_ary === false)
	{
		$groups_ary = array();

		// get user's groups
		$sql = 'SELECT group_id
				FROM ' . USER_GROUP_TABLE . '
				WHERE user_id = ' . (int) $user->data['user_id'] . '
				ORDER BY group_id ASC';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$groups_ary[] = $row['group_id'];
		}
		$db->sql_freeresult($result);

		// save data in cache for 60 seconds
		$cache->put('_user_groups_' . $user->data['user_id'], $groups_ary, 60);
	}

	return $groups_ary;
}
