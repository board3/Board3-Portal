<?php
/**
* @package Portal
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

class acp_portal
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $cache, $template, $display_vars;
		global $config, $phpbb_root_path, $portal_root_path, $phpbb_admin_path, $phpEx;
		
		include($phpbb_root_path . 'portal/includes/constants.' . $phpEx);
		$portal_root_path = PORTAL_ROOT_PATH;
		if (!function_exists('column_string_const'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_modules.' . $phpEx);
		}

		if (!function_exists('mod_version_check'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_version_check.' . $phpEx);
		}
		
		if(!function_exists('obtain_portal_config'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
		}

		$user->add_lang('mods/portal');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_portal';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writeable), path (relative path, but able to escape the root), wpath (writeable)
		*/
		switch ($mode)
		{
			case 'config':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_GENERAL_TITLE',
					'vars'	=> array(
						'legend1'					=> 'ACP_PORTAL_CONFIG_INFO',
						'board3_enable'				=> array('lang' => 'PORTAL_ENABLE',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'board3_left_column'		=> array('lang' => 'PORTAL_LEFT_COLUMN',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'board3_right_column'		=> array('lang' => 'PORTAL_RIGHT_COLUMN',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'board3_version_check'		=> array('lang' => 'PORTAL_VERSION_CHECK',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => false),
						'board3_phpbb_menu'		=> array('lang' => 'PORTAL_PHPBB_MENU',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),

						'legend2'					=> 'ACP_PORTAL_COLUMN_WIDTH_SETTINGS',
						'board3_left_column_width'	=> array('lang' => 'PORTAL_LEFT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'board3_right_column_width'	=> array('lang' => 'PORTAL_RIGHT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
					)
				);

				$module_id = request_var('module_id', 0);
				if ($module_id)
				{
					$sql = 'SELECT *
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . $module_id;
					$result = $db->sql_query_limit($sql, 1);
					$module_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($module_data !== false)
					{
						$class = 'portal_' . $module_data['module_classname'] . '_module';
						if (!class_exists($class))
						{
							include($phpbb_root_path . 'portal/modules/portal_' . $module_data['module_classname'] . '.' . $phpEx);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$c_class = new $class();
						if ($c_class->language)
						{
							$user->add_lang('mods/portal/' . $c_class->language);
						}
						$module_name = $user->lang[$c_class->name];
						$display_vars = $c_class->get_template_acp($module_id);
						$template->assign_vars(array(
							'MODULE_NAME'			=> $module_data['module_name'],
							'MODULE_IMAGE'			=> $module_data['module_image_src'],
							'MODULE_IMAGE_SRC'		=> ($module_data['module_image_src']) ? $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $module_data['module_image_src'] : '',
						));
						
						if($module_data['module_classname'] != 'custom')
						{
							$groups_ary = explode(',', $module_data['module_group_ids']);
					
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
						}
						
						$template->assign_var('SHOW_MODULE_OPTIONS', true);
					}
				}
				else
				{
					// only show the mod version check if we are on the General Settings page
					mod_version_check();
				}

				$this->new_config = $config;
				$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
				$error = array();

				// We validate the complete config if whished
				validate_config_vars($display_vars['vars'], $cfg_array, $error);
				if ($submit && !check_form_key($form_key))
				{
					$error[] = $user->lang['FORM_INVALID'];
				}

				// Do not write values if there is an error
				if (sizeof($error))
				{
					$submit = false;
				}

				// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
				foreach ($display_vars['vars'] as $config_name => $null)
				{
					if ($submit && ($null['type'] == 'custom' || $null['submit_type'] == 'custom'))
					{
						$func = array($c_class, $null['submit']);
						$args = ($module_id != 0) ? array($cfg_array[$config_name], $config_name, $module_id) : $config_name;
						call_user_func_array($func, $args);
					}
					
					
					if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
					{
						continue;
					}
					
					if($null['type'] == 'custom')
					{
						continue;
					}

					$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

					if ($submit)
					{	
						set_config($config_name, $config_value);
					}
				}

				if ($submit)
				{
					$module_permission = request_var('permission-setting', array(0 => ''));
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
					
					$module_permission = array_intersect($module_permission, $groups_ary);
					$module_permission = implode(',', $module_permission);
					
					
					$sql_ary = array(
						'module_image_src'	=> request_var('module_image', ''),
						'module_name'		=> request_var('module_name', '', true),
						'module_group_ids'	=> $module_permission,
					);

					$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE module_id = ' . $module_id;
					$db->sql_query($sql);

					$cache->destroy('sql', CONFIG_TABLE);
					if(isset($module_name))
					{
						add_log('admin', 'LOG_PORTAL_CONFIG',$module_name);
					}
					else
					{
						add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
					}
					trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link(($module_id) ? append_sid("{$phpbb_root_path}adm/index.$phpEx", 'i=portal&mode=modules') : $this->u_action));
				}

				// show custom HTML files on the settings page of the modules instead of the standard board3 portal one, if chosen by module
				if(!isset($c_class->custom_acp_tpl) || empty($c_class->custom_acp_tpl))
				{
					$this->tpl_name = 'portal/acp_portal_config';
				}
				else
				{
					$this->tpl_name = 'portal/' . $c_class->custom_acp_tpl;
				}
				$this->page_title = $display_vars['title'];

				$template->assign_vars(array(
					'L_TITLE'			=> $user->lang[$display_vars['title']],
					'L_TITLE_EXPLAIN'	=> (isset($user->lang[$display_vars['title'] . '_EXP'])) ? $user->lang[$display_vars['title'] . '_EXP'] : '',

					'S_ERROR'			=> (sizeof($error)) ? true : false,
					'ERROR_MSG'			=> implode('<br />', $error),

					'U_ACTION'			=> $this->u_action . (($module_id) ? '&amp;module_id=' . $module_id : ''),
				));
				

				// Output relevant page
				foreach ($display_vars['vars'] as $config_key => $vars)
				{
					if (!is_array($vars) && strpos($config_key, 'legend') === false)
					{
						continue;
					}

					if (strpos($config_key, 'legend') !== false)
					{
						$template->assign_block_vars('options', array(
							'S_LEGEND'		=> true,
							'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
						);

						continue;
					}
					$this->new_config[$config_key] = $config[$config_key];
					$type = explode(':', $vars['type']);

					$l_explain = '';
					if ($vars['explain'])
					{
						$l_explain = (isset($user->lang[$vars['lang'] . '_EXP'])) ? $user->lang[$vars['lang'] . '_EXP'] : '';
					}

					if($vars['type'] != 'custom')
					{
						$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);
					}
					else
					{
						$args = array($this->new_config[$config_key], $config_key, $module_id);
						$func = array($c_class, $vars['method']);
						$content = call_user_func_array($func, $args);
					}

					if (empty($content))
					{
						continue;
					}

					$template->assign_block_vars('options', array(
						'KEY'			=> $config_key,
						'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
						'S_EXPLAIN'		=> $vars['explain'],
						'TITLE_EXPLAIN'	=> $l_explain,
						'CONTENT'		=> $content,
					));

					unset($display_vars['vars'][$config_key]);
				}
			break;
			case 'modules':
				$action = request_var('action', '');
				$module_id = request_var('module_id', '');
				if ($action == 'move_up')
				{
					$sql = 'SELECT module_order, module_column
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . $module_id;
					$result = $db->sql_query_limit($sql, 1);
					$module_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if (($module_data !== false) && ($module_data['module_order'] > 1))
					{
						$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
							SET module_order = module_order + 1
							WHERE module_order = ' . ($module_data['module_order'] - 1) . '
								AND module_column = ' . $module_data['module_column'];
						$db->sql_query($sql);
						$updated = $db->sql_affectedrows();
						if ($updated)
						{
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order - 1
								WHERE module_id = ' . $module_id;
							$db->sql_query($sql);
						}
					}
				}
				elseif ($action == 'move_down')
				{
					$sql = 'SELECT module_order, module_column
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . $module_id;
					$result = $db->sql_query_limit($sql, 1);
					$module_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($module_data !== false)
					{
						$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
							SET module_order = module_order - 1
							WHERE module_order = ' . ($module_data['module_order'] + 1) . '
								AND module_column = ' . $module_data['module_column'];
						$db->sql_query($sql);
						$updated = $db->sql_affectedrows();
						if ($updated)
						{
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order + 1
								WHERE module_id = ' . $module_id;
							$db->sql_query($sql);
						}
					}
				}
				elseif ($action == 'delete')
				{
					$sql = 'SELECT *
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . $module_id;
					$result = $db->sql_query_limit($sql, 1);
					$module_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);
					
					$directory = $phpbb_root_path . 'portal/modules/';

					if ($module_data !== false)
					{
						$module_classname = request_var('module_classname', '');
						$class = 'portal_' . $module_classname . '_module';
						if (!class_exists($class))
						{
							include($directory . 'portal_' . $module_classname . '.' . $phpEx);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$c_class = new $class();
						$c_class->uninstall($module_data['module_id']);

						$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE . '
							WHERE module_id = ' . $module_id;
						$db->sql_query($sql);

						$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
							SET module_order = module_order - 1
							WHERE module_column = ' . $module_data['module_column'] . '
								AND module_order > ' . $module_data['module_order'];
						$db->sql_query($sql);
						
						$cache->purge(); // make sure we don't get errors after re-adding a module

						trigger_error($user->lang['SUCCESS_DELETE'] . adm_back_link($this->u_action));
					}
				}

				$add_module = key(request_var('add', array('' => '')));
				$add_column = request_var('add_column', column_string_num($add_module));
				if ($add_column)
				{
					$submit = (isset($_POST['submit'])) ? true : false;
					$directory = $phpbb_root_path . 'portal/modules/';

					if ($submit)
					{
						$module_classname = request_var('module_classname', '');
						$class = 'portal_' . $module_classname . '_module';
						if (!class_exists($class))
						{
							include($directory . 'portal_' . $module_classname . '.' . $phpEx);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$sql = 'SELECT module_order
							FROM ' . PORTAL_MODULES_TABLE . '
							WHERE module_column = ' . $add_column . '
							ORDER BY module_order DESC';
						$result = $db->sql_query_limit($sql, 1);
						$module_order = 1 + (int) $db->sql_fetchfield('module_order');
						$db->sql_freeresult($result);

						$c_class = new $class();

						$sql_ary = array(
							'module_classname'	=> $module_classname,
							'module_column'		=> $add_column,
							'module_order'		=> $module_order,
							'module_name'		=> $c_class->name,
							'module_image_src'	=> $c_class->image_src,
							'module_group_ids'	=> '',
						);
						$sql = 'INSERT INTO ' . PORTAL_MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						$db->sql_query($sql);

						$module_id = $db->sql_nextid();

						$c_class->install($module_id);
						
						$cache->purge(); // make sure we don't get errors after re-adding a module

						if($module_classname == 'custom')
						{
							meta_refresh(3, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $module_id));
						}

						trigger_error($user->lang['SUCCESS_ADD'] . adm_back_link($this->u_action));
					}

					$template->assign_var('S_EDIT', true);
					$fileinfo = array();

					$dh = @opendir($directory);
					if (!$dh)
					{
						return $fileinfo;
					}

					while (($file = readdir($dh)) !== false)
					{
						// Is module?
						if (preg_match('/^portal_.+\.' . $phpEx . '$/', $file))
						{
							$class = str_replace(".$phpEx", '', $file) . '_module';
							if (!class_exists($class))
							{
								include($directory . $file);
							}

							// Get module title tag
							if (class_exists($class))
							{
								$c_class = new $class();
								if ($c_class->columns & column_string_const($add_module))
								{
									if ($c_class->language)
									{
										$user->add_lang('mods/portal/' . $c_class->language);
									}
									$fileinfo[] = array(
										'module'		=> substr($class, 7, -7),
										'name'			=> $user->lang[$c_class->name],
									);
								}
							}
						}
					}
					closedir($dh);

					// we sort the $fileinfo array by the name of the modules
					foreach($fileinfo as $key => $cur_file)
					{
						$name_ary[$key] = $cur_file['name'];
					}
					array_multisort($name_ary, SORT_REGULAR, $fileinfo);
					$options = '';

					foreach ($fileinfo as $module)
					{
						$options .= '<option value="' . $module['module'] . '">' . $module['name'] . '</option>';
					}

					$s_hidden_fields = build_hidden_fields(array(
						'add_column'	=> column_string_num($add_module),
					));
					$template->assign_vars(array(
						'S_MODULE_NAMES'	=> $options,
						'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
					));
				}
				else
				{
					$directory = $phpbb_root_path . 'portal/modules/';

					$sql = 'SELECT *
						FROM ' . PORTAL_MODULES_TABLE . '
						ORDER BY module_column, module_order ASC';
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$class = 'portal_' . $row['module_classname'] . '_module';
						if (!class_exists($class))
						{
							include($directory . 'portal_' . $row['module_classname'] . '.' . $phpEx);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$c_class = new $class();
						if ($c_class->language)
						{
							$user->add_lang('mods/portal/' . $c_class->language);
						}
						$template_column = column_num_string($row['module_column']);

						$template->assign_block_vars('modules_' . $template_column, array(
							'MODULE_NAME'		=> (isset($user->lang[$row['module_name']])) ? $user->lang[$row['module_name']] : $row['module_name'],
							'MODULE_IMAGE'		=> ($row['module_image_src']) ? '<img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $row['module_image_src'] . '" alt="' . $row['module_name'] . '" />' : '',

							'U_DELETE'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;module_classname=' . $row['module_classname'] . '&amp;action=delete',
							'U_EDIT'			=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $row['module_id']),
							'U_MOVE_UP'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_up',
							'U_MOVE_DOWN'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_down',
							'U_MOVE_RIGHT'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_right',
							'U_MOVE_LEFT'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_left',
						));
					}
					$db->sql_freeresult($result);
					
					$template->assign_vars(array(
						'ICON_MOVE_LEFT'				=> '<img src="' . $phpbb_admin_path . 'images/icon_left.gif" alt="' . $user->lang['MOVE_LEFT'] . '" title="' . $user->lang['MOVE_LEFT'] . '" />',
						'ICON_MOVE_LEFT_DISABLED'		=> '<img src="' . $phpbb_admin_path . 'images/icon_left_disabled.gif" alt="' . $user->lang['MOVE_LEFT'] . '" title="' . $user->lang['MOVE_LEFT'] . '" />',
						'ICON_MOVE_RIGHT'				=> '<img src="' . $phpbb_admin_path . 'images/icon_right.gif" alt="' . $user->lang['MOVE_RIGHT'] . '" title="' . $user->lang['MOVE_RIGHT'] . '" />',
						'ICON_MOVE_RIGHT_DISABLED'		=> '<img src="' . $phpbb_admin_path . 'images/icon_right_disabled.gif" alt="' . $user->lang['MOVE_RIGHT'] . '" title="' . $user->lang['MOVE_RIGHT'] . '" />',
					));
				}

				$this->tpl_name = 'portal/acp_portal_modules';
				$this->page_title = 'ACP_PORTAL_MODULES';
			break;
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}
	}
}
?>