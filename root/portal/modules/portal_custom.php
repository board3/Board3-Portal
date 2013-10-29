<?php
/**
*
* @package Board3 Portal v2 - Custom
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
* @package Custom
*/
class portal_custom_module
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

	public function get_template_center($module_id)
	{
		return $this->parse_template($module_id);
	}

	public function get_template_side($module_id)
	{
		return $this->parse_template($module_id, 'side');
	}

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
	* API functions
	*/
	public function install($module_id)
	{
		set_portal_config('board3_custom_' . $module_id . '_code', '');
		set_config('board3_custom_' . $module_id . '_code', '');
		set_config('board3_custom_' . $module_id . '_bbcode', 1);
		set_config('board3_custom_' . $module_id . '_title', '');
		set_config('board3_custom_' . $module_id . '_image_src', '');
		set_config('board3_custom_' . $module_id . '_uid', '');
		set_config('board3_custom_' . $module_id . '_bitfield', '');
		set_config('board3_custom_' . $module_id . '_permission', '');
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

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

	public function manage_custom($value, $key, $module_id)
	{
		global $db, $portal_config, $config, $template, $user, $phpEx, $phpbb_admin_path, $phpbb_root_path;

		$action = (isset($_POST['reset'])) ? 'reset' : '';
		$action = (isset($_POST['submit'])) ? 'save' : $action;
		$action = (isset($_POST['preview'])) ? 'preview' : $action;

		$portal_config = obtain_portal_config();

		$u_action = append_sid($phpbb_admin_path . 'index.' . $phpEx, 'i=portal&amp;mode=config&amp;module_id=' . $module_id);

		switch($action)
		{
			// Save changes
			case 'save':
				if (!check_form_key('acp_portal'))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($u_action), E_USER_WARNING);
				}

				$custom_code = utf8_normalize_nfc(request_var('custom_code', '', true));
				$custom_bbcode = request_var('custom_use_bbcode', 1); // default to BBCode
				$custom_permission = request_var('permission-setting', array(0 => ''));
				$custom_title = utf8_normalize_nfc(request_var('module_name', '', true));
				$custom_image_src = utf8_normalize_nfc(request_var('module_image', ''));
				$groups_ary = array();
				$uid = $bitfield = $flags = '';
				$options = 7;
				if($custom_bbcode)
				{
					generate_text_for_storage($custom_code, $uid, $bitfield, $flags, true, true, true);
				}

				// first check for obvious errors, we don't want to waste server resources
				if(empty($custom_code))
				{
					trigger_error($user->lang['ACP_PORTAL_CUSTOM_CODE_SHORT']. adm_back_link($u_action), E_USER_WARNING);
				}

				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$db->sql_freeresult($result);

				$custom_permission = array_intersect($custom_permission, $groups_ary);
				$custom_permission = implode(',', $custom_permission);

				if (isset($user->lang[$custom_title]))
				{
					$log_title =  $user->lang[$custom_title];
				}
				else
				{
					$log_title = $custom_title;
				}

				add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['PORTAL_CUSTOM'] . ':&nbsp;' . $log_title);

				// set_portal_config will take care of escaping the welcome message
				set_portal_config('board3_custom_' . $module_id . '_code', $custom_code);
				set_config('board3_custom_' . $module_id . '_bbcode', $custom_bbcode);
				set_config('board3_custom_' . $module_id . '_title', $custom_title);
				set_config('board3_custom_' . $module_id . '_image_src', $custom_image_src);
				set_config('board3_custom_' . $module_id . '_uid', $uid);
				set_config('board3_custom_' . $module_id . '_bitfield', $bitfield);
				set_config('board3_custom_' . $module_id . '_permission', $custom_permission);

				//trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link(($module_id) ? append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&mode=modules') : $u_action));

			break;

			case 'preview':
				$custom_code = $text = utf8_normalize_nfc(request_var('custom_code', '', true));
				$custom_bbcode = request_var('custom_use_bbcode', 1); // default to BBCode
				$custom_permission = request_var('permission-setting', array(0 => ''));
				$custom_title = utf8_normalize_nfc(request_var('module_name', ''));
				$custom_image_src = utf8_normalize_nfc(request_var('module_image', ''));
				$groups_ary = array();

				// first check for obvious errors, we don't want to waste server resources
				if(empty($custom_code))
				{
					trigger_error($user->lang['ACP_PORTAL_CUSTOM_CODE_SHORT']. adm_back_link($u_action), E_USER_WARNING);
				}

				if (!class_exists('parse_message'))
				{
					include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
				}
				if($custom_bbcode)
				{
					$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
					$uid  =  (isset($config['board3_custom_' . $module_id . '_uid'])) ? $config['board3_custom_' . $module_id . '_uid'] : '';
					$bitfield = (isset($config['board3_custom_' . $module_id . '_bitfield'])) ? $config['board3_custom_' . $module_id . '_bitfield'] : '';
					$options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
					generate_text_for_storage($text, $uid, $bitfield, $options, true, true, true);

					$text = generate_text_for_display($text, $uid, $bitfield, $options);
				}
				else
				{
					$text = htmlspecialchars_decode($text, ENT_QUOTES);
				}

				$template->assign_vars(array(
					'PREVIEW_TEXT'		=> $text,
					'S_PREVIEW'			=> true,
				));

				// get groups and check if the selected groups actually exist
				$sql = 'SELECT group_id
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$groups_ary[] = $row['group_id'];
				}
				$db->sql_freeresult($result);

				$temp_permissions = array_intersect($custom_permission, $groups_ary);

			// Edit or add menu item
			case 'reset':
			default:
				if(!isset($custom_code))
				{
					$custom_code = generate_text_for_edit($portal_config['board3_custom_' . $module_id . '_code'], $config['board3_custom_' . $module_id . '_uid'], '');
				}

				$template->assign_vars(array(
					'CUSTOM_CODE'			=> (is_array($custom_code)) ? $custom_code['text'] : $custom_code,
					'CUSTOM_USE_BBCODE'		=> (isset($custom_bbcode)) ? $custom_bbcode : (($config['board3_custom_' . $module_id . '_bbcode'] != '') ? $config['board3_custom_' . $module_id . '_bbcode'] : true), // BBCodes are selected by default
					//'U_BACK'				=> $u_action,
					'U_ACTION'				=> $u_action,
					'S_EDIT'				=> true,
					'S_LINKS_ALLOWED'       => true,
					'S_BBCODE_IMG'          => true,
					'S_BBCODE_FLASH'		=> true,
					'S_BBCODE_QUOTE'		=> true,
					'S_BBCODE_ALLOWED'		=> true,
					'MAX_FONT_SIZE'			=> (int) $config['max_post_font_size'],
				));

				$groups_ary = (isset($temp_permissions)) ? $temp_permissions : ((isset($config['board3_custom_' . $module_id . '_permission'])) ? explode(',', $config['board3_custom_' . $module_id . '_permission']) : array());

				// get group info from database and assign the block vars
				$sql = 'SELECT group_id, group_name 
						FROM ' . GROUPS_TABLE . '
						ORDER BY group_id ASC';
				$result = $db->sql_query($sql);
				while($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('permission_setting', array(
						'SELECTED'		=> (in_array($row['group_id'], $groups_ary)) ? true : false,
						'GROUP_NAME'	=> (isset($user->lang['G_' . $row['group_name']])) ? $user->lang['G_' . $row['group_name']] : $row['group_name'],
						'GROUP_ID'		=> $row['group_id'],
					));
				}
				$db->sql_freeresult($result);

				if(!function_exists('display_forums'))
				{
					include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
				}

				// Build custom bbcodes array
				display_custom_bbcodes();
				$user->add_lang('posting');

			break;		
		}
	}

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
		global $config, $template, $portal_config, $user;

		/*
		* Run generate_text_for_display if the user uses BBCode for designing his custom block
		* HTML won't be parsed if the user chooses to use BBCodes in the ACP
		* If BBCodes are turned off, the custom Block code will be directly assigned and HTML will be parsed
		*/
		if ($config['board3_custom_' . $module_id . '_bbcode'])
		{
			// Generate text for display and assign template vars
			$uid = $config['board3_custom_' . $module_id . '_uid'];
			$bitfield = $config['board3_custom_' . $module_id . '_bitfield'];
			$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
			$assign_code = generate_text_for_display($portal_config['board3_custom_' . $module_id . '_code'], $uid, $bitfield, $bbcode_options);
		}
		else
		{
			$assign_code = htmlspecialchars_decode($portal_config['board3_custom_' . $module_id . '_code'], ENT_QUOTES);
		}

		$title = (!empty($config['board3_custom_' . $module_id . '_title'])) ? ((isset($user->lang[$config['board3_custom_' . $module_id . '_title']])) ? $user->lang[$config['board3_custom_' . $module_id . '_title']] : $config['board3_custom_' . $module_id . '_title']) : $user->lang[$this->name];

		if(!empty($assign_code))
		{
			return array(
				'template'	=> 'custom_' . $type . '.html',
				'title'		=> $title,
				'code'		=> $assign_code,
				// no image for center blocks
				'image_src'	=> ($type === 'center') ? '' : ((!empty($config['board3_custom_' . $module_id . '_image_src'])) ? $config['board3_custom_' . $module_id . '_image_src'] : $this->image_src),
			);
		}
	}
}
