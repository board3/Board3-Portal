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

class phpbb_unit_modules_announcements_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $path_helper;

	static $config;

	protected $expected_config = array();
	protected $expected_portal_config = array();

	/** @var \board3\portal\modules\announcements */
	protected $announcements;

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
		self::$config->delete('foobar');
		$this->template = new \board3\portal\tests\mock\template($this);
		$controller_helper = new \board3\portal\tests\mock\controller_helper($phpbb_root_path, $phpEx);
		$controller_helper->add_route('board3_portal_controller', 'portal');
		$this->auth = $this->getMock('\phpbb\auth\auth', array('acl_get'));
		$this->auth->expects($this->any())
			->method('acl_get')
			->with($this->anything())
			->will($this->returnValue(true));
		$pagination = $this->getMockBuilder('\phpbb\pagination')
			->disableOriginalConstructor()
			->setConstructorArgs(array($this->template, $user, $controller_helper, $phpbb_dispatcher))
			->getMock();
		$modules_helper = new \board3\portal\includes\modules_helper($this->auth, new \phpbb\config\config(array()), $controller_helper, new \phpbb_mock_request());
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
		$this->fetch_posts = new \board3\portal\portal\fetch_posts($this->auth, $cache, self::$config, $this->db, $modules_helper, $user);
		$this->announcements = new \board3\portal\modules\announcements($this->auth, $cache, self::$config, $this->template, $db, $pagination, $modules_helper, $this->request, 'php', dirname(__FILE__) . '/../../../', $user, $this->fetch_posts);
		define('PORTAL_MODULES_TABLE', 'phpbb_portal_modules');
		define('PORTAL_CONFIG_TABLE', 'phpbb_portal_config');
	}

	public function test_install_uninstall()
	{
		$this->assertEmpty(self::$config);
		$this->assertTrue($this->announcements->install(5));

		$backup_config = array();
		foreach (self::$config as $key => $value)
		{
			$backup_config[$key] = $value;
		}

		$this->assertTrue($this->announcements->uninstall(5, $this->db));

		foreach ($backup_config as $key => $value)
		{
			$this->assertArrayNotHasKey($key, self::$config);
		}
	}

	public function test_get_template_center()
	{
		$this->assertSame('announcements_center.html', $this->announcements->get_template_center(5));
		$this->template->assert_same(array(array(
			'S_NO_TOPICS'	=> true,
			'S_NOT_LAST'	=> false
		)), 'announcements.center_row');
		$this->template->assert_same(false, 'S_CAN_READ');

		self::$config->set('board3_announcements_style_5', true);
		$this->template->delete_var('announcements.center_row');
		$this->assertSame('announcements_center_compact.html', $this->announcements->get_template_center(5));
		$this->template->assert_same(array(array(
			'S_NO_TOPICS'	=> true,
			'S_NOT_LAST'	=> false
		)), 'announcements.center_row');
		$this->template->assert_same(false, 'S_CAN_READ');
	}
}
