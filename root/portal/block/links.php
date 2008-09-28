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

$links = ( strlen($portal_config['portal_links_array']) > 0 ) ? unserialize($portal_config['portal_links_array']) : array();

ksort( $links );
reset( $links );

foreach( $links as $link_id => $link_data )
{
	$template->assign_block_vars('link', array(
		'URL' => $link_data['url'],
		'TEXT' => $link_data['text'],
	));
}

if (!isset($template->filename['links_block']))
{
	$template->set_filenames(array(
		'links_block'	=> 'portal/block/links.html')
	);
}

$block_temp = $template->assign_display('links_block');

$template->assign_block_vars('portal_column_'.$block_pos, array(
	'BLOCK_DATA'	=> $block_temp)
);
unset( $block_temp );

?>