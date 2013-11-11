<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace board3\portal\modules;

/**
* @package module_interface
*/
interface module_interface
{
	/**
	* Get allowed columns
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*
	* @return int Allowed columns
	*/
	public function get_allowed_columns();

	/**
	* Get module name
	*
	* @return string Module name, e.g. BOARD3_NEWS
	*/
	public function get_name();

	/**
	* Get default module image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*
	* @return string Module image file
	*/
	public function get_image();

	/**
	* Get module language file
	* File must be in "board3/portal/language/{$user->lang}/portal/" or
	* this should return false.
	*
	* @return string|bool Language file or false
	*/
	public function get_language();

	/**
	* Get template file for side columns
	*
	* @param int $module_id Module's ID
	*
	* @return string Module template file
	*/
	public function get_template_side($module_id);

	/**
	* Get template file for center columns
	*
	* @param int $module_id Module's ID
	*
	* @return string Module template file
	*/
	public function get_template_center($module_id);

	/**
	* Get acp settings
	*
	* @param int $module_id Module's ID
	*
	* @return array ACP settings for module
	*/
	public function get_template_acp($module_id);

	/**
	* Install module
	* Executes any additional commands for installing the module
	*
	* @param int $module_id Module's ID
	*
	* @return bool True if install was successful, false if not
	*/
	public function install($module_id);

	/**
	* Uninstall module
	* Executes any additional commands for uninstalling the module
	*
	* @param int $module_id Module's ID
	*
	* @return bool True if uninstall was successful, false if not
	*/
	public function uninstall($module_id);
}
