<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/


class board3_includes_helper_database_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $portal_helper;

	protected $modules;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/auth.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$config = new \phpbb\config\config(array());
		$this->modules = array(
			'\board3\portal\modules\link_us'	=> new \board3\portal\modules\link_us($config, new \board3\portal\tests\mock\template($this), new \board3\portal\tests\mock\user),
		);
		$auth = new \phpbb\auth\auth();

		$this->portal_helper = $this->get_portal_helper($auth, $this->modules);
	}

	protected function get_portal_helper($auth, $modules)
	{
		$this->portal_helper = new \board3\portal\includes\helper($auth, $modules);

		return $this->portal_helper;
	}

	public function data_get_disallowed_forums()
	{
		return array(
			array(array(), false),
			array(array(0 => 1, 1 => 2), true),
		);
	}

	/**
	* @dataProvider data_get_disallowed_forums
	*/
	public function test_get_disallowed_forums($expected, $input)
	{
		$this->assertEquals($expected, $this->portal_helper->get_disallowed_forums($input));
	}
}
