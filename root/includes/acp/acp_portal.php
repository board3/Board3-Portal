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
		global $config, $portal_config, $phpbb_root_path, $portal_root_path, $phpbb_admin_path, $phpEx;
		$portal_root_path = PORTAL_ROOT_PATH;
		if (!function_exists('column_string_const'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_modules.' . $phpEx);
		}

		if (!function_exists('obtain_portal_config'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
		}
		$portal_config = obtain_portal_config();
		/*
		if (!function_exists('mod_version_check'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_version_check.' . $phpEx);
		}
		mod_version_check();*/

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
						'legend1'					=> 'ACP_PORTAL_GENERAL_INFO',
						'portal_enable'				=> array('lang' => 'PORTAL_ENABLE',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_left_column'		=> array('lang' => 'PORTAL_LEFT_COLUMN',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_right_column'		=> array('lang' => 'PORTAL_RIGHT_COLUMN',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_version_check'		=> array('lang' => 'PORTAL_VERSION_CHECK',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_forum_index'		=> array('lang' => 'PORTAL_FORUM_INDEX',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),

						'legend2'					=> 'ACP_PORTAL_COLUMN_WIDTH_SETTINGS',
						'portal_left_column_width'	=> array('lang' => 'PORTAL_LEFT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_right_column_width'	=> array('lang' => 'PORTAL_RIGHT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
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
						$display_vars = $c_class->get_template_acp($module_id);
						$template->assign_vars(array(
							'MODULE_NAME'			=> $module_data['module_name'],
							'MODULE_IMAGE'			=> $module_data['module_image_src'],
							'MODULE_IMAGE_SRC'		=> ($module_data['module_image_src']) ? $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $module_data['module_image_src'] : '',
						));
						
						$template->assign_var('SHOW_MODULE_OPTIONS', true);
					}
				}

				$this->new_config = $portal_config;
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
					if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
					{
						continue;
					}

					$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

					if ($submit)
					{
						set_portal_config($config_name, $config_value);
					}
				}

				if ($submit)
				{
					$sql_ary = array(
						'module_image_src'	=> request_var('module_image', ''),
						'module_name'		=> request_var('module_name', '', true),
					);

					$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE module_id = ' . $module_id;
					$db->sql_query($sql);

					$cache->destroy('sql', CONFIG_TABLE);
					add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
					trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
				}

				$this->tpl_name = 'acp_portal_config';
				$this->page_title = $display_vars['title'];

				$template->assign_vars(array(
					'L_TITLE'			=> $user->lang[$display_vars['title']],
					'L_TITLE_EXPLAIN'	=> (isset($user->lang[$display_vars['title'] . '_EXPLAIN'])) ? $user->lang[$display_vars['title'] . '_EXPLAIN'] : '',

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
					//$this->new_config[$config_key] = $config[$config_key];
					$type = explode(':', $vars['type']);

					$l_explain = '';
					if ($vars['explain'])
					{
						$l_explain = (isset($user->lang[$vars['lang'] . '_EXP'])) ? $user->lang[$vars['lang'] . '_EXP'] : '';
					}

					$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

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

						trigger_error('SUCCESS');
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

						$c_class->install($db->sql_nextid());

						trigger_error('SUCCESS');
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
									$fileinfo[] = substr($class, 7, -7);
								}
							}
						}
					}
					closedir($dh);

					ksort($fileinfo);
					$options = '';

					foreach ($fileinfo as $module)
					{
						$options .= '<option value="' . $module . '">' . $module . '</option>';
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

							'U_DELETE'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=delete',
							'U_EDIT'			=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $row['module_id']),
							'U_MOVE_UP'			=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_up',
							'U_MOVE_DOWN'		=> $this->u_action . '&amp;module_id=' . $row['module_id'] . '&amp;action=move_down',
						));
					}
					$db->sql_freeresult($result);
				}

				$this->tpl_name = 'acp_portal_modules';
				$this->page_title = 'ACP_PORTAL_MODULES';
			break;
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}
	}
}
?>