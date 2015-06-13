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

	/** @var \board3\portal\modules\module_interface */
	protected $c_class;

	protected $db, $user, $cache, $template, $display_vars, $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $phpbb_container;
	protected $root_path, $request, $php_ext, $portal_helper, $modules_helper, $log, $portal_columns;

	/** @var \board3\portal\portal\modules\manager */
	protected $modules_manager;

	/** @var \board3\portal\portal\modules\constraints_handler */
	protected $modules_constraints;

	/** @var \board3\portal\controller\helper */
	protected $board3_controller_helper;

	/** @var int Board3 module enabled */
	const B3_MODULE_ENABLED = 1;

	public function __construct()
	{
		global $db, $user, $cache, $request, $template, $table_prefix;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpbb_container, $phpEx, $phpbb_log;

		$user->add_lang_ext('board3/portal', array('portal', 'portal_acp'));

		$this->root_path = $phpbb_root_path . 'ext/board3/portal/';

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
		$this->portal_helper = $this->phpbb_container->get('board3.portal.helper');
		$this->modules_helper = $this->phpbb_container->get('board3.portal.modules_helper');
		$this->log = $phpbb_log;
		$this->portal_columns = $this->phpbb_container->get('board3.portal.columns');
		$this->modules_manager = $this->phpbb_container->get('board3.portal.modules.manager');
		$this->modules_constraints = $this->phpbb_container->get('board3.portal.modules.constraints_handler');
		$this->board3_controller_helper = $this->phpbb_container->get('board3.portal.controller_helper');

		if (!defined('PORTAL_MODULES_TABLE'))
		{
			define('PORTAL_MODULES_TABLE', $this->phpbb_container->getParameter('board3.portal.modules.table'));
			define('PORTAL_CONFIG_TABLE', $this->phpbb_container->getParameter('board3.portal.config.table'));
		}

		if (!function_exists('obtain_portal_config'))
		{
			include($this->root_path . 'includes/functions.' . $this->php_ext);
		}
	}

	public function main($id, $mode)
	{
		$submit = ($this->request->is_set_post('submit')) ? true : false;

		$form_key = 'acp_portal';
		add_form_key($form_key);

		// Setup modules manager class
		$this->modules_manager->set_u_action($this->u_action)
			->set_acp_class(__CLASS__);

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
						'board3_display_jumpbox'	=> array('lang' => 'PORTAL_DISPLAY_JUMPBOX',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),

						'legend2'					=> 'ACP_PORTAL_COLUMN_WIDTH_SETTINGS',
						'board3_left_column_width'	=> array('lang' => 'PORTAL_LEFT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'board3_right_column_width'	=> array('lang' => 'PORTAL_RIGHT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),

						'legend3'					=> 'ACP_PORTAL_SHOW_ALL',
						'board3_show_all_pages'		=> array('lang' => 'ACP_PORTAL_SHOW_ALL',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'board3_show_all_side'		=> array('lang' => 'PORTAL_SHOW_ALL_SIDE',	'validate' => 'bool',	'type' => 'custom',	'method' => array('board3.portal.modules_helper', 'display_left_right'),	'submit' => array('board3.portal.modules_helper', 'store_left_right'),	'explain' => true),
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

						if (!($this->c_class = $this->portal_helper->get_module($module_data['module_classname'])))
						{
							continue;
						}

						// Load module language
						$this->board3_controller_helper->load_module_language($this->c_class);

						$module_name = $this->user->lang[$this->c_class->get_name()];
						$display_vars = $this->c_class->get_template_acp($module_id);
						$this->template->assign_vars(array(
							'MODULE_NAME'			=> (isset($this->c_class->hide_name) && $this->c_class->hide_name == true)? '' : $module_data['module_name'],
							'MODULE_IMAGE'			=> $module_data['module_image_src'],
							'MODULE_IMAGE_WIDTH'	=> $module_data['module_image_width'],
							'MODULE_IMAGE_HEIGHT'	=> $module_data['module_image_height'],
							'MODULE_IMAGE_SRC'		=> ($module_data['module_image_src']) ? $this->root_path . 'styles/all/theme/images/portal/' . $module_data['module_image_src'] : '',
							'MODULE_ENABLED'		=> ($module_data['module_status']) ? true : false,
							'MODULE_SHOW_IMAGE'		=> (in_array($this->portal_columns->number_to_string($module_data['module_column']), array('center', 'top', 'bottom'))) ? false : true,
						));

						if ($module_data['module_classname'] != '\board3\portal\modules\custom')
						{
							$groups_ary = explode(',', $module_data['module_group_ids']);

							// get group info from database and assign the block vars
							$sql = 'SELECT group_id, group_name 
									FROM ' . GROUPS_TABLE . '
									ORDER BY group_id ASC';
							$result = $this->db->sql_query($sql);
							while ($row = $this->db->sql_fetchrow($result))
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

				$this->new_config = $this->config;
				$cfg_array = ($this->request->is_set('config')) ? $this->request->variable('config', array('' => ''), true) : $this->new_config;
				$error = array();

				// We validate the complete config if wished
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

				if ($reset_module && !empty($module_data))
				{
					$this->modules_manager->reset_module($id, $mode, $module_id, $module_data);
				}

				// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
				foreach ($display_vars['vars'] as $config_name => $null)
				{
					if ($submit && ((isset($null['type']) && $null['type'] == 'custom') || (isset($null['submit_type']) && $null['submit_type'] == 'custom')))
					{
						if (!is_array($null['submit']))
						{
							if (method_exists($this->c_class, $null['submit']))
							{
								$func = array($this->c_class, $null['submit']);
								$args = ($module_id != 0) ? array($config_name, $module_id) : $config_name;
							}
							else if (function_exists($null['submit']))
							{
								$func = $null['submit'];
								$args = ($module_id != 0) ? array($cfg_array[$config_name], $config_name, $module_id) : $config_name;
							}
							else
							{
								throw new \RuntimeException($this->user->lang('UNKNOWN_MODULE_METHOD', $module_data['module_classname']));
							}
						}
						else
						{
							if ($null['submit'][0] == 'board3.portal.modules_helper')
							{
								$func = array($this->modules_helper, $null['submit'][1]);
								$args = ($module_id != 0) ? array($config_name, $module_id) : array($config_name);
							}
							else
							{
								$args = ($module_id != 0) ? array($cfg_array[$config_name], $config_name, $module_id) : array($config_name);
								$func = $null['submit'];
							}
						}

						call_user_func_array($func, $args);
					}

					if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
					{
						continue;
					}

					if (isset($null['type']) && $null['type'] == 'custom')
					{
						continue;
					}

					$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

					if ($submit)
					{
						$this->config->set($config_name, $config_value);
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
					while ($row = $this->db->sql_fetchrow($result))
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
						'module_status'			=> $this->request->variable('module_status', self::B3_MODULE_ENABLED),
					);

					if (!(isset($this->c_class->hide_name) && $this->c_class->hide_name == true))
					{
						$sql_ary['module_name'] = $this->request->variable('module_name', '', true);
					}

					// check if module image file actually exists
					$img_error = check_file_src($sql_ary['module_image_src'], '', $module_id, false);

					$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE module_id = ' . (int) $module_id;
					$this->db->sql_query($sql);

					$this->cache->destroy('sql', PORTAL_MODULES_TABLE);
					$this->cache->destroy('sql', CONFIG_TABLE);

					if (isset($module_name))
					{
						if (isset($module_data) && $module_data['module_classname'] !== '\board3\portal\modules\custom')
						{
							$this->log->add('admin', $this->user->data['user_id'], $this->user->data['user_ip'], 'LOG_PORTAL_CONFIG', false, array($module_name));
						}
					}
					else
					{
						$this->log->add('admin', $this->user->data['user_id'], $this->user->data['user_ip'], 'LOG_PORTAL_CONFIG', false, array($this->user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']));
					}
					trigger_error($this->user->lang['CONFIG_UPDATED'] . ((!empty($img_error) ? '<br /><br />' . $this->user->lang['MODULE_IMAGE_ERROR'] . '<br />' . $img_error : '')) . adm_back_link(($module_id) ? append_sid("{$this->phpbb_admin_path}index.{$this->php_ext}", 'i=\board3\portal\acp\portal_module&amp;mode=modules') : $this->u_action));
				}

				// show custom HTML files on the settings page of the modules instead of the standard board3 portal one, if chosen by module
				if (!isset($this->c_class->custom_acp_tpl) || empty($this->c_class->custom_acp_tpl))
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

					'B3P_U_ACTION'			=> $this->modules_manager->get_module_link('config', $module_id),
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

					if ($vars['type'] != 'custom')
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
							if ($vars['method'][0] == 'board3.portal.modules_helper')
							{
								$func = array($this->modules_helper, $vars['method'][1]);
							}
							else
							{
								$func = $vars['method'];
							}
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
				$installed_modules = $module_column = array();

				foreach ($portal_modules as $cur_module)
				{
					$installed_modules[] = $cur_module['module_classname'];
					// Create an array with the columns the module is in
					$module_column[$cur_module['module_classname']][] = $this->portal_columns->number_to_string($cur_module['module_column']);
				}
				$this->modules_constraints->set_module_column($module_column);
				unset($module_column);

				if ($action == 'move_up')
				{
					$this->modules_manager->move_module_vertical($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_UP);
				}
				else if ($action == 'move_down')
				{
					$this->modules_manager->move_module_vertical($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_DOWN);
				}
				else if ($action == 'move_right')
				{
					$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_RIGHT);
				}
				else if ($action == 'move_left')
				{
					$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_LEFT);
				}
				else if ($action == 'delete')
				{
					$this->modules_manager->module_delete($id, $mode, $action, $module_id);
				}

				$add_list = $this->request->variable('add', array('' => ''));
				$add_module = key($add_list);
				$add_column = $this->request->variable('add_column', $this->portal_columns->string_to_number($add_module));
				if ($add_column)
				{
					$submit = ($this->request->is_set_post('submit')) ? true : false;
					if ($submit)
					{
						$module_classname = $this->request->variable('module_classname', '');

						if (!($this->c_class = $this->portal_helper->get_module($module_classname)))
						{
							continue;
						}

						// Do not add modules that shouldn't be added
						if (!$this->modules_constraints->can_add_module($this->c_class, $add_column))
						{
							trigger_error($this->user->lang('UNABLE_TO_ADD_MODULE') . adm_back_link($this->u_action), E_USER_WARNING);
						}

						// Do not install if module already exists in the
						// column and it can't be added more than once
						if (!$this->c_class->can_multi_include() && !$this->modules_constraints->can_move_module($this->portal_columns->number_to_string($add_column), $module_classname))
						{
							trigger_error($this->user->lang['MODULE_ADD_ONCE'] . adm_back_link($this->u_action), E_USER_WARNING);
						}

						$sql = 'SELECT module_order
							FROM ' . PORTAL_MODULES_TABLE . '
							WHERE module_column = ' . (int) $add_column . '
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
							'module_status'		=> self::B3_MODULE_ENABLED,
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
								foreach ($error as $cur_error)
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

						meta_refresh(3, $this->modules_manager->get_module_link('config', $module_id));

						trigger_error($this->user->lang['SUCCESS_ADD'] . adm_back_link($this->u_action));
					}

					$this->template->assign_var('S_EDIT', true);
					$fileinfo = $name_ary = array();
					$modules_list = $this->portal_helper->get_all_modules();

					// Find new modules
					foreach ($modules_list as $module_class => $module)
					{
						// Module can't be added to this column
						if (!$this->modules_constraints->can_add_module($module, $add_column))
						{
							continue;
						}

						// Do not install if module already exists in the
						// column and it can't be added more than once
						if (!$module->can_multi_include() && !$this->modules_constraints->can_move_module($this->portal_columns->number_to_string($add_column), $module_class))
						{
							continue;
						}

						if ($module->get_allowed_columns() & $this->portal_columns->string_to_constant($add_module))
						{
							// Load module language
							$this->board3_controller_helper->load_module_language($module);

							$fileinfo[] = array(
								'module'		=> $module_class,
								'name'			=> $this->user->lang[$module->get_name()],
							);
						}
					}

					// we sort the $fileinfo array by the name of the modules
					foreach ($fileinfo as $key => $cur_file)
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
						'add_column'	=> $this->portal_columns->string_to_number($add_module),
					));
					$this->template->assign_vars(array(
						'S_MODULE_NAMES'	=> $options,
						'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
					));

					if ($this->request->is_ajax())
					{
						$this->template->assign_vars(array(
							'S_AJAX_REQUEST'	=> true,
							'U_ACTION'		=> str_replace('&amp;', '&', $this->modules_manager->get_module_link('modules', $module_id)),
						));
						$this->template->set_filenames(array(
							'body' => 'portal/acp_portal_modules.html')
						);
						$this->modules_manager->handle_ajax_request(array(
							'MESSAGE_BODY'		=> $this->template->assign_display('body'),
							'MESSAGE_TITLE'		=> $this->user->lang['ADD_MODULE'],
							'MESSAGE_TEXT'		=> $this->user->lang['ADD_MODULE'],

							'YES_VALUE'		=> $this->user->lang['SUBMIT'],
							'S_CONFIRM_ACTION'	=> str_replace('&amp;', '&', $this->modules_manager->get_module_link('modules', $module_id)), //inefficient, rewrite whole function
							'S_HIDDEN_FIELDS'	=> $s_hidden_fields
						));
					}
				}
				else
				{
					$portal_modules = obtain_portal_modules();

					foreach ($portal_modules as $row)
					{
						if (!($this->c_class = $this->portal_helper->get_module($row['module_classname'])))
						{
							continue;
						}

						// Load module language
						$this->board3_controller_helper->load_module_language($this->c_class);

						$template_column = $this->portal_columns->number_to_string($row['module_column']);

						// find out of we can move modules to the left or right
						if (($this->c_class->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($row['module_column'] + 1))) || ($this->c_class->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($row['module_column'] + 2)) && $row['module_column'] != 2))
						{
							/**
							* check if we can actually move
							* this only applies to modules in the center column as the side modules
							* will automatically skip the center column when moving if they need to
							*/
							if ($row['module_classname'] != '\board3\portal\modules\custom')
							{
								$column_string = $this->portal_columns->number_to_string($row['module_column'] + 1); // move 1 right

								if ($column_string == 'right' && !$this->modules_constraints->can_move_module(array('left', 'right'), $row['module_classname']))
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

						if (($this->c_class->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($row['module_column'] - 1))) || ($this->c_class->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($row['module_column'] - 2)) && $row['module_column'] != 2))
						{
							/**
							* check if we can actually move
							* this only applies to modules in the center column as the side modules
							* will automatically skip the center column when moving if they need to
							*/
							if ($row['module_classname'] != '\board3\portal\modules\custom')
							{
								$column_string = $this->portal_columns->number_to_string($row['module_column'] - 1); // move 1 left

								if ($column_string == 'left' && !$this->modules_constraints->can_move_module(array('left', 'right'), $row['module_classname']))
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
							'MODULE_IMAGE'		=> ($row['module_image_src']) ? '<img src="' . $this->root_path . 'styles/all/theme/images/portal/' . $row['module_image_src'] . '" alt="' . $row['module_name'] . '" />' : '',
							'MODULE_ENABLED'	=> ($row['module_status']) ? true : false,

							'U_DELETE'			=> $this->modules_manager->get_module_link('modules', $row['module_id']) . '&amp;action=delete&amp;module_classname=' . $row['module_classname'],
							'U_EDIT'			=> $this->modules_manager->get_module_link('config', $row['module_id']),
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
						'B3P_U_ACTION'					=> $this->modules_manager->get_module_link('modules', $module_id),
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
