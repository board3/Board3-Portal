<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

die('This script shouldn\'t be run unless you really know what you do. If this script exists on a live board, please delete it.');

define('IN_PHPBB', true);
define('B3_MODULE_ENABLED', 1);
define('GROUPS_TABLE', '$this->table_prefix . \'groups');
$phpbb_root_path = '../../../../';
$root_path = '../'; // one directory down
include($phpbb_root_path . 'includes/startup.php');
$php_ex = substr(strrchr(__FILE__, '.'), 1);
$phpEx = $php_ex;
$table_prefix = 'phpbb_';
require_once $phpbb_root_path . 'includes/constants.php';
require_once $phpbb_root_path . 'phpbb/class_loader.' . $phpEx;

$phpbb_class_loader_mock = new \phpbb\class_loader('phpbb_mock_', $phpbb_root_path . '../tests/mock/', "php");
$phpbb_class_loader_mock->register();
$phpbb_class_loader_ext = new \phpbb\class_loader('\\', $phpbb_root_path . 'ext/', "php");
$phpbb_class_loader_ext->register();
$phpbb_class_loader = new \phpbb\class_loader('phpbb\\', $phpbb_root_path . 'phpbb/', "php");
$phpbb_class_loader->register();

require($phpbb_root_path . 'includes/functions_content.' . $phpEx);
require($phpbb_root_path . 'includes/functions_container.' . $phpEx);
include($phpbb_root_path . 'includes/functions_compatibility.' . $phpEx);
require($root_path . 'develop/phpbb_functions.' . $phpEx);
// Set up container
$phpbb_container = phpbb_create_default_container($phpbb_root_path, $phpEx);

$config_entry = $portal_config_entry = $db_data = array();

function set_config($name, $val)
{
	global $config_entry;

	if (isset($config_entry[$name]))
	{
		trigger_error('Duplicate entry: ' . $name);
	}

	handle_string($val);

	$config_entry[$name] = $val;
}

function handle_string(&$str)
{
	if (is_string($str) && strpos($str, '$') === 0)
	{
	      // @codingStandardsIgnoreStart
	      $str = str_replace(',', ' . \',\' . ', $str);
	      // @codingStandardsIgnoreEnd
	}
	else if (is_string($str))
	{
		$str = "'$str'";
	}

	if (empty($str))
	{
		$str = "''";
	}
}

function set_portal_config($name, $val)
{
	global $portal_config_entry;

	if (isset($portal_config_entry[$name]))
	{
		trigger_error('Duplicate entry: ' . $name);
	}

	handle_string($val);

	// we do not want serialized entries as they are hard to read
	if (strpos($val, 'a:') === 1)
	{
		// cut preceding and appended quote
		$val = substr($val, 1, -1);
		// start unserializing and building
		$val = unserialize($val);
		$after_val = 'serialize(array(<br />';
		foreach ($val as $key => $entry)
		{
			if (is_array($entry))
			{
				$after_val .= '			array(<br />';
				foreach ($entry as $one => $two)
				{
					handle_string($one);
					handle_string($two);
					$after_val .= '				' . $one . '		=> ' . $two . ',<br />';
				}
				$after_val .= '			),<br />';
			}
			else
			{
				handle_string($key);
				handle_string($entry);
				$after_val .= '		' . $key . '		=> ' . $entry . ',<br />';
			}
		}
		$after_val .= '		))';
		$val = $after_val;
	}

	$portal_config_entry[$name] = $val;
}

$db = new db($db_data);
board3_get_install_data($db, $root_path, $php_ex, $db_data);

echo 'set_config entries for migrations:<br /><pre>';
foreach ($config_entry as $name => $val)
{
	echo '			array(\'config.add\', array(\'' . $name . '\', ' . $val . ')),<br />';
}
echo '</pre>';

echo '<br /><br />set_portal_config entries for migrations:<br /><pre>';
foreach ($portal_config_entry as $name => $val)
{
	echo '		$this->set_portal_config(\'' . $name . '\', ' . $val . ');<br />';
}
echo '</pre>';

