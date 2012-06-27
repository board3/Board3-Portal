<?php
/**
*
* @package Board3 Portal v2
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
 * @ignore
 */
define('UMIL_AUTO', true);
define('IN_INSTALL', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
define('IN_PHPBB', true);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

if (!function_exists('board3_basic_install'))
{
	include($phpbb_root_path . 'portal/includes/functions.' . $phpEx);
}

if (!defined('PORTAL_CONFIG_TABLE'))
{
	include($phpbb_root_path . 'portal/includes/constants.' . $phpEx);
}

// The name of the mod to be displayed during installation.
$mod_name = 'Board3 Portal';

global $user;

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'board3_portal_version';


// The language file which will be included when installing
$language_file = 'mods/info_acp_portal';


/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
//$logo_img = 'styles/prosilver/imageset/site_logo.gif';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'2.0.0-a1' => array(
		'permission_add' => array(
			array('u_view_portal', 1),
			array('a_manage_portal', 1),
		),

		'permission_set' => array(
			array('GUESTS', 'u_view_portal', 'group'),
			array('REGISTERED_COPPA', 'u_view_portal', 'group'),
			array('GLOBAL_MODERATORS', 'u_view_portal', 'group'),
			array('ADMINISTRATORS', 'u_view_portal', 'group'),
			array('BOTS', 'u_view_portal', 'group'),
			array('NEWLY_REGISTERED', 'u_view_portal', 'group'),
		),

		'table_add' => array(
			array(PORTAL_MODULES_TABLE, array(
				'COLUMNS' => array(
					'module_id' => array('UINT:3', NULL, 'auto_increment'),
					'module_classname' => array('VCHAR:64', ''),
					'module_column' => array('TINT:3', 0),
					'module_order' => array('TINT:3', 0),
					'module_name' => array('VCHAR', ''),
					'module_image_src' => array('VCHAR', ''),
					'module_image_width' => array('INT:3', 0),
					'module_image_height' => array('INT:3', 0),
					'module_group_ids' => array('VCHAR', ''),
					'module_status' => array('TINT:1', 1),
				),

				'PRIMARY_KEY'	=> 'module_id',
			)),
			array(PORTAL_CONFIG_TABLE, array(
				'COLUMNS' => array(
					'config_name' => array('VCHAR:255', ''),
					'config_value'=> array('MTEXT', ''),
				),
				
				'PRIMARY_KEY'	=> 'config_name',
			)),
		),

		'config_add' => array(
			array('board3_enable', 1, 0),
			array('board3_left_column', 1, 0),
			array('board3_right_column', 1, 0),
			array('board3_version_check', 1, 0),
			array('board3_forum_index', 1, 0),
			array('board3_left_column_width', 180, 0),
			array('board3_right_column_width', 180, 0),
			array('board3_phpbb_menu', 0, 0),
			array('board3_display_jumpbox', 1, 0),
		),

		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_PORTAL'),

			array('acp', 'ACP_PORTAL', array(
				
					'module_basename'	=> 'portal',
					'module_langname'	=> 'ACP_PORTAL_GENERAL_INFO',
					'module_mode' 		=> 'config',
					'module_auth'		=> 'acl_a_manage_portal',
				),
			),
			
			array('acp', 'ACP_PORTAL', array(
					'module_basename'	=> 'portal',
					'module_langname'	=> 'ACP_PORTAL_MODULES',
					'module_mode'		=> 'modules',
					'module_auth'		=> 'acl_a_manage_portal',
				),
			),
			
			array('acp', 'ACP_PORTAL', array(
					'module_basename'	=> 'portal',
					'module_langname'	=> 'ACP_PORTAL_UPLOAD',
					'module_mode'		=> 'upload_module',
					'module_auth'		=> 'acl_a_manage_portal',
				),
			),
		),
		'custom'	=> array('board3_basic_install'),

	),

	'2.0.0b1' => array(
		// no changes
	),

	'2.0.0' => array(
		// no changes
	),
	
	'2.0.1' => array(
		// no changes ... purge caches anyways
		'cache_purge' => array(
			'imageset',
			'template',
			'theme',
			'',
		),
	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);
