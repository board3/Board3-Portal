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
class phpbb_functional_portal_vote_poll_test extends \board3\portal\tests\testframework\functional_test_case
{
	public function setUp()
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
		$this->enable_board3_portal_ext();
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
			$crawler = self::request('GET', 'app.php?portal');
		}
	}
}
