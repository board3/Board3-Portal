<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

class phpbb_unit_modules_clock_test extends \board3\portal\tests\testframework\test_case
{
	/** @var \board3\portal\tests\mock\template */
	protected $template;

	/** @var \board3\portal\modules\clock */
	protected $clock;

	/** @var \phpbb\config\config */
	protected $config;

	public function setUp(): void
	{
		parent::setUp();

		$this->template = new \board3\portal\tests\mock\template($this);
		$this->config = new \phpbb\config\config(array());
		$this->clock = new \board3\portal\modules\clock($this->config, $this->template);
	}

	public function test_get_template_side()
	{
		$this->assertSame('clock_side.html', $this->clock->get_template_side(5));
		$this->template->assert_same(null, 'B3P_CLOCK_SRC');
		$this->config->set('board3_clock_src_5', 'foobar');
		$this->assertSame('clock_side.html', $this->clock->get_template_side(5));
		$this->template->assert_same('foobar', 'B3P_CLOCK_SRC');
	}

	public function test_get_template_acp()
	{
		$acp_template = $this->clock->get_template_acp(5);
		$this->assertNotEmpty($acp_template);
		$this->assertArrayHasKey('board3_clock_src_5', $acp_template['vars']);
	}

	public function test_install_uninstall()
	{
		$this->config->delete('board3_clock_src_5');
		$this->assertTrue($this->clock->install(5));
		$this->assertTrue(isset($this->config['board3_clock_src_5']));
		$this->assertSame('', $this->config['board3_clock_src_5']);
		$this->assertTrue($this->clock->uninstall(5, ''));
		$this->assertFalse(isset($this->config['board3_clock_src_5']));
	}
}
