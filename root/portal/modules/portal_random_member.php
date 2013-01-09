<?php
/**
*
* @package Board3 Portal v2 - Random Member
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
* @package Random Member
*/
class portal_random_member_module
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

	public function get_template_side($module_id)
	{
		global $config, $template, $db, $user;

		switch ($db->sql_layer)
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

		$result = $db->sql_query_limit($sql, 1);
		$row = $db->sql_fetchrow($result);

		$avatar_img = get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']);

		$rank_title = $rank_img = '';
		get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);

		$username = $row['username'];
		$user_id = (int) $row['user_id'];
		$colour = $row['user_colour'];

		$template->assign_block_vars('random_member', array(
			'USERNAME_FULL'		=> get_username_string('full', $user_id, $username, $colour),
			'USERNAME'			=> get_username_string('username', $user_id, $username, $colour),
			'USER_COLOR'		=> get_username_string('colour', $user_id, $username, $colour),
			'U_VIEW_PROFILE'	=> get_username_string('profile', $user_id, $username, $colour),

			'RANK_TITLE'	=> $rank_title,
			'RANK_IMG'		=> $rank_img,
			'RANK_IMG_SRC'	=> $rank_img_src,

			'USER_POSTS'	=> (int) $row['user_posts'],
			'AVATAR_IMG'	=> $avatar_img,
			'JOINED'		=> $user->format_date($row['user_regdate'], 'd.M.Y'),
			'USER_OCC'		=> censor_text($row['user_occ']),
			'USER_FROM'		=> censor_text($row['user_from']),
			'U_WWW'			=> censor_text($row['user_website']),
		));
		$db->sql_freeresult($result);

		return 'random_member_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'PORTAL_RANDOM_MEMBER',
			'vars'	=> array(),
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		return true;
	}

	public function uninstall($module_id)
	{
		return true;
	}
}
