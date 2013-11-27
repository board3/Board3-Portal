<?php
/**
*
* @package testing
* @copyright (c) 2013 Board3 Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @group functional
*/
class phpbb_functional_portal_acp_test extends \board3\portal\tests\testframework\functional_test_case
{
	public function setUp()
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
		$this->enable_board3_portal_ext();
	}

	public function acp_pages_data()
	{
		return array(
			array('config'),
			array('modules'),
			array('upload_module'),
		);
	}

	/**
	* @dataProvider acp_pages_data
	*/
	public function test_acp_pages($mode)
	{
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&amp;mode=' . $mode . '&sid=' . $this->sid);
	}
}
