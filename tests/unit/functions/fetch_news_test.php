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

class phpbb_functions_fetch_news_test extends \board3\portal\tests\testframework\database_test_case
{
	protected $default_main_columns = array('topic_count', 'global_id', 'topic_icons');

	public function setUp()
	{
		parent::setUp();

		global $auth, $cache, $phpbb_container, $phpbb_dispatcher, $template, $user, $phpbb_root_path, $phpEx;

		$user = new \phpbb\user('\phpbb\datetime');
		$user->data['user_id'] = 2;
		$user->timezone = new \DateTimeZone('UTC');
		$user->add_lang('common');
		$user->add_lang('../../ext/board3/portal/language/en/portal');
		$request = new \phpbb_mock_request;
		$phpbb_dispatcher = new phpbb_mock_event_dispatcher();
		$cache = $this->getMock('\phpbb\cache\cache', array('obtain_word_list', 'get', 'sql_exists', 'put', 'obtain_attach_extensions', 'sql_load', 'sql_save'));
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
		$this->user = $user;
		$phpbb_container = new \phpbb_mock_container_builder();
		$controller_helper = new \board3\portal\tests\mock\controller_helper($phpbb_root_path, $phpEx);
		$controller_helper->add_route('board3_portal_controller', 'portal');
		$this->modules_helper = new \board3\portal\includes\modules_helper($auth, $this->config, $controller_helper, $request);
		$phpbb_container->set('board3.portal.modules_helper', $this->modules_helper);
		$phpbb_container->set('board3.portal.fetch_posts', new \board3\portal\portal\fetch_posts($auth, $cache, $this->config, $this->db, $this->modules_helper, $user));
		$template = $this->getMock('\phpbb\template', array('set_filenames', 'destroy_block_vars', 'assign_block_vars', 'assign_display'));
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
			$this->setExpectedException($expected_exception);
		}

		$fetch_posts = phpbb_fetch_posts($module_id, $forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start, $invert);

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
		global $cache, $phpbb_container;

		$cache = $this->getMock('\phpbb\cache\cache', array('obtain_word_list', 'get', 'sql_exists', 'put'));
		$cache->expects($this->any())
			->method('obtain_word_list')
			->with()
			->will($this->returnValue(array()));
		$cache->expects($this->any())
			->method('get')
			->with($this->anything())
			->will($this->returnValue(array()));

		$phpbb_container->set('board3.portal.fetch_posts', new \board3\portal\portal\fetch_posts($this->auth, $cache, $this->config, $this->db, $this->modules_helper, $this->user));
		$fetch_posts = phpbb_fetch_posts(5, '', false, 5, 150, time(), 'announcements');
		$this->assertEmpty($fetch_posts);
	}

	public function test_no_allowed_forums()
	{
		global $auth;

		$auth = new \phpbb\auth\auth();

		$fetch_posts = phpbb_fetch_posts(5, '2', true, 5, 150, time(), 'announcements');
		$this->assertSame(array(), $fetch_posts);
	}

	public function test_number_replies()
	{
		$fetch_posts = phpbb_fetch_posts(5, '', false, 5, 150, time(), 'news');
		// Topic has 2 posts which means there is only one reply
		$this->assertEquals(1, $fetch_posts[0]['topic_replies']);
		$this->assertEquals(1, $fetch_posts[0]['topic_replies_real']);
	}
}
