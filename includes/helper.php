<?php
/**
*
* @package Board3 Portal v2.3
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace board3\portal\includes;

class helper
{
	/**
	* Board3 Modules service collection
	* @var \phpbb\di\service_collection
	*/
	protected $modules;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	* @param \phpbb\di\service_collection $modules Board3 Modules service
	*						collection
	*/
	public function __construct($modules)
	{
		$this->register_modules($modules);
	}

	/**
	* Register list of Board3 Portal modules
	*
	* @param \phpbb\di\service_collection $modules Board3 Modules service
	*						collection
	* @return null
	*/
	protected function register_modules($modules)
	{
		foreach ($modules as $current_module)
		{
			$class_name = '\\' . get_class($current_module);
			if (!isset($this->modules[$class_name]))
			{
				$this->modules[$class_name] = $current_module;
			}
		}
	}

	/**
	* Get module specified by module class name
	*
	* @param string $module_name Module class name
	*
	* @return bool|object The module object if it exists, false if not
	*/
	public function get_module($module_name)
	{
		if (isset($this->modules[$module_name]))
		{
			return $this->modules[$module_name];
		}
		else
		{
			return false;
		}
	}

	/**
	* Get all supported modules
	*
	* @return array An array containing all supported modules
	*/
	public function get_all_modules()
	{
		return $this->modules;
	}
}
