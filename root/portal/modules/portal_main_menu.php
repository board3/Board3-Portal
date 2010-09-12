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
	
	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	var $custom_acp_tpl = 'acp_portal_links';

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
		set_config('board3_links_urls', '');
		set_config('board3_links_options', '');
		set_config('board3_links_titles', '');
		return true;
	}

	function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_links_urls',
			'board3_links_options',
			'board3_links_titles',
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
	
	function manage_links($key)
	{
		global $config, $phpbb_admin_path, $user, $phpEx, $db, $template;
		
		// @todo: merge into constants file, maybe even portal contants file
		define('B3_LINKS_CAT', 0);
		define('B3_LINKS_INT', 1);
		define('B3_LINKS_EXT', 2);
		
		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$link_id = request_var('id', 0);
		
		$sql = 'SELECT module_id FROM ' . PORTAL_MODULES_TABLE . " WHERE module_classname = 'main_menu'";
		$result = $db->sql_query($sql);
		$module_id = $db->sql_fetchfield('module_id');
		$db->sql_freeresult($result);
		
		$links_urls = $links_options = $links_titles = array();
		
		$links_urls = explode(';', $config['board3_links_urls']);
		$links_options = explode(';', $config['board3_links_options']);
		$links_titles = explode(';', $config['board3_links_titles']);
		
		$u_action = append_sid($phpbb_admin_path . 'index.' . $phpEx, 'i=portal&amp;mode=config&amp;module_id=' . $module_id);

		switch ($action)
		{
			// Save changes
			case 'save':
				$form_name = 'acp_portal';
				if (!check_form_key($form_name))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($u_action), E_USER_WARNING);
				}

				$link_title = utf8_normalize_nfc(request_var('link_title', '', true));
				$link_is_cat = request_var('link_is_cat', 0);
				$link_url = ($link_is_cat) ? ' ' : request_var('link_url', '');

				if (!$link_title)
				{
					trigger_error($user->lang['NO_LINK_TITLE'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (!$link_is_cat && !$link_url)
				{
					trigger_error($user->lang['NO_LINK_URL'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if ($link_id)
				{
					$message = $user->lang['LINK_UPDATED'];
					
					// always check if the links already exist
					if(isset($link_titles[$link_id]) && isset($link_options[$link_id]) && isset($link_urls[$link_id]))
					{
						$links_titles[$link_id] = $link_title;
						$links_urls[$link_id] = htmlspecialchars_decode($link_url);
						$links_options[$link_id] = ($link_is_cat) ? B3_LINKS_CAT : B3_LINKS_EXT; // Add internal link later on
					}
					else
					{
						$links_titles[] = $link_title;
						$links_urls[] = $link_url;
						$links_options[] = ($link_is_cat) ? B3_LINKS_CAT : B3_LINKS_EXT; // Add internal link later on
					}

					add_log('admin', 'LOG_PORTAL_LINK_UPDATED', $link_title);
				}
				else
				{
					$message = $user->lang['LINK_ADDED'];

					if($links_titles[0] == '')
					{
						$links_titles[0] = $link_title;
						$links_urls[0] = $link_url;
						$links_options[0] = ($link_is_cat) ? B3_LINKS_CAT : B3_LINKS_EXT; // Add internal link later on
					}
					else
					{
						$links_titles[] = $link_title;
						$links_urls[] = $link_url;
						$links_options[] = ($link_is_cat) ? B3_LINKS_CAT : B3_LINKS_EXT; // Add internal link later on
					}

					//$config['board3_menu_count']++; // @todo: check if we need this
					add_log('admin', 'LOG_PORTAL_LINK_ADDED', $link_title);
				}

				// $cache->destroy('_links'); // @todo: check if we need this
				
				set_config('board3_links_urls', implode(';', $links_urls));
				set_config('board3_links_options', implode(';', $links_options));
				set_config('board3_links_titles', implode(';', $links_titles));
				

				trigger_error($message . adm_back_link($u_action));

			break;

			// Delete link
			case 'delete':

				if (!$link_id)
				{
					trigger_error($user->lang['MUST_SELECT_LINK'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT link_title, link_order
						FROM ' . PORTAL_LINKS_TABLE . "
						WHERE link_id = $link_id";
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($row)
					{
						$row['link_title'] = (string) $row['link_title'];
						$row['link_order'] = (int) $row['link_order'];
					}

					$sql = 'DELETE FROM ' . PORTAL_LINKS_TABLE . " WHERE link_id = $link_id";
					$db->sql_query($sql);

					// Reset link order...
					$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . ' SET link_order = link_order - 1 WHERE link_order > ' . $row['link_order'];
					$db->sql_query($sql);

					$cache->destroy('_links');

					set_portal_config('num_links', $config['board3_menu_count'] - 1, true);
					add_log('admin', 'LOG_PORTAL_LINK_REMOVED', $row['link_title']);
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'link_id'	=> $link_id,
						'action'	=> 'delete',
					)));
				}

			break;

			// Move items up or down
			case 'move_up':
			case 'move_down':

				if (!$link_id)
				{
					trigger_error($user->lang['MUST_SELECT_LINK'] . adm_back_link($u_action), E_USER_WARNING);
				}

				// Get current order id...
				$sql = 'SELECT link_order AS current_order
					FROM ' . PORTAL_LINKS_TABLE . "
					WHERE link_id = $link_id";
				$result = $db->sql_query($sql);
				$current_order = (int) $db->sql_fetchfield('current_order');
				$db->sql_freeresult($result);

				if ($current_order == 0 && $action == 'move_up')
				{
					break;
				}

				// on move_down, switch position with next order_id...
				// on move_up, switch position with previous order_id...
				$switch_order_id = ($action == 'move_down') ? $current_order + 1 : $current_order - 1;

				// Update order values
				$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . "
					SET link_order = $current_order
					WHERE link_order = $switch_order_id
						AND link_id <> $link_id";
				$db->sql_query($sql);

				// Only update the other entry too if the previous entry got updated
				if ($db->sql_affectedrows())
				{
					$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . "
						SET link_order = $switch_order_id
						WHERE link_order = $current_order
							AND link_id = $link_id";
					$db->sql_query($sql);
				}

			break;

			// Edit or add menu item
			case 'edit':
			case 'add':
				$template->assign_vars(array(
					'LINK_TITLE'	=> (isset($links_titles[$link_id])) ? $links_titles[$link_id] : '',
					'LINK_URL'		=> (isset($links_urls[$link_id]) && $links_options[$link_id] != B3_LINKS_CAT) ? $links_urls[$link_id] : '',

					'U_BACK'	=> $u_action,
					'U_ACTION'	=> $u_action . '&amp;id=' . $link_id,

					'S_EDIT'				=> true,
					'S_LINK_IS_CAT'			=> (!isset($links_options[$link_id]) || $links_options[$link_id] == B3_LINKS_CAT) ? true : false,
				));

				return;

			break;
		}

		for ($i = 0; $i < sizeof($links_urls); $i++)
		{
			$template->assign_block_vars('links', array(
				'LINK_TITLE'	=> $links_titles[$i],
				'LINK_URL'		=> $links_urls[$i],

				'U_EDIT'		=> $u_action . '&amp;action=edit&amp;id=' . $i,
				'U_DELETE'		=> $u_action . '&amp;action=delete&amp;id=' . $i,
				'U_MOVE_UP'		=> $u_action . '&amp;action=move_up&amp;id=' . $i,
				'U_MOVE_DOWN'	=> $u_action . '&amp;action=move_down&amp;id=' . $i,

				'S_LINK_IS_CAT'	=> ($links_options[$i] == B3_LINKS_CAT) ? true : false,
			));	
		}
		$db->sql_freeresult($result);
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
	function manage_links_old($key)
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
		$this->manage_links($key);
	}
}

?>