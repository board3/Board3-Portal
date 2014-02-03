<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../includes/functions.php');

class phpbb_functions_simple_test extends PHPUnit_Framework_TestCase
{
	public function test_ap_validate()
	{
		$this->assertEquals('<br/>woot<br/><ul><li>test</li></ul>', ap_validate('<br />woot<br/><ul><li>test</li><br /></ul>'));
	}

}
