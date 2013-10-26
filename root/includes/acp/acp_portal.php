<?php
/**
*
* @package Board3 Portal v2
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

class acp_portal
{
	public $u_action;
	public $new_config = array();
	protected $c_class;
	protected $db, $user, $cache, $template, $display_vars, $config, $phpbb_root_path, $portal_root_path, $phpbb_admin_path, $phpEx;

	public function __construct()
	{
		global $db, $user, $cache, $template;
		global $config, $phpbb_root_path, $portal_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('mods/portal');

		include($phpbb_root_path . 'portal/includes/constants.' . $phpEx);
		$portal_root_path = PORTAL_ROOT_PATH;

		$this->db = $db;
		$this->user = $user;
		$this->cache = $cache;
		$this->template = $template;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpbb_admin_path = $phpbb_admin_path;
		$this->php_ex = $phpEx;

		if (!function_exists('column_string_const'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_modules.' . $this->php_ex);
		}

		if (!function_exists('mod_version_check'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_version_check.' . $this->php_ex);
		}

		if(!function_exists('obtain_portal_config'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $this->php_ex);
		}
	}

	public function main($id, $mode)
	{
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
					$result = $this->db->sql_query_limit($sql, 1);
					$module_data = $this->db->sql_fetchrow($result);
					$this->db->sql_freeresult($result);

					if ($module_data !== false)
					{
						$class = 'portal_' . $module_data['module_classname'] . '_module';
						if (!class_exists($class))
						{
							include($this->phpbb_root_path . 'portal/modules/portal_' . $module_data['module_classname'] . '.' . $this->php_ex);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$this->c_class = new $class();
						if ($this->c_class->language)
						{
							$this->user->add_lang('mods/portal/' . $this->c_class->language);
						}
						$module_name = $this->user->lang[$this->c_class->name];
						$display_vars = $this->c_class->get_template_acp($module_id);
						$this->template->assign_vars(array(
							'MODULE_NAME'			=> (isset($this->c_class->hide_name) && $this->c_class->hide_name == true)? '' : $module_data['module_name'],
							'MODULE_IMAGE'			=> $module_data['module_image_src'],
							'MODULE_IMAGE_WIDTH'	=> $module_data['module_image_width'],
							'MODULE_IMAGE_HEIGHT'	=> $module_data['module_image_height'],
							'MODULE_IMAGE_SRC'		=> ($module_data['module_image_src']) ? $this->phpbb_root_path . 'styles/' . $this->user->theme['theme_path'] . '/theme/images/portal/' . $module_data['module_image_src'] : '',
							'MODULE_ENABLED'		=> ($module_data['module_status']) ? true : false,
							'MODULE_SHOW_IMAGE'		=> (in_array(column_num_string($module_data['module_column']), array('center', 'top', 'bottom'))) ? false : true,
						));

						if($module_data['module_classname'] != 'custom')
						{
							$groups_ary = explode(',', $module_data['module_group_ids']);

							// get group info from database and assign the block vars
							$sql = 'SELECT group_id, group_name 
									FROM ' . GROUPS_TABLE . '
									ORDER BY group_id ASC';
							$result = $this->db->sql_query($sql);
							while($row = $this->db->sql_fetchrow($result))
							{
								$this->template->assign_block_vars('permission_setting', array(
									'SELECTED'		=> (in_array($row['group_id'], $groups_ary)) ? true : false,
									'GROUP_NAME'	=> (isset($this->user->lang['G_' . $row['group_name']])) ? $this->user->lang['G_' . $row['group_name']] : $row['group_name'],
									'GROUP_ID'		=> $row['group_id'],
								));
							}
							$this->db->sql_freeresult($result);
						}

						$this->template->assign_var('SHOW_MODULE_OPTIONS', true);
					}
				}
				else
				{
					// only show the mod version check if we are on the General Settings page
					mod_version_check();
				}

				$this->new_config = $this->config;
				$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
				$error = array();

				// We validate the complete config if whished
				validate_config_vars($display_vars['vars'], $cfg_array, $error);
				if ($submit && !check_form_key($form_key))
				{
					$error[] = $this->user->lang['FORM_INVALID'];
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
					$this->reset_module($id, $mode, $module_id, $module_data);
				}

				// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
				foreach ($display_vars['vars'] as $config_name => $null)
				{
					if ($submit && ((isset($null['type']) && $null['type'] == 'custom') || (isset($null['submit_type']) && $null['submit_type'] == 'custom')))
					{
						$func = array($this->c_class, $null['submit']);

						if(method_exists($this->c_class, $null['submit']))
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

					if(isset($null['type']) && $null['type'] == 'custom')
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
					$img_error = '';

					// get groups and check if the selected groups actually exist
					$sql = 'SELECT group_id
							FROM ' . GROUPS_TABLE . '
							ORDER BY group_id ASC';
					$result = $this->db->sql_query($sql);
					while($row = $this->db->sql_fetchrow($result))
					{
						$groups_ary[] = $row['group_id'];
					}
					$this->db->sql_freeresult($result);

					$module_permission = array_intersect($module_permission, $groups_ary);
					$module_permission = implode(',', $module_permission);

					$sql_ary = array(
						'module_image_src'		=> request_var('module_image', ''),
						'module_image_width'	=> request_var('module_img_width', 0),
						'module_image_height'	=> request_var('module_img_height', 0),
						'module_group_ids'		=> $module_permission,
						'module_status'			=> request_var('module_status', B3_MODULE_ENABLED),
					);

					if(!(isset($this->c_class->hide_name) && $this->c_class->hide_name == true))
					{
						$sql_ary['module_name'] = utf8_normalize_nfc(request_var('module_name', '', true));
					}

					// check if module image file actually exists
					$img_error = check_file_src($sql_ary['module_image_src'], '', $module_id, false);

					$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE module_id = ' . (int) $module_id;
					$this->db->sql_query($sql);

					$this->cache->destroy('portal_modules');
					$this->cache->destroy('sql', CONFIG_TABLE);

					if(isset($module_name))
					{
						if ($module_data['module_classname'] !== 'custom')
						{
							add_log('admin', 'LOG_PORTAL_CONFIG', $module_name);
						}
					}
					else
					{
						add_log('admin', 'LOG_PORTAL_CONFIG', $this->user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
					}
					trigger_error($this->user->lang['CONFIG_UPDATED'] . ((!empty($img_error) ? '<br /><br />' . $this->user->lang['MODULE_IMAGE_ERROR'] . '<br />' . $img_error : '')) . adm_back_link(($module_id) ? append_sid("{$this->phpbb_root_path}adm/index.{$this->php_ex}", 'i=portal&amp;mode=modules') : $this->u_action));
				}

				// show custom HTML files on the settings page of the modules instead of the standard board3 portal one, if chosen by module
				if(!isset($this->c_class->custom_acp_tpl) || empty($this->c_class->custom_acp_tpl))
				{
					$this->tpl_name = 'portal/acp_portal_config';
				}
				else
				{
					$this->tpl_name = 'portal/' . $this->c_class->custom_acp_tpl;
				}
				$this->page_title = $display_vars['title'];

				$this->template->assign_vars(array(
					'L_TITLE'			=> $this->user->lang[$display_vars['title']],
					'L_TITLE_EXPLAIN'	=> (isset($this->user->lang[$display_vars['title'] . '_EXP'])) ? $this->user->lang[$display_vars['title'] . '_EXP'] : '',

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
						$this->template->assign_block_vars('options', array(
							'S_LEGEND'		=> true,
							'LEGEND'		=> (isset($this->user->lang[$vars])) ? $this->user->lang[$vars] : $vars)
						);

						continue;
					}
					$this->new_config[$config_key] = $this->config[$config_key];
					$type = explode(':', $vars['type']);

					$l_explain = '';
					if ($vars['explain'])
					{
						$l_explain = (isset($this->user->lang[$vars['lang'] . '_EXP'])) ? $this->user->lang[$vars['lang'] . '_EXP'] : '';
					}

					if($vars['type'] != 'custom')
					{
						$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);
					}
					else
					{
						$args = array($this->new_config[$config_key], $config_key, $module_id);
						if (!is_array($vars['method']))
						{
							$func = array($this->c_class, $vars['method']);
						}
						else
						{
							$func = $vars['method'];
						}
						$content = call_user_func_array($func, $args);
					}

					if (empty($content))
					{
						continue;
					}

					$this->template->assign_block_vars('options', array(
						'KEY'			=> $config_key,
						'TITLE'			=> (isset($this->user->lang[$vars['lang']])) ? $this->user->lang[$vars['lang']] : $vars['lang'],
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

				// Create an array of already installed modules
				$portal_modules = obtain_portal_modules();
				$installed_modules = $module_column = array();

				foreach($portal_modules as $cur_module) 
				{ 
					$installed_modules[] = $cur_module['module_classname'];
					// Create an array with the columns the module is in
					$module_column[$cur_module['module_classname']][] = column_num_string($cur_module['module_column']);
				}

				if ($action == 'move_up')
				{
					$this->move_module_up($module_id);
				}
				elseif ($action == 'move_down')
				{
					$this->move_module_down($module_id);
				}
				elseif($action == 'move_right')
				{
					$this->move_module_right($module_id);
				}
				elseif($action == 'move_left')
				{
					$this->move_module_left($module_id);
				}
				elseif ($action == 'delete')
				{
					$this->module_delete($id, $mode, $action, $module_id);
				}

				$add_module = key(request_var('add', array('' => '')));
				$add_column = request_var('add_column', column_string_num($add_module));
				if ($add_column)
				{
					$submit = (isset($_POST['submit'])) ? true : false;
					$directory = $this->phpbb_root_path . 'portal/modules/';

					if ($submit)
					{
						$module_classname = request_var('module_classname', '');
						$class = 'portal_' . $module_classname . '_module';

						$column_string = column_num_string($add_column);

						// do we want to add the module to the side columns or to the center columns?
						if (in_array($column_string, array('left', 'right')))
						{
							// does the module already exist in the side columns?
							if (isset($module_column[$module_classname]) && 
								(in_array('left', $module_column[$module_classname]) || in_array('right', $module_column[$module_classname])))
							{
								$submit = false;
							}
						}
						elseif (in_array($column_string, array('center', 'top', 'bottom')))
						{
							// does the module already exist in the center columns?
							if (isset($module_column[$module_classname]) && 
								(in_array('center', $module_column[$module_classname]) || 
								in_array('top', $module_column[$module_classname]) || 
								in_array('bottom', $module_column[$module_classname])))
							{
								$submit = false;
							}
						}

						// do not install if module already exists in that column
						if (!$submit && $module_classname != 'custom')
						{
							trigger_error($this->user->lang['MODULE_ADD_ONCE'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						if (!class_exists($class))
						{
							include($directory . 'portal_' . $module_classname . '.' . $this->php_ex);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$sql = 'SELECT module_order
							FROM ' . PORTAL_MODULES_TABLE . '
							WHERE module_column = ' . $add_column . '
							ORDER BY module_order DESC';
						$result = $this->db->sql_query_limit($sql, 1);
						$module_order = 1 + (int) $this->db->sql_fetchfield('module_order');
						$this->db->sql_freeresult($result);

						$this->c_class = new $class();

						$sql_ary = array(
							'module_classname'	=> $module_classname,
							'module_column'		=> $add_column,
							'module_order'		=> $module_order,
							'module_name'		=> $this->c_class->name,
							'module_image_src'	=> $this->c_class->image_src,
							'module_group_ids'	=> '',
							'module_image_height'	=> 16,
							'module_image_width'	=> 16,
							'module_status'		=> B3_MODULE_ENABLED,
						);
						$sql = 'INSERT INTO ' . PORTAL_MODULES_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
						$this->db->sql_query($sql);

						$module_id = $this->db->sql_nextid();

						$error = $this->c_class->install($module_id);

						$this->cache->purge(); // make sure we don't get errors after re-adding a module

						// if something went wrong, handle the errors accordingly and undo the above query
						if (sizeof($error) && $error != true)
						{
							if (is_array($error))
							{
								foreach($error as $cur_error)
								{
									$error_output = $cur_error . '<br />';
								}
							}
							else
							{
								$error_output = $error;
							}

							$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE . ' WHERE module_id = ' . (int) $module_id;

							trigger_error($error_output . adm_back_link($this->u_action));
						}

						meta_refresh(3, append_sid("{$this->phpbb_admin_path}index.{$this->php_ex}", 'i=portal&amp;mode=config&amp;module_id=' . $module_id));

						trigger_error($this->user->lang['SUCCESS_ADD'] . adm_back_link($this->u_action));
					}

					$this->template->assign_var('S_EDIT', true);
					$fileinfo = array();

					$dh = @opendir($directory);
					if (!$dh)
					{
						return $fileinfo;
					}

					while (($file = readdir($dh)) !== false)
					{
						// Is module?
						if (preg_match('/^portal_.+\.' . $this->php_ex . '$/', $file))
						{
							$class = str_replace(".{$this->php_ex}", '', $file) . '_module';
							$module_class = str_replace(array('portal_', ".{$this->php_ex}"), '', $file);
							$column_string = column_num_string($add_column);

							// do we want to add the module to the side columns or to the center columns?
							if ($module_class != 'custom')
							{
								if (in_array($column_string, array('left', 'right')))
								{
									// does the module already exist in the side columns?
									if (isset($module_column[$module_class]) && 
										(in_array('left', $module_column[$module_class]) || in_array('right', $module_column[$module_class])))
									{
										continue;
									}
								}
								elseif (in_array($column_string, array('center', 'top', 'bottom')))
								{
									// does the module already exist in the center columns?
									if (isset($module_column[$module_class]) && 
										(in_array('center', $module_column[$module_class]) || 
										in_array('top', $module_column[$module_class]) || 
										in_array('bottom', $module_column[$module_class])))
									{
										continue;
									}
								}
							}

							if (!class_exists($class))
							{
								include($directory . $file);
							}

							// Get module title tag
							if (class_exists($class))
							{
								$this->c_class = new $class();
								if ($this->c_class->columns & column_string_const($add_module))
								{
									if ($this->c_class->language)
									{
										$this->user->add_lang('mods/portal/' . $this->c_class->language);
									}
									$fileinfo[] = array(
										'module'		=> substr($class, 7, -7),
										'name'			=> $this->user->lang[$this->c_class->name],
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
					$this->template->assign_vars(array(
						'S_MODULE_NAMES'	=> $options,
						'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
					));
				}
				else
				{
					$directory = $this->phpbb_root_path . 'portal/modules/';

					$portal_modules = obtain_portal_modules();

					foreach($portal_modules as $row)
					{
						$class = 'portal_' . $row['module_classname'] . '_module';
						if (!class_exists($class))
						{
							include($directory . 'portal_' . $row['module_classname'] . '.' . $this->php_ex);
						}
						if (!class_exists($class))
						{
							trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
						}

						$this->c_class = new $class();
						if ($this->c_class->language)
						{
							$this->user->add_lang('mods/portal/' . $this->c_class->language);
						}
						$template_column = column_num_string($row['module_column']);

						// find out of we can move modules to the left or right
						if(($this->c_class->columns & column_string_const(column_num_string($row['module_column'] + 1))) || ($this->c_class->columns & column_string_const(column_num_string($row['module_column'] + 2)) && $row['module_column'] != 2))
						{
							/**
							* check if we can actually move
							* this only applies to modules in the center column as the side modules
							* will automatically skip the center column when moving if they need to
							*/
							if ($row['module_classname'] != 'custom')
							{
								$column_string = column_num_string($row['module_column'] + 1); // move 1 right

								if ($column_string == 'right' &&
									isset($module_column[$row['module_classname']]) &&
									(in_array('left', $module_column[$row['module_classname']]) ||
									in_array('right', $module_column[$row['module_classname']])))
								{
									$move_right = false;
								}
								else
								{
									$move_right = true;
								}
							}
							else
							{
								$move_right = true;
							}
						}
						else
						{
							$move_right = false;
						}

						if(($this->c_class->columns & column_string_const(column_num_string($row['module_column'] - 1))) || ($this->c_class->columns & column_string_const(column_num_string($row['module_column'] - 2)) && $row['module_column'] != 2))
						{
							/**
							* check if we can actually move
							* this only applies to modules in the center column as the side modules
							* will automatically skip the center column when moving if they need to
							*/
							if ($row['module_classname'] != 'custom')
							{
								$column_string = column_num_string($row['module_column'] - 1); // move 1 left

								if ($column_string == 'left' &&
									isset($module_column[$row['module_classname']]) &&
									(in_array('left', $module_column[$row['module_classname']]) ||
									in_array('right', $module_column[$row['module_classname']])))
								{
									$move_left = false;
								}
								else
								{
									$move_left = true;
								}
							}
							else
							{
								$move_left = true;
							}
						}
						else
						{
							$move_left = false;
						}

						$this->template->assign_block_vars('modules_' . $template_column, array(
							'MODULE_NAME'		=> (isset($this->user->lang[$row['module_name']])) ? $this->user->lang[$row['module_name']] : $row['module_name'],
							'MODULE_IMAGE'		=> ($row['module_image_src']) ? '<img src="' . $this->phpbb_root_path . 'styles/' . $this->user->theme['theme_path'] . '/theme/images/portal/' . $row['module_image_src'] . '" alt="' . $row['module_name'] . '" />' : '',
							'MODULE_ENABLED'	=> ($row['module_status']) ? true : false,

							'U_DELETE'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;module_classname=' . $row['module_classname'] . '&amp;action=delete',
							'U_EDIT'			=> append_sid("{$this->phpbb_admin_path}index.{$this->php_ex}", 'i=portal&amp;mode=config&amp;module_id=' . $row['module_id']),
							'U_MOVE_UP'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_up',
							'U_MOVE_DOWN'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_down',
							'U_MOVE_RIGHT'		=> ($move_right) ? $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_right' : '',
							'U_MOVE_LEFT'		=> ($move_left) ? $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_left' : '',
						));
					}

					$this->template->assign_vars(array(
						'ICON_MOVE_LEFT'				=> '<img src="' . $this->phpbb_admin_path . 'images/icon_left.gif" alt="' . $this->user->lang['MOVE_LEFT'] . '" title="' . $this->user->lang['MOVE_LEFT'] . '" />',
						'ICON_MOVE_LEFT_DISABLED'		=> '<img src="' . $this->phpbb_admin_path . 'images/icon_left_disabled.gif" alt="' . $this->user->lang['MOVE_LEFT'] . '" title="' . $this->user->lang['MOVE_LEFT'] . '" />',
						'ICON_MOVE_RIGHT'				=> '<img src="' . $this->phpbb_admin_path . 'images/icon_right.gif" alt="' . $this->user->lang['MOVE_RIGHT'] . '" title="' . $this->user->lang['MOVE_RIGHT'] . '" />',
						'ICON_MOVE_RIGHT_DISABLED'		=> '<img src="' . $this->phpbb_admin_path . 'images/icon_right_disabled.gif" alt="' . $this->user->lang['MOVE_RIGHT'] . '" title="' . $this->user->lang['MOVE_RIGHT'] . '" />',
					));
				}

				$this->tpl_name = 'portal/acp_portal_modules';
				$this->page_title = 'ACP_PORTAL_MODULES';
			break;
			case 'upload_module':
				$error = array();
				if($submit)
				{
					if(!check_form_key('acp_portal_module_upload'))
					{
						trigger_error($this->user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
					}
					include($this->phpbb_root_path . 'portal/includes/functions_upload.' . $this->php_ex);
					// Default upload path is portal/upload/
					$upload_path = $this->phpbb_root_path . 'portal/upload/';

					$portal_upload = new portal_upload($upload_path, $this->u_action);

					$this->tpl_name = 'portal/acp_portal_upload_module';
					$this->page_title = $this->user->lang['ACP_PORTAL_UPLOAD'];
				}
				else
				{
					// start the page
					$this->template->assign_vars(array(
						'U_UPLOAD'			=> $this->u_action,
						'S_FORM_ENCTYPE'	=> ' enctype="multipart/form-data"',
					));

					add_form_key('acp_portal_module_upload');

					$this->tpl_name = 'portal/acp_portal_upload_module';
					$this->page_title = $this->user->lang['ACP_PORTAL_UPLOAD'];

					$this->template->assign_vars(array(
						'L_TITLE'			=> $this->user->lang['ACP_PORTAL_UPLOAD'],
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

	/**
	* Reset module settings to default options
	*
	* @param int $id ID of the acp_portal module
	* @param string|int $mode Mode of the acp_portal module
	* @param int $module_id ID of the module that should be reset
	* @param array $module_data Array containing the module's database row
	*/
	protected function reset_module($id, $mode, $module_id, $module_data)
	{
		if (confirm_box(true))
		{
			$sql_ary = array(
				'module_name'		=> $this->c_class->name,
				'module_image_src'	=> $this->c_class->image_src,
				'module_group_ids'	=> '',
				'module_image_height'	=> 16,
				'module_image_width'	=> 16,
				'module_status'		=> B3_MODULE_ENABLED,
			);
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . ' 
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . ' 
					WHERE module_id = ' . (int) $module_id;
			$this->db->sql_query($sql);
			$affected_rows = $this->db->sql_affectedrows();

			if (empty($affected_rows))
			{
				// We need to return to the module config
				meta_refresh(3, reapply_sid($this->u_action . "&amp;module_id=$module_id"));
				trigger_error($this->user->lang['MODULE_NOT_EXISTS'] . adm_back_link($this->u_action . "&amp;module_id=$module_id"), E_USER_WARNING);
			}

			$this->cache->destroy('config');
			$this->cache->destroy('portal_config');
			$portal_config = obtain_portal_config(); // we need to prevent duplicate entry errors
			$this->c_class->install($module_id);
			$this->cache->purge();
			
			// We need to return to the module config
			meta_refresh(3, reapply_sid($this->u_action . "&amp;module_id=$module_id"));
			
			trigger_error($this->user->lang['MODULE_RESET_SUCCESS'] . adm_back_link($this->u_action . "&amp;module_id=$module_id"));
		}
		else
		{
			$confirm_text = (isset($this->user->lang[$module_data['module_name']])) ? sprintf($this->user->lang['MODULE_RESET_CONFIRM'], $this->user->lang[$module_data['module_name']]) : sprintf($this->user->lang['DELETE_MODULE_CONFIRM'], utf8_normalize_nfc($module_data['module_name']));
			confirm_box(false, $confirm_text, build_hidden_fields(array(
				'i'				=> $id,
				'mode'			=> $mode,
				'module_reset'	=> true,
				'module_id'		=> $module_id,
			)));
		}
	}

	/**
	* Move module up one row
	*
	* @param int $module_id ID of the module that should be moved
	*/
	protected function move_module_up($module_id)
	{
		$sql = 'SELECT module_order, module_column
			FROM ' . PORTAL_MODULES_TABLE . '
			WHERE module_id = ' . (int) $module_id;
		$result = $this->db->sql_query_limit($sql, 1);
		$module_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if (($module_data !== false) && ($module_data['module_order'] > 1))
		{
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order + 1
				WHERE module_order = ' . (int) ($module_data['module_order'] - 1) . '
					AND module_column = ' . (int) $module_data['module_column'];

			$this->db->sql_query($sql);
			$updated = $this->db->sql_affectedrows();
			if ($updated)
			{
				$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = module_order - 1
					WHERE module_id = ' . (int) $module_id;
				$this->db->sql_query($sql);
			}
		}
		else
		{
			trigger_error($this->user->lang['UNABLE_TO_MOVE_ROW'] . adm_back_link($this->u_action));
		}
		
		$this->cache->destroy('portal_modules');
		redirect($this->u_action); // redirect in order to get rid of excessive URL parameters
	}

	/**
	* Move module down one row
	*
	* @param int $module_id ID of the module that should be moved
	*/
	protected function move_module_down($module_id)
	{
		$sql = 'SELECT module_order, module_column
			FROM ' . PORTAL_MODULES_TABLE . '
			WHERE module_id = ' . (int) $module_id;
		$result = $this->db->sql_query_limit($sql, 1);
		$module_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if ($module_data !== false)
		{
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order - 1
				WHERE module_order = ' . (int) ($module_data['module_order'] + 1) . '
					AND module_column = ' . (int) $module_data['module_column'];
			$this->db->sql_query($sql);
			$updated = $this->db->sql_affectedrows();
			if ($updated)
			{
				$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = module_order + 1
					WHERE module_id = ' . (int) $module_id;
				$this->db->sql_query($sql);
			}
		}
		else
		{
			trigger_error($this->user->lang['UNABLE_TO_MOVE_ROW'] . adm_back_link($this->u_action));
		}
		
		$this->cache->destroy('portal_modules');
		redirect($this->u_action); // redirect in order to get rid of excessive URL parameters
	}

	/**
	* Move module left one column
	*
	* @param int $module_id ID of the module that should be moved
	*/
	protected function move_module_left($module_id)
	{
		$sql = 'SELECT module_order, module_column, module_classname
			FROM ' . PORTAL_MODULES_TABLE . '
			WHERE module_id = ' . (int) $module_id;
		$result = $this->db->sql_query_limit($sql, 1);
		$module_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		
		$class = 'portal_' . $module_data['module_classname'] . '_module';
		if (!class_exists($class))
		{
			include($this->phpbb_root_path . 'portal/modules/portal_' . $module_data['module_classname'] . '.' . $this->php_ex);
		}
		if (!class_exists($class))
		{
			trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
		}
		$this->c_class = new $class();
		
		if ($module_data !== false)
		{
			if($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] - 1)))
			{
				$move_action = 1; // we move 1 column to the left
			}
			elseif($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] - 2)) && $module_data['module_column'] != 2)
			{
				$move_action = 2; // we move 2 columns to the left
			}
			else
			{
				// @todo: need an error handle here (i.e. trigger_error())
			}
			
			/**
			* moving only 1 column to the left means we will either end up in the left column
			* or in the center column. this is not possible when moving 2 columns to the left.
			* therefore we only need to check if we won't end up with a duplicate module in the
			* new column (side columns (left & right) or center columns (top, center, bottom)).
			* of course this does not apply to custom modules.
			*/
			if ($module_data['module_classname'] != 'custom' && $move_action == 1)
			{
				$column_string = column_num_string($module_data['module_column'] - $move_action);
				// we can only move left to the left & center column
				if ($column_string == 'left' &&
					isset($module_column[$module_data['module_classname']]) &&
					(in_array('left', $module_column[$module_data['module_classname']]) ||
					in_array('right', $module_column[$module_data['module_classname']])))
				{
					trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
				}
				elseif ($column_string == 'center' &&
					isset($module_column[$module_data['module_classname']]) &&
					(in_array('center', $module_column[$module_data['module_classname']]) ||
					in_array('top', $module_column[$module_data['module_classname']]) ||
					in_array('bottom', $module_column[$module_data['module_classname']])))
				{
					// we are moving from the right to the center column so we should move to the left column instead
					$move_action = 2;
				}
			}

			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order + 1
				WHERE module_order >= ' . $module_data['module_order'] . '
					AND module_column = ' . ($module_data['module_column'] - $move_action);
			$this->db->sql_query($sql);
			$updated = $this->db->sql_affectedrows();

			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_column = module_column - ' . $move_action . '
				WHERE module_id = ' . (int) $module_id;
			$this->db->sql_query($sql);
			
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order - 1
				WHERE module_order >= ' . $module_data['module_order'] . '
				AND module_column = ' . $module_data['module_column'];
			$this->db->sql_query($sql);
			
			// the module that needs to moved is in the last row
			if(!$updated)
			{
				$sql = 'SELECT MAX(module_order) as new_order
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_order < ' . $module_data['module_order'] . '
						AND module_column = ' . (int) ($module_data['module_column'] - $move_action);
				$this->db->sql_query($sql);
				$new_order = $this->db->sql_fetchfield('new_order') + 1;
				
				$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = ' . $new_order . '
					WHERE module_id = ' . (int) $module_id;
				$this->db->sql_query($sql);
			}
		}
		else
		{
			trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
		}
		
		$this->cache->destroy('portal_modules');
		redirect($this->u_action); // redirect in order to get rid of excessive URL parameters
	}

	/**
	* Move module right one column
	*
	* @param int $module_id ID of the module that should be moved
	*/
	protected function move_module_right($module_id)
	{
		$sql = 'SELECT module_order, module_column, module_classname
			FROM ' . PORTAL_MODULES_TABLE . '
			WHERE module_id = ' . (int) $module_id;
		$result = $this->db->sql_query_limit($sql, 1);
		$module_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		
		$class = 'portal_' . $module_data['module_classname'] . '_module';
		if (!class_exists($class))
		{
			include($this->phpbb_root_path . 'portal/modules/portal_' . $module_data['module_classname'] . '.' . $this->php_ex);
		}
		if (!class_exists($class))
		{
			trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
		}
		$this->c_class = new $class();
		
		if ($module_data !== false)
		{
			if($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] + 1)))
			{
				$move_action = 1; // we move 1 column to the right
			}
			elseif($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] + 2)) && $module_data['module_column'] != 2)
			{
				$move_action = 2; // we move 2 columns to the right
			}
			else
			{
				// @todo: need an error handle here
			}
			
			/**
			* moving only 1 column to the right means we will either end up in the right column
			* or in the center column. this is not possible when moving 2 columns to the right.
			* therefore we only need to check if we won't end up with a duplicate module in the
			* new column (side columns (left & right) or center columns (top, center, bottom)).
			* of course this does not apply to custom modules.
			*/
			if ($module_data['module_classname'] != 'custom' && $move_action == 1)
			{
				$column_string = column_num_string($module_data['module_column'] + $move_action);
				// we can only move right to the right & center column
				if ($column_string == 'right' &&
					isset($module_column[$module_data['module_classname']]) &&
					(in_array('left', $module_column[$module_data['module_classname']]) ||
					in_array('right', $module_column[$module_data['module_classname']])))
				{
					trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
				}
				elseif ($column_string == 'center' &&
					isset($module_column[$module_data['module_classname']]) &&
					(in_array('center', $module_column[$module_data['module_classname']]) ||
					in_array('top', $module_column[$module_data['module_classname']]) ||
					in_array('bottom', $module_column[$module_data['module_classname']])))
				{
					// we are moving from the left to the center column so we should move to the right column instead
					$move_action = 2;
				}
			}
			
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order + 1
				WHERE module_order >= ' . (int) $module_data['module_order'] . '
					AND module_column = ' . (int) ($module_data['module_column'] + $move_action);
			$this->db->sql_query($sql);
			$updated = $this->db->sql_affectedrows();

			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_column = module_column + ' . $move_action . '
				WHERE module_id = ' . (int) $module_id;
			$this->db->sql_query($sql);
			
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order - 1
				WHERE module_order >= ' . (int) $module_data['module_order'] . '
				AND module_column = ' . (int) $module_data['module_column'];
			$this->db->sql_query($sql);
			
			// the module that needs to moved is in the last row
			if(!$updated)
			{
				$sql = 'SELECT MAX(module_order) as new_order
						FROM ' . PORTAL_MODULES_TABLE . '
						WHERE module_order < ' . (int) $module_data['module_order'] . '
						AND module_column = ' . (int) ($module_data['module_column'] + $move_action);
				$this->db->sql_query($sql);
				$new_order = $this->db->sql_fetchfield('new_order') + 1;
				
				$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = ' . (int) $new_order . '
					WHERE module_id = ' . (int) $module_id;
				$this->db->sql_query($sql);
			}
		}
		else
		{
			trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
		}
		
		$this->cache->destroy('portal_modules');
		redirect($this->u_action); // redirect in order to get rid of excessive URL parameters
	}

	/**
	* Delete module
	*
	* @param int|string $id Module ID of the acp_portal module
	* @param string $mode Mode of the acp_portal module
	* @param string $action Current action of the acp_portal module
	* @param int $module_id ID of the module that should be deleted
	*/
	protected function module_delete($id, $mode, $action, $module_id)
	{
		$sql = 'SELECT *
			FROM ' . PORTAL_MODULES_TABLE . '
			WHERE module_id = ' . (int) $module_id;
		$result = $this->db->sql_query_limit($sql, 1);
		$module_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		
		$directory = $this->phpbb_root_path . 'portal/modules/';

		if ($module_data !== false)
		{
			$module_classname = request_var('module_classname', '');
			$class = 'portal_' . $module_classname . '_module';
			if (!class_exists($class))
			{
				include($directory . 'portal_' . $module_classname . '.' . $this->php_ex);
			}
			if (!class_exists($class))
			{
				trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
			}
			
			if (confirm_box(true))
			{
				$this->c_class = new $class();
				$this->c_class->uninstall($module_data['module_id']);

				$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE . '
					WHERE module_id = ' . (int) $module_id;
				$this->db->sql_query($sql);

				$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = module_order - 1
					WHERE module_column = ' . $module_data['module_column'] . '
						AND module_order > ' . $module_data['module_order'];
				$this->db->sql_query($sql);
				
				$this->cache->purge(); // make sure we don't get errors after re-adding a module

				trigger_error($this->user->lang['SUCCESS_DELETE'] . adm_back_link($this->u_action));
			}
			else
			{
				$this->c_class = new $class();
				if ($this->c_class->language)
				{
					$this->user->add_lang('mods/portal/' . $this->c_class->language);
				}
				$confirm_text = (isset($this->user->lang[$module_data['module_name']])) ? sprintf($this->user->lang['DELETE_MODULE_CONFIRM'], $this->user->lang[$module_data['module_name']]) : sprintf($this->user->lang['DELETE_MODULE_CONFIRM'], utf8_normalize_nfc($module_data['module_name']));
				confirm_box(false, $confirm_text, build_hidden_fields(array(
					'i'			=> $id,
					'mode'		=> $mode,
					'action'	=> $action,
					'module_id'	=> $module_id,
				)));
			}
		}
		
		$this->cache->destroy('portal_modules');
	}
}
