<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

class acp_portal
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $template;
		global $config, $portal_config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$phpEx = (empty($phpEx)) ? substr(strrchr(__FILE__, '.'), 1) : $phpEx;
		
		require '../portal/includes/functions.'.$phpEx;

		$portal_config = obtain_portal_config();

		$user->add_lang('mods/lang_portal_acp');

		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writeable), path (relative path, but able to escape the root), wpath (writeable)
		*/
		switch ($mode)
		{
			case 'general':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_GENERAL_INFO',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_GENERAL_SETTINGS',
						'portal_advanced_stat'				=> array('lang' => 'PORTAL_ADVANCED_STAT'	, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_search'						=> array('lang' => 'PORTAL_SEARCH'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_leaders'					=> array('lang' => 'PORTAL_LEADERS'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_clock'						=> array('lang' => 'PORTAL_CLOCK'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_link_us'					=> array('lang' => 'PORTAL_LINK_US'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_links'						=> array('lang' => 'PORTAL_LINKS'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_birthdays'					=> array('lang' => 'PORTAL_BIRTHDAYS'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_birthdays_ahead'			=> array('lang' => 'PORTAL_BIRTHDAYS_AHEAD'		, 'validate' => 'int'	, 'type' => 'text:3:3'	, 'explain' => true),
						'portal_random_member'				=> array('lang' => 'PORTAL_RANDOM_MEMBER'	, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_whois_online'				=> array('lang' => 'PORTAL_WHOIS_ONLINE'	, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_change_style'				=> array('lang' => 'PORTAL_CHANGE_STYLE'	, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_main_menu'					=> array('lang' => 'PORTAL_MAIN_MENU'	, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_user_menu'					=> array('lang' => 'PORTAL_USER_MENU'	, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_friends'					=> array('lang' => 'PORTAL_FRIENDS'		, 'validate' => 'bool'	, 'type' => 'radio:yes_no'	, 'explain' => true),
						'portal_max_online_friends'			=> array('lang' => 'PORTAL_MAX_ONLINE_FRIENDS'	, 'validate' => 'int'	, 'type' => 'text:3:3'		, 'explain' => true),	

						'legend2'							=> 'ACP_PORTAL_COLLUMN_WIDTH_SETTINGS',
						'portal_left_collumn_width'			=> array('lang' => 'PORTAL_LEFT_COLLUMN_WIDTH'	,	'validate' => 'int'	, 'type' => 'text:3:3',		 'explain' => true),
						'portal_right_collumn_width'		=> array('lang' => 'PORTAL_RIGHT_COLLUMN_WIDTH'	,	'validate' => 'int'	, 'type' => 'text:3:3',		 'explain' => true),
					)
				);
			break;
			case 'news':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_NEWS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_NEWS_SETTINGS',
						'portal_news'						=> array('lang' => 'PORTAL_NEWS'					,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_news_style'					=> array('lang' => 'PORTAL_NEWS_STYLE'				,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_show_all_news'				=> array('lang' => 'PORTAL_SHOW_ALL_NEWS'			,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_number_of_news'				=> array('lang' => 'PORTAL_NUMBER_OF_NEWS'			,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_news_length'				=> array('lang' => 'PORTAL_NEWS_LENGTH'				,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_news_forum'					=> array('lang' => 'PORTAL_NEWS_FORUM'				,	'validate' => 'string',		'type' => 'text:10:200',	 'explain' => true),
						'portal_news_permissions'			=> array('lang' => 'PORTAL_NEWS_PERMISSIONS'		,	'validate' => 'bool',		'type' => 'radio:yes_no',	 'explain' => true),
					)
				);
			break;
			case 'announcements':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_ANNOUNCE_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_ANNOUNCE_SETTINGS',
						'portal_announcements'				=> array('lang' => 'PORTAL_ANNOUNCEMENTS'				,	'validate' => 'bool',  	'type' => 'radio:yes_no',	'explain' => true),
						'portal_announcements_style'		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_STYLE'		 	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_number_of_announcements'	=> array('lang' => 'PORTAL_NUMBER_OF_ANNOUNCEMENTS'		,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_announcements_day'			=> array('lang' => 'PORTAL_ANNOUNCEMENTS_DAY'			,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_announcements_length'		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_LENGTH'		,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_global_announcements_forum'	=> array('lang' => 'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'	,	'validate' => 'string',	'type' => 'text:10:200',	'explain' => true),
						'portal_announcements_permissions'	=> array('lang' => 'PORTAL_ANNOUNCEMENTS_PERMISSIONS'	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
					)
				);
			break;
			case 'recent':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_RECENT_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_RECENT_SETTINGS',
						'portal_recent'			 			=> array('lang' => 'PORTAL_RECENT'				  	 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_max_topics'					=> array('lang' => 'PORTAL_MAX_TOPIC'					 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_recent_title_limit'			=> array('lang' => 'PORTAL_RECENT_TITLE_LIMIT'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_exclude_forums'				=> array('lang' => 'PORTAL_EXCLUDE_FORUM'				,	'validate' => 'string',		'type' => 'text:10:200',	 'explain' => true),
					)
				);
			break;
			case 'wordgraph':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_WORDGRAPH_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_WORDGRAPH_SETTINGS',
						'portal_wordgraph'			 		=> array('lang' => 'PORTAL_WORDGRAPH'					 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_wordgraph_max_words'		=> array('lang' => 'PORTAL_WORDGRAPH_MAX_WORDS'	,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_wordgraph_word_counts'		=> array('lang' => 'PORTAL_WORDGRAPH_WORD_COUNTS'	,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_wordgraph_ratio'			=> array('lang' => 'PORTAL_WORDGRAPH_RATIO'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
					)
				);
			break;
			case 'paypal':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_PAYPAL_SETTINGS',
					'vars'	=> array(
						'legend2'							=> 'ACP_PORTAL_PAYPAL_SETTINGS',
						'portal_pay_c_block'				=> array('lang' => 'PORTAL_PAY_C_BLOCK'				  ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_pay_s_block'				=> array('lang' => 'PORTAL_PAY_S_BLOCK'				  ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_pay_acc'					=> array('lang' => 'PORTAL_PAY_ACC'						,	'validate' => 'string',		'type' => 'text:25:100',	 'explain' => true),
					)
				);
			break;
			case 'attachments':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS',
						'portal_attachments'				=> array('lang' => 'PORTAL_ATTACHMENTS'				  ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_attachments_number'	=> array('lang' => 'PORTAL_ATTACHMENTS_NUMBER'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_attachments_forum_ids'	=> array('lang' => 'PORTAL_ATTACHMENTS_FORUM_IDS',	'validate' => 'string',		'type' => 'text:10:200',	 'explain' => true),
					)
				);
			break;
			case 'members':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_MEMBERS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_MEMBERS_SETTINGS',
						'portal_latest_members'				=> array('lang' => 'PORTAL_LATEST_MEMBERS'			  ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_max_last_member'			=> array('lang' => 'PORTAL_MAX_LAST_MEMBER'			 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
					)
				);
			break;
			case 'polls':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_POLLS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_POLLS_SETTINGS',
						'portal_poll_topic'					=> array('lang' => 'PORTAL_POLL_TOPIC'					,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_poll_topic_id'				=> array('lang' => 'PORTAL_POLL_TOPIC_ID'				,	'validate' => 'string',		'type' => 'text:10:200',	'explain' => true),
						'portal_poll_limit'					=> array('lang' => 'PORTAL_POLL_LIMIT'					,	'validate' => 'int',		'type' => 'text:3:3',	 	'explain' => true),
						'portal_poll_allow_vote'			=> array('lang' => 'PORTAL_POLL_ALLOW_VOTE'				,	'validate' => 'ibool',		'type' => 'radio:yes_no',	 'explain' => true),
					)
				);
			break;
			case 'bots':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_BOTS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_BOTS_SETTINGS',
						'portal_load_last_visited_bots'		=> array('lang' => 'PORTAL_LOAD_LAST_VISITED_BOTS'	,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_last_visited_bots_number'	=> array('lang' => 'PORTAL_LAST_VISITED_BOTS_NUMBER' ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
					)
				);
			break;
			case 'poster':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_MOST_POSTER_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_MOST_POSTER_SETTINGS',
						'portal_top_posters'				=> array('lang' => 'PORTAL_TOP_POSTERS'					,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_max_most_poster'			=> array('lang' => 'PORTAL_MAX_MOST_POSTER'			  ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
					)
				);
			break;

			case 'welcome':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_WELCOME_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_WELCOME_SETTINGS',
						'portal_welcome'					=> array('lang' => 'PORTAL_WELCOME'						 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_welcome_guest'				=> array('lang' => 'PORTAL_WELCOME_GUEST'						 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_welcome_intro'				=> array('lang' => 'PORTAL_WELCOME_INTRO'				 ,	'validate' => 'string',	'type' => 'textarea:6:6',	 'explain' => true),
					 )
				);
			break;

			case 'customblock':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_CUSTOM_SETTINGS',
					'vars'	=> array(
						'legend1'								=> 'ACP_PORTAL_CUSTOM_SMALL_SETTINGS',
						'portal_custom_small'					=> array('lang' => 'PORTAL_CUSTOM_SMALL'						,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_small_headline'		=> array('lang' => 'PORTAL_CUSTOM_SMALL_HEADLINE'			,	'validate' => 'string',  'type' => 'text:40:200',	  'explain' => true),
						'portal_custom_small_bbcode'		=> array('lang' => 'PORTAL_CUSTOM_SMALL_BBCODE'				,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_code_small'			=> array('lang' => 'PORTAL_CUSTOM_CODE_SMALL'				,	'validate' => 'string',	'type' => 'textarea:6:6',	 'explain' => true),
						'legend2'								=> 'ACP_PORTAL_CUSTOM_CENTER_SETTINGS',
						'portal_custom_center'				=> array('lang' => 'PORTAL_CUSTOM_CENTER'						,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_center_headline'		=> array('lang' => 'PORTAL_CUSTOM_CENTER_HEADLINE'			,	'validate' => 'string',  'type' => 'text:40:200',	  'explain' => true),
						'portal_custom_center_bbcode'		=> array('lang' => 'PORTAL_CUSTOM_CENTER_BBCODE'			,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_code_center'			=> array('lang' => 'PORTAL_CUSTOM_CODE_CENTER'				,	'validate' => 'string',	'type' => 'textarea:6:6',	 'explain' => true),
					 )
				);
			break;

		  case 'minicalendar':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_MINICALENDAR_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_MINICALENDAR_SETTINGS',
						'portal_minicalendar'				=> array('lang' => 'PORTAL_MINICALENDAR'					 ,	'validate' => 'bool',	 'type' => 'radio:yes_no',	'explain' => true),
						'portal_minicalendar_today_color'	=> array('lang' => 'PORTAL_MINICALENDAR_TODAY_COLOR'	 ,	'validate' => 'string',  'type' => 'text:10:10',	  'explain' => true),
						'portal_minicalendar_day_link_color'	=> array('lang' => 'PORTAL_MINICALENDAR_DAY_LINK_COLOR' ,	'validate' => 'string',  'type' => 'text:10:10',	  'explain' => true),
					)
				);
			break;
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$this->new_config = $portal_config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($submit)
			{
				set_portal_config($config_name, $config_value);
			}
		}

		if ($submit)
		{
			add_log('admin', 'LOG_CONFIG_' . strtoupper($mode));
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$this->tpl_name = 'acp_board';
		$this->page_title = $display_vars['title'];

		$title_explain = $user->lang[$display_vars['title'] . '_EXPLAIN'];

		$title_explain .= ( $display_vars['title'] == 'ACP_PORTAL_GENERAL_INFO' ) ? '<br /><br />' . sprintf($user->lang['ACP_PORTAL_VERSION'], $portal_config['portal_version']) : '';

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $title_explain,

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ACTION'			=> $this->u_action)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
				)
			);
			unset($display_vars['vars'][$config_key]);
		}
	}
}

?>