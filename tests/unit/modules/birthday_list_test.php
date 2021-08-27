<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

class phpbb_unit_modules_birthday_list_test extends \board3\portal\tests\testframework\database_test_case
{
	/** @var \board3\portal\tests\mock\template */
	protected $template;

	/** @var \board3\portal\modules\birthday_list */
	protected $birthday_list;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/users.xml');
	}

	public function setUp(): void
	{
		global $auth, $phpbb_dispatcher, $phpbb_root_path;

		parent::setUp();

		$this->template = new \board3\portal\tests\mock\template($this);
		$this->config = new \phpbb\config\config(array());
		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);
		$this->user = new \phpbb\user($this->language, '\phpbb\datetime');
		$this->user->timezone = new \DateTimeZone('UTC');
		$this->user->add_lang('common');
		$this->birthday_list = new \board3\portal\modules\birthday_list($this->config, $this->template, $this->new_dbal(), $this->user);
		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->setMethods(['acl_get'])
			->getMock();
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->anything())
			->will($this->returnValue(true));
		$phpbb_dispatcher = $this->getMockBuilder('\phpbb\event\dispatcher')
			->disableOriginalConstructor()
			->getMock();
		$phpbb_dispatcher->expects($this->any())
			->method('trigger_event')
			->with($this->anything())
			->will($this->returnArgument(1));
	}

	public function test_get_template_side()
	{
		$this->assertSame('birthdays_side.html', $this->birthday_list->get_template_side(5));
		$this->template->assert_same('', 'BIRTHDAY_LIST');
		$this->config->set('allow_birthdays', true);
		$this->config->set('load_birthdays', true);
		$this->config->set('board3_birthdays_ahead_5', 5);
		$sql_ary = array(
			array(
				'username'			=> 'foobar',
				'username_clean'	=> 'foobar',
				'user_birthday'		=> preg_replace('/([0-9]+)-([0-9])-([0-9]+)/', '$1- $2-$3', date('d-n-Y', time())),
				'user_id'			=> 2,
				'user_permissions'	=> '',
				'user_sig'			=> '',
				'user_type'			=> USER_NORMAL,
			),
			array(
				'username'			=> 'foobar2',
				'username_clean'	=> 'foobar2',
				'user_birthday'		=> preg_replace('/([0-9]+)-([0-9])-([0-9]+)/', '$1- $2-$3', date('d-n-Y',  time() + 86400 * 3)),
				'user_id'			=> 3,
				'user_permissions'	=> '',
				'user_sig'			=> '',
				'user_type'			=> USER_NORMAL,
			),
		);
		$this->db->sql_multi_insert(USERS_TABLE, $sql_ary);
		$this->assertSame('birthdays_side.html', $this->birthday_list->get_template_side(5));
	}

	public function test_get_template_acp()
	{
		$acp_template = $this->birthday_list->get_template_acp(5);
		$this->assertArrayHasKey('title', $acp_template);
		$this->assertArrayHasKey('vars', $acp_template);
		$this->assertArrayHasKey('board3_birthdays_ahead_5', $acp_template['vars']);
	}

	public function test_install_uninstall()
	{
		$this->assertFalse(isset($this->config['board3_birthdays_ahead_5']));
		$this->assertTrue($this->birthday_list->install(5));
		$this->assertTrue(isset($this->config['board3_birthdays_ahead_5']));
		$this->assertTrue($this->birthday_list->uninstall(5, $this->db));
		$this->assertFalse(isset($this->config['board3_birthdays_ahead_5']));
	}

}
