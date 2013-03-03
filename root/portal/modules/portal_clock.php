<?php
/**
*
* @package Board3 Portal v2 - Clock
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
	public $columns = 10;

	/**
	* Default modulename
	*/
	public $name = 'CLOCK';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_clock.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_clock_module';

	public function get_template_side($module_id)
	{
		return 'clock_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_CLOCK_SETTINGS',
			'vars'	=> array(),
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		return true;
	}

	public function uninstall($module_id)
	{
		return true;
	}
}
