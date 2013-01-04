<?php
/**
*
* @package Board3 Portal v2 - Latest Bots
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
* @package Latest Bots
*/
class portal_latest_bots_module
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
	public $name = 'LATEST_BOTS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_bots.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_latest_bots_module';

	/**
	* hide module name in ACP configuration page
	*/
	public $hide_name = false;


	public function get_template_side($module_id)
	{
		global $config, $template, $db, $user;

		// Last x visited bots
		$sql = 'SELECT username, user_colour, user_lastvisit
			FROM ' . USERS_TABLE . '
			WHERE user_type = ' . USER_IGNORE . '
			AND user_lastvisit > 0
			ORDER BY user_lastvisit DESC';
		$result = $db->sql_query_limit($sql, $config['board3_last_visited_bots_number_' . $module_id]);

		$show_module = false;

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('last_visited_bots', array(
				'BOT_NAME'			=> get_username_string('full', '', $row['username'], $row['user_colour']),
				'LAST_VISIT_DATE'	=> $user->format_date($row['user_lastvisit']),
			));
			$show_module = true;
		}
		$db->sql_freeresult($result);

		if($show_module)
		{
			return 'latest_bots_side.html';
		}
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_BOTS_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_BOTS_SETTINGS',
				'board3_last_visited_bots_number_' . $module_id	=> array('lang' => 'PORTAL_LAST_VISITED_BOTS_NUMBER' ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
			)
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_last_visited_bots_number_' . $module_id, 1);
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_last_visited_bots_number_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
