<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\portal;

class fetch_posts
{
	/**
	* phpBB auth
	* @var \phpbb\auth\auth
	*/
	protected $auth;

	/**
	* phpBB cache
	* @var \phpbb\cache\driver\driver_interface
	*/
	protected $cache;

	/**
	* phpBB config
	* @var \phpbb\config\config
	*/
	protected $config;

	/**
	* phpBB db driver
	* @var \phpbb\db\driver\driver_interface
	*/
	protected $db;

	/**
	* Modules helper
	* @var \board3\portal\includes\modules_helper
	*/
	protected $modules_helper;

	/**
	* phpBB user
	* @var \phpbb\user
	*/
	protected $user;

	/**
	* SQL Query where constraint
	* @var string
	*/
	protected $where_string = '';

	/**
	* SQL topic type constraint
	* @var string
	*/
	protected $topic_type = '';

	/**
	* SQL user link constraint
	* @var string
	*/
	protected $user_link = '';

	/**
	* SQL post link constraint
	* @var string
	*/
	protected $post_link = '';

	/**
	* SQL topic order constraint
	* @var string
	*/
	protected $topic_order = '';

	/**
	* Module ID
	* @var int
	*/
	protected $module_id;

	/**
	* Forum ID to use for global topics
	* @var int
	*/
	protected $global_id;

