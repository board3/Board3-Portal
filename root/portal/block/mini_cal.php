<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @copyright (c) Adrian Cockburn - phpbb@netclectic.com (mini calendar)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

define ('IN_MINI_CAL', 1);

include_once($phpbb_root_path . '/portal/includes/mini_cal/mini_cal_config.'.$phpEx);
include_once($phpbb_root_path . '/portal/includes/mini_cal/mini_cal_common.'.$phpEx);
include_once($phpbb_root_path . '/portal/includes/mini_cal/calendarSuite.'.$phpEx);
// get the mode (if any)
$mini_cal_mode = 0;
if( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mini_cal_mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
$mini_cal_mode = ($mini_cal_mode == 'personal') ? $mini_cal_mode : 'default';

// get the user (for personal calendar)
if( isset($_GET['u']) || isset($_POST['u']) )
{
	$mini_cal_user = ( isset($_POST['u']) ) ? intval($_POST['u']) : intval($_GET['u']);
}

// get the calendar month
$mini_cal_month = 0;
if( isset($_GET['m']) || isset($_POST['m']) )
{
	$mini_cal_month = ( isset($_POST['m']) ) ? intval($_POST['m']) : intval($_GET['m']);
}

// initialise our calendarsuite class
$mini_cal = new calendarSuite();

// setup our mini_cal template
$template->set_filenames(array(
	'mini_cal_body'		=> 'portal/block/mini_cal_body.html'
));

// initialise some variables
$mini_cal_today = date('Ymd', time() + $user->timezone + $user->dst - date('Z'));
$s_cal_month = ($mini_cal_month != 0) ? $mini_cal_month . ' month' : $mini_cal_today;
$mini_cal->getMonth($s_cal_month);
$mini_cal_count=MINI_CAL_FDOW;
$mini_cal_this_year = $mini_cal->dateYYYY;
$mini_cal_this_month = $mini_cal->dateMM;
$mini_cal_this_day = $mini_cal->dateDD;
$mini_cal_month_days = $mini_cal->daysMonth;

if ( MINI_CAL_CALENDAR_VERSION != 'NONE' )
{
	// include the required events calendar support
	$mini_cal_inc = 'mini_cal_' . MINI_CAL_CALENDAR_VERSION;
	include_once($phpbb_root_path . 'portal/includes/mini_cal/' . $mini_cal_inc . '.' . $phpEx);

	// include the required events calendar support
	$mini_cal_auth = getMiniCalForumsAuth($user);
	$mini_cal_event_days = getMiniCalEventDays($mini_cal_auth['view']);
	getMiniCalEvents($mini_cal_auth);
	getMiniCalPostForumsList($mini_cal_auth['post']);
}

// output the days for the current month 
// if MINI_CAL_DATE_SEARCH = POSTS then hyperlink any days which have already past
// if MINI_CAL_DATE_SEARCH = EVENTS then hyperkink any which have events
$holiday=0;
for($i=0; $i < $mini_cal_month_days;) 
{
	// is this the first day of the week?
	if($mini_cal_count==MINI_CAL_FDOW)
	{
		$template->assign_block_vars('mini_cal_row', array());
	}
	
	// is this a valid weekday?
	if($mini_cal_count==($mini_cal->day[$i][7])) 
	{
		$mini_cal_this_day = $mini_cal->day[$i][0];
	
		$d_mini_cal_today = $mini_cal_this_year . ( ($mini_cal_this_month <= 9) ? '0' . $mini_cal_this_month : $mini_cal_this_month ) . ( ($mini_cal_this_day <= 9) ? '0' . $mini_cal_this_day : $mini_cal_this_day );
		$mini_cal_day = ( $mini_cal_today == $d_mini_cal_today ) ? '<span class="' . MINI_CAL_TODAY_CLASS . '" style="font-weight: bold; border-style: outset; border-width: thin; color:' . $portal_config['portal_minicalendar_today_color'] . ';">' . $mini_cal_this_day . '</span>' : $mini_cal_this_day;

		if ( (MINI_CAL_CALENDAR_VERSION != 'NONE') && (MINI_CAL_DATE_SEARCH == 'EVENTS') )
		{
			$mini_cal_day_link = '<a href="' . getMiniCalSearchURL($d_mini_cal_today) . '" class="' . MINI_CAL_DAY_LINK_CLASS . '" style="color: ' . $portal_config['portal_minicalendar_day_link_color'] . ';">' . ( $mini_cal_day ) . '</a>';
			$mini_cal_day = ( in_array($mini_cal_this_day, $mini_cal_event_days) ) ? $mini_cal_day_link : $mini_cal_day;
		}
		else
		{
			$nix_mini_cal_today = gmmktime($config['board_timezone'], 0, 0, $mini_cal_this_month, $mini_cal_this_day, $mini_cal_this_year);
			$mini_cal_day_link = '<a href="' . append_sid($phpbb_root_path . "search.$phpEx?search_id=unanswered&amp;st=" . $nix_mini_cal_today) . '" class="' . MINI_CAL_DAY_LINK_CLASS . '" style="color: ' . $portal_config['portal_minicalendar_day_link_color'] . ';">' . ( $mini_cal_day ) . '</a>';
			$mini_cal_day = ( $mini_cal_today >= $d_mini_cal_today ) ? $mini_cal_day_link : $mini_cal_day;
		}
		
		$template->assign_block_vars('mini_cal_row.mini_cal_days', array(
			'MINI_CAL_DAY'		=> $mini_cal_day
		)); 
		$i++;
	} 
	// no day
	else 
	{
		$template->assign_block_vars('mini_cal_row.mini_cal_days', array(
			'MINI_CAL_DAY'		=> ' '
		)); 
	}

	// is this the last day of the week?
	if ($mini_cal_count==6)
	{
		// if so then reset the count
		$mini_cal_count=0;
	}
	else
	{
		// otherwise increment the count
		$mini_cal_count++;
	}
}

// output our general calendar bits
$prev_qs = setQueryStringVal('m', $mini_cal_month -1);
$next_qs = setQueryStringVal('m', $mini_cal_month +1);
$down = $mini_cal_month - 1;
$up = $mini_cal_month + 1;
$prev_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m=$down") . '"><img src="' . "{$phpbb_root_path}portal/images/mini_cal_icon_left_arrow.png" . '" title="' . $user->lang['View_previous_month'] . '" height="16" width="16" alt="&lt;&lt;" /></a>';
$next_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m=$up") . '"><img src="' . "{$phpbb_root_path}portal/images/mini_cal_icon_right_arrow.png" . '" title="' . $user->lang['View_next_month'] . '" height="16" width="16" alt="&gt;&gt;" /></a>';

$template->assign_vars(array(
	'S_DISPLAY_MINICAL' => true,
	'L_MINI_CAL_MONTH' => $user->lang['mini_cal']['long_month'][$mini_cal->day[0][4]] . " " . $mini_cal->day[0][5],
	'L_MINI_CAL_ADD_EVENT' => $user->lang['Mini_Cal_add_event'],
	'L_MINI_CAL_CALENDAR' => $user->lang['Mini_Cal_calendar'], 
	'L_MINI_CAL_EVENTS' => $user->lang['Mini_Cal_events'], 
	'L_MINI_CAL_NO_EVENTS' => $user->lang['Mini_Cal_no_events'],
	'L_MINI_CAL_SUN' => $user->lang['mini_cal']['day'][1], 
	'L_MINI_CAL_MON' => $user->lang['mini_cal']['day'][2], 
	'L_MINI_CAL_TUE' => $user->lang['mini_cal']['day'][3], 
	'L_MINI_CAL_WED' => $user->lang['mini_cal']['day'][4], 
	'L_MINI_CAL_THU' => $user->lang['mini_cal']['day'][5], 
	'L_MINI_CAL_FRI' => $user->lang['mini_cal']['day'][6], 
	'L_MINI_CAL_SAT' => $user->lang['mini_cal']['day'][7], 
	'U_PREV_MONTH' => $prev_month,
	'U_NEXT_MONTH' => $next_month,
));

?>