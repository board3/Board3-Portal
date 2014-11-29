<?php
/**
 *
 * @package Board3 Portal Testing
 * @copyright (c) Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\portal\modules;

class modules_manager_confirm_box_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $portal_columns;
	static public $is_ajax = false;
	static public $confirm = false;
	static public $confirm_text = '';
	static public $hidden_fields = array();
	static public $meta_refresh = array();
	static public $trigger_text = '';
	static public $trigger_type = '';

	/** @var \board3\portal\portal\modules\manager */
	protected $modules_manager;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/../acp/fixtures/modules.xml');
	}

	public function setUp()
	{
		global $cache, $db, $portal_config;

		parent::setUp();

		$user = new \board3\portal\tests\mock\user();
		$request =new \phpbb_mock_request();

		$config = new \phpbb\config\config(array());

		$portal_helper = new \board3\portal\includes\helper(array(
			new \board3\portal\modules\clock($config, null),
			new \board3\portal\modules\birthday_list($config, null, $this->db, $user),
			new \board3\portal\modules\welcome($config, new \phpbb_mock_request, $this->db, $user, $this->phpbb_root_path, $this->phpEx),
			new \board3\portal\modules\donation($config, null, $user),
		));

		$this->portal_columns = new \board3\portal\portal\columns();
		$cache = $this->getMock('\phpbb\cache\cache', array('destroy', 'sql_exists', 'get', 'put', 'purge'));
		$cache->expects($this->any())
			->method('destroy')
			->withConsecutive(array($this->equalTo('config')), array($this->equalTo('portal_config')));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
		$cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything());
		$cache->expects($this->any())
			->method('put')
			->with($this->anything());
		$cache->expects($this->any())
			->method('purge');
		$db = $this->db;
		$user->set(array(
			'UNABLE_TO_MOVE'	=> 'UNABLE_TO_MOVE',
			'UNABLE_TO_MOVE_ROW'	=> 'UNABLE_TO_MOVE_ROW',
		));

		$this->database_handler = new \board3\portal\portal\modules\database_handler($db);
		$this->modules_manager = new \board3\portal\portal\modules\manager($cache, $db, $this->portal_columns, $portal_helper, $this->database_handler, $request, $user);
		$portal_config = array();
	}

	public function test_reset_module()
	{
		// Build confirm box first
		$this->modules_manager->set_u_action('adm/index.php?i=15&amp;mode=foobar')->set_acp_class('foo\bar');
		self::$confirm = false;
		$this->assertNull($this->modules_manager->reset_module(15, 'barfoo', 6, array()));
		$this->assertEquals('<input type="hidden" name="i" value="15" />
<input type="hidden" name="mode" value="barfoo" />
<input type="hidden" name="module_reset" value="1" />
<input type="hidden" name="module_id" value="6" />
', self::$hidden_fields);

		// Actually reset module
		phpbb_acp_move_module_test::$override_trigger_error = true;
		self::$confirm = true;
		$this->assertNull($this->modules_manager->reset_module(15, 'barfoo', 6, array()));
		$this->assertEquals(array(
			'seconds'	=> 3,
			'link'		=> 'adm/index.php?i=%5Cfoo%5Cbar&amp;mode=config&amp;module_id=6',
		), self::$meta_refresh);
		$this->assertEquals(phpbb_acp_move_module_test::$error_type, E_USER_NOTICE);
		$this->assertEquals(phpbb_acp_move_module_test::$error, 'adm/index.php?i=15&amp;mode=foobar&amp;module_id=6');
	}
}

function confirm_box($check, $text = '', $hidden_fields = '')
{
	modules_manager_confirm_box_test::$confirm_text = $text;
	modules_manager_confirm_box_test::$hidden_fields = $hidden_fields;
	return modules_manager_confirm_box_test::$confirm;
}

function meta_refresh($seconds, $link)
{
	modules_manager_confirm_box_test::$meta_refresh = array(
		'seconds'	=> $seconds,
		'link'		=> $link,
	);
}
