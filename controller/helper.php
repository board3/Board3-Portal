<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\controller;

class helper
{
	/**
	* Auth object
	* @var \phpbb\auth\auth
	*/
	protected $auth;

	/**
	* phpBB Config object
	* @var \phpbb\config\config
	*/
	protected $config;

	/**
	* Template object
	* @var \phpbb\template
	*/
	protected $template;

	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

	/**
	* phpBB root path
	* @var string
	*/
	protected $phpbb_root_path;

	/**
	* PHP file extension
	* @var string
	*/
	protected $php_ext;

	/**
	* Portal root path
	* @var string
	*/
	protected $root_path;

	/**
	* phpBB path helper
	* @var \phpbb\path_helper
	*/
	protected $path_helper;

	/**
	* Portal Helper object
	* @var \board3\portal\includes\helper
	*/
	protected $portal_helper;

	/**
	* Portal modules array
	* @var array
	*/
	protected $portal_modules;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	* @param \phpbb\auth\auth $auth Auth object
	* @param \phpbb\config\config $config phpBB Config object
	* @param \phpbb\template $template Template object
	* @param \phpbb\user $user User object
	* @param \phpbb\path_helper $path_helper phpBB path helper
	* @param \board3\portal\includes\helper $portal_helper Portal helper class
	* @param string $phpbb_root_path phpBB root path
	* @param string $php_ext PHP file extension
	*/
	public function __construct($auth, $config, $template, $user, $path_helper, $portal_helper, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->path_helper = $path_helper;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->portal_helper = $portal_helper;

		$this->root_path = $phpbb_root_path . 'ext/board3/portal/';
	}

	/**
	* Check if user should be able to access this page. Redirect to index
	* if this does not apply.
	*
	* @return null
	*/
	protected function check_permission()
	{
		if (!isset($this->config['board3_enable']) || !$this->config['board3_enable'] || !$this->auth->acl_get('u_view_portal'))
		{
			redirect(append_sid($this->phpbb_root_path . 'index' . $this->php_ext));
		}
	}

	/**
	* Return true if online list should be displayed
	*
	* @return mixed True if online list should be display, current value
	*		if unsure
	*/
	public function check_online_list($module_classname, $display_online)
	{
		return ($module_classname === '\board3\portal\modules\whois_online') ? true : $display_online;
	}

	/**
	* Get portal module and run module start checks
	*
	* @param array $row Module row
	*
	* @return mixed False if one of the module checks failed, the module
	*		object if checks were successful
	*/
	public function get_portal_module($row)
	{
		// Do not try to load non-existent or disabled modules
		if ($row['module_status'] == B3_MODULE_DISABLED || !is_object($module = $this->portal_helper->get_module($row['module_classname'])))
		{
			return false;
		}

		// Check if module shouldn't be loaded
		if ($this->check_column_disabled($row))
		{
			return false;
		}

		/**
		* Check for permissions before loading anything
		* the default group of a user always defines his/her permission
		*/
		return ($this->check_group_access($row)) ? $module : false;
	}

	/**
	* Check if column is disabled
	*
	* @param array $row Module database row
	*
	* @return bool False if column is not disabled, true if it is
	*/
	protected function check_column_disabled($row)
	{
		return ($this->config['board3_left_column'] === false && column_num_string($row['module_column']) === 'left') || ($this->config['board3_right_column'] === false && column_num_string($row['module_column']) === 'right');
	}

	/**
	* Check if user is in required groups
	*
	* @param array $row Module row
	*/
	protected function check_group_access($row)
	{
		$group_ary = (!empty($row['module_group_ids'])) ? explode(',', $row['module_group_ids']) : '';
		if ((is_array($group_ary) && !in_array($this->user->data['group_id'], $group_ary)))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	* Load language file of module
	*
	* @param object $module Module of which language file should be loaded
	*/
	public function load_module_language($module)
	{
		if ($language_file = $module->get_language())
		{
			// Load language file from vendor if specified
			if (is_array($language_file))
			{
				$this->user->add_lang_ext($language_file['vendor'], $language_file['file']);
			}
			else
			{
				$this->user->add_lang_ext('board3/portal', 'modules/' . $language_file);
			}
		}
	}

	/**
	* Assign module's template vars
	*
	* @param array $row Database row of module
	* @param mixed $template_module Template data as returned by module
	*
	* @return null
	*/
	public function assign_module_vars($row, $template_module)
	{
		if (is_array($template_module))
		{
			$this->template->assign_block_vars('modules_' . column_num_string($row['module_column']), array(
				'TEMPLATE_FILE'			=> 'portal/modules/' . $template_module['template'],
				'IMAGE_SRC'			=> $this->path_helper->get_web_root_path() . $this->root_path . 'styles/' . $this->user->style['style_path'] . '/theme/images/portal/' . $template_module['image_src'],
				'TITLE'				=> $template_module['title'],
				'CODE'				=> $template_module['code'],
				'MODULE_ID'			=> $row['module_id'],
				'IMAGE_WIDTH'			=> $row['module_image_width'],
				'IMAGE_HEIGHT'			=> $row['module_image_height'],
			));
		}
		else
		{
			$this->template->assign_block_vars('modules_' . column_num_string($row['module_column']), array(
				'TEMPLATE_FILE'			=> 'portal/modules/' . $template_module,
				'IMAGE_SRC'			=> $this->path_helper->get_web_root_path() . $this->root_path . 'styles/' . $this->user->style['style_path'] . '/theme/images/portal/' . $row['module_image_src'],
				'IMAGE_WIDTH'			=> $row['module_image_width'],
				'IMAGE_HEIGHT'			=> $row['module_image_height'],
				'MODULE_ID'			=> $row['module_id'],
				'TITLE'				=> (isset($this->user->lang[$row['module_name']])) ? $this->user->lang[$row['module_name']] : utf8_normalize_nfc($row['module_name']),
			));
		}
	}

	/**
	* Run initial tasks that are required for a properly setup extension
	*
	* @return null
	*/
	public function run_initial_tasks()
	{
		// Check for permissions first
		$this->check_permission();

		// Load language file
		$this->user->add_lang_ext('board3/portal', 'portal');

		// Obtain portal config
		obtain_portal_config();
	}
}
