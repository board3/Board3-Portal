<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace phpbbgallery\core\tests\testframework;

abstract class test_case_helpers extends \phpbb_test_case_helpers
{
	/**
	* Copied from phpbb_test_case_helpers::get_test_config() to fix some paths
	*/
	static public function get_test_config()
	{
		$config = array();

		if (extension_loaded('sqlite') && version_compare(PHPUnit_Runner_Version::id(), '3.4.15', '>='))
		{
			$config = array_merge($config, array(
				'dbms'		=> 'phpbb_db_driver_sqlite',
				'dbhost'	=> dirname(__FILE__) . '/../phpbb_unit_tests.sqlite2', // filename
				'dbport'	=> '',
				'dbname'	=> '',
				'dbuser'	=> '',
				'dbpasswd'	=> '',
			));
		}

		if (isset($_SERVER['PHPBB_TEST_CONFIG']))
		{
			// Could be an absolute path
			$test_config = $_SERVER['PHPBB_TEST_CONFIG'];
		}
		else
		{
			$test_config = dirname(__FILE__) . '/../test_config.php';
		}

		if (file_exists($test_config))
		{
			include($test_config);

			if (!function_exists('phpbb_convert_30_dbms_to_31'))
			{
				global $phpbb_root_path;
				require_once $phpbb_root_path . 'includes/functions.php';
			}

			$config = array_merge($config, array(
				'dbms'		=> phpbb_convert_30_dbms_to_31($dbms),
				'dbhost'	=> $dbhost,
				'dbport'	=> $dbport,
				'dbname'	=> $dbname,
				'dbuser'	=> $dbuser,
				'dbpasswd'	=> $dbpasswd,
				'custom_dsn'	=> isset($custom_dsn) ? $custom_dsn : '',
			));

			if (isset($phpbb_functional_url))
			{
				$config['phpbb_functional_url'] = $phpbb_functional_url;
			}

			if (isset($phpbb_redis_host))
			{
				$config['redis_host'] = $phpbb_redis_host;
			}
			if (isset($phpbb_redis_port))
			{
				$config['redis_port'] = $phpbb_redis_port;
			}
		}

		if (isset($_SERVER['PHPBB_TEST_DBMS']))
		{
			if (!function_exists('phpbb_convert_30_dbms_to_31'))
			{
				global $phpbb_root_path;
				require_once $phpbb_root_path . 'includes/functions.php';
			}

			$config = array_merge($config, array(
				'dbms'		=> isset($_SERVER['PHPBB_TEST_DBMS']) ? phpbb_convert_30_dbms_to_31($_SERVER['PHPBB_TEST_DBMS']) : '',
				'dbhost'	=> isset($_SERVER['PHPBB_TEST_DBHOST']) ? $_SERVER['PHPBB_TEST_DBHOST'] : '',
				'dbport'	=> isset($_SERVER['PHPBB_TEST_DBPORT']) ? $_SERVER['PHPBB_TEST_DBPORT'] : '',
				'dbname'	=> isset($_SERVER['PHPBB_TEST_DBNAME']) ? $_SERVER['PHPBB_TEST_DBNAME'] : '',
				'dbuser'	=> isset($_SERVER['PHPBB_TEST_DBUSER']) ? $_SERVER['PHPBB_TEST_DBUSER'] : '',
				'dbpasswd'	=> isset($_SERVER['PHPBB_TEST_DBPASSWD']) ? $_SERVER['PHPBB_TEST_DBPASSWD'] : '',
				'custom_dsn'	=> isset($_SERVER['PHPBB_TEST_CUSTOM_DSN']) ? $_SERVER['PHPBB_TEST_CUSTOM_DSN'] : '',
			));
		}

		if (isset($_SERVER['PHPBB_FUNCTIONAL_URL']))
		{
			$config = array_merge($config, array(
				'phpbb_functional_url'	=> isset($_SERVER['PHPBB_FUNCTIONAL_URL']) ? $_SERVER['PHPBB_FUNCTIONAL_URL'] : '',
			));
		}

		if (isset($_SERVER['PHPBB_TEST_REDIS_HOST']))
		{
			$config['redis_host'] = $_SERVER['PHPBB_TEST_REDIS_HOST'];
		}

		if (isset($_SERVER['PHPBB_TEST_REDIS_PORT']))
		{
			$config['redis_port'] = $_SERVER['PHPBB_TEST_REDIS_PORT'];
		}

		return $config;
	}
}
