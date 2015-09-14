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
	}

	public function acp_pages_data()
	{
		return array(
			array('config'),
			array('modules'),
		);
	}

	/**
	* @dataProvider acp_pages_data
	*/
	public function test_acp_pages($mode)
	{
		self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=' . $mode . '&sid=' . $this->sid);
	}

	public function test_move_first_module_up()
	{
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&sid=' . $this->sid);
		$module_link = $crawler->filter('table')->eq(3)->filter('tr')->eq(1)->filter('a')->eq(0)->attr('href');
		preg_match('/module_id=(?:([0-9]{1,3}))/', $module_link, $output);
		$this->assertNotEmpty($output[1]);
		$module_id = $output[1];
		self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&module_id=' . $module_id . '&action=move_up&sid=' . $this->sid);
	}

	public function test_move_last_module_down()
	{
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&sid=' . $this->sid);
		$module_link = $crawler->filter('table')->eq(3)->filter('tr')->last()->filter('a')->eq(0)->attr('href');
		preg_match('/module_id=(?:([0-9]{1,3}))/', $module_link, $output);
		$this->assertNotEmpty($output[1]);
		$module_id = $output[1];
		self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&module_id=' . $module_id . '&action=move_down&sid=' . $this->sid);
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
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=modules&add[center]=true&module_column=2&sid=' . $this->sid);
		$form = $crawler->selectButton('submit')->form();
		$form->setValues(array('module_classname' => $module_name));
		self::submit($form);
	}

	public function test_portal_logs()
	{
		$this->add_lang_ext('board3/portal', 'info_acp_portal');
		$crawler = self::request('GET', 'adm/index.php?i=-board3-portal-acp-portal_module&mode=config&sid=' . $this->sid);
		$form = $crawler->selectButton('submit')->form();
		$crawler = self::submit($form);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->text());

		// Take a look at the logs
		$crawler = self::request('GET', 'adm/index.php?i=acp_logs&mode=admin&sid=' . $this->sid);
		$this->assertContains(strip_tags(html_entity_decode($this->lang('LOG_PORTAL_CONFIG', $this->lang('ACP_PORTAL_GENERAL_INFO')), ENT_COMPAT, 'UTF-8')), $crawler->text());
	}

	public function test_portal_permissions()
	{
		$this->add_lang_ext('board3/portal', 'permissions_portal');
		$crawler = self::request('GET', 'adm/index.php?i=acp_permissions&mode=setting_group_global&sid=' . $this->sid);
		$form = $crawler->selectButton('submit')->form();
		$crawler = self::submit($form);
		$this->assertContainsLang('ACL_U_VIEW_PORTAL', $crawler->text());
	}

	public function test_edit_menu_link()
	{
		$this->add_lang_ext('board3/portal', 'info_acp_portal');
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=config&module_id=1&action=edit&id=10&sid=' . $this->sid);
		$form = $crawler->selectButton('submit')->form();
		$form->setValues(array('link_title'	=> 'foobar'));
		$crawler = self::submit($form);
		$crawler = self::request('GET', 'adm/index.php?i=\board3\portal\acp\portal_module&mode=config&module_id=1&sid=' . $this->sid);
		$this->assertContains('foobar', $crawler->text());
		$crawler = self::request('GET', 'app.php/portal?sid=' . $this->sid);
		$this->assertContains('foobar', $crawler->text());
	}

	public function data_add_second_module()
	{
		return array(
			array('\board3\portal\modules\news', 2, 'center', 'The module was added successfully.'),
			array('\board3\portal\modules\news', 1, 'left', 'It is not possible to add the module to the selected column.'),
			array('\board3\portal\modules\attachments', 2, 'center', 'The module was added successfully'),
			array('\board3\portal\modules\attachments', 2, 'center', 'This module can only be added once'),
			array('\board3\portal\modules\attachments', 1, 'left', 'This module can only be added once'),
		);
	}

	/**
	 * @dataProvider data_add_second_module
	 */
	public function test_add_second_news($module_class, $column, $column_name, $expected_message)
	{
		$this->add_lang_ext('board3/portal', 'info_acp_portal');
		$crawler = self::request('GET', 'adm/index.php?i=-board3-portal-acp-portal_module&mode=modules&add_column=' . $column . '&add[' . $column_name . ']=add&sid=' . $this->sid);
		$form = $crawler->selectButton('submit')->form();
		$form['module_classname']->disableValidation()->select($module_class);
		$crawler = self::submit($form);
		$this->assertContains($expected_message, $crawler->text());
	}
}
