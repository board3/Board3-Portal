<?php
/**
*
* @package Board3 Portal Testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../../../../includes/functions_acp.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/functions.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/utf/utf_tools.php');
require_once(dirname(__FILE__) . '/../../../vendor/marc1706/phpbb-text-shortener/src/Shortener.php');
require_once(dirname(__FILE__) . '/../../../vendor/marc1706/phpbb-text-shortener/src/Helper.php');
require_once(dirname(__FILE__) . '/../../../vendor/marc1706/phpbb-text-shortener/src/TextIterator.php');


class phpbb_portal_fetch_posts_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $default_main_columns = array('topic_count', 'global_id', 'topic_icons');
	protected $fetch_posts;

	public function setUp(): void
	{
		global $auth, $cache, $phpbb_dispatcher, $phpbb_root_path, $phpEx, $template, $user;

		parent::setUp();

		$this->language_file_loader = new \phpbb\language\language_file_loader($phpbb_root_path, 'php');
		$this->language = new \phpbb\language\language($this->language_file_loader);
		$user = new \phpbb\user($this->language, '\phpbb\datetime');
		$user->data['user_id'] = 2;
		$user->timezone = new \DateTimeZone('UTC');
		$user->add_lang('common');
		$user->add_lang('../../ext/board3/portal/language/en/portal');
		$phpbb_dispatcher = new phpbb_mock_event_dispatcher();
		$cache = $this->getMockBuilder('\phpbb\cache\driver\dummy')
			->setMethods(['obtain_word_list', 'get', 'sql_exists', 'put', 'obtain_attach_extensions', 'sql_load', 'sql_save'])
			->getMock();
		$cache->expects($this->any())
			->method('obtain_word_list')
			->with()
			->will($this->returnValue(array()));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(false));
		$cache->expects($this->any())
			->method('sql_load')
			->with($this->anything())
			->will($this->returnValue(false));
		$cache->expects($this->any())
			->method('sql_save')
			->with($this->anything())
			->will($this->returnArgument(2));
		require_once(dirname(__FILE__) . '/../../../../../../includes/functions_content.php');
		$this->config = new \phpbb\config\config(array('allow_attachments' => 1));
		$auth = new \phpbb\auth\auth();
		$userdata = array(
			'user_id'	=> 2,
		);
		$auth->acl($userdata);
		// Pretend to allow downloads
		$auth->acl[0][0] = true;
		// Pretend to allow downloads in forum 1
		$auth->acl[1][0] = true;
		$this->auth = $auth;
		$controller_helper = new \board3\portal\tests\mock\controller_helper($phpbb_root_path, $phpEx);
		$controller_helper->add_route('board3_portal_controller', 'portal');
		$this->modules_helper = new \board3\portal\includes\modules_helper($auth, $this->config, $controller_helper, new phpbb_mock_request());
		$this->user = $user;
		$template = $this->getMockBuilder('\phpbb\template')
			->setMethods(['set_filenames', 'destroy_block_vars', 'assign_block_vars', 'assign_display'])
			->getMock();
		$this->fetch_posts = new \board3\portal\portal\fetch_posts($auth, $cache, $this->config, $this->db, $this->modules_helper, $user);
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/news.xml');
	}

	public function data_phpbb_fetch_news()
	{
		return array(
			array('news', array(
				'forum_id',
				'topic_id',
				'topic_last_post_time',
				'topic_replies',
				'topic_replies_real',
				'topic_type',
				'topic_status',
				'topic_posted',
				'attachment',
				'forum_name',
				'topic_title',
				'username',
				'username_full',
				'username_full_last',
				'user_type',
				'user_id',
				'topic_time',
				'post_text',
				'topic_views',
				'icon_id',
				'poll',
				'attachments',
				'forum_name',
			)),
			array('news_all', array(
				'forum_id',
				'topic_id',
				'topic_last_post_time',
				'topic_replies',
				'topic_replies_real',
				'topic_type',
				'topic_status',
				'topic_posted',
				'attachment',
				'forum_name',
				'topic_title',
				'username',
				'username_full',
				'username_full_last',
				'user_type',
				'user_id',
				'topic_time',
				'post_text',
				'topic_views',
				'icon_id',
				'poll',
				'attachments',
				'forum_name',
			)),
			array('announcements', array(), array('topic_icons', 'topic_count'), 5, ''),
			array('news', array(), array(), 0),
			array('foobar', array(), array(), 5, '', false, false, false, 150, '\InvalidArgumentException'),
			array('news', array(
				'forum_id',
				'topic_id',
				'topic_last_post_time',
				'topic_replies',
				'topic_replies_real',
				'topic_type',
				'topic_status',
				'topic_posted',
				'attachment',
				'forum_name',
				'topic_title',
				'username',
				'username_full',
				'username_full_last',
				'user_type',
				'user_id',
				'topic_time',
				'post_text',
				'topic_views',
				'icon_id',
				'poll',
				'attachments',
				'forum_name',
			), array(), 5, '', false, true),
			array('announcements', array(), array('topic_icons', 'topic_count'), 5, '3'),
			array('announcements', array(), array('topic_icons', 'topic_count'), 5, '1,2', false, true),
			array('news', array(), array(), 5, '1,2', true, false, true),
			array('announcements', array(), array('topic_icons', 'topic_count'), 5, '', false, true),
			array('announcements', array(), array(), 5, '1,2', true, true, true),
			array('news', array(
				'forum_id',
				'topic_id',
				'topic_last_post_time',
				'topic_replies',
				'topic_replies_real',
				'topic_type',
				'topic_status',
				'topic_posted',
				'attachment',
				'forum_name',
				'topic_title',
				'username',
				'username_full',
				'username_full_last',
				'user_type',
				'user_id',
				'topic_time',
				'post_text',
				'topic_views',
				'icon_id',
				'poll',
				'attachments',
				'forum_name',
			), array(), 5, '', false, true, false, 5),
		);
	}

	/**
	* @dataProvider data_phpbb_fetch_news
	*/
	public function test_phpbb_fetch_news($type, $expected_columns, $expected_main_columns = array(), $number_of_posts = 5, $forum_from = '', $empty = false, $permissions = false,
		$invert = false, $text_length = 150, $expected_exception = false)
	{
		$module_id = 5;
		$time = time();
		$start = 0;

		if ($expected_exception)
		{
			$this->expectException($expected_exception);
		}

		$this->fetch_posts->set_module_id($module_id);
		$fetch_posts = $this->fetch_posts->get_posts($forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start, $invert);

		if (!$empty)
		{
			if (empty($expected_main_columns))
			{
				$expected_main_columns = $this->default_main_columns;
			}

			foreach ($expected_main_columns as $main_column)
			{
				$this->assertArrayHasKey($main_column, $fetch_posts);
				unset($fetch_posts[$main_column]);
			}

			foreach ($fetch_posts as $post)
			{
				foreach ($expected_columns as $column)
				{
					$this->assertArrayHasKey($column, $post);
					$this->assertNotNull($post[$column]);
				}
			}
		}
		else
		{
			if (!empty($fetch_posts))
			{
				var_export($fetch_posts);
			}
			$this->assertEmpty($fetch_posts);
		}
	}

	public function test_cached_first_forum_id()
	{
		global $cache;

		$cache = $this->getMockBuilder('\phpbb\cache\driver\dummy')
			->setMethods(['obtain_word_list', 'get', 'sql_exists', 'put'])
			->getMock();
		$cache->expects($this->any())
			->method('obtain_word_list')
			->with()
			->will($this->returnValue(array()));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(array()));

		$this->fetch_posts = new \board3\portal\portal\fetch_posts($this->auth, $cache, $this->config, $this->db, $this->modules_helper, $this->user);
		$this->fetch_posts->set_module_id(5);

		$fetch_posts = $this->fetch_posts->get_posts('', false, 5, 150, time(), 'announcements');
		$this->assertEmpty($fetch_posts);
	}

	public function test_no_allowed_forums()
	{
		global $auth;

		$auth = new \phpbb\auth\auth();

		$this->fetch_posts->set_module_id(5);
		$fetch_posts = $this->fetch_posts->get_posts('2', true, 5, 150, time(), 'announcements');
		$this->assertSame(array(), $fetch_posts);
	}

	public function test_number_replies()
	{
		$this->fetch_posts->set_module_id(5);
		$fetch_posts = $this->fetch_posts->get_posts('', false, 5, 150, time(), 'news');
		// Topic has 2 posts which means there is only one reply
		$this->assertEquals(1, $fetch_posts[0]['topic_replies']);
		$this->assertEquals(1, $fetch_posts[0]['topic_replies_real']);
	}
}
