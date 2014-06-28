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
		$this->assertSame($expected, character_limit($input, $length));
	}
}

function censor_text($text)
{
	$text = trim(str_replace('disallowed_word', '', $text));
	return $text;
}

/**
* Truncates string while retaining special characters if going over the max length
* The default max length is 60 at the moment
* The maximum storage length is there to fit the string within the given length. The string may be further truncated due to html entities.
* For example: string given is 'a "quote"' (length: 9), would be a stored as 'a &quot;quote&quot;' (length: 19)
*
* @param string $string The text to truncate to the given length. String is specialchared.
* @param int $max_length Maximum length of string (multibyte character count as 1 char / Html entity count as 1 char)
* @param int $max_store_length Maximum character length of string (multibyte character count as 1 char / Html entity count as entity chars).
* @param bool $allow_reply Allow Re: in front of string
* 	NOTE: This parameter can cause undesired behavior (returning strings longer than $max_store_length) and is deprecated.
* @param string $append String to be appended
*/
function truncate_string($string, $max_length = 60, $max_store_length = 255, $allow_reply = false, $append = '')
{
	$chars = array();

	$strip_reply = false;
	$stripped = false;
	if ($allow_reply && strpos($string, 'Re: ') === 0)
	{
		$strip_reply = true;
		$string = substr($string, 4);
	}

	$_chars = utf8_str_split(htmlspecialchars_decode($string));
	$chars = array_map('utf8_htmlspecialchars', $_chars);

	// Now check the length ;)
	if (sizeof($chars) > $max_length)
	{
		// Cut off the last elements from the array
		$string = implode('', array_slice($chars, 0, $max_length - utf8_strlen($append)));
		$stripped = true;
	}

	// Due to specialchars, we may not be able to store the string...
	if (utf8_strlen($string) > $max_store_length)
	{
		// let's split again, we do not want half-baked strings where entities are split
		$_chars = utf8_str_split(htmlspecialchars_decode($string));
		$chars = array_map('utf8_htmlspecialchars', $_chars);

		do
		{
			array_pop($chars);
			$string = implode('', $chars);
		}
		while (!empty($chars) && utf8_strlen($string) > $max_store_length);
	}

	if ($strip_reply)
	{
		$string = 'Re: ' . $string;
	}

	if ($append != '' && $stripped)
	{
		$string = $string . $append;
	}

	return $string;
}
