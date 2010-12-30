<?php

/**
*
* @package - Board3portal
* @version $Id: mini_cal.php 630 2010-03-14 15:13:05Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @copyright (c) Adrian Cockburn - phpbb@netclectic.com (mini calendar)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

// 0 = Sunday first - 1 = Monday first. ;-)
if ($portal_config['portal_sunday_first'])
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

// initialise our calendarsuite class
$mini_cal = new calendar();

// initialise some variables
$mini_cal_today = date('Ymd', time() + $user->timezone + $user->dst - date('Z'));
$s_cal_month = ($mini_cal_month != 0) ? $mini_cal_month . ' month' : $mini_cal_today;
$mini_cal->getMonth($s_cal_month);
$mini_cal_count = MINI_CAL_FDOW;
$mini_cal_this_year = $mini_cal->dateYYYY;
$mini_cal_this_month = $mini_cal->dateMM;
$mini_cal_this_day = $mini_cal->dateDD;
$mini_cal_month_days = $mini_cal->daysMonth;

// output the days for the current month 
for($i=0; $i < $mini_cal_month_days;) 
{
	// is this the first day of the week?
	if($mini_cal_count == MINI_CAL_FDOW)
	{
		$template->assign_block_vars('mini_cal_row', array());
	}

	// is this a valid weekday?
	if($mini_cal_count == ($mini_cal->day[$i][3])) 
	{
		$mini_cal_this_day = $mini_cal->day[$i][0];

		$d_mini_cal_today = $mini_cal_this_year . (($mini_cal_this_month <= 9) ? '0' . $mini_cal_this_month : $mini_cal_this_month) . (($mini_cal_this_day <= 9) ? '0' . $mini_cal_this_day : $mini_cal_this_day);
		$mini_cal_day = ($mini_cal_today == $d_mini_cal_today) ? '<span style="font-weight: bold; color: ' . $portal_config['portal_minicalendar_today_color'] . ';">' . $mini_cal_this_day . '</span>' : $mini_cal_this_day;

		$template->assign_block_vars('mini_cal_row.mini_cal_days', array(
			'MINI_CAL_DAY'		=> ($mini_cal_count == 0) ? '<span style="color: ' . $portal_config['portal_minicalendar_sunday_color'] . ';">' . $mini_cal_day . '</span>' : $mini_cal_day)
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
$prev_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m=$down#minical") . '"><img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/mini_cal_icon_left_arrow.png' . '" title="' . $user->lang['VIEW_PREVIOUS_MONTH'] . '" height="16" width="16" alt="&lt;&lt;" /></a>';
$next_month = '<a href="' . append_sid("{$phpbb_root_path}portal.$phpEx", "m=$up#minical") . '"><img src="' . $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/mini_cal_icon_right_arrow.png' . '" title="' . $user->lang['VIEW_NEXT_MONTH'] . '" height="16" width="16" alt="&gt;&gt;" /></a>';

$template->assign_vars(array(
	'S_DISPLAY_MINICAL'	=> true,
	'S_SUNDAY_FIRST'	=> ($portal_config['portal_sunday_first']) ? true : false,
	'L_MINI_CAL_MONTH'	=> (($portal_config['portal_long_month']) ? $user->lang['mini_cal']['long_month'][$mini_cal->day[0][1]] : $user->lang['mini_cal']['month'][$mini_cal->day[0][1]]) . " " . $mini_cal->day[0][2],
	'L_MINI_CAL_SUN'	=> '<span style="color: ' . $portal_config['portal_minicalendar_sunday_color'] . ';">' . $user->lang['mini_cal']['day'][1] . '</span>', 
	'L_MINI_CAL_MON'	=> $user->lang['mini_cal']['day'][2], 
	'L_MINI_CAL_TUE'	=> $user->lang['mini_cal']['day'][3], 
	'L_MINI_CAL_WED'	=> $user->lang['mini_cal']['day'][4], 
	'L_MINI_CAL_THU'	=> $user->lang['mini_cal']['day'][5], 
	'L_MINI_CAL_FRI'	=> $user->lang['mini_cal']['day'][6], 
	'L_MINI_CAL_SAT'	=> $user->lang['mini_cal']['day'][7], 
	'U_PREV_MONTH'		=> $prev_month,
	'U_NEXT_MONTH'		=> $next_month)
);

if (!isset($template->filename['mini_cal_block']))
{
	$template->set_filenames(array(
		'mini_cal_block'	=> 'portal/block/mini_calendar.html')
	);
}

?>