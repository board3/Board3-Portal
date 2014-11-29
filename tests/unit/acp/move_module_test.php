<?php
/**
*
* @package testing
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\portal\modules;

require_once(dirname(__FILE__) . '/../../../includes/functions.php');
require_once(dirname(__FILE__) . '/../../../acp/portal_module.php');

class phpbb_acp_move_module_test extends \board3\portal\tests\testframework\database_test_case
{
	static public $redirected = false;
	static public $error = false;
	static public $override_trigger_error = false;
	static public $error_type = E_USER_NOTICE;

	/** @var \board3\portal\portal\modules\manager */
	protected $modules_manager;

	/** @var \board3\portal\portal\columns */
	protected $portal_columns;

	public function setUp()
	{
		parent::setUp();
		global $db, $cache, $phpbb_root_path, $phpEx, $user, $phpbb_container, $request, $template, $table_prefix;
		$user = new \board3\portal\tests\mock\user();
		$request = new \phpbb_mock_request;
		$phpbb_container = new \phpbb_mock_container_builder();
		// Mock version check
		$phpbb_container->set('board3.portal.version.check',
			$this->getMockBuilder('\board3\portal\includes\version_check')
				->disableOriginalConstructor()
				->getMock());
		// Mock module service collection
		$config = new \phpbb\config\config(array());
		$phpbb_container->set('board3.portal.module_collection',
			array(
				new \board3\portal\modules\clock($config, $template),
				new \board3\portal\modules\birthday_list($config, $template, $this->db, $user),
				new \board3\portal\modules\welcome($config, new \phpbb_mock_request, $this->db, $user, $phpbb_root_path, $phpEx),
				new \board3\portal\modules\donation($config, $template, $user),
			));
		$portal_helper = new \board3\portal\includes\helper($phpbb_container->get('board3.portal.module_collection'));
		$phpbb_container->set('board3.portal.helper', $portal_helper);
		$phpbb_container->set('board3.portal.modules_helper', new \board3\portal\includes\modules_helper(new \phpbb\auth\auth(), $config, $request));
		$phpbb_container->setParameter('board3.portal.modules.table', $table_prefix . 'portal_modules');
		$phpbb_container->setParameter('board3.portal.config.table', $table_prefix . 'portal_config');
		$this->portal_columns = new \board3\portal\portal\columns();
		$phpbb_container->set('board3.portal.columns', $this->portal_columns);
		$cache = $this->getMock('\phpbb\cache\cache', array('destroy', 'sql_exists', 'get', 'put'));
		$cache->expects($this->any())
			->method('destroy')
			->with($this->equalTo('portal_modules'));
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
		$db = $this->db;
		$user->set(array(
			'UNABLE_TO_MOVE'	=> 'UNABLE_TO_MOVE',
			'UNABLE_TO_MOVE_ROW'	=> 'UNABLE_TO_MOVE_ROW',
		));
		$this->database_handler = new \board3\portal\portal\modules\database_handler($db);
		$this->modules_manager = new \board3\portal\portal\modules\manager($cache, $db, $this->portal_columns, $portal_helper, $this->database_handler, $request, $user);
		$phpbb_container->set('board3.portal.modules.manager', $this->modules_manager);
		$this->portal_module = new \board3\portal\acp\portal_module();
		$this->update_portal_modules();
	}

	protected function update_portal_modules()
	{
		$this->modules_manager->module_column = array();
		$portal_modules = obtain_portal_modules();
		foreach($portal_modules as $cur_module)
		{
			$this->modules_manager->module_column[$cur_module['module_classname']][] = $this->portal_columns->number_to_string($cur_module['module_column']);
		}
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/modules.xml');
	}

	public function test_get_move_module_data()
	{
		$module_data = $this->modules_manager->get_move_module_data(1);
		$this->assertEquals(array(
			'module_order'		=> '1',
			'module_column'		=> '1',
			'module_classname'	=> '\board3\portal\modules\clock',
			'module_id' => '1',
			'module_name' => '',
			'module_image_src' => '',
			'module_image_width' => '0',
			'module_image_height' => '0',
			'module_group_ids' => '',
			'module_status' => '1',
		), $module_data);
	}

	public function data_get_last_module_order()
	{
		return array(
			array(3, 1),
			array(2, 2),
			array(2, 3),
			array(1, 4),
		);
	}

	/**
	* @dataProvider data_get_last_module_order
	*/
	public function test_get_last_module_order($expected, $column)
	{
		$this->assertEquals($expected, $this->modules_manager->get_last_module_order($column));
	}

	public function test_move_module_up()
	{
		self::$redirected = false;
		$this->modules_manager->move_module_vertical(2, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_UP);
		$this->assertTrue(self::$redirected);

		$this->setExpectedTriggerError(E_USER_NOTICE, 'UNABLE_TO_MOVE_ROW');
		self::$redirected = false;
		$this->modules_manager->move_module_vertical(2, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_UP);
		$this->assertFalse(self::$redirected);
	}

	public function test_move_module_down()
	{
		self::$redirected = false;
		$this->modules_manager->move_module_vertical(3, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_DOWN);
		$this->assertTrue(self::$redirected);

		$this->setExpectedTriggerError(E_USER_NOTICE, 'UNABLE_TO_MOVE_ROW');
		self::$redirected = false;
		$this->modules_manager->move_module_vertical(3, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_DOWN);
		$this->assertFalse(self::$redirected);
	}

	public function data_handle_after_move()
	{
		return array(
			array(true, false, false),
			array(false, false, 'UNABLE_TO_MOVE'),
			array(false, true, 'UNABLE_TO_MOVE_ROW'),
		);
	}

	/**
	* @dataProvider data_handle_after_move
	*/
	public function test_handle_after_move($success, $is_row, $error)
	{
		if ($error)
		{
			$this->setExpectedTriggerError(E_USER_NOTICE, $error);
		}
		else
		{
			self::$redirected = false;
		}

		$this->modules_manager->handle_after_move($success, $is_row);

		if (!$error)
		{
			$this->assertTrue(self::$redirected);
		}
	}

	public function data_move_module_right()
	{
		return array(
			array(6, 1, 2),
			array(6, 1, 1, 2),
			array(7, 4, 0),
			array(5, 2, 0),
			array(1, 1, 1, 3),
			array(2, 2, 0),
		);
	}

	/**
	* @dataProvider data_move_module_right
	*/
	public function test_move_module_right($module_id, $column_start, $move_right, $add_to_column = false)
	{
		if ($column_start > 3)
		{
			$this->setExpectedTriggerError(E_USER_ERROR, 'CLASS_NOT_FOUND');
			$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_RIGHT);
			return;
		}

		if ($add_to_column)
		{
			$module_data = $this->modules_manager->get_move_module_data($module_id);
			$this->modules_manager->module_column[$module_data['module_classname']][] = $this->portal_columns->number_to_string($add_to_column);
		}

		for ($i = 1; $i <= $move_right; $i++)
		{
			$data = $this->modules_manager->get_move_module_data($module_id);
			$this->assertEquals($column_start, $data['module_column']);
			$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_RIGHT);
			$column_start++;
			$this->update_portal_modules();
		}
		$this->setExpectedTriggerError(E_USER_NOTICE, 'UNABLE_TO_MOVE');
		$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_RIGHT);
	}

	public function data_move_module_left()
	{
		return array(
			array(1, 1, 1, 1),
			array(6, 1, 2, 2),
			array(5, 2, 0, 0),
			array(6, 1, 2, 1, 2),
			array(7, 4, 0, 0),
			array(2, 2, 0, 0, 1),
		);
	}

	/**
	* @dataProvider data_move_module_left
	*/
	public function test_move_module_left($module_id, $column_start, $move_right, $move_left, $add_to_column = false)
	{
		if ($column_start > 3)
		{
			$this->setExpectedTriggerError(E_USER_ERROR, 'CLASS_NOT_FOUND');
			$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_LEFT);
			return;
		}

		for ($i = 1; $i <= $move_right; $i++)
		{
			$data = $this->modules_manager->get_move_module_data($module_id);
			$this->assertEquals($column_start, $data['module_column']);
			$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_RIGHT);
			$this->update_portal_modules();
			$column_start++;
		}

		if ($add_to_column)
		{
			$module_data = $this->modules_manager->get_move_module_data($module_id);
			$this->modules_manager->module_column[$module_data['module_classname']][] = $this->portal_columns->number_to_string($add_to_column);
		}

		// We always start in the right column = 3
		$column_start = 3;
		for ($i = 1; $i <= $move_left; $i++)
		{
			$data = $this->modules_manager->get_move_module_data($module_id);
			$this->assertEquals($column_start, $data['module_column']);
			$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_LEFT);
			$this->update_portal_modules();
			$column_start--;
		}
		$this->setExpectedTriggerError(E_USER_NOTICE, 'UNABLE_TO_MOVE');
		$this->modules_manager->move_module_horizontal($module_id, \board3\portal\portal\modules\database_handler::MOVE_DIRECTION_LEFT);
	}

	public function data_can_move_module()
	{
		return array(
			array(false, 'left', '\board3\portal\modules\clock'),
			array(false, 'right', '\board3\portal\modules\clock'),
			array(true, 'center', '\board3\portal\modules\clock'),
			array(true, array('top', 'bottom', 'center'), '\board3\portal\modules\clock'),
			array(false, array('left', 'right'), '\board3\portal\modules\clock'),
			array(false, 'center', '\board3\portal\modules\birthday_list'),
		);
	}

	/**
	* @dataProvider data_can_move_module
	*/
	public function test_can_move_module($expected, $target_column, $module_class)
	{
		$this->update_portal_modules();
		$this->assertEquals($expected, $this->modules_manager->can_move_module($target_column, $module_class));
	}
}

function redirect($url)
{
	phpbb_acp_move_module_test::$redirected = true;
}

function adm_back_link($url)
{
	return $url;
}

function trigger_error($input, $type = E_USER_NOTICE)
{
	if (!phpbb_acp_move_module_test::$override_trigger_error)
	{
		\trigger_error($input, $type);
	}
	phpbb_acp_move_module_test::$error = $input;
	phpbb_acp_move_module_test::$error_type = $type;
}
