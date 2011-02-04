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
						'board3_phpbb_menu'			=> array('lang' => 'PORTAL_PHPBB_MENU',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'board3_display_jumpbox'	=> array('lang' => 'PORTAL_DISPLAY_JUMPBOX',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),

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
						WHERE module_id = ' . (int) $module_id;
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
							'MODULE_NAME'			=> ($module_data['module_classname'] != 'latest_bots')? $module_data['module_name'] : '',
							'MODULE_IMAGE'			=> $module_data['module_image_src'],
							'MODULE_IMAGE_WIDTH'	=> $module_data['module_image_width'],
							'MODULE_IMAGE_HEIGHT'	=> $module_data['module_image_height'],
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
				
				// Reset module
				$reset_module = request_var('module_reset', 0);
				
				if($reset_module)
				{
					if (confirm_box(true))
					{
						$sql_ary = array(
							'module_name'		=> $c_class->name,
							'module_image_src'	=> $c_class->image_src,
							'module_group_ids'	=> '',
							'module_image_height'	=> 16,
							'module_image_width'	=> 16,
						);
						$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . ' 
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' 
								WHERE module_id = ' . (int) $module_id;
						$db->sql_query($sql);
						
						$cache->destroy('config');
						$cache->destroy('portal_config');
						$portal_config = obtain_portal_config(); // we need to prevent duplicate entry errors
						$c_class->install($module_id);
						$cache->purge();
						
						// We need to return to the module config
						meta_refresh(3, reapply_sid($this->u_action . "&amp;module_id=$module_id"));
						
						trigger_error($user->lang['MODULE_RESET_SUCCESS'] . adm_back_link($this->u_action . "&amp;module_id=$module_id"));
					}
					else
					{
						$confirm_text = (isset($user->lang[$module_data['module_name']])) ? sprintf($user->lang['MODULE_RESET_CONFIRM'], $user->lang[$module_data['module_name']]) : sprintf($user->lang['DELETE_MODULE_CONFIRM'], utf8_normalize_nfc($module_data['module_name']));
						confirm_box(false, $confirm_text, build_hidden_fields(array(
							'i'				=> $id,
							'mode'			=> $mode,
							'module_reset'	=> true,
							'module_id'		=> $module_id,
						)));
					}
				}
				
				// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
				foreach ($display_vars['vars'] as $config_name => $null)
				{
					if ($submit && ($null['type'] == 'custom' || (isset($null['submit_type']) && $null['submit_type'] == 'custom')))
					{
						$func = array($c_class, $null['submit']);
						
						if(method_exists($c_class, $null['submit']))
						{
							$args = ($module_id != 0) ? array($config_name, $module_id) : $config_name;
							call_user_func_array($func, $args);
						}
						else
						{
							$args = ($module_id != 0) ? array($cfg_array[$config_name], $config_name, $module_id) : $config_name;
							call_user_func_array($null['submit'], $args);
						}
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
						'module_image_src'		=> request_var('module_image', ''),
						'module_name'			=> request_var('module_name', '', true),
						'module_image_width'	=> request_var('module_img_width', 0),
						'module_image_height'	=> request_var('module_img_height', 0),
						'module_group_ids'		=> $module_permission,
					);
					
					// check if module image file actually exists
					check_file_src($sql_ary['module_image_src'], '', $module_id);

					$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE module_id = ' . (int) $module_id;
					$db->sql_query($sql);

					$cache->destroy('portal_modules');
					$cache->destroy('sql', CONFIG_TABLE);
					if(isset($module_name))
					{
						add_log('admin', 'LOG_PORTAL_CONFIG',$module_name);
					}
					else
					{
						add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
					}
					trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link(($module_id) ? append_sid("{$phpbb_root_path}adm/index.$phpEx", 'i=portal&amp;mode=modules') : $this->u_action));
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
						WHERE module_id = ' . (int) $module_id;
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
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);
						}
					}
					
					$cache->destroy('portal_modules');
				}
				elseif ($action == 'move_down')
				{
					$sql = 'SELECT module_order, module_column
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . (int) $module_id;
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
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);
						}
					}
					
					$cache->destroy('portal_modules');
				}
				elseif($action == 'move_right')
				{
					$sql = 'SELECT module_order, module_column, module_classname
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . (int) $module_id;
					$result = $db->sql_query_limit($sql, 1);
					$module_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);
					
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
					
					if($c_class->columns & column_string_const(column_num_string($module_data['module_column'] + 1)))
					{
						if ($module_data !== false)
						{
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order + 1
								WHERE module_order >= ' . $module_data['module_order'] . '
									AND module_column = ' . ($module_data['module_column'] + 1);
							$db->sql_query($sql);
							$updated = $db->sql_affectedrows();

							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_column = module_column + 1
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);
							
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order - 1
								WHERE module_order >= ' . $module_data['module_order'] . '
								AND module_column = ' . $module_data['module_column'];
							$db->sql_query($sql);
							
							// the module that needs to moved is in the last row
							if(!$updated)
							{
								$sql = 'SELECT MAX(module_order) as new_order
										FROM ' . PORTAL_MODULES_TABLE . '
										WHERE module_order < ' . $module_data['module_order'];
								$db->sql_query($sql);
								$new_order = $db->sql_fetchfield('new_order') + 1;
								
								$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
									SET module_order = ' . $new_order . '
									WHERE module_id = ' . (int) $module_id;
								$db->sql_query($sql);
							}
						}
					}
					elseif($c_class->columns & column_string_const(column_num_string($module_data['module_column'] + 2)) && $module_data['module_column'] != 2)
					{
						if ($module_data !== false)
						{
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order + 1
								WHERE module_order >= ' . $module_data['module_order'] . '
									AND module_column = ' . ($module_data['module_column'] + 2);
							$db->sql_query($sql);
							$updated = $db->sql_affectedrows();

							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_column = module_column + 2
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);
							
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order - 1
								WHERE module_order >= ' . $module_data['module_order'] . '
								AND module_column = ' . $module_data['module_column'];
							$db->sql_query($sql);
							
							// the module that needs to moved is in the last row
							if(!$updated)
							{
								$sql = 'SELECT MAX(module_order) as new_order
										FROM ' . PORTAL_MODULES_TABLE . '
										WHERE module_order < ' . $module_data['module_order'];
								$db->sql_query($sql);
								$new_order = $db->sql_fetchfield('new_order') + 1;
								
								$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
									SET module_order = ' . $new_order . '
									WHERE module_id = ' . (int) $module_id;
								$db->sql_query($sql);
							}

						}
					}
					else
					{
						trigger_error($user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
					}
					
					$cache->destroy('portal_modules');
				}
				elseif($action == 'move_left')
				{
					$sql = 'SELECT module_order, module_column, module_classname
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . (int) $module_id;
					$result = $db->sql_query_limit($sql, 1);
					$module_data = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);
					
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
					
					if($c_class->columns & column_string_const(column_num_string($module_data['module_column'] - 1)))
					{
						if ($module_data !== false)
						{
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order + 1
								WHERE module_order >= ' . $module_data['module_order'] . '
									AND module_column = ' . ($module_data['module_column'] - 1);
							$db->sql_query($sql);
							$updated = $db->sql_affectedrows();

							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_column = module_column - 1
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);
							
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order - 1
								WHERE module_order >= ' . $module_data['module_order'] . '
								AND module_column = ' . $module_data['module_column'];
							$db->sql_query($sql);
							
							// the module that needs to moved is in the last row
							if(!$updated)
							{
								$sql = 'SELECT MAX(module_order) as new_order
										FROM ' . PORTAL_MODULES_TABLE . '
										WHERE module_order < ' . $module_data['module_order'];
								$db->sql_query($sql);
								$new_order = $db->sql_fetchfield('new_order') + 1;
								
								$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
									SET module_order = ' . $new_order . '
									WHERE module_id = ' . (int) $module_id;
								$db->sql_query($sql);
							}
						}
					}
					elseif($c_class->columns & column_string_const(column_num_string($module_data['module_column'] - 2)) && $module_data['module_column'] != 2)
					{
						if ($module_data !== false)
						{
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order + 1
								WHERE module_order >= ' . $module_data['module_order'] . '
									AND module_column = ' . ($module_data['module_column'] - 2);
							$db->sql_query($sql);
							$updated = $db->sql_affectedrows();

							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_column = module_column - 2
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);
							
							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order - 1
								WHERE module_order >= ' . $module_data['module_order'] . '
								AND module_column = ' . $module_data['module_column'];
							$db->sql_query($sql);
							
							// the module that needs to moved is in the last row
							if(!$updated)
							{
								$sql = 'SELECT MAX(module_order) as new_order
										FROM ' . PORTAL_MODULES_TABLE . '
										WHERE module_order < ' . $module_data['module_order'];
								$db->sql_query($sql);
								$new_order = $db->sql_fetchfield('new_order') + 1;
								
								$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
									SET module_order = ' . $new_order . '
									WHERE module_id = ' . (int) $module_id;
								$db->sql_query($sql);
							}
						}
					}
					else
					{
						trigger_error($user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
					}
					
					$cache->destroy('portal_modules');
				}
				elseif ($action == 'delete')
				{
					$sql = 'SELECT *
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_id = ' . (int) $module_id;
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
						
						if (confirm_box(true))
						{
							$c_class = new $class();
							$c_class->uninstall($module_data['module_id']);

							$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE . '
								WHERE module_id = ' . (int) $module_id;
							$db->sql_query($sql);

							$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
								SET module_order = module_order - 1
								WHERE module_column = ' . $module_data['module_column'] . '
									AND module_order > ' . $module_data['module_order'];
							$db->sql_query($sql);
							
							$cache->purge(); // make sure we don't get errors after re-adding a module

							trigger_error($user->lang['SUCCESS_DELETE'] . adm_back_link($this->u_action));
						}
						else
						{
							$c_class = new $class();
							if ($c_class->language)
							{
								$user->add_lang('mods/portal/' . $c_class->language);
							}
							$confirm_text = (isset($user->lang[$module_data['module_name']])) ? sprintf($user->lang['DELETE_MODULE_CONFIRM'], $user->lang[$module_data['module_name']]) : sprintf($user->lang['DELETE_MODULE_CONFIRM'], utf8_normalize_nfc($module_data['module_name']));
							confirm_box(false, $confirm_text, build_hidden_fields(array(
								'i'			=> $id,
								'mode'		=> $mode,
								'action'	=> $action,
								'module_id'	=> $module_id,
							)));
						}
					}
					
					$cache->destroy('portal_modules');
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
							'module_image_height'	=> 16,
							'module_image_width'	=> 16,
						);
						$sql = 'INSERT INTO ' . PORTAL_MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						$db->sql_query($sql);

						$module_id = $db->sql_nextid();

						$c_class->install($module_id);
						
						$cache->purge(); // make sure we don't get errors after re-adding a module

						meta_refresh(3, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $module_id));

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

					$portal_modules = obtain_portal_modules();
					
					foreach($portal_modules as $row)
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
						
						// find out of we can move modules to the left or right
						if(($c_class->columns & column_string_const(column_num_string($row['module_column'] + 1))) || ($c_class->columns & column_string_const(column_num_string($row['module_column'] + 2)) && $row['module_column'] != 2))
						{
							$move_right = true;
						}
						else
						{
							$move_right = false;
						}
						
						if(($c_class->columns & column_string_const(column_num_string($row['module_column'] - 1))) || ($c_class->columns & column_string_const(column_num_string($row['module_column'] - 2)) && $row['module_column'] != 2))
						{
							$move_left = true;
						}
						else
						{
							$move_left = false;
						}

						$template->assign_block_vars('modules_' . $template_column, array(
							'MODULE_NAME'		=> (isset($user->lang[$row['module_name']])) ? $user->lang[$row['module_name']] : $row['module_name'],
							'MODULE_IMAGE'		=> ($row['module_image_src']) ? '<img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $row['module_image_src'] . '" alt="' . $row['module_name'] . '" />' : '',

							'U_DELETE'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;module_classname=' . $row['module_classname'] . '&amp;action=delete',
							'U_EDIT'			=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $row['module_id']),
							'U_MOVE_UP'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_up',
							'U_MOVE_DOWN'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_down',
							'U_MOVE_RIGHT'		=> ($move_right) ? $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_right' : '',
							'U_MOVE_LEFT'		=> ($move_left) ? $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_left' : '',
						));
					}
					
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
			case 'upload_module':
				$error = array();
				if($submit)
				{
					// Default upload path is portal/upload/
					$upload_path = $phpbb_root_path . 'portal/upload/';
					// Upload part
					$user->add_lang('posting');  // For error messages
					include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
					$upload = new fileupload();
					// Only allow ZIP files
					$upload->set_allowed_extensions(array('zip'));
					
					$file = $upload->form_upload('modupload');
					
					if (empty($file->filename))
					{
						trigger_error($user->lang['NO_UPLOAD_FILE'] . adm_back_link($this->u_action), E_USER_WARNING);
					}
					else
					{
						if (!$file->init_error && !sizeof($file->error))
						{
							$file->clean_filename('real');
							$file->move_file(str_replace($phpbb_root_path, '', $upload_path), true, true);
							
							if (!sizeof($file->error))
							{
								include($phpbb_root_path . 'includes/functions_compress.' . $phpEx);
								$mod_dir = $upload_path . str_replace('.zip', '', $file->get('realname'));
								// make sure we don't already have the new folder
								if(is_dir($mod_dir))
								{
									$this->directory_delete($mod_dir);
								}
								$compress = new compress_zip('r', $file->destination_file);
								$compress->extract($mod_dir . '_tmp/');
								$compress->close();
								$folder_contents = scandir($mod_dir . '_tmp/', 1);  // This ensures dir is at index 0
								//print_r($folder_contents);
								// We need to check if there's a main directory inside the temp MOD directory
								if (sizeof($folder_contents) == 3)
								{
									// We need to move that directory then
									$this->directory_move($mod_dir . '_tmp/' . $folder_contents[0], $upload_path . '/' . $folder_contents[0]);
									
								}
								else if (!is_dir($mod_dir))
								{
									// Change the name of the directory by moving to directory without _tmp in it
									$this->directory_move($mod_dir . '_tmp/', $mod_dir);
									
								}
								
								$this->directory_delete($mod_dir . '_tmp/');
								
								// if we got until here set $actions['NEW_FILES']
								$actions['NEW_FILES'] = array();
								
								// Now we need to get the files inside the folders
								$folder_contents = scandir($mod_dir);
								$cut_array = array('.', '..');
								
								$folder_contents = array_diff($folder_contents, $cut_array);

								/* 
								* This will tell us what files we need to copy incl. the path
								* In loving memory of PHP 4.x  .... NOT
								*/
								foreach($folder_contents as $cur_content)
								{
									$cur_folder_content = array();
									switch($cur_content)
									{
										case 'language':
											// there are more foreach to come .....
											$cur_folder_content = scandir($mod_dir . '/language/');
											$cur_folder_content = array_diff($cur_folder_content, $cut_array);
											$langs = array();
											
											foreach($cur_folder_content as $copy_file)
											{
												$langs[] = $copy_file;
											}
											
											foreach($langs as $cur_lang)
											{
												$lang_content = scandir($mod_dir . '/language/' . $cur_lang . '/');
												$lang_content = array_diff($lang_content, $cut_array);
												
												foreach($lang_content as $new_file)
												{
													$actions['NEW_FILES'][$mod_dir . '/language/' . $cur_lang . '/' . $new_file] = $phpbb_root_path . 'language/' . $cur_lang . '/mods/portal/' . $new_file;
												}
											}
										break;
										case 'module':
											$cur_folder_content = scandir($mod_dir . '/module/');
											$cur_folder_content = array_diff($cur_folder_content, $cut_array);
											
											foreach($cur_folder_content as $copy_file)
											{
												$actions['NEW_FILES'][$mod_dir . '/module/' . $copy_file] = $phpbb_root_path . 'portal/modules/' . $copy_file;
											}
										break;
										case 'styles':
											// there are more foreach to come .....
											$cur_folder_content = scandir($mod_dir . '/styles/');
											$cur_folder_content = array_diff($cur_folder_content, $cut_array);
											$styles = array();
											
											foreach($cur_folder_content as $copy_file)
											{
												$styles[] = $copy_file;
											}
											
											foreach($styles as $cur_style)
											{
												$style_content = scandir($mod_dir . '/styles/' . $cur_style);
												$style_content = array_diff($style_content, $cut_array);
												
												foreach($style_content as $new_file)
												{
													$actions['NEW_FILES'][$mod_dir . '/styles/' . $cur_style . '/' . $new_file] = $phpbb_root_path . 'styles/' . $cur_style . '/template/portal/modules/' . $new_file;
												}
											}
										break;
										default:
											// there shouldn't be other files ...
											trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
									}
								}

								if (!sizeof($file->error))
								{
									include("{$phpbb_root_path}includes/functions_transfer.$phpEx");
									include("{$phpbb_root_path}includes/editor.$phpEx");
									include("{$phpbb_root_path}includes/functions_mods.$phpEx");
									include("{$phpbb_root_path}includes/mod_parser.$phpEx");
									
									if(!function_exists('determine_write_method') || !class_exists('editor') || !class_exists('parser'))
									{
										trigger_error($user->lang['NO_AUTOMOD_INSTALLED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
									}

									// start the page
									$user->add_lang(array('install', 'acp/mods'));
									
									// Let's start moving our files where they belong
									$write_method = 'editor_' . determine_write_method(false);
									$editor = new $write_method();
									
									foreach ($actions['NEW_FILES'] as $source => $target)
									{
										$status = $editor->copy_content($source, $target);

										if ($status !== true && !is_null($status))
										{
											$module_installed = false;
										}

										$template->assign_block_vars('new_files', array(
											'S_SUCCESS'			=> ($status === true) ? true : false,
											'S_NO_COPY_ATTEMPT'	=> (is_null($status)) ? true : false,
											'SOURCE'			=> $source,
											'TARGET'			=> $target,
										));
									}
									
									$editor->commit_changes($mod_dir . '_edited', '');
									
									$template->assign_vars(array(
										'S_MOD_SUCCESSBOX'	=> true,
										'MESSAGE'			=> $user->lang['INSTALLED'],
										'U_RETURN'			=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules'),
									));
								}
							}
						}
						$file->remove();				
						if ($file->init_error || sizeof($file->error))
						{
							trigger_error((sizeof($file->error) ? implode('<br />', $file->error) : $user->lang['MOD_UPLOAD_INIT_FAIL']) . adm_back_link($this->u_action), E_USER_WARNING);
						}
						
						$this->tpl_name = 'portal/acp_portal_upload_module';
						$this->page_title = $user->lang['ACP_PORTAL_UPLOAD'];
						
						$template->assign_vars(array(
						'L_TITLE'			=> $user->lang['ACP_PORTAL_UPLOAD'],
						'L_TITLE_EXPLAIN'	=> '',

						'S_ERROR'			=> (sizeof($error)) ? true : false,
						'ERROR_MSG'			=> implode('<br />', $error),

						'U_ACTION'			=> $this->u_action,
					));
					}
				}
				else
				{
					if(@ini_get('file_uploads') == '0' || strtolower(@ini_get('file_uploads')) == 'off' || !@extension_loaded('zlib'))
					{
						trigger_error($user->lang['NO_MODULE_UPLOAD'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
					}
					
					if(!isset($config['am_file_perms']))
					{
						trigger_error($user->lang['NO_AUTOMOD_INSTALLED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
					}
					
					include("{$phpbb_root_path}includes/functions_transfer.$phpEx");
					include("{$phpbb_root_path}includes/editor.$phpEx");
					include("{$phpbb_root_path}includes/functions_mods.$phpEx");
					include("{$phpbb_root_path}includes/mod_parser.$phpEx");

					// start the page
					$user->add_lang(array('install', 'acp/mods'));

					$template->assign_vars(array(
						'U_UPLOAD'			=> $this->u_action,
						'S_FORM_ENCTYPE'	=> ' enctype="multipart/form-data"',
					));
					
					add_form_key('acp_mods_upload');

					$this->tpl_name = 'portal/acp_portal_upload_module';
					$this->page_title = $user->lang['ACP_PORTAL_UPLOAD'];

					$template->assign_vars(array(
						'L_TITLE'			=> $user->lang['ACP_PORTAL_UPLOAD'],
						'L_TITLE_EXPLAIN'	=> '',

						'S_ERROR'			=> (sizeof($error)) ? true : false,
						'ERROR_MSG'			=> implode('<br />', $error),

						'U_ACTION'			=> $this->u_action,
					));
				}
			break;
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}
	}
	
	function directory_move($src, $dest)
	{
		global $config;
		
		$src_contents = scandir($src);
		
		if (!is_dir($dest) && is_dir($src))
		{
			mkdir($dest . '/', octdec($config['am_dir_perms']));
		}
		
		foreach ($src_contents as $src_entry)
		{
			if ($src_entry != '.' && $src_entry != '..')
			{
				if (is_dir($src . '/' . $src_entry) && !is_dir($dest . '/' . $src_entry))
				{
					$this->directory_move($src . '/' . $src_entry, $dest . '/' . $src_entry);
				}
				else if (is_file($src . '/' . $src_entry) && !is_file($dest . '/' . $src_entry))
				{
					copy($src . '/' . $src_entry, $dest . '/' . $src_entry);
					chmod($dest . '/' . $src_entry, octdec($config['am_file_perms']));
				}
			}
		}
	}
	
	function directory_delete($dir)
	{
		if (!file_exists($dir))
		{
			return true;
		}
		
		if (!is_dir($dir) && is_file($dir))
		{
			phpbb_chmod($dir, CHMOD_ALL);
			return unlink($dir);
		}
		
        foreach (scandir($dir) as $item)
		{ 
            if ($item == '.' || $item == '..')
			{
				continue;
			}
            if (!$this->directory_delete($dir . "/" . $item))
			{
				phpbb_chmod($dir . "/" . $item, CHMOD_ALL);
                if (!$this->directory_delete($dir . "/" . $item))
				{
					return false;
				}
            }
        }
		
		return rmdir($dir);
	}
}
?>