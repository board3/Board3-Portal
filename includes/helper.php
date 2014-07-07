<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\includes;

class helper
{
	/**
	* Auth object
	* @var \phpbb\auth\auth
	*/
	private $auth;

	/**
	* Board3 Modules service collection
	* @var \phpbb\di\service_collection
	*/
	protected $modules;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	* @param \phpbb\auth\auth $auth Auth object
	* @param \phpbb\di\service_collection $modules Board3 Modules service
	*						collection
	*/
	public function __construct($auth, $modules)
	{
		$this->auth = $auth;
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
	* Get an array of disallowed forums
	*
	* @param bool $disallow_access Whether the array for disallowing access
	*			should be filled
	*/
	public function get_disallowed_forums($disallow_access)
	{
		if ($disallow_access == true)
		{
			$disallow_access = array_unique(array_keys($this->auth->acl_getf('!f_read', true)));
		}
		else
		{
			$disallow_access = array();
		}

		return $disallow_access;
	}
}
