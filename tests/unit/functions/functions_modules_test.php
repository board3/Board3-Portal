<?php
/**
*
* @package Board3 Portal testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../includes/functions_modules.php');

class phpbb_functions_functions_modules_test extends PHPUnit_Framework_TestCase
{
	public function data_column_num_string()
	{
		return array(
			array('', ''),
			array('', false),
			array('left', 1),
			array('center', 2),
			array('right', 3),
			array('top', 4),
			array('bottom', 5),
		);
	}

	/**
	* @dataProvider data_column_num_string
	*/
	public function test_column_num_string($expected, $input)
	{
		$this->assertEquals($expected, column_num_string($input));
	}

	public function data_column_string_num()
	{
		return array(
			array(0, ''),
			array(0, false),
			array(1, 'left'),
			array(2, 'center'),
			array(3, 'right'),
			array(4, 'top'),
			array(5, 'bottom'),
		);
	}

	/**
	* @dataProvider data_column_string_num
	*/
	public function test_column_string_num($expected, $input)
	{
		$this->assertEquals($expected, column_string_num($input));
	}

	public function data_column_string_const()
	{
		return array(
			array(0, ''),
			array(0, ''),
			array(2, 'left'),
			array(4, 'center'),
			array(8, 'right'),
			array(1, 'top'),
			array(16, 'bottom'),
		);
	}

	/**
	* @dataProvider data_column_string_const
	*/
	public function test_column_string_const($expected, $input)
	{
		$this->assertEquals($expected, column_string_const($input));
	}
}
