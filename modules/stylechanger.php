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
* @package Stylechanger
*/
class stylechanger extends module_base
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
	public $name = 'BOARD_STYLE';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_style.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_stylechanger_module';

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\db\driver */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var php file extension */
	protected $php_ext;

	/** @var phpbb root path */
	protected $phpbb_root_path;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a stylechanger object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\db\driver $db Database driver
	* @param \phpbb\request\request $request phpBB request
	* @param string $phpEx php file extension
	* @param string $phpbb_root_path phpBB root path
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($config, $template, $db, $request, $phpEx, $phpbb_root_path, $user)
	{
		$this->config = $config;
		$this->template = $template;
		$this->db = $db;
		$this->request = $request;
		$this->php_ext = $phpEx;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->user = $user;
	}

	/**
	* @inheritdoc
	*/
	public function get_template_side($module_id)
	{
		$style_count = 0;
		$style_select = '';
		$sql = 'SELECT style_id, style_name
			FROM ' . STYLES_TABLE . '
			WHERE style_active = 1
			ORDER BY LOWER(style_name) ASC';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$style = $this->request->variable('style', 0);
			if (!empty($style))
			{
				$url = str_replace('style=' . $style, 'style=' . $row['style_id'], append_sid("{$this->phpbb_root_path}app.{$this->php_ext}/portal"));
			}
			else
			{
				$url = append_sid("{$this->phpbb_root_path}app.{$this->php_ext}/portal", 'style=' . $row['style_id']);
			}
			++$style_count;
			$style_select .= '<option value="' . $url . '"' . ($row['style_id'] == $this->user->style['style_id'] ? ' selected="selected"' : '') . '>' . htmlspecialchars($row['style_name']) . '</option>';
		}
		$this->db->sql_freeresult($result);
		if(strlen($style_select))
		{
			$this->template->assign_var('STYLE_SELECT', $style_select);
		}

		// Assign specific vars
		$this->template->assign_vars(array(
			'S_STYLE_OPTIONS'			=> ($this->config['override_user_style'] || $style_count < 2) ? '' : style_select($this->user->data['user_style']),
		));

		return 'stylechanger_side.html';
	}

	/**
	* @inheritdoc
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'BOARD_STYLE',
			'vars'	=> array(),
		);
	}
}
