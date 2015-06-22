<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

require_once dirname(__FILE__) . '/../../mock/check_form_key.php';

class phpbb_unit_modules_calendar_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $path_helper;

	static $config;

	protected $expected_config = array();
	protected $expected_portal_config = array();

	/** @var \board3\portal\modules\calendar */
	protected $calendar;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \board3\portal\tests\mock\template */
	protected $template;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/configs.xml');
	}

	public function setUp()
	{
		parent::setUp();
		global $cache, $phpbb_root_path, $phpEx, $phpbb_dispatcher, $request;

		$this->path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			new \phpbb_mock_request(),
			$phpbb_root_path,
			'php'
		);
		$db = $this->new_dbal();
		$phpbb_dispatcher = $this->getMockBuilder('\phpbb\event\dispatcher')
			->disableOriginalConstructor()
			->getMock();
		$phpbb_dispatcher->expects($this->any())
			->method('trigger_event')
			->with($this->anything())
			->will($this->returnArgument(1));
		self::$config = new \phpbb\config\config(array());
		$this->template = new \board3\portal\tests\mock\template($this);
		$controller_helper = new \board3\portal\tests\mock\controller_helper($phpbb_root_path, $phpEx);
		$controller_helper->add_route('board3_portal_controller', 'portal');
		$modules_helper = new \board3\portal\includes\modules_helper(new \phpbb\auth\auth(), new \phpbb\config\config(array()), $controller_helper, new \phpbb_mock_request());
		$request = $this->request = new \phpbb_mock_request();
		$user = new \phpbb\user('\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->add_lang('common');
		$log = $this->getMockBuilder('\phpbb\log')
			->setMethods(array('add'))
			->disableOriginalConstructor()
			->getMock();
		$log->expects($this->any())
			->method('add')
			->with($this->anything())
			->will($this->returnValue(true));
		$this->calendar = new \board3\portal\modules\calendar(self::$config, $modules_helper, $this->template, $db, $this->request, dirname(__FILE__) . '/../../../', 'php', $user, $this->path_helper, $log);
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

	public function test_get_template_side()
	{
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));
		self::$config->set('board3_sunday_first_5', true);
		$this->request->overwrite('m5', 1);
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));
		$this->request->overwrite('m5', -1);
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));
	}

	public function test_update_events_no_error()
	{
		$this->calendar->update_events('foobar', 5);
	}

	public function test_update_events_form_key_fail()
	{
		// Save event
		check_form_key::$form_key_valid = false;
		$this->request->overwrite('save', true, \phpbb\request\request_interface::POST);
		$this->setExpectedTriggerError(E_USER_WARNING);
		$this->calendar->update_events('foobar', 5);
	}

	public function test_update_events_wrong_start_time()
	{
		// Save event
		check_form_key::$form_key_valid = true;
		$this->request->overwrite('save', true, \phpbb\request\request_interface::POST);
		$this->setExpectedTriggerError(E_USER_WARNING);
		$this->calendar->update_events('foobar', 5);
	}

	public function test_update_events_wrong_end_time()
	{
		// Save event
		check_form_key::$form_key_valid = true;
		$this->request->overwrite('event_start_date', '15.06.2035 13:00');
		$this->request->overwrite('save', true, \phpbb\request\request_interface::POST);
		$this->setExpectedTriggerError(E_USER_WARNING);
		$this->calendar->update_events('foobar', 5);
	}

	public function test_update_events_all_day()
	{
		// Save event
		check_form_key::$form_key_valid = true;
		$this->request->overwrite('event_start_date', '15.06.2035 13:00');
		$this->request->overwrite('event_all_day', true);
		$this->request->overwrite('event_title', 'foobar');
		$this->request->overwrite('save', true, \phpbb\request\request_interface::POST);
		$this->setExpectedTriggerError(E_USER_NOTICE, '<br /><br /><a href="index.php?i=-board3-portal-acp-portal_module&amp;mode=config&amp;module_id=5">&laquo; </a>');
		$this->calendar->update_events('foobar', 5);
	}

	public function test_display_events()
	{
		set_portal_config('board3_calendar_events_5', '[{"title":"foobar","desc":" ","start_time":2065518000,"end_time":"","all_day":true,"permission":"","url":" "}]');
		check_form_key::$form_key_valid = false;
		$this->calendar->manage_events('', 'foobar', 5);
	}
}

function set_config($config_name, $config_value, $is_dynamic = false)
{
	phpbb_unit_modules_calendar_test::$config->set($config_name, $config_value, !$is_dynamic);
}
