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
class portal_upload
{
	/*
	* pre-defined vars
	*/
	private $upload_path;
	private $u_action;

	/*
	* constructor function
	*/
	public function __construct($path, $u_action)
	{
		// This shouldn't happen, but we check for it anyways
		if(is_dir($path))
		{
			$this->upload_path = $path;
			$this->u_action = $u_action;

			$this->upload_file();
		}
	}

	/**
	* upload module zip
	*/
	private function upload_file()
	{
		global $user, $phpbb_root_path, $phpEx, $phpbb_admin_path, $template;
		// Upload part
		$user->add_lang('posting');  // For error messages
		include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
		$upload = new fileupload();
		// Only allow ZIP files
		$upload->set_allowed_extensions(array('zip'));

		$file = $upload->form_upload('modupload');

		// this is for module zips so don't allow anything else
		if (empty($file->filename) || !preg_match('.zip.', $file->get('realname')))
		{
			trigger_error($user->lang['NO_FILE_B3P'] . adm_back_link($this->u_action), E_USER_WARNING);
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
						$this->directory_move($mod_dir . '_tmp/' . $folder_contents[0], $this->upload_path . $folder_contents[0]);
						$new_mod_dir = $this->upload_path . $folder_contents[0];

					}
					else if (!is_dir($mod_dir))
					{
						// Change the name of the directory by moving to directory without _tmp in it
						$this->directory_move($mod_dir . '_tmp/', $mod_dir);
						$new_mod_dir = $mod_dir;
					}

					$this->directory_delete($mod_dir . '_tmp/');

					// make sure we set $mod_dir to the correct folder after the above step
					$mod_dir = (isset($new_mod_dir)) ? $new_mod_dir : $mod_dir;

					// if we got until here set $actions['NEW_FILES']
					$actions['NEW_FILES'] = array();

					// Now we need to get the files inside the folders
					//$folder_contents = $this->cut_folder(scandir($mod_dir));
					$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($mod_dir)); // requires PHP 5

					foreach($iterator as $cur_file)
					{
						$cur_path = $cur_file->getPathname();
						$cur_path = str_replace('\\', '/', $cur_path); // we want unix-like paths
						$cur_path = str_replace($mod_dir . '/', '', $cur_path);
						$cut_pos = strpos($cur_path, '/');

						/* 
						* We only copy files. The recursive iterator might grab paths depending on
						* the PHP version. This will trigger our error handle with trigger_error()
						* though. If we are trying to copy a directory just move on.
						*/
						if (is_dir($cur_path))
						{
							continue;
						}

						// Only allow files in adm, language, portal and styles folder and a license.txt
						if(!in_array(substr($cur_path, 0, $cut_pos), array('adm', 'language', 'portal', 'styles')) && $cur_file->getFilename() != 'license.txt')
						{
							$file->remove();
							$this->directory_delete($mod_dir);
							trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
						}
						else
						{
							$actions['NEW_FILES'][$mod_dir . '/' . $cur_path] = $phpbb_root_path . $cur_path;
						}
					}

					if (!sizeof($file->error))
					{
						// Let's start moving our files where they belong						
						foreach ($actions['NEW_FILES'] as $source => $target)
						{
							/*
							* make sure we don't try to copy folders
							* folders will be created if necessary in copy_content
							*/
							if(is_dir($source))
							{
								continue;
							}
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
	private function cut_folder($folder_content)
	{
		$cut_array = array('.', '..');
		$folder_content = array_diff($folder_content, $cut_array);

		return $folder_content;
	}

	private function directory_move($src, $dest)
	{
		$src_contents = scandir($src);

		if (!is_dir($dest) && is_dir($src))
		{
			mkdir($dest . '/', 0755);
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
					@copy($src . '/' . $src_entry, $dest . '/' . $src_entry);
					@chmod($dest . '/' . $src_entry, 0644);
				}
			}
		}
	}

	/**
	* the following functions are from the AutoMOD package
	* @copyright (c) 2008 phpBB Group
	* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
	*/

	private function directory_delete($dir)
	{
		if (!file_exists($dir))
		{
			return true;
		}

		if (!is_dir($dir) && is_file($dir))
		{
			@chmod($dir, 0644);
			return @unlink($dir);
		}

		foreach (scandir($dir) as $item)
		{ 
			if ($item == '.' || $item == '..')
			{
				continue;
			}
			if (!$this->directory_delete($dir . "/" . $item))
			{
				@chmod($dir . "/" . $item, 0644);
				if (!$this->directory_delete($dir . "/" . $item))
				{
					return false;
				}
			}
		}

		return @rmdir($dir);
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
	private function copy_content($from, $to = '', $strip = '')
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

		// leave a backup file if it already exists
		if(file_exists($to))
		{
			// remove old backup file first
			if(file_exists($to . '.bak'))
			{
				@chmod($to . '.bak', 0644);
				unlink($to . '.bak');
			}
			@rename($to, $to . '.bak');
			@chmod($to, 0644);
		}

		if (!@copy($from, $to))
		{
			return sprintf($user->lang['MODULE_COPY_FAILURE'], $to);
		}
		@chmod($to, 0644);

		return true;
	}

	/**
	* @author Michal Nazarewicz (from the php manual)
	* Creates all non-existant directories in a path
	* @param $path - path to create
	* @param $mode - CHMOD the new dir to these permissions
	* @return bool
	*/
	private function recursive_mkdir($path, $mode = false)
	{
		if (!$mode)
		{
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
