<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\controller;

class helper_test extends \board3\portal\tests\testframework\test_case
{
	protected $controller_helper;

	protected $modules;

	static public $redirect = false;

	public function setUp()
	{
		global $cache;

		parent::setUp();

		define(B3_MODULE_DISABLED, 0);
		define(B3_MODULE_ENABLED, 1);

		$cache = $this->getMock('\phpbb\cache\driver', array('get', 'put'));
		$this->auth = $this->getMock('\phpbb\auth\auth', array('acl_get'));
		$this->auth->expects($this->any())
			->method('acl_get')
			->with($this->anything())
			->will($this->returnValue(true));
		$this->config = new \phpbb\config\config(array(
			'board3_enable'	=> true,
		));
		$this->template = new \board3\portal\tests\mock\template($this);
		$this->user = $this->getMock('\phpbb\user', array('add_lang_ext'), array('\phpbb\datetime'));
		$this->user->data['group_id'] = 2;
		$this->phpbb_root_path = dirname(__FILE__) . '/../../../../../../';
		$this->php_ext = 'php';
		$this->portal_columns = new \board3\portal\portal\columns();
		$this->modules = array(
			'\board3\portal\modules\link_us'	=> new \board3\portal\modules\link_us($config, new \board3\portal\tests\mock\template($this), new \board3\portal\tests\mock\user),
		);
		$this->portal_helper = new \board3\portal\includes\helper($this->modules);
		$this->path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			new \phpbb_mock_request(),
			$this->phpbb_root_path,
			$this->php_ext
		);
		$this->controller_helper = $this->get_controller_helper();
	}

	protected function get_controller_helper()
	{
		$controller_helper = new \board3\portal\controller\helper(
			$this->auth,
			$this->portal_columns,
			$this->config,
			$this->template,
			$this->user,
			$this->path_helper,
			$this->portal_helper,
			$this->phpbb_root_path,
			$this->php_ext
		);

		return $controller_helper;
	}

	public function test_check_online_list()
	{
		$this->assertFalse($this->controller_helper->check_online_list('foobar', false));
		$this->assertTrue($this->controller_helper->check_online_list('\board3\portal\modules\whois_online', false));
		$this->assertTrue($this->controller_helper->check_online_list('foobar', true));
	}

	public function test_check_permission()
	{
		self::$redirect = false;
		$this->controller_helper->run_initial_tasks();
		$this->assertFalse(self::$redirect);

		$this->config['board3_enable'] = false;
		$controller_helper = $this->get_controller_helper();
		$controller_helper->run_initial_tasks();
		$this->assertTrue(self::$redirect);
	}

	public function data_get_portal_module()
	{
		return array(
			array(false, array(
				'module_status'		=> 1,
				'module_classname'	=> 'foo',
			)),
			array(false, array(
				'module_status'		=> 0,
				'module_classname'	=> '\board3\portal\modules\link_us',
			)),
			array(true, array(
				'module_status'		=> 1,
				'module_classname'	=> '\board3\portal\modules\link_us',
			)),
			array(false, array(
				'module_status'		=> 1,
				'module_classname'	=> '\board3\portal\modules\link_us',
				'module_group_ids'	=> 3,4,
			)),
		);
	}

	/**
	* @dataProvider data_get_portal_module
	*/
	public function test_get_portal_module($expected, $row)
	{
		$this->assertEquals(($expected) ? $this->modules['\board3\portal\modules\link_us'] : false, $this->controller_helper->get_portal_module($row));
	}

	public function test_load_module_language()
	{
		$this->assertNull($this->controller_helper->load_module_language($this->modules['\board3\portal\modules\link_us']));
	}

	public function data_assign_module_vars()
	{
		return array(
			array(array(
				'module_column'		=> 1,
				'module_id'		=> 1,
				'module_image_width'	=> 16,
				'module_image_height'	=> 16,
			), array(
				'template'	=> 'foobar.html',
				'title'		=> 'foo',
				'code'		=> 'bar',
			)),
			array(array(
				'module_column'		=> 1,
				'module_id'		=> 1,
				'module_image_width'	=> 16,
				'module_image_height'	=> 16,
			), 'foobar.html'),
		);
	}

	/**
	* @dataProvider data_assign_module_vars
	*/
	public function test_assign_module_vars($row, $template_module)
	{
		$this->assertNull($this->controller_helper->assign_module_vars($row, $template_module));
	}
}

function redirect($foo)
{
	\board3\portal\controller\helper_test::$redirect = true;
}

function append_sid($link)
{
	return $link;
}
