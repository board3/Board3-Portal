<?php
/**
*
* @package Board3 Portal v2 - Latest Members
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
* @package Modulname
*/
class portal_latest_members_module
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
	public $name = 'LATEST_MEMBERS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_members.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_latest_members_module';

	public function get_template_side($module_id)
	{
		global $config, $template, $db, $user;

		$sql = 'SELECT user_id, username, user_regdate, user_colour
			FROM ' . USERS_TABLE . '
			WHERE user_type <> ' . USER_IGNORE . '
				AND user_inactive_time = 0
			ORDER BY user_regdate DESC';
		$result = $db->sql_query_limit($sql, $config['board3_max_last_member_' . $module_id]);

		while(($row = $db->sql_fetchrow($result)) && ($row['username']))
		{
			$template->assign_block_vars('latest_members', array(
				'USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'JOINED'		=> $user->format_date($row['user_regdate'], $format = 'd M'),
			));
		}
		$db->sql_freeresult($result);

		return 'latest_members_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_MEMBERS_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_MEMBERS_SETTINGS',
				'board3_max_last_member_' . $module_id			=> array('lang' => 'PORTAL_MAX_LAST_MEMBER'			 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
			)
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_max_last_member_' . $module_id, 8);
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_max_last_member_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
