<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2015 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\migrations;

class v210 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\board3\portal\migrations\v210_rc3');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('board3_portal_version', '2.1.0')),
			array('config.remove', array('board3_version_check')),
			array('custom', array(array($this, 'add_donation_setting'))),
			array('custom', array(array($this, 'convert_serialize_to_json'))),
			array('custom', array(array($this, 'add_module_permissions'))),
		);
	}

	/**
	 * Adds default currency setting to already installed donation modules
	 */
	public function add_donation_setting()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "portal_modules
			WHERE module_classname = '\\\board3\\\portal\\\modules\\\donation'";
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->config->set('board3_pay_default_' . $row['module_id'], 'EUR');
		}
		$this->db->sql_freeresult($result);
	}

	public function convert_serialize_to_json()
	{
		if (!function_exists('obtain_portal_config'))
		{
			include ($this->phpbb_root_path . 'ext/board3/portal/includes/functions.' . $this->php_ext);
			define('PORTAL_CONFIG_TABLE', $this->table_prefix . 'portal_config');
		}

		$portal_config = obtain_portal_config();

		$sql = 'SELECT module_id, module_classname
			FROM ' . $this->table_prefix . 'portal_modules
			WHERE ' . $this->db->sql_in_set('module_classname', array(
				'\board3\portal\modules\calendar',
				'\board3\portal\modules\links',
				'\board3\portal\modules\main_menu',
			));
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			switch ($row['module_classname'])
			{
				case '\board3\portal\modules\calendar':
					$setting = 'board3_calendar_events_' . $row['module_id'];
				break;
				case '\board3\portal\modules\links':
					$setting = 'board3_links_array_' . $row['module_id'];
				break;
				case '\board3\portal\modules\main_menu':
					$setting = 'board3_menu_array_' . $row['module_id'];
				break;
				default:
					// nothing
			}

			// Do not try to unserialize empty data
			if (empty($setting) || empty($portal_config[$setting]))
			{
				continue;
			}

			// Save json encoded setting
			set_portal_config($setting, json_encode($this->utf_unserialize($portal_config[$setting])));
		}
		$this->db->sql_freeresult($result);
	}

	/**
	 * Add correct module permissions to ACP modules
	 */
	public function add_module_permissions()
	{
		$sql = 'UPDATE ' . $this->table_prefix . "modules
			SET module_auth = 'ext_board3/portal && acl_a_manage_portal'
			WHERE module_basename = '\\\\board3\\\\portal\\\\acp\\\\portal_module'
				AND module_auth = 'acl_a_manage_portal'";
		$this->db->sql_query($sql);
	}

	/**
	 * Unserialize links array
	 *
	 * @param string $serial_str Serialized string
	 *
	 * @return array Unserialized string
	 */
	private function utf_unserialize($serial_str)
	{
		$out = preg_replace_callback('!s:(\d+):"(.*?)";!s', function ($result) {
			return 's:' . strlen($result[2]) . ":\"{$result[2]}\";";
		}, $serial_str);
		return unserialize($out);
	}
}
