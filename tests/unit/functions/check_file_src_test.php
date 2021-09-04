<?php
/**
*
* @package Board3 Portal Testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../../../../includes/functions_acp.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/functions.php');

class phpbb_functions_check_file_src_test extends \board3\portal\tests\testframework\database_test_case
{
	public function setUp(): void
	{
		global $phpbb_root_path, $portal_root_path;

		parent::setUp();

		global $user;
		$language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$language = new \board3\portal\tests\mock\language($language_file_loader);
		$language->set([
			'B3P_FILE_NOT_FOUND'		=> 'B3P_FILE_NOT_FOUND',
		]);
		$user = new \phpbb\user($language, '\phpbb\datetime');

		$portal_root_path = $phpbb_root_path . 'ext/board3/portal/';
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/styles.xml');
	}

	public function test_check_file_src()
	{
		$this->assertFalse(check_file_src('portal_attach.png', '', 15, false));
		$this->assertEquals('B3P_FILE_NOT_FOUND: styles/all/theme/images/portal/portal_foobar.png<br />', check_file_src('portal_foobar.png', '', 15, false));
	}

	public function test_check_file_src_error()
	{
		global $phpbb_dispatcher;

		$phpbb_dispatcher = new phpbb_mock_event_dispatcher;
		$this->setExpectedTriggerError(E_USER_WARNING);
		$this->assertEquals(': styles/all/theme/images/portal/portal_foobar.png<br />', check_file_src('portal_foobar.png', '', 15));
	}
}
