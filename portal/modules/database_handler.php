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
			'module_status'		=> B3_MODULE_ENABLED,
		);
		$sql = 'UPDATE ' . PORTAL_MODULES_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE module_id = ' . (int) $module_id;
		$this->db->sql_query($sql);

		return $this->db->sql_affectedrows();
	}
}
