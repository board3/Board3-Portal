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
class phpbb_functional_portal_redirect_test extends \board3\portal\tests\testframework\functional_test_case
{
	public function setUp(): void
	{
		parent::setUp();

		$this->login();
		$this->admin_login();
	}

	public function test_redirect()
	{
		if (function_exists('apache_get_modules'))
		{
			$modules = apache_get_modules();
			$mod_rewrite = in_array('mod_rewrite', $modules);
		}
		else
		{
			$mod_rewrite = getenv('HTTP_MOD_REWRITE') == 'On';
		}

		if ($mod_rewrite)
		{
			$crawler = self::request('GET', '');
			$this->assertStringContainsString('Board3 Portal', $crawler->text());
		}
	}

	public function test_redirect_after_login()
	{
		// Make sure we are logged out
		$this->logout();

		$crawler = self::request('GET', 'app.php/portal');
		$form = $crawler->selectButton('Login')->form();
		$form->setValues(array(
			'username'	=> 'admin',
			'password'	=> 'adminadmin',
		));

		$crawler = self::submit($form);

		// Should be redirected to portal and logged in
		$this->assertStringContainsString('Site Admin', $crawler->text());
	}
}
