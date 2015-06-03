<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\acp;

/**
* @package module_install
*/
class portal_info
{
	public function module()
	{
		return array(
			'filename'	=> '\board3\portal\acp\portal_module',
			'title'		=> 'ACP_PORTAL',
			'version'	=> '2.1.0',
			'modes'		=> array(
				'config'		=> array('title' => 'ACP_PORTAL_GENERAL_INFO',	'auth' => 'ext_board3/portal && acl_a_manage_portal', 'cat' => array('ACP_PORTAL')),
				'modules'		=> array('title' => 'ACP_PORTAL_MODULES',	'auth' => 'ext_board3/portal && acl_a_manage_portal', 'cat' => array('ACP_PORTAL')),
			),
		);
	}
}
