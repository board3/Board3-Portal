<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package Birthday List
*/
class birthday_list extends module_base
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

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a birthday_list object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\template\template $template phpBB template
	* @param \phpbb\db\driver\driver_interface $db Database driver
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($config, $template, $db, $user)
	{
		$this->config = $config;
		$this->template = $template;
		$this->db = $db;
		$this->user = $user;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		// Generate birthday list if required ... / borrowed from index.php 3.0.6
		$birthday_list = $birthday_ahead_list = '';

		if ($this->config['load_birthdays'] && $this->config['allow_birthdays'])
		{
			$time = $this->user->create_datetime();
			$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());
			$cache_days = $this->config['board3_birthdays_ahead_' . $module_id];
			$sql_days = '';
			while ($cache_days > 0)
			{
				$day = phpbb_gmgetdate($time->getTimestamp() + 86400 * $cache_days + $time->getOffset());
				$like_expression = $this->db->sql_like_expression($this->db->get_any_char() . (sprintf('%2d-%2d-', $day['mday'], $day['mon'])) . $this->db->get_any_char());
				$sql_days .= " OR u.user_birthday " . $like_expression . "";
				$cache_days--;
			}

			switch ($this->db->get_sql_layer())
			{
				case 'mssql':
				case 'mssql_odbc':
					$order_by = 'u.user_birthday ASC';
				break;

				default:
					$order_by = 'SUBSTRING(u.user_birthday FROM 4 FOR 2) ASC, SUBSTRING(u.user_birthday FROM 1 FOR 2) ASC, u.username_clean ASC';
				break;
			}

			$sql_array = array(
				'SELECT'		=> 'u.user_id, u.username, u.user_colour, u.user_birthday',
				'FROM'		=> array(USERS_TABLE	=> 'u'),
				'LEFT_JOIN'	=> array(
					array(
						'FROM'		=> array(BANLIST_TABLE	=> 'b'),
						'ON'		=> 'u.user_id = b.ban_userid',
					),
				),
				'WHERE'		=> "(b.ban_id IS NULL
						OR b.ban_exclude = 1)
					AND (u.user_birthday " . $this->db->sql_like_expression($this->db->get_any_char() . sprintf('%2d-%2d-', $now['mday'], $now['mon']) . $this->db->get_any_char()) . " {$sql_days})
					AND " . $this->db->sql_in_set('u.user_type', array(USER_NORMAL , USER_FOUNDER)),
				'ORDER BY'	=> $order_by,
			);
			$sql = $this->db->sql_build_query('SELECT', $sql_array);
			$result = $this->db->sql_query($sql, 300);
			$today = sprintf('%2d-%2d-', $now['mday'], $now['mon']);

			while ($row = $this->db->sql_fetchrow($result))
			{
				if (substr($row['user_birthday'], 0, 6) == $today)
				{
					$birthday_list = true;
					$this->template->assign_block_vars('board3_birthday_list', array(
						'USER'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
						'AGE'		=> ($age = (int) substr($row['user_birthday'], -4)) ? ' (' . ($now['year'] - $age) . ')' : '',
					));
				}
				else if ($this->config['board3_birthdays_ahead_' . $module_id] > 0)
				{
					$birthday_ahead_list = true;
					$this->template->assign_block_vars('board3_birthday_ahead_list', array(
						'USER'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
						'AGE'		=> ($age = (int) substr($row['user_birthday'], -4)) ? ' (' . ($now['year'] - $age) . ')' : '',
						'DATE'		=> $this->format_birthday($this->user, $row['user_birthday'], 'd M'),
					));
				}
			}
			$this->db->sql_freeresult($result);
		}

		// Assign index specific vars
		$this->template->assign_vars(array(
			'BIRTHDAY_LIST'					=> $birthday_list,
			'BIRTHDAYS_AHEAD_LIST'			=> ($this->config['board3_birthdays_ahead_' . $module_id]) ? $birthday_ahead_list : '',
			'L_BIRTHDAYS_AHEAD'				=> sprintf($this->user->lang['BIRTHDAYS_AHEAD'], $this->config['board3_birthdays_ahead_' . $module_id]),
			'S_DISPLAY_BIRTHDAY_LIST'		=> ($this->config['load_birthdays']) ? true : false,
			'S_DISPLAY_BIRTHDAY_AHEAD_LIST'	=> ($this->config['board3_birthdays_ahead_' . $module_id] > 0) ? true : false,
		));

		return 'birthdays_side.html';
	}

	/**
	* {@inheritdoc}
	*/
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
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_birthdays_ahead_' . $module_id, 30);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$this->config->delete('board3_birthdays_ahead_' . $module_id);
		return true;
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
		$time = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
		$lang_dates = array_filter($user->lang['datetime'], 'is_string');

		return strtr(date($date_settings, $time), $lang_dates);
	}
}
