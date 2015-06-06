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
use board3\portal\modules\module_interface;
use board3\portal\portal\columns;
use phpbb\db\driver\driver_interface;
use phpbb\request\request_interface;

class manager
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \board3\portal\controller\helper */
	protected $controller_helper;

	/** @var \board3\portal\portal\columns */
	protected $portal_columns;

	/** @var \board3\portal\includes\helper */
	protected $portal_helper;

	/** @var \board3\portal\portal\modules\constraints_handler */
	protected $constraints_handler;

	/** @var \board3\portal\portal\modules\database_handler */
	protected $database_handler;

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

	/**
	 * Constructor for modules manager
	 *
	 * @param \phpbb\cache\service $cache phpBB cache
	 * @param \phpbb\db\driver\driver_interface $db Database driver
	 * @param \board3\portal\controller\helper $controller_helper Board3 Portal controller helper
	 * @param \board3\portal\portal\columns $portal_columns Portal columns helper
	 * @param \board3\portal\includes\helper $portal_helper Portal helper
	 * @param \board3\portal\portal\modules\constraints_handler $constraints_handler Modules constraints handler
	 * @param \board3\portal\portal\modules\database_handler $database_handler Modules database handler
	 * @param \phpbb\request\request_interface $request phpBB request
	 * @param \phpbb\user $user phpBB user
	 */
	public function __construct($cache, driver_interface $db, \board3\portal\controller\helper $controller_helper, columns $portal_columns, helper $portal_helper, constraints_handler $constraints_handler, database_handler $database_handler, request_interface $request, $user)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->controller_helper = $controller_helper;
		$this->portal_columns = $portal_columns;
		$this->portal_helper = $portal_helper;
		$this->constraints_handler = $constraints_handler;
		$this->database_handler = $database_handler;
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
		$this->constraints_handler->set_u_action($u_action);

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
		$module = $this->portal_helper->get_module($class_name);

		if (!$module instanceof module_interface)
		{
			trigger_error('CLASS_NOT_FOUND', E_USER_ERROR);
		}
		else
		{
			$this->module = $module;
		}

		unset($module);
	}

	/**
	 * Handle ajax request.
	 * Method will return supplied data if request is an ajax request
	 *
	 * @param array $data Data to send
	 *
	 * @return null
	 */
	public function handle_ajax_request($data)
	{
		if ($this->request->is_ajax())
		{
			$json_response = new \phpbb\json_response;
			$json_response->send($data);
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

			$affected_rows = $this->database_handler->reset_module($this->module, $module_id);

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
		return $this->database_handler->get_module_data($module_id);
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

		$this->cache->destroy('sql', PORTAL_MODULES_TABLE);

		// Handle ajax requests
		$this->handle_ajax_request(array('success' => true));

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
	 * Move module vertically
	 *
	 * @param int $module_id Module ID
	 * @param int $direction Direction of move, either -1 for up or 1 for down
	 */
	public function move_module_vertical($module_id, $direction)
	{
		$module_data = $this->get_move_module_data($module_id);

		if ($module_data === false || ($direction == database_handler::MOVE_DIRECTION_UP && $module_data['module_order'] <= 1) ||
			($direction == database_handler::MOVE_DIRECTION_DOWN && $this->get_last_module_order($module_data['module_column']) == $module_data['module_order']))
		{
			$this->handle_after_move(false, true);
		}
		else
		{
			$this->handle_after_move($this->database_handler->move_module_vertical($module_id, $module_data, $direction, 1), true);
		}
	}

	/**
	 * Move module horizontally
	 *
	 * @param int $module_id ID of the module that should be moved
	 * @param int $direction The direction to move the module
	 *
	 * @return null
	 */
	public function move_module_horizontal($module_id, $direction)
	{
		$module_data = $this->get_move_module_data($module_id);

		$this->get_module($module_data['module_classname']);

		$move_action = $this->get_horizontal_move_action($module_data, $direction);
		$this->constraints_handler->check_module_conflict($module_data, $move_action);

		$this->database_handler->move_module_horizontal($module_id, $module_data, $move_action);

		$this->handle_after_move(true);
	}

	/**
	 * Get the horizontal move action (columns to move)
	 *
	 * @param array $module_data Array containing the module data
	 * @param int $direction Direction to move; 1 for right, -1 for left
	 *
	 * @return int|null Move action if module can be moved, calls
	 *		handle_after_move() if it can't be moved
	 */
	public function get_horizontal_move_action($module_data, $direction)
	{
		if ($this->constraints_handler->can_move_horizontally($module_data, $direction))
		{
			if ($this->module->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($module_data['module_column'] + $direction)))
			{
				return $direction; // we move 1 column
			}
			else if ($this->module->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($module_data['module_column'] + $direction * 2)) && $module_data['module_column'] != $this->portal_columns->string_to_number('center'))
			{
				return 2 * $direction; // we move 2 columns
			}
		}

		$this->handle_after_move(false);
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
					WHERE module_column = ' . (int) $module_data['module_column'] . '
						AND module_order > ' . (int) $module_data['module_order'];
				$this->db->sql_query($sql);

				$this->cache->purge(); // make sure we don't get errors after re-adding a module

				// Handle ajax request
				$this->handle_ajax_request(array(
					'success' => true,
					'MESSAGE_TITLE'	=> $this->user->lang['INFORMATION'],
					'MESSAGE_TEXT'	=> $this->user->lang['SUCCESS_DELETE'],
				));

				trigger_error($this->user->lang['SUCCESS_DELETE'] . adm_back_link($this->u_action));
			}
			else
			{
				if ($this->module->get_language())
				{
					$this->controller_helper->load_module_language($this->module);
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

		$this->cache->destroy('sql', PORTAL_MODULES_TABLE);
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
		return preg_replace(array('/i=[0-9]+/', '/mode=[a-zA-Z0-9_]+/'), array('i=-' . str_replace('\\', '-', $this->acp_class), 'mode=' . $mode), $this->u_action) . (($module_id) ? '&amp;module_id=' . $module_id : '');
	}
}
