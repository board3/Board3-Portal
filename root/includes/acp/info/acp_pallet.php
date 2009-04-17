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

/**
* @package module_install
*/
class acp_pallet_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_pallet',
			'title'		=> 'ACP_PALLET_INFO',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'list'		=> array('title' => 'ACP_PALLET_LIST_INFO',		'auth' => 'acl_a_board',	'cat' => array('ACP_BOARD_CONFIGURATION')),
				'layout'	=> array('title' => 'ACP_PORTAL_LAYOUT_INFO',	'auth' => 'acl_a_board',	'cat' => array('ACP_BOARD_CONFIGURATION')),
			),
		);
	}
}

?>