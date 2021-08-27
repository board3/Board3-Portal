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

	/** @var \board3\portal\portal\modules\constraints_handler */
	protected $constraints_handler;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \board3\portal\controller\helper */
	protected $b3p_controller_helper;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/../acp/fixtures/modules.xml');
	}

	public function setUp(): void
	{
		global $cache, $db, $portal_config, $phpbb_root_path, $phpEx;

		parent::setUp();

		$user = new \board3\portal\tests\mock\user();
		$request =new \phpbb_mock_request();
		$this->request = $request;
		$this->user = $user;
		$auth = new \phpbb\auth\auth();

		$config = new \phpbb\config\config(array());

		$controller_helper = new \board3\portal\tests\mock\controller_helper($phpbb_root_path, $phpEx);
		$controller_helper->add_route('board3_portal_controller', 'portal');
		$modules_helper = new \board3\portal\includes\modules_helper($auth, $config, $controller_helper, $this->request);

		$this->portal_helper = new \board3\portal\includes\helper(array(
			new \board3\portal\modules\clock($config, null),
			new \board3\portal\modules\birthday_list($config, null, $this->db, $user),
			new \board3\portal\modules\welcome($config, new \phpbb_mock_request, $this->db, $user, $this->phpbb_root_path, $this->phpEx),
			new \board3\portal\modules\donation($config, $this->request, null, $user, $modules_helper),
		));

		$this->portal_columns = new \board3\portal\portal\columns();
		$this->cache = $this->getMockBuilder('\phpbb\cache\driver\dummy')
			->setMethods(['destroy', 'sql_exists', 'get', 'put', 'purge'])
			->getMock();
		$this->cache->expects($this->any())
			->method('destroy')
			->withConsecutive(array($this->equalTo('config')), array($this->equalTo('portal_config')));
		$this->cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
		$this->cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything());
		$this->cache->expects($this->any())
			->method('put')
			->with($this->anything());
		$this->cache->expects($this->any())
			->method('purge');
		$cache = $this->cache;
		$db = $this->db;
		$user->set(array(
			'UNABLE_TO_MOVE'	=> 'UNABLE_TO_MOVE',
			'UNABLE_TO_MOVE_ROW'	=> 'UNABLE_TO_MOVE_ROW',
			'SUCCESS_DELETE'		=> 'SUCCESS_DELETE',
		));

		$this->database_handler = new \board3\portal\portal\modules\database_handler($db);
		$this->constraints_handler = new \board3\portal\portal\modules\constraints_handler($this->portal_columns, $user);

		$this->path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem\filesystem(),
			new \phpbb_mock_request(),
			$phpbb_root_path,
			$phpEx
		);

		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);

		$this->b3p_controller_helper = new \board3\portal\controller\helper(
			new \phpbb\auth\auth(),
			$this->portal_columns,
			$config,
			$this->language,
			new \board3\portal\tests\mock\template($this),
			$user,
			$this->path_helper,
			$this->portal_helper,
			$phpbb_root_path,
			$phpEx
		);

		$this->modules_manager = new \board3\portal\portal\modules\manager($this->cache, $db, $this->b3p_controller_helper, $this->portal_columns, $this->portal_helper, $this->constraints_handler, $this->database_handler, $request, $user);
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
			'link'		=> 'adm/index.php?i=-foo-bar&amp;mode=config&amp;module_id=6',
		), self::$meta_refresh);
		$this->assertEquals(phpbb_acp_move_module_test::$error_type, E_USER_NOTICE);
		$this->assertEquals(phpbb_acp_move_module_test::$error, 'adm/index.php?i=15&amp;mode=foobar&amp;module_id=6');
		phpbb_acp_move_module_test::$override_trigger_error = false;
	}

	public function test_module_delete()
	{
		$this->cache = $this->getMockBuilder('\phpbb\cache\driver\dummy')
			->setMethods(['destroy', 'sql_exists', 'get', 'put', 'purge'])
			->getMock();
		$this->cache->expects($this->any())
			->method('destroy')
			->with($this->equalTo('sql'));
		$this->cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
		$this->cache->expects($this->any())
			->method('sql_exists')
			->with($this->anything());
		$this->cache->expects($this->any())
			->method('put')
			->with($this->anything());
		$this->cache->expects($this->any())
			->method('purge');
		$this->request->overwrite('module_classname', '\board3\portal\modules\donation');
		$this->modules_manager = new \board3\portal\portal\modules\manager($this->cache, $this->db, $this->b3p_controller_helper, $this->portal_columns, $this->portal_helper, $this->constraints_handler, $this->database_handler, $this->request, $this->user);
		$this->modules_manager->set_u_action('adm/index.php?i=15&amp;mode=foobar')->set_acp_class('foo\bar');

		// Trigger confirm box creation
		modules_manager_confirm_box_test::$confirm = false;
		$this->assertNull($this->modules_manager->module_delete(6, 'foobar', 'module_delete', 6));
		$this->assertEquals('<input type="hidden" name="i" value="6" />
<input type="hidden" name="mode" value="foobar" />
<input type="hidden" name="action" value="module_delete" />
<input type="hidden" name="module_id" value="6" />
<input type="hidden" name="module_classname" value="\board3\portal\modules\donation" />
', self::$hidden_fields);

		// Actually delete module
		phpbb_acp_move_module_test::$override_trigger_error = true;
		modules_manager_confirm_box_test::$confirm = true;
		$this->assertNull($this->modules_manager->module_delete(6, 'foobar', 'module_delete', 6));
		$this->assertEquals(E_USER_NOTICE, phpbb_acp_move_module_test::$error_type);
		$this->assertEquals('SUCCESS_DELETEadm/index.php?i=15&amp;mode=foobar', phpbb_acp_move_module_test::$error);
		phpbb_acp_move_module_test::$override_trigger_error = false;
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
