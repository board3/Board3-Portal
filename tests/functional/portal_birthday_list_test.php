<?php
/**
*
* @package testing
* @copyright (c) 2014 Board3 Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @group functional
*/
class phpbb_functional_portal_birthday_list_test extends \board3\portal\tests\testframework\functional_test_case
{
	public function setUp(): void
	{
		parent::setUp();

		$this->purge_cache();

		$this->login();
		$this->admin_login();
	}

	public function test_setup_birthday()
	{
		$this->logout();
		$uid = $this->create_user('portal_birthday_user');
		if (!$uid)
		{
			$this->markTestIncomplete('Unable to create portal_user');
		}
		$this->login('portal_birthday_user');
		$crawler = self::request('GET', 'ucp.php?i=ucp_profile&mode=profile_info&sid=' . $this->sid);
		$form = $crawler->selectButton('Submit')->form();
		$form->setValues(array(
			'bday_day'	=> date('d', time() + 86400*2),
			'bday_month'	=> date('m', time() + 86400*2),
			'bday_year'	=> date('Y', time() + 86400*2),
		));
		self::submit($form);
	}

	/**
	* @depends test_setup_birthday
	*/
	public function test_after_announce()
	{
		$crawler = self::request('GET', 'app.php/portal');
		$this->assertContains(date('d M', time() + 86400*2), $crawler->html());
	}
}
