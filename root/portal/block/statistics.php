<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

// switch idea from phpBB2 :p
function get_db_stat($mode)
{
	global $db, $user;

	switch( $mode )
	{
		case 'announcementtotal':
			$sql = 'SELECT COUNT(distinct t.topic_id) AS announcement_total
				FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
				WHERE t.topic_type = ' . POST_ANNOUNCE . '
					AND p.post_id = t.topic_first_post_id';
		break;
		case 'stickytotal':
			$sql = 'SELECT COUNT(distinct t.topic_id) AS sticky_total
				FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
				WHERE t.topic_type = ' . POST_STICKY . '
					AND p.post_id = t.topic_first_post_id';
		break;
		case 'attachmentstotal':
			$sql = 'SELECT COUNT(attach_id) AS attachments_total
					FROM ' . ATTACHMENTS_TABLE;
		break;
	}
	
	if ( !($result = $db->sql_query($sql)) )
	{
		return false;
	}

	$row = $db->sql_fetchrow($result);
 
	switch ( $mode )
	{
		case 'announcementtotal':
			return $row['announcement_total'];
		break;
		case 'stickytotal':
			return $row['sticky_total'];
		break;
		case 'attachmentstotal':
			return $row['attachments_total'];
		break;
	}
	return false;
}

// Set some stats, get posts count from forums data if we... hum... retrieve all forums data
$total_posts		= $config['num_posts'];
$total_topics		= $config['num_topics'];
$total_users		= $config['num_users'];

$l_total_user_s 	= ($total_users == 0) ? 'TOTAL_USERS_ZERO' : 'TOTAL_USERS_OTHER';
$l_total_post_s 	= ($total_posts == 0) ? 'TOTAL_POSTS_ZERO' : 'TOTAL_POSTS_OTHER';
$l_total_topic_s	= ($total_topics == 0) ? 'TOTAL_TOPICS_ZERO' : 'TOTAL_TOPICS_OTHER';

// avarage stat
$board_days = ( time() - $config['board_startdate'] ) / 86400;

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

// Assign specific vars
$template->assign_vars(array(
	'TOTAL_POSTS'	=> sprintf($user->lang[$l_total_post_s], $total_posts),
	'TOTAL_TOPICS'	=> sprintf($user->lang[$l_total_topic_s], $total_topics),
	'TOTAL_USERS'	=> sprintf($user->lang[$l_total_user_s], $total_users),
	'NEWEST_USER'	=> sprintf($user->lang['NEWEST_USER'], get_username_string('full', $config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'])),
	'S_ANN'			=> get_db_stat('announcementtotal'),
	'S_SCT'			=> get_db_stat('stickytotal'),
	'S_TOT_ATTACH'	=> ($config['allow_attachments']) ? get_db_stat('attachmentstotal') : 0,
	
	// avarage stat
	'TOPICS_PER_DAY'	=> sprintf($user->lang[$l_topics_per_day_s], $topics_per_day),
	'POSTS_PER_DAY'		=> sprintf($user->lang[$l_posts_per_day_s], $posts_per_day),
	'USERS_PER_DAY'		=> sprintf($user->lang[$l_users_per_day_s], $users_per_day),
	'TOPICS_PER_USER'	=> sprintf($user->lang[$l_topics_per_user_s], $topics_per_user),
	'POSTS_PER_USER'	=> sprintf($user->lang[$l_posts_per_user_s], $posts_per_user),
	'POSTS_PER_TOPIC'	=> sprintf($user->lang[$l_posts_per_topic_s], $posts_per_topic),
));

if (!isset($template->filename['statistics_block']))
{
	$template->set_filenames(array(
		'statistics_block'	=> 'portal/block/statistics.html')
	);
}

$block_temp = $template->assign_display('statistics_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );

?>