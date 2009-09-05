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

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$styles = '';
$sql = 'SELECT style_id, style_name
	FROM ' . STYLES_TABLE . '
	WHERE style_active = 1
	ORDER BY style_name ASC';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
	if(defined('SID_STYLE'))
	{
		$url = str_replace('style=' . SID_STYLE, 'style=' . $row['style_id'], append_sid("{$phpbb_root_path}portal.$phpEx"));
	}
	else
	{
		$url = append_sid("{$phpbb_root_path}portal.$phpEx", 'style=' . $row['style_id']);
	}
	$styles .= '<option value="' . $url . '"' . ($row['style_id'] == $user->theme['style_id'] ? ' selected="selected"' : '') . '>' . htmlspecialchars($row['style_name']) . '</option>';
}
$db->sql_freeresult($result);
if(strlen($styles))
{
	$template->assign_var('STYLE_SELECT', $styles);
}


// Assign specific vars
$template->assign_vars(array(
	'S_STYLE_OPTIONS'			=> ($config['override_user_style']) ? '' : style_select($user->data['user_style']),
	'S_DISPLAY_CHANGE_STYLE'	=> true,
));

?>