<?php
/**
*
* @package Board3 Portal v2
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package mod_version_check
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class board3_portal_check_version
{
	public function version()
	{
		global $config, $phpbb_root_path, $phpEx;

		return array(
			'author'	=> 'Saint_hh',
			'title'		=> 'Board3 Portal',
			'tag'		=> 'board3_portal_v2_dev',
			'version'	=> $config['board3_portal_version'],
			'file'		=> array('board3.de', 'updatecheck', 'board3_portal.xml'),
		);
	}
}
