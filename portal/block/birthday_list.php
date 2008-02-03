<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

// Generate birthday list if required ...   / borrowed from index.php (RC4)
$birthday_list = '';
$birthday_ahead_list = '';
if ($config['load_birthdays'] && $config['allow_birthdays'])
{
   $now = getdate(time() + $user->timezone + $user->dst - date('Z'));
    $today = (mktime(0, 0, 0, $now['mon'], $now['mday'], $now['year']));
   
   $sql = 'SELECT user_id, username, user_colour, user_birthday
      FROM ' . USERS_TABLE . "
      WHERE user_birthday <> ''
         AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ') ORDER BY SUBSTRING(user_birthday FROM 4 FOR 2) ASC, SUBSTRING(user_birthday FROM 1 FOR 2) ASC, username_clean ASC';
   $result = $db->sql_query($sql);

   while ($row = $db->sql_fetchrow($result))
   {
      $birthdaydate = (gmdate('Y') . '-' . trim(substr($row['user_birthday'],3,-5)) . '-' . trim(substr($row['user_birthday'],0,-8) ));
       $user_birthday = strtotime($birthdaydate);
      if($user_birthday == $today)
      {
      $birthday_list .= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

      if ($age = (int) substr($row['user_birthday'], -4))
      {
         $birthday_list .= ' (' . ($now['year'] - $age) . ')<br  />'."\n";
      }      
      }
       
      if( $portal_config['portal_birthdays_ahead'] > 0 )
      {
        if ( $user_birthday >= ($today + 86400) && $user_birthday <= ($today + ($portal_config['portal_birthdays_ahead'] * 86400) ) )
        {
         if ($row['user_colour'])
         {
            $user_colour = ' style="color:#' . $row['user_colour'] . '"';
           $row['username'] = '<strong>' . $row['username'] . '</strong>';
         }
         else
         {
           $user_colour = '';
         }

             $birthday_ahead_list .= '<a' . $user_colour . ' href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row['user_id']) . '" title="' . date('d M', $user_birthday) . '">' . $row['username'] . '</a>';

         if ( $age = (int) substr($row['user_birthday'], -4) )
         {
           $birthday_ahead_list .= ' (' . ($now['year'] - $age) . ')<br  />'."\n";
         }
        }
       }
   }
   $db->sql_freeresult($result);
}

// Assign index specific vars
$template->assign_vars(array(
   'BIRTHDAY_LIST'   => $birthday_list,
   'BIRTHDAYS_AHEAD_LIST'   => ( $portal_config['portal_birthdays_ahead'] > 0 ) ? $birthday_ahead_list : '',
   'L_BIRTHDAYS_AHEAD'   => sprintf($user->lang['BIRTHDAYS_AHEAD'], $portal_config['portal_birthdays_ahead']),
   'S_DISPLAY_BIRTHDAY_LIST'   => ($config['load_birthdays']) ? true : false,
   )
);

?>