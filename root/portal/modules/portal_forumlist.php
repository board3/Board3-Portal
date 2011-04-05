<?php
/**
*
* @package Board3 Portal v2 - Forumlist
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package Forumlist
*/
class portal_forumlist_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	var $columns = 21;

	/**
	* Default modulename
	*/
	var $name = 'PORTAL_FORUMLIST';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	var $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	var $language = 'portal_forumlist_module';
	
	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	var $custom_acp_tpl = '';

	function get_template_center($module_id)
	{
		global $config, $template, $user, $auth, $phpbb_root_path, $phpEx;

		display_forums('', $config['load_moderators'], false);

		$template->assign_vars(array(
			'FORUM_IMG'			=> $user->img('forum_read', 'NO_NEW_POSTS'),
			'FORUM_NEW_IMG'			=> $user->img('forum_unread', 'NEW_POSTS'),
			'FORUM_LOCKED_IMG'		=> $user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
			'FORUM_NEW_LOCKED_IMG'		=> $user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),
			'S_DISPLAY_PORTAL_FORUM_INDEX'	=> true,
			'U_MARK_FORUMS'			=> ($user->data['is_registered'] || $config['load_anon_lastread']) ? append_sid("{$phpbb_root_path}index.$phpEx", 'hash=' . generate_link_hash('global') . '&amp;mark=forums') : '',
			'U_MCP'				=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '',
		));

		return 'forumlist.html';
	}

	function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'PORTAL_FORUMLIST',
			'vars'	=> array(),
		);
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		return true;
	}

	function uninstall($module_id)
	{
		return true;
	}
}