echo '<br /><br />database entries:<br /><pre>';
echo $db_data . '</pre><br />';

/**
* This function will install the basic set of portal modules
*
* only set $purge_modules to false if you already know that the table is empty
* set $u_action to where the user should be redirected after this
* note that already existing data won't be deleted from the config and portal_config
* just to make sure we don't overwrite anything, the IDs won't be reset
* !! this function should usually only be executed once upon installing the portal !!
* DO NOT set $purge_modules to false unless you want to auto-add all modules again after deleting them (i.e. if your database was corrupted)
*/
function board3_get_install_data($db, $root_path, $php_ex, &$db_data)
{
	global $phpbb_container;

	$directory = $root_path . 'portal/modules/';
	$db_data = '		$board3_sql_query = array(<br />';

	/*
	* this is a list of the basic modules that will be installed
	* module_name => array(module_column, module_order)
	*/
	$modules_ary = array(
		// left column
		'portal_main_menu' 		=> array(1, 1),
		'portal_stylechanger'	=> array(1, 2),
		'portal_birthday_list'	=> array(1, 3),
		'portal_clock'			=> array(1, 4),
		'portal_search'			=> array(1, 5),
		'portal_attachments'	=> array(1, 6),
		'portal_topposters'		=> array(1, 7),
		'portal_latest_members'	=> array(1, 8),
		'portal_link_us'		=> array(1, 9),

		// center column
		'portal_welcome'		=> array(2, 1),
		'portal_recent'			=> array(2, 2),
		'portal_announcements'	=> array(2, 3),
		'portal_news'			=> array(2, 4),
		'portal_poll'			=> array(2, 5),
		'portal_whois_online'	=> array(2, 6),

		// right column
		'portal_user_menu'		=> array(3, 1),
		'portal_statistics'		=> array(3, 2),
		'portal_calendar'		=> array(3, 3),
		'portal_leaders'		=> array(3, 4),
		'portal_latest_bots'	=> array(3, 5),
		'portal_links'			=> array(3, 6),
	);

	foreach ($modules_ary as $module_name => $module_data)
	{
		$new_module_name = '\\board3\\portal\\modules\\' . str_replace('portal_', '', $module_name);
		if (class_exists($new_module_name))
		{
			$c_class = $phpbb_container->get('board3.module.' . str_replace('portal_', '', $module_name));
			$module_name = $new_module_name;
		}
		else
		{
			$class_name = $module_name . '_module';
			if (!class_exists($class_name))
			{
				include($directory . $module_name . '.' . $php_ex);
			}
			if (!class_exists($class_name))
			{
				trigger_error('Class not found: ' . $class_name, E_USER_ERROR);
			}

			$c_class = new $class_name();
			$module_name = substr($module_name, 7);
		}

		$sql_ary = array(
			'module_classname'		=> $module_name,
			'module_column'			=> $module_data[0],
			'module_order'			=> $module_data[1],
			'module_name'			=> $c_class->get_name(),
			'module_image_src'		=> $c_class->get_image(),
			'module_group_ids'		=> '',
			'module_image_width'	=> 16,
			'module_image_height'	=> 16,
			'module_status'			=> B3_MODULE_ENABLED,
		);
		$sql = 'INSERT INTO \' . $this->table_prefix . \'portal_modules ' . $db->sql_build_array('INSERT', $sql_ary);
		$db->sql_query($sql, true);

		$data1 = array();
		$data2 = array();
		$db_data .= '			array(<br />';
		foreach ($sql_ary as $key => $val)
		{
			$key = (is_string($key)) ? '\'' . $key . '\'' : $key;
			$val = (is_string($val)) ? '\'' . $val . '\'' : $val;
			$db_data .= '				' . $key . '		=> ' . $val . ',<br />';
		}
		$db_data .= '			),<br />';
		$c_class->install($db->sql_id());
	}
	$db_data .= '		);';
}

class db
{
	// start at 0
	private $sql_id = 0;

	private $id = 0;

	private $int_pointer = 0;

	private $sql_ary = array();

