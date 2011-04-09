<?php
/**
*
* @package Board3 Portal v2
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

/**
* @ignore
*/
class portal_upload extends acp_portal
{
	/*
	* pre-defined vars
	*/
	var $upload_path;
	
	/*
	* constructor function for PHP<5
	*/
	function portal_upload($path)
	{
		if(is_dir($path))
		{
			$this->upload_path = $path;
			
			$this->upload_file();
		}
	}
	
	function upload_file()
	{
		global $user, $phpbb_root_path, $phpEx, $phpbb_admin_path, $template;
		// Upload part
		$user->add_lang('posting');  // For error messages
		include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
		$upload = new fileupload();
		// Only allow ZIP files
		$upload->set_allowed_extensions(array('zip'));
		
		$file = $upload->form_upload('modupload');
		
		if (empty($file->filename))
		{
			trigger_error($user->lang['NO_UPLOAD_FILE'] . adm_back_link($this->u_action), E_USER_WARNING);
		}
		else
		{
			if (!$file->init_error && !sizeof($file->error))
			{
				$file->clean_filename('real');
				$file->move_file(str_replace($phpbb_root_path, '', $this->upload_path), true, true);
				
				if (!sizeof($file->error))
				{
					include($phpbb_root_path . 'includes/functions_compress.' . $phpEx);
					$mod_dir = $this->upload_path . str_replace('.zip', '', $file->get('realname'));
					// make sure we don't already have the new folder
					if(is_dir($mod_dir))
					{
						$this->directory_delete($mod_dir);
					}
					$compress = new compress_zip('r', $file->destination_file);
					$compress->extract($mod_dir . '_tmp/');
					$compress->close();
					$folder_contents = $this->cut_folder(scandir($mod_dir . '_tmp/', 1));  // This ensures dir is at index 0

					// We need to check if there's a main directory inside the temp MOD directory
					if (sizeof($folder_contents) == 1)
					{
						// We need to move that directory then
						$this->directory_move($mod_dir . '_tmp/' . $folder_contents[0], $this->upload_path . '/' . $folder_contents[0]);
						
					}
					else if (!is_dir($mod_dir))
					{
						// Change the name of the directory by moving to directory without _tmp in it
						$this->directory_move($mod_dir . '_tmp/', $mod_dir);
						
					}
					
					$this->directory_delete($mod_dir . '_tmp/');
					
					// if we got until here set $actions['NEW_FILES']
					$actions['NEW_FILES'] = array();
					
					// Now we need to get the files inside the folders
					$folder_contents = $this->cut_folder(scandir($mod_dir));

					/* 
					* This will tell us what files we need to copy incl. the path
					* In loving memory of PHP 4.x ... NOT
					*/
					foreach($folder_contents as $cur_content)
					{
						$cur_folder_content = array();
						switch($cur_content)
						{
							case 'language':
								// there are more foreach to come .....
								$cur_folder_content = $this->cut_folder(scandir($mod_dir . '/language/'));
								$langs = array();
								
								foreach($cur_folder_content as $copy_file)
								{
									$langs[] = $copy_file;
								}
								
								foreach($langs as $cur_lang)
								{
									if(!file_exists($mod_dir . '/language/' . $cur_lang . '/mods/portal/'))
									{
										$file->remove();
										$this->directory_delete($mod_dir);
										trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
									}
									$lang_content = $this->cut_folder(scandir($mod_dir . '/language/' . $cur_lang . '/mods/portal/'));

									foreach($lang_content as $new_file)
									{
										$actions['NEW_FILES'][$mod_dir . '/language/' . $cur_lang . '/' . $new_file] = $phpbb_root_path . 'language/' . $cur_lang . '/mods/portal/' . $new_file;
									}
								}
							break;
							case 'portal':
								if(!file_exists($mod_dir . '/portal/modules/'))
								{
									$file->remove();
									$this->directory_delete($mod_dir);
									trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
								}
								$cur_folder_content = $this->cut_folder(scandir($mod_dir . '/portal/modules/'));
								
								foreach($cur_folder_content as $copy_file)
								{
									$actions['NEW_FILES'][$mod_dir . '/portal/modules/' . $copy_file] = $phpbb_root_path . 'portal/modules/' . $copy_file;
								}
							break;
							case 'styles':
								// there are more foreach to come .....
								$cur_folder_content = $this->cut_folder(scandir($mod_dir . '/styles/'));
								$styles = array();
								
								foreach($cur_folder_content as $copy_file)
								{
									$styles[] = $copy_file;
								}
								
								foreach($styles as $cur_style)
								{
									if(!file_exists($mod_dir . '/styles/' . $cur_style . '/template/portal/modules/'))
									{
										$file->remove();
										$this->directory_delete($mod_dir);
										trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
									}
									$style_content = $this->cut_folder(scandir($mod_dir . '/styles/' . $cur_style . '/template/portal/modules/'));

									foreach($style_content as $new_file)
									{
										$actions['NEW_FILES'][$mod_dir . '/styles/' . $cur_style . '/template/portal/modules/' . $new_file] = $phpbb_root_path . 'styles/' . $cur_style . '/template/portal/modules/' . $new_file;
									}
								}
							break;
							default:
								// there shouldn't be other files or folders
								$file->remove();
								$this->directory_delete($mod_dir);
								trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
						}
					}

					if (!sizeof($file->error))
					{
						// Let's start moving our files where they belong						
						foreach ($actions['NEW_FILES'] as $source => $target)
						{
							$status = $this->copy_content($source, $target);

							if ($status !== true && !is_null($status))
							{
								$module_installed = false;
							}

							$template->assign_block_vars('new_files', array(
								'S_SUCCESS'			=> ($status === true) ? true : false,
								'S_NO_COPY_ATTEMPT'	=> (is_null($status)) ? true : false,
								'SOURCE'			=> $source,
								'TARGET'			=> $target,
							));
						}
						
						$template->assign_vars(array(
							'S_MOD_SUCCESSBOX'	=> true,
							'MESSAGE'			=> $user->lang['MODULE_UPLOADED'],
							'U_RETURN'			=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules'),
							'S_INSTALL'			=> true,
						));
					}
				}
			}
			$file->remove();
			$this->directory_delete($mod_dir);
			if ($file->init_error || sizeof($file->error))
			{
				trigger_error((sizeof($file->error) ? implode('<br />', $file->error) : $user->lang['MOD_UPLOAD_INIT_FAIL']) . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			$this->tpl_name = 'portal/acp_portal_upload_module';
			$this->page_title = $user->lang['ACP_PORTAL_UPLOAD'];
			
			$template->assign_vars(array(
			'L_TITLE'			=> $user->lang['ACP_PORTAL_UPLOAD'],
			'L_TITLE_EXPLAIN'	=> '',

			'S_ERROR'			=> false, // if we get here, there was no error or we can ignore it
			'ERROR_MSG'			=> '',

			'U_ACTION'			=> $this->u_action,
		));
		}
	}
	
	/**
	* Cuts the unneeded '.' and '..' from the folder content info scandir returns
	*
	* @return: cut array
	*/
	function cut_folder($folder_content)
	{
		$cut_array = array('.', '..');
		$folder_content = array_diff($folder_content, $cut_array);
		
		return $folder_content;
	}

	function directory_move($src, $dest)
	{
		global $config;
		
		$src_contents = scandir($src);
		
		if (!is_dir($dest) && is_dir($src))
		{
			mkdir($dest . '/', octdec($config['am_dir_perms']));
		}
		
		foreach ($src_contents as $src_entry)
		{
			if ($src_entry != '.' && $src_entry != '..')
			{
				if (is_dir($src . '/' . $src_entry) && !is_dir($dest . '/' . $src_entry))
				{
					$this->directory_move($src . '/' . $src_entry, $dest . '/' . $src_entry);
				}
				else if (is_file($src . '/' . $src_entry) && !is_file($dest . '/' . $src_entry))
				{
					copy($src . '/' . $src_entry, $dest . '/' . $src_entry);
					chmod($dest . '/' . $src_entry, octdec($config['am_file_perms']));
				}
			}
		}
	}
	
	function directory_delete($dir)
	{
		if (!file_exists($dir))
		{
			return true;
		}
		
		if (!is_dir($dir) && is_file($dir))
		{
			phpbb_chmod($dir, CHMOD_ALL);
			return unlink($dir);
		}
		
        foreach (scandir($dir) as $item)
		{ 
            if ($item == '.' || $item == '..')
			{
				continue;
			}
            if (!$this->directory_delete($dir . "/" . $item))
			{
				phpbb_chmod($dir . "/" . $item, CHMOD_ALL);
                if (!$this->directory_delete($dir . "/" . $item))
				{
					return false;
				}
            }
        }
		
		return rmdir($dir);
	}
	
	/**
	* Moves files or complete directories
	*
	* @param $from string Can be a file or a directory. Will move either the file or all files within the directory
	* @param $to string Where to move the file(s) to. If not specified then will get moved to the root folder
	* @param $strip Used for FTP only
	* @return mixed: Bool true on success, error string on failure, NULL if no action was taken
	* 
	* NOTE: function should preferably not return in case of failure on only one file.  
	* 	The current method makes error handling difficult 
	*/
	function copy_content($from, $to = '', $strip = '')
	{
		global $phpbb_root_path, $user, $config;

		if (strpos($from, $phpbb_root_path) !== 0)
		{
			$from = $phpbb_root_path . $from;
		}

		if (strpos($to, $phpbb_root_path) !== 0)
		{
			$to = $phpbb_root_path . $to;
		}

		$dirname_check = dirname($to);

		if (!is_dir($dirname_check))
		{
			if ($this->recursive_mkdir($dirname_check) === false)
			{
				return sprintf($user->lang['MODULE_UPLOAD_MKDIR_FAILURE'], $dirname_check);
			}
		}

		$dest = $to;

		if (!@copy($from, $to))
		{
			return sprintf($user->lang['MODULE_COPY_FAILURE'], $dest);
		}
		@chmod($dest, octdec(0666));

		return true;
	}
	
	/**
	* @author Michal Nazarewicz (from the php manual)
	* Creates all non-existant directories in a path
	* @param $path - path to create
	* @param $mode - CHMOD the new dir to these permissions
	* @return bool
	*/
	function recursive_mkdir($path, $mode = false)
	{
		if (!$mode)
		{
			global $config;
			$mode = octdec(0777);
		}

		$dirs = explode('/', $path);
		$count = sizeof($dirs);
		$path = '.';
		for ($i = 0; $i < $count; $i++)
		{
			$path .= '/' . $dirs[$i];

			if (!is_dir($path))
			{
				@mkdir($path, $mode);
				@chmod($path, $mode);

				if (!is_dir($path))
				{
					return false;
				}
			}
		}
		return true;
	}
}