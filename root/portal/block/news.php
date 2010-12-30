<?php

/**
*
* @package - Board3portal
* @version $Id: news.php 588 2009-12-04 17:16:46Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$news = request_var('news', -1);
$news = ($news > $portal_config['portal_news_length'] -1) ? -1 : $news;
$user->add_lang('viewforum');
$start = request_var('np', 0);
$start = ($start < 0) ? 0 : $start;

// Fetch news from portal/includes/functions.php with check if "read full" is requested.
$portal_news_length = ($news < 0) ? $portal_config['portal_news_length'] : 0;
$fetch_news = phpbb_fetch_posts($portal_config['portal_news_forum'], $portal_config['portal_news_permissions'], $portal_config['portal_number_of_news'], $portal_news_length, 0, ($portal_config['portal_show_all_news']) ? 'news_all' : 'news', $start, $portal_config['portal_news_exclude']);


// Any news present? If not terminate it here.
if (sizeof($fetch_news) == 0)
{
	$template->assign_block_vars('news_row', array(
		'S_NO_TOPICS'	=> true,
		'S_NOT_LAST'	=> false,
	));
}
else
{
	// Count number of posts for news archive, considering if permission check is dis- or enabled.
	if ($portal_config['portal_news_archive'])
	{
		$permissions = $portal_config['portal_news_permissions'];
		$forum_from = $portal_config['portal_news_forum'];

		$forum_from = (strpos($forum_from, ',') !== false) ? explode(',', $forum_from) : (($forum_from != '') ? array($forum_from) : array());

		$str_where = '';

		if($permissions == true)
		{
			$disallow_access = array_unique(array_keys($auth->acl_getf('!f_read', true)));
		}
		else
		{
			$disallow_access = array();
		}
		
		if($portal_config['portal_news_exclude'] == true)
		{
			$disallow_access = array_merge($disallow_access, $forum_from);
			$forum_from = array();
		}

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

		$str_where = (strlen($str_where) > 0) ? 'AND (' . trim(substr($str_where, 0, -4)) . ')' : '';

		$topic_type = ($portal_config['portal_show_all_news']) ? '(topic_type <> ' . POST_ANNOUNCE . ') AND (topic_type <> ' . POST_GLOBAL . ')' : 'topic_type = ' . POST_NORMAL;

		$sql = 'SELECT COUNT(topic_id) AS num_topics
			FROM ' . TOPICS_TABLE . '
			WHERE ' . $topic_type . '
				AND topic_approved = 1
				AND topic_moved_id = 0
				' . $str_where;
			$result = $db->sql_query($sql);
			$total_news = (int) $db->sql_fetchfield('num_topics');
			$db->sql_freeresult($result);
	}

	if($news < 0)
	// Show the news overview
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
			$topic_tracking_info = get_complete_topic_tracking($forum_id, $topic_id, $global_announce_list = false);
			$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
			
			$read_full_url = (isset($_GET['np'])) ? 'np='. $start . '&amp;news=' . $i . '#n' . $i : 'news=' . $i . '#n' . $i;
			$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);
			if ($portal_config['portal_news_archive'])
			{
				$pagination = generate_portal_pagination(append_sid("{$phpbb_root_path}portal.$phpEx"), $total_news, $portal_config['portal_number_of_news'], $start, ($portal_config['portal_show_all_news']) ? 'news_all' : 'news');
			}

			$replies = ($auth->acl_get('m_approve', $forum_id)) ? $fetch_news[$i]['topic_replies_real'] : $fetch_news[$i]['topic_replies'];
			$folder_img = $folder_alt = $topic_type = $folder = $folder_new = '';
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
			if ($fetch_news[$i]['topic_posted'])
			{
				$folder .= '_mine';
				$folder_new .= '_mine';
			}

			$folder_img = ($unread_topic) ? $folder_new : $folder;
			$folder_alt = ($unread_topic) ? 'NEW_POSTS' : (($fetch_news[$i]['topic_status'] == ITEM_LOCKED) ? 'TOPIC_LOCKED' : 'NO_NEW_POSTS');

			// Grab icons
			$icons = $cache->obtain_icons();

			$template->assign_block_vars('news_row', array(
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
				'N_ID'					=> $i,
				'TOPIC_FOLDER_IMG'		=> $user->img($folder_img, $folder_alt),
				'TOPIC_FOLDER_IMG_SRC'  => $user->img($folder_img, $folder_alt, false, '', 'src'),
				'TOPIC_FOLDER_IMG_ALT'  => $user->lang[$folder_alt],
				'TOPIC_ICON_IMG'		=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['img'] : '',
				'TOPIC_ICON_IMG_WIDTH'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['width'] : '',
				'TOPIC_ICON_IMG_HEIGHT'	=> (!empty($icons[$fetch_news[$i]['icon_id']])) ? $icons[$fetch_news[$i]['icon_id']]['height'] : '',
				'FOLDER_IMG'			=> $user->img('topic_read', 'NO_NEW_POSTS'),
				'U_VIEWFORUM'			=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $fetch_news[$i]['forum_id']),
				'U_LAST_COMMENTS'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id'] . '&amp;p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
				'U_VIEW_COMMENTS'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
				'U_VIEW_UNREAD'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id'] . '&amp;view=unread#unread'),
				'U_POST_COMMENT'		=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=reply&amp;f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
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
					$template->assign_block_vars('news_row.attachment', array(
						'DISPLAY_ATTACHMENT'	=> $attachment)
					);
				}
			}

			if ($portal_config['portal_number_of_news'] <> 0 && $portal_config['portal_news_archive'])
			{
				$template->assign_vars(array(
					'NP_PAGINATION'		=> $pagination,
					'TOTAL_NEWS'		=> ($total_news == 1) ? $user->lang['VIEW_FORUM_TOPIC'] : sprintf($user->lang['VIEW_FORUM_TOPICS'], $total_news),
					'NP_PAGE_NUMBER'	=> on_page($total_news, $portal_config['portal_number_of_news'], $start))
				);
			}
		}
	}
	else
	// Show "read full" page
	{
		$i = $news;
		$forum_id = $fetch_news[$i]['forum_id'];
		$topic_id = $fetch_news[$i]['topic_id'];
		$topic_tracking_info = get_complete_topic_tracking($forum_id, $topic_id, $global_announce_list = false);
		$unread_topic = (isset($topic_tracking_info[$topic_id]) && $fetch_news[$i]['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;
		$open_bracket = '[ ';
		$close_bracket = ' ]';
		$read_full = $user->lang['BACK'];
				
		$read_full_url = (isset($_GET['np'])) ? append_sid("{$phpbb_root_path}portal.$phpEx", "np=$start#n$i") : append_sid("{$phpbb_root_path}portal.$phpEx#n$i");
		$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $topic_id);
		if ($portal_config['portal_news_archive'])
		{
			$pagination = generate_portal_pagination(append_sid("{$phpbb_root_path}portal.$phpEx"), $total_news, $portal_config['portal_number_of_news'], $start, ($portal_config['portal_show_all_news']) ? 'news_all' : 'news');
		}

		$template->assign_block_vars('news_row', array(
			'ATTACH_ICON_IMG'	=> ($fetch_news[$i]['attachment'] && $config['allow_attachments']) ? $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']) : '',
			'FORUM_NAME'		=> ($forum_id) ? $fetch_news[$i]['forum_name'] : '',
			'TITLE'				=> $fetch_news[$i]['topic_title'],
			'POSTER'			=> $fetch_news[$i]['username'],
			'POSTER_FULL'		=> $fetch_news[$i]['username_full'],
			'TIME'				=> $fetch_news[$i]['topic_time'],
			'TEXT'				=> $fetch_news[$i]['post_text'],
			'REPLIES'			=> $fetch_news[$i]['topic_replies'],
			'TOPIC_VIEWS'		=> $fetch_news[$i]['topic_views'],
			'N_ID'				=> $i,
			'U_VIEWFORUM'		=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $fetch_news[$i]['forum_id']),
			'U_LAST_COMMENTS'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $fetch_news[$i]['topic_last_post_id'] . '#p' . $fetch_news[$i]['topic_last_post_id']),
			'U_VIEW_COMMENTS'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
			'U_POST_COMMENT'	=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=reply&amp;f=' . $fetch_news[$i]['forum_id'] . '&amp;t=' . $fetch_news[$i]['topic_id']),
			'S_POLL'			=> $fetch_news[$i]['poll'],
			'S_UNREAD_INFO'		=> $unread_topic,
			'U_READ_FULL'		=> $read_full_url,
			'L_READ_FULL'		=> $read_full,      
			'OPEN'				=> $open_bracket,
			'CLOSE'				=> $close_bracket,
			'PAGINATION'		=> topic_generate_pagination($fetch_news[$i]['topic_replies'], $view_topic_url),
			'S_HAS_ATTACHMENTS'	=> (!empty($fetch_news[$i]['attachments'])) ? true : false,
		));

		if(!empty($fetch_news[$i]['attachments']))
		{
			foreach ($fetch_news[$i]['attachments'] as $attachment)
			{
				$template->assign_block_vars('news_row.attachment', array(
					'DISPLAY_ATTACHMENT'	=> $attachment)
				);
			}
		}

		if ($portal_config['portal_number_of_news'] <> 0 && $portal_config['portal_news_archive'])
		{
			$template->assign_vars(array(
				'NP_PAGINATION'		=> $pagination,
				'TOTAL_NEWS'		=> ($total_news == 1) ? $user->lang['VIEW_FORUM_TOPIC'] : sprintf($user->lang['VIEW_FORUM_TOPICS'], $total_news),
				'NP_PAGE_NUMBER'	=> on_page($total_news, $portal_config['portal_number_of_news'], $start))
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
	'NEWEST_POST_IMG'			=> $user->img('icon_topic_newest', 'VIEW_NEWEST_POST'),
	'READ_POST_IMG'				=> $user->img('icon_topic_latest', 'VIEW_LATEST_POST'),
	'GOTO_PAGE_IMG'				=> $user->img('icon_post_target', 'GOTO_PAGE'),
	'S_NEWEST_OR_FIRST'			=> ($portal_config['portal_news_show_last']) ? $user->lang['JUMP_NEWEST'] : $user->lang['JUMP_FIRST'],
	'POSTED_BY_TEXT'			=> ($portal_config['portal_news_show_last']) ? $user->lang['LAST_POST'] : $user->lang['POSTED'],
	'S_DISPLAY_NEWS'			=> true,
	'S_DISPLAY_NEWS_RVS'		=> ($portal_config['portal_show_news_replies_views']) ? true : false,
	'S_TOPIC_ICONS'				=> $topic_icons,
));

?>