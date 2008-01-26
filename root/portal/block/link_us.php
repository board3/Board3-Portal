<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
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

//doing the easy way ;)
$u_link = $config['server_protocol'] . $config['server_name'] . $config['script_path'];

// Assign specific vars
$template->assign_vars(array(
	'S_DISPLAY_LINK_US' => true,
	'LINK_US_TXT'		=> sprintf($user->lang['LINK_US_TXT'], $config['sitename']),
	'U_LINK_US'			=> '&lt;a&nbsp;href=&quot;' . $u_link . '&quot;&nbsp;' . (($config['site_desc']) ? 'title=&quot;' . $config['site_desc'] . '&quot;' : '' ) . '&gt;' . (($config['sitename']) ? $config['sitename'] : $u_link ) . '&lt;/a&gt;',
));

?>