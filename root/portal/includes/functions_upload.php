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
	var $this->upload_path;
	var $this->error = array();
	
	/*
	* constructor function for PHP<5
	*/
	function portal_upload($path)
	{
		if(is_dir($path))
		{
			$this->upload_path = $path;
			
			$result = $this->upload_file();
			
			if($result != true)
			{
				$this->error = $result;
			}
			
			$this->finishing_touches();
		}
	}
	
	function upload_file()
	{
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
				$file->move_file(str_replace($phpbb_root_path, '', $upload_path), true, true);
				
				if (!sizeof($file->error))
				{
					include($phpbb_root_path . 'includes/functions_compress.' . $phpEx);
					$mod_dir = $upload_path . str_replace('.zip', '', $file->get('realname'));
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
						$this->directory_move($mod_dir . '_tmp/' . $folder_contents[0], $upload_path . '/' . $folder_contents[0]);
						
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
									$lang_content = $this->cut_folder(scandir($mod_dir . '/language/' . $cur_lang . '/'));

									foreach($lang_content as $new_file)
									{
										$actions['NEW_FILES'][$mod_dir . '/language/' . $cur_lang . '/' . $new_file] = $phpbb_root_path . 'language/' . $cur_lang . '/mods/portal/' . $new_file;
									}
								}
							break;
							case 'module':
								$cur_folder_content = $this->cut_folder(scandir($mod_dir . '/module/'));
								
								foreach($cur_folder_content as $copy_file)
								{
									$actions['NEW_FILES'][$mod_dir . '/module/' . $copy_file] = $phpbb_root_path . 'portal/modules/' . $copy_file;
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
									$style_content = $this->cut_folder(scandir($mod_dir . '/styles/' . $cur_style));

									foreach($style_content as $new_file)
									{
										$actions['NEW_FILES'][$mod_dir . '/styles/' . $cur_style . '/' . $new_file] = $phpbb_root_path . 'styles/' . $cur_style . '/template/portal/modules/' . $new_file;
									}
								}
							break;
							default:
								// there shouldn't be other files or folders
								trigger_error($user->lang['MODULE_CORRUPTED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
						}
					}

					if (!sizeof($file->error))
					{
						include("{$phpbb_root_path}includes/functions_transfer.$phpEx");
						include("{$phpbb_root_path}includes/editor.$phpEx");
						include("{$phpbb_root_path}includes/functions_mods.$phpEx");
						include("{$phpbb_root_path}includes/mod_parser.$phpEx");
						
						if(!function_exists('determine_write_method') || !class_exists('editor') || !class_exists('parser'))
						{
							trigger_error($user->lang['NO_AUTOMOD_INSTALLED'] . adm_back_link(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules')), E_USER_WARNING);
						}

						// start the page
						$user->add_lang(array('install', 'acp/mods'));
						
						// Let's start moving our files where they belong
						$write_method = 'editor_' . determine_write_method(false);
						$editor = new $write_method();
						
						foreach ($actions['NEW_FILES'] as $source => $target)
						{
							$status = $editor->copy_content($source, $target);

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
						
						$editor->commit_changes($mod_dir . '_edited', '');
						
						$template->assign_vars(array(
							'S_MOD_SUCCESSBOX'	=> true,
							'MESSAGE'			=> $user->lang['INSTALLED'],
							'U_RETURN'			=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=modules'),
						));
					}
				}
			}
			$file->remove();				
			if ($file->init_error || sizeof($file->error))
			{
				trigger_error((sizeof($file->error) ? implode('<br />', $file->error) : $user->lang['MOD_UPLOAD_INIT_FAIL']) . adm_back_link($this->u_action), E_USER_WARNING);
			}
			
			$this->tpl_name = 'portal/acp_portal_upload_module';
			$this->page_title = $user->lang['ACP_PORTAL_UPLOAD'];
			
			$template->assign_vars(array(
			'L_TITLE'			=> $user->lang['ACP_PORTAL_UPLOAD'],
			'L_TITLE_EXPLAIN'	=> '',

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

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
		
		return $folder_content
	}
	
	function determine_write_method($pre_install = false)
	{
		global $phpbb_root_path, $config;

		/* 
		* to be truly correct, we should scan all files ...
		* no ftp upload here
		*/
		if ((is_writable($phpbb_root_path)) || $pre_install)
		{
			$write_method = 'direct';
		}
		else
		{
			$write_method = 'manual';
		}

		return $write_method;
	}

}