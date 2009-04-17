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

if (!isset($template->filename['clock_block']))
{
	$template->set_filenames(array(
		'clock_block'	=> 'portal/block/clock.html')
	);
}

$block_temp = $template->assign_display('clock_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );
?>