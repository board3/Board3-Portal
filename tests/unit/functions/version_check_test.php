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
	protected $template;
	protected $config;

	public function setUp()
	{
		global $phpbb_root_path, $phpEx;

		include_once($phpbb_root_path . 'includes/functions.' . $phpEx);
		include_once($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

		$this->version_data = array(
			'author'	=> 'Marc',
			'version'	=> 'board3_portal_version',
			'title'		=> 'Board3 Portal',
			'file'		=> array('board3.de', '/updatecheck', 'board3_portal.json'),
		);
		$this->config = new \phpbb\config\config(array());
		$this->user = new \board3\portal\tests\mock\user;
		$this->user->set(array(
			'NO_INFO'		=> 'NO_INFO',
			'NOT_UP_TO_DATE'	=> 'NOT_UP_TO_DATE',
			'UP_TO_DATE'		=> 'UP_TO_DATE',
		));
		$this->cache = $this->getMockBuilder('\phpbb\cache\service')
			->disableOriginalConstructor()
			->getMock();
	}

	protected function get_version_helper($version)
	{
		$this->config->set('board3_portal_version', $version);

		$this->template = new \board3\portal\tests\mock\template($this);
		$version_helper = new \phpbb\version_helper($this->cache, $this->config, new \phpbb\file_downloader(), new \phpbb\user('\phpbb\datetime'));
		$this->version_check = new \board3\portal\includes\version_check($this->version_data, $this->config, $version_helper, $this->template, $this->user);
	}

	public function data_version_check()
	{
		return array(
			array('2.1.0', array(
				'CURRENT_VERSION' => '2.1.0',
				'TITLE' => 'Board3 Portal',
				'UP_TO_DATE' => 'UP_TO_DATE',
				'S_UP_TO_DATE' => true,
				'LATEST_VERSION' => '2.1.0',
			)),
			array('2.1.0-a1', array(
				'CURRENT_VERSION' => '2.1.0-a1',
				'TITLE' => 'Board3 Portal',
				'UP_TO_DATE' => 'NOT_UP_TO_DATE',
				'S_UP_TO_DATE' => false,
				'LATEST_VERSION' => '2.1.0-b1',
			)),
		);
	}

	/**
	 * @dataProvider data_version_check
	 */
	public function test_version_up_to_date($version, $template_data)
	{
		$this->get_version_helper($version);
		$this->assertEquals($version, $this->version_check->check(true));
		$this->assertNull($this->version_check->check());
		$this->template->assert_equals($template_data, 'mods');
	}
}
