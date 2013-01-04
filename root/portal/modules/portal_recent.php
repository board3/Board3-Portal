<?php
/**
*
* @package Board3 Portal v2 - Recent
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
* @package Recent
*/
class portal_recent_module
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
	public $name = 'PORTAL_RECENT';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_recent_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = '';

	public function get_template_center($module_id)
	{
		global $config, $template, $db, $auth, $phpbb_root_path, $phpEx;

		//
		// Exclude forums
		//
		$sql_where = '';
		if ($config['board3_recent_forum_' . $module_id] > 0)
		{
			$exclude_forums = explode(',', $config['board3_recent_forum_' . $module_id]);

			$sql_where = ' AND ' . $db->sql_in_set('forum_id', array_map('intval', $exclude_forums), ($config['board3_recent_exclude_forums_' . $module_id]) ? true : false);
		}

		// Get a list of forums the user cannot read
		$forum_ary = array_unique(array_keys($auth->acl_getf('!f_read', true)));

		// Determine first forum the user is able to read (must not be a category)
		$sql = 'SELECT forum_id
			FROM ' . FORUMS_TABLE . '
			WHERE forum_type = ' . FORUM_POST;

		$forum_sql = '';
		if (sizeof($forum_ary))
		{
			$sql .= ' AND ' . $db->sql_in_set('forum_id', $forum_ary, true);
			$forum_sql = ' AND ' . $db->sql_in_set('t.forum_id', $forum_ary, true);
		}

		$result = $db->sql_query_limit($sql, 1);
		$g_forum_id = (int) $db->sql_fetchfield('forum_id');
		$db->sql_freeresult($result);

		//
		// Recent announcements
		//
		$sql = 'SELECT topic_title, forum_id, topic_id
			FROM ' . TOPICS_TABLE . ' t
			WHERE topic_status <> ' . FORUM_LINK . '
				AND topic_approved = 1 
				AND (topic_type = ' . POST_ANNOUNCE . ' OR topic_type = ' . POST_GLOBAL . ')
				AND topic_moved_id = 0
				' . $sql_where . '' .  $forum_sql . '
			ORDER BY topic_time DESC';
		$result = $db->sql_query_limit($sql, $config['board3_max_topics_' . $module_id]);

		while(($row = $db->sql_fetchrow($result)) && ($row['topic_title']))
		{
			// auto auth
			if (($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0'))
			{
				$template->assign_block_vars('latest_announcements', array(
					'TITLE'			=> character_limit($row['topic_title'], $config['board3_recent_title_limit_' . $module_id]),
					'FULL_TITLE'	=> censor_text($row['topic_title']),
					'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row['forum_id'] == 0) ? $g_forum_id : $row['forum_id']) . '&amp;t=' . $row['topic_id'])
				));
			}
		}
		$db->sql_freeresult($result);

		//
		// Recent hot topics
		//
		$sql = 'SELECT topic_title, forum_id, topic_id
			FROM ' . TOPICS_TABLE . ' t
			WHERE topic_approved = 1 
				AND topic_replies >=' . $config['hot_threshold'] . '
				AND topic_moved_id = 0
				' . $sql_where . '' .  $forum_sql . '
			ORDER BY topic_time DESC';
		$result = $db->sql_query_limit($sql, $config['board3_max_topics_' . $module_id]);

		while(($row = $db->sql_fetchrow($result)) && ($row['topic_title']))
		{
			// auto auth
			if (($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0'))
			{
				$template->assign_block_vars('latest_hot_topics', array(
					'TITLE'			=> character_limit($row['topic_title'], $config['board3_recent_title_limit_' . $module_id]),
					'FULL_TITLE'	=> censor_text($row['topic_title']),
					'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row['forum_id'] == 0) ? $g_forum_id : $row['forum_id']) . '&amp;t=' . $row['topic_id'])
				));
			}
		}
		$db->sql_freeresult($result);

		//
		// Recent topic (only show normal topic)
		//
		$sql = 'SELECT topic_title, forum_id, topic_id
			FROM ' . TOPICS_TABLE . ' t
			WHERE topic_status <> ' . ITEM_MOVED . '
				AND topic_approved = 1 
				AND topic_type = ' . POST_NORMAL . '
				AND topic_moved_id = 0
				' . $sql_where . '' .  $forum_sql . '
			ORDER BY topic_time DESC';
		$result = $db->sql_query_limit($sql, $config['board3_max_topics_' . $module_id]);

		while(($row = $db->sql_fetchrow($result)) && ($row['topic_title']))
		{
			// auto auth
			if (($auth->acl_get('f_read', $row['forum_id'])) || ($row['forum_id'] == '0'))
			{
				$template->assign_block_vars('latest_topics', array(
					'TITLE'			=> character_limit($row['topic_title'], $config['board3_recent_title_limit_' . $module_id]),
					'FULL_TITLE'	=> censor_text($row['topic_title']),
					'U_VIEW_TOPIC'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'])
				));
			}
		}
		$db->sql_freeresult($result);

		return 'recent_center.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_RECENT_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_RECENT_SETTINGS',
				'board3_max_topics_' . $module_id				=> array('lang' => 'PORTAL_MAX_TOPIC',			'validate' => 'int',		'type' => 'text:3:3',		'explain' => true),
				'board3_recent_title_limit_' . $module_id		=> array('lang' => 'PORTAL_RECENT_TITLE_LIMIT',	'validate' => 'int',		'type' => 'text:3:3',		'explain' => true),
				'board3_recent_forum_' . $module_id				=> array('lang' => 'PORTAL_RECENT_FORUM',		'validate' => 'string',		'type' => 'custom',			'explain' => true, 'method' => 'select_forums', 'submit' => 'store_selected_forums'),
				'board3_recent_exclude_forums_' . $module_id	=> array('lang' => 'PORTAL_EXCLUDE_FORUM',		'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
			)
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_max_topics_' . $module_id, 10);
		set_config('board3_recent_title_limit_' . $module_id, 100);
		set_config('board3_recent_forum_' . $module_id, '');
		set_config('board3_recent_exclude_forums_' . $module_id, 1);
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_max_topics_' . $module_id,
			'board3_recent_title_limit_' . $module_id,
			'board3_recent_forum_' . $module_id,
			'board3_recent_exclude_forums_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}

	// Create forum select box
	public function select_forums($value, $key, $module_id)
	{
		global $user, $config;

		$forum_list = make_forum_select(false, false, true, true, true, false, true);

		$selected = array();
		if(isset($config[$key]) && strlen($config[$key]) > 0)
		{
			$selected = explode(',', $config[$key]);
		}
		// Build forum options
		$s_forum_options = '<select id="' . $key . '" name="' . $key . '[]" multiple="multiple">';
		foreach ($forum_list as $f_id => $f_row)
		{
			$s_forum_options .= '<option value="' . $f_id . '"' . ((in_array($f_id, $selected)) ? ' selected="selected"' : '') . (($f_row['disabled']) ? ' disabled="disabled" class="disabled-option"' : '') . '>' . $f_row['padding'] . $f_row['forum_name'] . '</option>';
		}
		$s_forum_options .= '</select>';

		return $s_forum_options;

	}

	// Store selected forums
	public function store_selected_forums($key, $module_id)
	{
		global $db, $cache;

		// Get selected extensions
		$values = request_var($key, array(0 => ''));

		$news = implode(',', $values);

		set_config($key, $news);

	}
}
