<?php
/**
* @package Portal
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

global $table_prefix;

// Config constants
define('B3_LINKS_CAT', 0);
define('B3_LINKS_INT', 1);
define('B3_LINKS_EXT', 2);

// Tables and paths
define('PORTAL_ROOT_PATH', 'portal/');
define('PORTAL_MODULES_TABLE',		$table_prefix . 'portal_modules');
define('PORTAL_CONFIG_TABLE',		$table_prefix . 'portal_config');

?>