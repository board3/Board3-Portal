<?php
/**
*
* @package - Board3portal
* @version $Id: index.php 661 2010-07-11 12:34:49Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @installer based on: phpBB Gallery by nickvergessen, www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* borrowed from phpBB3
* @author: phpBB Group
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
define('IN_INSTALL', true);

define('NEWEST_B3P_VERSION', '1.0.6');

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('install', 'mods/install_portal'));

if (!defined('PORTAL_CONFIG_TABLE'))
{
	trigger_error('MISSING_CONSTANTS');
}

//need some module-names
$user->add_lang(array('acp/modules', 'acp/common', 'mods/info_acp_portal'));

$template->set_custom_template('../adm/style', 'admin');
$template->assign_var('T_TEMPLATE_PATH', '../adm/style');

$mode = request_var('mode', 'overview');
$sub = request_var('sub', '');

// the acp template is never stored in the database
$user->theme['template_storedb'] = false;

$install = new module();

$install->create('install', "index.$phpEx", $mode, $sub);
$install->load();

// Generate the page
$install->page_header();
$install->generate_navigation();

$template->set_filenames(array(
	'body' => $install->get_tpl_name())
);

$install->page_footer();

/**
* @package install
*/
class module
{
	var $id = 0;
	var $type = 'install';
	var $module_ary = array();
	var $filename;
	var $module_url = '';
	var $tpl_name = '';
	var $mode;
	var $sub;
	var $installed_version = false;
	var $installed_p3p_version = false;
	var $acp_parent_module = false;

	/**
	* Private methods, should not be overwritten
	*/
	function create($module_type, $module_url, $selected_mod = false, $selected_submod = false)
	{
		global $db, $config, $phpEx, $phpbb_root_path;

		/**
		* Get tables of a database
		*/
		function get_tables($db)
		{
			switch ($db->sql_layer)
			{
				case 'mysql':
				case 'mysql4':
				case 'mysqli':
					$sql = 'SHOW TABLES';
				break;

				case 'sqlite':
					$sql = 'SELECT name
						FROM sqlite_master
						WHERE type = "table"';
				break;

				case 'mssql':
				case 'mssql_odbc':
					$sql = "SELECT name
						FROM sysobjects
						WHERE type='U'";
				break;

				case 'postgres':
					$sql = 'SELECT relname
						FROM pg_stat_user_tables';
				break;

				case 'firebird':
					$sql = 'SELECT rdb$relation_name
						FROM rdb$relations
						WHERE rdb$view_source is null
							AND rdb$system_flag = 0';
				break;

				case 'oracle':
					$sql = 'SELECT table_name
						FROM USER_TABLES';
				break;
			}
			$result = $db->sql_query($sql);

			$tables = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$tables[] = current($row);
			}
			$db->sql_freeresult($result);

			return $tables;
		}	
		// Check if the board3 Portal is already installed and acp_parent_module is already exists
		$tables = get_tables($db);
		if (in_array(PORTAL_CONFIG_TABLE, $tables))
		{
			$sql = 'SELECT *
				FROM ' . PORTAL_CONFIG_TABLE;
			$result = $db->sql_query($sql);
			
			while ($row = $db->sql_fetchrow($result))
			{
				if ($row['config_name'] == 'portal_version')
				{
					$this->installed_version = $row['config_value'];
				}
				if ($row['config_name'] == 'acp_parent_module')
				{
					$this->acp_parent_module = $row['config_value'];
				}
			}
			$db->sql_freeresult($result);
		}
		if (in_array(CONFIG_TABLE, $tables))
		{
			$p3p_sql = 'SELECT *
				FROM ' . CONFIG_TABLE;
			$p3p_result = $db->sql_query($p3p_sql);

			while ($p3p_row = $db->sql_fetchrow($p3p_result))
			{
				if ($p3p_row['config_name'] == 'portal_version')
				{
					$this->installed_p3p_version = $p3p_row['config_value'];
				}
			}
			$db->sql_freeresult($p3p_result);
		}
		unset($tables);	

