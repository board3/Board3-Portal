<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package module_base
*/
class module_base implements module_interface
{
	/** @var int Module's allowed columns */
	protected $columns;

	/** @var string Module name */
	protected $name;

	/** @var string Module image source */
	protected $image_src;

	/** @var string Module language file */
	protected $language;

	/** @var bool Can include this module multiple times */
	protected $multiple_includes = false;

	/**
	* {@inheritdoc}
	*/
	public function get_allowed_columns()
	{
		return $this->columns;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_name()
	{
		return $this->name;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_image()
	{
		return $this->image_src;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_language()
	{
		return $this->language;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		return;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		return;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array();
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function can_multi_include()
	{
		return $this->multiple_includes;
	}
}
