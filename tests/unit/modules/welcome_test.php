<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

require_once dirname(__FILE__) . '/../../mock/check_form_key.php';

class phpbb_unit_modules_welcome_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $path_helper;

	/** @var \board3\portal\modules\welcome */
	protected $welcome;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \board3\portal\tests\mock\template */
	protected $template;

	/** @var \phpbb_mock_request */
	protected $request;

	protected $expected_config = array();
	protected $expected_portal_config = array();

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/configs.xml');
	}

	public function setUp()
	{
		parent::setUp();
		global $cache, $phpbb_root_path, $phpEx, $phpbb_dispatcher, $request, $config, $phpbb_container, $user;

		$config = $this->config = new \phpbb\config\config(array('allowed_schemes_links' => 'http,https,ftp'));
		$this->request = new \phpbb_mock_request();
		$request = $this->request;
		$this->template = new \board3\portal\tests\mock\template($this);
		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);
		$this->user = new \phpbb\user($this->language, '\phpbb\datetime');
		$user = $this->user;
		$cache = $this->getMock('\phpbb\cache\cache', array('destroy', 'sql_exists', 'get', 'put', 'sql_load'));
		$cache->expects($this->any())
			->method('destroy')
			->with($this->equalTo('portal_config'));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
		$cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything());
		$cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything())
			->will($this->returnValue(false));
		$cache->expects($this->any())
			->method('put')
			->with($this->anything());
		$phpbb_dispatcher = $this->getMockBuilder('\phpbb\event\dispatcher')
			->disableOriginalConstructor()
			->getMock();
		$phpbb_dispatcher->expects($this->any())
			->method('trigger_event')
			->with($this->anything())
			->will($this->returnArgument(1));
		$phpbb_container = new \phpbb_mock_container_builder();
		$s9e_factory = new \phpbb\textformatter\s9e\factory(
			new \phpbb\textformatter\data_access($this->db, BBCODES_TABLE, SMILIES_TABLE, STYLES_TABLE, WORDS_TABLE, $phpbb_root_path . 'styles/'),
			new \phpbb\cache\driver\dummy(),
			$phpbb_dispatcher,
			$config,
			new \phpbb\textformatter\s9e\link_helper(),
			$phpbb_root_path . 'cache',
			'_text_formatter_parser',
			'_text_formatter_renderer'
		);
		$phpbb_container->set(
			'text_formatter.parser',
			new \phpbb\textformatter\s9e\parser(
				new \phpbb\cache\driver\dummy(),
				'_text_formatter_parser',
				$s9e_factory,
				$phpbb_dispatcher
			)
		);
		$phpbb_container->set(
			'text_formatter.renderer',
			new \phpbb\textformatter\s9e\renderer(
				new \phpbb\cache\driver\dummy(),
				$phpbb_root_path . 'cache',
				'_text_formatter_renderer',
				$s9e_factory,
				$phpbb_dispatcher
			)
		);

		$this->welcome = new \board3\portal\modules\welcome($this->config, $this->request, $this->template, $this->user, $phpbb_root_path, $phpEx);
		\set_config('foobar', 0, false, $this->config);
		$this->config->delete('foobar');
		check_form_key::$form_key_valid = false;
	}

	public function test_get_template_center()
	{
		\set_portal_config('board3_welcome_message_' . 5, 'Welcome to my Community!');
		$this->config['board3_welcome_message_uid_' . 5] = '';
		$this->config['board3_welcome_message_bitfield_' . 5] = '';
		$return = $this->welcome->get_template_center(5);
		$this->assertEquals('welcome_center.html', $return);
		$this->template->assert_same('Welcome to my Community!', 'PORTAL_WELCOME_MSG');
	}

	public function test_get_template_acp()
	{
		$acp_template = $this->welcome->get_template_acp(5);
		$this->assertNotEmpty($acp_template);
		$this->assertArrayHasKey('board3_welcome_message_5', $acp_template['vars']);
	}

	public function test_install()
	{
		$this->assertTrue($this->welcome->install(1));

		foreach ($this->config as $key => $value)
		{
			$this->expected_config[$key] = $value;
		}

		$portal_config = obtain_portal_config();

		foreach ($portal_config as $key => $value)
		{
			$this->expected_portal_config[$key] = $value;
		}
	}

	/**
	* @dependsOn test_install
	*/
	public function test_uninstall()
	{
		$this->assertNotEmpty($this->welcome->uninstall(1, $this->db));

		foreach ($this->expected_config as $key => $value)
		{
			$this->assertFalse(isset($this->config[$key]));
		}

		$portal_config = obtain_portal_config();

		foreach ($this->expected_config as $key => $value)
		{
			$this->assertFalse(isset($portal_config[$key]));
		}
	}

	public function test_update_welcome()
	{
		$this->welcome->update_welcome('foobar', 5);
		$this->template->assert_same(true, 'S_EDIT');
		$this->request->overwrite('preview', true, \phpbb\request\request_interface::POST);
		$this->request->overwrite('welcome_message', 'foobar101');
		$this->welcome->update_welcome('foobar', 5);
		$this->template->assert_same(true, 'S_PREVIEW');
		$this->template->assert_same('foobar101', 'PREVIEW_TEXT');

		$this->request = new \phpbb_mock_request();
		$this->welcome = new \board3\portal\modules\welcome($this->config, $this->request, $this->template, $this->user, '', '');
		$this->request->overwrite('submit', true, \phpbb\request\request_interface::POST);
		check_form_key::$form_key_valid = true;
		$this->request->overwrite('welcome_message', 'foobar101');
		$this->welcome->update_welcome('foobar', 5);
		check_form_key::$form_key_valid = false;
	}

	public function test_update_welcome_invalid_form_key()
	{
		$this->request = new \phpbb_mock_request();
		$this->welcome = new \board3\portal\modules\welcome($this->config, $this->request, $this->template, $this->user, '', '');
		$this->request->overwrite('submit', true, \phpbb\request\request_interface::POST);
		$this->request->overwrite('welcome_message', 'foobar101');
		$this->setExpectedTriggerError(E_USER_WARNING);
		$this->welcome->update_welcome('foobar', 5);
	}

	public function test_update_welcome_empty_message()
	{
		$this->request = new \phpbb_mock_request();
		$this->welcome = new \board3\portal\modules\welcome($this->config, $this->request, $this->template, $this->user, '', '');
		$this->request->overwrite('submit', true, \phpbb\request\request_interface::POST);
		$this->request->overwrite('welcome_message', '');
		$this->setExpectedTriggerError(E_USER_WARNING);
		check_form_key::$form_key_valid = true;
		$this->welcome->update_welcome('foobar', 5);
	}
}
