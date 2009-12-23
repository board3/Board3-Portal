<?php
/**
* @package Portal
* @version $Id$
* @copyright (c) 2009, 2010 Board3 Portal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
			'title'		=> 'ACP_PORTAL',
			'version'	=> '1.2.0',
			'modes'		=> array(
				'config'	=> array('title' => 'ACP_PORTAL_GENERAL_INFO',	'auth' => 'acl_a_portal', 'cat' => array('ACP_PORTAL')),
				'modules'	=> array('title' => 'ACP_PORTAL_MODULES',	'auth' => 'acl_a_portal', 'cat' => array('ACP_PORTAL')),
			),
		);
	}
}

?>