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

	public function setUp()
	{
		global $phpbb_root_path, $phpEx, $table_prefix, $cache;

		parent::setUp();

		$path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			new \phpbb_mock_request(),
			$phpbb_root_path,
			$phpEx
		);

		$cache = new \phpbb\cache\driver\null();

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

		$controller_helper = new \board3\portal\controller\helper(
			$auth,
			$portal_columns,
			$this->config,
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
}
