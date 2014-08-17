<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../includes/functions.php');

class phpbb_unit_functions_get_user_groups_test extends \board3\portal\tests\testframework\database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/user_groups.xml');
	}

	public function setUp()
	{
		global $cache, $user;

		parent::setUp();

		$user = $this->getMock('\phpbb\user', array('optionget'), array('\phpbb\datetime'));
		$cache = $this->getMock('\phpbb\cache\cache', array('get', 'put', 'sql_exists'));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
	}

	public function data_get_user_groups()
	{
		return array(
			array(array(1, 2, 3), 2),
			array(array(5), 3),
		);
	}

	/**
	* @dataProvider data_get_user_groups
	*/
	public function test_get_user_groups($expected, $user_id)
	{
		global $user;

		$user->data['user_id'] = $user_id;
		$this->assertEquals($expected, get_user_groups());
	}
}
