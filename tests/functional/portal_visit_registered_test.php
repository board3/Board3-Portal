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

	public function test_setup_hidden_forum()
	{
		$this->logout();
		$this->login();
		$this->admin_login();
		$crawler = self::request('GET', 'adm/index.php?i=acp_forums&mode=manage&parent_id=1&sid=' . $this->sid);
		$form = $crawler->selectButton('Create new forum')->form();
		$form->setValues(array('forum_name' => 'Hidden forum'));
		$crawler = self::submit($form);

		// Create the forum
		$form = $crawler->selectButton('Submit')->form();
		$form['forum_perm_from']->select(2);
		$crawler = self::submit($form);
		$this->assertContains('Forum created successfully', $crawler->text());

		// Hide forum using permissions from registered users
		$crawler = self::request('GET', 'adm/index.php?i=acp_permissions&mode=setting_group_local&sid=' . $this->sid);
		$form = $crawler->selectButton('Submit')->form();
		$group_id = 0;
		$crawler->filter('option')->each(function ($node) use (&$group_id) {
			if ($node->text() === 'Registered users')
			{
				$group_id = $node->attr('value');
			}
		});
		$form->setValues(array('group_id[0]' => $group_id));
		$crawler = self::submit($form);
		$form = $crawler->selectButton('Submit')->form();
		$forum_id = 0;
		$crawler->filter('option')->each(function ($node) use (&$forum_id) {
			if (strpos($node->text(), 'Hidden forum') !== false)
			{
				$forum_id = $node->attr('value');
			}
		});
		$form['forum_id']->select($forum_id);
		$crawler = self::submit($form);
		$form = $crawler->selectButton('Apply all permissions')->form();
		$role_id = 0;
		$crawler->filter('li')->each(function ($node) use (&$role_id) {
			if ($node->text() === 'No Access')
			{
				$role_id = $node->attr('data-id');
			}
		});

		$db = $this->get_db();
		$sql = 'DELETE FROM ' . ACL_GROUPS_TABLE . "
			WHERE group_id = {$group_id}
				AND forum_id = {$forum_id}";
		$db->sql_query($sql);
		$sql = 'INSERT INTO ' . ACL_GROUPS_TABLE . " (group_id, forum_id, auth_option_id, auth_role_id, auth_setting)
			VALUES({$group_id}, {$forum_id}, 0, {$role_id}, 0)";
		$db->sql_query($sql);

		// Create standard registered user
		$this->create_user('standard-user');
		$this->add_user_group('REGISTERED_USERS', array('standard-user'));
		$this->remove_user_group('NEWLY_REGISTERED_USERS', array('standard-user'));

		// Create topic in hidden forum
		$this->create_topic($forum_id, 'Hidden topic', 'Very very hidden topic (for registered users that is)');
	}

	/**
	 * @dependsOn test_setup_hidden_forum
	 */
	public function test_news_with_hidden_forum()
	{
		$this->logout();
		$this->login('standard-user');
		$crawler = self::request('GET', 'index.php');
		$this->assertNotContains('Hidden forum', $crawler->text());
		$crawler = self::request('GET', 'app.php/portal');
		$this->assertNotContains('Hidden topic', $crawler->text());
	}
}
