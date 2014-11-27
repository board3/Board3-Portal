<?php
/**
 *
 * @package Board3 Portal v2.1
 * @copyright (c) 2014 Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\portal\modules;

use board3\portal\includes\helper;
use board3\portal\portal\columns;
use phpbb\cache\service;
use phpbb\db\driver\driver_interface;
use phpbb\request\request_interface;
use phpbb\user;

class manager
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \board3\portal\portal\columns */
	protected $portal_columns;

	/** @var \board3\portal\includes\helper */
	protected $portal_helper;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \board3\portal\modules\module_interface */
	protected $module;

	/** @var string u_action of acp module */
	protected $u_action;

	/** @var string class of acp module */
	protected $acp_class;

	/** @var array Array of module columns */
	public $module_column = array();

	/**
	 * Constructor for modules manager
	 *
	 * @param \phpbb\cache\service $cache phpBB cache
	 * @param \phpbb\db\driver\driver_interface $db Database driver
	 * @param \board3\portal\portal\columns $portal_columns Portal columns helper
	 * @param \board3\portal\includes\helper $portal_helper Portal helper
	 * @param \phpbb\request\request_interface $request phpBB request
	 * @param \phpbb\user $user phpBB user
	 */
	public function __construct($cache, driver_interface $db, columns $portal_columns, helper $portal_helper, request_interface $request, $user)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->portal_columns = $portal_columns;
		$this->portal_helper = $portal_helper;
		$this->request = $request;
		$this->user = $user;
	}

	/**
	 * Set u_action for module
	 *
	 * @param string $u_action u_action for module
	 *
	 * @return \board3\portal\portal\modules\manager This class
	 */
	public function set_u_action($u_action)
	{
		$this->u_action = $u_action;

		return $this;
	}

	/**
	 * Set acp module class
	 *
	 * @param string $acp_class ACP module class
	 *
	 * @return \board3\portal\portal\modules\manager This class
	 */
	public function set_acp_class($acp_class)
	{
		$this->acp_class = $acp_class;

		return $this;
	}

	/**
	 * Get module object
	 *
	 * @param string $class_name Module class name
	 * @return null
	 */
	protected function get_module($class_name)
	{
		if (($this->module = $this->portal_helper->get_module($class_name)) === false)
		{
			trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
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
	public function reset_module($id, $mode, $module_id, $module_data)
	{
		if (confirm_box(true))
		{
			$module_data = $this->get_move_module_data($module_id);

			$this->get_module($module_data['module_classname']);

			$sql_ary = array(
				'module_name'		=> $this->module->get_name(),
				'module_image_src'	=> $this->module->get_image(),
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
			$this->module->install($module_id);
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
		$sql = 'SELECT *
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

		$this->get_module($module_data['module_classname']);

		$move_action = 0;

		if ($module_data !== false && $module_data['module_column'] > $this->portal_columns->string_to_number('left'))
		{
			if($this->module->columns & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($module_data['module_column'] - 1)))
			{
				$move_action = 1; // we move 1 column to the left
			}
			else if($this->module->columns & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($module_data['module_column'] - 2)) && $module_data['module_column'] != 2)
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
				$column_string = $this->portal_columns->number_to_string($module_data['module_column'] - $move_action);
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

		$this->get_module($module_data['module_classname']);

		$move_action = 0;

		if ($module_data !== false && $module_data['module_column'] < $this->portal_columns->string_to_number('right'))
		{
			if($this->module->columns & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($module_data['module_column'] + 1)))
			{
				$move_action = 1; // we move 1 column to the right
			}
			else if($this->module->columns & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($module_data['module_column'] + 2)) && $module_data['module_column'] != 2)
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
				$column_string = $this->portal_columns->number_to_string($module_data['module_column'] + $move_action);

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
	public function module_delete($id, $mode, $action, $module_id)
	{
		$module_data = $this->get_move_module_data($module_id);

		if ($module_data !== false)
		{
			$module_classname = $this->request->variable('module_classname', '');

			$this->get_module($module_data['module_classname']);

			if (confirm_box(true))
			{
				$this->module->uninstall($module_data['module_id'], $this->db);

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
				if ($this->module->get_language())
				{
					$this->user->add_lang_ext('board3/portal', 'modules/' . $this->module->get_language());
				}
				$confirm_text = (isset($this->user->lang[$module_data['module_name']])) ? sprintf($this->user->lang['DELETE_MODULE_CONFIRM'], $this->user->lang[$module_data['module_name']]) : sprintf($this->user->lang['DELETE_MODULE_CONFIRM'], utf8_normalize_nfc($module_data['module_name']));
				confirm_box(false, $confirm_text, build_hidden_fields(array(
					'i'					=> $id,
					'mode'				=> $mode,
					'action'			=> $action,
					'module_id'			=> $module_id,
					'module_classname'	=> $module_classname,
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
	public function get_module_link($mode, $module_id)
	{
		return preg_replace(array('/i=[0-9]+/', '/mode=[a-zA-Z0-9_]+/'), array('i=%5C' . str_replace('\\', '%5C', $this->acp_class), 'mode=' . $mode), $this->u_action) . (($module_id) ? '&amp;module_id=' . $module_id : '');
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