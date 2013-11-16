<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace board3\portal\modules;

/**
* @package Statistics
*/
class statistics extends module_base
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
	public $name = 'STATISTICS';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_statistics.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_statistics_module';

	/**
	* custom acp template
	* file must be in "adm/style/portal/"
	*/
	public $custom_acp_tpl = '';

	/** @var \phpbb\cache */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver */
	protected $db;

	/** @var \phpbb\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Construct a search object
	*
	* @param \phpbb\cache $cache phpBB cache system
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\db\driver $db phpBB database system
	* @param \phpbb\template $template phpBB template
	* @param \phpbb\user $user phpBB user object
	*/
	public function __construct($cache, $config, $db, $template, $user)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* @inheritdoc
	*/
	public function get_template_side($module_id)
	{
		// Set some stats, get posts count from forums data if we... hum... retrieve all forums data
		$total_posts		= $this->config['num_posts'];
		$total_topics		= $this->config['num_topics'];
		$total_users		= $this->config['num_users'];
		$total_files 		= $this->config['num_files'];

		$l_total_user_s 	= ($total_users == 0) ? sprintf($this->user->lang['TOTAL_USERS_ZERO'], $total_users) : sprintf($this->user->lang['TOTAL_USERS'][2], $total_users);
		$l_total_post_s 	= ($total_posts == 0) ? sprintf($this->user->lang['TOTAL_POSTS_ZERO'], $total_posts) : sprintf($this->user->lang['TOTAL_POSTS_COUNT'][2], $total_posts);
		$l_total_topic_s	= ($total_topics == 0) ? sprintf($this->user->lang['TOTAL_TOPICS_ZERO'], $total_topics) : sprintf($this->user->lang['TOTAL_TOPICS'][2], $total_topics);

		// avarage stat
		$board_days = (time() - $this->config['board_startdate']) / 86400;

		$topics_per_day		= ($total_topics) ? round($total_topics / $board_days, 0) : 0;
		$posts_per_day		= ($total_posts) ? round($total_posts / $board_days, 0) : 0;
		$users_per_day		= round($total_users / $board_days, 0);
		$topics_per_user	= ($total_topics) ? round($total_topics / $total_users, 0) : 0;
		$posts_per_user		= ($total_posts) ? round($total_posts / $total_users, 0) : 0;
		$posts_per_topic	= ($total_topics) ? round($total_posts / $total_topics, 0) : 0;

		if ($topics_per_day > $total_topics)
		{
			$topics_per_day = $total_topics;
		}

		if ($posts_per_day > $total_posts)
		{
			$posts_per_day = $total_posts;
		}

		if ($users_per_day > $total_users)
		{
			$users_per_day = $total_users;
		}

		if ($topics_per_user > $total_topics)
		{
			$topics_per_user = $total_topics;
		}

		if ($posts_per_user > $total_posts)
		{
			$posts_per_user = $total_posts;
		}

		if ($posts_per_topic > $total_posts)
		{
			$posts_per_topic = $total_posts;
		}

		$l_topics_per_day_s = ($total_topics == 0) ? 'TOPICS_PER_DAY_ZERO' : 'TOPICS_PER_DAY_OTHER';
		$l_posts_per_day_s = ($total_posts == 0) ? 'POSTS_PER_DAY_ZERO' : 'POSTS_PER_DAY_OTHER';
		$l_users_per_day_s = ($total_users == 0) ? 'USERS_PER_DAY_ZERO' : 'USERS_PER_DAY_OTHER';
		$l_topics_per_user_s = ($total_topics == 0) ? 'TOPICS_PER_USER_ZERO' : 'TOPICS_PER_USER_OTHER';
		$l_posts_per_user_s = ($total_posts == 0) ? 'POSTS_PER_USER_ZERO' : 'POSTS_PER_USER_OTHER';
		$l_posts_per_topic_s = ($total_posts == 0) ? 'POSTS_PER_TOPIC_ZERO' : 'POSTS_PER_TOPIC_OTHER';

		$topics_count = $this->get_topics_count();

		// Assign specific vars
		$this->template->assign_vars(array(
			'B3_TOTAL_POSTS'				=> $l_total_post_s,
			'B3_TOTAL_TOPICS'				=> $l_total_topic_s,
			'B3_TOTAL_USERS'				=> $l_total_user_s,
			'B3_NEWEST_USER'				=> sprintf($this->user->lang['NEWEST_USER'], get_username_string('full', $this->config['newest_user_id'], $this->config['newest_username'], $this->config['newest_user_colour'])),
			'B3_ANNOUNCE_COUNT'				=> $topics_count[POST_ANNOUNCE],
			'B3_STICKY_COUNT'				=> $topics_count[POST_STICKY],
			'B3_TOTAL_ATTACH'				=> ($this->config['allow_attachments']) ? $total_files : 0,

			// average stat
			'B3_TOPICS_PER_DAY'		=> sprintf($this->user->lang[$l_topics_per_day_s], $topics_per_day),
			'B3_POSTS_PER_DAY'		=> sprintf($this->user->lang[$l_posts_per_day_s], $posts_per_day),
			'B3_USERS_PER_DAY'		=> sprintf($this->user->lang[$l_users_per_day_s], $users_per_day),
			'B3_TOPICS_PER_USER'	=> sprintf($this->user->lang[$l_topics_per_user_s], $topics_per_user),
			'B3_POSTS_PER_USER'		=> sprintf($this->user->lang[$l_posts_per_user_s], $posts_per_user),
			'B3_POSTS_PER_TOPIC'	=> sprintf($this->user->lang[$l_posts_per_topic_s], $posts_per_topic),
		));
		return 'statistics_side.html';
	}

	/**
	* @inheritdoc
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'STATISTICS',
			'vars'	=> array(),
		);
	}

	/**
	* Get topics count by type
	*
	* @return array	Topics count array with type in array keys and count
	*		in array values
	*/
	public function get_topics_count()
	{
		if (($return_ary = $this->cache->get('_b3p_topics_type_count')) === false)
		{
			$return_ary = array(
				POST_ANNOUNCE => 0,
				POST_STICKY => 0,
			);

			$sql_in = array(
				POST_ANNOUNCE,
				POST_STICKY,
			);

			$sql = 'SELECT DISTINCT(topic_id) AS topic_id, topic_type AS type
						FROM ' . TOPICS_TABLE . '
						WHERE ' . $this->db->sql_in_set('topic_type', $sql_in, false);
			$result = $this->db->sql_query($sql);
			while ($row = $this->db->sql_fetchrow($result))
			{
				switch ($row['type'])
				{
					case POST_ANNOUNCE:
						++$return_ary[POST_ANNOUNCE];
					break;

					case POST_STICKY:
						++$return_ary[POST_STICKY];
					break;
				}
			}
			$this->db->sql_freeresult($result);

			// cache topics type count for 1 hour
			$this->cache->put('_b3p_topics_type_count', $return_ary, 3600);
		}

		return $return_ary;
	}
}
