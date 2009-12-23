<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

// COULD BE DELETED

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_portal_config
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $cache, $template;
		global $config, $portal_config, $phpbb_root_path, $portal_root_path, $phpbb_admin_path, $phpEx;
		$portal_root_path = PORTAL_ROOT_PATH;
	
		if (!function_exists('obtain_portal_config'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
		}
		$portal_config = obtain_portal_config();

		if (!function_exists('mod_version_check'))
		{
			include($phpbb_root_path . $portal_root_path . 'includes/functions_version_check.' . $phpEx);
		}
		mod_version_check();	

		$user->add_lang('mods/portal');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_time';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writeable), path (relative path, but able to escape the root), wpath (writeable)
		*/
		switch ($mode)
		{
			case 'config':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_GENERAL_TITLE',
					'vars'	=> array(
						'legend1'					=> 'ACP_PORTAL_GENERAL_INFO',
						'portal_enable'				=> array('lang' => 'PORTAL_ENABLE',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_left_column_width'	=> array('lang' => 'PORTAL_LEFT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_right_column_width'	=> array('lang' => 'PORTAL_RIGHT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
					)
				);
			break;
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);
		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}

		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];
			
			if ($submit)
			{
				set_portal_config($config_name, $config_value);
			}
		}
		
		if ($submit)
		{
			$cache->destroy('sql', PORTAL_CONFIG_TABLE);
			add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$this->tpl_name = 'acp_portal_config';
		$this->page_title = $display_vars['title'];

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ACTION'			=> $this->u_action)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}
			$this->new_config[$config_key] = $portal_config[$config_key];
			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXP'])) ? $user->lang[$vars['lang'] . '_EXP'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
			));

			unset($display_vars['vars'][$config_key]);
		}
	}
}
?>