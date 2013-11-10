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
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_base
*/
class module_base implements module_interface
{
	/**
	* @inheritdoc
	*/
	public function get_allowed_columns()
	{
		return $this->columns;
	}

	/**
	* @inheritdoc
	*/
	public function get_name()
	{
		return $this->name;
	}

	/**
	* @inheritdoc
	*/
	public function get_image()
	{
		return $this->image_src;
	}

	/**
	* @inheritdoc
	*/
	public function get_language()
	{
		return $this->language;
	}

	/**
	* @inheritdoc
	*/
	public function get_template_side($module_id)
	{
		return;
	}

	/**
	* @inheritdoc
	*/
	public function get_template_center($module_id)
	{
		return;
	}

	/**
	* @inheritdoc
	*/
	public function get_template_acp($module_id)
	{
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function install($module_id)
	{
		return true;
	}

	/**
	* @inheritdoc
	*/
	public function uninstall($module_id)
	{
		return true;
	}
}
