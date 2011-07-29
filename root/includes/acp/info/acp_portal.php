<?php
/**
*
* @package Board3 Portal v2
* @copyright (c) Board3 Group ( www.board3.de )
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
	public function module()
	{
		return array(
			'filename'	=> 'acp_portal',
			'title'		=> 'ACP_PORTAL',
			'version'	=> '2.0.0b2',
			'modes'		=> array(
				'config'		=> array('title' => 'ACP_PORTAL_GENERAL_INFO',	'auth' => 'acl_a_manage_portal', 'cat' => array('ACP_PORTAL')),
				'modules'		=> array('title' => 'ACP_PORTAL_MODULES',	'auth' => 'acl_a_manage_portal', 'cat' => array('ACP_PORTAL')),
				'upload_module'		=> array('title' => 'ACP_PORTAL_UPLOAD',	'auth' => 'acl_a_manage_portal', 'cat' => array('ACP_PORTAL')),
			),
		);
	}
}
