<?php
/**
* @package Portal - Clock
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge($lang, array(
	'PORTAL_CALENDAR'			=> 'Calendar',
	'VIEW_NEXT_MONTH'		=> 'next month',
	'VIEW_PREVIOUS_MONTH'	=> 'Previous month',
	'EVENT_START'			=> 'From',
	'EVENT_END'				=> 'To',
	'EVENT_TIME'			=> 'Time',
	'EVENT_ALL_DAY'			=> 'All Day Event',
	'CURRENT_EVENTS'		=> 'Current Events',
	'NO_CUR_EVENTS'			=> 'No current events',
	'UPCOMING_EVENTS'		=> 'Upcoming Events',
	'NO_UPCOMING_EVENTS'	=> 'No upcoming events',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Su',
			'2'	=> 'Mo',
			'3'	=> 'Tu',
			'4'	=> 'We',
			'5'	=> 'Th',
			'6'	=> 'Fr',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Jan.',
			'2'	=> 'Feb.',
			'3'	=> 'Mar.',
			'4'	=> 'Apr.',
			'5'	=> 'May',
			'6'	=> 'Jun.',
			'7'	=> 'Jul.',
			'8'	=> 'Aug.',
			'9'	=> 'Sep.',
			'10'=> 'Oct.',
			'11'=> 'Nov.',
			'12'=> 'Dec.',
		),

		'long_month'=> array(
			'1'	=> 'January',
			'2'	=> 'February',
			'3'	=> 'March',
			'4'	=> 'April',
			'5'	=> 'May',
			'6'	=> 'June',
			'7'	=> 'July',
			'8'	=> 'August',
			'9'	=> 'September',
			'10'=> 'October',
			'11'=> 'November',
			'12'=> 'December',
		),
	),
));

?>