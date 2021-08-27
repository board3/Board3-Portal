<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

class phpbb_unit_modules_search_test extends \board3\portal\tests\testframework\test_case
{
	/** @var \board3\portal\tests\mock\template */
	protected $template;

	/** @var \board3\portal\modules\search */
	protected $search;

	public function setUp(): void
	{
		parent::setUp();

		$this->template = new \board3\portal\tests\mock\template($this);
		$this->search = new \board3\portal\modules\search($this->template, '', '');
	}

	public function test_get_template_side()
	{
		$this->assertSame('search_side.html', $this->search->get_template_side(5));
	}

	public function test_get_template_acp()
	{
		$acp_template = $this->search->get_template_acp(5);
		$this->assertNotEmpty($acp_template);
		$this->assertEmpty($acp_template['vars']);
	}
}
