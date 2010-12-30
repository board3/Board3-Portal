<?php

/**
*
* @package - Board3portal
* @version $Id: acp_portal.php 504 2009-04-20 21:44:16Z Christian_N $
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
class acp_portal_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_portal',
			'title'		=> 'ACP_PORTAL_INFO',
			'version'	=> '1.0.2',
			'modes'		=> array(
				'general'		=> array('title' => 'ACP_PORTAL_GENERAL_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'news'			=> array('title' => 'ACP_PORTAL_NEWS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'announcements'	=> array('title' => 'ACP_PORTAL_ANNOUNCEMENTS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'welcome'		=> array('title' => 'ACP_PORTAL_WELCOME_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'recent'		=> array('title' => 'ACP_PORTAL_RECENT_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'wordgraph'		=> array('title' => 'ACP_PORTAL_WORDGRAPH_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'paypal'		=> array('title' => 'ACP_PORTAL_PAYPAL_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'attachments'	=> array('title' => 'ACP_PORTAL_ATTACHMENTS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'members'		=> array('title' => 'ACP_PORTAL_MEMBERS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'polls'			=> array('title' => 'ACP_PORTAL_POLLS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'bots'			=> array('title' => 'ACP_PORTAL_BOTS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'poster'		=> array('title' => 'ACP_PORTAL_POSTER_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'customblock'	=> array('title' => 'ACP_PORTAL_CUSTOMBLOCK_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'minicalendar'	=> array('title' => 'ACP_PORTAL_MINICALENDAR_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'friends'		=> array('title' => 'ACP_PORTAL_FRIENDS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'birthdays'		=> array('title' => 'ACP_PORTAL_BIRTHDAYS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
				'links'			=> array('title' => 'ACP_PORTAL_LINKS_INFO', 'auth' => 'acl_a_portal_manage', 'cat' => array('ACP_PORTAL_INFO')),
			),
		);
	}
}

?>