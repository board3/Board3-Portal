<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
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
	function version()
	{
		global $portal_config, $phpbb_root_path, $phpEx;
		if (!function_exists('obtain_portal_config'))
		{
			include($phpbb_root_path . 'portal/includes/functions.' . $phpEx);
		}
		$portal_config = obtain_portal_config();

		return array(
			'author'	=> 'Saint_hh',
			'title'		=> 'Board3 Portal',
			'tag'		=> 'board3_portal_v2',
			'version'	=> $portal_config['portal_version'],
			'file'		=> array('board3.de', 'updatecheck', 'board3_portal.xml'),
		);
	}
}

?>