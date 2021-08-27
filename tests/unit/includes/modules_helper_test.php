<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once dirname(__FILE__) . '/../../../../../../includes/functions_admin.php';

class board3_includes_modules_helper_test extends \board3\portal\tests\testframework\database_test_case
{
	/** @var \board3\portal\includes\modules_helper */
	protected $modules_helper;

	protected $modules;

	/** @var \phpbb\config\config */
	protected $config;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/auth.xml');
	}

	public function setUp(): void
	{
		global $phpbb_root_path, $phpEx, $phpbb_dispatcher;

		parent::setUp();

		$auth = new \phpbb\auth\auth();
		$this->config = new \phpbb\config\config(array());
		$request = new \phpbb_mock_request(array('foo' => array('bar')));
		$controller_helper = new \board3\portal\tests\mock\controller_helper($phpbb_root_path, $phpEx);
		$controller_helper->add_route('board3_portal_controller', 'portal');
		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_dispatcher = $this->getMockBuilder('\phpbb\event\dispatcher')
			->setMethods(['trigger_event'])
			->getMock();
		$phpbb_dispatcher->expects($this->any())
			->method('trigger_event')
			->with($this->anything())
			->will($this->returnArgument(1));

		$this->modules_helper = new \board3\portal\includes\modules_helper($auth, $this->config, $controller_helper, $request);
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
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
			array('<select id="foobar" name="foobar"><option value="one">one</option><option value="two" selected="selected">two</option></select>',
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
			array('<select id="foobar" name="foobar"><option value="one" selected="selected">two</option><option value="two">three</option></select>',
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
			array('<select id="foobar" name="foobar[]" multiple="multiple"><option value="one" selected="selected">two</option><option value="two" selected="selected">three</option></select>',
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
				array('one', 'two'),
				true),
		);
	}

	/**
	* @dataProvider data_generate_select_box
	*/
	public function test_generate_select_box($expected, $key, $select_ary, $selected_options, $multiple = false)
	{
		$this->assertEquals($expected, $this->modules_helper->generate_select_box($key, $select_ary, $selected_options, $multiple));
	}

	public function test_generate_forum_select()
	{
		$this->assertEquals(
			'<select id="bar" name="bar[]" multiple="multiple"><option value="1" disabled="disabled" class="disabled-option">forum_one</option><option value="2" disabled="disabled" class="disabled-option">forum_two</option></select>',
			$this->modules_helper->generate_forum_select('foo', 'bar')
		);
		$this->config->set('bar', '1,2');
		$this->assertEquals(
			'<select id="bar" name="bar[]" multiple="multiple"><option value="1" selected="selected" disabled="disabled" class="disabled-option">forum_one</option><option value="2" selected="selected" disabled="disabled" class="disabled-option">forum_two</option></select>',
			$this->modules_helper->generate_forum_select('foo', 'bar')
		);
	}

	public function test_store_selected_forums()
	{
		$this->assertEmpty($this->config['foo']);
		$this->modules_helper->store_selected_forums('foo');
		$this->assertEquals('bar', $this->config['foo']);
	}

	public function test_store_left_right()
	{
		$this->assertEmpty($this->config['store_left_right']);
		$this->modules_helper->store_left_right('store_left_right');
		$this->assertEquals(0, $this->config['store_left_right']);
	}
}
