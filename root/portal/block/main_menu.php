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

$template->assign_vars(array(
	'U_M_BBCODE'   => append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode'),
	'U_M_TERMS'      => append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=terms'),
	'U_M_PRV'      => append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=privacy'),
));

if (!isset($template->filename['main_menu_block']))
{
	$template->set_filenames(array(
		'main_menu_block'	=> 'portal/block/main_menu.html')
	);
}

$block_temp = $template->assign_display('main_menu_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );

?>