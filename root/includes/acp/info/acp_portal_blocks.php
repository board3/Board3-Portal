<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
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
class acp_portal_blocks_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_portal_blocks',
			'title'		=> 'ACP_PORTAL_BLOCKS',
			'version'	=> '2.0.0',
			'modes'		=> array(
				'blocks'	=> array('title' => 'ACP_PORTAL_MANAGE_BLOCKS', 'auth' => 'acl_a_portal', 'cat' => array('ACP_PORTAL')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>