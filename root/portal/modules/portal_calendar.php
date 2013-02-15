<?php
/**
*
* @package Board3 Portal v2 - Calendar
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
* @package Calendar
*/
class portal_calendar_module
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
	private $mini_cal_fdow;

	/**
	* constants
	*/
	const TIME_DAY = 86400;
	const DAYS_PER_WEEK = 6; // indexes start at 0
	const MONTHS_PER_YEAR = 12;

	public function get_template_side($module_id)
	{
		global $config, $template, $user, $phpbb_root_path, $phpEx, $db;

		$portal_config = obtain_portal_config();

		// 0 = Sunday first - 1 = Monday first. ;-)
		if ($config['board3_sunday_first_' . $module_id])
		{
			$this->mini_cal_fdow = 0;
		}
		else
		{
			$this->mini_cal_fdow = 1;
		}

		// get the calendar month
		$this->mini_cal_month = 0;
		if(isset($_GET['m' . $module_id]) || isset($_POST['m' . $module_id]))
		{
			$this->mini_cal_month = request_var('m' . $module_id, 0);
		}

		// initialise some variables
		$today_timestamp = time() + $user->timezone + $user->dst;
		$mini_cal_today = date('Ymd', time() + $user->timezone + $user->dst - date('Z'));
		$s_cal_month = ($this->mini_cal_month != 0) ? $this->mini_cal_month . ' month' : $mini_cal_today;
		$this->getMonth($s_cal_month);
		$mini_cal_count = $this->mini_cal_fdow;
		$mini_cal_this_year = $this->dateYYYY;
		$mini_cal_this_month = $this->dateMM;
		$mini_cal_this_day = $this->dateDD;
		$mini_cal_month_days = $this->daysMonth;

		// output our general calendar bits
		$down = $this->mini_cal_month - 1;
		$up = $this->mini_cal_month + 1;
		$prev_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m$module_id=$down#minical$module_id") . '"><img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/cal_icon_left_arrow.png' . '" title="' . $user->lang['VIEW_PREVIOUS_MONTH'] . '" height="16" width="16" alt="&lt;&lt;" /></a>';
		$next_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m$module_id=$up#minical$module_id") . '"><img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/cal_icon_right_arrow.png' . '" title="' . $user->lang['VIEW_NEXT_MONTH'] . '" height="16" width="16" alt="&gt;&gt;" /></a>';

		$template->assign_block_vars('minical', array(
			'S_SUNDAY_FIRST'	=> ($config['board3_sunday_first_' . $module_id]) ? true : false,
			'L_MINI_CAL_MONTH'	=> (($config['board3_long_month_' . $module_id]) ? $user->lang['mini_cal']['long_month'][$this->day[0][1]] : $user->lang['mini_cal']['month'][$this->day[0][1]]) . " " . $this->day[0][2],
			'L_MINI_CAL_SUN'	=> '<span style="color: ' . $config['board3_calendar_sunday_color_' . $module_id] . ';">' . $user->lang['mini_cal']['day'][1] . '</span>', 
			'L_MINI_CAL_MON'	=> $user->lang['mini_cal']['day'][2], 
			'L_MINI_CAL_TUE'	=> $user->lang['mini_cal']['day'][3], 
			'L_MINI_CAL_WED'	=> $user->lang['mini_cal']['day'][4], 
			'L_MINI_CAL_THU'	=> $user->lang['mini_cal']['day'][5], 
			'L_MINI_CAL_FRI'	=> $user->lang['mini_cal']['day'][6], 
			'L_MINI_CAL_SAT'	=> $user->lang['mini_cal']['day'][7], 
			'U_PREV_MONTH'		=> $prev_month,
			'U_NEXT_MONTH'		=> $next_month,
			'S_DISPLAY_EVENTS'	=> ($config['board3_display_events_' . $module_id]) ? true : false,
			'MODULE_ID'			=> $module_id,
		));

		// output the days for the current month 
		for($i = 0; $i < $mini_cal_month_days;)
		{
			// is this the first day of the week?
			if($mini_cal_count == $this->mini_cal_fdow)
			{
				$template->assign_block_vars('minical.mini_cal_row', array(
					'MODULE_ID'		=> $module_id,
				));
			}

			// is this a valid weekday?
			if($mini_cal_count == ($this->day[$i][3])) 
			{
				$mini_cal_this_day = $this->day[$i][0];

				$d_mini_cal_today = $mini_cal_this_year . (($mini_cal_this_month <= 9) ? '0' . $mini_cal_this_month : $mini_cal_this_month) . (($mini_cal_this_day <= 9) ? '0' . $mini_cal_this_day : $mini_cal_this_day);
				$mini_cal_day = ($mini_cal_today == $d_mini_cal_today) ? '<span style="font-weight: bold; color: ' . $config['board3_calendar_today_color_' . $module_id] . ';">' . $mini_cal_this_day . '</span>' : $mini_cal_this_day;

				$template->assign_block_vars('minical.mini_cal_row.mini_cal_days', array(
					'MINI_CAL_DAY'		=> ($mini_cal_count == 0) ? '<span style="color: ' . $config['board3_calendar_sunday_color_' . $module_id] . ';">' . $mini_cal_day . '</span>' : $mini_cal_day)
				);
				$i++;
			} 
			// no day
			else 
			{
				$template->assign_block_vars('minical.mini_cal_row.mini_cal_days', array(
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

		/* 
		* Let's start displaying the events
		* make sure we only display events in the future
		*/
		$events = $this->utf_unserialize($portal_config['board3_calendar_events_' . $module_id]);

		if(!empty($events) && $config['board3_display_events_' . $module_id])
		{
			// we sort the $events array by the start time
			foreach($events as $key => $cur_event)
			{
				$time_ary[$key] = $cur_event['start_time'];
			}
			array_multisort($time_ary, SORT_NUMERIC, $events);

			$groups_ary = get_user_groups();

			foreach($events as $key => $cur_event)
			{
				if(($cur_event['start_time'] + $user->timezone + $user->dst) >= $today_timestamp || 
					($cur_event['end_time'] + $user->timezone + $user->dst) >= $today_timestamp || 
					(($cur_event['start_time'] + $user->timezone + $user->dst + self::TIME_DAY) >= $today_timestamp && $cur_event['all_day']))
				{
					$cur_permissions = explode(',', $cur_event['permission']);
					$permission_check = array_intersect($groups_ary, $cur_permissions);

					if(!empty($permission_check) || $cur_event['permission'] == '')
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
						if((($cur_event['start_time'] + $user->timezone + $user->dst - $today_timestamp) <= self::TIME_DAY && $cur_event['all_day']) || 
						(($cur_event['start_time'] + $user->timezone + $user->dst - $today_timestamp) <= self::TIME_DAY && ($cur_event['end_time'] + $user->timezone + $user->dst) >= $today_timestamp))
						{
							$template->assign_block_vars('minical.cur_events', array(
								'EVENT_URL'		=> (isset($cur_event['url']) && $cur_event['url'] != '') ? $this->validate_url($cur_event['url']) : '',
								'EVENT_TITLE'	=> $cur_event['title'],
								'START_TIME'	=> $user->format_date($cur_event['start_time'], 'j. M Y, H:i'),
								'END_TIME'		=> (!empty($cur_event['end_time'])) ? $user->format_date($cur_event['end_time'], 'j. M Y, H:i') : false,
								'EVENT_DESC'	=> (isset($cur_event['desc']) && $cur_event['desc'] != '') ? $cur_event['desc'] : '',
								'ALL_DAY'	=> ($cur_event['all_day']) ? true : false,
								'MODULE_ID'		=> $module_id,
								'EVENT_URL_NEW_WINDOW'	=> ($is_external && $config['board3_events_url_new_window_' . $module_id]) ? true : false,
							));
						}
						else
						{
							$template->assign_block_vars('minical.upcoming_events', array(
								'EVENT_URL'		=> (isset($cur_event['url']) && $cur_event['url'] != '') ? $this->validate_url($cur_event['url']) : '',
								'EVENT_TITLE'	=> $cur_event['title'],
								'START_TIME'	=> $user->format_date($cur_event['start_time'], 'j. M Y, H:i'),
								'END_TIME'		=> (!$cur_event['all_day']) ? $user->format_date($cur_event['end_time'], 'j. M Y, H:i') : '',
								'EVENT_DESC'	=> (isset($cur_event['desc']) && $cur_event['desc'] != '') ? $cur_event['desc'] : '',
								'ALL_DAY'	=> (($cur_event['start_time'] - $cur_event['end_time']) == 1) ? true : false,
								'MODULE_ID'		=> $module_id,
								'EVENT_URL_NEW_WINDOW'	=> ($is_external && $config['board3_events_url_new_window_' . $module_id]) ? true : false,
							));
						}
					}
				}
			}
		}

		return 'calendar_side.html';
	}

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
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_sunday_first_' . $module_id, 1);
		set_config('board3_calendar_today_color_' . $module_id, '#000000');
		set_config('board3_calendar_sunday_color_' . $module_id, '#FF0000');
		set_config('board3_long_month_' . $module_id, 0);
		set_config('board3_display_events_' . $module_id, 0);
		set_config('board3_events_' . $module_id, '');
		set_config('board3_events_url_new_window_' . $module_id, 0);

		set_portal_config('board3_calendar_events_' . $module_id, '');
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

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

	public function manage_events($value, $key, $module_id)
	{
		global $db, $portal_config, $config, $template, $user, $phpEx, $phpbb_admin_path;

		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$link_id = request_var('id', 99999999); // 0 will trigger unwanted behavior, therefore we set a number we should never reach
		$portal_config = obtain_portal_config();

		$events = (strlen($portal_config['board3_calendar_events_' . $module_id]) >= 1) ? $this->utf_unserialize($portal_config['board3_calendar_events_' . $module_id]) : array();

		$u_action = append_sid($phpbb_admin_path . 'index.' . $phpEx, 'i=portal&amp;mode=config&amp;module_id=' . $module_id);

		switch($action)
		{
			// Save changes
			case 'save':
				if (!check_form_key('acp_portal'))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($u_action), E_USER_WARNING);
				}

				$event_title = utf8_normalize_nfc(request_var('event_title', ' ', true));
				$event_desc = utf8_normalize_nfc(request_var('event_desc', ' ', true));
				$event_start_day = trim(request_var('event_start_day', ''));
				$event_start_time = trim(request_var('event_start_time', ''));
				$event_end_day = trim(request_var('event_end_day', ''));
				$event_end_time = trim(request_var('event_end_time', ''));
				$event_all_day = request_var('event_all_day', false); // default to false
				$event_url = request_var('event_url', ' ');
				$event_permission = request_var('permission-setting-calendar', array(0 => ''));
				$groups_ary = array();

				/* 
				* parse the event time
				* first check for obvious errors, we don't want to waste server resources
				*/
				if(strlen($event_start_day) < 9 || strlen($event_start_day) > 10 || (strlen($event_start_time) < 4 && !$event_all_day) || strlen($event_start_time) > 5)
				{
					trigger_error($user->lang['ACP_PORTAL_CALENDAR_START_INCORRECT']. adm_back_link($u_action), E_USER_WARNING);
				}
				elseif((strlen($event_end_day) < 9 || strlen($event_end_day) > 10 || strlen($event_end_time) < 4 || strlen($event_end_time) > 5) && !$event_all_day)
				{
					trigger_error($user->lang['ACP_PORTAL_CALENDAR_END_INCORRECT']. adm_back_link($u_action), E_USER_WARNING);
				}
				// Now get the needed numbers out of the entered information
				$first_start_hyphen = strpos($event_start_day, '-', 0);
				$second_start_hyphen = strpos($event_start_day, '-', $first_start_hyphen + 1);
				$start_colon_pos = strpos($event_start_time, ':', 0);
				$start_day_length = strlen($event_start_day);
				$start_time_length = strlen($event_start_time);
				$start_day = (int) substr($event_start_day, 0, $first_start_hyphen);
				$start_month =  (int) substr($event_start_day, $first_start_hyphen + 1, ($second_start_hyphen - $first_start_hyphen - 1));
				$start_year = (int) substr($event_start_day, $second_start_hyphen + 1, $start_day_length - $second_start_hyphen);
				$start_hour = (int) substr($event_start_time, 0, $start_colon_pos);
				$start_minute = (int) substr($event_start_time, $start_colon_pos + 1, ($start_time_length - $start_colon_pos) - 1);

				if(!$event_all_day)
				{
					$first_end_hyphen = strpos($event_end_day, '-', 0);
					$second_end_hyphen = strpos($event_end_day, '-', $first_end_hyphen + 1);
					$end_colon_pos = strpos($event_end_time, ':', 0);
					$end_day_length = strlen($event_end_day);
					$end_time_length = strlen($event_end_time);
					$end_day = (int) substr($event_end_day, 0, $first_end_hyphen);
					$end_month = (int) substr($event_end_day, $first_end_hyphen + 1, ($second_end_hyphen - $first_end_hyphen - 1));
					$end_year = (int) substr($event_end_day, $second_end_hyphen + 1, $end_day_length - $second_end_hyphen);
					$end_hour = (int) substr($event_end_time, 0, $end_colon_pos);
					$end_minute = (int) substr($event_end_time, $end_colon_pos + 1, ($end_time_length - $end_colon_pos) - 1);
				}

				// UNIX timestamps
				$start_time = gmmktime($start_hour, $start_minute, 0, $start_month, $start_day, $start_year) - $user->timezone - $user->dst;
				$end_time = (!$event_all_day) ? gmmktime($end_hour, $end_minute, 0, $end_month, $end_day, $end_year) - $user->timezone - $user->dst : '';

				if(($end_time) <= time() && !(($start_time + self::TIME_DAY) >= time() && $event_all_day))
				{
					trigger_error($user->lang['ACP_PORTAL_CALENDAR_EVENT_PAST']. adm_back_link($u_action), E_USER_WARNING);
				}
				elseif($end_time < $start_time && !$event_all_day)
				{
					trigger_error($user->lang['ACP_PORTAL_CALENDAR_EVENT_START_FIRST']. adm_back_link($u_action), E_USER_WARNING);
				}

				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$db->sql_freeresult($result);

				$event_permission = array_intersect($event_permission, $groups_ary);
				$event_permission = implode(',', $event_permission);

				// Check for errors
				if (!$event_title)
				{
					trigger_error($user->lang['NO_EVENT_TITLE'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (!$start_time || $start_time == 0)
				{
					trigger_error($user->lang['NO_EVENT_START'] . adm_back_link($u_action), E_USER_WARNING);
				}

				// overwrite already existing events and make sure we don't try to save an event outside of the normal array size of $events
				if (isset($link_id) && $link_id < sizeof($events))
				{
					$message = $user->lang['EVENT_UPDATED'];

					$events[$link_id] = array(
						'title' 		=> $event_title,
						'desc'			=> $event_desc,
						'start_time'	=> $start_time,
						'end_time'		=> $end_time,
						'all_day'		=> $event_all_day,
						'permission'	=> $event_permission,
						'url'			=> htmlspecialchars_decode($event_url),
					);

					add_log('admin', 'LOG_PORTAL_EVENT_UPDATED', $event_title);
				}
				else
				{
					$message = $user->lang['EVENT_ADDED'];

					$events[] = array(
						'title'			=> $event_title,
						'desc'			=> $event_desc,
						'start_time'	=> $start_time,
						'end_time'		=> $end_time,
						'all_day'		=> $event_all_day,
						'permission'	=> $event_permission,
						'url'			=> $event_url, // optional
					);
					add_log('admin', 'LOG_PORTAL_EVENT_ADDED', $event_title);
				}

				// we sort the $events array by the start time
				foreach($events as $key => $cur_event)
				{
					$time_ary[$key] = $cur_event['start_time'];
				}
				array_multisort($time_ary, SORT_NUMERIC, $events);
				$board3_events_array = serialize($events);
				set_portal_config('board3_calendar_events_' . $module_id, $board3_events_array);

				trigger_error($message . adm_back_link($u_action));

			break;

			// Delete link
			case 'delete':

				if (!isset($link_id) && $link_id >= sizeof($events))
				{
					trigger_error($user->lang['NO_EVENT'] . adm_back_link($u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$cur_event_title = $events[$link_id]['title'];
					// delete the selected link and reset the array numbering afterwards
					array_splice($events, $link_id, 1);
					$events = array_merge($events);

					$board3_events_array = serialize($events);
					set_portal_config('board3_calendar_events_' . $module_id, $board3_events_array);

					add_log('admin', 'LOG_PORTAL_EVENT_REMOVED', $cur_event_title);
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'link_id'	=> $link_id,
						'action'	=> 'delete',
					)));
				}

			break;

			// Edit or add menu item
			case 'edit':
			case 'add':
				$event_all_day = (isset($events[$link_id]['all_day']) && $events[$link_id]['all_day'] == true) ? true : false;

				$template->assign_vars(array(
					'EVENT_TITLE'		=> (isset($events[$link_id]['title']) && $action != 'add') ? $events[$link_id]['title'] : '',
					'EVENT_DESC'		=> (isset($events[$link_id]['desc']) && $action != 'add') ? $events[$link_id]['desc'] : '',
					'EVENT_START_DAY'	=> ($action != 'add') ? $user->format_date($events[$link_id]['start_time'], 'd-m-Y') : '',
					'EVENT_START_TIME'	=> ($action != 'add') ? $user->format_date($events[$link_id]['start_time'], 'G:i') : '',
					'EVENT_END_DAY'		=> ($action != 'add' && !$event_all_day) ? $user->format_date($events[$link_id]['end_time'], 'd-m-Y') : '',
					'EVENT_END_TIME'	=> ($action != 'add' && !$event_all_day) ? $user->format_date($events[$link_id]['end_time'], 'G:i') : '',
					'EVENT_ALL_DAY'		=> (isset($events[$link_id]['all_day']) && $events[$link_id]['all_day'] == true) ? true : false,
					'EVENT_URL'			=> (isset($events[$link_id]['url']) && $action != 'add') ? $events[$link_id]['url'] : '',

					//'U_BACK'	=> $u_action,
					'U_ACTION'	=> $u_action . '&amp;id=' . $link_id,

					'S_EDIT'				=> true,
				));

				$groups_ary = (isset($events[$link_id]['permission'])) ? explode(',', $events[$link_id]['permission']) : array();

				// get group info from database and assign the block vars
				$sql = 'SELECT group_id, group_name 
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('permission_setting_calendar', array(
						'SELECTED'		=> (in_array($row['group_id'], $groups_ary)) ? true : false,
						'GROUP_NAME'	=> (isset($user->lang['G_' . $row['group_name']])) ? $user->lang['G_' . $row['group_name']] : $row['group_name'],
						'GROUP_ID'		=> $row['group_id'],
					));
				}
				$db->sql_freeresult($result);

				return;

			break;		
		}

		for ($i = 0; $i < sizeof($events); $i++)
		{
			$event_all_day = ($events[$i]['all_day'] == true) ? true : false;
			$start_time_format = (!intval($user->format_date($events[$i]['start_time'], 'H')) && !intval($user->format_date($events[$i]['start_time'], 'i'))) ? 'j. M Y' : 'j. M Y, H:i';
			$end_time_format = (!intval($user->format_date($events[$i]['end_time'], 'H')) && !intval($user->format_date($events[$i]['end_time'], 'i'))) ? 'j. M Y' : 'j. M Y, H:i';

			$template->assign_block_vars('events', array(
				'EVENT_TITLE'	=> ($action != 'add') ? ((isset($user->lang[$events[$i]['title']])) ? $user->lang[$events[$i]['title']] : $events[$i]['title']) : '',
				'EVENT_DESC'	=> ($action != 'add') ? $events[$i]['desc'] : '',
				'EVENT_START'	=> ($action != 'add') ? $user->format_date($events[$i]['start_time'], $start_time_format) : '',
				'EVENT_END'		=> ($action != 'add' && !$event_all_day) ? $user->format_date($events[$i]['end_time'], $end_time_format) : '',
				'EVENT_URL'		=> ($action != 'add' && isset($events[$i]['url']) && !empty($events[$i]['url'])) ? $this->validate_url($events[$i]['url']) : '',
				'EVENT_URL_RAW'	=> ($action != 'add' && isset($events[$i]['url']) && !empty($events[$i]['url'])) ? $events[$i]['url'] : '',
				'U_EDIT'		=> $u_action . '&amp;action=edit&amp;id=' . $i,
				'U_DELETE'		=> $u_action . '&amp;action=delete&amp;id=' . $i,
				'EVENT_ALL_DAY'	=> $event_all_day,
			));
		}

	}

	public function update_events($key, $module_id)
	{
		$this->manage_events('', $key, $module_id);
	}

	private $dateYYY;						// year in numeric format (YYYY)
	private $dateMM;						// month in numeric format (MM)
	private $dateDD;						// day in numeric format (DD)
	private $ext_dateMM;					// extended month (e.g. February)
	private $daysMonth;						// count of days in month
	private $stamp;							// timestamp
	private $day;							// return array s.a.

	/**
	* convert date->timestamp
	**/
	private function makeTimestamp($date) 
	{
		global $user;

		$this->stamp = strtotime($date);
		return ($this->stamp);
	}

	/**
	* get date listed in array
	**/
	private function getMonth($callDate) 
	{
		global $user;

		$this->makeTimestamp($callDate);
		// last or first day of some months need to be treated in a special way
		if (!empty($this->mini_cal_month))
		{
			$today_timestamp = time() + $user->timezone + $user->dst;
			$cur_month = date("n", $today_timestamp);
			$correct_month = $cur_month + $this->mini_cal_month;

			// move back or forth the correct number of years
			while ($correct_month < 1 || $correct_month > self::MONTHS_PER_YEAR)
			{
				if ($correct_month < 1)
				{
					$correct_month = $correct_month + self::MONTHS_PER_YEAR;
				}
				else
				{
					$correct_month = $correct_month - self::MONTHS_PER_YEAR;
				}
			}

			// fix incorrect months
			while (date("n", $this->stamp) != $correct_month)
			{
				if (date("n", $this->stamp) > $correct_month)
				{
					$this->stamp = $this->stamp - self::TIME_DAY; // go back one day
				}
				else
				{
					$this->stamp = $this->stamp + self::TIME_DAY; // move forward one day
				}
			}
		}
		$this->dateYYYY = date("Y", $this->stamp);
		$this->dateMM = date("n", $this->stamp);
		$this->ext_dateMM = date("F", $this->stamp);
		$this->dateDD = date("d", $this->stamp);
		$this->daysMonth = date("t", $this->stamp);

		for ($i = 1; $i < $this->daysMonth + 1; $i++)
		{
			$this->makeTimestamp("$i {$this->ext_dateMM} {$this->dateYYYY}");
			$this->day[] = array(
				'0' => "$i",
				'1' => $this->dateMM,
				'2' => $this->dateYYYY,
				'3' => date('w', $this->stamp)
				);
		}
	}

	// Unserialize links array
	private function utf_unserialize($serial_str) 
	{
		$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
		return unserialize($out);   
	}

	/**
	* validate URLs and execute apppend_sid if necessary
	*/
	private function validate_url($url)
	{
		global $config;

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
}
