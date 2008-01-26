<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @copyright (c) Adrian Cockburn - phpbb@netclectic.com (mini calendar)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_MINI_CAL'))
{
	exit;
}

/***************************************************************************

The following values are configurable to tailor the mini cal to your needs.

***************************************************************************/

// Defines which events calendar you are using, if any
// possible values:
//      MYCAL       - MyCalendar
//      PLUS        - MyCalendar+
//      TOPIC       - Topic Calendar
//      SNAIL       - Websnail Calendar Pro
//      SNAILLITE   - Websnail Calendar Lite
//      NONE        - No Supported Calendar is installed
define('MINI_CAL_CALENDAR_VERSION', 'NONE');


// EVENTS CALENDAR USERS ONLY!
// Limits the number of events shown on the mini cal
define('MINI_CAL_LIMIT', 5);


// EVENTS CALENDAR USERS ONLY!
// Limits the number of days ahead in which time upcoming events will be shown
// set to 0 (zero) for umlimited
define('MINI_CAL_DAYS_AHEAD', 7);


// Defines what type of search happens when a user clicks on a date in the calendar
// possible values:
//      POSTS   - will return all posts posted on that date
//      EVENTS  - will return all events happening on that date (ONLY SUITABLE FOR EVENTS CALENDAR USERS).
define('MINI_CAL_DATE_SEARCH', 'POSTS');


// First Day of the Week - 0=Sunday, 1=Monday...6=Saturday
// if you change this remember to change the short day names in lang_main_mini_cal.php
define('MINI_CAL_FDOW', 1);


// Defines the css class to use for mini cal days urls 
define('MINI_CAL_DAY_LINK_CLASS', 'gensmall');

// Defines the css class to use for mini cal today date
define('MINI_CAL_TODAY_CLASS', 'gensmall');


// defines the authentication level required to be able to view the upcoming events
// this relates to the permission level assigned to forum
// possible values:
//		auth_view, auth_read, auth_post, auth_reply, auth_edit, 
//		auth_delte, auth_sticky, auth_announce, auth_vote, auth_pollcreate
define('MINI_CAL_EVENT_AUTH_LEVEL', 'auth_view');


/***************************************************************************

You should NOT modify any values below here.

***************************************************************************/

// DO NOT MODIFY THIS!
define('MINI_CAL_DATE_PATTERNS', serialize(array('/%a/', '/%b/', '/%c/', '/%d/', '/%e/', '/%m/', '/%y/', '/%Y/', 
                    '/%H/', '/%k/', '/%h/', '/%l/', '/%i/', '/%s/', '/%p/')));

?>