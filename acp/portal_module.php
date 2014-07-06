<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\acp;

class portal_module
{
	public $u_action;
	public $new_config = array();
	protected $c_class;
	protected $db, $user, $cache, $template, $display_vars, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $phpbb_container;
	protected $root_path, $mod_version_check, $request, $php_ext;
	public $module_column = array();

	/** @var \phpbb\di\service_collection Portal modules */
	protected $modules;

	public function __construct()
	{
		global $db, $user, $cache, $request, $template, $table_prefix;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpbb_container, $phpEx;

		$user->add_lang_ext('board3/portal', array('portal', 'portal_acp'));

		$this->root_path = $phpbb_root_path . 'ext/board3/portal/';

		include($this->root_path . 'includes/constants.' . $phpEx);

		$this->db = $db;
		$this->user = $user;
		$this->cache = $cache;
		$this->template = $template;
		$this->config = $config;
		$this->request = $request;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpbb_admin_path = $phpbb_admin_path;
		$this->php_ext = $phpEx;
		$this->phpbb_container = $phpbb_container;
		$this->mod_version_check = $this->phpbb_container->get('board3.version.check');
		$this->register_modules($this->phpbb_container->get('board3.module_collection'));
		define('PORTAL_MODULES_TABLE', $this->phpbb_container->getParameter('board3.modules.table'));
		define('PORTAL_CONFIG_TABLE', $this->phpbb_container->getParameter('board3.config.table'));

		if (!function_exists('column_string_const'))
		{
			include($this->root_path . 'includes/functions_modules.' . $this->php_ext);
		}

		if(!function_exists('obtain_portal_config'))
		{
			include($this->root_path . 'includes/functions.' . $this->php_ext);
		}
	}

	public function main($id, $mode)
	{
		$submit = ($this->request->is_set_post('submit')) ? true : false;

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

				$module_id = $this->request->variable('module_id', 0);
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
						if (!isset($this->modules[$module_data['module_classname']]))
						{
							$class = 'portal_' . $module_data['module_classname'] . '_module';
							if (!class_exists($class))
							{
								include($this->root_path . 'portal/modules/portal_' . $module_data['module_classname'] . '.' . $this->php_ext);
							}
							if (class_exists($class))
							{
								$this->c_class = new $class();
							}
							else
							{
								continue;
							}
						}
						else
						{
							$this->c_class = $this->modules[$module_data['module_classname']];
						}

						if ($this->c_class->get_language())
						{
							$this->user->add_lang_ext('board3/portal', 'modules/' . $this->c_class->get_language());
						}
						$module_name = $this->user->lang[$this->c_class->get_name()];
						$display_vars = $this->c_class->get_template_acp($module_id);
						$this->template->assign_vars(array(
							'MODULE_NAME'			=> (isset($this->c_class->hide_name) && $this->c_class->hide_name == true)? '' : $module_data['module_name'],
							'MODULE_IMAGE'			=> $module_data['module_image_src'],
							'MODULE_IMAGE_WIDTH'	=> $module_data['module_image_width'],
							'MODULE_IMAGE_HEIGHT'	=> $module_data['module_image_height'],
							'MODULE_IMAGE_SRC'		=> ($module_data['module_image_src']) ? $this->root_path . 'styles/' . $this->user->style['style_path'] . '/theme/images/portal/' . $module_data['module_image_src'] : '',
							'MODULE_ENABLED'		=> ($module_data['module_status']) ? true : false,
							'MODULE_SHOW_IMAGE'		=> (in_array(column_num_string($module_data['module_column']), array('center', 'top', 'bottom'))) ? false : true,
						));

						if($module_data['module_classname'] != '\board3\portal\modules\custom')
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
					$this->mod_version_check->version_check();
				}

				$this->new_config = $this->config;
				$cfg_array = ($this->request->is_set('config')) ? $this->request->variable('config', array('' => ''), true) : $this->new_config;
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
				$reset_module = $this->request->variable('module_reset', 0);

