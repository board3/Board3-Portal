<?php
/**
*
* @package Board3 Portal v2 - Welcome
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
* @package Welcome
*/
class portal_welcome_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 21;

	/**
	* Default modulename
	*/
	public $name = 'PORTAL_WELCOME';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_welcome_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = 'acp_portal_welcome';

	public function get_template_center($module_id)
	{
		global $config, $template, $portal_config, $phpEx;

		// Generate text for display and assign template vars
		$uid = $config['board3_welcome_message_uid_' . $module_id];
		$bitfield = $config['board3_welcome_message_bitfield_' . $module_id];
		$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
		$text = generate_text_for_display($portal_config['board3_welcome_message_' . $module_id], $uid, $bitfield, $bbcode_options);

		$template->assign_vars(array(
			'PORTAL_WELCOME_MSG'	=> $text,
		));

		return 'welcome_center.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_WELCOME_SETTINGS',
			'vars'	=> array(
				'legend1'								=> 'ACP_PORTAL_WELCOME_SETTINGS',
				'board3_welcome_message_' . $module_id	=> array('lang' => 'PORTAL_WELCOME_INTRO',	'validate' => 'string',	'type' => 'custom', 'method' => 'manage_welcome', 'submit' => 'update_welcome', 'explain' => true),
			),
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_portal_config('board3_welcome_message_' . $module_id, 'Welcome to my Community!');
		set_config('board3_welcome_message_' . $module_id, '');
		set_config('board3_welcome_message_uid_' . $module_id, '');
		set_config('board3_welcome_message_bitfield_' . $module_id, '');
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_welcome_message_' . $module_id,
		);
		$sql = 'DELETE FROM ' . PORTAL_CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);

		$check = $db->sql_query($sql);

		$del_config = array(
			'board3_welcome_intro_' . $module_id,
			'board3_welcome_message_uid_' . $module_id,
			'board3_welcome_message_bitfield_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return ((!$check) ? $check : $db->sql_query($sql)); // if something went wrong, make sure we are aware of the first query
	}

	public function manage_welcome($value, $key, $module_id)
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

				$welcome_message = utf8_normalize_nfc(request_var('welcome_message', '', true));
				$uid = $bitfield = $flags = '';
				$options = 7;
				generate_text_for_storage($welcome_message, $uid, $bitfield, $flags, true, true, true);

				// first check for obvious errors, we don't want to waste server resources
				if(empty($welcome_message))
				{
					trigger_error($user->lang['ACP_PORTAL_WELCOME_MESSAGE_SHORT']. adm_back_link($u_action), E_USER_WARNING);
				}

				add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['PORTAL_WELCOME']);

				// set_portal_config will take care of escaping the welcome message
				set_portal_config('board3_welcome_message_' . $module_id, $welcome_message);
				set_config('board3_welcome_message_uid_' . $module_id, $uid);
				set_config('board3_welcome_message_bitfield_' . $module_id, $bitfield);
			break;

			case 'preview':
				$welcome_message = $text = utf8_normalize_nfc(request_var('welcome_message', '', true));

				if (!class_exists('parse_message'))
				{
					include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
				}

				$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
				$uid  =  (isset($config['board3_welcome_message_uid_' . $module_id])) ? $config['board3_welcome_message_uid_' . $module_id] : '';
				$bitfield = (isset($config['board3_welcome_message_bitfield_' . $module_id])) ? $config['board3_welcome_message_bitfield_' . $module_id] : '';
				$options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
				generate_text_for_storage($text, $uid, $bitfield, $options, true, true, true);

				$text = generate_text_for_display($text, $uid, $bitfield, $options);

				$template->assign_vars(array(
					'PREVIEW_TEXT'		=> $text,
					'S_PREVIEW'			=> true,
				));

			// Edit or add menu item
			case 'reset':
			default:
				if(!isset($welcome_message))
				{
					$welcome_message = generate_text_for_edit($portal_config['board3_welcome_message_' . $module_id], $config['board3_welcome_message_uid_' . $module_id], '');
				}

				$template->assign_vars(array(
					'WELCOME_MESSAGE'		=> (is_array($welcome_message)) ? $welcome_message['text'] : $welcome_message,
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

	public function update_welcome($key, $module_id)
	{
		$this->manage_welcome('', $key, $module_id);
	}
}
