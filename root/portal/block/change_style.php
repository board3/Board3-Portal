<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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

$lang = request_var('lang', '', false, true);

if (file_exists($phpbb_root_path . 'language/' . $lang . "/common.$phpEx"))
{
	$this->lang_name = $lang;
	$this->lang_path = $phpbb_root_path . 'language/' . $this->lang_name . '/';

	$cookie_expire = $this->time_now + (($config['max_autologin_time']) ? 86400 * (int) $config['max_autologin_time'] : 31536000);
	$this->set_cookie('lang', $lang, $cookie_expire);
	unset($cookie_expire);
}

$requested_style = request_var('style', 0, false, true);

if ($requested_style && (!$config['override_user_style'] || $auth->acl_get('a_styles')))
{
	$style = $requested_style;

	$cookie_expire = $this->time_now + (($config['max_autologin_time']) ? 86400 * (int) $config['max_autologin_time'] : 31536000);
	$this->set_cookie('style', $style, $cookie_expire);
	unset($cookie_expire);
}

$all = false;
$default = '';

$sql_where = (!$all) ? 'WHERE style_active = 1 ' : '';
$sql = 'SELECT style_id, style_name, style_copyright
	FROM ' . STYLES_TABLE . "
	$sql_where
	ORDER BY style_name";
$result = $db->sql_query($sql);

$style_options = '';
while ($row = $db->sql_fetchrow($result))
{
	$selected = ($row['style_id'] == $default) ? ' selected="selected"' : '';
	$style_options .= '<option value="' . $row['style_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';

	$template->assign_block_vars('styles', array(
		'STYLE_ID' 		=> $row['style_id'],
		'STYLE_NAME' 	=> $row['style_name'],
		'STYLE_COPY' 	=> $row['style_copyright'],
		'U_STYLE' 		=> append_sid("{$phpbb_root_path}portal.$phpEx", 'style=' . $row['style_id']),
	));
}
$db->sql_freeresult($result);

// Assign specific vars
$template->assign_vars(array(
	'S_STYLE_OPTIONS'		=> ($config['override_user_style']) ? '' : style_select($data['style']),
	'S_DISPLAY_CHANGE_STYLE'	=> true,
));

?>