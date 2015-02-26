<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package Search
*/
class search extends module_base
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
	public $name = 'PORTAL_SEARCH';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_search.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_search_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = '';

	/** @var \phpbb\template */
	protected $template;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string PHP file extension */
	protected $php_ext;

	/**
	* Construct a search object
	*
	* @param \phpbb\template $template phpBB template
	* @param string $phpbb_root_path phpbb root path
	* @param string $php_ext php file extension
	*/
	public function __construct($template, $phpbb_root_path, $php_ext)
	{
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		return 'search_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'PORTAL_SEARCH',
			'vars'	=> array(),
		);
	}
}
