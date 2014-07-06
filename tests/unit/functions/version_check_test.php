<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../../../../includes/utf/utf_tools.php');

class phpbb_functions_version_check_test extends \board3\portal\tests\testframework\test_case
{
	protected $version_check;

	public function setUp()
	{
		global $phpbb_root_path, $phpEx;

		$this->template = new \board3\portal\tests\mock\template($this);

		$version_data = array(
			'author'	=> 'Saint_hh',
			'title'		=> 'Board3 Portal',
			'tag'		=> 'board3_portal_v2_dev',
			'version'	=> 'board3_portal_version',
			'file'		=> array('board3.de', 'updatecheck', 'board3_portal.xml'),
		);
		$config = array('board3_portal_version' => '2.1.0');
		$user = new \board3\portal\tests\mock\user;
		$user->set(array(
			'NO_INFO'		=> 'NO_INFO',
			'NOT_UP_TO_DATE'	=> 'NOT_UP_TO_DATE',
			'UP_TO_DATE'		=> 'UP_TO_DATE',
		));
		$this->version_check = new \board3\portal\includes\version_check($version_data, $config, $phpbb_root_path, $phpEx, $this->template, $user);
	}

	public function test_version_check()
	{
		$this->assertTrue(true);
		$this->assertNull($this->version_check->version_check());
		$this->assertEquals('2.1.0', $this->version_check->version_check(true));
		$this->template->assert_equals(array(
			'CURRENT_VERSION' => '2.1.0',
			'TITLE' => 'Board3 Portal',
			'UP_TO_DATE' => 'UP_TO_DATE',
			'S_UP_TO_DATE' => true,
		), 'mods');
	}
}
