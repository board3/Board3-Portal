<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \board3\portal\controller\main */
	protected $board3_controller;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor of Board3 Portal event listener
	*
	* @param \board3\portal\controller\main $board3_controller Board3 Portal controller
	* @param \phpbb\auth\auth		$auth	phpBB auth object
	* @param \phpbb\config\config		$config phpBB config
	* @param \phpbb\controller\helper	$controller_helper	Controller helper object
	* @param \phpbb\path_helper		$path_helper		phpBB path helper
	* @param \phpbb\template\template	$template		Template object
	* @param \phpbb\user			$user			User object
	* @param string				$php_ext		phpEx
	*/
	public function __construct(\board3\portal\controller\main $board3_controller, \phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $controller_helper, \phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->board3_controller = $board3_controller;
		$this->auth = $auth;
		$this->config = $config;
		$this->controller_helper = $controller_helper;
		$this->path_helper = $path_helper;
		$this->template = $template;
		$this->user = $user;
		$this->php_ext = $php_ext;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'			=> 'load_portal_language',
			'core.viewonline_overwrite_location'	=> 'viewonline_page',
			'core.page_header'			=> 'add_portal_link',
		);
	}

	/**
	* Load portal language during user setup
	*
	* @param object $event The event object
	* @return null
	*/
	public function load_portal_language($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'board3/portal',
			'lang_set' => 'portal',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Show users as viewing the portals on Who Is Online page
	*
	* @param object $event The event object
	* @return null
	*/
	public function viewonline_page($event)
	{
		if ($event['on_page'][1] == 'app' && strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/portal') === 0)
		{
			$event['location'] = $this->user->lang('VIEWING_PORTAL');
			$event['location_url'] = $this->controller_helper->route('board3_portal_controller');
		}
	}

	/**
	* Add portal link if user is authed to see it
	*
	* @return null
	*/
	public function add_portal_link()
	{
		if (!$this->has_portal_access())
		{
			return;
		}

		if (strpos($this->controller_helper->get_current_url(), '/portal') === false)
		{
			$portal_link = $this->controller_helper->route('board3_portal_controller');
			$this->check_portal_all();
		}
		else
		{
			$portal_link = $this->path_helper->remove_web_root_path($this->controller_helper->route('board3_portal_controller'));
		}

		$this->template->assign_vars(array(
			'U_PORTAL'	=> $portal_link,
		));
	}

	/**
	 * Check if user should be able to access portal
	 *
	 * @return bool True of user should be able to access it, false if not
	 */
	protected function has_portal_access()
	{
		return $this->auth->acl_get('u_view_portal') && $this->config['board3_enable'];
	}

	/**
	 * Check if portal on all pages should be shown and display it accordignly
	 */
	protected function check_portal_all()
	{
		// Check if we should show the portal
		if (isset($this->config['board3_show_all_pages']) && $this->config['board3_show_all_pages'] && !$this->board_disabled())
		{
			$this->display_portal();
		}
	}

	/**
	 * Display portal on all pages
	 */
	protected function display_portal()
	{
		$this->board3_controller->handle(array(
			'left'	=> $this->config['board3_show_all_side'] == false,
			'right'	=> $this->config['board3_show_all_side'] == true,
		));
	}

	/**
	 * Check whether the board has been disabled and should not be shown
	 *
	 * @return bool True if board has been disabled, false if not
	 */
	protected function board_disabled()
	{
		return $this->config['board_disable'] && !defined('SKIP_CHECK_DISABLED') && !$this->auth->acl_gets('a_', 'm_') && !$this->auth->acl_getf_global('m_');
	}
}
