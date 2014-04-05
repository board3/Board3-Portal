<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\controller;

class main
{
	/**
	* Auth object
	* @var phpbb_auth
	*/
	private $auth;

	/**
	* phpBB Config object
	* @var phpbb_config_db
	*/
	private $config;

	/**
	* Template object
	* @var phpbb_template
	*/
	private $template;

	/**
	* User object
	* @var phpbb_user
	*/
	private $user;

	/**
	* phpBB root path
	* @var string
	*/
	private $phpbb_root_path;

	/**
	* PHP file extension
	* @var string
	*/
	private $php_ext;

	/**
	* Portal root path
	* @var string
	*/
	private $root_path;

	/**
	* Portal includes path
	* @var string
	*/
	private $includes_path;

	/**
	* phpBB path helper
	* @var \phpbb\path_helper
	*/
	protected $path_helper;

	/**
	* Board3 Modules service collection
	* @var phpbb\di\service_collection
	*/
	protected $modules;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	* @param phpbb_auth $auth Auth object
	* @param phpbb_config_db $config phpBB Config object
	* @param phpbb_template $template Template object
	* @param phpbb_user $user User object
	* @param \phpbb\path_helper $path_helper phpBB path helper
	* @param string $phpbb_root_path phpBB root path
	* @param string $php_ext PHP file extension
	* @param \phpbb\di\service_collection $modules Board3 Modules service
	*						collection
	*/
	public function __construct($auth, $config, $template, $user, $path_helper, $phpbb_root_path, $php_ext, $modules)
	{
		global $portal_root_path;

		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->path_helper = $path_helper;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->register_modules($modules);

		$this->includes_path = $phpbb_root_path . 'ext/board3/portal/includes/';
		$this->root_path = $phpbb_root_path . 'ext/board3/portal/';
		$portal_root_path = $this->root_path;

		if (!function_exists('obtain_portal_config'))
		{
			include($this->includes_path . 'constants' . $this->php_ext);
			include($this->includes_path . 'functions_modules' . $this->php_ext);
			include($this->includes_path . 'functions' . $this->php_ext);
		}
	}

	/**
	* Register list of Board3 Portal modules
	*
	* @param \phpbb\di\service_collection $modules Board3 Modules service
	*						collection
	* @return null
	*/
	protected function register_modules($modules)
	{
		foreach ($modules as $current_module)
		{
			$class_name = '\\' . get_class($current_module);
			if (!isset($this->modules[$class_name]))
			{
				$this->modules[$class_name] = $current_module;
			}
		}
	}

