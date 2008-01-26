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

if (!defined('IN_PORTAL'))
{
   exit;
}

// Just grab all attachment info from database
$sql = 'SELECT *
	FROM ' . ATTACHMENTS_TABLE . '
	ORDER BY filetime ' . ((!$config['display_order']) ? 'DESC' : 'ASC') . ', post_msg_id ASC';
$result = $db->sql_query_limit($sql, $portal_config['portal_attachments_number']);

while ($row = $db->sql_fetchrow($result))
{
	$size_lang = ($row['filesize'] >= 1048576) ? $user->lang['MB'] : (($row['filesize'] >= 1024) ? $user->lang['KB'] : $user->lang['BYTES']);
	$row['filesize'] = ($row['filesize'] >= 1048576) ? round((round($row['filesize'] / 1048576 * 100) / 100), 2) : (($row['filesize'] >= 1024) ? round((round($row['filesize'] / 1024 * 100) / 100), 2) : $row['filesize']);

	$replace = str_replace(array('_','.zip','.jpg','.gif','.png','.ZIP','.JPG','.GIF','.PNG','.','-'), ' ', $row['real_filename']);

	$template->assign_block_vars('attach', array(
		'FILESIZE'			=> $row['filesize'] . ' ' . $size_lang,
		'FILETIME'			=> $user->format_date($row['filetime']),
		'DOWNLOAD_COUNT'	=> (int) $row['download_count'], // grab downloads count
		'REAL_FILENAME'		=> $replace,
		'PHYSICAL_FILENAME'	=> basename($row['physical_filename']),
		'ATTACH_ID'			=> $row['attach_id'],
		'POST_IDS'			=> (!empty($post_ids[$row['attach_id']])) ? $post_ids[$row['attach_id']] : '',
		'POST_MSG_ID'		=> $row['post_msg_id'], // grab post ID to redirect to post
		'U_FILE'			=> append_sid($phpbb_root_path . 'download/file.' . $phpEx, 'id=' . $row['attach_id']),
	));
}
$db->sql_freeresult($result);

// Assign specific vars
$template->assign_vars(array(
	'S_DISPLAY_ATTACHMENTS'	=> true,
));

?>