		$module = array();

		// Grab module information using Bart's "neat-o-module" system (tm)
		$dir = @opendir('.');

		if (!$dir)
		{
			$this->error('Unable to access the installation directory', __LINE__, __FILE__);
		}

		$setmodules = 1;
		while (($file = readdir($dir)) !== false)
		{
			if (preg_match('#^install_(.*?)\.' . $phpEx . '$#', $file))
			{
				include($file);
			}
		}
		closedir($dir);

		unset($setmodules);

		if (!sizeof($module))
		{
			$this->error('No installation modules found', __LINE__, __FILE__);
		}

		// Order to use and count further if modules get assigned to the same position or not having an order
		$max_module_order = 1000;

		foreach ($module as $row)
		{
			// Check any module pre-reqs
			if ($row['module_reqs'] != '')
			{
			}

			// Module order not specified or module already assigned at this position?
			if (!isset($row['module_order']) || isset($this->module_ary[$row['module_order']]))
			{
				$row['module_order'] = $max_module_order;
				$max_module_order++;
			}

			$this->module_ary[$row['module_order']]['name'] = $row['module_title'];
			$this->module_ary[$row['module_order']]['filename'] = $row['module_filename'];
			$this->module_ary[$row['module_order']]['subs'] = $row['module_subs'];
			$this->module_ary[$row['module_order']]['stages'] = $row['module_stages'];

			if (strtolower($selected_mod) == strtolower($row['module_title']))
			{
				$this->id = (int) $row['module_order'];
				$this->filename = (string) $row['module_filename'];
				$this->module_url = (string) $module_url;
				$this->mode = (string) $selected_mod;
				// Check that the sub-mode specified is valid or set a default if not
				if (is_array($row['module_subs']))
				{
					$this->sub = strtolower((in_array(strtoupper($selected_submod), $row['module_subs'])) ? $selected_submod : $row['module_subs'][0]);
				}
				else if (is_array($row['module_stages']))
				{
					$this->sub = strtolower((in_array(strtoupper($selected_submod), $row['module_stages'])) ? $selected_submod : $row['module_stages'][0]);
				}
				else
				{
					$this->sub = '';
				}
			}
		} // END foreach
	} // END create

	/**
	* Load and run the relevant module if applicable
	*/
	function load($mode = false, $run = true)
	{
		global $phpbb_root_path, $phpEx;

		if ($run)
		{
			if (!empty($mode))
			{
				$this->mode = $mode;
			}

			$module = $this->filename;
			if (!class_exists($module))
			{
				$this->error('Module "' . htmlspecialchars($module) . '" not accessible.', __LINE__, __FILE__);
			}
			$this->module = new $module($this);

			if (method_exists($this->module, 'main'))
			{
				$this->module->main($this->mode, $this->sub);
			}
		}
	}

	/**
	* Output the standard page header
	*/
	function page_header()
	{
		if (defined('HEADER_INC'))
		{
			return;
		}

		define('HEADER_INC', true);
		global $template, $user, $stage, $phpbb_root_path;

		$template->assign_vars(array(
			'L_CHANGE'				=> $user->lang['CHANGE'],
			'L_INSTALL_PANEL'		=> $user->lang['INSTALL_PANEL'],
			'L_SELECT_LANG'			=> $user->lang['SELECT_LANG'],
			'L_SKIP'				=> $user->lang['SKIP'],
			'PAGE_TITLE'			=> $this->get_page_title(),
			'T_IMAGE_PATH'			=> $phpbb_root_path . 'adm/images/',

			'S_CONTENT_DIRECTION' 	=> $user->lang['DIRECTION'],
			'S_CONTENT_FLOW_BEGIN'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
			'S_CONTENT_FLOW_END'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
			'S_CONTENT_ENCODING' 	=> 'UTF-8',

			'S_USER_LANG'			=> $user->lang['USER_LANG'],
			)
		);

		header('Content-type: text/html; charset=UTF-8');
		header('Cache-Control: private, no-cache="set-cookie"');
		header('Expires: 0');
		header('Pragma: no-cache');

		return;
	}

	/**
	* Output the standard page footer
	*/
	function page_footer()
	{
		global $db, $template;

		$template->display('body');
		
		// Unload cache, must be done before the DB connection if closed
		if (!empty($cache) && is_object($cache))
		{
			$cache->unload();
		}

		// Close our DB connection.
		if (!empty($db) && is_object($db))
		{
			$db->sql_close();
		}

		if (function_exists('exit_handler'))
		{
			exit_handler();
		}
	}

	/**
	* Returns desired template name
	*/
	function get_tpl_name()
	{
		return $this->module->tpl_name . '.html';
	}

	/**
	* Returns the desired page title
	*/
	function get_page_title()
	{
		global $user;

		if (!isset($this->module->page_title))
		{
			return '';
		}

		return (isset($user->lang[$this->module->page_title])) ? $user->lang[$this->module->page_title] : $this->module->page_title;
	}

	/**
	* Generate the navigation tabs
	*/
	function generate_navigation()
	{
		global $user, $template, $phpEx, $language;

		if (is_array($this->module_ary))
		{
			@ksort($this->module_ary);
			foreach ($this->module_ary as $cat_ary)
			{
				$cat = $cat_ary['name'];
				$l_cat = (!empty($user->lang['CAT_' . $cat])) ? $user->lang['CAT_' . $cat] : preg_replace('#_#', ' ', $cat);
				$cat = strtolower($cat);
				$url = $this->module_url . "?mode=$cat";

				if ($this->mode == $cat)
				{
					$template->assign_block_vars('t_block1', array(
						'L_TITLE'		=> $l_cat,
						'S_SELECTED'	=> true,
						'U_TITLE'		=> $url,
					));

					if (is_array($this->module_ary[$this->id]['subs']))
					{
						$subs = $this->module_ary[$this->id]['subs'];
						foreach ($subs as $option)
						{
							$l_option = (!empty($user->lang['SUB_' . $option])) ? $user->lang['SUB_' . $option] : preg_replace('#_#', ' ', $option);
							$option = strtolower($option);
							$url = $this->module_url . '?mode=' . $this->mode . "&amp;sub=$option";

							$template->assign_block_vars('l_block1', array(
								'L_TITLE'		=> $l_option,
								'S_SELECTED'	=> ($this->sub == $option),
								'U_TITLE'		=> $url,
							));
						}
					}

					if (is_array($this->module_ary[$this->id]['stages']))
					{
						$subs = $this->module_ary[$this->id]['stages'];
						$matched = false;
						foreach ($subs as $option)
						{
							$l_option = (!empty($user->lang['STAGE_' . $option])) ? $user->lang['STAGE_' . $option] : preg_replace('#_#', ' ', $option);
							$option = strtolower($option);
							$matched = ($this->sub == $option) ? true : $matched;

							$template->assign_block_vars('l_block2', array(
								'L_TITLE'		=> $l_option,
								'S_SELECTED'	=> ($this->sub == $option),
								'S_COMPLETE'	=> !$matched,
							));
						}
					}
				}
				else
				{
					$template->assign_block_vars('t_block1', array(
						'L_TITLE'		=> $l_cat,
						'S_SELECTED'	=> false,
						'U_TITLE'		=> $url,
					));
				}
			}
		}
	}
	
	/**
	* Output an error message
	* If skip is true, return and continue execution, else exit
	*/
	function error($error, $line, $file, $skip = false)
	{
		global $user, $db, $template;

		if ($skip)
		{
			$template->assign_block_vars('checks', array(
				'S_LEGEND'	=> true,
				'LEGEND'	=> $user->lang['INST_ERR'],
			));

			$template->assign_block_vars('checks', array(
				'TITLE'		=> basename($file) . ' [ ' . $line . ' ]',
				'RESULT'	=> '<b style="color:red">' . $error . '</b>',
			));

			return;
		}

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">';
		echo '<head>';
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
		echo '<title>' . $user->lang['INST_ERR_FATAL'] . '</title>';
		echo '<link href="../adm/style/admin.css" rel="stylesheet" type="text/css" media="screen" />';
		echo '</head>';
		echo '<body id="errorpage">';
		echo '<div id="wrap">';
		echo '	<div id="page-header">';
		echo '	</div>';
		echo '	<div id="page-body">';
		echo '		<div id="acp">';
		echo '		<div class="panel">';
		echo '			<span class="corners-top"><span></span></span>';
		echo '			<div id="content">';
		echo '				<h1>' . $user->lang['INST_ERR_FATAL'] . '</h1>';
		echo '		<p>' . $user->lang['INST_ERR_FATAL'] . "</p>\n";
		echo '		<p>' . basename($file) . ' [ ' . $line . " ]</p>\n";
		echo '		<p><b>' . $error . "</b></p>\n";
		echo '			</div>';
		echo '			<span class="corners-bottom"><span></span></span>';
		echo '		</div>';
		echo '		</div>';
		echo '	</div>';
		echo '	<div id="page-footer">';
		echo '		Powered by phpBB &copy; 2000, 2002, 2005, 2007 <a href="http://www.phpbb.com/">phpBB Group</a>';
		echo '	</div>';
		echo '</div>';
		echo '</body>';
		echo '</html>';

		if (!empty($db) && is_object($db))
		{
			$db->sql_close();
		}

		exit_handler();
	}

	/**
	* Generate the relevant HTML for an input field and the associated label and explanatory text
	*/
	function input_field($name, $type, $value='', $options='')
	{
		global $user;
		$tpl_type = explode(':', $type);
		$tpl = '';

		switch ($tpl_type[0])
		{
			case 'text':
			case 'password':
				$size = (int) $tpl_type[1];
				$maxlength = (int) $tpl_type[2];

				$tpl = '<input id="' . $name . '" type="' . $tpl_type[0] . '"' . (($size) ? ' size="' . $size . '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $name . '" value="' . $value . '" />';
			break;

			case 'textarea':
				$rows = (int) $tpl_type[1];
				$cols = (int) $tpl_type[2];

				$tpl = '<textarea id="' . $name . '" name="' . $name . '" rows="' . $rows . '" cols="' . $cols . '">' . $value . '</textarea>';
			break;

			case 'radio':
				$key_yes	= ($value) ? ' checked="checked" id="' . $name . '"' : '';
				$key_no		= (!$value) ? ' checked="checked" id="' . $name . '"' : '';

				$tpl_type_cond = explode('_', $tpl_type[1]);
				$type_no = ($tpl_type_cond[0] == 'disabled' || $tpl_type_cond[0] == 'enabled') ? false : true;

				$tpl_no = '<label><input type="radio" name="' . $name . '" value="0"' . $key_no . ' class="radio" /> ' . (($type_no) ? $user->lang['NO'] : $user->lang['DISABLED']) . '</label>';
				$tpl_yes = '<label><input type="radio" name="' . $name . '" value="1"' . $key_yes . ' class="radio" /> ' . (($type_no) ? $user->lang['YES'] : $user->lang['ENABLED']) . '</label>';

				$tpl = ($tpl_type_cond[0] == 'yes' || $tpl_type_cond[0] == 'enabled') ? $tpl_yes . '&nbsp;&nbsp;' . $tpl_no : $tpl_no . '&nbsp;&nbsp;' . $tpl_yes;
			break;

			case 'select':
				eval('$s_options = ' . str_replace('{VALUE}', $value, $options) . ';');
				$tpl = '<select id="' . $name . '" name="' . $name . '">' . $s_options . '</select>';
			break;

			case 'custom':
				eval('$tpl = ' . str_replace('{VALUE}', $value, $options) . ';');
			break;

			default:
			break;
		}

		return $tpl;
	}
}

?>