<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package Latest Bots
*/
class latest_bots extends module_base
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

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a latest bots object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\db\driver\driver_interface $db phpBB db driver
	* @param \phpbb\template\template $template phpBB template
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($config, $db, $template, $user)
	{
		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		// Last x visited bots
		$sql = 'SELECT username, user_colour, user_lastvisit
			FROM ' . USERS_TABLE . '
			WHERE user_type = ' . USER_IGNORE . '
			AND user_lastvisit > 0
			ORDER BY user_lastvisit DESC';
		$result = $this->db->sql_query_limit($sql, $this->config['board3_last_visited_bots_number_' . $module_id], 0, 600);

		$show_module = false;

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->template->assign_block_vars('last_visited_bots', array(
				'BOT_NAME'			=> get_username_string('full', '', $row['username'], $row['user_colour']),
				'LAST_VISIT_DATE'	=> $this->user->format_date($row['user_lastvisit']),
			));
			$show_module = true;
		}
		$this->db->sql_freeresult($result);

		if ($show_module)
		{
			return 'latest_bots_side.html';
		}
	}

	/**
	* {@inheritdoc}
	*/
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
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_last_visited_bots_number_' . $module_id, 1);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_last_visited_bots_number_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
