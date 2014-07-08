<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

require_once(dirname(__FILE__) . '/../../../includes/functions.php');

class phpbb_unit_modules_calendar_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $path_helper;
	protected $calendar;
	static $config;

	protected $expected_config = array();
	protected $expected_portal_config = array();

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/configs.xml');
	}

	public function setUp()
	{
		parent::setUp();
		global $cache, $phpbb_root_path;

		$this->path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			new \phpbb_mock_request(),
			$phpbb_root_path,
			'php'
		);
		self::$config = new \phpbb\config\config(array());
		$this->calendar = new \board3\portal\modules\calendar(array(), null, null, null, dirname(__FILE__) . '/../../../', 'php', null, $this->path_helper);
		define('PORTAL_MODULES_TABLE', 'phpbb_portal_modules');
		define('PORTAL_CONFIG_TABLE', 'phpbb_portal_config');
		$cache = $this->getMock('\phpbb\cache\cache', array('destroy', 'sql_exists', 'get', 'put'));
		$cache->expects($this->any())
			->method('destroy')
			->with($this->equalTo('portal_config'));
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
	}

	public function data_date_to_time()
	{
		return array(
			array(strtotime('2014-06-15 18:00'), '2014-06-15 18:00'),
			array(strtotime('2014-06-15 18:00'), '15.06.2014 18:00'),
			array(strtotime('2014-06-15 18:00'), '06/15/2014 6:00 PM'),
			array(false, '15/06'),
		);
	}

	/**
	* @dataProvider data_date_to_time
	*/
	public function test_date_to_time($expected, $date)
	{
		$this->assertEquals($expected, $this->calendar->date_to_time($date));
	}

	public function test_install()
	{
		$this->assertTrue($this->calendar->install(1));

		foreach (self::$config as $key => $value)
		{
			$this->expected_config[$key] = $value;
		}
		
		$portal_config = obtain_portal_config();

		foreach ($portal_config as $key => $value)
		{
			$this->expected_portal_config[$key] = $value;
		}
	}

	/**
	* @dependsOn test_install
	*/
	public function test_uninstall()
	{
		$this->assertNotEmpty($this->calendar->uninstall(1, $this->db));

		foreach ($this->expected_config as $key => $value)
		{
			$this->assertFalse(isset(self::$config[$key]));
		}

		$portal_config = obtain_portal_config();

		foreach ($this->expected_config as $key => $value)
		{
			$this->assertFalse(isset($portal_config[$key]));
		}
	}
}

function set_config($config_name, $config_value, $is_dynamic = false)
{
	phpbb_unit_modules_calendar_test::$config->set($config_name, $config_value, !$is_dynamic);
}
