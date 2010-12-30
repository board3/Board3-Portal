<?php

/**
*
* @package - Board3portal
* @version $Id: acp_portal.php 665 2010-07-28 13:00:37Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_portal
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $template;
		global $config, $portal_config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'portal/includes/functions.' . $phpEx);

		$portal_config = obtain_portal_config();

		$user->add_lang('mods/lang_portal_acp');

		if (!function_exists('mod_version_check'))
		{
			include($phpbb_root_path . 'portal/includes/functions_version_check.' . $phpEx);
		}
		mod_version_check();

		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;
		
		$this->new_config = $portal_config;

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
					'title'	=> 'ACP_PORTAL_GENERAL_TITLE',
					'vars'	=> array(
						'legend1'					=> 'ACP_PORTAL_GENERAL_SETTINGS',
						'portal_enable'				=> array('lang' => 'PORTAL_ENABLE',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_left_column'		=> array('lang' => 'PORTAL_LEFT_COLUMN',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_right_column'		=> array('lang' => 'PORTAL_RIGHT_COLUMN',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_version_check'		=> array('lang' => 'PORTAL_VERSION_CHECK',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_advanced_stat'		=> array('lang' => 'PORTAL_ADVANCED_STAT',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_search'				=> array('lang' => 'PORTAL_SEARCH',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_leaders'			=> array('lang' => 'PORTAL_LEADERS',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_leaders_ext'		=> array('lang' => 'PORTAL_LEADERS_EXT',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_clock'				=> array('lang' => 'PORTAL_CLOCK',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_link_us'			=> array('lang' => 'PORTAL_LINK_US',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_random_member'		=> array('lang' => 'PORTAL_RANDOM_MEMBER',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_forum_index'		=> array('lang' => 'PORTAL_FORUM_INDEX',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_whois_online'		=> array('lang' => 'PORTAL_WHOIS_ONLINE',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_change_style'		=> array('lang' => 'PORTAL_CHANGE_STYLE',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_main_menu'			=> array('lang' => 'PORTAL_MAIN_MENU',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_phpbb_menu'			=> array('lang' => 'PORTAL_PHPBB_MENU',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_user_menu'			=> array('lang' => 'PORTAL_USER_MENU',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),

						'legend2'					=> 'ACP_PORTAL_COLUMN_WIDTH_SETTINGS',
						'portal_left_column_width'	=> array('lang' => 'PORTAL_LEFT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_right_column_width'	=> array('lang' => 'PORTAL_RIGHT_COLUMN_WIDTH',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
					)
				);
			break;
			case 'news':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_NEWS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_NEWS_SETTINGS',
						'portal_news'						=> array('lang' => 'PORTAL_NEWS',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_news_style'					=> array('lang' => 'PORTAL_NEWS_STYLE',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_show_all_news'				=> array('lang' => 'PORTAL_SHOW_ALL_NEWS',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_number_of_news'				=> array('lang' => 'PORTAL_NUMBER_OF_NEWS',	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_news_length'				=> array('lang' => 'PORTAL_NEWS_LENGTH',	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_news_forum'					=> array('lang' => 'PORTAL_NEWS_FORUM',		'validate' => 'string',		'type' => 'custom',	 		'explain' => true,	'method' => 'select_forums'),
						'portal_news_exclude'				=> array('lang' => 'PORTAL_NEWS_EXCLUDE',	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_news_show_last'             => array('lang' => 'PORTAL_NEWS_SHOW_LAST',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_news_archive'               => array('lang' => 'PORTAL_NEWS_ARCHIVE',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_news_permissions'			=> array('lang' => 'PORTAL_NEWS_PERMISSIONS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_show_news_replies_views'	=> array('lang' => 'PORTAL_SHOW_REPLIES_VIEWS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
					)
				);
			break;
			case 'announcements':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_ANNOUNCE_SETTINGS',
					'vars'	=> array(
						'legend1'									=> 'ACP_PORTAL_ANNOUNCE_SETTINGS',
						'portal_announcements'						=> array('lang' => 'PORTAL_ANNOUNCEMENTS'				,	'validate' => 'bool', 	'type' => 'radio:yes_no',	'explain' => true),
						'portal_announcements_style'				=> array('lang' => 'PORTAL_ANNOUNCEMENTS_STYLE'		 	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_number_of_announcements'			=> array('lang' => 'PORTAL_NUMBER_OF_ANNOUNCEMENTS'		,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_announcements_day'					=> array('lang' => 'PORTAL_ANNOUNCEMENTS_DAY'			,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_announcements_length'				=> array('lang' => 'PORTAL_ANNOUNCEMENTS_LENGTH'		,	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
						'portal_global_announcements_forum'			=> array('lang' => 'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'	,	'validate' => 'string',	'type' => 'custom',			'explain' => true, 'method' => 'select_forums'),
						'portal_announcements_forum_exclude'		=> array('lang' => 'PORTAL_ANNOUNCEMENTS_FORUM_EXCLUDE',	'validate' => 'string', 'type' => 'radio:yes_no',	'explain' => true),
						'portal_announcements_archive'				=> array('lang' => 'PORTAL_ANNOUNCEMENTS_ARCHIVE',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_announcements_permissions'			=> array('lang' => 'PORTAL_ANNOUNCEMENTS_PERMISSIONS'	,	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_show_announcements_replies_views'	=> array('lang' => 'PORTAL_SHOW_REPLIES_VIEWS',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
					)
				);
			break;
			case 'recent':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_RECENT_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_RECENT_SETTINGS',
						'portal_recent'			 			=> array('lang' => 'PORTAL_RECENT',				'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_max_topics'					=> array('lang' => 'PORTAL_MAX_TOPIC',			'validate' => 'int',		'type' => 'text:3:3',		'explain' => true),
						'portal_recent_title_limit'			=> array('lang' => 'PORTAL_RECENT_TITLE_LIMIT',	'validate' => 'int',		'type' => 'text:3:3',		'explain' => true),
						'portal_recent_forum'				=> array('lang' => 'PORTAL_RECENT_FORUM',		'validate' => 'string',		'type' => 'custom',			'explain' => true, 'method' => 'select_forums'),
						'portal_exclude_forums'				=> array('lang' => 'PORTAL_EXCLUDE_FORUM',		'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
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
						'legend1'							=> 'ACP_PORTAL_PAYPAL_SETTINGS',
						'portal_pay_c_block'				=> array('lang' => 'PORTAL_PAY_C_BLOCK'				 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_pay_s_block'				=> array('lang' => 'PORTAL_PAY_S_BLOCK'				 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_pay_acc'					=> array('lang' => 'PORTAL_PAY_ACC'						,	'validate' => 'string',		'type' => 'text:25:100',	 'explain' => true),
					)
				);
			break;
			case 'attachments':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS',
						'portal_attachments'				=> array('lang' => 'PORTAL_ATTACHMENTS'				 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_attachments_number'	=> array('lang' => 'PORTAL_ATTACHMENTS_NUMBER'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_attach_max_length'	=> array('lang' => 'PORTAL_ATTACHMENTS_MAX_LENGTH'		 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
						'portal_attachments_forum_ids'	=> array('lang' => 'PORTAL_ATTACHMENTS_FORUM_IDS',	'validate' => 'string',		'type' => 'custom',	'explain' => true,	'method' => 'select_forums'),
						'portal_attachments_forum_exclude' => array('lang' => 'PORTAL_ATTACHMENTS_FORUM_EXCLUDE', 'validate' => 'bool', 'type' => 'radio:yes_no',	 'explain' => true),
						'portal_attachments_filetype'	=> array('lang' => 'PORTAL_ATTACHMENTS_FILETYPE',	'validate' => 'string', 	'type' => 'custom',	'explain' => true,	'method' => 'select_filetype'),
						'portal_attachments_exclude'	=> array('lang' => 'PORTAL_ATTACHMENTS_EXCLUDE', 	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
					)
				);
			break;
			case 'members':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_MEMBERS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_MEMBERS_SETTINGS',
						'portal_latest_members'				=> array('lang' => 'PORTAL_LATEST_MEMBERS'			 ,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
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
						'portal_poll_topic_id'				=> array('lang' => 'PORTAL_POLL_TOPIC_ID'				,	'validate' => 'string',		'type' => 'custom',			'explain' => true, 'method' => 'select_forums'),
						'portal_poll_exclude_id'			=> array('lang' => 'PORTAL_POLL_EXCLUDE_ID'				,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_poll_limit'					=> array('lang' => 'PORTAL_POLL_LIMIT'					,	'validate' => 'int',		'type' => 'text:3:3',	 	'explain' => true),
						'portal_poll_allow_vote'			=> array('lang' => 'PORTAL_POLL_ALLOW_VOTE'				,	'validate' => 'ibool',		'type' => 'radio:yes_no',	 'explain' => true),
						'portal_poll_hide'					=> array('lang' => 'PORTAL_POLL_HIDE'					,	'validate' => 'bool',		'type' => 'radio:yes_no',	 'explain' => true),
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
						'portal_max_most_poster'			=> array('lang' => 'PORTAL_MAX_MOST_POSTER'			 ,	'validate' => 'int',		'type' => 'text:3:3',		 'explain' => true),
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
						'portal_welcome_intro'				=> array('lang' => 'PORTAL_WELCOME_INTRO'				 ,	'type' => 'textarea:6:6',	 'explain' => true),
					 )
				);
			break;

			case 'customblock':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_CUSTOM_SETTINGS',
					'vars'	=> array(
						'legend1'								=> 'ACP_PORTAL_CUSTOM_SMALL_SETTINGS',
						'portal_custom_small'					=> array('lang' => 'PORTAL_CUSTOM_SMALL'						,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_small_headline'		=> array('lang' => 'PORTAL_CUSTOM_SMALL_HEADLINE'			,	'validate' => 'string', 'type' => 'text:40:200',	 'explain' => true),
						'portal_custom_small_bbcode'		=> array('lang' => 'PORTAL_CUSTOM_SMALL_BBCODE'				,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_code_small'			=> array('lang' => 'PORTAL_CUSTOM_CODE_SMALL'				,	'type' => 'textarea:6:6',	 'explain' => true),
						'legend2'								=> 'ACP_PORTAL_CUSTOM_CENTER_SETTINGS',
						'portal_custom_center'				=> array('lang' => 'PORTAL_CUSTOM_CENTER'						,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_center_headline'		=> array('lang' => 'PORTAL_CUSTOM_CENTER_HEADLINE'			,	'validate' => 'string', 'type' => 'text:40:200',	 'explain' => true),
						'portal_custom_center_bbcode'		=> array('lang' => 'PORTAL_CUSTOM_CENTER_BBCODE'			,	'validate' => 'bool',		'type' => 'radio:yes_no',	'explain' => true),
						'portal_custom_code_center'			=> array('lang' => 'PORTAL_CUSTOM_CODE_CENTER'				,	'type' => 'textarea:6:6',	 'explain' => true),
					 )
				);
			break;

			case 'birthdays':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_BIRTHDAYS_SETTINGS',
					'vars'	=> array(
						'legend1'					=> 'ACP_PORTAL_BIRTHDAYS_SETTINGS',
						'portal_birthdays'			=> array('lang' => 'PORTAL_BIRTHDAYS',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_birthdays_ahead'	=> array('lang' => 'PORTAL_BIRTHDAYS_AHEAD',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
					)
				);
			break;

			case 'friends':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_FRIENDS_SETTINGS',
					'vars'	=> array(
						'legend1'					=> 'ACP_PORTAL_FRIENDS_SETTINGS',
						'portal_friends'			=> array('lang' => 'PORTAL_FRIENDS',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain' => true),
						'portal_max_online_friends'	=> array('lang' => 'PORTAL_MAX_ONLINE_FRIENDS',	'validate' => 'int',	'type' => 'text:3:3',		'explain' => true),
					)
				);
			break;
			case 'minicalendar':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_MINICALENDAR_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_MINICALENDAR_SETTINGS',
						'portal_minicalendar'				=> array('lang' => 'PORTAL_MINICALENDAR'					 ,	'validate' => 'bool',	 'type' => 'radio:yes_no',	'explain' => true),
						'portal_minicalendar_today_color'	=> array('lang' => 'PORTAL_MINICALENDAR_TODAY_COLOR'	 ,	'validate' => 'string', 'type' => 'text:10:10',	 'explain' => true),
						'portal_minicalendar_sunday_color'	=> array('lang' => 'PORTAL_MINICALENDAR_SUNDAY_COLOR' ,	'validate' => 'string', 'type' => 'text:10:10',	 'explain' => true),
						'portal_long_month'	=> array('lang' => 'PORTAL_LONG_MONTH' ,	'validate' => 'bool',	'type' => 'radio:yes_no',	 'explain' => true),
						'portal_sunday_first'	=> array('lang' => 'PORTAL_SUNDAY_FIRST' ,	'validate' => 'bool',	'type' => 'radio:yes_no',	 'explain' => true),
					)
				);
			break;
			case 'links':
				$display_vars = array(
					'title'	=> 'ACP_PORTAL_LINKS_SETTINGS',
					'vars'	=> array(
						'legend1'							=> 'ACP_PORTAL_LINKS_SETTINGS',
						'portal_links'						=> array('lang' => 'PORTAL_LINKS', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true),
					)
				);
				// Links require preprocessing
				
				$links = (strlen($portal_config['portal_links_array'])) ? utf_unserialize($portal_config['portal_links_array']) : array() ;
				$this->link_num = sizeof($links);
				
				$lid = request_var('link', 0);

				switch($action)
				{
					case 'delete':
						if($lid > 0)
						{
							if($lid < $this->link_num)
							{
								for($i = $lid+1; $i <= $this->link_num; ++$i)
								{
									$links[$i-1] = $links[$i];
								}
							}
							unset($links[$this->link_num]);
							set_portal_config('portal_links_array', serialize($links));
						}
					break;
					case 'add':
						$this->link_num = $this->link_num + 1;
						$links[$this->link_num] = array('url' => '', 'text' => '');
						set_portal_config('portal_links_array', serialize($links));
					break;
					case 'moveup':
						if($lid > 1 && isset($links[$lid]))
						{
							$temp = $links[$lid];
							$links[$lid] = $links[$lid-1];
							$links[$lid-1] = $temp;
							unset($temp);
							set_portal_config('portal_links_array', serialize($links));
						}
					break;
					case 'movedown':
						if($lid > 0 && $lid < $this->link_num && isset($links[$lid]))
						{
							$temp = $links[$lid];
							$links[$lid] = $links[$lid+1];
							$links[$lid+1] = $temp;
							unset($temp);
							set_portal_config('portal_links_array', serialize($links));
						}
					break;
				}
				
				ksort($links);
				reset($links);
				
				foreach($links as $link_id => $link_data)
				{
					$key = 'portal_link_'.$link_id;
					$display_vars['vars'][$key] = array('lang' => 'PORTAL_LINK_TEXT', 'type' => 'custom', 'method' => 'createLink', 'explain' => true);
					$this->new_config[$key] = array('key' => $link_id, 'text' => $link_data['text'], 'url' => $link_data['url']);
				}
				
				$display_vars['vars']['portal_link_add'] = array('lang' => 'PORTAL_ADD_LINK_TEXT', 'type' => 'custom', 'method' => 'addLink', 'explain' => true);
				$this->new_config['portal_link_add'] = '';
			break;
			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();
		
		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);
		
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}
		if ($submit)
		{
			switch($mode)
			{
				case 'links':
					$links = array();

					for($i = 1; $i <= $this->link_num; ++$i)
					{
						$links[$i] = array(
							'url' => $cfg_array['portal_link_'.$i.'_url'],
							'text' => $cfg_array['portal_link_'.$i.'_text'],
						);
					}					
					$display_vars['vars']['portal_links_array'] = '';
					$cfg_array['portal_links_array'] = serialize($links);
				break;
			}
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') || ($mode == 'links' && strpos($config_name, 'portal_link_') ) !== false)
			{
				continue;
			}
			
			if ($config_name == 'portal_attachments_filetype' || $config_name == 'portal_news_forum' || $config_name == 'portal_global_announcements_forum' || $config_name == 'portal_recent_forum' || $config_name == 'portal_attachments_forum_ids' || $config_name == 'portal_poll_topic_id')
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($submit)
			{
				if (confirm_box(true))
				{
					switch($mode)
					{
						case 'news':
							set_portal_config('portal_news_permissions', 0);
						break;
						case 'announcements':
							set_portal_config('portal_announcements_permissions', 0);
						break;
					}
				}
				elseif(($config_name == 'portal_news_permissions' && $config_value == '0' && $portal_config['portal_news_permissions'] == '1') || ($config_name == 'portal_announcements_permissions' && $config_value == '0' && $portal_config['portal_announcements_permissions'] == '1'))
				{
					$s_hidden_fields = build_hidden_fields(array(
					'i'			=> $id,
					'mode'		=> $mode,
					'submit'	=> $submit,
					));
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], $s_hidden_fields);
				}
				else
				{
					set_portal_config($config_name, $config_value);
				}
			}
		}
		
		if ($submit)
		{
			// Get data from select boxes and store in DB
			switch($mode)
			{
				case 'attachments':
					$this->store_filetypes('portal_attachments_filetype');
					$this->store_selected_forums('portal_attachments_forum_ids');
				break;
				
				case 'news':
					$this->store_selected_forums('portal_news_forum');
				break;
				
				case 'announcements':
					$this->store_selected_forums('portal_global_announcements_forum');
				break;
				
				case 'recent':
					$this->store_selected_forums('portal_recent_forum');
				break;
				
				case 'polls':
					$this->store_selected_forums('portal_poll_topic_id');
				break;
				
				default:
			}
		
			add_log('admin', 'LOG_PORTAL_CONFIG', $user->lang['ACP_PORTAL_' . strtoupper($mode) . '_INFO']);
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$this->tpl_name = 'acp_portal';
		$this->page_title = $display_vars['title'];

		$title_explain = $user->lang[$display_vars['title'] . '_EXPLAIN'];

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $title_explain,

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'S_VERSIONCHECK'	=> ($display_vars['title'] == 'ACP_PORTAL_GENERAL_TITLE') ? true : false,

			'U_ACTION'			=> $this->u_action,
			'BLOCK_CHANGE_WARN' => $user->lang['BLOCK_CHANGE_WARN'],
		));

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
	
	function createLink($value, $key)
	{
		global $user, $phpEx, $phpbb_admin_path;
		$icon_up		=	'<a href="'.append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=links&amp;action=moveup&amp;link='.$value['key']).'"><img src="' . $phpbb_admin_path . 'images/icon_up.gif" alt="' . $user->lang['MOVE_UP'] . '" title="' . $user->lang['MOVE_UP'] . '" /></a>';
		$icon_up_d		=	'<img src="' . $phpbb_admin_path . 'images/icon_up_disabled.gif" alt="' . $user->lang['MOVE_UP'] . '" title="' . $user->lang['MOVE_UP'] . '" />';
		$icon_down		=	'<a href="'.append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=links&amp;action=movedown&amp;link='.$value['key']).'"><img src="' . $phpbb_admin_path . 'images/icon_down.gif" alt="' . $user->lang['MOVE_DOWN'] . '" title="' . $user->lang['MOVE_DOWN'] . '" /></a>';
		$icon_down_d	=	'<img src="' . $phpbb_admin_path . 'images/icon_down_disabled.gif" alt="' . $user->lang['MOVE_DOWN'] . '" title="' . $user->lang['MOVE_DOWN'] . '" />';
		$icon_del		=	'<a href="'.append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=links&amp;action=delete&amp;link='.$value['key']).'"><img src="' . $phpbb_admin_path . 'images/icon_delete.gif" alt="' . $user->lang['DELETE'] . '" title="' . $user->lang['DELETE'] . '" /></a>';

		return '<input id="' . $key . '_text" type="text" size="40" maxlength="255" name="config[' . $key . '_text]" value="' . $value['text'] . '" /> <input id="' . $key . '_url" type="text" size="40" maxlength="255" name="config[' . $key . '_url]" value="' . $value['url'] . '" /> ' . $icon_del . ' ' . (($value['key'] < $this->link_num) ? $icon_down : $icon_down_d) . ' ' . (($value['key'] > 1) ? $icon_up : $icon_up_d);
	}
	
	function addLink($value, $key)
	{
		global $user, $phpEx, $phpbb_admin_path;
		
		$link = append_sid("{$phpbb_admin_path}index.$phpEx", 'i=portal&amp;mode=links&amp;action=add');
		
		return '<a href="'.$link.'">'.$user->lang['PORTAL_LINK_ADD'].'</a>';
	}
	
	// Create select box for attachment filetype
	function select_filetype($value, $key)
	{
		global $db, $user, $config, $portal_config;
		
		// Get extensions
		$sql = 'SELECT *
			FROM ' . EXTENSIONS_TABLE . '
			ORDER BY extension ASC';
		$result = $db->sql_query($sql);
		
		while ($row = $db->sql_fetchrow($result))
		{
			$extensions[] = $row;
		}
		
		$selected = array();
		if(isset($portal_config['portal_attachments_filetype']) && strlen($portal_config['portal_attachments_filetype']) > 0)
		{
			$selected = explode(',', $portal_config['portal_attachments_filetype']);
		}
		
		// Build options
		$ext_options = '<select id="' . $key . '" name="' . $key . '[]" multiple="multiple">';
		foreach ($extensions as $id => $ext)
		{
			$ext_options .= '<option value="' . $ext['extension'] . '"' . ((in_array($ext['extension'], $selected)) ? ' selected="selected"' : '') . '>' . $ext['extension'] . '</option>';
		}
		$ext_options .= '</select>';
		
		return $ext_options;
	}
	
	// Store selected filetypes
	function store_filetypes($key)
	{
		global $db, $cache;
		
		// Get selected extensions
		$values = request_var($key, array(0 => ''));
		
		$filetypes = implode(',', $values);
		
		set_portal_config('portal_attachments_filetype', $filetypes);

	}
	
	// Create forum select box
	function select_forums($value, $key)
	{
		global $user, $config, $portal_config;

		$forum_list = make_forum_select(false, false, true, true, true, false, true);
		
		$selected = array();
		if(isset($portal_config[$key]) && strlen($portal_config[$key]) > 0)
		{
			$selected = explode(',', $portal_config[$key]);
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
	function store_selected_forums($key)
	{
		global $db, $cache;
		
		// Get selected extensions
		$values = request_var($key, array(0 => ''));
		
		$news = implode(',', $values);
		
		set_portal_config($key, $news);
	
	}
}

function utf_unserialize($serial_str) {
    $out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
    return unserialize($out);   
}
?>