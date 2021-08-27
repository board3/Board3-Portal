<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

class phpbb_unit_functions_get_user_groups_test extends \board3\portal\tests\testframework\database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/user_groups.xml');
	}

	public function setUp(): void
	{
		global $cache, $user, $phpbb_root_path;

		parent::setUp();

		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);
		$user = $this->getMock('\phpbb\user', array('optionget'), array($this->language, '\phpbb\datetime'));
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