	/**
	* Extension front handler method. This is called automatically when your extension is accessed
	* through index.php?ext=example/foobar
	* @return null
	*/
	public function handle()
	{
		$this->check_permission();
		// We defined the phpBB objects in __construct() and can use them in the rest of our class like this
		//echo 'Welcome, ' . $this->user->data['username'];

		// The following takes two arguments:
		// 1) which extension language folder we're using (it's not smart enough to use its own automatically)
		// 2) what language file to use
		$this->user->add_lang_ext('board3/portal', 'portal');

		/**
		* get initial data
		*/
		$portal_config = obtain_portal_config();
		$portal_modules = obtain_portal_modules();
		$display_online = false;

		/**
		* set up column_count array
		* with this we can hide unneeded parts of the portal
		*/
		$module_count = array(
			'total' 	=> 0,
			'top'		=> 0,
			'left'		=> 0,
			'center'	=> 0,
			'right'		=> 0,
			'bottom'	=> 0,
		);

		/**
		* start assigning block vars
		*/
		foreach ($portal_modules as $row)
		{
			if($row['module_status'] == B3_MODULE_DISABLED)
			{
				continue;
			}

			// Do not try to load non-existant modules
			if (!isset($this->modules[$row['module_classname']]))
			{
				if (file_exists("{$this->includes_path}modules/portal_{$row['module_classname']}{$this->php_ext}"))
				{
					include("{$this->includes_path}modules/portal_{$row['module_classname']}{$this->php_ext}");
				}

				$class_name = 'portal_' . $row['module_classname'] . '_module';
				if (class_exists($class_name))
				{
					$module = new $class_name();
				}
				else
				{
					continue;
				}
			}
			else
			{
				$module = $this->modules[$row['module_classname']];
			}

			/**
			* Check for permissions before loading anything
			* the default group of a user always defines his/her permission (KISS)
			*/
			$group_ary = (!empty($row['module_group_ids'])) ? explode(',', $row['module_group_ids']) : '';
			if ((is_array($group_ary) && !in_array($this->user->data['group_id'], $group_ary)))
			{
				continue;
			}

			if ($language_file = $module->get_language())
			{
				$this->user->add_lang_ext('board3/portal', 'modules/' . $language_file);
			}
			if ($row['module_column'] == column_string_num('left') && $this->config['board3_left_column'])
			{
				$template_module = $module->get_template_side($row['module_id']);
				$template_column = 'left';
				++$module_count['left'];
			}
			if ($row['module_column'] == column_string_num('center'))
			{
				$template_module = $module->get_template_center($row['module_id']);
				$template_column = 'center';
				++$module_count['center'];
			}
			if ($row['module_column'] == column_string_num('right') && $this->config['board3_right_column'])
			{
				$template_module = $module->get_template_side($row['module_id']);
				$template_column = 'right';
				++$module_count['right'];
			}
			if ($row['module_column'] == column_string_num('top'))
			{
				$template_module = $module->get_template_center($row['module_id']);
				++$module_count['top'];
			}
			if ($row['module_column'] == column_string_num('bottom'))
			{
				$template_module = $module->get_template_center($row['module_id']);
				++$module_count['bottom'];
			}
			if (!isset($template_module))
			{
				continue;
			}

			// Custom Blocks that have been defined in the ACP will return an array instead of just the name of the template file
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

			// Check if we need to show the online list
			if ($row['module_classname'] === '\board3\portal\modules\whois_online')
			{
				$display_online = true;
			}

			unset($template_module);
		}
		$module_count['total'] = sizeof($portal_modules);

		// Redirect to index if there are currently no active modules
		if($module_count['total'] < 1)
		{
			redirect(append_sid($this->phpbb_root_path . 'index' . $this->php_ext));
		}

		// Assign specific vars
		$this->template->assign_vars(array(
		// 	'S_SMALL_BLOCK'			=> true,
			'S_PORTAL_LEFT_COLUMN'	=> $this->config['board3_left_column_width'],
			'S_PORTAL_RIGHT_COLUMN'	=> $this->config['board3_right_column_width'],
			'S_LEFT_COLUMN'			=> ($module_count['left'] > 0 && $this->config['board3_left_column']) ? true : false,
			'S_CENTER_COLUMN'		=> ($module_count['center'] > 0) ? true : false,
			'S_RIGHT_COLUMN'		=> ($module_count['right'] > 0 && $this->config['board3_right_column']) ? true : false,
			'S_TOP_COLUMN'			=> ($module_count['top'] > 0) ? true : false,
			'S_BOTTOM_COLUMN'		=> ($module_count['bottom'] > 0) ? true : false,
			'S_DISPLAY_PHPBB_MENU'	=> $this->config['board3_phpbb_menu'],
			'B3P_DISPLAY_JUMPBOX'	=> $this->config['board3_display_jumpbox'],
			'T_EXT_THEME_PATH'		=> $this->path_helper->get_web_root_path() . $this->root_path . 'styles/' . $this->user->style['style_path'] . '/theme/',
		));

		// And now to output the page.
		page_header($this->user->lang('PORTAL'), $display_online);

		// foobar_body.html is in ./ext/foobar/example/styles/prosilver/template/foobar_body.html
		$this->template->set_filenames(array(
			'body' => 'portal/portal_body.html'
		));

		page_footer();
	}

	// check if user should be able to access this page
	private function check_permission()
	{
		if (!isset($this->config['board3_enable']) || !$this->config['board3_enable'] || !$this->auth->acl_get('u_view_portal'))
		{
			redirect(append_sid($this->phpbb_root_path . 'index' . $this->php_ext));
		}
	}
}
