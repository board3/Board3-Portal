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
* @package Latest members
*/
class latest_members extends module_base
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

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a latest_members object
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
		$sql = 'SELECT user_id, username, user_regdate, user_colour
			FROM ' . USERS_TABLE . '
			WHERE user_type <> ' . USER_IGNORE . '
				AND user_inactive_time = 0
			ORDER BY user_regdate DESC';
		$result = $this->db->sql_query_limit($sql, $this->config['board3_max_last_member_' . $module_id], 0, 600);

		while (($row = $this->db->sql_fetchrow($result)) && ($row['username']))
		{
			$this->template->assign_block_vars('latest_members', array(
				'USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'JOINED'		=> $this->user->format_date($row['user_regdate'], $format = 'd M'),
			));
		}
		$this->db->sql_freeresult($result);

		return 'latest_members_side.html';
	}

	/**
	* {@inheritdoc}
	*/
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
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_max_last_member_' . $module_id, 8);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_max_last_member_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