				if($reset_module && !empty($module_data))
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
					$module_permission = $this->request->variable('permission-setting', array(0 => ''));
					$groups_ary = array();

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
						'module_image_src'		=> $this->request->variable('module_image', ''),
						'module_image_width'	=> $this->request->variable('module_img_width', 0),
						'module_image_height'	=> $this->request->variable('module_img_height', 0),
						'module_group_ids'		=> $module_permission,
						'module_status'			=> $this->request->variable('module_status', B3_MODULE_ENABLED),
					);

					if(!(isset($this->c_class->hide_name) && $this->c_class->hide_name == true))
					{
						$sql_ary['module_name'] = $this->request->variable('module_name', '', true);
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
						if (isset($module_data) && $module_data['module_classname'] !== '\board3\portal\modules\custom')
						{
							add_log('admin', 'LOG_PORTAL_CONFIG', $module_name);
						}
					}
					else
					{
						add_log('admin', 'LOG_PORTAL_CONFIG', $this->user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
					}
					trigger_error($this->user->lang['CONFIG_UPDATED'] . ((!empty($img_error) ? '<br /><br />' . $this->user->lang['MODULE_IMAGE_ERROR'] . '<br />' . $img_error : '')) . adm_back_link(($module_id) ? append_sid("{$this->phpbb_root_path}adm/index.{$this->php_ext}", 'i=\board3\portal\acp\portal_module&amp;mode=modules') : $this->u_action));
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

					'B3P_U_ACTION'			=> $this->get_module_link('config', $module_id),
					'B3P_ACP_ROOT'		=> $this->root_path,
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
				$action = $this->request->variable('action', '');
				$module_id = $this->request->variable('module_id', '');

				// Create an array of already installed modules
				$portal_modules = obtain_portal_modules();
				$installed_modules = array();

				foreach($portal_modules as $cur_module)
				{
					$installed_modules[] = $cur_module['module_classname'];
					// Create an array with the columns the module is in
					$this->module_column[$cur_module['module_classname']][] = column_num_string($cur_module['module_column']);
				}

				if ($action == 'move_up')
				{
					$this->move_module_up($module_id);
				}
				else if ($action == 'move_down')
				{
					$this->move_module_down($module_id);
				}
				else if($action == 'move_right')
				{
					$this->move_module_right($module_id);
				}
				else if($action == 'move_left')
				{
					$this->move_module_left($module_id);
				}
				else if ($action == 'delete')
				{
					$this->module_delete($id, $mode, $action, $module_id);
				}

				$add_list = $this->request->variable('add', array('' => ''));
				$add_module = key($add_list);
				$add_column = $this->request->variable('add_column', column_string_num($add_module));
				if ($add_column)
				{
					$submit = ($this->request->is_set_post('submit')) ? true : false;
					if ($submit)
					{
						$module_classname = $this->request->variable('module_classname', '');

						$column_string = column_num_string($add_column);

						// do we want to add the module to the side columns or to the center columns?
						if (in_array($column_string, array('left', 'right')))
						{
							$submit = $this->can_move_module(array('left', 'right'), $module_classname);
						}
						else if (in_array($column_string, array('center', 'top', 'bottom')))
						{
							$submit = $this->can_move_module(array('center', 'top', 'bottom'), $module_classname);
						}

						// do not install if module already exists in that column
						if (!$submit && $module_classname != '\board3\portal\modules\custom')
						{
							trigger_error($this->user->lang['MODULE_ADD_ONCE'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						if (isset($this->modules[$module_classname]))
						{
							$this->c_class = $this->modules[$module_classname];
						}
						else
						{
							continue;
						}

						$sql = 'SELECT module_order
							FROM ' . PORTAL_MODULES_TABLE . '
							WHERE module_column = ' . $add_column . '
							ORDER BY module_order DESC';
						$result = $this->db->sql_query_limit($sql, 1);
						$module_order = 1 + (int) $this->db->sql_fetchfield('module_order');
						$this->db->sql_freeresult($result);

						$sql_ary = array(
							'module_classname'	=> $module_classname,
							'module_column'		=> $add_column,
							'module_order'		=> $module_order,
							'module_name'		=> $this->c_class->get_name(),
							'module_image_src'	=> $this->c_class->get_image(),
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
						if (!empty($error) && $error != true)
						{
							if (is_array($error))
							{
								$error_output = '';
								foreach($error as $cur_error)
								{
									$error_output .= $cur_error . '<br />';
								}
							}
							else
							{
								$error_output = $error;
							}

							$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE . ' WHERE module_id = ' . (int) $module_id;
							$this->db->sql_query($sql);

							trigger_error($error_output . adm_back_link($this->u_action));
						}

						meta_refresh(3, $this->get_module_link('config', $module_id));

						trigger_error($this->user->lang['SUCCESS_ADD'] . adm_back_link($this->u_action));
					}

					$this->template->assign_var('S_EDIT', true);
					$fileinfo = $name_ary = array();
					$column_string = column_num_string($add_column);

					// Find new modules
					foreach ($this->modules as $module_class => $module)
					{
						if ($module_class !== '\board3\portal\modules\custom')
						{
							if (in_array($column_string, array('left', 'right')))
							{
								// does the module already exist in the side columns?
								if (!$this->can_move_module(array('left', 'right'), $module_class))
								{
									continue;
								}
							}
							else if (in_array($column_string, array('center', 'top', 'bottom')))
							{
								// does the module already exist in the center columns?
								if (!$this->can_move_module(array('center', 'top', 'bottom'), $module_class))
								{
									continue;
								}
							}
						}

						if ($module->get_allowed_columns() & column_string_const($add_module))
						{
							if ($module->get_language())
							{
								$this->user->add_lang_ext('board3/portal', 'modules/' . $module->get_language());
							}
							$fileinfo[] = array(
								'module'		=> $module_class,
								'name'			=> $this->user->lang[$module->get_name()],
							);
						}
					}

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

					if ($this->request->is_ajax())
					{
						$this->template->assign_vars(array(
							'S_AJAX_REQUEST'	=> true,
							'U_ACTION'		=> str_replace('&amp;', '&', $this->get_module_link('modules', $module_id)),
						));
						$this->template->set_filenames(array(
							'body' => 'portal/acp_portal_modules.html')
						);
						$json_response = new \phpbb\json_response;
						$json_response->send(array(
							'MESSAGE_BODY'		=> $this->template->assign_display('body'),
							'MESSAGE_TITLE'		=> $this->user->lang['ADD_MODULE'],
							'MESSAGE_TEXT'		=> $this->user->lang['ADD_MODULE'],

							'YES_VALUE'		=> $this->user->lang['SUBMIT'],
							'S_CONFIRM_ACTION'	=> str_replace('&amp;', '&', $this->get_module_link('modules', $module_id)), //inefficient, rewrite whole function
							'S_HIDDEN_FIELDS'	=> $s_hidden_fields
						));
					}
				}
				else
				{
					$portal_modules = obtain_portal_modules();

					foreach($portal_modules as $row)
					{
						if (!isset($this->modules[$row['module_classname']]))
						{
							continue;
						}
						else
						{
							$this->c_class = $this->modules[$row['module_classname']];
						}

						if ($this->c_class->get_language())
						{
							$this->user->add_lang_ext('board3/portal', 'modules/' . $this->c_class->get_language());
						}
						$template_column = column_num_string($row['module_column']);

						// find out of we can move modules to the left or right
						if(($this->c_class->get_allowed_columns() & column_string_const(column_num_string($row['module_column'] + 1))) || ($this->c_class->get_allowed_columns() & column_string_const(column_num_string($row['module_column'] + 2)) && $row['module_column'] != 2))
						{
							/**
							* check if we can actually move
							* this only applies to modules in the center column as the side modules
							* will automatically skip the center column when moving if they need to
							*/
							if ($row['module_classname'] != '\board3\portal\modules\custom')
							{
								$column_string = column_num_string($row['module_column'] + 1); // move 1 right

								if ($column_string == 'right' && !$this->can_move_module(array('left', 'right'), $row['module_classname']))
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

						if(($this->c_class->get_allowed_columns() & column_string_const(column_num_string($row['module_column'] - 1))) || ($this->c_class->get_allowed_columns() & column_string_const(column_num_string($row['module_column'] - 2)) && $row['module_column'] != 2))
						{
							/**
							* check if we can actually move
							* this only applies to modules in the center column as the side modules
							* will automatically skip the center column when moving if they need to
							*/
							if ($row['module_classname'] != '\board3\portal\modules\custom')
							{
								$column_string = column_num_string($row['module_column'] - 1); // move 1 left

								if ($column_string == 'left' && !$this->can_move_module(array('left', 'right'), $row['module_classname']))
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
							'MODULE_IMAGE'		=> ($row['module_image_src']) ? '<img src="' . $this->root_path . 'styles/' .  $this->user->style['style_path'] . '/theme/images/portal/' . $row['module_image_src'] . '" alt="' . $row['module_name'] . '" />' : '',
							'MODULE_ENABLED'	=> ($row['module_status']) ? true : false,

							'U_DELETE'			=> $this->get_module_link('modules', $row['module_id']) . '&amp;action=delete&amp;module_classname=' . $row['module_classname'],
							'U_EDIT'			=> $this->get_module_link('config', $row['module_id']),
							'U_MOVE_UP'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_up',
							'U_MOVE_DOWN'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_down',
							'U_MOVE_RIGHT'		=> ($move_right) ? $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_right' : '',
							'U_MOVE_LEFT'		=> ($move_left) ? $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_left' : '',
						));
					}

					$this->template->assign_vars(array(
						'ICON_MOVE_LEFT'				=> '<img src="' . $this->root_path . 'adm/images/icon_left.gif" alt="' . $this->user->lang['MOVE_LEFT'] . '" title="' . $this->user->lang['MOVE_LEFT'] . '" />',
						'ICON_MOVE_LEFT_DISABLED'		=> '<img src="' . $this->root_path . 'adm/images/icon_left_disabled.gif" alt="' . $this->user->lang['MOVE_LEFT'] . '" title="' . $this->user->lang['MOVE_LEFT'] . '" />',
						'ICON_MOVE_RIGHT'				=> '<img src="' . $this->root_path . 'adm/images/icon_right.gif" alt="' . $this->user->lang['MOVE_RIGHT'] . '" title="' . $this->user->lang['MOVE_RIGHT'] . '" />',
						'ICON_MOVE_RIGHT_DISABLED'		=> '<img src="' . $this->root_path . 'adm/images/icon_right_disabled.gif" alt="' . $this->user->lang['MOVE_RIGHT'] . '" title="' . $this->user->lang['MOVE_RIGHT'] . '" />',
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
					include($this->root_path . 'includes/functions_upload.' . $this->php_ext);
					// Default upload path is portal/upload/
					$upload_path = $this->root_path . 'portal/upload/';

					new portal_upload($upload_path, $this->u_action);

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
			$sql = 'SELECT module_order, module_column, module_classname
				FROM ' . PORTAL_MODULES_TABLE . '
				WHERE module_id = ' . (int) $module_id;
			$result = $this->db->sql_query_limit($sql, 1);
			$module_data = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if (!isset($this->modules[$module_data['module_classname']]))
			{
				trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
			}

			$this->c_class = $this->modules[$module_data['module_classname']];

			$sql_ary = array(
				'module_name'		=> $this->c_class->get_name(),
				'module_image_src'	=> $this->c_class->get_image(),
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
				meta_refresh(3, $this->get_module_link('config', $module_id));
				trigger_error($this->user->lang['MODULE_NOT_EXISTS'] . adm_back_link($this->u_action . "&amp;module_id=$module_id"), E_USER_WARNING);
			}

			$this->cache->destroy('config');
			$this->cache->destroy('portal_config');
			obtain_portal_config(); // we need to prevent duplicate entry errors
			$this->c_class->install($module_id);
			$this->cache->purge();

			// We need to return to the module config
			meta_refresh(3, $this->get_module_link('config', $module_id));

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
	* Get module_data required for moving it
	*
	* @param int	$module_id	ID of the module that should be moved
	* @return array|null		Module_data or empty if not successful
	*/
	public function get_move_module_data($module_id)
	{
		$sql = 'SELECT module_order, module_column, module_classname
			FROM ' . PORTAL_MODULES_TABLE . '
			WHERE module_id = ' . (int) $module_id;
		$result = $this->db->sql_query_limit($sql, 1);
		$module_data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $module_data;
	}

	/**
	* Handle output after moving module
	*
	* @param bool $success	Whether moving module was successful
	* @param bool $is_row	Whether the module move was inside a row
	* @return void
	*/
	public function handle_after_move($success = true, $is_row = false)
	{
		if (!$success)
		{
			trigger_error($this->user->lang['UNABLE_TO_MOVE' . (($is_row) ? '_ROW' : '')] . adm_back_link($this->u_action));
		}

		$this->cache->destroy('portal_modules');

		if ($this->request->is_ajax())
		{
			$json_response = new \phpbb\json_response;
			$json_response->send(array('success' => true));
		}
		redirect($this->u_action); // redirect in order to get rid of excessive URL parameters
	}

	/**
	* Get the module order to the last module in the column
	*
	* @param int $module_column	Module column to check
	* @return int Module order of the last module in the column
	*/
	public function get_last_module_order($module_column)
	{
		$modules = obtain_portal_modules();
		$last_order = 1;
		foreach ($modules as $cur_module)
		{
			if ($cur_module['module_column'] != $module_column)
			{
				continue;
			}

			$last_order = max($last_order, $cur_module['module_order']);
		}

		return $last_order;
	}

	/**
	* Move module up one row
	*
	* @param int $module_id ID of the module that should be moved
	*/
	public function move_module_up($module_id)
	{
		$updated = false;
		$module_data = $this->get_move_module_data($module_id);

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

		$this->handle_after_move($updated, true);
	}

	/**
	* Move module down one row
	*
	* @param int $module_id ID of the module that should be moved
	*/
	public function move_module_down($module_id)
	{
		$updated = false;
		$module_data = $this->get_move_module_data($module_id);

		if ($module_data !== false && $this->get_last_module_order($module_data['module_column']) != $module_data['module_order'])
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

		$this->handle_after_move($updated, true);
	}

	/**
	* Move module left one column
	*
	* @param int $module_id ID of the module that should be moved
	*/
	public function move_module_left($module_id)
	{
		$module_data = $this->get_move_module_data($module_id);

		if (!isset($this->modules[$module_data['module_classname']]))
		{
			trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
		}

		$this->c_class = $this->modules[$module_data['module_classname']];
		$move_action = 0;

		if ($module_data !== false && $module_data['module_column'] > column_string_num('left'))
		{
			if($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] - 1)))
			{
				$move_action = 1; // we move 1 column to the left
			}
			else if($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] - 2)) && $module_data['module_column'] != 2)
			{
				$move_action = 2; // we move 2 columns to the left
			}
			else
			{
				$this->handle_after_move(false);
			}

			/**
			* moving only 1 column to the left means we will either end up in the left column
			* or in the center column. this is not possible when moving 2 columns to the left.
			* therefore we only need to check if we won't end up with a duplicate module in the
			* new column (side columns (left & right) or center columns (top, center, bottom)).
			* of course this does not apply to custom modules.
			*/
			if ($module_data['module_classname'] != '\board3\portal\modules\custom' && $move_action == 1)
			{
				$column_string = column_num_string($module_data['module_column'] - $move_action);
				// we can only move left to the left & center column
				if ($column_string == 'left' && !$this->can_move_module(array('right', 'left'), $module_data['module_classname']))
				{
					trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
				}
				else if ($column_string == 'center' && !$this->can_move_module(array('top', 'center', 'bottom'), $module_data['module_classname']))
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
			$this->handle_after_move(false);
		}

		$this->handle_after_move(true);
	}

	/**
	* Move module right one column
	*
	* @param int $module_id ID of the module that should be moved
	*/
	public function move_module_right($module_id)
	{
		$module_data = $this->get_move_module_data($module_id);

		if (!isset($this->modules[$module_data['module_classname']]))
		{
			trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
		}

		$this->c_class = $this->modules[$module_data['module_classname']];
		$move_action = 0;

		if ($module_data !== false && $module_data['module_column'] < column_string_num('right'))
		{
			if($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] + 1)))
			{
				$move_action = 1; // we move 1 column to the right
			}
			else if($this->c_class->columns & column_string_const(column_num_string($module_data['module_column'] + 2)) && $module_data['module_column'] != 2)
			{
				$move_action = 2; // we move 2 columns to the right
			}
			else
			{
				$this->handle_after_move(false);
			}

			/**
			* moving only 1 column to the right means we will either end up in the right column
			* or in the center column. this is not possible when moving 2 columns to the right.
			* therefore we only need to check if we won't end up with a duplicate module in the
			* new column (side columns (left & right) or center columns (top, center, bottom)).
			* of course this does not apply to custom modules.
			*/
			if ($module_data['module_classname'] != '\board3\portal\modules\custom' && $move_action == 1)
			{
				$column_string = column_num_string($module_data['module_column'] + $move_action);
				// we can only move right to the right & center column
				if ($column_string == 'right' && !$this->can_move_module(array('right', 'left'), $module_data['module_classname']))
				{
					trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
				}
				else if ($column_string == 'center' && !$this->can_move_module(array('top', 'center', 'bottom'), $module_data['module_classname']))
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
			$this->handle_after_move(false);
		}

		$this->handle_after_move(true);
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

		if ($module_data !== false)
		{
			$module_classname = $this->request->variable('module_classname', '');

			if (!isset($this->modules[$module_classname]))
			{
				trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
			}

			if (confirm_box(true))
			{
				$this->c_class = $this->modules[$module_classname];
				$this->c_class->uninstall($module_data['module_id'], $this->db);

				$sql = 'DELETE FROM ' . PORTAL_MODULES_TABLE . '
					WHERE module_id = ' . (int) $module_id;
				$this->db->sql_query($sql);

				$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = module_order - 1
					WHERE module_column = ' . $module_data['module_column'] . '
						AND module_order > ' . $module_data['module_order'];
				$this->db->sql_query($sql);

				$this->cache->purge(); // make sure we don't get errors after re-adding a module

				if ($this->request->is_ajax())
				{
					$json_response = new \phpbb\json_response;
					$json_response->send(array(
						'success' => true,
						'MESSAGE_TITLE'	=> $this->user->lang['INFORMATION'],
						'MESSAGE_TEXT'	=> $this->user->lang['SUCCESS_DELETE'],
					));
				}
				trigger_error($this->user->lang['SUCCESS_DELETE'] . adm_back_link($this->u_action));
			}
			else
			{
				$this->c_class = $this->modules[$module_classname];
				if ($this->c_class->get_language())
				{
					$this->user->add_lang_ext('board3/portal', 'modules/' . $this->c_class->get_language());
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

	/**
	* Get link to module settings with specified ID and portal_module mode
	*
	* @param string $mode portal_module mode
	* @param int $module_id Module ID
	*
	* @return string Link to module settings
	*/
	protected function get_module_link($mode, $module_id)
	{
		return preg_replace(array('/i=[0-9]+/', '/mode=[a-zA-Z0-9_]+/'), array('i=%5C' . str_replace('\\', '%5C', __CLASS__), 'mode=' . $mode), $this->u_action) . (($module_id) ? '&amp;module_id=' . $module_id : '');
	}

	/**
	* Register list of Board3 Portal modules
	*
	* @param \phpbb\di\service_collection $modules Board3 Modules service
	*						collection
	* @return null
	*/
	protected function register_modules($modules)
	{
		foreach ($modules as $current_module)
		{
			$class_name = '\\' . get_class($current_module);
			if (!isset($this->modules[$class_name]))
			{
				$this->modules[$class_name] = $current_module;
			}
		}
	}

	/**
	* Check if module can be moved to desired column(s)
	*
	* @param array|int	$target_column Column(s) the module should be
	*				moved to
	* @param string		$module_class Class of the module
	* @return bool		True if module can be moved to desired column,
	*			false if not
	*/
	public function can_move_module($target_column, $module_class)
	{
		$submit = true;

		if (is_array($target_column))
		{
			foreach ($target_column as $column)
			{
				if (!$this->can_move_module($column, $module_class))
				{
					$submit = false;
				}
			}
		}

		// do we want to add the module to the side columns or to the center columns?
		if (in_array($target_column, array('left', 'right')))
		{
			// does the module already exist in the side columns?
			if (isset($this->module_column[$module_class]) &&
				(in_array('left', $this->module_column[$module_class]) || in_array('right', $this->module_column[$module_class])))
			{
				$submit = false;
			}
		}
		else if (in_array($target_column, array('center', 'top', 'bottom')))
		{
			// does the module already exist in the center columns?
			if (isset($this->module_column[$module_class]) &&
				(in_array('center', $this->module_column[$module_class]) ||
				in_array('top', $this->module_column[$module_class]) ||
				in_array('bottom', $this->module_column[$module_class])))
			{
				$submit = false;
			}
		}

		return $submit;
	}
}
