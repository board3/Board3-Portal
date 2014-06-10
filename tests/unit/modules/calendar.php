<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../includes/functions.php');

class phpbb_functions_simple_test extends \board3\portal\tests\testframework\test_case
{
	protected $path_helper;
	protected $calendar;

	public function setUp()
	{
		parent::setUp();
		global $phpbb_root_path;

		$this->path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$phpbb_root_path,
			'php'
		);
		$this->calendar = new \board3\portal\modules\calendar(array(), null, null, null, dirname(__FILE__) . '/../../../', 'php', null, $this->path_helper);
		$this->offset = strtotime('17.06.1990') - 645580800;
	}

	public function data_date_to_time()
	{
		return array(
			array(1402855200, '2014-06-15 18:00'),
			array(1402855200, '15.06.2014 18:00'),
			array(1402855200, '06/15/2014 6:00 PM'),
			array(false, '15/06'),
		);
	}

	/**
	* @dataProvider data_date_to_time
	*/
	public function test_date_to_time($expected, $date)
	{
		$this->assertEquals($expected, $this->calendar->date_to_time($date) + $this->offset);
	}

}
