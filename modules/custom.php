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
* @package Custom
*/
class custom extends module_base
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
	public $name = 'PORTAL_CUSTOM';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_custom.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_custom_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = 'acp_portal_custom';

	/** @var bool Can include this module multiple times */
	protected $multiple_includes = true;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\db\driver */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\log\log phpBB log*/
	protected $log;

	/**
	* Construct a custom module object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\db\driver $db Database driver
	* @param \phpbb\request\request $request phpBB request
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	* @param \phpbb\log\log $log phpBB log
	*/
	public function __construct($config, $template, $db, $request, $phpbb_root_path, $phpEx, $user, $log)
	{
		$this->config = $config;
		$this->template = $template;
		$this->db = $db;
		$this->request = $request;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
		$this->log = $log;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		return $this->parse_template($module_id);
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
			'title'	=> 'PORTAL_CUSTOM',
			'vars'	=> array(
				'legend1'								=> 'PORTAL_CUSTOM',
				'board3_custom_' . $module_id . '_code'	=> array('lang' => 'PORTAL_CUSTOM',		'validate' => 'string',	'type' => 'custom', 'method' => 'manage_custom', 'submit' => 'update_custom', 'explain' => true),
			),
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		set_portal_config('board3_custom_' . $module_id . '_code', '');
		$this->config->set('board3_custom_' . $module_id . '_code', '');
		$this->config->set('board3_custom_' . $module_id . '_bbcode', 1);
		$this->config->set('board3_custom_' . $module_id . '_title', '');
		$this->config->set('board3_custom_' . $module_id . '_image_src', '');
		$this->config->set('board3_custom_' . $module_id . '_uid', '');
		$this->config->set('board3_custom_' . $module_id . '_bitfield', '');
		$this->config->set('board3_custom_' . $module_id . '_permission', '');
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_custom_' . $module_id . '_code',
		);
		$sql = 'DELETE FROM ' . PORTAL_CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);

		$check = $db->sql_query($sql);

		$del_config = array(
			'board3_custom_' . $module_id . '_bbcode',
			'board3_custom_' . $module_id . '_title',
			'board3_custom_' . $module_id . '_image_src',
			'board3_custom_' . $module_id . '_uid',
			'board3_custom_' . $module_id . '_bitfield',
			'board3_custom_' . $module_id . '_permission',
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return ((!$check) ? $check : $db->sql_query($sql)); // if something went wrong, make sure we are aware of the first query
	}

	/**
	* Manage custom module
	*
	* @param mixed $value Value of input
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function manage_custom($value, $key, $module_id)
	{
		$action = ($this->request->is_set_post('reset')) ? 'reset' : '';
		$action = ($this->request->is_set_post('submit')) ? 'save' : $action;
		$action = ($this->request->is_set_post('preview')) ? 'preview' : $action;

		$portal_config = obtain_portal_config();

		$u_action = append_sid('index.' . $this->php_ext, 'i=-board3-portal-acp-portal_module&amp;mode=config&amp;module_id=' . $module_id);

		switch ($action)
		{
			// Save changes
			case 'save':
				if (!check_form_key('acp_portal'))
				{
					trigger_error($this->user->lang['FORM_INVALID']. adm_back_link($u_action), E_USER_WARNING);
				}

				$custom_code = $this->request->variable('custom_code', '', true);
				$custom_bbcode = $this->request->variable('custom_use_bbcode', 1); // default to BBCode
				$custom_permission = $this->request->variable('permission-setting', array(0 => ''));
				$custom_title = $this->request->variable('module_name', '', true);
				$custom_image_src = $this->request->variable('module_image', '', true);
				$groups_ary = array();
				$uid = $bitfield = $flags = '';

				if ($custom_bbcode)
				{
					generate_text_for_storage($custom_code, $uid, $bitfield, $flags, true, true, true);
				}

				// first check for obvious errors, we don't want to waste server resources
				if (empty($custom_code))
				{
					trigger_error($this->user->lang['ACP_PORTAL_CUSTOM_CODE_SHORT']. adm_back_link($u_action), E_USER_WARNING);
				}

				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $this->db->sql_query($sql);
				while ($row = $this->db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$this->db->sql_freeresult($result);

				$custom_permission = array_intersect($custom_permission, $groups_ary);
				$custom_permission = implode(',', $custom_permission);

				if (isset($this->user->lang[$custom_title]))
				{
					$log_title =  $this->user->lang[$custom_title];
				}
				else
				{
					$log_title = $custom_title;
				}

				$this->log->add('admin', $this->user->data['user_id'], $this->user->data['user_ip'], 'LOG_PORTAL_CONFIG', false, array($this->user->lang['PORTAL_CUSTOM'] . ':&nbsp;' . $log_title));

				// set_portal_config will take care of escaping the welcome message
				set_portal_config('board3_custom_' . $module_id . '_code', $custom_code);
				$this->config->set('board3_custom_' . $module_id . '_bbcode', $custom_bbcode);
				$this->config->set('board3_custom_' . $module_id . '_title', $custom_title);
				$this->config->set('board3_custom_' . $module_id . '_image_src', $custom_image_src);
				$this->config->set('board3_custom_' . $module_id . '_uid', $uid);
				$this->config->set('board3_custom_' . $module_id . '_bitfield', $bitfield);
				$this->config->set('board3_custom_' . $module_id . '_permission', $custom_permission);

				//trigger_error($this->user->lang['CONFIG_UPDATED'] . adm_back_link(($module_id) ? append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&mode=modules') : $u_action));

			break;

			case 'preview':
				$custom_code = $text = $this->request->variable('custom_code', '', true);
				$custom_bbcode = $this->request->variable('custom_use_bbcode', 1); // default to BBCode
				$custom_permission = $this->request->variable('permission-setting', array(0 => ''));
				$custom_title = $this->request->variable('module_name', '', true);
				$custom_image_src = $this->request->variable('module_image', '', true);
				$groups_ary = array();

				// first check for obvious errors, we don't want to waste server resources
				if (empty($custom_code))
				{
					trigger_error($this->user->lang['ACP_PORTAL_CUSTOM_CODE_SHORT']. adm_back_link($u_action), E_USER_WARNING);
				}

				if ($custom_bbcode)
				{
					$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
					$uid  =  (isset($this->config['board3_custom_' . $module_id . '_uid'])) ? $this->config['board3_custom_' . $module_id . '_uid'] : '';
					$bitfield = (isset($this->config['board3_custom_' . $module_id . '_bitfield'])) ? $this->config['board3_custom_' . $module_id . '_bitfield'] : '';
					$options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
					generate_text_for_storage($text, $uid, $bitfield, $options, true, true, true);

					$text = generate_text_for_display($text, $uid, $bitfield, $options);
				}
				else
				{
					$text = htmlspecialchars_decode($text, ENT_QUOTES);
				}

				$this->template->assign_vars(array(
					'PREVIEW_TEXT'		=> $text,
					'S_PREVIEW'			=> true,
				));

				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $this->db->sql_query($sql);
				while ($row = $this->db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$this->db->sql_freeresult($result);

				$temp_permissions = array_intersect($custom_permission, $groups_ary);

			// Edit or add menu item
			case 'reset':
			default:
				if (!isset($custom_code))
				{
					$custom_code = generate_text_for_edit($portal_config['board3_custom_' . $module_id . '_code'], $this->config['board3_custom_' . $module_id . '_uid'], '');
				}

				$this->template->assign_vars(array(
					'CUSTOM_CODE'			=> (is_array($custom_code)) ? $custom_code['text'] : $custom_code,
					'CUSTOM_USE_BBCODE'		=> (isset($custom_bbcode)) ? $custom_bbcode : (($this->config['board3_custom_' . $module_id . '_bbcode'] != '') ? $this->config['board3_custom_' . $module_id . '_bbcode'] : true), // BBCodes are selected by default
					//'U_BACK'				=> $u_action,
					'U_ACTION'				=> $u_action,
					'S_EDIT'				=> true,
					'S_LINKS_ALLOWED'       => true,
					'S_BBCODE_IMG'          => true,
					'S_BBCODE_FLASH'		=> true,
					'S_BBCODE_QUOTE'		=> true,
					'S_BBCODE_ALLOWED'		=> true,
					'MAX_FONT_SIZE'			=> (int) $this->config['max_post_font_size'],
				));

				$groups_ary = (isset($temp_permissions)) ? $temp_permissions : ((isset($this->config['board3_custom_' . $module_id . '_permission'])) ? explode(',', $this->config['board3_custom_' . $module_id . '_permission']) : array());

				// get group info from database and assign the block vars
				$sql = 'SELECT group_id, group_name 
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $this->db->sql_query($sql);
				while ($row = $this->db->sql_fetchrow($result))
				{
					$this->template->assign_block_vars('permission_setting', array(
						'SELECTED'		=> (in_array($row['group_id'], $groups_ary)) ? true : false,
						'GROUP_NAME'	=> (isset($this->user->lang['G_' . $row['group_name']])) ? $this->user->lang['G_' . $row['group_name']] : $row['group_name'],
						'GROUP_ID'		=> $row['group_id'],
					));
				}
				$this->db->sql_freeresult($result);

				if (!function_exists('display_forums'))
				{
					include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
				}

				// Build custom bbcodes array
				display_custom_bbcodes();
				$this->user->add_lang('posting');

			break;
		}
	}

	/**
	* Update custom module
	*
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function update_custom($key, $module_id)
	{
		$this->manage_custom('', $key, $module_id);
	}

	/**
	* Parse template for custom blocks
	*
	* @param int $module_id	Module ID of current module
	* @param string $type	Type of module (center or side), default to
	*			center to not show module image unless wanted
	* @return array		An array containing the custom module data
	*/
	protected function parse_template($module_id, $type = 'center')
	{
		$portal_config = obtain_portal_config();

		/*
		* Run generate_text_for_display if the user uses BBCode for designing his custom block
		* HTML won't be parsed if the user chooses to use BBCodes in the ACP
		* If BBCodes are turned off, the custom Block code will be directly assigned and HTML will be parsed
		*/
		if ($this->config['board3_custom_' . $module_id . '_bbcode'])
		{
			// Generate text for display and assign template vars
			$uid = $this->config['board3_custom_' . $module_id . '_uid'];
			$bitfield = $this->config['board3_custom_' . $module_id . '_bitfield'];
			$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
			$assign_code = generate_text_for_display($portal_config['board3_custom_' . $module_id . '_code'], $uid, $bitfield, $bbcode_options);
		}
		else
		{
			$assign_code = htmlspecialchars_decode($portal_config['board3_custom_' . $module_id . '_code'], ENT_QUOTES);
		}

		$title = (!empty($this->config['board3_custom_' . $module_id . '_title'])) ? ((isset($this->user->lang[$this->config['board3_custom_' . $module_id . '_title']])) ? $this->user->lang[$this->config['board3_custom_' . $module_id . '_title']] : $this->config['board3_custom_' . $module_id . '_title']) : $this->user->lang[$this->name];

		if (!empty($assign_code))
		{
			return array(
				'template'	=> 'custom_' . $type . '.html',
				'title'		=> $title,
				'code'		=> $assign_code,
				// no image for center blocks
				'image_src'	=> ($type === 'center') ? '' : ((!empty($this->config['board3_custom_' . $module_id . '_image_src'])) ? $this->config['board3_custom_' . $module_id . '_image_src'] : $this->image_src),
			);
		}
	}
}
