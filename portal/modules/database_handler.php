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
}
