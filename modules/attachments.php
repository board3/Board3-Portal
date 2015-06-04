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
* @package Modulname
*/
class attachments extends module_base
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 31;

	/**
	* Default modulename
	*/
	public $name = 'PORTAL_ATTACHMENTS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_attach.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_attachments_module';

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \board3\portal\includes\modules_helper */
	protected $helper;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct an attachments object
	*
	* @param \phpbb\auth\auth $auth phpBB auth service
	* @param \phpbb\config\config $config phpBB config
	* @param \board3\portal\includes\modules_helper $helper Modules helper
	* @param \phpbb\template\template $template phpBB template
	* @param \phpbb\db\driver\driver_interface $db Database driver
	* @param \phpbb\request\request $request phpBB request
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($auth, $config, $helper, $template, $db, $request, $phpEx, $phpbb_root_path, $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->db = $db;
		$this->request = $request;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		return $this->parse_template($module_id, 'center');
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		return $this->parse_template($module_id, 'side');
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS',
				'board3_attachments_number_' . $module_id			=> array('lang' => 'PORTAL_ATTACHMENTS_NUMBER'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
				'board3_attach_max_length_' . $module_id			=> array('lang' => 'PORTAL_ATTACHMENTS_MAX_LENGTH'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
				'board3_attachments_forum_ids_' . $module_id		=> array('lang' => 'PORTAL_ATTACHMENTS_FORUM_IDS',	'validate' => 'string',		'type' => 'custom',	'explain' => true,	'method' => array('board3.portal.modules_helper', 'generate_forum_select'), 'submit' => array('board3.portal.modules_helper', 'store_selected_forums')),
				'board3_attachments_forum_exclude_' . $module_id	=> array('lang' => 'PORTAL_ATTACHMENTS_FORUM_EXCLUDE', 'validate' => 'bool', 'type' => 'radio:yes_no',	 'explain' => true),
				'board3_attachments_filetype_' . $module_id			=> array('lang' => 'PORTAL_ATTACHMENTS_FILETYPE',	'validate' => 'string', 	'type' => 'custom',	'explain' => true,	'method' => 'select_filetype', 'submit' => 'store_filetypes'),
				'board3_attachments_exclude_' . $module_id			=> array('lang' => 'PORTAL_ATTACHMENTS_EXCLUDE', 	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_attachments_number_' . $module_id, 8);
		$this->config->set('board3_attach_max_length_' . $module_id, 15);
		$this->config->set('board3_attachments_forum_ids_' . $module_id, '');
		$this->config->set('board3_attachments_forum_exclude_' . $module_id, 0);
		$this->config->set('board3_attachments_filetype_' . $module_id, '');
		$this->config->set('board3_attachments_exclude_' . $module_id, 0);
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_attachments_number_' . $module_id,
			'board3_attach_max_length_' . $module_id,
			'board3_attachments_forum_ids_' . $module_id,
			'board3_attachments_forum_exclude_' . $module_id,
			'board3_attachments_filetype_' . $module_id,
			'board3_attachments_exclude_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}

	/**
	* Create select box for attachment filetype
	*
	* @param mixed $value Value of input
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return string Forum select box HTML
	*/
	public function select_filetype($value, $key, $module_id)
	{
		$extensions = array();

		// Get extensions
		$sql = 'SELECT *
			FROM ' . EXTENSIONS_TABLE . '
			ORDER BY extension ASC';
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$extensions[] = array(
				'value'	=> $row['extension'],
				'title'	=> $row['extension'],
			);
		}
		$this->db->sql_freeresult($result);

		$selected = $this->get_selected_filetypes($module_id);

		return $this->helper->generate_select_box($key, $extensions, $selected, true);
	}

	/**
	* Store selected filetypes
	*
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function store_filetypes($key, $module_id)
	{
		// Get selected extensions
		$values = $this->request->variable($key, array(0 => ''));

		$filetypes = implode(',', $values);

		$this->config->set('board3_attachments_filetype_' . $module_id, $filetypes);

	}

	/**
	* Parse template variables for module
	*
	* @param int $module_id	Module ID
	* @param string $type	Module type (center or side)
	*
	* @return string	Template file name or false if nothing should
	*			be displayed
	*/
	protected function parse_template($module_id, $type)
	{
		$attach_forums = false;
		$where = '';

		// Get filetypes and put them into an array
		$filetypes = $this->get_selected_filetypes($module_id);

		if ($this->config['board3_attachments_forum_ids_' . $module_id] !== '')
		{
			$attach_forums_config = (strpos($this->config['board3_attachments_forum_ids_' . $module_id], ',') !== false) ? explode(',', $this->config['board3_attachments_forum_ids_' . $module_id]) : array($this->config['board3_attachments_forum_ids_' . $module_id]);
			$forum_list =  array_unique(array_keys($this->auth->acl_getf('f_read', true)));

			if ($this->config['board3_attachments_forum_exclude_' . $module_id])
			{
				$forum_list = array_unique(array_diff($forum_list, $attach_forums_config));
			}
			else
			{
				$forum_list =  array_unique(array_intersect($attach_forums_config, $forum_list));
			}
		}
		else
		{
			$forum_list =  array_unique(array_keys($this->auth->acl_getf('f_read', true)));
		}

		if (sizeof($forum_list))
		{
			$attach_forums = true;
			$where = 'AND ' . $this->db->sql_in_set('t.forum_id', $forum_list);
		}

		if (sizeof($filetypes))
		{
			if ($this->config['board3_attachments_exclude_' . $module_id])
			{
				$where .= ' AND ' . $this->db->sql_in_set('a.extension', $filetypes, true);
			}
			else
			{
				$where .= ' AND ' . $this->db->sql_in_set('a.extension', $filetypes);
			}
		}

		if ($attach_forums === true)
		{
			// Just grab all attachment info from database
			$sql = 'SELECT
						a.*,
						t.forum_id
					FROM
						' . ATTACHMENTS_TABLE . ' a,
						' . TOPICS_TABLE . ' t
					WHERE
						a.topic_id <> 0
						AND a.topic_id = t.topic_id
						' . $where . '
					ORDER BY
						filetime ' . ((!$this->config['display_order']) ? 'DESC' : 'ASC') . ', post_msg_id ASC';
			$result = $this->db->sql_query_limit($sql, $this->config['board3_attachments_number_' . $module_id], 0, 600);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$size_lang = ($row['filesize'] >= 1048576) ? $this->user->lang['MIB'] : (($row['filesize'] >= 1024) ? $this->user->lang['KIB'] : $this->user->lang['BYTES']);
				$row['filesize'] = ($row['filesize'] >= 1048576) ? round((round($row['filesize'] / 1048576 * 100) / 100), 2) : (($row['filesize'] >= 1024) ? round((round($row['filesize'] / 1024 * 100) / 100), 2) : $row['filesize']);

				$raw_filename = utf8_substr($row['real_filename'], 0, strrpos($row['real_filename'], '.'));
				$replace = character_limit($raw_filename, $this->config['board3_attach_max_length_' . $module_id]);

				$this->template->assign_block_vars('attach_' . $type, array(
					'FILESIZE'			=> $row['filesize'] . ' ' . $size_lang,
					'FILETIME'			=> $this->user->format_date($row['filetime']),
					'DOWNLOAD_COUNT'	=> (int) $row['download_count'], // grab downloads count
					'FILENAME'			=> $replace,
					'REAL_FILENAME'		=> $row['real_filename'],
					'PHYSICAL_FILENAME'	=> basename($row['physical_filename']),
					'ATTACH_ID'			=> $row['attach_id'],
					'POST_IDS'			=> (!empty($post_ids[$row['attach_id']])) ? $post_ids[$row['attach_id']] : '',
					'POST_MSG_ID'		=> $row['post_msg_id'], // grab post ID to redirect to post
					'U_FILE'			=> append_sid($this->phpbb_root_path . 'download/file.' . $this->php_ext, 'id=' . $row['attach_id']),
					'U_TOPIC'			=> append_sid($this->phpbb_root_path . 'viewtopic.' . $this->php_ext, 'p='.$row['post_msg_id'].'#p'.$row['post_msg_id']),
				));
			}
			$this->db->sql_freeresult($result);

			$this->template->assign_var('S_DISPLAY_ATTACHMENTS', true);
		}
		else
		{
			$this->template->assign_var('S_DISPLAY_ATTACHMENTS', false);
		}

		return 'attachments_' . $type . '.html';
	}

	/**
	* Get the filetypes that were selected in the ACP
	*
	* @param int $module_id Module ID
	*
	* @return array An array with the selected filetypes
	*/
	protected function get_selected_filetypes($module_id)
	{
		$selected = array();
		if (isset($this->config['board3_attachments_filetype_' . $module_id]) && strlen($this->config['board3_attachments_filetype_' . $module_id]) > 0)
		{
			$selected = explode(',', $this->config['board3_attachments_filetype_' . $module_id]);
		}

		return $selected;
	}
}
