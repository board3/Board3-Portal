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


if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
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
		$template->assign_vars(array(
			'S_DISPLAY_LAST_BOTS'	=> true,
		));

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
));

if (!isset($template->filename['latest_bots_block']))
{
	$template->set_filenames(array(
		'latest_bots_block'	=> 'portal/block/latest_bots.html')
	);
}

$block_temp = $template->assign_display('latest_bots_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );
?>