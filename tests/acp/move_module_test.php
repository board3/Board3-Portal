<?php
/**
*
* @package testing
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\acp;

require_once(dirname(__FILE__) . '/../../includes/functions.php');
require_once(dirname(__FILE__) . '/../../acp/portal_module.php');

class phpbb_acp_move_module_test extends \board3\portal\tests\testframework\database_test_case
{
	static public $redirected = false;

	public function setUp()
	{
		parent::setUp();
		global $db, $cache, $phpbb_root_path, $phpEx, $user, $phpbb_container, $template;
		$user = new \board3\portal\tests\mock\user();
		$phpbb_container = new \phpbb_mock_container_builder();
		// Mock version check
		$phpbb_container->set('board3.version.check',
			$this->getMockBuilder('\board3\portal\includes\mod_version_check')
				->disableOriginalConstructor()
				->getMock());
		// Mock module service collection
		$phpbb_container->set('board3.module_collection',
			array(
				new \board3\portal\modules\clock(),
				new \board3\portal\modules\birthday_list(new \phpbb\config\config(array()), $template, $this->db, $user),
			));
		$cache = $this->getMock('\phpbb\cache\cache', array('destroy', 'sql_exists', 'get', 'put'));
		$cache->expects($this->any())
			->method('destroy')
			->with($this->equalTo('portal_modules'));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
		$cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything());
		$cache->expects($this->any())
			->method('put')
			->with($this->anything());
		$db = $this->db;
		$user->set(array(
			'UNABLE_TO_MOVE'	=> 'UNABLE_TO_MOVE',
			'UNABLE_TO_MOVE_ROW'	=> 'UNABLE_TO_MOVE_ROW',
		));
		$this->portal_module = new \board3\portal\acp\portal_module();
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/modules.xml');
	}

	public function test_get_move_module_data()
	{
		$module_data = $this->portal_module->get_move_module_data(1);
		$this->assertEquals(array(
			'module_order'		=> 1,
			'module_column'		=> 2,
			'module_classname'	=> '\board3\portal\modules\clock',
		), $module_data);
	}

	public function data_get_last_module_order()
	{
		return array(
			array(1, 1),
			array(2, 2),
			array(2, 4),
		);
	}

	/**
	* @dataProvider data_get_last_module_order
	*/
	public function test_get_last_module_order($expected, $column)
	{
		$this->assertEquals($expected, $this->portal_module->get_last_module_order($column));
	}

	public function test_move_module_up()
	{
		self::$redirected = false;
		$this->portal_module->move_module_up(2);
		$this->assertTrue(self::$redirected);

		$this->setExpectedTriggerError(E_USER_NOTICE, 'UNABLE_TO_MOVE_ROW');
		self::$redirected = false;
		$this->portal_module->move_module_up(2);
		$this->assertFalse(self::$redirected);
	}

	public function test_move_module_down()
	{
		self::$redirected = false;
		$this->portal_module->move_module_down(1);
		$this->assertTrue(self::$redirected);

		$this->setExpectedTriggerError(E_USER_NOTICE, 'UNABLE_TO_MOVE_ROW');
		self::$redirected = false;
		$this->portal_module->move_module_down(1);
		$this->assertFalse(self::$redirected);
	}

	public function data_handle_after_move()
	{
		return array(
			array(true, false, false),
			array(false, false, 'UNABLE_TO_MOVE'),
			array(false, true, 'UNABLE_TO_MOVE_ROW'),
		);
	}

	/**
	* @dataProvider data_handle_after_move
	*/
	public function test_handle_after_move($success, $is_row, $error)
	{
		if ($error)
		{
			$this->setExpectedTriggerError(E_USER_NOTICE, $error);
		}
		else
		{
			self::$redirected = false;
		}

		$this->portal_module->handle_after_move($success, $is_row);

		if (!$error)
		{
			$this->assertTrue(self::$redirected);
		}
	}
}

function redirect($url)
{
	phpbb_acp_move_module_test::$redirected = true;
}

function adm_back_link($url)
{
	return $url;
}
