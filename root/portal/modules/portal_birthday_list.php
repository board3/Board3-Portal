<?php
/**
*
* @package Board3 Portal v2 - Birthday List
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package Birthday List
*/
class portal_birthday_list_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 10;

	/**
	* Default modulename
	*/
	public $name = 'BIRTHDAYS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_birthday.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_birthday_list_module';

	public function get_template_side($module_id)
	{
		global $config, $template, $db, $user, $phpbb_root_path;

		// Generate birthday list if required ... / borrowed from index.php 3.0.6
		$birthday_list = $birthday_ahead_list = '';
		if ($config['load_birthdays'] && $config['allow_birthdays'])
		{
			$now = getdate(time() + $user->timezone + $user->dst - date('Z'));
			$cache_days = $config['board3_birthdays_ahead_' . $module_id];
			$sql_days = '';
			while ($cache_days > 0)
			{
				$day = getdate(time() + 86400 * $cache_days + $user->timezone + $user->dst - date('Z'));
				$like_expression = $db->sql_like_expression($db->any_char . (sprintf('%2d-%2d-', $day['mday'], $day['mon'])) . $db->any_char);
				$sql_days .= " OR u.user_birthday " . $like_expression . "";
				$cache_days--;
			}

			switch ($db->sql_layer)
			{
				case 'mssql':
				case 'mssql_odbc':
					$order_by = 'u.user_birthday ASC';
				break;

				default:
					$order_by = 'SUBSTRING(u.user_birthday FROM 4 FOR 2) ASC, SUBSTRING(u.user_birthday FROM 1 FOR 2) ASC, u.username_clean ASC';
				break;
			}
			$now = getdate(time() + $user->timezone + $user->dst - date('Z'));
			$sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_birthday
				FROM ' . USERS_TABLE . ' u
				LEFT JOIN ' . BANLIST_TABLE . " b ON (u.user_id = b.ban_userid)
				WHERE (b.ban_id IS NULL
						OR b.ban_exclude = 1)
					AND (u.user_birthday LIKE '" . $db->sql_escape(sprintf('%2d-%2d-', $now['mday'], $now['mon'])) . "%' {$sql_days})
					AND u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')
				ORDER BY ' . $order_by;
			$result = $db->sql_query($sql);
			$today = sprintf('%2d-%2d-', $now['mday'], $now['mon']);

			while ($row = $db->sql_fetchrow($result))
			{
				if (substr($row['user_birthday'], 0, 6) == $today)
				{
					$birthday_list = true;
					$template->assign_block_vars('board3_birthday_list', array(
						'USER'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
						'AGE'		=> ($age = (int) substr($row['user_birthday'], -4)) ? ' (' . ($now['year'] - $age) . ')' : '',
					));
				}
				elseif ($config['board3_birthdays_ahead_' . $module_id] > 0)
				{
					$birthday_ahead_list = true;
					$template->assign_block_vars('board3_birthday_ahead_list', array(
						'USER'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
						'AGE'		=> ($age = (int) substr($row['user_birthday'], -4)) ? ' (' . ($now['year'] - $age) . ')' : '',
						'DATE'		=> $this->format_birthday($user, $row['user_birthday'], 'd M'),
					));
				}
			}
			$db->sql_freeresult($result);
		}

		// Assign index specific vars
		$template->assign_vars(array(
			'BIRTHDAY_LIST'					=> $birthday_list,
			'BIRTHDAYS_AHEAD_LIST'			=> ($config['board3_birthdays_ahead_' . $module_id]) ? $birthday_ahead_list : '',
			'L_BIRTHDAYS_AHEAD'				=> sprintf($user->lang['BIRTHDAYS_AHEAD'], $config['board3_birthdays_ahead_' . $module_id]),
			'S_DISPLAY_BIRTHDAY_LIST'		=> ($config['load_birthdays']) ? true : false,
			'S_DISPLAY_BIRTHDAY_AHEAD_LIST'	=> ($config['board3_birthdays_ahead_' . $module_id] > 0) ? true : false,
		));

		return 'birthdays_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_BIRTHDAYS_SETTINGS',
			'vars'	=> array(
				'legend1'					=> 'ACP_PORTAL_BIRTHDAYS_SETTINGS',
				'board3_birthdays_ahead_' . $module_id	=> array('lang' => 'PORTAL_BIRTHDAYS_AHEAD',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
			),
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_birthdays_ahead_' . $module_id, 30);
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_birthdays_ahead_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}

	/**
	* Format birthday for span title
	*
	* @param object $user phpBB user object
	* @param string $birthday User's birthday from database
	* @param string $date_settings Settings for date() function
	*/
	protected function format_birthday($user, $birthday, $date_settings)
	{
		if (!preg_match('/[0-9]{1,2}-[ ]?[0-9]{1,2}-[0-9]{4}/', $birthday))
		{
			return '';
		}

		$date = explode('-', $birthday);
		$time = mktime(0, 0, 0, $date[1], $date[0], (isset($date[2])) ? $date[2] : 0);
		$lang_dates = array_filter($user->lang['datetime'], 'is_string');

		return strtr(date($date_settings, $time), $lang_dates);
	}
}
