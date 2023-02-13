<?php
/**
*
* @package Board3 Portal v2.3
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace board3\portal\modules;

/**
* @package Link Us
*/
class link_us extends module_base
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

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a link us object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($config, $template, $user)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		//doing the easy way ;)
		$u_link = generate_board_url();

		// Assign specific vars
		$this->template->assign_vars(array(
			'LINK_US_TXT'		=> sprintf($this->user->lang['LINK_US_TXT'], $this->config['sitename']),
			'U_LINK_US_HTML'	=> '&lt;a&nbsp;href=&quot;' . $u_link . '&quot;&nbsp;' . (($this->config['sitename']) ? 'title=&quot;' . $this->config['sitename'] . '&quot;' : '' ) . '&gt;' . (($this->config['sitename']) ? $this->config['sitename'] : $u_link ) . '&lt;/a&gt;',
			'U_LINK_US_BB'		=> '[url=' . $u_link . ']' . (($this->config['sitename']) ? $this->config['sitename'] : $u_link ) . '[/url]',
		));

		return 'link_us_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'LINK_US',
			'vars'	=> array(),
		);
	}
}