	/**
	* Type of posts to fetch
	* @var string
	*/
	protected $type;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	* @param \phpbb\auth\auth			$auth	phpBB auth object
	* @param \phpbb\cache\driver			$cache	phpBB cache driver
	* @param \phpbb\config\config			$config	phpBB config
	* @param \phpbb\db\driver_interface		$db	phpBB database driver
	* @param \board3\portal\includes\modules_helper	$modules_helper Board3 modules helper
	* @param \phpbb\user				$user	phpBB user object
	*/
	public function __construct($auth, $cache, $config, $db, $modules_helper, $user)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->modules_helper = $modules_helper;
		$this->user = $user;
	}

	/**
	* Get posts defined by type and other settings
	*
	* @param string $forum_from Forums from which the posts should be retrieved
	* @param bool $permissions Whether permissions should be taken into account
	* 					during retrieval
	* @param int $number_of_posts Number of posts to get
	* @param int $text_length Length the text should be shortened to
	* @param int $time The amount of days ago the posts could have been posted
	* @param string $type Type of posts to get
	* @param int $start At which position the query should start
	* @param bool $invert Whether the permissions should be inverted
	*
	* @return array An array containing the posts that were retrieved from the database
	*/
	public function get_posts($forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start = 0, $invert = false)
	{
		$posts = array();
		$post_time = $this->get_setting_based_data($time == 0, '', 'AND t.topic_time > ' . (time() - $time * 86400));
		$forum_from = $this->get_setting_based_data(strpos($forum_from, ',') !== false, explode(',', $forum_from), $this->get_setting_based_data($forum_from != '', array($forum_from), array()));
		$topic_icons = array(0);
		$have_icons = 0;
		$this->global_id = 0;
		$this->type = $type;
		$this->reset_constraints();

		// Get disallowed forums
		$disallow_access = $this->modules_helper->get_disallowed_forums($permissions);

		// Set forums that should be excluded or included
		if (!$this->set_forum_constraints($forum_from, $disallow_access, $invert))
		{
			return array();
		}

		// Get SQL constraints
		$this->get_type_constraints();

		// Get global forum ID for announcements
		if (!$this->get_global_id())
		{
			return array();
		}

		$result = $this->run_sql_query($post_time, $number_of_posts, $start);

		$i = 0;

		// Fill posts array
		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->fill_posts_array($row, $text_length, $i, $have_icons, $posts, $topic_icons);
			++$i;
		}
		$this->db->sql_freeresult($result);

		$posts['topic_icons'] = $this->get_setting_based_data(max($topic_icons) > 0 && $have_icons, true, false);
		$posts['topic_count'] = $i;

		if ($this->global_id < 1)
		{
			return array();
		}
		else
		{
			return $posts;
		}
	}

	/**
	* Run SQL query for fetching posts from database
	*
	* @param int	$post_time		Post time
	* @param int	$number_of_posts	Number of posts to fetch
	* @param int	$start			Start of query
	*
	* @return int Result pointer
	*/
	protected function run_sql_query($post_time, $number_of_posts, $start)
	{
		$sql_array = array(
			'SELECT' => 't.forum_id,
				t.topic_id,
				t.topic_last_post_id,
				t.topic_last_post_time,
				t.topic_time,
				t.topic_title,
				t.topic_attachment,
				t.topic_views,
				t.poll_title,
				t.topic_posts_approved,
				t.topic_posts_unapproved,
				t.topic_posts_softdeleted,
				t.topic_poster,
				t.topic_type,
				t.topic_status,
				t.topic_last_poster_name,
				t.topic_last_poster_id,
				t.topic_last_poster_colour,
				t.icon_id,
				u.username,
				u.user_id,
				u.user_type,
				u.user_colour,
				p.post_id,
				p.poster_id,
				p.post_time,
				p.post_text,
				p.post_attachment,
				p.post_username,
				p.enable_smilies,
				p.enable_bbcode,
				p.enable_magic_url,
				p.bbcode_bitfield,
				p.bbcode_uid,
				f.forum_name,
				f.enable_icons',
			'FROM' => array(
				TOPICS_TABLE => 't',
			),
			'LEFT_JOIN' => array(
				array(
					'FROM' => array(USERS_TABLE => 'u'),
					'ON' => $this->user_link,
				),
				array(
					'FROM' => array(FORUMS_TABLE => 'f'),
					'ON' => 't.forum_id=f.forum_id',
				),
				array(
					'FROM' => array(POSTS_TABLE => 'p'),
					'ON' => $this->post_link,
				),
			),
			'WHERE' => $this->topic_type . '
					' . $post_time . '
					AND t.topic_status <> ' . ITEM_MOVED . '
					AND t.topic_visibility = 1
					AND t.topic_moved_id = 0
					' . $this->where_string,
			'ORDER_BY' => $this->topic_order,
		);

		$sql_array['LEFT_JOIN'][] = array('FROM' => array(TOPICS_POSTED_TABLE => 'tp'), 'ON' => 'tp.topic_id = t.topic_id AND tp.user_id = ' . $this->user->data['user_id']);
		$sql_array['SELECT'] .= ', tp.topic_posted';
		$sql = $this->db->sql_build_query('SELECT', $sql_array);

		// Cache queries for 30 seconds
		if ($number_of_posts != 0)
		{
			$result = $this->db->sql_query_limit($sql, $number_of_posts, $start, 600);
		}
		else
		{
			$result = $this->db->sql_query($sql, 30);
		}

		return $result;
	}

	/**
	 * Fill posts array with data
	 *
	 * @param array $row Database row
	 * @param int $text_length Text length
	 * @param int $i Array pointer
	 * @param int $have_icons Whether any post has icons
	 * @param array $posts The posts array
	 * @param array $topic_icons List of topic icons
	 */
	public function fill_posts_array($row, $text_length, $i, &$have_icons, &$posts, &$topic_icons)
	{
		$update_count = array();

		// Get attachments
		$attachments = $this->get_post_attachments($row);

		$posts[$i]['bbcode_uid'] = $row['bbcode_uid'];

		// Format message
		$message = $this->format_message($row, $text_length, $posts[$i]['striped']);

		$row['bbcode_options'] = $this->get_setting_based_data($row['enable_bbcode'], OPTION_FLAG_BBCODE, 0) + $this->get_setting_based_data($row['enable_smilies'], OPTION_FLAG_SMILIES, 0) + $this->get_setting_based_data($row['enable_magic_url'], OPTION_FLAG_LINKS, 0);
		$message = generate_text_for_display($message, $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']);

		if (!empty($attachments))
		{
			parse_attachments($row['forum_id'], $message, $attachments, $update_count);
		}

		// Get proper global ID
		$this->global_id = $this->get_setting_based_data($this->global_id, $this->global_id, $row['forum_id']);

		$topic_icons[] = $row['enable_icons'];
		$have_icons = $this->get_setting_based_data($row['icon_id'], 1, $have_icons);

		$posts[$i] = array_merge($posts[$i], array(
			'post_text'				=> ap_validate($message),
			'topic_id'				=> $row['topic_id'],
			'topic_last_post_id'	=> $row['topic_last_post_id'],
			'topic_type'			=> $row['topic_type'],
			'topic_posted'			=> $this->get_setting_based_data(isset($row['topic_posted']) && $row['topic_posted'], true, false),
			'icon_id'				=> $row['icon_id'],
			'topic_status'			=> $row['topic_status'],
			'forum_id'				=> $row['forum_id'],
			'topic_replies'			=> $row['topic_posts_approved'] + $row['topic_posts_unapproved'] + $row['topic_posts_softdeleted'] - 1,
			'topic_replies_real'	=> $row['topic_posts_approved'] - 1,
			'topic_time'			=> $this->user->format_date($row['post_time']),
			'topic_last_post_time'	=> $row['topic_last_post_time'],
			'topic_title'			=> $row['topic_title'],
			'username'				=> $row['username'],
			'username_full'			=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['post_username']),
			'username_full_last'	=> get_username_string('full', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour'], $row['topic_last_poster_name']),
			'user_id'				=> $row['user_id'],
			'user_type'				=> $row['user_type'],
			'user_colour'			=> $row['user_colour'],
			'poll'					=> $this->get_setting_based_data($row['poll_title'], true, false),
			'attachment'			=> $this->get_setting_based_data($row['topic_attachment'], true, false),
			'topic_views'			=> $row['topic_views'],
			'forum_name'			=> $row['forum_name'],
			'attachments'			=> $this->get_setting_based_data($attachments, $attachments, array()),
		));
		$posts['global_id'] = $this->global_id;
	}

	/**
	* Get type constraints for database query
	*
	* @return null
	* @throws \InvalidArgumentexception If unknown type is used
	*/
	protected function get_type_constraints()
	{
		switch ($this->type)
		{
			case "announcements":
				$this->get_announcements_constraints();
			break;
			case "news":
				$this->get_news_constraints();
			break;
			case "news_all":
				$this->get_news_all_constraints();
			break;

			default:
				// Method was called with unsupported type
				throw new \InvalidArgumentexception($this->user->lang('B3P_WRONG_METHOD_CALL', __FUNCTION__));
		}
	}

	/**
	* Get type constraints for announcements
	*
	* @return null
	*/
	protected function get_announcements_constraints()
	{
		$this->topic_type = '((t.topic_type = ' . POST_ANNOUNCE . ') OR (t.topic_type = ' . POST_GLOBAL . '))';
		$this->where_string = (strlen($this->where_string) > 0) ? 'AND (t.forum_id = 0 OR (' . trim(substr($this->where_string, 0, -4)) . '))' : '';
		$this->user_link = 't.topic_poster = u.user_id';
		$this->post_link = 't.topic_first_post_id = p.post_id';
		$this->topic_order = 't.topic_time DESC';
	}

	/**
	* Get type constraints for news
	*
	* @return null
	*/
	protected function get_news_constraints()
	{
		$this->topic_type = 't.topic_type = ' . POST_NORMAL;
		$this->where_string = (strlen($this->where_string) > 0) ? 'AND (' . trim(substr($this->where_string, 0, -4)) . ')' : '';
		$this->user_link = $this->get_setting_based_data($this->config['board3_news_style_' . $this->module_id], 't.topic_poster = u.user_id', $this->get_setting_based_data($this->config['board3_news_show_last_' . $this->module_id], 't.topic_last_poster_id = u.user_id', 't.topic_poster = u.user_id')) ;
		$this->post_link = $this->get_setting_based_data($this->config['board3_news_style_' . $this->module_id], 't.topic_first_post_id = p.post_id', $this->get_setting_based_data($this->config['board3_news_show_last_' . $this->module_id], 't.topic_last_post_id = p.post_id', 't.topic_first_post_id = p.post_id'));
		$this->topic_order = $this->get_setting_based_data($this->config['board3_news_show_last_' . $this->module_id], 't.topic_last_post_time DESC', 't.topic_time DESC');
	}

	/**
	* Get additional type constraints for all news
	* Overwrites topic type of get_news_constraints().
	*
	* @return null
	*/
	protected function get_news_all_constraints()
	{
		$this->get_news_constraints();
		$this->topic_type = '(t.topic_type <> ' . POST_ANNOUNCE . ') AND (t.topic_type <> ' . POST_GLOBAL . ')';
	}

	/**
	* Set module id
	*
	* @param	int	$module_id	Module ID
	* @return null
	*/
	public function set_module_id($module_id)
	{
		$this->module_id = $module_id;
	}

	/**
	* Set forums to exclude or include
	*
	* @param	array	$forum_from	Forums that should be shown or
	*					excluded from being shown
	* @param	array	$disallowed_forums	Forums that user is not
	*					allowed to see
	* @param	bool	$invert		Whether forum IDs in forum_from
	*					should be used for excluding or
	*					including forums
	* @return bool True if valid constraints were generated, false if not
	*/
	protected function set_forum_constraints($forum_from, $disallowed_forums, $invert = false)
	{
		if ($invert == true || empty($forum_from))
		{
			$access_list = array_merge($disallowed_forums, $forum_from);
			$sql_operator = '<>';
			$sql_append = 'AND';
		}
		else
		{
			$access_list = array_diff($forum_from, $disallowed_forums);
			$sql_operator = '=';
			$sql_append = 'OR';

			if (empty($access_list) && !empty($forum_from))
			{
				return false;
			}
		}

		// Generate where string
		$this->generate_where_string($access_list, $sql_operator, $sql_append);

		return true;
	}

	/**
	* Generate where string for database query
	*
	* @param	array	$access_list	Array containing the forum IDs
	*					the user has access to
	* @param	string	$sql_operator	The sql operator to use
	* @param	string	$sql_append	The sql append type to use.
	*					Should be either AND or OR
	* @return null
	*/
	protected function generate_where_string($access_list, $sql_operator, $sql_append)
	{
		foreach ($access_list as $acc_id)
		{
			$acc_id = (int) $acc_id;
			$this->where_string .= 't.forum_id ' . $sql_operator . " $acc_id $sql_append ";
			if ($sql_operator === '=' && $this->type == 'announcements' && $this->global_id < 1 && $acc_id > 0)
			{
				$this->global_id = $acc_id;
			}
		}
	}

	/**
	* Gets the a global forum ID for global announcements
	*
	* @return bool True if proper ID was selected, false if not
	*/
	protected function get_global_id()
	{
		if ($this->type == 'announcements' && $this->global_id < 1)
		{
			if (!empty($this->where_string) || ($row = $this->cache->get('_forum_id_first_forum_post')) === false)
			{
				$row = $this->get_first_forum_id();
			}

			if (empty($row))
			{
				return false;
			}
			$this->global_id = $row['forum_id'];
		}

		return true;
	}

	/**
	* Gets the first forum_id of FORUM_POST type forums
	*
	* @return array Database row of query
	*/
	protected function get_first_forum_id()
	{
		$sql = 'SELECT forum_id
			FROM ' . FORUMS_TABLE . '
			WHERE forum_type = ' . FORUM_POST . '
			' . str_replace('t.', '', $this->where_string) . '
			ORDER BY forum_id';
		$result = $this->db->sql_query_limit($sql, 1);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if (empty($this->where_string))
		{
			// Cache first forum ID for one day = 86400 s
			$this->cache->put('_forum_id_first_forum_post', $row, 86400);
		}

		return $row;
	}

	/**
	* Resets constraints that might have been set before
	*
	* @return null
	*/
	protected function reset_constraints()
	{
		$this->where_string = '';
	}

	/**
	 * Get valid data based on setting
	 *
	 * @param mixed $setting Setting to check
	 * @param mixed $setting_true Data if setting is 'on' (not empty)
	 * @param mixed $setting_false Data if setting is 'off' (empty or 0)
	 *
	 * @return mixed Valid data based on setting
	 */
	protected function get_setting_based_data($setting, $setting_true, $setting_false)
	{
		return (!empty($setting)) ? $setting_true : $setting_false;
	}

	/**
	 * Assert that all supplied arguments evaluate to true
	 *
	 * @return bool True if all evaluate to true, false if not
	 */
	protected function assert_all_true()
	{
		$args = func_get_args();
		$return = true;

		foreach ($args as $argument)
		{
			$return = $return && $argument;
		}

		return $return;
	}

	/**
	 * Get attachments of posts
	 *
	 * @param array $row Database row of post
	 *
	 * @return array Attachment data
	 */
	protected function get_post_attachments($row)
	{
		$attachments = array();

		if ($this->user_can_download($row['forum_id']) && $this->assert_all_true($this->config['allow_attachments'], $row['post_id'], $row['post_attachment']))
		{
			// Pull attachment data
			$sql = 'SELECT *
					FROM ' . ATTACHMENTS_TABLE . '
					WHERE post_msg_id = '. (int) $row['post_id'] .'
					AND in_message = 0
					ORDER BY filetime DESC';
			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$attachments[] = $row;
			}
			$this->db->sql_freeresult($result);
		}

		return $attachments;
	}

	/**
	 * Check if user can download a file in this forum
	 *
	 * @param int $forum_id Forum ID to check
	 *
	 * @return bool True if user can download, false if not
	 */
	protected function user_can_download($forum_id)
	{
		return $this->auth->acl_get('u_download') && ($this->auth->acl_get('f_download', $forum_id) || $forum_id == 0);
	}

	/**
	 * Format message for display
	 *
	 * @param array $row Database row
	 * @param int $text_length Length of text
	 * @param bool $posts_striped Whether post is striped
	 *
	 * @return mixed|string
	 */
	protected function format_message($row, $text_length, &$posts_striped)
	{
		if ($text_length > 0 && (strlen($row['post_text']) > $text_length))
		{
			$message = str_replace(array("\n", "\r"), array('<br />', "\n"), $row['post_text']);
			$message = $this->shorten_message($message, $row['bbcode_uid'], $text_length);
			$posts_striped = true;
		}
		else
		{
			$message = str_replace("\n", '<br/> ', $row['post_text']);
		}

		return $message;
	}

	/**
	 * Shorten message to specified length
	 *
	 * @param string $message Post text
	 * @param string $bbcode_uid BBCode UID
	 * @param int $length Length the text should have after shortening
	 *
	 * @return string Shortened messsage
	 */
	public function shorten_message($message, $bbcode_uid, $length)
	{
		if (class_exists('\Nickvergessen\TrimMessage\TrimMessage'))
		{
			$trim = new \Nickvergessen\TrimMessage\TrimMessage($message, $bbcode_uid, $length);
			$message = $trim->message();
			unset($trim);
		}

		return $message;
	}
}
