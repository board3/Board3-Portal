<?php
/**
* @package Portal - Clock
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package Clock
*/
class portal_clock_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	var $columns = 10;

	/**
	* Default modulename
	*/
	var $name = 'CLOCK';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	var $image_src = 'portal_clock.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	var $language = 'portal_clock_module';

	function get_template_side($module_id)
	{
		global $config, $template;

		$template->assign_vars(array(
			'CLOCK_SRC'			=> $config['board3_clock_src_' . $module_id],
		));

		return 'clock_side.html';
	}

	function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_CLOCK_SETTINGS',
			'vars'	=> array(
				'legend1'			=> 'ACP_PORTAL_CLOCK_SETTINGS',
				'board3_clock_src_' . $module_id	=> array('lang' => 'ACP_PORTAL_CLOCK_SRC',		'validate' => 'string',	'type' => 'text:50:200',	'explain' => true, 'submit_type' => 'custom', 'submit' => 'check_clock_src'),
			),
		);
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		set_config('board3_clock_src_' . $module_id, 'board3clock.swf');
		return true;
	}

	function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_clock_src_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
	
	
	/*
	* check if the entered clock src file actually exists
	*/
	function check_clock_src($value, $key, $module_id)
	{
		global $db, $phpbb_root_path, $phpEx, $user;
		
		$sql = 'SELECT st.theme_path
				FROM ' . STYLES_THEME_TABLE . ' st
					LEFT JOIN ' . STYLES_TABLE . ' s
						ON (st.theme_id = s.style_id)
				WHERE s.style_active = 1';
				
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result))
		{
			if(!file_exists($phpbb_root_path . 'styles/' . $row['theme_path'] . '/theme/images/portal/' . $value))
			{
				$error = $user->lang['B3P_FILE_NOT_FOUND'] . ': styles/' . $row['theme_path'] . '/theme/images/portal/' . $value . '<br />';
			}
		}
		$db->sql_freeresult($result);
		
		if(isset($error))
		{
			trigger_error($error . adm_back_link(append_sid("{$phpbb_root_path}adm/index.$phpEx", 'i=portal&amp;mode=config&amp;module_id=' . $module_id)));
		}
	}
}

?>