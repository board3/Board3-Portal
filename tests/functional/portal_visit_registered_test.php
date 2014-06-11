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
class phpbb_functional_portal_visit_registered_test extends \board3\portal\tests\testframework\functional_test_case
{
	public function setUp()
	{
		parent::setUp();

		$this->login();
		$this->admin_login();
	}

	public function test_vanilla_board()
	{
		$this->logout();
		$uid = $this->create_user('portal_user');
		if (!$uid)
		{
			$this->markTestIncomplete('Unable to create portal_user');
		}
		$this->login('portal_user');
		self::request('GET', 'app.php/portal');
	}

	public function test_with_announce()
	{
		// Create topic as announcement
		$data = $this->create_topic(2, 'Portal-announce', 'This is an announcement for the portal', array(
			'topic_type'	=> POST_ANNOUNCE,
		));

		if (isset($data))
		{
			// no errors should appear on portal
			self::request('GET', 'app.php/portal');
		}
	}

	public function test_with_global()
	{
		// Create topic as announcement
		$data = $this->create_topic(2, 'Portal-announce-global', 'This is a global announcement for the portal', array(
			'topic_type'	=> POST_GLOBAL,
		));

		if (isset($data))
		{
			// no errors should appear on portal
			self::request('GET', 'app.php/portal');
		}
	}

	/**
	* @depends test_with_announce
	*/
	public function test_after_announce()
	{
		$this->logout();
		self::request('GET', 'app.php/portal');
	}

	public function test_with_poll()
	{
		// Create topic with poll
		$data = $this->create_topic(2, 'Portal-poll', 'This is a poll for the portal', array(
			'poll_title'	=> 'Is this a poll?',
			'poll_option_text'	=> "Yes\nNo\nMaybe",
		));

		if (isset($data))
		{
			$crawler = self::request('GET', 'app.php/portal');
			$form = $crawler->selectButton('Submit vote')->form();
			$form->setValues(array('vote_id' => array(1)));
			self::submit($form);

			// no errors should appear on portal
			self::request('GET', 'app.php/portal');
		}
	}

	/**
	* @depends test_with_poll
	*/
	public function test_after_poll()
	{
		$this->logout();
		self::request('GET', 'app.php/portal');
	}

	public function test_whois_online_legend()
	{
		$crawler = self::request('GET', 'app.php/portal');

		$legend = $crawler->filter('dd.portal-responsive-show p em')->text();
		$this->assertContains('Administrators', $legend);
		$this->assertContains('Global moderators', $legend);
	}
}
