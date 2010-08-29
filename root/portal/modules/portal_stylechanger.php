<?php
/**
* @package Portal - Stylechanger
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
* @package Stylechanger
*/
class portal_stylechanger_module
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
	var $name = 'BOARD_STYLE';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	var $image_src = 'portal_style.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	var $language = 'portal_stylechanger_module';

	function get_template_side($module_id)
	{
		global $config, $template, $db, $phpEx;

		$style_count = 0;
		$style_select = '';
		$sql = 'SELECT style_id, style_name
			FROM ' . STYLES_TABLE . '
			WHERE style_active = 1
			ORDER BY LOWER(style_name) ASC';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$style = request_var('style', 0);
			if($style)
			{
				$url = str_replace('style=' . $style, 'style=' . $row['style_id'], append_sid("{$phpbb_root_path}portal.$phpEx"));
			}
			else
			{
				$url = append_sid("{$phpbb_root_path}portal.$phpEx", 'style=' . $row['style_id']);
			}
			++$style_count;
			$style_select .= '<option value="' . $url . '"' . ($row['style_id'] == $user->theme['style_id'] ? ' selected="selected"' : '') . '>' . htmlspecialchars($row['style_name']) . '</option>';
		}
		$db->sql_freeresult($result);
		if(strlen($style_select))
		{
			$template->assign_var('STYLE_SELECT', $style_select);
		}


		// Assign specific vars
		$template->assign_vars(array(
			'S_STYLE_OPTIONS'			=> ($config['override_user_style'] || $style_count < 2) ? '' : style_select($user->data['user_style']),
			'S_DISPLAY_CHANGE_STYLE'	=> true,
		));

		return 'stylechanger_side.html';
	}

	function get_template_acp($module_id)
	{
		return array();
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		set_config('portal_' . $module_id . '_configname', 'Hello World!');
		set_config('portal_' . $module_id . '_configname2', 1337);
		return true;
	}

	function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'portal_' . $module_id . '_configname',
			'portal_' . $module_id . '_configname2',
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}

?>