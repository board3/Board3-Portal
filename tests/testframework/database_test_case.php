<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\testframework;

abstract class database_test_case extends \phpbb_database_test_case
{
	static protected function setup_extensions()
	{
		return array('board3/portal');
	}

	protected $db;

	public function setUp()
	{
		parent::setUp();
		global $db;
		$db = $this->db = $this->new_dbal();
	}
}
