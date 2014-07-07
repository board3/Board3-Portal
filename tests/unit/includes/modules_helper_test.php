<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/


class board3_includes_modules_helper_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $modules_helper;

	protected $modules;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/auth.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$auth = new \phpbb\auth\auth();

		$this->modules_helper = new \board3\portal\includes\modules_helper($auth);
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
		$this->assertEquals($expected, $this->modules_helper->get_disallowed_forums($input));
	}
}
