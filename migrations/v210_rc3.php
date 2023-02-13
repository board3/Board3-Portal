<?php
/**
*
* @package Board3 Portal v2.3
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace board3\portal\migrations;

class v210_rc3 extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return array('\board3\portal\migrations\v210_rc2');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('board3_portal_version', '2.1.0-rc3')),
			array('config.add', array('board3_show_all_pages', 0)),
			array('config.add', array('board3_show_all_side', 0)),
		);
	}
}
