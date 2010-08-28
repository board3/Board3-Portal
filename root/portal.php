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
define('IN_PHPBB', true);
define('IN_PORTAL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$portal_root_path = PORTAL_ROOT_PATH;
$portal_icons_path = PORTAL_ICONS_PATH;
include($phpbb_root_path . $portal_root_path . 'includes/functions_modules.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
//include($phpbb_root_path . 'includes/message_parser.' . $phpEx);


// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/portal');

if (!$config['board3_enable'])
{
	redirect(reapply_sid($phpbb_root_path . 'index.' . $phpEx));
}

$sql = 'SELECT *
	FROM ' . PORTAL_MODULES_TABLE . '
	ORDER BY module_order ASC';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
	$class_name = 'portal_' . $row['module_classname'] . '_module';
	if (!class_exists($class_name))
	{
		include("{$phpbb_root_path}{$portal_root_path}modules/portal_{$row['module_classname']}.$phpEx");
	}
	if (!class_exists($class_name))
	{
		trigger_error(sprintf($user->lang['CLASS_NOT_FOUND'], $class_name, 'portal_' . $row['module_classname']), E_USER_ERROR);
	}


	$module = new $class_name();
	if ($module->language)
	{
		$user->add_lang('mods/portal/' . $module->language);
	}
	if ($row['module_column'] == 1)
	{
		$template_module = $module->get_template_side($row['module_id']);
		$template_column = 'left';
	}
	if ($row['module_column'] == 2)
	{
		$template_module = $module->get_template_center($row['module_id']);
		$template_column = 'center';
	}
	if ($row['module_column'] == 3)
	{
		$template_module = $module->get_template_side($row['module_id']);
		$template_column = 'right';
	}
	if ($row['module_column'] == 4)
	{
		$template_module = $module->get_template_center($row['module_id']);
	}
	if ($row['module_column'] == 5)
	{
		$template_module = $module->get_template_center($row['module_id']);
	}
	if (!$template_module)
	{
		continue;
	}

	$template->assign_block_vars('modules_' . column_num_string($row['module_column']), array(
		'TEMPLATE_FILE'		=> 'portal/modules/' . $template_module,
		'IMAGE_SRC'			=> $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/portal/' . $row['module_image_src'],
	));
	unset($template_module);
}
$db->sql_freeresult($result);

// Assign specific vars
$template->assign_vars(array(
	'S_SMALL_BLOCK'			=> true,
	'S_PORTAL_LEFT_COLUMN'	=> 250,
	'S_PORTAL_RIGHT_COLUMN'	=> 250,
));

// Output page
page_header($user->lang['PORTAL']);

$template->set_filenames(array(
	'body' => 'portal/portal_body.html')
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum . $phpEx"));

page_footer();

?>