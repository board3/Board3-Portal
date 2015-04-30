<?php
/**
 *
 * @package Board3 Portal v2.1
 * @copyright (c) 2014 Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\portal\modules;

use board3\portal\portal\columns;

class constraints_handler
{
	/** @var \board3\portal\portal\columns */
	protected $portal_columns;

	/** @var \phpbb\user */
	protected $user;

	/** @var string Form action (link) */
	protected $u_action;

	/** @var array Array with info about modules and their columns */
	public $module_column = array();

	/**
	 * Constructor for constraints handler
	 *
	 * @param columns $portal_columns Portal columns
	 * @param \phpbb\user $user phpBB user object
	 */
	public function __construct(columns $portal_columns, $user)
	{
		$this->portal_columns = $portal_columns;
		$this->user = $user;
	}

	/**
	 * Set u_action for module
	 *
	 * @param string $u_action u_action for module
	 */
	public function set_u_action($u_action)
	{
		$this->u_action = $u_action;
	}

	/**
	 * Set module columns info
	 *
	 * @param array $module_column Array with info about modules and their columns
	 */
	public function set_module_column($module_column = array())
	{
		$this->module_column = $module_column;
	}

	/**
	 * Check if there is conflict between the move action and existing modules
	 *
	 * @param array $module_data The module's data
	 * @param int $move_action The move action
	 *
	 * @return null
	 */
	public function check_module_conflict($module_data, &$move_action)
	{
		/**
		 * Moving only 1 column means we will either end up in a side column
		 * or in the center column. This is not possible when moving 2 columns.
		 * Therefore we only need to check if we won't end up with a duplicate
		 * module in the new column (side columns (left & right) or center
		 * columns (top, center, bottom)). Of course this does not apply to
		 * custom modules.
		 */
		if ($module_data['module_classname'] != '\board3\portal\modules\custom' && abs($move_action) == 1)
		{
			$column_string = $this->portal_columns->number_to_string($module_data['module_column'] + $move_action);

			// we can only move horizontally to center or side columns
			if (in_array($column_string, array('right', 'left')) && !$this->can_move_module(array('right', 'left'), $module_data['module_classname']))
			{
				trigger_error($this->user->lang['UNABLE_TO_MOVE'] . adm_back_link($this->u_action));
			}
			else if ($column_string == 'center' && !$this->can_move_module(array('top', 'center', 'bottom'), $module_data['module_classname']))
			{
				// we are moving from the right to the center column so we should move to the left column instead
				$move_action = 2 * $move_action;
			}
		}
	}

	/**
	 * Check if module can be moved horizontally
	 *
	 * @param array $module_data Module's module data
	 * @param int $direction Direction to move the module
	 *
	 * @return bool True if module can be moved, false if not
	 */
	public function can_move_horizontally($module_data, $direction)
	{
		if (isset($module_data['module_column']))
		{
			return ($direction === database_handler::MOVE_DIRECTION_RIGHT) ? $module_data['module_column'] < $this->portal_columns->string_to_number('right') : $module_data['module_column'] > $this->portal_columns->string_to_number('left');
		}
		else
		{
			return false;
		}
	}

	/**
	 * Check if module can be moved to desired column(s)
	 *
	 * @param array|string	$target_column Column(s) the module should be moved to
	 * @param string		$module_class Class of the module
	 * @return bool		True if module can be moved to desired column,
	 *			false if not
	 */
	public function can_move_module($target_column, $module_class)
	{
		if (is_array($target_column))
		{
			foreach ($target_column as $column)
			{
				if (!$this->can_move_module($column, $module_class))
				{
					return false;
				}
			}

			return true;
		}

		// Check if module already exists in the target columns
		return $this->check_module_already_exists($target_column, $module_class);
	}

	/**
	 * Check if module can be moved to desired column
	 *
	 * @param \board3\portal\modules\module_interface $module
	 * @param string $column Column string
	 *
	 * @return bool True if module can be moved, false if not
	 */
	public function can_add_module($module, $column)
	{
		return (bool) ($module->get_allowed_columns() & $this->portal_columns->string_to_constant($this->portal_columns->number_to_string($column)));
	}

	/**
	 * Check if module already exists in specified target column type
	 *
	 * @param string $column Column to check
	 * @param string $module_class Module class
	 *
	 * @return bool False if it already exists, true if not
	 */
	public function check_module_already_exists($column, $module_class)
	{
		if (isset($this->module_column[$module_class]))
		{
			// does the module already exist in the side columns?
			if (in_array($column, array('left', 'right')) &&
				(in_array('left', $this->module_column[$module_class]) || in_array('right', $this->module_column[$module_class])))
			{
				return false;
			}
			// does the module already exist in the center columns?
			else if (in_array($column, array('center', 'top', 'bottom')) &&
				(in_array('center', $this->module_column[$module_class]) || in_array('top', $this->module_column[$module_class]) || in_array('bottom', $this->module_column[$module_class])))
			{
				return false;
			}
		}

		return true;
	}
}
