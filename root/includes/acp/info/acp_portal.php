<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_portal_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_portal',
			'title'		=> 'ACP_PORTAL_INFO',
			'version'	=> '0.1.0',
			'modes'		=> array(
				'general'		=> array('title' => 'ACP_PORTAL_GENERAL_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'news'			=> array('title' => 'ACP_PORTAL_NEWS_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'announcements'	=> array('title' => 'ACP_PORTAL_ANNOUNCE_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'welcome'		=> array('title' => 'ACP_PORTAL_WELCOME_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'recent'		=> array('title' => 'ACP_PORTAL_RECENT_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'wordgraph'		=> array('title' => 'ACP_PORTAL_WORDGRAPH_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'paypal'		=> array('title' => 'ACP_PORTAL_PAYPAL_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'attachments'	=> array('title' => 'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'members'		=> array('title' => 'ACP_PORTAL_MEMBERS_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'polls'			=> array('title' => 'ACP_PORTAL_POLLS_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'bots'			=> array('title' => 'ACP_PORTAL_BOTS_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'poster'		=> array('title' => 'ACP_PORTAL_MOST_POSTER_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				//'ads'			=> array('title' => 'ACP_PORTAL_ADS_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
				'minicalendar'	=> array('title' => 'ACP_PORTAL_MINICALENDAR_INFO', 'auth' => 'acl_a_board', 'cat' => array('ACP_BOARD_CONFIGURATION')),
			),
		);
	}
}

?>