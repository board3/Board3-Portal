<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\testframework;

abstract class functional_test_case extends \phpbb_functional_test_case
{
	protected $portal_enabled = false;

	public function enable_board3_portal_ext()
	{
		$enable_portal = false;

		if ($this->portal_enabled === true || $this->check_if_enabled())
		{
			return;
		}

		$crawler = self::request('GET', 'adm/index.php?i=acp_extensions&mode=main&sid=' . $this->sid);
		$disabled_extensions = $crawler->filter('tr.ext_disabled')->extract(array('_text'));
		foreach ($disabled_extensions as $extension)
		{
			if (strpos($extension, 'Board3 Portal') !== false)
			{
				$enable_portal = true;
			}
		}

		if ($enable_portal)
		{
			$crawler = self::request('GET', 'adm/index.php?i=acp_extensions&mode=main&action=enable_pre&ext_name=board3%2fportal&sid=' . $this->sid);
			$form = $crawler->selectButton('Enable')->form();
			$crawler = self::submit($form);
			$this->assertContains('The extension was enabled successfully', $crawler->text());
			$this->portal_enabled = true;
			$this->set_enabled();
		}
	}

	protected function check_if_enabled()
	{
		$this->db = $this->get_db();

		$sql = "SELECT config_value FROM phpbb_config WHERE config_name = 'b3p_ext_enabled'";
		$result = $this->db->sql_query($sql);
		$enabled = $this->db->sql_fetchfield('config_value');
		$this->db->sql_freeresult($result);

		return $enabled;
	}

	protected function set_enabled()
	{
		$this->db = $this->get_db();

		$sql = "INSERT INTO phpbb_config (config_name, config_value, is_dynamic) VALUES ('b3p_ext_enabled', 1, 1)";
		$this->db->sql_query($sql);
	}
}
