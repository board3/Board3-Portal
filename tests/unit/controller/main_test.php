<?php
/**
 *
 * @package testing
 * @copyright (c) Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\controller;

class main_test extends \board3\portal\tests\testframework\database_test_case
{
	/** @var \board3\portal\controller\main */
	protected $controller_main;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \board3\portal\tests\mock\template */
	protected $template;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/../acp/fixtures/modules.xml');
	}

	public function setUp(): void
	{
		global $phpbb_root_path, $phpEx, $table_prefix, $cache;

		parent::setUp();

		$path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem\filesystem(),
			new \phpbb_mock_request(),
			$phpbb_root_path,
			$phpEx
		);

		$cache = new \phpbb\cache\driver\dummy();

		$user = new \board3\portal\tests\mock\user();

		$config_table = $table_prefix . 'portal_config';
		$modules_table = $table_prefix . 'portal_modules';
		$this->template = new \board3\portal\tests\mock\template($this);
		$portal_columns = new \board3\portal\portal\columns();
		$this->config = new \phpbb\config\config(array('board3_enable' => true));
		$modules = array(
			'\board3\portal\modules\clock'	=> new \board3\portal\modules\clock($this->config, $this->template),
		);
		$portal_helper = new \board3\portal\includes\helper($modules);
		$auth = $this->getMock('\phpbb\auth\auth', array('acl_get'));
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->anything())
			->will($this->returnValue(true));
		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);

		$controller_helper = new \board3\portal\controller\helper(
			$auth,
			$portal_columns,
			$this->config,
			$this->language,
			$this->template,
			$user,
			$path_helper,
			$portal_helper,
			$phpbb_root_path,
			'.' . $phpEx
		);

		$this->controller_main = new \board3\portal\controller\main(
			$portal_columns,
			$this->config,
			$controller_helper,
			$this->template,
			$user,
			$path_helper,
			$phpbb_root_path,
			'.' . $phpEx,
			$config_table,
			$modules_table
		);
	}

	public function test_display_all_pages()
	{
		$this->assertNull($this->controller_main->handle(array('left' => 1)));
		$this->template->assert_same(true, 'S_PORTAL_ALL');
	}

	public function test_display_all_pages_twice()
	{
		$this->assertNull($this->controller_main->handle(array('left' => 1)));
		$this->template->assert_same(true, 'S_PORTAL_ALL');
		$this->template->delete_var('S_PORTAL_ALL');
		$this->assertNull($this->controller_main->handle(array('left' => 1)));
		$this->template->assert_same(null, 'S_PORTAL_ALL');
	}

	public function test_is_enabled_side_column()
	{
		$this->assertFalse($this->controller_main->get_module_template(array(), new \board3\portal\modules\clock($this->config, $this->template)));
		$this->assertNull($this->controller_main->handle(array('left' => 1)));
		$this->template->assert_same(true, 'S_PORTAL_ALL');
		$this->config['board3_left_column'] = false;
		$this->assertSame('clock_side.html', $this->controller_main->get_module_template(array('module_column' => 1), new \board3\portal\modules\clock($this->config, $this->template)));
	}
}
