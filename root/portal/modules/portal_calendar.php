<?php
/**
* @package Portal - Calendar
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	var $columns = 10;

	/**
	* Default modulename
	*/
	var $name = 'PORTAL_CALENDAR';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	var $image_src = 'portal_calendar.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	var $language = 'portal_calendar_module';
	
	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	//var $custom_acp_tpl = '';

	function get_template_center($module_id)
	{
		global $config, $template;

		$template->assign_vars(array(
			'EXAMPLE'			=> $config['portal_' . $module_id . '_configname'],
		));

		return 'modulename_center.html';
	}

	function get_template_side($module_id)
	{
		global $config, $template, $user, $phpbb_root_path, $phpEx;
		
		$portal_config = obtain_portal_config();

		// 0 = Sunday first - 1 = Monday first. ;-)
		if ($config['board3_sunday_first_' . $module_id])
		{
			define('MINI_CAL_FDOW', 0);
		}
		else
		{
			define('MINI_CAL_FDOW', 1);
		}

		// get the calendar month
		$mini_cal_month = 0;
		if(isset($_GET['m']) || isset($_POST['m']))
		{
			$mini_cal_month = request_var('m', 0);
		}

		// initialise some variables
		$today_timestamp = time() + $user->timezone + $user->dst;
		$mini_cal_today = date('Ymd', time() + $user->timezone + $user->dst - date('Z'));
		$s_cal_month = ($mini_cal_month != 0) ? $mini_cal_month . ' month' : $mini_cal_today;
		$this->getMonth($s_cal_month);
		$mini_cal_count = MINI_CAL_FDOW;
		$mini_cal_this_year = $this->dateYYYY;
		$mini_cal_this_month = $this->dateMM;
		$mini_cal_this_day = $this->dateDD;
		$mini_cal_month_days = $this->daysMonth;

		// output the days for the current month 
		for($i=0; $i < $mini_cal_month_days;) 
		{
			// is this the first day of the week?
			if($mini_cal_count == MINI_CAL_FDOW)
			{
				$template->assign_block_vars('mini_cal_row', array());
			}

			// is this a valid weekday?
			if($mini_cal_count == ($this->day[$i][3])) 
			{
				$mini_cal_this_day = $this->day[$i][0];

				$d_mini_cal_today = $mini_cal_this_year . (($mini_cal_this_month <= 9) ? '0' . $mini_cal_this_month : $mini_cal_this_month) . (($mini_cal_this_day <= 9) ? '0' . $mini_cal_this_day : $mini_cal_this_day);
				$mini_cal_day = ($mini_cal_today == $d_mini_cal_today) ? '<span style="font-weight: bold; color: ' . $config['board3_calendar_today_color_' . $module_id] . ';">' . $mini_cal_this_day . '</span>' : $mini_cal_this_day;

				$template->assign_block_vars('mini_cal_row.mini_cal_days', array(
					'MINI_CAL_DAY'		=> ($mini_cal_count == 0) ? '<span style="color: ' . $config['board3_calendar_sunday_color_' . $module_id] . ';">' . $mini_cal_day . '</span>' : $mini_cal_day)
				); 
				$i++;
			} 
			// no day
			else 
			{
				$template->assign_block_vars('mini_cal_row.mini_cal_days', array(
					'MINI_CAL_DAY'		=> ' ')
				); 
			}

			// is this the last day of the week?
			if ($mini_cal_count == 6)
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

		// output our general calendar bits
		$down = $mini_cal_month - 1;
		$up = $mini_cal_month + 1;
		$prev_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m=$down#minical") . '"><img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/cal_icon_left_arrow.png' . '" title="' . $user->lang['VIEW_PREVIOUS_MONTH'] . '" height="16" width="16" alt="&lt;&lt;" /></a>';
		$next_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m=$up#minical") . '"><img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/cal_icon_right_arrow.png' . '" title="' . $user->lang['VIEW_NEXT_MONTH'] . '" height="16" width="16" alt="&gt;&gt;" /></a>';

		$template->assign_vars(array(
			'S_DISPLAY_MINICAL'	=> true,
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
			'U_NEXT_MONTH'		=> $next_month)
		);
		
		/* 
		* Let's start displaying the events
		* make sure we only display events in the future
		*/
		$events = $this->utf_unserialize($portal_config['board3_calendar_events_' . $module_id]);
		
		/*
		* this is what the events array should look like
		$events[0] = array(
			'title'			=> '',
			'desc'			=> '',
			'start_time'	=> '',
			'end_time'		=> '',
			'url'			=> '',
		);*/
		if(!empty($events))
		{
			// we sort the $events array by the start time
			foreach($events as $key => $cur_event)
			{
				$time_ary[$key] = $cur_event['start_time'];
			}
			array_multisort($time_ary, SORT_NUMERIC, $events);
			
			foreach($events as $key => $cur_event)
			{
				if($cur_event['start_time'] >= $today_timestamp || $cur_event['end_time'] >= $today_timestamp)
				{
					// current events
					if(($cur_event['start_time'] <= $today_timestamp && $cur_event['end_time'] <= $cur_event['start_time']) || ($cur_event['start_time'] <= $today_timestamp && $cur_event['end_time'] >= $today_timestamp))
					{
						$template->assign_block_vars('cur_events', array(
							'EVENT_URL'		=> (isset($cur_event['url']) && $cur_event['url'] != '') ? $this->validate_url($cur_event['url']) : '',
							'EVENT_TITLE'	=> $cur_event['title'],
							'START_TIME'	=> $user->format_date($cur_event['start_time'], 'y-m-d'),
							'END_TIME'		=> $user->format_date($cur_event['end_time'], 'y-m-d'),
							'EVENT_DESC'	=> (isset($cur_event['desc']) && $cur_event['desc'] != '') ? $cur_event['desc'] : '',
						));
					}
					else
					{
						$template->assign_block_vars('upcoming_events', array(
							'EVENT_URL'		=> (isset($cur_event['url']) && $cur_event['url'] != '') ? $this->validate_url($cur_event['url']) : '',
							'EVENT_TITLE'	=> $cur_event['title'],
							'CUR_EVENT'		=> ($cur_event['start_time'] <= $today_timestamp && $cur_event['end_time'] >= $today_timestamp) ? true : false,
							'START_TIME'	=> $user->format_date($cur_event['start_time'], 'y-m-d'),
							'END_TIME'		=> $user->format_date($cur_event['end_time'], 'y-m-d'),
							'EVENT_DESC'	=> (isset($cur_event['desc']) && $cur_event['desc'] != '') ? $cur_event['desc'] : '',
						));
					}
				}
				else
				{
					// mark the events that should be deleted
					$delete_id_ary[] = $key;
				}
			}
			
			// now delete old events
			if(isset($delete_id_ary) && !empty($delete_id_ary))
			{
				foreach($delete_id_ary as $cur_id)
				{
					array_splice($events, $cur_id, 1);
				}
				
				// afterwards reset the array numbering and insert the data into the database
				$events = array_merge($events);
				
				$events = serialize($events);
				set_portal_config('board3_calendar_events_' . $module_id, $events);
			}
		}
		
		//print_r($events); // no output needed, seems to work correctly

		/*
		if (!isset($template->filename['mini_cal_block']))
		{
			$template->set_filenames(array(
				'mini_cal_block'	=> 'portal/block/mini_calendar.html')
			);
		}
		*/


		return 'calendar_side.html';
	}

	function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_CONFIG_MODULENAME',
			'vars'	=> array(
				'legend1'								=> 'ACP_MODULENAME_CONFIGLEGEND',
				'portal_' . $module_id . '_configname'	=> array('lang' => 'MODULENAME_CONFIGNAME',		'validate' => 'string',	'type' => 'text:10:200',	'explain' => false),
				'portal_' . $module_id . '_configname2'	=> array('lang' => 'MODULENAME_CONFIGNAME2',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
			),
		);
		return array();
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		set_config('board3_sunday_first_' . $module_id, 1);
		set_config('board3_calendar_today_color_' . $module_id, '#000000');
		set_config('board3_calendar_sunday_color_' . $module_id, '#FF0000');
		set_config('board3_long_month_' . $module_id, 0);
		
		set_portal_config('board3_calendar_events_' . $module_id, '');
		return true;
	}

	function uninstall($module_id)
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
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
	
	var $dateYYY;						// year in numeric format (YYYY)
	var $dateMM;						// month in numeric format (MM)
	var $dateDD;						// day in numeric format (DD)
	var $ext_dateMM;					// extended month (e.g. February)
	var $daysMonth;						// count of days in month
	var $stamp;							// timestamp
	var $day;							// return array s.a.

	/**
	* convert date->timestamp
	**/
	function makeTimestamp($date) 
	{
		$this->stamp = strtotime($date);
		return ($this->stamp);
	}

	/**
	* get date listed in array
	**/
	function getMonth($callDate) 
	{

		$this->makeTimestamp($callDate);
		$this->dateYYYY = date("Y", $this->stamp);
		$this->dateMM = date("n", $this->stamp);
		$this->ext_dateMM = date("F", $this->stamp);
		$this->dateDD = date("d", $this->stamp);
		$this->daysMonth = date("t", $this->stamp);
    
		for($i=1; $i < $this->daysMonth+1; $i++) 
		{
			$this->makeTimestamp("$i $this->ext_dateMM $this->dateYYYY");
			$this->day[] = array(
				"0" => "$i",
				"1" => $this->dateMM,
				"2" => $this->dateYYYY,
				"3" => (date('w', $this->stamp))
				);
		}
	}
	
	// Unserialize links array
	function utf_unserialize($serial_str) 
	{
		$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
		return unserialize($out);   
	}
	
	/**
	* validate URLs and execute apppend_sid if necessary
	*/
	function validate_url($url)
	{
		global $config;

		$url = str_replace("\r\n", "\n", str_replace('\"', '"', trim($url)));
		$url = str_replace(' ', '%20', $url);
		
		// if there is no scheme, then add http schema
		if (!preg_match('#^[a-z][a-z\d+\-.]*:/{2}#i', $url))
		{
			$url = 'http://' . $url;
		}
		
		// Is this a link to somewhere inside this board? If so then remove the session id from the url
		if (strpos($url, generate_board_url()) !== false && strpos($url, 'sid=') !== false)
		{
			$url = reapply_sid($url);
		}
		
		return $url;
	}
}

?>