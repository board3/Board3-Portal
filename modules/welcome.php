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
* @package Welcome
*/
class welcome extends module_base
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

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/**
	* Construct a welcome object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\request\request $request phpBB request
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\user $user phpBB user
	* @param string $phpbb_root_path phpBB root path
	* @param string $phpEx php file extension
	*/
	public function __construct($config, $request, $template, $user, $phpbb_root_path, $phpEx)
	{
		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		$portal_config = obtain_portal_config();

		// Generate text for display and assign template vars
		$uid = $this->config['board3_welcome_message_uid_' . $module_id];
		$bitfield = $this->config['board3_welcome_message_bitfield_' . $module_id];
		$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
		$text = generate_text_for_display($portal_config['board3_welcome_message_' . $module_id], $uid, $bitfield, $bbcode_options);

		$this->template->assign_vars(array(
			'PORTAL_WELCOME_MSG'	=> $text,
		));

		return 'welcome_center.html';
	}

	/**
	* {@inheritdoc}
	*/
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
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		set_portal_config('board3_welcome_message_' . $module_id, 'Welcome to my Community!');
		$this->config->set('board3_welcome_message_' . $module_id, '');
		$this->config->set('board3_welcome_message_uid_' . $module_id, '');
		$this->config->set('board3_welcome_message_bitfield_' . $module_id, '');
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
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

	/**
	* Manage welcome message
	*
	* @param mixed $value Value of input
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function manage_welcome($value, $key, $module_id)
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

				$welcome_message = $this->request->variable('welcome_message', '', true);
				$uid = $bitfield = $flags = '';
				generate_text_for_storage($welcome_message, $uid, $bitfield, $flags, true, true, true);

				// first check for obvious errors, we don't want to waste server resources
				if (empty($welcome_message))
				{
					trigger_error($this->user->lang['ACP_PORTAL_WELCOME_MESSAGE_SHORT']. adm_back_link($u_action), E_USER_WARNING);
				}

				// set_portal_config will take care of escaping the welcome message
				set_portal_config('board3_welcome_message_' . $module_id, $welcome_message);
				$this->config->set('board3_welcome_message_uid_' . $module_id, $uid);
				$this->config->set('board3_welcome_message_bitfield_' . $module_id, $bitfield);
			break;

			case 'preview':
				$welcome_message = $text = $this->request->variable('welcome_message', '', true);

				$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
				$uid  =  (isset($this->config['board3_welcome_message_uid_' . $module_id])) ? $this->config['board3_welcome_message_uid_' . $module_id] : '';
				$bitfield = (isset($this->config['board3_welcome_message_bitfield_' . $module_id])) ? $this->config['board3_welcome_message_bitfield_' . $module_id] : '';
				$options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
				generate_text_for_storage($text, $uid, $bitfield, $options, true, true, true);

				$text = generate_text_for_display($text, $uid, $bitfield, $options);

				$this->template->assign_vars(array(
					'PREVIEW_TEXT'		=> $text,
					'S_PREVIEW'			=> true,
				));

			// Edit or add menu item
			case 'reset':
			default:
				if (!isset($welcome_message))
				{
					$welcome_message = generate_text_for_edit($portal_config['board3_welcome_message_' . $module_id], $this->config['board3_welcome_message_uid_' . $module_id], '');
				}

				$this->template->assign_vars(array(
					'WELCOME_MESSAGE'		=> (is_array($welcome_message)) ? $welcome_message['text'] : $welcome_message,
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
	* Update welcome message
	*
	* @param string $key Key name
	* @param int $module_id Module ID
	*
	* @return null
	*/
	public function update_welcome($key, $module_id)
	{
		$this->manage_welcome('', $key, $module_id);
	}
}
