<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\migrations;

class v210_rc1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\board3\portal\migrations\v210_beta1');
	}

	public function update_data()
	{
		return array(
			array('config.remove', array('board3_phpbb_menu')),
			array('config.update', array('board3_portal_version', '2.1.0-rc1')),
		);
	}
}
