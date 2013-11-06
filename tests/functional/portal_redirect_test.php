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
	public function setUp()
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
		$this->add_lang(array('mods/portal'));
		$this->enable_board3_portal_ext();
	}

	protected function enable_board3_portal_ext()
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_extensions&mode=main&sid=' . $this->sid);
		$crawler->filter('tr.ext_disabled')->each(function ($node, $i)
		{
			if (strpos($node->text(), 'Board3 Portal') !== false)
			{
				$crawler = self::request('GET', 'adm/index.php?i=acp_extensions&mode=main&action=enable_pre&ext_name=board3%2fportal&sid=' . $this->sid);
				$form = $crawler->selectButton('Enable')->form();
				$crawler = self::submit($form);
				$this->assertContains('The extension was enabled successfully', $crawler->text());
			}
		});
	}

	public function test_redirect()
	{
		$crawler = self::request('GET', '');
		$this->assertContains('Board3 Portal', $crawler->text());
	}
}
