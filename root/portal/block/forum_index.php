<?php

/**
*
* @package - Board3portal
* @version $Id: forum_index.php 325 2008-08-17 18:59:40Z kevin74 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

display_forums('');

$template->assign_vars(array(
'FORUM_IMG'				=> $user->img('forum_read', 'NO_NEW_POSTS'),
'FORUM_NEW_IMG'			=> $user->img('forum_unread', 'NEW_POSTS'),
'FORUM_LOCKED_IMG'		=> $user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
'FORUM_NEW_LOCKED_IMG'	=> $user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),
'S_DISPLAY_PORTAL_FORUM_INDEX' => true,

'U_MARK_FORUMS'		=> ($user->data['is_registered'] || $config['load_anon_lastread']) ? append_sid("{$phpbb_root_path}index.$phpEx", 'mark=forums') : '',
'U_MCP'				=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '')
);

if (!isset($template->filename['forum_index_block']))
{
	$template->set_filenames(array(
		'forum_index_block'	=> 'portal/block/forum_index.html')
	);
}

$block_temp = $template->assign_display('forum_index_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );

?>