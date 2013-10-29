<?php
/**
*
* @package Board3 Portal v2 - Friends
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package Friends
*/
class portal_friends_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 10;

	/**
	* Default modulename
	*/
	public $name = 'FRIENDS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_friends.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_friends_module';

	public function get_template_side($module_id)
	{
		global $config, $template, $db, $user, $auth;

		$s_display_friends = false;

		// Output listing of friends online
		$update_time = $config['load_online_time'] * 60;

		$sql = $db->sql_build_query('SELECT_DISTINCT', array(
			'SELECT'	=> 'u.user_id, u.username, u.username_clean, u.user_colour, u.user_allow_viewonline, MAX(s.session_time) as online_time, MIN(s.session_viewonline) AS viewonline',
			'FROM'		=> array(
				USERS_TABLE	=> 'u',
				ZEBRA_TABLE	=> 'z'
			),

			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(SESSIONS_TABLE => 's'),
					'ON'	=> 's.session_user_id = z.zebra_id'
				)
			),

			'WHERE'		=> 'z.user_id = ' . $user->data['user_id'] . '
				AND z.friend = 1
				AND u.user_id = z.zebra_id',
			'GROUP_BY'	=> 'z.zebra_id, u.user_id, u.username, u.username_clean, u.user_allow_viewonline, u.user_colour',
			'ORDER_BY'   => 'u.username_clean ASC',
		));

		$result = $db->sql_query_limit($sql, $config['board3_max_online_friends_' . $module_id]);

		while ($row = $db->sql_fetchrow($result))
		{
			$which = (time() - $update_time < $row['online_time'] && ($row['viewonline'] || $auth->acl_get('u_viewonline'))) ? 'online' : 'offline';
			$s_display_friends = ($row['user_id']) ? true : false;

			$template->assign_block_vars("b3p_friends_{$which}", array(
				'USER_ID'		=> $row['user_id'],
				'U_PROFILE'		=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
				'USER_COLOUR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour']),
				'USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
				'USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']))
			);
		}
		$db->sql_freeresult($result);

		// Assign specific vars
		$template->assign_vars(array(
			'S_DISPLAY_FRIENDS'	=> $s_display_friends,
		));

		return 'friends_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_FRIENDS_SETTINGS',
			'vars'	=> array(
				'legend1'					=> 'ACP_PORTAL_FRIENDS_SETTINGS',
				'board3_max_online_friends_' . $module_id	=> array('lang' => 'PORTAL_MAX_ONLINE_FRIENDS',	'validate' => 'int',	'type' => 'text:3:3', 'explain' => true),
			)
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_max_online_friends_' . $module_id, 8);
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_max_online_friends_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
