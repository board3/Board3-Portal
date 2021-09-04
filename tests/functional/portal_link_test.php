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
class phpbb_functional_portal_link_test extends \board3\portal\tests\testframework\functional_test_case
{
	public function setUp(): void
	{
		parent::setUp();

		$this->login();
		$this->admin_login();
	}

	public function test_portal_link()
	{
		$crawler = self::request('GET', 'index.php?sid=' . $this->sid);
		$this->assertStringContainsString('Portal', $crawler->text());
	}

	public function test_disabled_portal_link()
	{
		// Disable portal
		$crawler = self::request('GET', 'adm/index.php?i=-board3-portal-acp-portal_module&mode=config&sid=' . $this->sid);
		$form = $crawler->selectButton('Submit')->form();
		$form->setValues(array(
			'config[board3_enable]'	=> 0,
		));
		$crawler = self::submit($form);

		// Should be updated
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->text());

		// Look for portal link on index
		$crawler = self::request('GET', 'index.php?sid=' . $this->sid);
		$vals = $crawler->filter('#nav-breadcrumbs')->each(function (\Symfony\Component\DomCrawler\Crawler $node, $i) {
			return $node->text();
		});
		foreach ($vals as $val)
		{
			$this->assertStringNotContainsString('Portal', $val);
		}

		// Try to access portal directly
		$crawler = self::request('GET', 'app.php/portal?sid=' . $this->sid);
		$vals = $crawler->filter('#nav-breadcrumbs')->each(function (\Symfony\Component\DomCrawler\Crawler $node, $i) {
			return $node->text();
		});
		foreach ($vals as $val)
		{
			$this->assertStringNotContainsString('Portal', $val);
		}

		// Enable portal again
		$crawler = self::request('GET', 'adm/index.php?i=-board3-portal-acp-portal_module&mode=config&sid=' . $this->sid);
		$form = $crawler->selectButton('Submit')->form();
		$form->setValues(array(
			'config[board3_enable]'	=> 1,
		));
		self::submit($form);
	}
}
