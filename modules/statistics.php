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

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var double Board days */
	protected $board_days;

	/**
	* Construct a search object
	*
	* @param \phpbb\cache\service $cache phpBB cache system
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\db\driver\driver_interface $db phpBB database system
	* @param \phpbb\template\template $template phpBB template
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
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		// Get totals language strings
		$l_total_user_s = $this->get_totals_language($this->config['num_users'], 'TOTAL_USERS');
		$l_total_post_s = $this->get_totals_language($this->config['num_posts'], 'TOTAL_POSTS', 'TOTAL_POSTS_COUNT');
		$l_total_topic_s = $this->get_totals_language($this->config['num_topics'], 'TOTAL_TOPICS');

		// Average statistics
		$this->board_days = (double) ((time() - $this->config['board_startdate']) / 86400);

		$topics_per_day		= round($this->config['num_topics'] / $this->board_days, 0);
		$posts_per_day		= round($this->config['num_posts'] / $this->board_days, 0);
		$users_per_day		= round($this->config['num_users'] / $this->board_days, 0);
		$topics_per_user	= round($this->config['num_topics'] / $this->config['num_users'], 0);
		$posts_per_user		= round($this->config['num_posts'] / $this->config['num_users'], 0);
		$posts_per_topic	= ($this->config['num_topics']) ? round($this->config['num_posts'] / $this->config['num_topics'], 0) : 0;

		// Mitigate incorrect averages on first day
		$topics_per_day = $this->get_first_day_average($topics_per_day, $this->config['num_topics']);
		$posts_per_day = $this->get_first_day_average($posts_per_day, $this->config['num_posts']);
		$users_per_day = $this->get_first_day_average($users_per_day, $this->config['num_users']);
		$topics_per_user = $this->get_first_day_average($topics_per_user, $this->config['num_topics']);
		$posts_per_user = $this->get_first_day_average($posts_per_user, $this->config['num_topics']);
		$posts_per_topic = $this->get_first_day_average($posts_per_topic, $this->config['num_posts']);

		// Get language variables for averages
		$l_topics_per_day_s = $this->get_average_language($this->config['num_topics'], 'TOPICS_PER_DAY');
		$l_posts_per_day_s = $this->get_average_language($this->config['num_posts'], 'POSTS_PER_DAY');
		$l_users_per_day_s = $this->get_average_language($this->config['num_users'], 'USERS_PER_DAY');
		$l_topics_per_user_s = $this->get_average_language($this->config['num_topics'], 'TOPICS_PER_USER');
		$l_posts_per_user_s = $this->get_average_language($this->config['num_posts'], 'POSTS_PER_USER');
		$l_posts_per_topic_s = $this->get_average_language($this->config['num_posts'], 'POSTS_PER_TOPIC');

		$topics_count = $this->get_topics_count();

		// Assign specific vars
		$this->template->assign_vars(array(
			'B3_TOTAL_POSTS'				=> $l_total_post_s,
			'B3_TOTAL_TOPICS'				=> $l_total_topic_s,
			'B3_TOTAL_USERS'				=> $l_total_user_s,
			'B3_NEWEST_USER'				=> sprintf($this->user->lang['NEWEST_USER'], get_username_string('full', $this->config['newest_user_id'], $this->config['newest_username'], $this->config['newest_user_colour'])),
			'B3_ANNOUNCE_COUNT'				=> $topics_count[POST_ANNOUNCE],
			'B3_STICKY_COUNT'				=> $topics_count[POST_STICKY],
			'B3_TOTAL_ATTACH'				=> ($this->config['allow_attachments']) ? $this->config['num_files'] : 0,

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
	* {@inheritdoc}
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

	/**
	 * Get correct average per day on first day.
	 * The per day average will be higher than the total amount. This will
	 * result in incorrect statistics.
	 *
	 * @param int $average Average per day
	 * @param int $total Total value
	 *
	 * @return int Corrected average per day, if correction was necessary
	 */
	protected function get_first_day_average($average, $total)
	{
		return ($average > $total) ? $total : $average;
	}

	/**
	 * Get language string for totals
	 *
	 * @param int $total The total value
	 * @param string $language_variable Language variable of the total
	 * @param string $count_language_variable Optional language variable for count
	 *
	 * @return string Language string for total
	 */
	protected function get_totals_language($total, $language_variable, $count_language_variable = '')
	{
		if ($count_language_variable === '')
		{
			$count_language_variable = $language_variable;
		}

		return ($total == 0) ? sprintf($this->user->lang[$language_variable . '_ZERO'], $total) : sprintf($this->user->lang[$count_language_variable][2], $total);
	}

	/**
	 * Get language variable for averages
	 *
	 * @param int $total The total value
	 * @param string $language_variable Language variable of the total
	 *
	 * @return string Language string for total
	 */
	protected function get_average_language($total, $language_variable)
	{
		return ($total == 0) ? $language_variable . '_ZERO' : $language_variable . '_OTHER';
	}
}
