<?php

/**
*
* @package - Board3portal
* @version $Id: links.php 668 2010-08-19 21:16:29Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$links = (strlen($portal_config['portal_links_array']) > 0) ? unserialize($portal_config['portal_links_array']) : array();

ksort($links);
reset($links);

foreach($links as $link_id => $link_data)
{
	$template->assign_block_vars('link', array(
		'URL' => portal_validate_url($link_data['url']),
		'TEXT' => $link_data['text'],
	));
}

$template->assign_var('S_DISPLAY_LINKS', true);

?>