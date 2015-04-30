<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\migrations;

class v210_rc1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\board3\portal\migrations\v210_beta1');
	}

	public function update_data()
	{
		return array(
			array('config.remove', array('board3_phpbb_menu')),
			array('config.update', array('board3_portal_version', '2.1.0-rc1')),
			array('custom', array(array($this, 'add_clock_setting'))),
		);
	}

	/**
	 * Adds clock settings to already installed clock modules
	 */
	public function add_clock_setting()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "portal_modules
			WHERE module_classname = '\\\board3\\\portal\\\modules\\\clock'";
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->config->set('board3_clock_src_' . $row['module_id'], '');
		}
		$this->db->sql_freeresult($result);
	}
}
