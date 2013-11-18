<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\includes;

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class mod_version_check
{
	/**
	* @var version_data
	*/
	protected $version_data;

	/**
	* @var \phpbb\config\config
	*/
	protected $config;

	/**
	* @var phpbb_root_path
	*/
	protected $phpbb_root_path;

	/**
	* @var phpEx
	*/
	protected $php_ext;

	/**
	* @var \phpbb\template\twig\twig
	*/
	protected $template;

	/**
	* @var \phpbb\user
	*/
	protected $user;

	/**
	* Construct a mod_version_check object
	*
	* @param array $version_data Version data
	* @param \phpbb\config\config $config phpBB config
	* @param string $phpbb_root_path phpBB root path
	* @param string $php_ext PHP file extension
	* @param \phpbb\template\twig\twig $template phpBB template object
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($version_data, $config, $phpbb_root_path, $php_ext, $template, $user)
	{
		$this->version_data = $version_data;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Check MOD version
	*
	* @param bool $return_version Yes if current version should be returned
	* @return string Current version if $return_version is set to true
	*/
	public function version_check($return_version = false)
	{
		if (!function_exists('get_remote_file'))
		{
			include($this->phpbb_root_path . 'includes/functions_admin.' . $this->php_ext);
		}

		$var = $this->version_data;

		// Get current and latest version
		$errstr = '';
		$errno = 0;

		if (!$return_version)
		{
			$mod_version = $this->user->lang['NO_INFO'];
			$data = array(
				'title'			=> $var['title'],
				'description'	=> $this->user->lang['NO_INFO'],
				'download'		=> $this->user->lang['NO_INFO'],
				'announcement'	=> $this->user->lang['NO_INFO'],
			);
		}
		$file = get_remote_file($var['file'][0], '/' . $var['file'][1], $var['file'][2], $errstr, $errno);

		if ($file)
		{
			// let's not stop the page from loading if a mod author messed up their mod check file
			// also take care of one of the easiest ways to mess up an xml file: "&"
			$mod = @simplexml_load_string(str_replace('&', '&amp;', $file));
			if (isset($mod->$var['tag']))
			{
				$row = $mod->$var['tag'];
				$mod_version = $row->mod_version->major . '.' . $row->mod_version->minor . '.' . $row->mod_version->revision . $row->mod_version->release;

				$data = array(
					'title'			=> $row->title,
					'description'	=> $row->description,
					'download'		=> $row->download,
					'announcement'	=> $row->announcement,
				);
			}
		}

		// remove spaces from the version in the mod file stored locally
		$version = $this->config[str_replace(' ', '', $var['version'])];
		if ($return_version)
		{
			return $version;
		}

		$version_compare = (version_compare($version, $mod_version, '<')) ? false : true;

		$this->template->assign_block_vars('mods', array(
			'ANNOUNCEMENT'		=> (string) $data['announcement'],
			'AUTHOR'			=> $var['author'],
			'CURRENT_VERSION'	=> $version,
			'DESCRIPTION'		=> (string) $data['description'],
			'DOWNLOAD'			=> (string) $data['download'],
			'LATEST_VERSION'	=> $mod_version,
			'TITLE'				=> (string) $data['title'],

			'UP_TO_DATE'		=> sprintf((!$version_compare) ? $this->user->lang['NOT_UP_TO_DATE'] : $this->user->lang['UP_TO_DATE'], $data['title']),

			'S_UP_TO_DATE'		=> $version_compare,

			'U_AUTHOR'			=> 'http://www.phpbb.com/community/memberlist.php?mode=viewprofile&un=' . $var['author'],
		));
	}
}
