<?php

/**
*
* @package - Board3portal
* @version $Id: functions.php 668 2010-08-19 21:16:29Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

// Get portal config
function obtain_portal_config()
{
	global $db;

	$sql = 'SELECT config_name, config_value
		FROM ' . PORTAL_CONFIG_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$cached_portal_config[$row['config_name']] = $row['config_value'];
		$portal_config[$row['config_name']] = $row['config_value'];
	}
	$db->sql_freeresult($result);

	return $portal_config;
}

/**
* Set config value. Creates missing config entry.
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
}

// fetch post for news & announce
function phpbb_fetch_posts($forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start = 0, $invert = false)
{
	global $db, $phpbb_root_path, $auth, $user, $bbcode_bitfield, $bbcode, $portal_config, $config;

	$posts = array();
	$post_time = ($time == 0) ? '' : 'AND t.topic_time > ' . (time() - $time * 86400);
	$forum_from = (strpos($forum_from, ',') !== FALSE) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());
	$str_where = '';
	$topic_icons = array(0);
	$have_icons = 0;

	if($permissions == true)
	{
		$disallow_access = array_unique(array_keys($auth->acl_getf('!f_read', true)));
	} 
	else
	{
		$disallow_access = array();
	}
	
	if($invert == true)
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
			$str_where .= "t.forum_id = $acc_id OR ";
			if($type == 'announcements' && $global_f < 1 && $acc_id > 0)
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
			$user_link = ($portal_config['portal_news_style']) ? 't.topic_poster = u.user_id' : (($portal_config['portal_news_show_last']) ? 't.topic_last_poster_id = u.user_id' : 't.topic_poster = u.user_id' ) ;
			$post_link = ($portal_config['portal_news_style']) ? 't.topic_first_post_id = p.post_id' : (($portal_config['portal_news_show_last']) ? 't.topic_last_post_id = p.post_id' : 't.topic_first_post_id = p.post_id' ) ;
			$topic_order = ($portal_config['portal_news_show_last']) ? 't.topic_last_post_time DESC' : 't.topic_time DESC' ;
		break;
		case "news_all":
			$topic_type = '(t.topic_type <> ' . POST_ANNOUNCE . ') AND (t.topic_type <> ' . POST_GLOBAL . ')';
			$str_where = (strlen($str_where) > 0) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';
			$user_link = ($portal_config['portal_news_style']) ? 't.topic_poster = u.user_id' : (($portal_config['portal_news_show_last']) ? 't.topic_last_poster_id = u.user_id' : 't.topic_poster = u.user_id' ) ;
			$post_link = ($portal_config['portal_news_style']) ? 't.topic_first_post_id = p.post_id' : (($portal_config['portal_news_show_last']) ? 't.topic_last_post_id = p.post_id' : 't.topic_first_post_id = p.post_id' ) ;
			$topic_order = ($portal_config['portal_news_show_last']) ? 't.topic_last_post_time DESC' : 't.topic_time DESC' ;
		break;
	}

	if($type == 'announcements' && $global_f < 1)
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

		if(!sizeof($row))
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
		if(($auth->acl_get('u_download') && ($auth->acl_get('f_download', $row['forum_id']) || $row['forum_id'] == 0)) && $config['allow_attachments'] && $row['post_id'])
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

		if($global_f < 1)
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
		$i++;
	}
	$db->sql_freeresult($result);
	
	$posts['topic_icons'] = ((max($topic_icons) > 0) && $have_icons) ? true : false;
	$posts['topic_count'] = $i;

	if($global_f < 1)
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

// Don't let them mess up the complete portal layout in cut messages and do some real AP magic
function is_valid_bbtag($str, $bbuid)
{
	return (substr($str,0,1) == '[') && (strpos($str, ':'.$bbuid.']') > 0);
}

function get_end_bbtag($tag, $bbuid)
{
	$etag = '';
	for($i=0;$i<strlen($tag);$i++)
	{
		if ($tag[$i] == '[') 
		{
			$etag .= $tag[$i] . '/';
		}
		else if (($tag[$i] == '=') || ($tag[$i] == ':'))
		{
			if ($tag[1] == '*')
			{
				$etag .= ':m:'.$bbuid.']';
			}
			else if (substr($tag, 0, 6) == '[list=')
			{
				$etag .= ':o:'.$bbuid.']';
			}
			else if (substr($tag, 0, 5) == '[list')
			{
				$etag .= ':u:'.$bbuid.']';
			}
			else 
			{
				$etag .= ':'.$bbuid.']';
			}
			break;
		} 
		else 
		{
			$etag .= $tag[$i];
		}
	}
	return $etag;
}

function get_next_word($str)
{
	$ret = '';
	for($i=0;$i<strlen($str);$i++)
	{
		switch ($str[$i])
		{
			case ' ': //$ret .= ' '; break; break;
				return $ret . ' ';
			case '\\': 
				if ($str[$i+1] == 'n') return $ret . '\n';
			case '[': if ($i != 0) return $ret;
			default: $ret .= $str[$i];
		}    
	}
	return $ret;
}

function get_next_bbhtml_part($str)
{
	$lim =  substr($str,0,strpos($str,'>')+1);
	return substr($str,0,strpos($str, $lim, strlen($lim))+strlen($lim));
}

function get_sub_taged_string($str, $bbuid, $maxlen)
{
	$sl = $str;
	$ret = '';
	$ntext = '';
	$lret = '';
	$i = 0;
	$cnt = $maxlen;
	$last = '';
	$arr = array();

	while((strlen($ntext) < $cnt) && (strlen($sl) > 0))
	{
		$sr = '';
		if (substr($sl, 0, 1) == '[')
		{
			$sr = substr($sl,0,strpos($sl,']')+1);
		}
		/* GESCHLOSSENE HTML-TAGS BEACHTEN */
		if (substr($sl, 0, 2) == '<!')
		{
			$sr = get_next_bbhtml_part($sl);
			$ret .= $sr;
		} 
		else if (substr($sl, 0, 1) == '<')
		{
			$sr = substr($sl,0,strpos($sl,'>')+1);
			$ret .= $sr;
		}
		else if (is_valid_bbtag($sr, $bbuid))
		{
			if ($sr[1] == '/')
			{
				/* entfernt das endtag aus dem tag array */
				$tarr = array();
				$j = 0;
				foreach ($arr as $elem)
				{
					if (strcmp($elem[1],$sr) != 0) 
					{
						$tarr[$j++] = $elem;
					}
				}
				$arr = $tarr;
			}
			else
			{
				$arr[$i][0] = $sr;
				$arr[$i++][1] = get_end_bbtag($sr, $bbuid);
			} 
			$ret .= $sr;
		}
		else
		{
			$sr = get_next_word($sl);
			$ret .= $sr;
			$ntext .= $sr;
			$last = $sr;
		}
		$sl = substr($sl, strlen($sr), strlen($sl)-strlen($sr));
	}
	
	$ap = '';

	foreach ($arr as $elem)
	{
		$ap = $elem[1] . $ap;
	}

	$ret .= $ap;
	$ret = trim($ret);
	if(substr($ret, -4) == '<!--')
	{
		$ret .= ' -->';
	}
	$ret = add_endtag($ret);
	$ret = $ret . '...';
	return $ret;
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

		for ($i = $start_cnt + 1; $i < $end_cnt; $i++)
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

		for ($i = 2; $i < $total_pages; $i++)
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
		$time->time_now	= time();
		$lang_dates		= $user->lang['datetime'];
		$format			= (!$format) ? $time->date_format : $format;

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
* check for invalid link tag at the end of a cut string
*/
function add_endtag ($message = '')
{
	$check = (int) strripos($message, '<!-- m --><a ');
	$check_2 = (int) strripos($message, '</a><!--');
	
	if(((isset($check) && $check > 0) && ($check_2 <= $check)) || ((isset($check) && $check > 0) && !isset($check_2)))
	{
		$message .= '</a><!-- m -->';
	}
	
	return $message;
}

