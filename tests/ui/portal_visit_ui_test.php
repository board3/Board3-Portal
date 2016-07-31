<?php
/**
*
* @package testing
* @copyright (c) 2013 Board3 Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @group ui
*/
class phpbb_ui_portal_visit_ui_test extends \board3\portal\tests\testframework\ui_test_case
{
	public function setUp()
	{
		parent::setUp();

		$this->purge_cache();

		$this->login();
		$this->admin_login();
	}

	public function test_vanilla_board()
	{
		$this->visit('app.php/portal');
	}
}