	private $sql_in_set = array();

	private $data = array();

	public function __construct(&$data)
	{
		$this->data = &$data;
	}
	public function sql_id()
	{
		return $this->sql_id;
	}

	public function sql_query($sql, $increase = false)
	{
		if (strpos($sql, 'INSERT') !== false)
		{
			//$this->data[] = $sql;
		}
		if ($increase)
		{
			$this->sql_id++;
		}
		$this->id++;
		$this->sql_ary[$this->id] = $sql;
		return $this->id;
	}

	public function sql_build_array($type, $ary)
	{
		$data1 = array();
		$data2 = array();
		foreach ($ary as $key => $val)
		{
			$data1[] = $key;
			$data2[] = (is_string($val)) ? '\'' . $val . '\'' : $val;
		}
		return '(' . implode(', ', $data1) . ') VALUES (' . implode(', ', $data2) . ');';
	}

	public function sql_in_set($data1, $data2, $bool = -1)
	{
		$this->sql_in_set[$this->id + 1] = array($data1, $data2);
		return '\' . $db->sql_in_set('. $data1 . ', array(' . implode(',', $data2) . (($bool !== -1) ? '), ' . $bool : '') . '))';
	}

	public function sql_fetchrow($id)
	{
		if (isset($this->sql_ary[$id]))
		{
			preg_match_all('/SELECT+[a-z0-9A-Z,_ ]+FROM/', $this->sql_ary[$id], $match);
			if (!empty($match))
			{
				// cut "SELECT " and " FROM"
				$match = substr($match[0][0], 7, strlen($match[0][0]) - 5 - 7);
				$match = str_replace(', ', ',', $match);
				$match = explode(',', $match);
				if (isset($this->sql_in_set[$id][1][$this->int_pointer]))
				{
					$ret = array();
					foreach ($match as $key)
					{
						if ($key == $this->sql_in_set[$id][0])
						{
							$ret[$key] = $this->sql_in_set[$id][1][$this->int_pointer];
						}
						else
						{
							$ret[$key] = "{foobar.{$key}.{$this->sql_in_set[$id][1][$this->int_pointer]}}";
						}
					}
					$this->int_pointer++;
					return $this->preg_replace_value($ret);
				}
			}
		}
		else
		{
			return false;
		}
	}

	protected function preg_replace_value($value)
	{
		return preg_replace("/\{foobar\.group_id\.\s*([A-Z_]+?)\s*+\}/", "\$groups_ary['$1']", $value);
	}
}

/**
* Convert either 3.0 dbms or 3.1 db driver class name to 3.1 db driver class name.
*
* If $dbms is a valid 3.1 db driver class name, returns it unchanged.
* Otherwise prepends phpbb\db\driver\ to the dbms to convert a 3.0 dbms
* to 3.1 db driver class name.
*
* @param string $dbms dbms parameter
* @return db driver class
*/
function phpbb_convert_30_dbms_to_31($dbms)
{
	// Note: this check is done first because mysqli extension
	// supplies a mysqli class, and class_exists($dbms) would return
	// true for mysqli class.
	// However, per the docblock any valid 3.1 driver name should be
	// recognized by this function, and have priority over 3.0 dbms.
	if (class_exists('phpbb\db\driver\\' . $dbms))
	{
		return 'phpbb\db\driver\\' . $dbms;
	}

	if (class_exists($dbms))
	{
		// Additionally we could check that $dbms extends phpbb\db\driver\driver.
		// http://php.net/manual/en/class.reflectionclass.php
		// Beware of possible performance issues:
		// http://stackoverflow.com/questions/294582/php-5-reflection-api-performance
		// We could check for interface implementation in all paths or
		// only when we do not prepend phpbb\db\driver\.

		/*
		$reflection = new \ReflectionClass($dbms);

		if ($reflection->isSubclassOf('phpbb\db\driver\driver'))
		{
			return $dbms;
		}
		*/

		return $dbms;
	}

	throw new \RuntimeException("You have specified an invalid dbms driver: $dbms");
}
