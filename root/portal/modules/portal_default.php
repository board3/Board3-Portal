<?php
/**
*
* @package Board3 Portal v2 - Default
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
	public $columns = 0;

	/**
	* Default modulename
	*/
	public $name = 'MODULENAME';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'modulename.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = '';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = '';

	/**
	* hide module name in ACP configuration page
	*/
	public $hide_name = false;

	public function get_template_center($module_id)
	{
		global $config, $template;

		$template->assign_vars(array(
			'EXAMPLE'			=> $config['board3_configname_' . $module_id],
		));

		return 'modulename_center.html';
	}

	public function get_template_side($module_id)
	{
		global $config, $template;

		$template->assign_vars(array(
			'EXAMPLE'			=> $config['board3_configname2_' . $module_id],
		));

		return 'modulename_side.html';
	}

	public function get_template_acp($module_id)
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
	public function install($module_id)
	{
		set_config('board3_configname_' . $module_id, 'Hello World!');
		set_config('board3_configname2_' . $module_id, 1337);
		return true;
	}

	public function uninstall($module_id)
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
