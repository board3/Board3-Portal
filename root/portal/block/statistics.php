<?php

/**
*
* @package - Board3portal
* @version $Id: statistics.php 648 2010-04-07 11:34:14Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

// Better function with only one query
function get_topics_count()
{
	global $db, $user;
	
	$return_ary = array(
		POST_ANNOUNCE => 0,
		POST_STICKY => 0,
	);
	
	$sql_in = array(
		POST_ANNOUNCE,
		POST_STICKY,
	);
	
	$sql = 'SELECT DISTINCT(topic_id) AS topic_id, topic_type AS type
				FROM ' . TOPICS_TABLE . '
				WHERE ' . $db->sql_in_set('topic_type', $sql_in, false);
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result))
	{
		switch($row['type'])
		{
			case POST_ANNOUNCE:
				++$return_ary[POST_ANNOUNCE];
			break;
			
			case POST_STICKY:
				++$return_ary[POST_STICKY];
			break;
		}
	}
	$db->sql_freeresult($result);
	
	return $return_ary;
}

// Set some stats, get posts count from forums data if we... hum... retrieve all forums data
$total_posts		= $config['num_posts'];
$total_topics		= $config['num_topics'];
$total_users		= $config['num_users'];
$total_files 		= $config['num_files'];

$l_total_user_s 	= ($total_users == 0) ? 'TOTAL_USERS_ZERO' : 'TOTAL_USERS_OTHER';
$l_total_post_s 	= ($total_posts == 0) ? 'TOTAL_POSTS_ZERO' : 'TOTAL_POSTS_OTHER';
$l_total_topic_s	= ($total_topics == 0) ? 'TOTAL_TOPICS_ZERO' : 'TOTAL_TOPICS_OTHER';

// avarage stat
$board_days = (time() - $config['board_startdate']) / 86400;

$topics_per_day		= ($total_topics) ? round($total_topics / $board_days, 0) : 0;
$posts_per_day		= ($total_posts) ? round($total_posts / $board_days, 0) : 0;
$users_per_day		= round($total_users / $board_days, 0);
$topics_per_user	= ($total_topics) ? round($total_topics / $total_users, 0) : 0;
$posts_per_user		= ($total_posts) ? round($total_posts / $total_users, 0) : 0;
$posts_per_topic	= ($total_topics) ? round($total_posts / $total_topics, 0) : 0;

if ($topics_per_day > $total_topics)
{
	$topics_per_day = $total_topics;
}

if ($posts_per_day > $total_posts)
{
	$posts_per_day = $total_posts;
}

if ($users_per_day > $total_users)
{
	$users_per_day = $total_users;
}

if ($topics_per_user > $total_topics)
{
	$topics_per_user = $total_topics;
}

if ($posts_per_user > $total_posts)
{
	$posts_per_user = $total_posts;
}

if ($posts_per_topic > $total_posts)
{
	$posts_per_topic = $total_posts;
}

$l_topics_per_day_s = ($total_topics == 0) ? 'TOPICS_PER_DAY_ZERO' : 'TOPICS_PER_DAY_OTHER';
$l_posts_per_day_s = ($total_posts == 0) ? 'POSTS_PER_DAY_ZERO' : 'POSTS_PER_DAY_OTHER';
$l_users_per_day_s = ($total_users == 0) ? 'USERS_PER_DAY_ZERO' : 'USERS_PER_DAY_OTHER';
$l_topics_per_user_s = ($total_topics == 0) ? 'TOPICS_PER_USER_ZERO' : 'TOPICS_PER_USER_OTHER';
$l_posts_per_user_s = ($total_posts == 0) ? 'POSTS_PER_USER_ZERO' : 'POSTS_PER_USER_OTHER';
$l_posts_per_topic_s = ($total_posts == 0) ? 'POSTS_PER_TOPIC_ZERO' : 'POSTS_PER_TOPIC_OTHER';

$topics_count = get_topics_count();


// Assign specific vars
$template->assign_vars(array(
	'S_DISPLAY_ADVANCED_STAT'	=> true,
	'TOTAL_POSTS'				=> sprintf($user->lang[$l_total_post_s], $total_posts),
	'TOTAL_TOPICS'				=> sprintf($user->lang[$l_total_topic_s], $total_topics),
	'TOTAL_USERS'				=> sprintf($user->lang[$l_total_user_s], $total_users),
	'NEWEST_USER'				=> sprintf($user->lang['NEWEST_USER'], get_username_string('full', $config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'])),
	'S_ANN'						=> $topics_count[POST_ANNOUNCE],
	'S_SCT'						=> $topics_count[POST_STICKY],
	'S_TOT_ATTACH'				=> ($config['allow_attachments']) ? $total_files : 0,

	// avarage stat
	'TOPICS_PER_DAY'	=> sprintf($user->lang[$l_topics_per_day_s], $topics_per_day),
	'POSTS_PER_DAY'		=> sprintf($user->lang[$l_posts_per_day_s], $posts_per_day),
	'USERS_PER_DAY'		=> sprintf($user->lang[$l_users_per_day_s], $users_per_day),
	'TOPICS_PER_USER'	=> sprintf($user->lang[$l_topics_per_user_s], $topics_per_user),
	'POSTS_PER_USER'	=> sprintf($user->lang[$l_posts_per_user_s], $posts_per_user),
	'POSTS_PER_TOPIC'	=> sprintf($user->lang[$l_posts_per_topic_s], $posts_per_topic),
));

?>