/**
* validate URLs and execute apppend_sid if necessary
*/
function portal_validate_url($url)
{
	global $config;

	$url = str_replace("\r\n", "\n", str_replace('\"', '"', trim($url)));
	$url = str_replace(' ', '%20', $url);
	
	// if there is no scheme, then add http schema
	if (!preg_match('#^[a-z][a-z\d+\-.]*:/{2}#i', $url))
	{
		$url = 'http://' . $url;
	}
	
	// Is this a link to somewhere inside this board? If so then remove the session id from the url
	if (strpos($url, generate_board_url()) !== false && strpos($url, 'sid=') !== false)
	{
		$url = preg_replace('/(&amp;|\?)sid=[0-9a-f]{32}&amp;/', '\1', $url);
		$url = preg_replace('/(&amp;|\?)sid=[0-9a-f]{32}$/', '', $url);
		$url = append_sid($url);
	}
	
	return $url;
}

// Mini Cal.
class calendar 
{
	var $dateYYY;						// year in numeric format (YYYY)
	var $dateMM;						// month in numeric format (MM)
	var $dateDD;						// day in numeric format (DD)
	var $ext_dateMM;					// extended month (e.g. February)
	var $daysMonth;						// count of days in month
	var $stamp;							// timestamp
	var $day;							// return array s.a.

	/**
	* convert date->timestamp
	**/
	function makeTimestamp($date) 
	{
		$this->stamp = strtotime($date);
		return ($this->stamp);
	}

	/**
	* get date listed in array
	**/
	function getMonth($callDate) 
	{

		$this->makeTimestamp($callDate);
		$this->dateYYYY = date("Y", $this->stamp);
		$this->dateMM = date("n", $this->stamp);
		$this->ext_dateMM = date("F", $this->stamp);
		$this->dateDD = date("d", $this->stamp);
		$this->daysMonth = date("t", $this->stamp);
    
		for($i=1; $i < $this->daysMonth+1; $i++) 
		{
			$this->makeTimestamp("$i $this->ext_dateMM $this->dateYYYY");
			$this->day[] = array(
				"0" => "$i",
				"1" => $this->dateMM,
				"2" => $this->dateYYYY,
				"3" => (date('w', $this->stamp))
				);
		}
	}
} 

?>