<?php

class phpbb_ext_board3_portal_controller extends phpbb_extension_controller
{
	// extension root path
	private $root_path = '';
	
    /**
    * Extension front handler method. This is called automatically when your extension is accessed 
    * through index.php?ext=example/foobar
    * @return null
    */
    public function handle()
    {
		global $phpbb_root_path, $phpEx;

		$this->root_path = $phpbb_root_path . '/ext/board3/portal/portal/';
		
		$this->check_permission();
        // We defined the phpBB objects in __construct() and can use them in the rest of our class like this
        //echo 'Welcome, ' . $this->user->data['username'];

        // The following takes two arguments:
        // 1) which extension language folder we're using (it's not smart enough to use its own automatically)
        // 2) what language file to use
        $this->user->add_lang_ext('board3/portal', 'mods/portal');
		
		//$this->template->set_ext_dir_prefix($phpbb_root_path . 'ext/board3/portal/');
		
		$this->display_modules();

        // foobar_body.html is in ./ext/foobar/example/styles/prosilver/template/foobar_body.html
        $this->template->set_filenames(array(
                'body' => 'portal/portal_body.html'
        ));

        // And we assign template variables the same as before as well
        $this->template->assign_var('MESSAGE', 'Yes, this is hard-coded language, which should still be avoided in virtually all cases.');

        // And now to output the page.
        page_header($this->user->lang('PORTAL'));
        page_footer();
    }

	// check if user should be able to access this page
	private function check_permission()
	{
		global $config, $auth, $phpbb_root_path, $phpEx;
		
		if (!isset($config['board3_enable']) || !$config['board3_enable'] || !$auth->acl_get('u_view_portal'))
		{
			redirect(append_sid($phpbb_root_path . 'index.' . $phpEx));
		}
	}

	/**
	* Display the portal modules
	*
	* @return: true if page can be display, false if there are no modules to display
	*/
	private function display_modules()
	{
		global $template, $phpbb_root_path;

		/**
		* get initial data
		*/
		$portal_config = obtain_portal_config();
		$portal_modules = obtain_portal_modules();

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
			
			$class_name = 'portal_' . $row['module_classname'] . '_module';
			if (!class_exists($class_name))
			{
				include("{$this->root_path}modules/portal_{$row['module_classname']}.$phpEx");
			}
			if (!class_exists($class_name))
			{
				trigger_error(sprintf($user->lang['CLASS_NOT_FOUND'], $class_name, 'portal_' . $row['module_classname']), E_USER_ERROR);
			}

			$module = new $class_name();
			
			/** 
			* Check for permissions before loading anything
			* the default group of a user always defines his/her permission (KISS)
			*/
			$group_ary = (!empty($row['module_group_ids'])) ? explode(',', $row['module_group_ids']) : '';
			if ((is_array($group_ary) && !in_array($user->data['group_id'], $group_ary)))
			{
				continue;
			}
			
			if ($module->language)
			{
				$user->add_lang_ext('board3/portal', 'mods/portal/' . $module->language);
			}
			if ($row['module_column'] == column_string_num('left') && $config['board3_left_column'])
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
			if ($row['module_column'] == column_string_num('right') && $config['board3_right_column'])
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
				$template->assign_block_vars('modules_' . column_num_string($row['module_column']), array(
					'TEMPLATE_FILE'			=> 'portal/modules/' . $template_module['template'],
					'IMAGE_SRC'			=> $this->root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $template_module['image_src'],
					'TITLE'				=> $template_module['title'],
					'CODE'				=> $template_module['code'],
					'MODULE_ID'			=> $row['module_id'],
					'IMAGE_WIDTH'			=> $row['module_image_width'],
					'IMAGE_HEIGHT'			=> $row['module_image_height'],
				));
			}
			else
			{
				$template->assign_block_vars('modules_' . column_num_string($row['module_column']), array(
					'TEMPLATE_FILE'			=> 'portal/modules/' . $template_module,
					'IMAGE_SRC'			=> $this->root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $row['module_image_src'],
					'IMAGE_WIDTH'			=> $row['module_image_width'],
					'IMAGE_HEIGHT'			=> $row['module_image_height'],
					'MODULE_ID'			=> $row['module_id'],
					'TITLE'				=> (isset($user->lang[$row['module_name']])) ? $user->lang[$row['module_name']] : utf8_normalize_nfc($row['module_name']),
				));
			}
			unset($template_module);
		}
		return sizeof($portal_modules);
	}
	
}
