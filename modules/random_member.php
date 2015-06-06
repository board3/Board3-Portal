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

	/**
	* Construct a random member object
	*
	* @param \phpbb\db\driver $db phpBB database system
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($db, $template, $user)
	{
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
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

		$avatar_img = phpbb_get_avatar(\phpbb\avatar\manager::clean_row($row, 'user'), 'USER_AVATAR');

		$rank_title = $rank_img = $rank_img_src = '';
		get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);

		$username = $row['username'];
		$user_id = (int) $row['user_id'];
		$colour = $row['user_colour'];

		$this->template->assign_block_vars('random_member', array(
			'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
			'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
			'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
			'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

			'RANK_TITLE'	=> $rank_title,
			'RANK_IMG'		=> $rank_img,
			'RANK_IMG_SRC'	=> $rank_img_src,

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
