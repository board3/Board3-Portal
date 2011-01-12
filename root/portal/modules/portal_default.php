<?php
/**
* @package Portal - Modulname
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
* @package Modulname
*/
class portal_modulename_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	var $columns = 0;

	/**
	* Default modulename
	*/
	var $name = 'MODULENAME';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	var $image_src = 'modulename.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	var $language = '';
	
	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	var $custom_acp_tpl = '';

	function get_template_center($module_id)
	{
		global $config, $template;

		$template->assign_vars(array(
			'EXAMPLE'			=> $config['board3_configname_' . $module_id],
		));

		return 'modulename_center.html';
	}

	function get_template_side($module_id)
	{
		global $config, $template;

		$template->assign_vars(array(
			'EXAMPLE'			=> $config['board3_configname2_' . $module_id],
		));

		return 'modulename_side.html';
	}

	function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_CONFIG_MODULENAME',
			'vars'	=> array(
				'legend1'								=> 'ACP_MODULENAME_CONFIGLEGEND',
				'board3_configname_' . $module_id	=> array('lang' => 'MODULENAME_CONFIGNAME',		'validate' => 'string',	'type' => 'text:10:200',	'explain' => false),
				'board3_configname2_' . $module_id	=> array('lang' => 'MODULENAME_CONFIGNAME2',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
			),
		);
	}

	/**
	* API functions
	*/
	function install($module_id)
	{
		set_config('board3_configname_' . $module_id, 'Hello World!');
		set_config('board3_configname2_' . $module_id, 1337);
		return true;
	}

	function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_configname_' . $module_id,
			'board3_configname2_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}

?>