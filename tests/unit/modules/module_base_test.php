<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

class phpbb_unit_modules_module_base_test extends \board3\portal\tests\testframework\test_case
{
	/** @var \board3\portal\modules\module_base */
	protected $module_base;

	public function setUp(): void
	{
		parent::setUp();

		$this->module_base = new \board3\portal\modules\module_base();
	}

	public function test_get_templates()
	{
		$this->assertNull($this->module_base->get_template_side(5));
		$this->assertNull($this->module_base->get_template_center(5));
		$this->assertEquals(array(), $this->module_base->get_template_acp(5));
	}

	public function test_install()
	{
		$this->assertTrue($this->module_base->install(5));
		$this->assertTrue($this->module_base->uninstall(5, null));
	}

	public function test_can_multi_include()
	{
		$this->assertFalse($this->module_base->can_multi_include());
	}
}
