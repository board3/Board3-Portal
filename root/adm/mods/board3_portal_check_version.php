<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2007 StarTrekGuide
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
			'tag'		=> 'b3p_v1_modcheck',
			'version'	=> $portal_config['portal_version'],
			'file'		=> array('phpbb-projekt.de', 'updatecheck', 'b3p.xml'),
		);
	}
}

?>