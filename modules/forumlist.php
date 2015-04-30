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
* @package Forumlist
*/
class forumlist extends module_base
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 21;

	/**
	* Default modulename
	*/
	public $name = 'PORTAL_FORUMLIST';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_forumlist_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = '';

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template */
	protected $template;

	/** @var string PHP file extension */
	protected $php_ext;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a forumlist object
	*
	* @param \phpbb\auth\auth $auth phpBB auth service
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\template $template phpBB template
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($auth, $config, $template, $phpbb_root_path, $phpEx, $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		if (!function_exists('display_forums'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
		\display_forums('', $this->config['load_moderators'], false);

		$this->template->assign_vars(array(
			'FORUM_IMG'			=> $this->user->img('forum_read', 'NO_NEW_POSTS'),
			'FORUM_NEW_IMG'			=> $this->user->img('forum_unread', 'NEW_POSTS'),
			'FORUM_LOCKED_IMG'		=> $this->user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
			'FORUM_NEW_LOCKED_IMG'		=> $this->user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),
			'U_MARK_FORUMS'			=> ($this->user->data['is_registered'] || $this->config['load_anon_lastread']) ? append_sid("{$this->phpbb_root_path}index.{$this->php_ext}", 'hash=' . generate_link_hash('global') . '&amp;mark=forums') : '',
			'U_MCP'				=> ($this->auth->acl_get('m_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}mcp.{$this->php_ext}", 'i=main&amp;mode=front', true, $this->user->session_id) : '',
		));

		return 'forumlist.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'PORTAL_FORUMLIST',
			'vars'	=> array(),
		);
	}
}
