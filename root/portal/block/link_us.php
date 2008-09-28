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

//doing the easy way ;)
$u_link = $config['server_protocol'] . $config['server_name'] . $config['script_path'];

// Assign specific vars
$template->assign_vars(array(
	'LINK_US_TXT'		=> sprintf($user->lang['LINK_US_TXT'], $config['sitename']),
	'U_LINK_US'			=> '&lt;a&nbsp;href=&quot;' . $u_link . '&quot;&nbsp;' . (($config['site_desc']) ? 'title=&quot;' . $config['site_desc'] . '&quot;' : '' ) . '&gt;' . (($config['sitename']) ? $config['sitename'] : $u_link ) . '&lt;/a&gt;',
));

if (!isset($template->filename['link_us_block']))
{
	$template->set_filenames(array(
		'link_us_block'	=> 'portal/block/link_us.html')
	);
}

$block_temp = $template->assign_display('link_us_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );

?>