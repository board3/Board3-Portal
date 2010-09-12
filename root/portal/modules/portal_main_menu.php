<?php
/**
* @package Portal - Main Menu
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package Main Menu
*/
class portal_main_menu_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	var $columns = 10;

	/**
	* Default modulename
	*/
	var $name = 'M_MENU';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	var $image_src = 'portal_menu.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	var $language = 'portal_main_menu_module';

	function get_template_side($module_id)
	{
		global $config, $template, $phpEx, $phpbb_root_path;

		$template->assign_vars(array(
			'U_M_BBCODE'   			=> append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode'),
			'U_M_TERMS'      		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=terms'),
			'U_M_PRV'      			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=privacy'),
		));

		return 'main_menu_side.html';
	}

	function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_MENU',
			'vars'	=> array(
				'legend1'				=> 'ACP_PORTAL_MENU',
				'board3_links_urls'		=> array('lang' => 'ACP_PORTAL_MENU_MANAGE', 'validate' => 'string',	'type' => 'custom',	'explain' => true, 'method' => 'manage_links', 'submit' => 'update_links'),
			),
		);
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		set_config('board3_links_manage', '');
		set_config('board3_links_options', '');
		return true;
	}

	function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_links_manage',
			'board3_links_options',
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
	
	/*
	* create a table that lets the user manage the links
	* @todo: finish the main menu manage section
	* links_options:
	*	0 = category
	*	1 = internal link
	*	2 = external link
	* links_urls: contains the URLs or titles (for categories)
	*/
	function manage_links($key)
	{
		global $config, $phpbb_admin_path, $user, $phpEx, $db;
		
		// @todo: merge into constants file, maybe even portal contants file
		define('B3_LINKS_CAT', 0);
		define('B3_LINKS_INT', 1);
		define('B3_LINKS_EXT', 2);
		
		$sql = 'SELECT module_id FROM ' . PORTAL_MODULES_TABLE . " WHERE module_classname = 'main_menu'";
		$result = $db->sql_query($sql);
		$module_id = $db->sql_fetchfield('module_id');
		$db->sql_freeresult($result);
		
		$u_action = append_sid($phpbb_admin_path . 'index.' . $phpEx, 'i=portal&amp;mode=config&amp;module_id=' . $module_id);
		// opening code of the table
		$table_begin = "<table id='board3_links_manage' cellspacing='1'>\n<col class='row1' />\n<col class='row1' />\n<col class='row1' />\n<col class='row2' />\n<thead><tr><th>{$user->lang['ACP_PORTAL_MENU_TITLE']}</th><th>{$user->lang['ACP_PORTAL_MENU_URL']}</th><th>{$user->lang['ACP_PORTAL_MENU_TYPE']}</th><th>{$user->lang['ACTIONS']}</th></tr></thead>\n<tbody>";
		// code of the table end
		$table_end = "</tbody>\n</table>";
		$table_content = ''; // make sure this is empty before we begin
		
		$links_urls = explode(';', $config['board3_links_urls']);
		$links_options = explode(';', $config['board3_links_options']);
		$links_titles = explode(';', $config['board3_links_titles']);

		$links = array();
		for ($i = 0; $i < sizeof($links_urls); $i++)
		{
			// Cats will have a blueish background, normal links have white
			$table_row = ($links_options[$i] == B3_LINKS_CAT) ? "class='row2'": "class='row1'";
			
			// Define the drop-down box for the type of the link
			$drop_down_box = "<select id='board3_links_options$i' name='board3_links_options$i'>";
			$drop_down_box .= ($links_options[$i] == B3_LINKS_CAT) ? "<option value='0' selected='selected'>{$user->lang['ACP_PORTAL_MENU_CAT']}</option>" : "<option value='0'>{$user->lang['ACP_PORTAL_MENU_CAT']}</option>";
			$drop_down_box .= ($links_options[$i] == B3_LINKS_INT) ? "<option value='1' selected='selected'>{$user->lang['ACP_PORTAL_MENU_INT']}</option>" : "<option value='1'>{$user->lang['ACP_PORTAL_MENU_INT']}</option>";
			$drop_down_box .= ($links_options[$i] == B3_LINKS_EXT) ? "<option value='2' selected='selected'>{$user->lang['ACP_PORTAL_MENU_EXT']}</option>" : "<option value='2'>{$user->lang['ACP_PORTAL_MENU_EXT']}</option>";
			$drop_down_box .= '</select>';
			
			// Define the links
			$move_up_link = ($i == 0) ? '<img src="' . $phpbb_admin_path . 'images/icon_up_disabled.gif" alt="' . $user->lang['MOVE_UP'] . '" title="' . $user->lang['MOVE_UP'] . '" />' : '<a href="' . $u_action . '&amp;menu=' . $i . '&amp;menu_action=move_up"><img src="' . $phpbb_admin_path . 'images/icon_up.gif" alt="' . $user->lang['MOVE_UP'] . '" title="' . $user->lang['MOVE_UP'] . '" /></a>';
			$move_down_link = ($i >= (sizeof($links_urls) - 1)) ? '<img src="' . $phpbb_admin_path . 'images/icon_down_disabled.gif" alt="' . $user->lang['MOVE_DOWN'] . '" title="' . $user->lang['MOVE_DOWN'] . '" />' : '<a href="' . $u_action . '&amp;menu=' . $i . '&amp;menu_action=move_down"><img src="' . $phpbb_admin_path . 'images/icon_down.gif" alt="' . $user->lang['MOVE_DOWN'] . '" title="' . $user->lang['MOVE_DOWN'] . '" /></a>';
			$delete_link = '<a href="' . $u_action . '&amp;menu=' . $i . '&amp;menu_action=delete"><img src="' . $phpbb_admin_path . 'images/icon_delete.gif" alt="' . $user->lang['DELETE'] . '" title="' . $user->lang['DELETE'] . '" /></a>';
			
			// Throw it all together
			$table_content .= "<tr><td $table_row><input id='board3_links_title$i' name='board3_links_title$i' type='text' size='16' value='{$links_titles[$i]}' /></td><td $table_row><input id='board3_links$i' name='board3_links$i' type='text' size='32' value='{$links_urls[$i]}' /></td><td $table_row>$drop_down_box</td><td>$move_up_link&nbsp;$move_down_link&nbsp;$delete_link</td></tr>";
		}
		
		$return_ary = '';
		
		$return_ary .= $table_begin;
		$return_ary .= $table_content;
		$return_ary .= $table_end;
		
		//echo $config['board3_links_options']; // remove after testing
		
		return $return_ary;
	}
	
	function update_links($key)
	{
		global $db, $cache;
		
		$values = 
		
		print_r($values);
	}
}

?>