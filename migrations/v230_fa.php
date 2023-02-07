<?php

/**
* @package Board3 Portal v2.3
* @copyright 2021 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace board3\portal\migrations;

use phpbb\db\migration\migration;

class v230_fa extends migration
{
	public static function depends_on(): array
	{
		return ['\board3\portal\migrations\v210'];
	}

	public function update_schema(): array
	{
		return [
			'add_columns' => [
				$this->table_prefix . 'portal_modules' => [
					'module_fa_icon' => ['VCHAR', ''],
					'module_fa_size' => ['INT:1', 16],
				],
			],
		];
	}

	public function update_data(): array
	{
		return [
			['config.add', ['board3_portal_fa_styles', '']],
			['custom', [[$this, 'insert_defaults']]],
		];
	}

	public function insert_defaults()
	{
		$fa_icons = [
			'\board3\portal\modules\main_menu'		=> 'fa-bars',
			'\board3\portal\modules\stylechanger'	=> 'fa-paint-brush',
			'\board3\portal\modules\birthday_list'	=> 'fa-birthday-cake',
			'\board3\portal\modules\clock'			=> 'fa-clock-o',
			'\board3\portal\modules\search'			=> 'fa-search',
			'\board3\portal\modules\attachments'	=> 'fa-paperclip',
			'\board3\portal\modules\topposters'		=> 'fa-pencil-square-o',
			'\board3\portal\modules\latest_members'	=> 'fa-users',
			'\board3\portal\modules\link_us'		=> 'fa-external-link',
			'\board3\portal\modules\user_menu'		=> 'fa-user',
			'\board3\portal\modules\statistics'		=> 'fa-bar-chart',
			'\board3\portal\modules\calendar'		=> 'fa-calendar',
			'\board3\portal\modules\leaders'		=> 'fa-users',
			'\board3\portal\modules\latest_bots'	=> 'fa-android',
			'\board3\portal\modules\links'	=> 'fa-link',
		];
		foreach ($fa_icons as $key => $value)
		{
			$query = 'UPDATE ' . $this->table_prefix . "portal_modules
				SET module_fa_icon = '" . $value . "'
				WHERE module_classname = '" . $this->db->sql_escape($key) . "'";
			$this->db->sql_query($query);
		}
	}
}
