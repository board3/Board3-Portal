<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = 'php';
require_once $phpbb_root_path . 'includes/startup.' . $phpEx;

$table_prefix = 'phpbb_';
require_once $phpbb_root_path . 'includes/constants.' . $phpEx;
require_once $phpbb_root_path . 'phpbb/class_loader.' . $phpEx;

$phpbb_class_loader_mock = new \phpbb\class_loader('phpbb_mock_', $phpbb_root_path . '../tests/mock/', "php");
$phpbb_class_loader_mock->register();
$phpbb_class_loader_ext = new \phpbb\class_loader('\\', $phpbb_root_path . 'ext/', "php");
$phpbb_class_loader_ext->register();
$phpbb_class_loader = new \phpbb\class_loader('phpbb\\', $phpbb_root_path . 'phpbb/', "php");
$phpbb_class_loader->register();

require_once $phpbb_root_path . '../tests/test_framework/phpbb_test_case_helpers.' . $phpEx;
require_once $phpbb_root_path . '../tests/test_framework/phpbb_test_case.' . $phpEx;
require_once $phpbb_root_path . '../tests/test_framework/phpbb_database_test_case.' . $phpEx;
require_once $phpbb_root_path . '../tests/test_framework/phpbb_database_test_connection_manager.' . $phpEx;
require_once $phpbb_root_path . '../tests/test_framework/phpbb_functional_test_case.' . $phpEx;
