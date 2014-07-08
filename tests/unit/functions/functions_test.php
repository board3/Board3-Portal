<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../includes/functions.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/utf/utf_tools.php');

class phpbb_unit_functions_functions_test extends \board3\portal\tests\testframework\database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/styles.xml');
	}

	public function data_sql_table_exists()
	{
		return array(
			array(true, 'phpbb_config'),
			array(true, 'phpbb_styles'),
			array(false, 'phpbb_foobar'),
		);
	}

	/**
	* @dataProvider data_sql_table_exists
	*/
	public function test_sql_table_exists($expected, $table)
	{
		$this->assertEquals($expected, sql_table_exists($table));
	}

	public function data_character_limit()
	{
		return array(
			array('test', 'test', 5),
			array('foooo...', 'foooooooooobar', 5),
			array('wee', 'wee disallowed_word', 5),
		);
	}

	/**
	* @dataProvider data_character_limit
	*/
	public function test_character_limit($expected, $input, $length)
	{
		$this->markTestIncomplete('Cannot test this due to issues with censor_text() and truncate_string()');
		$this->assertSame($expected, character_limit($input, $length));
	}
}
