<?php

/**
*
* @package - Board3portal
* @version $Id: search.php 523 2009-08-27 21:41:08Z christian_n $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$template->assign_vars(array(
	'S_DISPLAY_PORTALSEARCH' => true,
	'S_SEARCH_ACTION'	=> append_sid("{$phpbb_root_path}search.$phpEx"),
));

?>