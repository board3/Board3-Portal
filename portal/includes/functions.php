<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/


if (!defined('IN_PHPBB'))
{
   exit;
}

include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Get portal config
function obtain_portal_config()
{
	global $db, $cache;

	if (($portal_config = $cache->get('portal_config')) !== true)
	{
		$portal_config = $cached_portal_config = array();

		$sql = 'SELECT config_name, config_value
			FROM ' . PORTAL_CONFIG_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$cached_portal_config[$row['config_name']] = $row['config_value'];
			$portal_config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		$cache->put('portal_config', $cached_portal_config);
	}

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

// 
include($phpbb_root_path . 'includes/message_parser.'.$phpEx);

// fetch post for news & announce
function phpbb_fetch_posts($forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start = 0)
{
	global $db, $phpbb_root_path, $auth, $user, $bbcode_bitfield, $bbcode, $portal_config;
	
	$posts = array();

	$post_time = ($time == 0) ? '' : 'AND t.topic_time > ' . (time() - $time * 86400);

	$forum_from = ( strpos($forum_from, ',') !== FALSE ) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());

	$str_where = '';

	if( $permissions == TRUE )
	{
		$disallow_access = array_unique(array_keys($auth->acl_getf('!f_read', true)));
	} else {
		$disallow_access = array();
	}
	
	$global_f = 0;
	
	if( sizeof($forum_from) )
	{
		$disallow_access = array_diff($forum_from, $disallow_access);		
		if( !sizeof($disallow_access) )
		{
			return array();
		}
		
		foreach( $disallow_access as $acc_id)
		{
			$acc_id = (int) $acc_id;
			$str_where .= "t.forum_id = $acc_id OR ";
			if( $type == 'announcements' && $global_f < 1 && $acc_id > 0 )
			{
				$global_f = $acc_id;
			}
		}
	}
	else
	{
		foreach( $disallow_access as $acc_id )
		{
			$acc_id = (int) $acc_id;
			$str_where .= "t.forum_id <> $acc_id AND ";
		}
	}
	
	switch( $type )
	{
		case "announcements":

			$topic_type = '(( t.topic_type = ' . POST_ANNOUNCE . ') OR ( t.topic_type = ' . POST_GLOBAL . '))';
			$str_where = ( strlen($str_where) > 0 ) ? 'AND (t.forum_id = 0 OR (' . trim(substr($str_where, 0, -4)) . '))' : '';
			$user_link = 't.topic_poster = u.user_id';
			$post_link = 't.topic_first_post_id = p.post_id';
			$topic_order = 't.topic_time DESC';

		break;
		case "news":

			$topic_type = 't.topic_type = ' . POST_NORMAL;
			$str_where = ( strlen($str_where) > 0 ) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';
			$user_link = ( $portal_config['portal_news_show_last'] ) ? 't.topic_last_poster_id = u.user_id' : 't.topic_poster = u.user_id' ;
			$post_link = ( $portal_config['portal_news_show_last'] ) ? 't.topic_last_post_id = p.post_id' : 't.topic_first_post_id = p.post_id' ;
			$topic_order = 't.topic_last_post_time DESC';

		break;
		case "news_all":

			$topic_type = '( t.topic_type <> ' . POST_ANNOUNCE . ' ) AND ( t.topic_type <> ' . POST_GLOBAL . ')';
			$str_where = ( strlen($str_where) > 0 ) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';
			$user_link = ( $portal_config['portal_news_show_last'] ) ? 't.topic_last_poster_id = u.user_id' : 't.topic_poster = u.user_id' ;
			$post_link = ( $portal_config['portal_news_show_last'] ) ? 't.topic_last_post_id = p.post_id' : 't.topic_first_post_id = p.post_id' ;
			$topic_order = 't.topic_last_post_time DESC';

		break;
	}
	
	if( $type == 'announcements' && $global_f < 1 )
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
		if( !sizeof( $row ) )
		{
			return array();
		}
		$global_f = $row['forum_id'];
		
	}
	
	
	$sql = 'SELECT
				t.forum_id,
				t.topic_id,
				t.topic_last_post_id,
				t.topic_last_post_time,
				t.topic_time,
				t.topic_title,
				t.topic_attachment,
				t.topic_views,
				t.poll_title,
				t.topic_replies,
				t.topic_poster,
				u.username,
				u.user_id,
				u.user_type,
				u.user_colour,
				p.post_id,
				p.post_time,
				p.post_text,
				p.post_attachment,
				p.enable_smilies,
				p.enable_bbcode,
				p.enable_magic_url,
				p.bbcode_bitfield,
				p.bbcode_uid,
				f.forum_name
			FROM
				' . TOPICS_TABLE . ' AS t
			LEFT JOIN
				' . USERS_TABLE . ' as u
			ON
				' . $user_link . '
			LEFT JOIN
				' . FORUMS_TABLE . ' as f
			ON
				t.forum_id=f.forum_id
			LEFT JOIN
				' . POSTS_TABLE . ' as p
			ON
				' . $post_link . '
			WHERE
				' . $topic_type . '
				' . $post_time . '
				AND t.topic_status <> 2
				AND t.topic_approved = 1
				AND t.topic_moved_id = 0
				' . $str_where .'
			ORDER BY
				' . $topic_order;

		if ($number_of_posts <> 0)
		{
			$result = $db->sql_query_limit($sql, $number_of_posts, $start);
		} else {
			$result = $db->sql_query($sql);
		}

	// Instantiate BBCode if need be
	if ($bbcode_bitfield !== '')
	{
		$phpEx = substr(strrchr(__FILE__, '.'), 1);
		include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
		$bbcode = new bbcode(base64_encode($bbcode_bitfield));
	}

	$i = 0;

	while ( $row = $db->sql_fetchrow($result) )
	{
		if ($row['user_id'] != ANONYMOUS && $row['user_colour'])
		{
			$row['username'] = '<b style="color:#' . $row['user_colour'] . '">' . $row['username'] . '</b>';
		}

		// Pull attachment data
		$sql2 = 'SELECT *
		   FROM ' . ATTACHMENTS_TABLE . '
		   WHERE `post_msg_id` = '. $row['post_id'] .'
		   AND in_message = 0';
		            
		$result2 = $db->sql_query($sql2);

		while ($row2 = $db->sql_fetchrow($result2))
		{
		   $attachments[] = $row2;
		}
		$db->sql_freeresult($result2);
		
		$posts[$i]['bbcode_uid'] = $row['bbcode_uid'];
		$len_check = $row['post_text'];
		$maxlen = $text_length;

		if (($text_length != 0) && (strlen($len_check) > $text_length))
		{
			$message = censor_text(get_sub_taged_string(str_replace("\n", '<br/> ', $row['post_text']), $row['bbcode_uid'], $maxlen));
			$posts[$i]['striped'] = true;
		}
		else 
		{
			$message = censor_text( str_replace("\n", '<br/> ', $row['post_text']) );
		}

		// Second parse bbcode here
		if ($row['bbcode_bitfield'])
		{
			$bbcode->bbcode_second_pass($message, $row['bbcode_uid'], $row['bbcode_bitfield']);
		}
		if (!empty($attachments))
		{
		   parse_attachments($row['forum_id'], $message, $attachments, $update_count);
		}
		$message = smiley_text($message); // Always process smilies after parsing bbcodes
		
		if( $global_f < 1 )
		{				
			$global_f = $row['forum_id'];
		}

		$posts[$i] = array_merge($posts[$i], array(
			'post_text'				=> ap_validate($message),
			'topic_id'				=> $row['topic_id'],
			'topic_last_post_id'	=> $row['post_id'],
			'forum_id'				=> $row['forum_id'],
			'topic_replies'			=> $row['topic_replies'],
			'topic_time'			=> $user->format_date($row['post_time']),
			'topic_last_post_time'	=> $row['topic_last_post_time'],
			'topic_title'			=> $row['topic_title'],
			'username'				=> $row['username'],
			'username_full'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']),
			'user_id'				=> $row['user_id'],
			'user_type'				=> $row['user_type'],
			'user_colour'			=> $row['user_colour'],
			'poll'					=> ($row['poll_title']) ? true : false,
			'attachment'			=> ($row['topic_attachment']) ? true : false,
			'topic_views'			=> $row['topic_views'],
			'forum_name'			=> $row['forum_name']
		));
		$posts['global_id'] = $global_f;
								
		$i++;
	}
	
	if( $global_f < 1 )
	{
		return array();
	} else {
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

function is_valid_bbtag($str, $bbuid) {
  return (substr($str,0,1) == '[') && (strpos($str, ':'.$bbuid.']') > 0);
}

function get_end_bbtag($tag, $bbuid) {
  $etag = '';
  for($i=0;$i<strlen($tag);$i++) {
    if ($tag[$i] == '[') $etag .= $tag[$i] . '/';
    else if (($tag[$i] == '=') || ($tag[$i] == ':')) {
      if ($tag[1] == '*') $etag .= ':m:'.$bbuid.']';
      else if (strpos($tag, 'list')) $etag .= ':u:'.$bbuid.']';
      else $etag .= ':'.$bbuid.']';
      break;
    } else $etag .= $tag[$i];
  }

  return $etag;
}

function get_next_word($str) {
  $ret = '';
  for($i=0;$i<strlen($str);$i++) {
    switch ($str[$i]) {
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

function get_next_bbhtml_part($str) {
  $lim =  substr($str,0,strpos($str,'>')+1);
	return substr($str,0,strpos($str, $lim, strlen($lim))+strlen($lim));
}

function get_sub_taged_string($str, $bbuid, $maxlen) {
  $sl = $str;
  $ret = '';
  $ntext = '';
  $lret = '';
  $i = 0;
  $cnt = $maxlen;
  $last = '';
  $arr = array();

  while((strlen($ntext) < $cnt) && (strlen($sl) > 0)) {
    $sr = '';
    if (substr($sl, 0, 1) == '[') $sr = substr($sl,0,strpos($sl,']')+1);
    /* GESCHLOSSENE HTML-TAGS BEACHTEN */
    if (substr($sl, 0, 2) == '<!') {
			$sr = get_next_bbhtml_part($sl);
			$ret .= $sr;
		} else if (substr($sl, 0, 1) == '<') {
      	$sr = substr($sl,0,strpos($sl,'>')+1);
				$ret .= $sr;
    } else if (is_valid_bbtag($sr, $bbuid)) {
      if ($sr[1] == '/') {
        /* entfernt das endtag aus dem tag array */
        $tarr = array();
        $j = 0;
        foreach ($arr as $elem) {
          if (strcmp($elem[1],$sr) != 0) $tarr[$j++] = $elem;
        }
        $arr = $tarr;
      } else {
        $arr[$i][0] = $sr;
        $arr[$i++][1] = get_end_bbtag($sr, $bbuid);
      } 
      $ret .= $sr;
    } else {
      $sr = get_next_word($sl);
      $ret .= $sr;
      $ntext .= $sr;
      $last = $sr;
    }
    $sl = substr($sl, strlen($sr), strlen($sl)-strlen($sr));
  }

  $ret = trim($ret) . '...';

  $ap = '';
  foreach ($arr as $elem) {
     $ap = $elem[1] . $ap;
  }
  $ret .= $ap;

  return $ret;
}

function ap_validate($str) {
  $s = str_replace('<br />', '<br/>', $str);
  return str_replace('</li><br/>', '</li>', $s);
}

/**
* Pagination routine, generates archive number sequence
*/
    function generate_portal_pagination($base_url, $num_items, $per_page, $start_item, $type, $add_prevnext_text = false, $tpl_prefix = '')
    {
       global $template, $user;

       switch( $type )
       {
          case "announcements":
             $pagination_type = 'ap';
             $anker = '#a0';
          break;
          case "news":
          case "news_all":
             $pagination_type = 'np';
             $anker = '#n0';
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

?>
