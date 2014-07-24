<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/


class board3_includes_modules_helper_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $modules_helper;

	protected $modules;

	protected $config;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/auth.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$auth = new \phpbb\auth\auth();
		$this->config = new \phpbb\config\config(array());
		$request = new \phpbb_mock_request(array('foo' => array('bar')));

		$this->modules_helper = new \board3\portal\includes\modules_helper($auth, $this->config, $request);
	}

	public function data_get_disallowed_forums()
	{
		return array(
			array(array(), false),
			array(array(0 => 1, 1 => 2), true),
		);
	}

	/**
	* @dataProvider data_get_disallowed_forums
	*/
	public function test_get_disallowed_forums($expected, $input)
	{
		$this->assertEquals($expected, $this->modules_helper->get_disallowed_forums($input));
	}

	public function data_generate_select_box()
	{
		return array(
			array('<select id="foobar" name="foobar[]" multiple="multiple"><option value="one">one</option><option value="two" selected="selected">two</option></select>',
			'foobar',
			array(
				'1'	=> array(
					'value'	=> 'one',
					'title'	=> 'one',
				),
				'2'	=> array(
					'value'	=> 'two',
					'title'	=> 'two',
				),
			),
			array('two')),
			array('<select id="foobar" name="foobar[]" multiple="multiple"><option value="one" selected="selected">two</option><option value="two">three</option></select>',
			'foobar',
			array(
				'1'	=> array(
					'value'	=> 'one',
					'title'	=> 'two',
				),
				'2'	=> array(
					'value'	=> 'two',
					'title'	=> 'three',
				),
			),
			array('one')),
		);
	}

	/**
	* @dataProvider data_generate_select_box
	*/
	public function test_generate_select_box($expected, $key, $select_ary, $selected_options)
	{
		$this->assertEquals($expected, $this->modules_helper->generate_select_box($key, $select_ary, $selected_options));
	}

	public function test_generate_forum_select()
	{
		$this->assertEquals(
			'<select id="bar" name="bar[]" multiple="multiple"><option value="1" disabled="disabled" class="disabled-option">forum_one</option><option value="2" disabled="disabled" class="disabled-option">forum_two</option></select>',
			$this->modules_helper->generate_forum_select('foo', 'bar')
		);
	}

	public function test_store_selected_forums()
	{
		$this->assertEmpty($this->config['foo']);
		$this->modules_helper->store_selected_forums('foo');
		$this->assertEquals('bar', $this->config['foo']);
	}
}
