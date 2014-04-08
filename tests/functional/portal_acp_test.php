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
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=' . $mode . '&sid=' . $this->sid);
	}

	public function test_move_first_module_up()
	{
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&sid=' . $this->sid);
		$module_link = $crawler->filter('table')->eq(3)->filter('tr')->eq(1)->filter('a')->eq(0)->attr('href');
		preg_match('/module_id=(?:([0-9]{1,3}))/', $module_link, $output);
		$this->assertNotEmpty($output[1]);
		$module_id = $output[1];
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&module_id=' . $module_id . '&action=move_up&sid=' . $this->sid);
	}

	public function test_move_last_module_down()
	{
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&sid=' . $this->sid);
		$module_link = $crawler->filter('table')->eq(3)->filter('tr')->last()->filter('a')->eq(0)->attr('href');
		preg_match('/module_id=(?:([0-9]{1,3}))/', $module_link, $output);
		$this->assertNotEmpty($output[1]);
		$module_id = $output[1];
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&module_id=' . $module_id . '&action=move_down&sid=' . $this->sid);
	}

	public function test_delete_module()
	{
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&sid=' . $this->sid);
		$module_link = str_replace(array('./../', '%5C'), array('', '\\'), $crawler->filter('table')->eq(3)->filter('tr')->last()->filter('a')->eq(3)->attr('href'));
		$crawler = self::request('GET', $module_link);
		preg_match('/module_classname=(?:([a-z0-9\\\_]+))/', $module_link, $module_name);
		$module_name = $module_name[1];
		$this->assertContains('Are you sure you wish to delete the module', $crawler->text());
		$form = $crawler->selectButton('confirm')->form();
		$crawler = self::submit($form);
		$this->assertContains('The module was removed successfully.', $crawler->text());

		// Add it back
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&add[center]=true&sid=' . $this->sid);
		$form = $crawler->selectButton('submit')->form();
		$form->setValues(array('module_classname' => $module_name));
		$crawler = self::submit($form);
	}
}
