<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package Calendar
*/
class calendar extends module_base
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
	public $name = 'PORTAL_CALENDAR';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_calendar.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_calendar_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = 'acp_portal_calendar';

	/**
	* additional variables
	*/
	protected $mini_cal_fdow;
	protected $mini_cal_month;

	/**
	* User datetime object
	*/
	protected $time;

	/**
	* constants
	*/
	const TIME_DAY = 86400;
	const DAYS_PER_WEEK = 6; // indexes start at 0
	const MONTHS_PER_YEAR = 12;

	/** @var int year in numeric format (YYYY) */
	protected $dateYYYY;

	/** @var int month in numeric format (MM) */
	protected $dateMM;

	/** @var int day in numeric format (DD) */
	protected $dateDD;

	/** @var string extended month (e.g. February) */
	protected $ext_dateMM;

	/** @var int count of days in month */
	protected $daysMonth;

	/** @var int timestamp */
	protected $stamp;

	/** @var array return array s.a. */
	protected $day;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var string Portal root path */
	protected $portal_root_path;

	/** @var \phpbb\log\log phpBB log */
	protected $log;

	/** @var \board3\portal\includes\modules_helper */
	protected $modules_helper;

	/**
	* Construct a calendar object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \board3\portal\includes\modules_helper $modules_helper Modules helper
	* @param \phpbb\template\template $template phpBB template
	* @param \phpbb\db\driver\driver_interface $db Database driver
	* @param \phpbb\request\request_interface $request phpBB request
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	* @param \phpbb\path_helper $path_helper phpBB path helper
	* @param \phpbb\log\log $log phpBB log object
	*/
	public function __construct($config, $modules_helper, $template, $db, $request, $phpbb_root_path, $phpEx, $user, $path_helper, $log)
	{
		$this->config = $config;
		$this->modules_helper = $modules_helper;
		$this->template = $template;
		$this->db = $db;
		$this->request = $request;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
		$this->path_helper = $path_helper;
		$this->log = $log;
		$this->portal_root_path = $this->path_helper->get_web_root_path() . $this->phpbb_root_path . 'ext/board3/portal/';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		$portal_config = obtain_portal_config();

		// 0 = Sunday first - 1 = Monday first. ;-)
		if ($this->config['board3_sunday_first_' . $module_id])
		{
			$this->mini_cal_fdow = 0;
		}
		else
		{
			$this->mini_cal_fdow = 1;
		}

		// get the calendar month
		$this->mini_cal_month = 0;
		if ($this->request->is_set('m' . $module_id))
		{
			$this->mini_cal_month = $this->request->variable('m' . $module_id, 0);
		}

		// initialise some variables
		$this->time = $this->user->create_datetime();
		$now = phpbb_gmgetdate($this->time->getTimestamp() + $this->time->getOffset());
		$today_timestamp = $now[0];
		$mini_cal_today = date('Ymd', $today_timestamp);
		$this->stamp = (int) $today_timestamp;
		$s_cal_month = ($this->mini_cal_month != 0) ? $this->mini_cal_month . ' month' : $mini_cal_today;
		$this->get_month($s_cal_month);
		$mini_cal_count = $this->mini_cal_fdow;
		$mini_cal_this_year = $this->dateYYYY;
		$mini_cal_this_month = $this->dateMM;
		$mini_cal_month_days = $this->daysMonth;

		// output our general calendar bits
		$down = $this->mini_cal_month - 1;
		$up = $this->mini_cal_month + 1;
		$prev_month = '<a href="' . $this->modules_helper->route('board3_portal_controller') . "?m$module_id=$down#minical$module_id" . '" rel="nofollow"><span class="portal-arrow-left-icon" title="' . $this->user->lang['VIEW_PREVIOUS_MONTH'] . '"></span></a>';
		$next_month = '<a href="' . $this->modules_helper->route('board3_portal_controller') . "?m$module_id=$up#minical$module_id" . '" rel="nofollow"><span class="portal-arrow-right-icon" title="' . $this->user->lang['VIEW_NEXT_MONTH'] . '"></span></a>';

		$this->template->assign_block_vars('minical', array(
			'S_SUNDAY_FIRST'	=> ($this->config['board3_sunday_first_' . $module_id]) ? true : false,
			'L_MINI_CAL_MONTH'	=> (($this->config['board3_long_month_' . $module_id]) ? $this->user->lang['mini_cal']['long_month'][$this->day[0][1]] : $this->user->lang['mini_cal']['month'][$this->day[0][1]]) . " " . $this->day[0][2],
			'L_MINI_CAL_SUN'	=> '<span style="color: ' . $this->config['board3_calendar_sunday_color_' . $module_id] . ';">' . $this->user->lang['mini_cal']['day'][1] . '</span>',
			'L_MINI_CAL_MON'	=> $this->user->lang['mini_cal']['day'][2],
			'L_MINI_CAL_TUE'	=> $this->user->lang['mini_cal']['day'][3],
			'L_MINI_CAL_WED'	=> $this->user->lang['mini_cal']['day'][4],
			'L_MINI_CAL_THU'	=> $this->user->lang['mini_cal']['day'][5],
			'L_MINI_CAL_FRI'	=> $this->user->lang['mini_cal']['day'][6],
			'L_MINI_CAL_SAT'	=> $this->user->lang['mini_cal']['day'][7],
			'U_PREV_MONTH'		=> $prev_month,
			'U_NEXT_MONTH'		=> $next_month,
			'S_DISPLAY_EVENTS'	=> ($this->config['board3_display_events_' . $module_id]) ? true : false,
			'MODULE_ID'			=> $module_id,
		));

		// output the days for the current month
		for ($i = 0; $i < $mini_cal_month_days;)
		{
			// is this the first day of the week?
			if ($mini_cal_count == $this->mini_cal_fdow)
			{
				$this->template->assign_block_vars('minical.mini_cal_row', array(
					'MODULE_ID'		=> $module_id,
				));
			}

			// is this a valid weekday?
			if ($mini_cal_count == ($this->day[$i][3]))
			{
				$mini_cal_this_day = $this->day[$i][0];

				$d_mini_cal_today = $mini_cal_this_year . (($mini_cal_this_month <= 9) ? '0' . $mini_cal_this_month : $mini_cal_this_month) . (($mini_cal_this_day <= 9) ? '0' . $mini_cal_this_day : $mini_cal_this_day);
				$mini_cal_day = ($mini_cal_today == $d_mini_cal_today) ? '<span style="font-weight: bold; color: ' . $this->config['board3_calendar_today_color_' . $module_id] . ';">' . $mini_cal_this_day . '</span>' : $mini_cal_this_day;

				$this->template->assign_block_vars('minical.mini_cal_row.mini_cal_days', array(
					'MINI_CAL_DAY'		=> ($mini_cal_count == 0) ? '<span style="color: ' . $this->config['board3_calendar_sunday_color_' . $module_id] . ';">' . $mini_cal_day . '</span>' : $mini_cal_day)
				);
				$i++;
			}
			// no day
			else
			{
				$this->template->assign_block_vars('minical.mini_cal_row.mini_cal_days', array(
					'MINI_CAL_DAY'		=> ' ')
				);
			}

			// is this the last day of the week?
			if ($mini_cal_count == self::DAYS_PER_WEEK)
			{
				// if so then reset the count
				$mini_cal_count = 0;
			}
			else
			{
				// otherwise increment the count
				$mini_cal_count++;
			}
		}

		// fill table with empty strings
		while ($mini_cal_count <= self::DAYS_PER_WEEK)
		{
			$this->template->assign_block_vars('minical.mini_cal_row.mini_cal_days', array(
				'MINI_CAL_DAY'		=> ' ')
			);
			$mini_cal_count++;
		}

		/*
		* Let's start displaying the events
		* make sure we only display events in the future
		*/
		$events = json_decode($portal_config['board3_calendar_events_' . $module_id], true);

		if (!empty($events) && $this->config['board3_display_events_' . $module_id])
		{
			$time_ary = array();
			// we sort the $events array by the start time
			foreach ($events as $key => $cur_event)
			{
				$time_ary[$key] = $cur_event['start_time'];
			}
			array_multisort($time_ary, SORT_NUMERIC, $events);

			$groups_ary = get_user_groups();

			foreach ($events as $key => $cur_event)
			{
				if (($cur_event['start_time'] + $this->time->getOffset()) >= $today_timestamp ||
					($cur_event['end_time'] + $this->time->getOffset()) >= $today_timestamp ||
					(($cur_event['start_time'] + $this->time->getOffset() + self::TIME_DAY) >= $today_timestamp && $cur_event['all_day']))
				{
					$cur_permissions = explode(',', $cur_event['permission']);
					$permission_check = array_intersect($groups_ary, $cur_permissions);

					if (!empty($permission_check) || $cur_event['permission'] == '')
					{
						// check if this is an external link
						if (isset($cur_event['url']) && strpos($cur_event['url'], generate_board_url()) === false)
						{
							$is_external = true;
						}
						else
						{
							$is_external = false;
						}

						/**
						* Current events
						*
						* Events are treated as current if the following is met:
						* - We have an all day event and the start of that event is less than 1 day (86400 seconds) away
						* - We have a normal event with a start that is less then 1 day away and that hasn't ended yet
						*/
						if ((($cur_event['start_time'] + $this->time->getOffset() - $today_timestamp) <= self::TIME_DAY && $cur_event['all_day']) ||
						(($cur_event['start_time'] + $this->time->getOffset() - $today_timestamp) <= self::TIME_DAY && ($cur_event['end_time'] + $this->time->getOffset()) >= $today_timestamp))
						{
							$this->template->assign_block_vars('minical.cur_events', array(
								'EVENT_URL'		=> (isset($cur_event['url']) && $cur_event['url'] != '') ? $this->validate_url($cur_event['url']) : '',
								'EVENT_TITLE'	=> $cur_event['title'],
								'START_TIME'	=> $this->user->format_date($cur_event['start_time']),
								'END_TIME'		=> (!empty($cur_event['end_time'])) ? $this->user->format_date($cur_event['end_time']) : false,
								'EVENT_DESC'	=> (isset($cur_event['desc']) && $cur_event['desc'] != '') ? $cur_event['desc'] : '',
								'ALL_DAY'	=> ($cur_event['all_day']) ? true : false,
								'MODULE_ID'		=> $module_id,
								'EVENT_URL_NEW_WINDOW'	=> ($is_external && $this->config['board3_events_url_new_window_' . $module_id]) ? true : false,
							));
						}
						else
						{
							$this->template->assign_block_vars('minical.upcoming_events', array(
								'EVENT_URL'		=> (isset($cur_event['url']) && $cur_event['url'] != '') ? $this->validate_url($cur_event['url']) : '',
								'EVENT_TITLE'	=> $cur_event['title'],
								'START_TIME'	=> $this->user->format_date($cur_event['start_time']),
								'END_TIME'		=> (!$cur_event['all_day']) ? $this->user->format_date($cur_event['end_time']) : '',
								'EVENT_DESC'	=> (isset($cur_event['desc']) && $cur_event['desc'] != '') ? $cur_event['desc'] : '',
								'ALL_DAY'	=> (($cur_event['start_time'] - $cur_event['end_time']) == 1) ? true : false,
								'MODULE_ID'		=> $module_id,
								'EVENT_URL_NEW_WINDOW'	=> ($is_external && $this->config['board3_events_url_new_window_' . $module_id]) ? true : false,
							));
						}
					}
				}
			}
		}

		return 'calendar_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_CALENDAR',
			'vars'	=> array(
				'legend1'								=> 'ACP_PORTAL_CALENDAR',
				'board3_calendar_today_color_' . $module_id		=> array('lang' => 'PORTAL_CALENDAR_TODAY_COLOR'	 ,	'validate' => 'string', 'type' => 'text:10:10',	 'explain' => true),
				'board3_calendar_sunday_color_' . $module_id	=> array('lang' => 'PORTAL_CALENDAR_SUNDAY_COLOR' ,	'validate' => 'string', 'type' => 'text:10:10',	 'explain' => true),
				'board3_long_month_' . $module_id				=> array('lang' => 'PORTAL_LONG_MONTH' ,	'validate' => 'bool',	'type' => 'radio:yes_no',	 'explain' => true),
				'board3_sunday_first_' . $module_id				=> array('lang' => 'PORTAL_SUNDAY_FIRST' ,	'validate' => 'bool',	'type' => 'radio:yes_no',	 'explain' => true),
				'board3_display_events_' . $module_id			=> array('lang' => 'PORTAL_DISPLAY_EVENTS',	'validate' => 'bool',	'type' => 'radio:yes_no',	 'explain' => true),
				'board3_events_url_new_window_' . $module_id	=> array('lang' => 'PORTAL_EVENTS_URL_NEW_WINDOW', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false),
				'board3_events_' . $module_id					=> array('lang' => 'PORTAL_EVENTS_MANAGE', 'validate' => 'string',	'type' => 'custom',	'explain' => false, 'method' => 'manage_events', 'submit' => 'update_events'),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_sunday_first_' . $module_id, 1);
		$this->config->set('board3_calendar_today_color_' . $module_id, '#000000');
		$this->config->set('board3_calendar_sunday_color_' . $module_id, '#FF0000');
		$this->config->set('board3_long_month_' . $module_id, 0);
		$this->config->set('board3_display_events_' . $module_id, 0);
		$this->config->set('board3_events_' . $module_id, '');
		$this->config->set('board3_events_url_new_window_' . $module_id, 0);

		set_portal_config('board3_calendar_events_' . $module_id, '');
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_calendar_events_' . $module_id,
		);
		$sql = 'DELETE FROM ' . PORTAL_CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);

		$db->sql_query($sql);

		$del_config = array(
			'board3_sunday_first_' . $module_id,
			'board3_calendar_today_color_' . $module_id,
			'board3_calendar_sunday_color_' . $module_id,
			'board3_long_month_' . $module_id,
			'board3_display_events_' . $module_id,
			'board3_events_' . $module_id,
			'board3_events_url_new_window_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}

	/**
	* Manage events
	*
	* @param mixed $value Value of input
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function manage_events($value, $key, $module_id)
	{
		$action = $this->request->variable('action', '');
		$action = ($this->request->is_set_post('add')) ? 'add' : $action;
		$action = ($this->request->is_set_post('save')) ? 'save' : $action;
		$link_id = $this->request->variable('id', 99999999); // 0 will trigger unwanted behavior, therefore we set a number we should never reach
		$portal_config = obtain_portal_config();

		$events = (strlen($portal_config['board3_calendar_events_' . $module_id]) >= 1) ? json_decode($portal_config['board3_calendar_events_' . $module_id], true) : array();

		// append_sid() adds adm/ already, no need to add it here
		$u_action = append_sid('index.' . $this->php_ext, 'i=-board3-portal-acp-portal_module&amp;mode=config&amp;module_id=' . $module_id);

		switch ($action)
		{
			// Save changes
			case 'save':
				if (!check_form_key('acp_portal'))
				{
					trigger_error($this->user->lang['FORM_INVALID']. adm_back_link($u_action), E_USER_WARNING);
				}

				$event_title = $this->request->variable('event_title', '', true);
				$event_desc = $this->request->variable('event_desc', '', true);
				$event_start_date = trim($this->request->variable('event_start_date', ''));
				$event_end_date = trim($this->request->variable('event_end_date', ''));
				$event_all_day = $this->request->variable('event_all_day', false); // default to false
				$event_url = $this->request->variable('event_url', '');
				$event_permission = $this->request->variable('permission-setting-calendar', array(0 => ''));
				$groups_ary = array();

				// Now get the unix timestamps out of the entered information
				$start_time = $this->date_to_time($event_start_date);
				$end_time = (!$event_all_day) ? $this->date_to_time($event_end_date) : '';

				if (!$start_time)
				{
					trigger_error($this->user->lang['ACP_PORTAL_CALENDAR_START_INCORRECT']. adm_back_link($u_action), E_USER_WARNING);
				}
				else if (!$event_all_day && !$end_time)
				{
					trigger_error($this->user->lang['ACP_PORTAL_CALENDAR_END_INCORRECT']. adm_back_link($u_action), E_USER_WARNING);
				}

				if (($end_time) <= time() && !(($start_time + self::TIME_DAY) >= time() && $event_all_day))
				{
					trigger_error($this->user->lang['ACP_PORTAL_CALENDAR_EVENT_PAST']. adm_back_link($u_action), E_USER_WARNING);
				}
				else if ($end_time < $start_time && !$event_all_day)
				{
					trigger_error($this->user->lang['ACP_PORTAL_CALENDAR_EVENT_START_FIRST']. adm_back_link($u_action), E_USER_WARNING);
				}

				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $this->db->sql_query($sql);
				while ($row = $this->db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$this->db->sql_freeresult($result);

				$event_permission = array_intersect($event_permission, $groups_ary);
				$event_permission = implode(',', $event_permission);

				// Check for errors
				if (!$event_title)
				{
					trigger_error($this->user->lang['NO_EVENT_TITLE'] . adm_back_link($u_action), E_USER_WARNING);
				}

				// overwrite already existing events and make sure we don't try to save an event outside of the normal array size of $events
				if (isset($link_id) && $link_id < sizeof($events))
				{
					$message = $this->user->lang['EVENT_UPDATED'];

					$events[$link_id] = array(
						'title' 		=> $event_title,
						'desc'			=> $event_desc,
						'start_time'	=> $start_time,
						'end_time'		=> $end_time,
						'all_day'		=> $event_all_day,
						'permission'	=> $event_permission,
						'url'			=> htmlspecialchars_decode($event_url),
					);

					$this->log->add('admin', $this->user->data['user_id'], $this->user->data['user_ip'], 'LOG_PORTAL_EVENT_UPDATED', false, array($event_title));
				}
				else
				{
					$message = $this->user->lang['EVENT_ADDED'];

					$events[] = array(
						'title'			=> $event_title,
						'desc'			=> $event_desc,
						'start_time'	=> $start_time,
						'end_time'		=> $end_time,
						'all_day'		=> $event_all_day,
						'permission'	=> $event_permission,
						'url'			=> $event_url, // optional
					);
					$this->log->add('admin', $this->user->data['user_id'], $this->user->data['user_ip'], 'LOG_PORTAL_EVENT_ADDED', false, array($event_title));
				}

				$time_ary = array();
				// we sort the $events array by the start time
				foreach ($events as $key => $cur_event)
				{
					$time_ary[$key] = $cur_event['start_time'];
				}
				array_multisort($time_ary, SORT_NUMERIC, $events);
				$board3_events_array = json_encode($events);
				set_portal_config('board3_calendar_events_' . $module_id, $board3_events_array);

				trigger_error($message . adm_back_link($u_action));

			break;

			// Delete link
			case 'delete':

				if (!isset($link_id) && $link_id >= sizeof($events))
				{
					trigger_error($this->user->lang['NO_EVENT'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$cur_event_title = $events[$link_id]['title'];
					// delete the selected link and reset the array numbering afterwards
					array_splice($events, $link_id, 1);
					$events = array_merge($events);

					$board3_events_array = json_encode($events);
					set_portal_config('board3_calendar_events_' . $module_id, $board3_events_array);

					$this->log->add('admin', $this->user->data['user_id'], $this->user->data['user_ip'], 'LOG_PORTAL_EVENT_REMOVED', false, array($cur_event_title));
				}
				else
				{
					confirm_box(false, $this->user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'link_id'	=> $link_id,
						'action'	=> 'delete',
					)));
				}

			break;

			// Edit or add menu item
			case 'edit':
			case 'add':
				$event_all_day = (isset($events[$link_id]['all_day']) && $events[$link_id]['all_day'] == true) ? true : false;
				$date_format = str_replace(array('D '), '', $this->user->data['user_dateformat']);

				$this->template->assign_vars(array(
					'EVENT_TITLE'		=> (isset($events[$link_id]['title']) && $action != 'add') ? $events[$link_id]['title'] : '',
					'EVENT_DESC'		=> (isset($events[$link_id]['desc']) && $action != 'add') ? $events[$link_id]['desc'] : '',
					'EVENT_START_DATE'	=> ($action != 'add') ? $this->user->format_date($events[$link_id]['start_time'], $date_format) : '',
					'EVENT_END_DATE'	=> ($action != 'add' && !$event_all_day) ? $this->user->format_date($events[$link_id]['end_time'], $date_format) : '',
					'EVENT_ALL_DAY'		=> (isset($events[$link_id]['all_day']) && $events[$link_id]['all_day'] == true) ? true : false,
					'EVENT_URL'			=> (isset($events[$link_id]['url']) && $action != 'add') ? $events[$link_id]['url'] : '',

					//'U_BACK'	=> $u_action,
					'B3P_U_ACTION'	=> $u_action . '&amp;id=' . $link_id,

					'S_EDIT'				=> true,
				));

				$groups_ary = (isset($events[$link_id]['permission'])) ? explode(',', $events[$link_id]['permission']) : array();

				// get group info from database and assign the block vars
				$sql = 'SELECT group_id, group_name
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $this->db->sql_query($sql);
				while ($row = $this->db->sql_fetchrow($result))
				{
					$this->template->assign_block_vars('permission_setting_calendar', array(
						'SELECTED'		=> (in_array($row['group_id'], $groups_ary)) ? true : false,
						'GROUP_NAME'	=> (isset($this->user->lang['G_' . $row['group_name']])) ? $this->user->lang['G_' . $row['group_name']] : $row['group_name'],
						'GROUP_ID'		=> $row['group_id'],
					));
				}
				$this->db->sql_freeresult($result);

				return;
		}

		for ($i = 0; $i < sizeof($events); $i++)
		{
			$event_all_day = ($events[$i]['all_day'] == true) ? true : false;

			$this->template->assign_block_vars('events', array(
				'EVENT_TITLE'	=> ($action != 'add') ? ((isset($this->user->lang[$events[$i]['title']])) ? $this->user->lang[$events[$i]['title']] : $events[$i]['title']) : '',
				'EVENT_DESC'	=> ($action != 'add') ? $events[$i]['desc'] : '',
				'EVENT_START'	=> ($action != 'add') ? $this->user->format_date($events[$i]['start_time']) : '',
				'EVENT_END'		=> ($action != 'add' && !$event_all_day && !empty($end_time_format)) ? $this->user->format_date($events[$i]['end_time']) : '',
				'EVENT_URL'		=> ($action != 'add' && isset($events[$i]['url']) && !empty($events[$i]['url'])) ? $this->validate_url($events[$i]['url']) : '',
				'EVENT_URL_RAW'	=> ($action != 'add' && isset($events[$i]['url']) && !empty($events[$i]['url'])) ? $events[$i]['url'] : '',
				'U_EDIT'		=> $u_action . '&amp;action=edit&amp;id=' . $i,
				'U_DELETE'		=> $u_action . '&amp;action=delete&amp;id=' . $i,
				'EVENT_ALL_DAY'	=> $event_all_day,
			));
		}

	}

	/**
	* Update events
	*
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function update_events($key, $module_id)
	{
		$this->manage_events('', $key, $module_id);
	}

	/**
	* Convert date->timestamp to time
	*
	* @param string $date Date to convert
	*
	* @return int Converted time
	*/
	protected function make_timestamp($date)
	{
		$this->stamp = strtotime($date);
		return $this->stamp;
	}

	/**
	* Get date listed in array
	*
	* @param string $call_date Date
	*
	* @return null
	*/
	protected function get_month($call_date)
	{
		$this->make_timestamp($call_date);
		// last or first day of some months need to be treated in a special way
		if (!empty($this->mini_cal_month))
		{
			$time = $this->user->create_datetime();
			$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());
			$today_timestamp = $now[0];
			$cur_month = date("n", $today_timestamp);
			$correct_month = $cur_month + $this->mini_cal_month;

			// move back or forth the correct number of years
			while ($correct_month < 1 || $correct_month > self::MONTHS_PER_YEAR)
			{
				$correct_month = ($correct_month < 1) ? $correct_month + self::MONTHS_PER_YEAR : $correct_month - self::MONTHS_PER_YEAR;
			}

			// fix incorrect months
			while (date("n", $this->stamp) != $correct_month)
			{
				// Go back one day or move forward in order to
				// get to the correct month
				$this->stamp = (date("n", $this->stamp) > $correct_month) ? $this->stamp - self::TIME_DAY : $this->stamp + self::TIME_DAY;
			}
		}
		$this->dateYYYY = (int) date("Y", $this->stamp);
		$this->dateMM = (int) date("n", $this->stamp);
		$this->ext_dateMM = date("F", $this->stamp);
		$this->dateDD = (int) date("d", $this->stamp);
		$this->daysMonth = (int) date("t", $this->stamp);

		for ($i = 1; $i < $this->daysMonth + 1; $i++)
		{
			$this->make_timestamp("$i {$this->ext_dateMM} {$this->dateYYYY}");
			$this->day[] = array(
				'0' => "$i",
				'1' => $this->dateMM,
				'2' => $this->dateYYYY,
				'3' => date('w', $this->stamp)
				);
		}
	}

	/**
	* Validate URLs and execute apppend_sid if necessary
	*
	* @param string $url URL to process
	*
	* @return string Processed URL
	*/
	protected function validate_url($url)
	{
		$url = str_replace("\r\n", "\n", str_replace('\"', '"', trim($url)));
		$url = str_replace(' ', '%20', $url);
		$url = str_replace('&', '&amp;', $url);

		// if there is no scheme, then add http schema
		if (!preg_match('#^[a-z][a-z\d+\-.]*:/{2}#i', $url))
		{
			$url = 'http://' . $url;
		}

		// Is this a link to somewhere inside this board? If so then run reapply_sid()
		if (strpos($url, generate_board_url()) !== false)
		{
			$url = reapply_sid($url);
		}

		return $url;
	}

	/**
	* Returns timestamp from given date string
	*
	* @param string $date	Date and time string. It can contain just the
	*			date or date and time info. The string should
	*			be in a similar format: 17.06.1990 18:06
	* @return int|bool	The timestamp of the given date or false if
	*			given date does not match any known formats.
	*/
	public function date_to_time($date)
	{
		return strtotime($date);
	}
}
