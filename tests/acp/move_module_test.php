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
		$cache = $this->getMock('\phpbb\cache\cache', array('destroy', 'sql_exists'));
		$cache->expects($this->any())
			->method('destroy')
			->with($this->equalTo('portal_modules'));
		$cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything());
		$db = $this->db;
		$this->portal_module = new \board3\portal\acp\portal_module();
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/modules.xml');
	}

	public function test_move_module_up()
	{
		self::$redirected = false;
		$this->portal_module->move_module_up(2);
		$this->assertTrue(self::$redirected);

		$this->setExpectedTriggerError(E_USER_NOTICE);
		self::$redirected = false;
		$this->portal_module->move_module_up(2);
		$this->assertFalse(self::$redirected);
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
