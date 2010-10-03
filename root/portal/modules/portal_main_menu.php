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
	var $custom_acp_tpl = 'acp_portal_menu';

	function get_template_side($module_id)
	{
		global $config, $template, $phpEx, $phpbb_root_path, $user, $db;

		$links_urls = $links_options = $links_titles = $groups_ary = array();
		
		$links_urls = explode(';', $config['board3_links_urls_' . $module_id]);
		$links_options = explode(';', $config['board3_links_options_' . $module_id]);
		$links_titles = explode(';', $config['board3_links_titles_' . $module_id]);
		$links_permissions = explode(';', $config['board3_links_permissions_' . $module_id]);
		
		// get user's groups
		$sql = 'SELECT group_id
				FROM ' . USER_GROUP_TABLE . '
				WHERE user_id = ' . $user->data['user_id'] . '
				ORDER BY group_id ASC';
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result))
		{
			$groups_ary[] = $row['group_id'];
		}
		$db->sql_freeresult($result);
		
		
		for ($i = 0; $i < sizeof($links_urls); $i++)
		{
			if($links_options[$i] == B3_LINKS_CAT)
			{
				$template->assign_block_vars('portalmenu', array(
					'CAT_TITLE'		=> (isset($user->lang[$links_titles[$i]])) ? $user->lang[$links_titles[$i]] : $links_titles[$i],
				));
			}
			else
			{
				if($links_options[$i] == B3_LINKS_INT)
				{
					$links_urls[$i] = str_replace('&', '&amp;', $links_urls[$i]); // we need to do this in order to prevent XHTML validation errors
					$cur_url = append_sid($phpbb_root_path . $links_urls[$i]); // the user should know what kind of file it is
				}
				else
				{
					$cur_url = $links_urls[$i];
				}
				
				$cur_permissions = explode(',', $links_permissions[$i]);
				$permission_check = array_intersect($groups_ary, $cur_permissions);
				
				if(!empty($permission_check) || $links_permissions[$i] == '')
				{
					$template->assign_block_vars('portalmenu.links', array(
						'LINK_TITLE'		=> (isset($user->lang[$links_titles[$i]])) ? $user->lang[$links_titles[$i]] : $links_titles[$i],
						'LINK_URL'			=> $cur_url,
					));
				}
			}
		}

		return 'main_menu_new.html';
	}

	function get_template_acp($module_id)
	{
		// do not remove this as it is needed in order to run manage_links
                return array(
			'title'	=> 'ACP_PORTAL_MENU',
			'vars'	=> array(
				'legend1'				=> 'ACP_PORTAL_MENU',
				'board3_links_urls_' . $module_id		=> array('lang' => 'ACP_PORTAL_MENU_MANAGE', 'validate' => 'string',	'type' => 'custom',	'explain' => true, 'method' => 'manage_links', 'submit' => 'update_links'),
			),
		);
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		global $phpbb_root_path, $phpEx, $db;
		
		// get the correct group IDs from the database
		$in_ary = array('GUESTS', 'REGISTERED', 'REGISTERED_COPPA');
		
		$sql = 'SELECT group_id, group_name FROM ' . GROUPS_TABLE . ' WHERE ' . $db->sql_in_set('group_name', $in_ary);
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result))
		{
			$groups_ary[$row['group_name']] = $row['group_id'];
		}
		
		$links_titles = array(
			'M_CONTENT',
			'INDEX',
			'SEARCH',
			'REGISTER',
			'MEMBERLIST',
			'THE_TEAM',
			'M_HELP',
			'FAQ',
			'M_BBCODE',
			'M_TERMS',
			'M_PRV',
		);
		
		$links_options = array(
			B3_LINKS_CAT,
			B3_LINKS_INT,
			B3_LINKS_INT,
			B3_LINKS_INT,
			B3_LINKS_INT,
			B3_LINKS_INT,
			B3_LINKS_CAT,
			B3_LINKS_INT,
			B3_LINKS_INT,
			B3_LINKS_INT,
			B3_LINKS_INT,
		);
		
		$links_urls = array(
			'',
			'index.' . $phpEx,
			'search.' . $phpEx,
			'ucp.' . $phpEx . '?mode=register',
			'memberlist.' . $phpEx,
			'memberlist.' . $phpEx . '?mode=leaders',
			'',
			'faq.' . $phpEx,
			'faq.' . $phpEx . '?mode=bbcode',
			'ucp.' . $phpEx . '?mode=terms',
			'ucp.' . $phpEx . '?mode=privacy',
		);
		
		$links_permissions = array(
			'',
			'',
			'',
			$groups_ary['GUESTS'],
			$groups_ary['REGISTERED'] . ',' . $groups_ary['REGISTERED_COPPA'],
			$groups_ary['REGISTERED'] . ',' . $groups_ary['REGISTERED_COPPA'],
			'',
			'',
			'',
			'',
			'',
		);
		
		set_config('board3_links_urls_' . $module_id, implode(';', $links_urls));
		set_config('board3_links_options_' . $module_id, implode(';', $links_options));
		set_config('board3_links_titles_' . $module_id, implode(';', $links_titles));
		set_config('board3_links_permissions_' . $module_id, implode(';', $links_permissions));
		return true;
	}

	function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_links_urls_' . $module_id,
			'board3_links_options_' . $module_id,
			'board3_links_titles_' . $module_id,
			'board3_links_permissions_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
	
	function manage_links($value, $key, $module_id)
	{
		global $config, $phpbb_admin_path, $user, $phpEx, $db, $template;
		
		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$link_id = request_var('id', 99999999); // 0 will trigger unwanted behavior, therefore we set a number we should never reach
		
		$sql = 'SELECT module_id FROM ' . PORTAL_MODULES_TABLE . " WHERE module_classname = 'main_menu'";
		$result = $db->sql_query($sql);
		$module_id = $db->sql_fetchfield('module_id');
		$db->sql_freeresult($result);
		
		$links_urls = $links_options = $links_titles = array();
		
		$links_urls = explode(';', $config['board3_links_urls_' . $module_id]);
		$links_options = explode(';', $config['board3_links_options_' . $module_id]);
		$links_titles = explode(';', $config['board3_links_titles_' . $module_id]);
		$links_permissions = explode(';', $config['board3_links_permissions_' . $module_id]);

		$u_action = append_sid($phpbb_admin_path . 'index.' . $phpEx, 'i=portal&amp;mode=config&amp;module_id=' . $module_id);

		switch ($action)
		{
			// Save changes
			case 'save':
				if (!check_form_key('acp_portal'))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($u_action), E_USER_WARNING);
				}

				$link_title = utf8_normalize_nfc(request_var('link_title', ' ', true));
				$link_is_cat = request_var('link_is_cat', 0);
				$link_type = (!$link_is_cat) ? request_var('link_type', 0) : B3_LINKS_CAT;
				$link_url = ($link_is_cat) ? ' ' : request_var('link_url', ' ');
				$link_url = str_replace('&amp;', '&', $link_url);
				$link_permission = request_var('permission-setting', array(0 => ''));
				$groups_ary = array();
				
				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$db->sql_freeresult($result);
				
				$link_permissions = array_intersect($link_permission, $groups_ary);
				$link_permissions = implode(',', $link_permissions);

				if (!$link_title)
				{
					trigger_error($user->lang['NO_LINK_TITLE'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (!$link_is_cat && !$link_url)
				{
					trigger_error($user->lang['NO_LINK_URL'] . adm_back_link($u_action), E_USER_WARNING);
				}

				// overwrite already existing links and make sure we don't try to save a link outside of the normal array size of $links_urls
				if (isset($link_id) && $link_id < sizeof($links_urls))
				{
					$message = $user->lang['LINK_UPDATED'];
					
					// always check if the links already exist
					if(isset($links_titles[$link_id]) && isset($links_options[$link_id]) && ($link_is_cat || isset($links_urls[$link_id])))
					{
						$links_titles[$link_id] = $link_title;
						$links_urls[$link_id] = htmlspecialchars_decode($link_url);
						$links_options[$link_id] = $link_type;
						$links_permissions[$link_id] = $link_permissions;
					}
					else
					{
						$links_titles[] = $link_title;
						$links_urls[] = $link_url;
						$links_options[] = $link_type;
						$links_permissions[$link_id] = $link_permissions;
					}

					add_log('admin', 'LOG_PORTAL_LINK_UPDATED', $link_title);
				}
				else
				{
					$message = $user->lang['LINK_ADDED'];

					if($links_titles[0] == '')
					{
						if($link_type != B3_LINKS_CAT && sizeof($links_titles) < 1)
						{
							trigger_error($user->lang['ACP_PORTAL_MENU_CREATE_CAT'] . adm_back_link($u_action), E_USER_WARNING);
						}
						$links_titles[0] = $link_title;
						$links_urls[0] = $link_url;
						$links_options[0] = $link_type;
						$links_permissions[0] = $link_permissions;
					}
					else
					{
						if($link_type != B3_LINKS_CAT && sizeof($links_titles) < 1)
						{
							trigger_error($user->lang['ACP_PORTAL_MENU_CREATE_CAT'] . adm_back_link($u_action), E_USER_WARNING);
						}
						$links_titles[] = $link_title;
						$links_urls[] = $link_url;
						$links_options[] = $link_type;
						$links_permissions[] = $link_permissions;
					}
					add_log('admin', 'LOG_PORTAL_LINK_ADDED', $link_title);
				}
				
				set_config('board3_links_urls_' . $module_id, implode(';', $links_urls));
				set_config('board3_links_options_' . $module_id, implode(';', $links_options));
				set_config('board3_links_titles_' . $module_id, implode(';', $links_titles));
				set_config('board3_links_permissions_' . $module_id, implode(';', $links_permissions));

				trigger_error($message . adm_back_link($u_action));

			break;

			// Delete link
			case 'delete':

				if (!isset($link_id) && $link_id >= sizeof($links_urls))
				{
					trigger_error($user->lang['MUST_SELECT_LINK'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$cur_link_title = $links_titles[$link_id];
					// make sure we don't delete links that weren't supposed to be deleted
					$title_ary = array('{remove_link}');
					$links_titles[$link_id] = '{remove_link}';
					$option_ary = array('{remove_link}');
					$links_options[$link_id] = '{remove_link}';
					$url_ary = array('{remove_link}');
					$links_urls[$link_id] = '{remove_link}';
					$permission_ary = array('{remove_link}');
					$links_permissions[$link_id] = '{remove_link}';
					
					$links_titles = array_diff($links_titles, $title_ary);
					$links_urls = array_diff($links_urls, $url_ary);
					$links_options = array_diff($links_options, $url_ary);
					$links_permissions = array_diff($links_permissions, $permission_ary);
					
					set_config('board3_links_urls_' . $module_id, implode(';', $links_urls));
					set_config('board3_links_options_' . $module_id, implode(';', $links_options));
					set_config('board3_links_titles_' . $module_id, implode(';', $links_titles));
					set_config('board3_links_permissions_' . $module_id, implode(';', $links_permissions));

					add_log('admin', 'LOG_PORTAL_LINK_REMOVED', $cur_link_title);
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'link_id'	=> $link_id,
						'action'	=> 'delete',
					)));
				}

			break;

			// Move items up or down
			case 'move_up':
			case 'move_down':

				if (!isset($link_id) && $link_id >= sizeof($links_urls))
				{
					trigger_error($user->lang['MUST_SELECT_LINK'] . adm_back_link($u_action), E_USER_WARNING);
				}

				// make sure we don't try to move a link where it can't be moved
				if (($link_id == 0 && $action == 'move_up') || ($link_id == (sizeof($links_urls) - 1) && $action == 'move_down'))
				{
					break;
				}

				/* 
				* on move_down, switch position with next order_id...
				* on move_up, switch position with previous order_id...
				* move up means a lower ID, move down means a higher ID
				*/
				$switch_order_id = ($action == 'move_down') ? $link_id + 1 : $link_id - 1;

				// back up the info of the link we want to move
				$cur_url = $links_urls[$link_id];
				$cur_title = $links_titles[$link_id];
				$cur_option = $links_options[$link_id];
				$cur_permission = $links_permissions[$link_id];
				
				// move the info of the links we replace in the order
				$links_urls[$link_id] = $links_urls[$switch_order_id];
				$links_titles[$link_id] = $links_titles[$switch_order_id];
				$links_options[$link_id] = $links_options[$switch_order_id];
				$links_permissions[$link_id] = $links_permissions[$switch_order_id];
				
				// insert the info of the moved link
				$links_urls[$switch_order_id] = $cur_url;
				$links_titles[$switch_order_id] = $cur_title;
				$links_options[$switch_order_id] = $cur_option;
				$links_permissions[$switch_order_id] = $cur_permission;

				set_config('board3_links_urls_' . $module_id, implode(';', $links_urls));
				set_config('board3_links_options_' . $module_id, implode(';', $links_options));
				set_config('board3_links_titles_' . $module_id, implode(';', $links_titles));
				set_config('board3_links_permissions_' . $module_id, implode(';', $links_permissions));

			break;

			// Edit or add menu item
			case 'edit':
			case 'add':
				$template->assign_vars(array(
					'LINK_TITLE'	=> (isset($links_titles[$link_id]) && $action != 'add') ? $links_titles[$link_id] : '',
					'LINK_URL'		=> (isset($links_urls[$link_id]) && $links_options[$link_id] != B3_LINKS_CAT && $action != 'add') ? str_replace('&', '&amp;', $links_urls[$link_id]) : '',

					//'U_BACK'	=> $u_action,
					'U_ACTION'	=> $u_action . '&amp;id=' . $link_id,

					'S_EDIT'				=> true,
					'S_LINK_IS_CAT'			=> (!isset($links_options[$link_id]) || $links_options[$link_id] == B3_LINKS_CAT) ? true : false,
					'S_LINK_IS_INT'			=> (isset($links_options[$link_id]) && $links_options[$link_id] == B3_LINKS_INT) ? true : false,
				));
				
				$groups_ary = explode(',', $links_permissions[$link_id]);
				
				// get group info from database and assign the block vars
				$sql = 'SELECT group_id, group_name 
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('permission_setting', array(
						'SELECTED'		=> (in_array($row['group_id'], $groups_ary)) ? true : false,
						'GROUP_NAME'	=> (isset($user->lang['G_' . $row['group_name']])) ? $user->lang['G_' . $row['group_name']] : $row['group_name'],
						'GROUP_ID'		=> $row['group_id'],
					));
				}
				$db->sql_freeresult($result);

				return;

			break;
		}

		for ($i = 0; $i < sizeof($links_urls); $i++)
		{
			$template->assign_block_vars('links', array(
				'LINK_TITLE'	=> ($action != 'add') ? $links_titles[$i] : '',
				'LINK_URL'		=> ($action != 'add') ? str_replace('&', '&amp;', $links_urls[$i]) : '',

				'U_EDIT'		=> $u_action . '&amp;action=edit&amp;id=' . $i,
				'U_DELETE'		=> $u_action . '&amp;action=delete&amp;id=' . $i,
				'U_MOVE_UP'		=> $u_action . '&amp;action=move_up&amp;id=' . $i,
				'U_MOVE_DOWN'	=> $u_action . '&amp;action=move_down&amp;id=' . $i,

				'S_LINK_IS_CAT'	=> ($links_options[$i] == B3_LINKS_CAT) ? true : false,
			));
		}
	}
	
	function update_links($key, $module_id)
	{
		$this->manage_links('', $key, $module_id);
	}
}

?>