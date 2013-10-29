<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\mock;

class user extends \PHPUnit_Framework_TestCase
{
	public $lang = array();

	public function set($data)
	{
		$this->assertTrue(is_array($data));

		foreach ($data as $key => $column)
		{
			$this->lang[$key] = $column;
		}
	}
}
