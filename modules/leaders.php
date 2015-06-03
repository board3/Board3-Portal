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
* @package Leaders
*/
class leaders extends module_base
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
	public $name = 'THE_TEAM';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_team.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_leaders_module';

	/** @var \phpbb\auth\auth */
	protected $auth;

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

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a leaders object
	*
	* @param \phpbb\auth\auth $auth phpBB auth service
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\db\driver\driver_interface $db phpBB db driver
	* @param \phpbb\template\template $template phpBB template
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($auth, $config, $db, $template, $phpbb_root_path, $phpEx, $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		// Display a listing of board admins, moderators
		$this->user->add_lang('groups');
		$order_legend = ($this->config['legend_sort_groupname']) ? 'group_name' : 'group_legend';

		if ($this->config['board3_leaders_ext_' . $module_id])
		{
			$legends = array();
			$groups = array();

			if ($this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
			{
				$sql = 'SELECT group_id, group_name, group_colour, group_type, group_legend
					FROM ' . GROUPS_TABLE . '
					WHERE group_legend >= 1
					ORDER BY ' . $order_legend . ' ASC';
			}
			else
			{
				$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type, g.group_legend
					FROM ' . GROUPS_TABLE . ' g
					LEFT JOIN ' . USER_GROUP_TABLE . ' ug
						ON (
							g.group_id = ug.group_id
							AND ug.user_id = ' . $this->user->data['user_id'] . '
							AND ug.user_pending = 0
						)
					WHERE g.group_legend >= 1
						AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . $this->user->data['user_id'] . ')
					ORDER BY g.' . $order_legend . ' ASC';
			}
			$result = $this->db->sql_query($sql, 600);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$groups[$row['group_id']] = array(
					'group_name'	=> $row['group_name'],
					'group_colour'	=> $row['group_colour'],
					'group_type'	=> $row['group_type'],
					'group_users'	=> array(),
				);
				$legends[] = $row['group_id'];
			}
			$this->db->sql_freeresult($result);

			if (sizeof($legends))
			{
				$sql = 'SELECT
							u.user_id AS user_id, u.username AS username, u.username_clean AS username_clean,
							u.user_colour AS user_colour, ug.group_id AS group_id
						FROM
							' . USERS_TABLE . ' AS u,
							' . USER_GROUP_TABLE . ' AS ug
						WHERE
							ug.user_id = u.user_id
							AND '. $this->db->sql_in_set('ug.group_id', $legends) . '
						ORDER BY u.username_clean ASC';
				$result = $this->db->sql_query($sql, 600);

				while ($row = $this->db->sql_fetchrow($result))
				{
					$groups[$row['group_id']]['group_users'][] = array(
						'user_id'		=> $row['user_id'],
						'username'		=> $row['username'],
						'user_colour'	=> $row['user_colour'],
					);
				}
				$this->db->sql_freeresult($result);
			}

			if (sizeof($groups))
			{
				foreach ($groups as $group_id => $group)
				{
					if (sizeof($group['group_users']))
					{
						$group_name = ($group['group_type'] == GROUP_SPECIAL) ? $this->user->lang['G_' . $group['group_name']] : $group['group_name'];
						$u_group = append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=group&amp;g=' . $group_id);

						$this->template->assign_block_vars('group', array(
							'GROUP_NAME'	=> $group_name,
							'GROUP_COLOUR'	=> $group['group_colour'],
							'U_GROUP'		=> $u_group,
						));

						foreach ($group['group_users'] as $group_user)
						{
							$this->template->assign_block_vars('group.member', array(
								'USER_ID'			=> $group_user['user_id'],
								'USERNAME_FULL'		=> get_username_string('full', $group_user['user_id'], $group_user['username'], $group_user['user_colour']),
							));
						}
					}
				}
			}
			return 'leaders_ext_side.html';
		}
		else
		{
			$sql = $this->db->sql_build_query('SELECT', array(
				'SELECT'	=> 'u.user_id, u.group_id as default_group, u.username, u.user_colour, u.user_allow_pm, g.group_id, g.group_name, g.group_colour, g.group_type, g.group_legend, ug.user_id as ug_user_id',
				'FROM'		=> array(
					USERS_TABLE		=> 'u',
					GROUPS_TABLE	=> 'g'
				),
				'LEFT_JOIN'	=> array(
					array(
						'FROM'	=> array(USER_GROUP_TABLE => 'ug'),
						'ON'	=> 'ug.group_id = g.group_id AND ug.user_pending = 0 AND ug.user_id = ' . $this->user->data['user_id']
					)),
				'WHERE'		=> 'u.group_id = g.group_id AND ' . $this->db->sql_in_set('g.group_name', array('ADMINISTRATORS', 'GLOBAL_MODERATORS')),
				'ORDER_BY'	=> 'g.' . $order_legend . ' ASC, u.username_clean ASC'
			));

			$result = $this->db->sql_query($sql, 600);

			while ($row = $this->db->sql_fetchrow($result))
			{
				if ($row['group_name'] == 'ADMINISTRATORS')
				{
					$which_row = 'b3p_admins';
				}
				else if ($row['group_name'] == 'GLOBAL_MODERATORS')
				{
					$which_row = 'b3p_moderators';
				}
				else
				{
					continue;
				}

				if ($row['group_type'] == GROUP_HIDDEN && !$this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel') && $row['ug_user_id'] != $this->user->data['user_id'])
				{
					$group_name = $this->user->lang['GROUP_UNDISCLOSED'];
					$u_group = '';
				}
				else
				{
					$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang['G_' . $row['group_name']] : $row['group_name'];
					$u_group = append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=group&amp;g=' . $row['group_id']);
				}

				$this->template->assign_block_vars($which_row, array(
					'USER_ID'			=> $row['user_id'],
					'GROUP_NAME'		=> $group_name,
					'GROUP_COLOR'		=> $row['group_colour'],

					'U_GROUP'			=> $u_group,

					'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
					'USERNAME'			=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
					'USER_COLOR'		=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour']),
					'U_VIEW_PROFILE'	=> get_username_string('profile', $row['user_id'], $row['username'], $row['user_colour']),
				));
			}
			$this->db->sql_freeresult($result);
			return 'leaders_side.html';
		}
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_LEADERS',
			'vars'	=> array(
				'legend1'				=> 'ACP_PORTAL_LEADERS',
				'board3_leaders_ext_' . $module_id	=> array('lang' => 'PORTAL_LEADERS_EXT',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		// Show normal team block by default
		$this->config->set('board3_leaders_ext_' . $module_id, 0);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_leaders_ext_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
