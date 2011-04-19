<?php
/**
*
* @package Board3 Portal v2 - Link us
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package Clock
*/
class portal_link_us_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 10;

	/**
	* Default modulename
	*/
	public $name = 'LINK_US';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_link_us.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_link_us_module';

	public function get_template_side($module_id)
	{
		global $config, $template, $user;

		//doing the easy way ;)
		$u_link = generate_board_url();

		// Assign specific vars
		$template->assign_vars(array(
			'LINK_US_TXT'		=> sprintf($user->lang['LINK_US_TXT'], $config['sitename']),
			'U_LINK_US'			=> '&lt;a&nbsp;href=&quot;' . $u_link . '&quot;&nbsp;' . (($config['site_desc']) ? 'title=&quot;' . $config['site_desc'] . '&quot;' : '' ) . '&gt;' . (($config['sitename']) ? $config['sitename'] : $u_link ) . '&lt;/a&gt;',
		));

		return 'link_us_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'LINK_US',
			'vars'	=> array(),
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		return true;
	}

	public function uninstall($module_id)
	{
		return true;
	}
}
