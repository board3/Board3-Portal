<?php
/**
*
* @package testing
* @copyright (c) 2015 Board3 Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\mock;

class controller_helper
{
	protected $phpbb_root_path;

	protected $php_ext;

	protected $routes;

	public function __construct($phpbb_root_path, $php_ext)
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function add_route($name, $url)
	{
		$this->routes[$name] = $url;
	}

	public function route($route)
	{
		return append_sid("{$this->phpbb_root_path}app.{$this->php_ext}/{$this->routes[$route]}");
	}
}
