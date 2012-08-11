<?php
/**
*
* @package Board3 Portal v2
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB') && !defined('UMIL_AUTO') && !defined('IN_INSTALL'))
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
*/
function obtain_portal_modules()
{
	global $db, $cache, $portal_modules;

	if (($portal_modules = $cache->get('portal_modules')) === false)
	{
		$portal_modules = $portal_cached_modules = array();

		$sql = 'SELECT *
			FROM ' . PORTAL_MODULES_TABLE . '
			ORDER BY module_order ASC';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$portal_cached_modules[] = $row;

			$portal_modules[] = $row;
		}
		$db->sql_freeresult($result);

		$cache->put('portal_modules', $portal_cached_modules);
	}

	return $portal_modules;
}

// fetch post for news & announce
function phpbb_fetch_posts($module_id, $forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start = 0, $invert = false)
{
	global $db, $phpbb_root_path, $auth, $user, $bbcode_bitfield, $bbcode, $portal_config, $config;

	$posts = $update_count = array();
	$post_time = ($time == 0) ? '' : 'AND t.topic_time > ' . (time() - $time * 86400);
	$forum_from = (strpos($forum_from, ',') !== FALSE) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());
	$str_where = '';
	$topic_icons = array(0);
	$have_icons = 0;

	if ($permissions == true)
	{
		$disallow_access = array_unique(array_keys($auth->acl_getf('!f_read', true)));
	} 
	else
	{
		$disallow_access = array();
	}

	if ($invert == true)
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
			$acc_id = (int) $acc_id;
			$str_where .= "t.forum_id = $acc_id OR ";
			if ($type == 'announcements' && $global_f < 1 && $acc_id > 0)
			{
				$global_f = $acc_id;
			}
		}
	}
	else
	{
		foreach ($disallow_access as $acc_id)
		{
			$acc_id = (int) $acc_id;
			$str_where .= "t.forum_id <> $acc_id AND ";
		}
	}

	switch($type)
	{
		case "announcements":
			$topic_type = '((t.topic_type = ' . POST_ANNOUNCE . ') OR (t.topic_type = ' . POST_GLOBAL . '))';
			$str_where = (strlen($str_where) > 0) ? 'AND (t.forum_id = 0 OR (' . trim(substr($str_where, 0, -4)) . '))' : '';
			$user_link = 't.topic_poster = u.user_id';
			$post_link = 't.topic_first_post_id = p.post_id';
			$topic_order = 't.topic_time DESC';
		break;
		case "news":
			$topic_type = 't.topic_type = ' . POST_NORMAL;
			$str_where = (strlen($str_where) > 0) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';
			$user_link = ($config['board3_news_style_' . $module_id]) ? 't.topic_poster = u.user_id' : (($config['board3_news_show_last_' . $module_id]) ? 't.topic_last_poster_id = u.user_id' : 't.topic_poster = u.user_id' ) ;
			$post_link = ($config['board3_news_style_' . $module_id]) ? 't.topic_first_post_id = p.post_id' : (($config['board3_news_show_last_' . $module_id]) ? 't.topic_last_post_id = p.post_id' : 't.topic_first_post_id = p.post_id' ) ;
			$topic_order = ($config['board3_news_show_last_' . $module_id]) ? 't.topic_last_post_time DESC' : 't.topic_time DESC' ;
		break;
		case "news_all":
			$topic_type = '(t.topic_type <> ' . POST_ANNOUNCE . ') AND (t.topic_type <> ' . POST_GLOBAL . ')';
			$str_where = (strlen($str_where) > 0) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';
			$user_link = ($config['board3_news_style_' . $module_id]) ? 't.topic_poster = u.user_id' : (($config['board3_news_show_last_' . $module_id]) ? 't.topic_last_poster_id = u.user_id' : 't.topic_poster = u.user_id' ) ;
			$post_link = ($config['board3_news_style_' . $module_id]) ? 't.topic_first_post_id = p.post_id' : (($config['board3_news_show_last_' . $module_id]) ? 't.topic_last_post_id = p.post_id' : 't.topic_first_post_id = p.post_id' ) ;
			$topic_order = ($config['board3_news_show_last_' . $module_id]) ? 't.topic_last_post_time DESC' : 't.topic_time DESC' ;
		break;

        default:
            $topic_type = $str_where = $user_link = $post_link = '';
            $topic_order = 't.topic_time DESC';
            // maybe use trigger_error here, as this shouldn't happen
	}

	if ($type == 'announcements' && $global_f < 1)
	{
		$sql = 'SELECT
					forum_id
				FROM
					' . FORUMS_TABLE . '
				WHERE
					forum_type = ' . FORUM_POST . '
					' . str_replace('t.', '', $str_where) . '
				ORDER BY
					forum_id';
		$result = $db->sql_query_limit($sql, 1);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if (!sizeof($row))
		{
			return array();
		}
		$global_f = $row['forum_id'];
	}

	$sql_array = array(
		'SELECT' => 't.forum_id,
			t.topic_id,
			t.topic_last_post_id,
			t.topic_last_post_time,
			t.topic_time,
			t.topic_title,
			t.topic_attachment,
			t.topic_views,
			t.poll_title,
			t.topic_replies,
			t.topic_replies_real,
			t.topic_poster,
			t.topic_type,
			t.topic_status,
			t.topic_last_poster_name,
			t.topic_last_poster_id,
			t.topic_last_poster_colour,
			t.icon_id,
			u.username,
			u.user_id,
			u.user_type,
			u.user_colour,
			p.post_id,
			p.poster_id,
			p.post_time,
			p.post_text,
			p.post_attachment,
			p.post_username,
			p.enable_smilies,
			p.enable_bbcode,
			p.enable_magic_url,
			p.bbcode_bitfield,
			p.bbcode_uid,
			f.forum_name,
			f.enable_icons',
		'FROM' => array(
			TOPICS_TABLE => 't',
		),
		'LEFT_JOIN' => array(
			array(
				'FROM' => array(USERS_TABLE => 'u'),
				'ON' => $user_link,
			),
			array(
				'FROM' => array(FORUMS_TABLE => 'f'),
				'ON' => 't.forum_id=f.forum_id',
			),
			array(
				'FROM' => array(POSTS_TABLE => 'p'),
				'ON' => $post_link,
			),
		),
		'WHERE' => $topic_type . '
				' . $post_time . '
				AND t.topic_status <> ' . ITEM_MOVED . '
				AND t.topic_approved = 1
				AND t.topic_moved_id = 0
				' . $str_where,
		'ORDER_BY' => $topic_order,
	);

	$sql_array['LEFT_JOIN'][] = array('FROM' => array(TOPICS_POSTED_TABLE => 'tp'), 'ON' => 'tp.topic_id = t.topic_id AND tp.user_id = ' . $user->data['user_id']);
	$sql_array['SELECT'] .= ', tp.topic_posted';
	$sql = $db->sql_build_query('SELECT', $sql_array);

	if ($number_of_posts != 0)
	{
		$result = $db->sql_query_limit($sql, $number_of_posts, $start);
	}
	else
	{
		$result = $db->sql_query($sql);
	}

	$i = 0;

	while ($row = $db->sql_fetchrow($result))
	{
		$attachments = array();
		if (($auth->acl_get('u_download') && ($auth->acl_get('f_download', $row['forum_id']) || $row['forum_id'] == 0)) && $config['allow_attachments'] && $row['post_id'] && $row['post_attachment'])
		{
			// Pull attachment data
			$sql2 = 'SELECT *
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE post_msg_id = '. $row['post_id'] .'
				AND in_message = 0
				ORDER BY filetime DESC';
			$result2 = $db->sql_query($sql2);

			while ($row2 = $db->sql_fetchrow($result2))
			{
				$attachments[] = $row2;
			}
			$db->sql_freeresult($result2);
		}

		$posts[$i]['bbcode_uid'] = $row['bbcode_uid'];
		$len_check = $row['post_text'];
		$maxlen = $text_length;

		if (($text_length != 0) && (strlen($len_check) > $text_length))
		{
			$message = str_replace(array("\n", "\r"), array('<br />', "\n"), $row['post_text']);
			$message = get_sub_taged_string($message, $row['bbcode_uid'], $maxlen);
			$posts[$i]['striped'] = true;
		}
		else 
		{
			$message = str_replace("\n", '<br/> ', $row['post_text']);
		}

		$row['bbcode_options'] = (($row['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) + (($row['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + (($row['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
		$message = generate_text_for_display($message, $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']);

		if (!empty($attachments))
		{
			parse_attachments($row['forum_id'], $message, $attachments, $update_count);
		}

		if ($global_f < 1)
		{
			$global_f = $row['forum_id'];
		}

		$topic_icons[] = $row['enable_icons'];
		$have_icons = ($row['icon_id'] > 0) ? 1 : $have_icons;

		$posts[$i] = array_merge($posts[$i], array(
			'post_text'				=> ap_validate($message),
			'topic_id'				=> $row['topic_id'],
			'topic_last_post_id'	=> $row['topic_last_post_id'],
			'topic_type'			=> $row['topic_type'],
			'topic_posted'			=> (isset($row['topic_posted']) && $row['topic_posted']) ? true : false,
			'icon_id'				=> $row['icon_id'],
			'topic_status'			=> $row['topic_status'],
			'forum_id'				=> $row['forum_id'],
			'topic_replies'			=> $row['topic_replies'],
			'topic_replies_real'	=> $row['topic_replies_real'],
			'topic_time'			=> $user->format_date($row['post_time']),
			'topic_last_post_time'	=> $row['topic_last_post_time'],
			'topic_title'			=> $row['topic_title'],
			'username'				=> $row['username'],
			'username_full'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['post_username']),
			'username_full_last'	=> get_username_string('full', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour'], $row['topic_last_poster_name']),
			'user_id'				=> $row['user_id'],
			'user_type'				=> $row['user_type'],
			'user_colour'			=> $row['user_colour'],
			'poll'					=> ($row['poll_title']) ? true : false,
			'attachment'			=> ($row['topic_attachment']) ? true : false,
			'topic_views'			=> $row['topic_views'],
			'forum_name'			=> $row['forum_name'],
			'attachments'			=> (!empty($attachments)) ? $attachments : array(),
		));
		$posts['global_id'] = $global_f;
		++$i;
	}
	$db->sql_freeresult($result);

	$posts['topic_icons'] = ((max($topic_icons) > 0) && $have_icons) ? true : false;
	$posts['topic_count'] = $i;

	if ($global_f < 1)
	{
		return array();
	}
	else
	{
		return $posts;
	}
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

/**
* Cut post text to given length
*
* @param $message string post text
* @param $bbcode_uid string bbcode uid
* @param $length int The desired length
*/
function get_sub_taged_string($message, $bbcode_uid, $length)
{
	global $phpbb_root_path, $phpEx;

	if(!class_exists('phpbb_trim_message'))
	{
		include($phpbb_root_path . 'includes/trim_message/trim_message.' . $phpEx);
	}
	
	if(!class_exists('phpbb_trim_message_bbcodes'))
	{
		include($phpbb_root_path . 'includes/trim_message/bbcodes.' . $phpEx);
	}

	$object = new phpbb_trim_message($message, $bbcode_uid, $length);
	// Ready to get parsed:
	return $object->message();
}

function ap_validate($str)
{
	$s = str_replace('<br />', '<br/>', $str);
	return str_replace('</li><br/>', '</li>', $s);
}

/**
* Pagination routine, generates archive number sequence
*/
function generate_portal_pagination($base_url, $num_items, $per_page, $start_item, $type, $add_prevnext_text = false, $tpl_prefix = '')
{
	global $template, $user;

	switch($type)
	{
		case "announcements":
			$pagination_type = 'ap';
			$anker = '#a';
		break;
		case "news":
		case "news_all":
			$pagination_type = 'np';
			$anker = '#n';
		break;

        default:
            // this shouldn't happend @todo: use trigger_error()
            $pagination_type = 'ap';
            $anker = '#a';
	}

	// Make sure $per_page is a valid value
	$per_page = ($per_page <= 0) ? 1 : $per_page;

	$seperator = '<span class="page-sep">' . $user->lang['COMMA_SEPARATOR'] . '</span>';
	$total_pages = ceil($num_items / $per_page);

	if ($total_pages == 1 || !$num_items)
	{
		return false;
	}

	$on_page = floor($start_item / $per_page) + 1;
	$url_delim = (strpos($base_url, '?') === false) ? '?' : '&amp;';

	$page_string = ($on_page == 1) ? '<strong>1</strong>' : '<a href="' . $base_url . $anker .'">1</a>';

	if ($total_pages > 5)
	{
		$start_cnt = min(max(1, $on_page - 4), $total_pages - 5);
		$end_cnt = max(min($total_pages, $on_page + 4), 6);

		$page_string .= ($start_cnt > 1) ? ' ... ' : $seperator;

		for ($i = $start_cnt + 1; $i < $end_cnt; ++$i)
		{
			$page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($i - 1) * $per_page) . $anker . '">' . $i . '</a>';
			if ($i < $end_cnt - 1)
			{
				$page_string .= $seperator;
			}
		}
		$page_string .= ($end_cnt < $total_pages) ? ' ... ' : $seperator;
	}
	else
	{
		$page_string .= $seperator;

		for ($i = 2; $i < $total_pages; ++$i)
		{
			$page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($i - 1) * $per_page) . $anker . '">' . $i . '</a>';
			if ($i < $total_pages)
			{
				$page_string .= $seperator;
			}
		}
	}
	$page_string .= ($on_page == $total_pages) ? '<strong>' . $total_pages . '</strong>' : '<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($total_pages - 1) * $per_page) . $anker . '">' . $total_pages . '</a>';

	if ($add_prevnext_text)
	{
		if ($on_page != 1)
		{
			$page_string = '<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . (($on_page - 2) * $per_page) . $anker . '">' . $user->lang['PREVIOUS'] . '</a>&nbsp;&nbsp;' . $page_string;
		}

		if ($on_page != $total_pages)
		{
			$page_string .= '&nbsp;&nbsp;<a href="' . $base_url . "{$url_delim}" . $pagination_type . '=' . ($on_page * $per_page) . $anker . '">' . $user->lang['NEXT'] . '</a>';
		}
	}

	$template->assign_vars(array(
		$tpl_prefix . 'BASE_URL'      => $base_url,
		'A_' . $tpl_prefix . 'BASE_URL'   => addslashes($base_url),
		$tpl_prefix . 'PER_PAGE'      => $per_page,

		$tpl_prefix . 'PREVIOUS_PAGE'   => ($on_page == 1) ? '' : $base_url . "{$url_delim}" . $pagination_type . '=' . (($on_page - 2) * $per_page) . $anker,
		$tpl_prefix . 'NEXT_PAGE'      => ($on_page == $total_pages) ? '' : $base_url . "{$url_delim}" . $pagination_type . '=' . ($on_page * $per_page) . $anker,
		$tpl_prefix . 'TOTAL_PAGES'      => $total_pages,
	));

	return $page_string;
}

/**
* Format user date for the Birthday block
* Note: this function is used as we already added timezones, etc
*
* borrowed from Upcoming Birthday Mod
* @author: lefty
* changed to work outside session.php by B3P
* @function: format_dateucb
*/ 

function format_birthday($date, $format = false)
{
	global $user;

	$lang_dates		= $user->lang['datetime'];
	$format			= (!$format) ? $user->data['user_dateformat'] : $format;

	// Short representation of month in format
	if ((strpos($format, '\M') === false && strpos($format, 'M') !== false) || (strpos($format, '\r') === false && strpos($format, 'r') !== false))
	{
		$lang_dates['May'] = $lang_dates['May_short'];
	}
	unset($lang_dates['May_short']);

	// We need to create a UNIX timestamp for date()
	$day = substr($date, 0, strpos($date, '-'));
	$month = substr($date, (strpos($date, '-')+1), 2);
	$year = substr($date, -4);
	$birthday_time = mktime(0, 0, 0, $month, $day, $year);

	return strtr(@date(str_replace('|', '', $format), $birthday_time), $lang_dates);
}

/**
* Check if table exists
* @copyright (c) 2007 phpBB Group
*
* @param string	$table_name	The table name to check for
* @return bool true if table exists, else false
*/
function sql_table_exists($table_name)
{
	global $db;
	$db->sql_return_on_error(true);
	$result = $db->sql_query_limit('SELECT * FROM ' . $db->sql_escape($table_name), 1);
	$db->sql_return_on_error(false);

	if ($result)
	{
		$db->sql_freeresult($result);
		return true;
	}

	return false;
}

/**
* get topic tracking info for news
* based on get_complete_tracking_info of phpBB3
* this should reduce the queries for the news and announcements block
*/
function get_portal_tracking_info($fetch_news)
{
	global $config, $user;
	
	$last_read = $topic_ids = $forum_ids = $tracking_info = $rev_forum_ids = array();
	
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
				FROM ' . TOPICS_TRACK_TABLE . "
				WHERE user_id = {$user->data['user_id']}
					AND " . $db->sql_in_set('topic_id', $current_forum);
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
					FROM ' . FORUMS_TRACK_TABLE . "
					WHERE user_id = {$user->data['user_id']}
						AND " . $db->sql_in_set('forum_id', $forum_ids);
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$mark_time[$row['forum_id']] = $row['mark_time'];
				}
				$db->sql_freeresult($result);

                // @todo: do not use $current_forum here as this is already used by the outside foreach
				foreach($forum_ids as $current_forum)
				{
					$user_lastmark[$current_forum] = (isset($mark_time[$current_forum])) ? $mark_time[$current_forum] : $user->data['user_lastmark'];
				}

                // @todo: also check if $user_lastmark has been defined for this specific forum_id
				foreach ($topic_ids as $topic_id)
				{
					$last_read[$topic_id] = (!isset($last_read[$topic_id]) || $user_lastmark[$rev_forum_ids[$topic_id]] > $last_read[$topic_id]) ? $user_lastmark[$rev_forum_ids[$topic_id]] : $last_read[$topic_id];
				}
			}
		}
		else if ($config['load_anon_lastread'] || $user->data['is_registered'])
		{
			global $tracking_topics;

			if (!isset($tracking_topics) || !sizeof($tracking_topics))
			{
				$tracking_topics = (isset($_COOKIE[$config['cookie_name'] . '_track'])) ? ((STRIP) ? stripslashes($_COOKIE[$config['cookie_name'] . '_track']) : $_COOKIE[$config['cookie_name'] . '_track']) : '';
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
* This function will install the basic set of portal modules
*
* only set $purge_modules to false if you already know that the table is empty
* set $u_action to where the user should be redirected after this
* note that already existing data won't be deleted from the config and portal_config
* just to make sure we don't overwrite anything, the IDs won't be reset
* !! this function should usually only be executed once upon installing the portal !!
* DO NOT set $purge_modules to false unless you want to auto-add all modules again after deleting them (i.e. if your database was corrupted)
*/
function board3_basic_install($mode = 'install', $purge_modules = true, $u_action = '')
{
	global $db, $phpbb_root_path, $phpEx, $cache, $user, $table_prefix, $config;
	
	// Shouldn't happen but we should check this nonetheless
	if (!defined('PORTAL_MODULES_TABLE'))
	{
		include($phpbb_root_path . 'portal/includes/constants.' . $phpEx);
	}
	
	if ($mode == 'install')
	{
		$directory = $phpbb_root_path . 'portal/modules/';
		
		if ($purge_modules)
		{
			$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE;
			$result = $db->sql_query($sql);
			$db->sql_freeresult($result);
		}
		
		/* 
		* this is a list of the basic modules that will be installed
		* module_name => array(module_column, module_order)
		*/
		$modules_ary = array(
			// left column
			'portal_main_menu' 		=> array(1, 1),
			'portal_stylechanger'	=> array(1, 2),
			'portal_birthday_list'	=> array(1, 3),
			'portal_clock'			=> array(1, 4),
			'portal_search'			=> array(1, 5),
			'portal_attachments'	=> array(1, 7),
			'portal_topposters'		=> array(1, 8),
			'portal_latest_members'	=> array(1, 9),
			'portal_link_us'		=> array(1, 10),
			
			// center column
			'portal_welcome'		=> array(2, 1),
			'portal_recent'			=> array(2, 2),
			'portal_announcements'	=> array(2, 3),
			'portal_news'			=> array(2, 4),
			'portal_poll'			=> array(2, 5),
			'portal_whois_online'	=> array(2, 6),
			
			// right column
			'portal_user_menu'		=> array(3, 1),
			'portal_statistics'		=> array(3, 2),
			'portal_calendar'		=> array(3, 3),
			'portal_leaders'		=> array(3, 4),
			'portal_latest_bots'	=> array(3, 5),
			'portal_links'			=> array(3, 6),
		);
		
		foreach ($modules_ary as $module_name => $module_data)
		{			
			$class_name = $module_name . '_module';
			if (!class_exists($class_name))
			{
				include($directory . $module_name . '.' . $phpEx);
			}
			if (!class_exists($class_name))
			{
				trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
			}
			
			$c_class = new $class_name();

			$sql_ary = array(
				'module_classname'		=> substr($module_name, 7),
				'module_column'			=> $module_data[0],
				'module_order'			=> $module_data[1],
				'module_name'			=> $c_class->name,
				'module_image_src'		=> $c_class->image_src,
				'module_group_ids'		=> '',
				'module_image_width'	=> 16,
				'module_image_height'	=> 16,
				'module_status'			=> B3_MODULE_ENABLED,
			);
			$sql = 'INSERT INTO ' . PORTAL_MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
			$db->sql_query($sql);

			$c_class->install($db->sql_nextid());
		}
		
		// Make sure we get rid of old data
		$cache->destroy('portal_modules');

		return $user->lang['PORTAL_BASIC_INSTALL'];
	}
	else
	{
		$skip_entries = array(
			'board3_right_column_width',
			'board3_left_column_width',
			'board3_forum_index',
			'board3_version_check',
			'board3_right_column',
			'board3_left_column',
			'board3_enable',
			'board3_portal_version',
			'board3_phpbb_menu',
			'board3_display_jumpbox',
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE config_name ' . $db->sql_like_expression(utf8_clean_string('board3_') . $db->any_char) . '
					AND ' . $db->sql_in_set('config_name', $skip_entries, true);
		$db->sql_query($sql);
		
		return $user->lang['PORTAL_BASIC_UNINSTALL'];
	}
}

	
/**
* check if the entered source file actually exists
*/
function check_file_src($value, $key, $module_id, $force_error = true)
{
	global $db, $phpbb_root_path, $phpEx, $user;
	
	$error = '';
	
	// We check if the chosen file is present in all active styles
	$sql = 'SELECT st.theme_path
			FROM ' . STYLES_THEME_TABLE . ' st
				LEFT JOIN ' . STYLES_TABLE . ' s
					ON (st.theme_id = s.style_id)
			WHERE s.style_active = 1';
			
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result))
	{
		if (!file_exists($phpbb_root_path . 'styles/' . $row['theme_path'] . '/theme/images/portal/' . $value))
		{
			$error .= $user->lang['B3P_FILE_NOT_FOUND'] . ': styles/' . $row['theme_path'] . '/theme/images/portal/' . $value . '<br />';
		}
	}
	$db->sql_freeresult($result);
	
	if (!empty($error))
	{
		if ($force_error)
		{
			trigger_error($error . adm_back_link(append_sid("{$phpbb_root_path}adm/index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $module_id)), E_USER_WARNING );
		}
		else
		{
			return $error;
		}
	}
	else
	{
		return false;
	}
}
