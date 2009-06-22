<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
	exit;
}

// Generate birthday list if required ... / borrowed from index.php 3.0.6
$birthday_list = $birthday_ahead_list = '';
if ($config['load_birthdays'] && $config['allow_birthdays'])
{
	$now = getdate(time() + $user->timezone + $user->dst - date('Z'));
	$cache_days = $portal_config['portal_birthdays_ahead'];
	$sql_days = '';
	while ($cache_days > 0)
	{
		$day = getdate(time() + 86400 * $cache_days + $user->timezone + $user->dst - date('Z'));
		$sql_days .= " OR u.user_birthday LIKE '" . $db->sql_escape(sprintf('%2d-%2d-', $day['mday'], $day['mon'])) . "%'";
		$cache_days--;
	}

	switch ($db->sql_layer)
	{
		case 'mssql':
		case 'mssql_odbc':
			$order_by = 'u.user_birthday ASC';
		break;

		default:
			$order_by = 'SUBSTRING(u.user_birthday FROM 4 FOR 2) ASC, SUBSTRING(u.user_birthday FROM 1 FOR 2) ASC, u.username_clean ASC';
		break;
	}
	$now = getdate(time() + $user->timezone + $user->dst - date('Z'));
	$sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_birthday
		FROM ' . USERS_TABLE . ' u
		LEFT JOIN ' . BANLIST_TABLE . " b ON (u.user_id = b.ban_userid)
		WHERE (b.ban_id IS NULL
				OR b.ban_exclude = 1)
			AND (u.user_birthday LIKE '" . $db->sql_escape(sprintf('%2d-%2d-', $now['mday'], $now['mon'])) . "%' {$sql_days}
			AND u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')
		ORDER BY ' . $order_by;
	$result = $db->sql_query($sql);
	$today = sprintf('%2d-%2d-', $now['mday'], $now['mon']);

	while ($row = $db->sql_fetchrow($result))
	{
		if (substr($row['user_birthday'], 0, 6) == $today)
		{
			$birthday_list .= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);
			if ($age = (int) substr($row['user_birthday'], -4))
			{
				$birthday_list .= ' (' . ($now['year'] - $age) . ')';
			}
			$birthday_list .= '<br /><br />';
		}
		else
		{
			$birthday_ahead_list .= '<span title="' . format_birthday($user_birthday, 'd M') . '">' . get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']) . '</span>';
			if ($age = (int) substr($row['user_birthday'], -4))
			{
				$birthday_ahead_list .= ' (' . ($now['year'] - $age) . ')';
			}
			$birthday_ahead_list .= '<br /><br />';
		}
	}
	$db->sql_freeresult($result);
}

// Assign index specific vars
$template->assign_vars(array(
	'BIRTHDAY_LIST'				=> $birthday_list,
	'BIRTHDAYS_AHEAD_LIST'		=> ($portal_config['portal_birthdays_ahead']) ? $birthday_ahead_list : '',
	'L_BIRTHDAYS_AHEAD'			=> sprintf($user->lang['BIRTHDAYS_AHEAD'], $portal_config['portal_birthdays_ahead']),
	'S_DISPLAY_BIRTHDAY_LIST'	=> ($config['load_birthdays']) ? true : false,
));

?>