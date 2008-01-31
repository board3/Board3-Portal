<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/


if (!defined('IN_PHPBB'))
{
   exit;
}

// Get portal config
$sql = 'SELECT *
	FROM ' . PORTAL_CONFIG_TABLE;
$result = $db->sql_query($sql);

while( $row = $db->sql_fetchrow($result) )
{
	$portal_config_name = $row['config_name'];
	$portal_config_value = $row['config_value'];
	$portal_config[$portal_config_name] = $portal_config_value;
}

// 
include($phpbb_root_path . 'includes/message_parser.'.$phpEx);

// fetch post for news & announce
function phpbb_fetch_posts($forum_from, $number_of_posts, $text_length, $time, $type)
{
	global $db, $phpbb_root_path, $auth, $user, $bbcode_bitfield;

	$posts = array();
	
	$post_time = ($time == 0) ? '' : 't.topic_last_post_time > ' . (time() - $time * 86400) . ' AND';

	$forum_from = ( strpos($forum_from, ',') !== FALSE ) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());

	$str_where = '';

	$allow_access = $auth->acl_getf('f_read', true);

	if( sizeof($allow_access) ){

		if( sizeof($forum_from) )
		{
			foreach( $allow_access as $acc_id => $acc_data )
			{
				if( in_array($acc_id, $forum_from ) )
				{
					$str_where .= "t.forum_id = $acc_id OR ";
					if( !isset($gobal_f) )
					{				
						$global_f = $acc_id;
					}
				}
			}
		}
		else
		{
			foreach( $allow_access as $acc_id => $acc_bool )
			{
				
				$str_where .= "t.forum_id = $acc_id OR ";
				if( !isset($gobal_f) )
				{				
					$global_f = $acc_id;
				}
			}
		}

		if ($type == 'announcements')
		{
			// only global announcements for announcements block
			$topic_type = '(( t.topic_type = ' . POST_ANNOUNCE . ') OR ( t.topic_type = ' . POST_GLOBAL . ')) AND';
	
			if( strlen($str_where) > 0 )
			{
				$str_where = ( strlen($str_where) > 0 ) ? 'AND (t.forum_id = 0 OR ' . substr($str_where, 0, -4) . ')' : '';

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
							t.topic_poster = u.user_id
						LEFT JOIN
							' . FORUMS_TABLE . ' as f
						ON
							t.forum_id=f.forum_id
						LEFT JOIN
							' . POSTS_TABLE . ' as p
						ON
							t.topic_first_post_id = p.post_id
						WHERE
							' . $topic_type . '
							' . $post_time . '
							t.topic_status <> 2 AND
							t.topic_approved = 1
							' . $str_where .'
						ORDER BY
							t.topic_time DESC';
		
		
				// query the database
				if(!($result = $db->sql_query_limit($sql, $number_of_posts)))
				{
					die('Could not query topic information for board3 Portal announcements section');
				}
			
				//
				// fetch all postings
				//
				
				// Instantiate BBCode if need be
				if ($bbcode_bitfield !== '')
				{
					$phpEx = substr(strrchr(__FILE__, '.'), 1);
					include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
					$bbcode = new bbcode(base64_encode($bbcode_bitfield));
				}
				$i = 0;
				while ( ($row = $db->sql_fetchrow($result)) && ( ($i < $number_of_posts) || ($number_of_posts == '0') ) )
				{
						if ($row['user_id'] != ANONYMOUS && $row['user_colour'])
						{
							$row['username'] = '<b style="color:#' . $row['user_colour'] . '">' . $row['username'] . '</b>';
						}
						$posts[$i]['bbcode_uid'] = $row['bbcode_uid'];
						$len_check = $row['post_text'];
						$maxlen = $text_length;
						if (($text_length != 0) && (strlen($len_check) > $text_length))
						{
								$posts[$i]['post_text'] = censor_text(get_sub_taged_string(str_replace("\n", '<br/> ', $row['post_text']), $row['bbcode_uid'], $maxlen));
								$posts[$i]['striped'] = true;
						} else $posts[$i]['post_text'] = censor_text($row['post_text']);
			
						$posts[$i]['topic_id'] = $row['topic_id'];
						$posts[$i]['topic_last_post_id'] = $row['topic_last_post_id'];
						$posts[$i]['forum_id'] = $row['forum_id'];
						$posts[$i]['topic_replies'] = $row['topic_replies'];
						$posts[$i]['topic_time'] = $user->format_date($row['topic_time']);
						$posts[$i]['topic_last_post_time'] = $row['topic_last_post_time'];
						$posts[$i]['topic_title'] = $row['topic_title'];
						$posts[$i]['username'] = $row['username'];
						$posts[$i]['user_id'] = $row['user_id'];
						$posts[$i]['user_type'] = $row['user_type'];
						$posts[$i]['user_user_colour'] = $row['user_colour'];
						$posts[$i]['poll'] = ($row['poll_title']) ? true : false;
						$posts[$i]['attachment'] = ($row['topic_attachment']) ? true : false;
						$posts[$i]['topic_views'] = ($row['topic_views']);
						$posts[$i]['forum_name'] = ($row['forum_name']);
						$posts[$i]['global_id'] = ($global_f);
			
						$message = $posts[$i]['post_text'];
						$message = str_replace("\n", '<br />', $message);
						
					
						if ($auth->acl_get('f_html', $row['forum_id'])) 
						{
							$message = preg_replace('#<!\-\-(.*?)\-\->#is', '', $message); // Remove Comments from post content
						}
						// Second parse bbcode here
						if ($row['bbcode_bitfield'])
						{
							$bbcode->bbcode_second_pass($message, $row['bbcode_uid'], $row['bbcode_bitfield']);
						}
						$message = smiley_text($message); // Always process smilies after parsing bbcodes
						$posts[$i]['post_text']= ap_validate($message);	
						$i++;
				}
			}
			// return the result
			return $posts;
			}
		
			// news - get last post
		
			else if ($type == 'news_all')
			{
				// not show global announcements
				$topic_type = '( t.topic_type != ' . POST_ANNOUNCE . ' ) AND ( t.topic_type != ' . POST_GLOBAL . ') AND';
			}
			else
			{
				// only normal topic
				$topic_type = 't.topic_type = ' . POST_NORMAL . ' AND';
			}
		
	
		$str_where = 'AND (' . substr($str_where, 0, -4) . ')';	
	
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
					t.forum_id,
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
						t.topic_poster = u.user_id
					LEFT JOIN
						' . FORUMS_TABLE . ' as f
					ON
						t.forum_id=f.forum_id
					LEFT JOIN
						' . POSTS_TABLE . ' as p
					ON
						t.topic_first_post_id = p.post_id
					WHERE
						' . $topic_type . '
						' . $post_time . '
						t.topic_status <> 2 AND
						t.topic_approved = 1
						' . $str_where . '
				ORDER BY
					t.topic_last_post_time DESC';
	
		// query the database
		if(!($result = $db->sql_query_limit($sql, $number_of_posts)))
		{
			die('Could not query topic information for board Portal news section');
		}
	
		//
		// fetch all postings
		//
		
		// Instantiate BBCode if need be
		if ($bbcode_bitfield !== '')
		{
			$phpEx = substr(strrchr(__FILE__, '.'), 1);
			include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
			$bbcode = new bbcode(base64_encode($bbcode_bitfield));
		}
		$i = 0;
		while ( ($row = $db->sql_fetchrow($result)) && ( ($i < $number_of_posts) || ($number_of_posts == '0') ) )
		{
			if ( ($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0') )
			{
				if ($row['user_id'] != ANONYMOUS && $row['user_colour'])
				{
					$row['username'] = '<b style="color:#' . $row['user_colour'] . '">' . $row['username'] . '</b>';
				}
				$posts[$i]['bbcode_uid'] = $row['bbcode_uid'];
				$len_check = $row['post_text'];
				$maxlen = $text_length;
				if (($text_length != 0) && (strlen($len_check) > $text_length))
				{
						$posts[$i]['post_text'] = censor_text(get_sub_taged_string(str_replace("\n", '<br/> ', $row['post_text']), $row['bbcode_uid'], $maxlen));
						$posts[$i]['striped'] = true;
				} else $posts[$i]['post_text'] = censor_text($row['post_text']);
				
	
				$posts[$i]['topic_id'] = $row['topic_id'];
				$posts[$i]['topic_last_post_id'] = $row['topic_last_post_id'];
				$posts[$i]['forum_id'] = $row['forum_id'];
				$posts[$i]['topic_replies'] = $row['topic_replies'];
				$posts[$i]['topic_time'] = $user->format_date($row['topic_last_post_time']);
				$posts[$i]['topic_last_post_time'] = $row['topic_last_post_time'];
				$posts[$i]['topic_title'] = $row['topic_title'];
				$posts[$i]['username'] = $row['username'];
				$posts[$i]['user_id'] = $row['user_id'];
				$posts[$i]['user_type'] = $row['user_type'];
				$posts[$i]['user_user_colour'] = $row['user_colour'];
				$posts[$i]['poll'] = ($row['poll_title']) ? true : false;
				$posts[$i]['attachment'] = ($row['topic_attachment']) ? true : false;
				$posts[$i]['topic_views'] = ($row['topic_views']);
				$posts[$i]['forum_name'] = ($row['forum_name']);
	
				$message = $posts[$i]['post_text'];
				$message = str_replace("\n", '<br/> ', $message);
				
			
				if ($auth->acl_get('f_html', $row['forum_id'])) 
				{
					$message = preg_replace('#<!\-\-(.*?)\-\->#is', '', $message); // Remove Comments from post content
				}
				// Second parse bbcode here
				if ($row['bbcode_bitfield'])
				{
					$bbcode->bbcode_second_pass($message, $row['bbcode_uid'], $row['bbcode_bitfield']);
				}
				$message = smiley_text($message); // Always process smilies after parsing bbcodes
				$posts[$i]['post_text']= ap_validate($message);
				$i++;
			}
		}
		// return the result
		return $posts;
	}
	else
	{
		return array();
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
* Get user avatar  / barroved from RC4
*
* @param string $avatar Users assigned avatar name
* @param int $avatar_type Type of avatar
* @param string $avatar_width Width of users avatar
* @param string $avatar_height Height of users avatar
* @param string $alt Optional language string for alt tag within image, can be a language key or text
*
* @return string Avatar image
*/
function get_user_avatar($avatar, $avatar_type, $avatar_width, $avatar_height, $alt = 'USER_AVATAR')
{
	global $user, $portal_config, $config, $phpbb_root_path, $phpEx;

	if (empty($avatar) || !$avatar_type)
	{
		return '';
	}

	$avatar_img = '';

	switch ($avatar_type)
	{
		case AVATAR_UPLOAD:
			$avatar_img = $phpbb_root_path . "download/file.$phpEx?avatar=";
		break;

		case AVATAR_GALLERY:
			$avatar_img = $phpbb_root_path . $config['avatar_gallery_path'] . '/';
		break;
	}

	$avatar_img .= $avatar;
	return '<img src="' . $avatar_img . '" width="' . $avatar_width . '" height="' . $avatar_height . '" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';
}

/**
* Get user rank title and image  / barroved from RC4
*
* @param int $user_rank the current stored users rank id
* @param int $user_posts the users number of posts
* @param string &$rank_title the rank title will be stored here after execution
* @param string &$rank_img the rank image as full img tag is stored here after execution
* @param string &$rank_img_src the rank image source is stored here after execution
*
*/
function get_user_rank($user_rank, $user_posts, &$rank_title, &$rank_img, &$rank_img_src)
{
	global $ranks, $config;

	if (empty($ranks))
	{
		global $cache;
		$ranks = $cache->obtain_ranks();
	}

	if (!empty($user_rank))
	{
		$rank_title = (isset($ranks['special'][$user_rank]['rank_title'])) ? $ranks['special'][$user_rank]['rank_title'] : '';
		$rank_img = (!empty($ranks['special'][$user_rank]['rank_image'])) ? '<img src="' . $config['ranks_path'] . '/' . $ranks['special'][$user_rank]['rank_image'] . '" alt="' . $ranks['special'][$user_rank]['rank_title'] . '" title="' . $ranks['special'][$user_rank]['rank_title'] . '" />' : '';
		$rank_img_src = (!empty($ranks['special'][$user_rank]['rank_image'])) ? $config['ranks_path'] . '/' . $ranks['special'][$user_rank]['rank_image'] : '';
	}
	else
	{
		if (!empty($ranks['normal']))
		{
			foreach ($ranks['normal'] as $rank)
			{
				if ($user_posts >= $rank['rank_min'])
				{
					$rank_title = $rank['rank_title'];
					$rank_img = (!empty($rank['rank_image'])) ? '<img src="' . $config['ranks_path'] . '/' . $rank['rank_image'] . '" alt="' . $rank['rank_title'] . '" title="' . $rank['rank_title'] . '" />' : '';
					$rank_img_src = (!empty($rank['rank_image'])) ? $config['ranks_path'] . '/' . $rank['rank_image'] : '';
					break;
				}
			}
		}
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
    if (substr($sl, 0, 1) == '<') {
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

?>