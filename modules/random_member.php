<?php
/**
*
* @package Board3 Portal v2.3
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace board3\portal\modules;

/**
* @package Random Member
*/
class random_member extends module_base
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
	public $name = 'PORTAL_RANDOM_MEMBER';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_random_member.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_random_member_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = '';

	/** @var \phpbb\db\driver */
	protected $db;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/**
	* Construct a random member object
	*
	* @param \phpbb\db\driver $db phpBB database system
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\user $user phpBB user object
	* @param string $phpbb_root_path phpBB root path
	* @param string $phpEx PHP file extension
	*/
	public function __construct($db, $template, $user, $phpbb_root_path, $phpEx)
	{
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		switch ($this->db->get_sql_layer())
		{
			case 'postgres':
			$sql = 'SELECT *
				FROM ' . USERS_TABLE . '
				WHERE user_type <> ' . USER_IGNORE . '
				AND user_type <> ' . USER_INACTIVE . '
				ORDER BY RANDOM()';
			break;

			case 'mssql':
			case 'mssql_odbc':
			$sql = 'SELECT *
				FROM ' . USERS_TABLE . '
				WHERE user_type <> ' . USER_IGNORE . '
				AND user_type <> ' . USER_INACTIVE . '
				ORDER BY NEWID()';
			break;

			default:
			$sql = 'SELECT *
				FROM ' . USERS_TABLE . '
				WHERE user_type <> ' . USER_IGNORE . '
				AND user_type <> ' . USER_INACTIVE . '
				ORDER BY RAND()';
			break;
		}

		$result = $this->db->sql_query_limit($sql, 1);
		$row = $this->db->sql_fetchrow($result);

		if (!function_exists('phpbb_get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		$avatar_img = phpbb_get_user_avatar($row);
		$rank_data = phpbb_get_user_rank($row, $row['user_posts']);

		$username = $row['username'];
		$user_id = (int) $row['user_id'];
		$colour = $row['user_colour'];

		$this->template->assign_block_vars('random_member', array(
			'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
			'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
			'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
			'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

			'RANK_TITLE'		=> $rank_data['title'],
			'RANK_IMG'			=> $rank_data['img'],
			'RANK_IMG_SRC'		=> $rank_data['img_src'],

			'USER_POSTS'	=> (int) $row['user_posts'],
			'AVATAR_IMG'	=> $avatar_img,
			'JOINED'		=> $this->user->format_date($row['user_regdate']),
//			'USER_OCC'		=> censor_text($row['user_occ']),
//			'USER_FROM'		=> censor_text($row['user_from']),
//			'U_WWW'			=> censor_text($row['user_website']),
		));
		$this->db->sql_freeresult($result);

		return 'random_member_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'PORTAL_RANDOM_MEMBER',
			'vars'	=> array(),
		);
	}
}
