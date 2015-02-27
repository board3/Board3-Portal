<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\includes;

class version_check
{
	/**
	* @var array version_data
	*/
	protected $version_data;

	/**
	* @var \phpbb\config\config
	*/
	protected $config;

	/**
	* @var \phpbb\version_helper $version_helper phpBB version helper
	*/
	protected $version_helper;

	/**
	* @var \phpbb\template\twig\twig
	*/
	protected $template;

	/**
	* @var \phpbb\user
	*/
	protected $user;

	/**
	 * @var string Current version
	 */
	protected $current_version;

	/**
	* Construct a version_check object
	*
	* @param array $version_data Version data
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\version_helper $version_helper phpBB version helper
	* @param \phpbb\template\twig\twig $template phpBB template object
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($version_data, $config, $version_helper, $template, $user)
	{
		$this->version_data = $version_data;
		$this->config = $config;
		$this->version_helper = $version_helper;
		$this->template = $template;
		$this->user = $user;
		$this->current_version = $this->config[str_replace(' ', '', $this->version_data['version'])];
	}

	/**
	* Check MOD version and assign template variables for version info if not
	* returning current version
	*
	* @param bool $return_version Yes if current version should be returned
	* @return string|bool Current version if $return_version is set to true, false if not
	*/
	public function check($return_version = false)
	{
		// Set file location
		$this->version_helper->set_file_location($this->version_data['file'][0], $this->version_data['file'][1], $this->version_data['file'][2]);
		// Set current version
		$this->version_helper->set_current_version($this->current_version);

		$this->version_helper->force_stability(($this->config['extension_force_unstable'] || !$this->version_helper->is_stable($this->current_version)) ? 'unstable' : null);

		// Expect version_helper to throw RuntimeExceptions
		try
		{
			$updates = $this->version_helper->get_suggested_updates(true);
		}
		catch (\RuntimeException $e)
		{
			return false;
		}

		// Return version if $return_version is set to true
		if ($return_version)
		{
			return $this->current_version;
		}

		$version_up_to_date = empty($updates);

		$template_data = array(
			'AUTHOR'			=> $this->version_data['author'],
			'CURRENT_VERSION'	=> $this->current_version,
			'UP_TO_DATE'		=> sprintf((!$version_up_to_date) ? $this->user->lang['NOT_UP_TO_DATE'] : $this->user->lang['UP_TO_DATE'], $this->version_data['title']),
			'S_UP_TO_DATE'		=> $version_up_to_date,
			'U_AUTHOR'			=> 'http://www.phpbb.com/community/memberlist.php?mode=viewprofile&un=' . $this->version_data['author'],
			'TITLE'				=> (string) $this->version_data['title'],
			'LATEST_VERSION'	=> $this->current_version,
		);

		$this->display_update_information($updates, $template_data);
		$this->template->assign_block_vars('mods', $template_data);

		return false;
	}

	/**
	 * Display update information if updates exist
	 *
	 * @param array $updates Updates data array
	 * @param array $template_data Template data array
	 */
	protected function display_update_information(&$updates, &$template_data)
	{
		if (!empty($updates))
		{
			$updates = array_shift($updates);
			$template_data = array_merge($template_data, array(
				'ANNOUNCEMENT'		=> (string) $updates['announcement'],
				'DOWNLOAD'			=> (string) $updates['download'],
				'LATEST_VERSION'	=> $updates['current'],
			));
		}
	}
}
