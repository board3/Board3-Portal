<?php
/**
*
* @package - Board3portal
* @version $Id: install_uninstall.php 458 2009-01-31 13:51:34Z Christian_N $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @installer based on: phpBB Gallery by nickvergessen, www.flying-bits.org
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
if (!defined('IN_INSTALL'))
{
	exit;
}

if (!empty($setmodules))
{
	if (!$this->installed_version)
	{
		return;
	}

	$module[] = array(
		'module_type'		=> 'uninstall',
		'module_title'		=> 'UNINSTALL',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 40,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'UNINSTALL'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/
class install_uninstall extends module
{
	function install_uninstall(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($mode, $sub)
	{
		global $user, $template, $phpbb_root_path, $cache, $phpEx;

		switch ($sub)
		{
			case 'intro':
				$this->page_title = $user->lang['SUB_INTRO'];

				$template->assign_vars(array(
					'TITLE'			=> $user->lang['UNINSTALL_INTRO'],
					'BODY'			=> $user->lang['UNINSTALL_INTRO_BODY'],
					'L_SUBMIT'		=> $user->lang['NEXT_STEP'],
					'U_ACTION'		=> $this->p_master->module_url . "?mode=$mode&amp;sub=uninstall",
				));

			break;

			case 'uninstall':
				$this->uninstall($mode, $sub);

			break;
		}

		$this->tpl_name = 'install_install';
	}

	/**
	* Load the contents of the schema into the database and then alter it based on what has been input during the installation
	*/
	function uninstall($mode, $sub)
	{
		global $db, $user, $template, $phpbb_root_path, $phpEx, $cache, $table_prefix;

		$this->page_title = $user->lang['STAGE_UNINSTALL'];
		$s_hidden_fields = '';

		// Drop thes tables if existing
		b3p_drop_table(PORTAL_CONFIG_TABLE);

		$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
			WHERE module_langname = 'ACP_PORTAL_GENERAL_INFO'
				OR module_langname = 'ACP_PORTAL_NEWS_INFO'
				OR module_langname = 'ACP_PORTAL_ANNOUNCE_INFO'
				OR module_langname = 'ACP_PORTAL_ANNOUNCEMENTS_INFO'
				OR module_langname = 'ACP_PORTAL_WELCOME_INFO'
				OR module_langname = 'ACP_PORTAL_RECENT_INFO'
				OR module_langname = 'ACP_PORTAL_WORDGRAPH_INFO'
				OR module_langname = 'ACP_PORTAL_PAYPAL_INFO'
				OR module_langname = 'ACP_PORTAL_ADS_INFO'
				OR module_langname = 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'
				OR module_langname = 'ACP_PORTAL_ATTACHMENTS_INFO'
				OR module_langname = 'ACP_PORTAL_MEMBERS_INFO'
				OR module_langname = 'ACP_PORTAL_POLLS_INFO'
				OR module_langname = 'ACP_PORTAL_BOTS_INFO'
				OR module_langname = 'ACP_PORTAL_MOST_POSTER_INFO'
				OR module_langname = 'ACP_PORTAL_POSTER_INFO'
				OR module_langname = 'ACP_PORTAL_MINICALENDAR_INFO'
				OR module_langname = 'ACP_PORTAL_CUSTOM_INFO'
				OR module_langname = 'ACP_PORTAL_CUSTOMBLOCK_INFO'
				OR module_langname = 'ACP_PORTAL_LINKS_INFO'
				OR module_langname = 'ACP_PORTAL_BIRTHDAYS_INFO'
				OR module_langname = 'ACP_PORTAL_FRIENDS_INFO'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			remove_module($row['module_id'], 'acp');
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT right_id, module_id FROM ' . MODULES_TABLE . "
			WHERE module_langname = 'ACP_PORTAL_INFO'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$sql = 'DELETE FROM ' . MODULES_TABLE . " WHERE module_id = '{$row['module_id']}'";
			$db->sql_query($sql);
			$sql = 'UPDATE ' . MODULES_TABLE . "
				SET left_id = left_id - 2
				WHERE module_class = 'acp'
					AND left_id > {$row['right_id']}";
			$db->sql_query($sql);
		
			$sql = 'UPDATE ' . MODULES_TABLE . "
				SET right_id = right_id - 2
				WHERE module_class = 'acp'
					AND right_id > {$row['right_id']}";
			$db->sql_query($sql);
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT auth_option_id FROM ' . ACL_OPTIONS_TABLE . "
				WHERE auth_option = 'a_portal_manage'
				";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$sql = 'DELETE FROM ' . ACL_OPTIONS_TABLE . " WHERE auth_option_id = '{$row['auth_option_id']}'";
			$db->sql_query($sql);
		}
		$db->sql_freeresult($result);

		$cache->purge();
				
		$template->assign_vars(array(
			'BODY'		=> $user->lang['UNINSTALL_CONGRATS'] . '<br /><br />' . $user->lang['UNINSTALL_CONGRATS_EXPLAIN'],
			'L_SUBMIT'	=> $user->lang['GOTO_INDEX'],
			'U_ACTION'	=> append_sid("{$phpbb_root_path}index.$phpEx"),
		));
	}
}

?>