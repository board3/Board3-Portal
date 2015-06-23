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
		global $cache, $phpbb_root_path, $phpEx, $phpbb_dispatcher, $request, $user;

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
		\set_config('foobar', false, false, self::$config);
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
		set_portal_config('board3_calendar_events_5', '[{"title":"foobar","desc":" ","start_time":' . (time() - 3600) . ',"end_time":"","all_day":true,"permission":"","url":" "},{"title":"foobar","desc":" ","start_time":' . (time() + 90000) . ',"end_time":"","all_day":true,"permission":"","url":" "}]');
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));

		self::$config->set('board3_sunday_first_5', true);
		$this->request->overwrite('m5', 1);
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));

		$this->request->overwrite('m5', -1);
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));

		self::$config->set('board3_display_events_5', true);
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));
		$this->assertSame(1, sizeof($this->template->get_row('minical.cur_events')));
		$this->assertSame(1, sizeof($this->template->get_row('minical.upcoming_events')));

		set_portal_config('board3_calendar_events_5', '[{"title":"foobar","desc":" ","start_time":' . (time() - 10800) . ',"end_time":"","all_day":true,"permission":"","url":"http://example.com"},{"title":"foobar","desc":" ","start_time":' . (time() + 108000) . ',"end_time":"","all_day":true,"permission":"","url":"' . generate_board_url() . '"},{"title":"foobar3","desc":" ","start_time":' . (time() - 90000) . ',"end_time":' . (time() + 90000) . ',"all_day":false,"permission":"","url":" "}]');
		$this->template->delete_var('minical.cur_events');
		$this->template->delete_var('minical.upcoming_events');
		$this->assertSame('calendar_side.html', $this->calendar->get_template_side(5));
		$this->assertSame(2, sizeof($this->template->get_row('minical.cur_events')));
		$this->assertSame(1, sizeof($this->template->get_row('minical.upcoming_events')));
	}

	public function test_get_template_acp()
	{
		$acp_template = $this->calendar->get_template_acp(5);
		$this->assertArrayHasKey('title', $acp_template);
		$this->assertArrayHasKey('vars', $acp_template);
		$this->assertArrayHasKey('board3_display_events_5', $acp_template['vars']);
	}

	public function test_update_events_no_error()
	{
		$this->calendar->update_events('foobar', 5);
	}

	public function data_update_events()
	{
		return array(
			array(
				array(
					'event_start_date'		=> date('d.m.Y G:i', time() + 3600 * 3),
					'event_all_day'			=> true,
					'event_title'			=> 'foobar',
					'id'					=> 0,
				),
				array(
					'save'					=> true,
				),
				E_USER_NOTICE,
				'<br /><br /><a href="index.php?i=-board3-portal-acp-portal_module&amp;mode=config&amp;module_id=5">&laquo; Back to previous page</a>',
				'[{"title":"foobar","desc":" ","start_time":' . (time() + 3600) . ',"end_time":"","all_day":true,"permission":"","url":" "}]',
				true,
			),
			// Form key invalid
			array(
				array(),
				array(
					'save'					=> true,
				),
				E_USER_WARNING,
				'',
				'',
				false,
			),
			// Wrong start time
			array(
				array(),
				array(
					'save'					=> true,
				),
				E_USER_WARNING,
				'',
				'',
				true,
			),
			// Wrong end time
			array(
				array(
					'event_start_date'		=> '15.06.2035 13:00',
				),
				array(
					'save'					=> true,
				),
				E_USER_WARNING,
				'',
				'',
				true,
			),
			// End time in past
			array(
				array(
					'event_start_date'		=> '15.06.2035 13:00',
					'event_end_date'		=> '15.06.2005 19:00',
				),
				array(
					'save'					=> true,
				),
				E_USER_WARNING,
				'',
				'',
				true,
			),
			// End time before start
			array(
				array(
					'event_start_date'		=> '15.06.2035 13:00',
					'event_end_date'		=> '15.06.2035 12:00',
				),
				array(
					'save'					=> true,
				),
				E_USER_WARNING,
				'',
				'',
				true,
			),
			// No event title
			array(
				array(
					'event_start_date'		=> date('d.m.Y G:i', time() + 3600 * 3),
					'event_all_day'			=> true,
				),
				array(
					'save'					=> true,
				),
				E_USER_WARNING,
				'',
				'[{"title":"foobar","desc":" ","start_time":' . (time() + 3600) . ',"end_time":"","all_day":true,"permission":"","url":" "}]',
				true,
			),
			// Create valid event
			array(
				array(
					'event_start_date'		=> date('d.m.Y G:i', time() + 3600 * 3),
					'event_all_day'			=> true,
					'event_title'			=> 'foobar',
				),
				array(
					'save'					=> true,
				),
				E_USER_NOTICE,
				'<br /><br /><a href="index.php?i=-board3-portal-acp-portal_module&amp;mode=config&amp;module_id=5">&laquo; Back to previous page</a>',
				'[{"title":"foobar","desc":" ","start_time":' . (time() + 3600) . ',"end_time":"","all_day":true,"permission":"","url":" "}]',
				true,
			),
			// Display existing events
			array(
				array(),
				array(),
				false,
				'',
				'board3_calendar_events_5'	=> '[{"title":"foobar","desc":" ","start_time":2065518000,"end_time":"","all_day":true,"permission":"","url":" "}]',
				false,
			),
			// Edit event
			array(
				array(
					'id'					=> 0,
					'action'					=> 'edit',
				),
				array(),
				false,
				'',
				'[{"title":"foobar","desc":" ","start_time":' . (time() + 3600) . ',"end_time":"","all_day":true,"permission":"","url":" "}]',
				true,
			),
		);
	}

	/**
	 * @dataProvider data_update_events
	 */
	public function test_update_events($get_variables, $post_variables, $expected_error = E_USER_WARNING, $expected_error_message = '', $portal_config = array(), $form_key_valid = false)
	{
		check_form_key::$form_key_valid = $form_key_valid;

		foreach ($get_variables as $key => $value)
		{
			$this->request->overwrite($key, $value);
		}

		foreach ($post_variables as $key => $value)
		{
			$this->request->overwrite($key, $value, \phpbb\request\request_interface::POST);
		}

		set_portal_config('board3_calendar_events_5', $portal_config);

		if ($expected_error !== false)
		{
			if (!empty($expected_error_message))
			{
				$this->setExpectedTriggerError($expected_error, $expected_error_message);
			}
			else
			{
				$this->setExpectedTriggerError($expected_error);
			}
		}

		$this->calendar->update_events('foobar', 5);
	}
}

function set_config($config_name, $config_value, $is_dynamic = false)
{
	phpbb_unit_modules_calendar_test::$config->set($config_name, $config_value, !$is_dynamic);
}
