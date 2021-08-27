<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../../../../includes/utf/utf_tools.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/functions_content.php');

class phpbb_unit_functions_functions_test extends \board3\portal\tests\testframework\database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/styles.xml');
	}

	public function setUp(): void
	{
		global $cache, $user, $phpbb_root_path;

		parent::setUp();

		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);
		$user = $this->getMock('\phpbb\user', array('optionget'), array($this->language, '\phpbb\datetime'));
		$cache = $this->getMock('\phpbb\cache\cache', array('obtain_word_list', 'sql_exists'));
		$cache->expects($this->any())
			->method('obtain_word_list')
			->with()
			->will($this->returnValue(array('match' => array('/disallowed_word/'), 'replace' => array(''))));
	}

	public function data_character_limit()
	{
		return array(
			array('test', 'test', 5),
			array('foooo...', 'foooooooooobar', 5),
			array('wee d...', 'wee disallowed_word', 5),
			array('test', 'test', 0),
		);
	}

	/**
	* @dataProvider data_character_limit
	*/
	public function test_character_limit($expected, $input, $length)
	{
		$this->assertSame($expected, character_limit($input, $length));
	}
}
