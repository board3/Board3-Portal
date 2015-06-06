<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

class board3_includes_helper_test extends \board3\portal\tests\testframework\test_case
{
	protected $portal_helper;

	protected $modules;

	public function setUp()
	{
		$config = new \phpbb\config\config(array());
		$this->modules = array(
			'\board3\portal\modules\link_us'	=> new \board3\portal\modules\link_us($config, new \board3\portal\tests\mock\template($this), new \board3\portal\tests\mock\user),
		);

		$this->portal_helper = $this->get_portal_helper($this->modules);
	}

	protected function get_portal_helper($modules)
	{
		$this->portal_helper = new \board3\portal\includes\helper($modules);

		return $this->portal_helper;
	}

	public function data_get_module()
	{
		return array(
			array(false, '\board3\portal\modules\user_menu'),
			array('\board3\portal\modules\link_us', '\board3\portal\modules\link_us'),
		);
	}

	/**
	* @dataProvider data_get_module
	*/
	public function test_get_module($expected, $module_name)
	{
		if (!empty($expected))
		{
			$expected = $this->modules[$expected];
		}
		$this->assertEquals($expected, $this->portal_helper->get_module($module_name));
	}

	public function test_get_all_modules()
	{
		$this->assertEquals($this->modules, $this->portal_helper->get_all_modules());
	}
}
