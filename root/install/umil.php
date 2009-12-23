<?php
/**
* @package Portal
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
define('IN_INSTALL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

$mod_name = 'PORTAL_MOD';

$version_config_name = 'portal_board3_version';
$language_file = 'mods/info_acp_portal';

$versions = array(
	// Version 1.1.0 => 1.2.x-dev
	'1.1.1'	=> array(
		'permission_add' => array(
			array('a_portal'),
		),
	),
	'1.1.4'	=> array(
		'table_add' => array(
			array(PORTAL_MODULES_TABLE, array(
				'COLUMNS'		=> array(
					'module_id'			=> array('UINT', NULL, 'auto_increment'),
					'module_classname'	=> array('VCHAR:64', ''),
					'module_column'		=> array('TINT:3', 0),
					'module_order'		=> array('TINT:3', 0),
					'module_name'		=> array('VCHAR', ''),
					'module_image_src'	=> array('VCHAR', ''),
					'module_group_ids'	=> array('VCHAR', ''),
				),
				'PRIMARY_KEY'		=> 'module_id',
			)),
		),
	),
);

// Include the UMIL Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);
?>