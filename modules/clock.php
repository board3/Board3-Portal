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
* @package Clock
*/
class clock extends module_base
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
	public $name = 'CLOCK';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_clock.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_clock_module';

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor for clock module
	 *
	 * @param \phpbb\config\config $config phpBB config
	 * @param \phpbb\template\template $template phpBB template
	 */
	public function __construct($config, $template)
	{
		$this->config = $config;
		$this->template = $template;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		if (isset($this->config['board3_clock_src_' . $module_id]) && !empty($this->config['board3_clock_src_' . $module_id]))
		{
			$this->template->assign_var('B3P_CLOCK_SRC', $this->config['board3_clock_src_' . $module_id]);
		}
		return 'clock_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_CLOCK_SETTINGS',
			'vars'	=> array(
				'legend1'	=> 'ACP_PORTAL_CLOCK_SETTINGS',
				'board3_clock_src_' . $module_id	=> array('lang' => 'ACP_PORTAL_CLOCK_SRC', 'validate' => 'string', 'type' => 'text:50:200', 'explain' => true, 'submit_type' => 'custom', 'submit' => 'check_file_src'),
			),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function install($module_id)
	{
		$this->config->set('board3_clock_src_' . $module_id, '');
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function uninstall($module_id, $db)
	{
		$this->config->delete('board3_clock_src_' . $module_id);
		return true;
	}
}
