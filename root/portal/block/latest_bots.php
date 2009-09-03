<?php

/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/


if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

// Last x visited bots
$sql = 'SELECT username, user_colour, user_lastvisit
	FROM ' . USERS_TABLE . '
	WHERE user_type = ' . USER_IGNORE . '
	ORDER BY user_lastvisit DESC';
$result = $db->sql_query_limit($sql, $portal_config['portal_last_visited_bots_number']);
$first = true;
while ($row = $db->sql_fetchrow($result))
{
	if (!$row['user_lastvisit'] && $first == TRUE)
	{
		$template->assign_vars(array(
			'S_DISPLAY_LAST_BOTS'	=> false,
		));
	}
	else 
	{
		$template->assign_var('S_DISPLAY_LAST_BOTS', true);

		if( $row['user_lastvisit'] > 0 )
		{
			$template->assign_block_vars('last_visited_bots', array(
				'BOT_NAME'			=> get_username_string('full', '', $row['username'], $row['user_colour']),
				'LAST_VISIT_DATE'	=> $user->format_date($row['user_lastvisit']),
			));
		}
	}
	$first = false;
}
$db->sql_freeresult($result);

// Assign specific vars
$template->assign_vars(array(
	'LAST_VISITED_BOTS'		=> sprintf($user->lang['LAST_VISITED_BOTS'], $portal_config['portal_last_visited_bots_number']),
	'S_LAST_VISITED_BOTS'	=> ($portal_config['portal_load_last_visited_bots']) ? true : false,
));

?>