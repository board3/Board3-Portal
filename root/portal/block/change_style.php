<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

$style = request_var('style', 0);
	
$sql = 'SELECT style_id, style_name, style_copyright
	FROM ' . STYLES_TABLE . '
	WHERE style_active = 1 
	ORDER BY style_name ASC';

$result = $db->sql_query($sql);
$style_select = '<option selected="selected" disabled="disabled">' . $user->lang['STYLE_CHOOSE'] . '</option>';
while ($row = $db->sql_fetchrow($result))
{
	$selected = ( $style == $row['style_id'] ) ? ' selected="selected"' : '';
	$style_value = append_sid("{$phpbb_root_path}portal.$phpEx", 'style=' . $row['style_id']);
	$style_select .= '<option value="' . $style_value . '"' . $selected . '>&nbsp; ' . $row['style_name'] . ' &nbsp;</option>';
}
$db->sql_freeresult($result);

// style info
$sql2 = 'SELECT style_id, style_name, style_copyright
	FROM ' . STYLES_TABLE . '
	WHERE style_active = 1
		AND style_id = ' . $style;

$result = $db->sql_query($sql2);
$row = $db->sql_fetchrow($result);

$template->assign_vars(array(
	'S_STYLE_ACTION'=> append_sid("{$phpbb_root_path}portal.$phpEx"),
	'STYLE_NAME' 	=> $row['style_name'],
	'STYLE_COPY' 	=> $row['style_copyright'],
	'STYLE_SELECT' 	=> $style_select,
));

$db->sql_freeresult($result);

// Assign specific vars
$template->assign_vars(array(
	'S_STYLE_OPTIONS'			=> ($config['override_user_style']) ? '' : style_select($user->data['user_style']),
));

if (!isset($template->filename['change_style_block']))
{
	$template->set_filenames(array(
		'change_style_block'	=> 'portal/block/change_style.html')
	);
}

$block_temp = $template->assign_display('change_style_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );
?>