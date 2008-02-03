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

if (!defined('IN_MINI_CAL'))
{
	exit;
}

    /***************************************************************************
        getFormattedDate
        
        version:        1.0.0
        parameters:     $cal_weekday    - 
                        $cal_month      - 
                        $cal_monthday   - 
                        $cal_year       - 
                        $cal_hour       - 
                        $cal_min        - 
                        $cal_sec        -
                        
        returns:        a date formatted according to the MINI_CAL_DATE_PATTERNS 
                        set in mini_cal_config.php and the Mini_Cal_date_format 
                        set in lang_main_min_cal.php
     ***************************************************************************/
    function getFormattedDate($cal_weekday, $cal_month, $cal_monthday, $cal_year, $cal_hour, $cal_min, $cal_sec, $format)
    {
		global $lang;
		
        // initialise out date formatting patterns
        $cal_date_pattern = unserialize(MINI_CAL_DATE_PATTERNS);

        $cal_date_replace = array( 
            $lang['mini_cal']['day'][$cal_weekday], 
            $lang['mini_cal']['month'][$cal_month], 
            $cal_month, 
            ( (strlen($cal_monthday) < 2 ) ?  '0' : '' ) . $cal_monthday, 
            $cal_monthday, 
            ( (strlen($cal_month) < 2 ) ?  '0' : '' ) . $cal_month, 
            substr($cal_year, -2),
            $cal_year,
            ( (strlen($cal_hour) < 2 ) ?  '0' : '' ) . $cal_hour,
            $cal_hour,
            ( (strlen($cal_hour) < 2 ) ?  '0' : '' ) . ( ( $cal_hour > 12 ) ? $cal_hour-12 : $cal_hour ),
            ( $cal_hour > 12 ) ? $cal_hour-12 : $cal_hour,
            $cal_min,
            $cal_sec,
            ( $cal_hour < 12 ) ? 'AM' : 'PM'
        );
        
        return preg_replace($cal_date_pattern, $cal_date_replace, $format); 
    }
    


    /***************************************************************************
        setQueryStringVal
        
        version:        1.0.0
        parameters:     $var    - the variable who's value is to be replaced
                        $value  - the new value for the variable
                        
        returns:        a modified querystring prefixed with ? 
     ***************************************************************************/
    function setQueryStringVal($var, $value)
    {
        $querystring = $_SERVER["QUERY_STRING"];
    
        if (!stristr($querystring, $var))
        { 
            $querystring .= ($querystring) ? '&' : '';
            $querystring .= "$var=$value";
        } 
        else 
        { 
            $querystring = ereg_replace("($var=[[:digit:]]{1,3})", "$var=$value", $querystring);
        } 
        return '?' . $querystring;
    }    
	
	
    /***************************************************************************
        getPostForumsList
        
        version:        1.0.0
        parameters:     $mini_cal_post_auth  - a comma seperated list of forms with post rights
                        
        returns:        adds a forums select list to the template output
    ***************************************************************************/
	function getPostForumsList($mini_cal_post_auth, $and_post_auth_sql = '')
	{
   		if ($mini_cal_post_auth)
	   	{
			global $db, $template, $lang;

	       // get a list of events forums
	       $sql = 'SELECT c.cat_id, c.cat_title, f.forum_id, f.forum_name 
	            FROM '  . FORUMS_TABLE . ' f, ' . CATEGORIES_TABLE . ' c 
	            WHERE f.cat_id = c.cat_id 
	              AND f.forum_id IN (' . $mini_cal_post_auth . ')' . 
				  $and_post_auth_sql;
			
	       if( $result = $db->sql_query($sql) )
		   {
	           $num_rows = $db->sql_numrows($result);
	           if ( $num_rows > 0 )
	           {
	               $template->assign_block_vars('switch_mini_cal_add_events', array());
	    
	               $forums_list = '<select style="width: 100%" name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value > -1){ forms[\'mini_cal\'].submit() }">';
	               	                    
	               $cat_id = 0;
	       	       while ($row = $db->sql_fetchrow($result))
	               {
	                    $forums_list .=  '<option value="' . $row['forum_id'] . '"' . $selected . '>  - ' . substr($row['forum_name'],0,20) . '</option>';
	               }
	               $forums_list .= '</select>';
	               
	               $template->assign_vars( array(
	                    'S_MINI_CAL_EVENTS_FORUMS_LIST' => $forums_list 
	                    )
	               );
	           }    
	           $db->sql_freeresult($result);
	       }
		}
   }
	
?>