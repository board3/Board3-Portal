<?php
/**
 *
 * @package testing
 * @copyright (c) 2014 Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\portal\modules;

use board3\portal\acp\portal_info;

class phpbb_acp_portal_module_test extends \board3\portal\tests\testframework\test_case
{
	public function test_portal_info()
	{
		$portal_info = new portal_info();
		$module_info = $portal_info->module();
		$this->assertArrayHasKey('filename', $module_info);
		$this->assertSame('\board3\portal\acp\portal_module', $module_info['filename']);
	}
}