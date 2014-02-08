<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\systemtests;

class base_database_test extends \board3\portal\tests\testframework\database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/basetests.xml');
	}

	public function test_check()
	{
		$sql = 'SELECT module_id, module_column
			FROM phpbb_portal_modules
			WHERE module_id = 1';
		$result = $this->db->sql_query($sql);
		$this->assertEquals(array(
			array(
				'module_id'	=> 1,
				'module_column'		=> 2
			),
		), $this->db->sql_fetchrowset($result));
		$this->db->sql_freeresult($result);
	}
}
