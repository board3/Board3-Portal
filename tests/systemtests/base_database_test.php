<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace phpbbgallery\core\tests\systemtests;

class base_database_test extends \phpbbgallery\core\tests\testframework\database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/basetests.xml');
	}

	public function test_check()
	{
		$sql = 'SELECT session_user_id, album_name
			FROM phpbb_sessions s
			LEFT JOIN phpbb_gallery_albums a
				ON (s.session_album_id = a.album_id)';
		$result = $this->db->sql_query($sql);
		$this->assertEquals(array(
			array(
				'session_user_id'	=> 4,
				'album_name'		=> 'Testalbum',
			),
		), $this->db->sql_fetchrowset($result));
		$this->db->sql_freeresult($result);
	}
}
