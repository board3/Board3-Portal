<?php

/**
*
* @package - Board3portal
* @version $Id: attachments.php 590 2009-12-05 13:25:30Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$attach_forums = false;
$where = '';
$filetypes = array();

// Get filetypes and put them into an array
if(isset($portal_config['portal_attachments_filetype']) && strlen($portal_config['portal_attachments_filetype']) > 0)
{
	$filetypes = explode(',', $portal_config['portal_attachments_filetype']);
}

if($portal_config['portal_attachments_forum_ids'] !== '')
{
	$attach_forums_config = (strpos($portal_config['portal_attachments_forum_ids'], ',') !== false) ? explode(',', $portal_config['portal_attachments_forum_ids']) : array($portal_config['portal_attachments_forum_ids']);
	$forum_list =  array_unique(array_keys($auth->acl_getf('f_read', true)));
	
	if($portal_config['portal_attachments_forum_exclude'])
	{
		$forum_list = array_unique(array_diff($forum_list, $attach_forums_config));
	}
	else
	{
		$forum_list =  array_unique(array_intersect($attach_forums_config, $forum_list));
	}
}
else
{
	$forum_list =  array_unique(array_keys($auth->acl_getf('f_read', true)));
}

if(sizeof($forum_list))
{
	$attach_forums = true;
	$where = 'AND ' . $db->sql_in_set('t.forum_id', $forum_list);
}

if(sizeof($filetypes))
{
	if($portal_config['portal_attachments_exclude'])
	{
		$where .= ' AND ' . $db->sql_in_set('a.extension', $filetypes, true);
	}
	else
	{
		$where .= ' AND ' . $db->sql_in_set('a.extension', $filetypes);
	}
}

if($attach_forums === true)
{
	// Just grab all attachment info from database
	$sql = 'SELECT
				a.*,
				t.forum_id
			FROM
				' . ATTACHMENTS_TABLE . ' a,
				' . TOPICS_TABLE . ' t
			WHERE
				a.topic_id <> 0
				AND a.topic_id = t.topic_id
				' . $where . '
			ORDER BY
				filetime ' . ((!$config['display_order']) ? 'DESC' : 'ASC') . ', post_msg_id ASC';
	$result = $db->sql_query_limit($sql, $portal_config['portal_attachments_number']);

	while ($row = $db->sql_fetchrow($result))
	{
		$size_lang = ($row['filesize'] >= 1048576) ? $user->lang['MIB'] : (($row['filesize'] >= 1024) ? $user->lang['KIB'] : $user->lang['BYTES']);
		$row['filesize'] = ($row['filesize'] >= 1048576) ? round((round($row['filesize'] / 1048576 * 100) / 100), 2) : (($row['filesize'] >= 1024) ? round((round($row['filesize'] / 1024 * 100) / 100), 2) : $row['filesize']);

		$replace = character_limit(utf8_substr($row['real_filename'], 0, strrpos($row['real_filename'], '.')), $portal_config['portal_attach_max_length']);

		$template->assign_block_vars('attach', array(
			'FILESIZE'			=> $row['filesize'] . ' ' . $size_lang,
			'FILETIME'			=> $user->format_date($row['filetime']),
			'DOWNLOAD_COUNT'	=> (int) $row['download_count'], // grab downloads count
			'FILENAME'			=> $replace,
			'REAL_FILENAME'		=> $row['real_filename'],
			'PHYSICAL_FILENAME'	=> basename($row['physical_filename']),
			'ATTACH_ID'			=> $row['attach_id'],
			'POST_IDS'			=> (!empty($post_ids[$row['attach_id']])) ? $post_ids[$row['attach_id']] : '',
			'POST_MSG_ID'		=> $row['post_msg_id'], // grab post ID to redirect to post
			'U_FILE'			=> append_sid($phpbb_root_path . 'download/file.' . $phpEx, 'id=' . $row['attach_id']),
			'U_TOPIC'			=> append_sid($phpbb_root_path . 'viewtopic.'.$phpEx, 'p='.$row['post_msg_id'].'#p'.$row['post_msg_id']),
		));
	}
	$db->sql_freeresult($result);

	$template->assign_var('S_DISPLAY_ATTACHMENTS', true);
} 
else 
{
	$template->assign_var('S_DISPLAY_ATTACHMENTS', false);
}


?>