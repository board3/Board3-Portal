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
* @package Topposters
*/
class topposters extends module_base
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
	public $name = 'TOPPOSTERS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_top_poster.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_topposters_module';

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/**
	* Construct a topposers object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\db\driver\driver_interface $db phpBB db driver
	* @param \phpbb\template\template $template phpBB template
	* @param string $phpbb_root_path phpBB root path
	* @param string $phpEx php file extension
	*/
	public function __construct($config, $db, $template, $phpbb_root_path, $phpEx)
	{
		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		$sql = 'SELECT user_id, username, user_posts, user_colour
			FROM ' . USERS_TABLE . '
			WHERE user_type <> ' . USER_IGNORE . "
				AND user_posts <> 0
				AND username <> ''
			ORDER BY user_posts DESC";
		$result = $this->db->sql_query_limit($sql, $this->config['board3_topposters_' . $module_id], 0, 600);

		while (($row = $this->db->sql_fetchrow($result)))
		{
			$this->template->assign_block_vars('topposters', array(
				'S_SEARCH_ACTION'	=> append_sid("{$this->phpbb_root_path}search.{$this->php_ext}", 'author_id=' . $row['user_id'] . '&amp;sr=posts'),
				'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'POSTER_POSTS'		=> $row['user_posts'],
			));
		}
		$this->db->sql_freeresult($result);

		return 'topposters_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'TOPPOSTERS_CONFIG',
			'vars'	=> array(
				'legend1'							=> 'TOPPOSTERS',
				'board3_topposters_' . $module_id	=> array('lang' => 'NUM_TOPPOSTERS',		'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_topposters_' . $module_id, 5);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_topposters_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
