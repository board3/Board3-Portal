<?php
/**
 *
 * @package Board3 Portal Testing
 * @copyright (c) Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

class board3_portal_columns_test extends \board3\portal\tests\testframework\test_case
{
	protected $portal_columns;

	public function setUp()
	{
		parent::setUp();

		$this->portal_columns = new \board3\portal\portal\columns();
	}
	public function data_column_number_string()
	{
		return array(
			array(4, 'top'),
			array(1, 'left'),
			array(2, 'center'),
			array(3, 'right'),
			array(5, 'bottom'),
			array(0, ''),
		);
	}

	/**
	 * @dataProvider data_column_number_string
	 */
	public function test_number_to_string($number, $string)
	{
		$this->assertEquals($string, $this->portal_columns->number_to_string($number));
	}

	/**
	 * @dataProvider data_column_number_string
	 */
	public function test_string_to_number($number, $string)
	{
		$this->assertEquals($number, $this->portal_columns->string_to_number($string));
	}

	public function data_column_string_constant()
	{
		return array(
			array('top', 1),
			array('left', 2),
			array('center', 4),
			array('right', 8),
			array('bottom', 16),
			array('', 0),
		);
	}

	/**
	 * @dataProvider data_column_string_constant
	 */
	public function test_string_to_constant($string, $constant)
	{
		$this->assertEquals($constant, $this->portal_columns->string_to_constant($string));
	}
}