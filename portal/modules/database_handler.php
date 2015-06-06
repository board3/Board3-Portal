<?php
/**
 *
 * @package Board3 Portal v2.1
 * @copyright (c) 2014 Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\portal\modules;

use phpbb\db\driver\driver_interface;

class database_handler
{
	/** @var int Move direction up */
	const MOVE_DIRECTION_UP = -1;

	/** @var int Move driection down */
	const MOVE_DIRECTION_DOWN = 1;

	/** @var int Move direction right */
	const MOVE_DIRECTION_RIGHT = 1;

	/** @var int Move direction left */
	const MOVE_DIRECTION_LEFT = -1;

	/** @var int Board3 module enabled */
	const B3_MODULE_ENABLED = 1;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/**
	 * Constructor for modules manager
	 *
	 * @param \phpbb\db\driver\driver_interface $db Database driver
	 */
	public function __construct(driver_interface $db)
	{
		$this->db = $db;
	}

	/**
	 * Get module data from database
	 *
	 * @param int $module_id Module ID
	 * @return array Module data array
	 */
	public function get_module_data($module_id)
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
	 * Run database part for resetting a module
	 *
	 * @param \board3\portal\modules\module_interface $module Module to reset
	 * @param int $module_id Module ID of module
	 *
	 * @return int Number of affected rows
	 */
	public function reset_module($module, $module_id)
	{
		$sql_ary = array(
			'module_name'		=> $module->get_name(),
			'module_image_src'	=> $module->get_image(),
			'module_group_ids'	=> '',
			'module_image_height'	=> 16,
			'module_image_width'	=> 16,
			'module_status'		=> self::B3_MODULE_ENABLED,
		);
		$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE module_id = ' . (int) $module_id;
		$this->db->sql_query($sql);

		return $this->db->sql_affectedrows();
	}

	/**
	 * Move module vertically
	 *
	 * @param int $module_id Module ID
	 * @param array $module_data Module data array
	 * @param int $direction Direction to move, see constants in this class
	 * @param int $step Moving step
	 *
	 * @return int Number of affected rows, 0 if unsuccessful
	 */
	public function move_module_vertical($module_id, $module_data, $direction, $step = 1)
	{
		$direction = (int) $direction;
		$step = (int) $step;

		if ($direction == self::MOVE_DIRECTION_DOWN)
		{
			$current_increment = ' + ' . $step;
			$other_increment = ' - ' . $step;
		}
		else
		{
			$current_increment = ' - ' . $step;
			$other_increment = ' + ' . $step;
		}

		$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order' . $other_increment . '
				WHERE module_order = ' . ($module_data['module_order'] + ($direction * $step)) . '
					AND module_column = ' . (int) $module_data['module_column'];
		$this->db->sql_query($sql);
		$updated = (bool) $this->db->sql_affectedrows();
		if ($updated)
		{
			$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET module_order = module_order' . $current_increment . '
					WHERE module_id = ' . (int) $module_id;
			$this->db->sql_query($sql);
		}

		return $updated;
	}

	/**
	 * Move module horizontally
	 *
	 * @param int $module_id Module ID
	 * @param array $module_data Module data array
	 * @param int $move_action The move action
	 */
	public function move_module_horizontal($module_id, $module_data, $move_action)
	{
		$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order + 1
				WHERE module_order >= ' . (int) $module_data['module_order'] . '
					AND module_column = ' . (int) ($module_data['module_column'] + $move_action);
		$this->db->sql_query($sql);
		$updated = $this->db->sql_affectedrows();

		$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_column = ' . (int) ($module_data['module_column'] + $move_action) . '
				WHERE module_id = ' . (int) $module_id;
		$this->db->sql_query($sql);

		$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
				SET module_order = module_order - 1
				WHERE module_order >= ' . (int) $module_data['module_order'] . '
				AND module_column = ' . (int) $module_data['module_column'];
		$this->db->sql_query($sql);

		// the module that needs to moved is in the last row
		if (!$updated)
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
}
