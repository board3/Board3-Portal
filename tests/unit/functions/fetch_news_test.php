<?php
/**
*
* @package Board3 Portal Testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once(dirname(__FILE__) . '/../../../includes/functions.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/functions_acp.php');
require_once(dirname(__FILE__) . '/../../../../../../includes/functions.php');

class phpbb_functions_fetch_news_test extends \board3\portal\tests\testframework\database_test_case
{
	public function setUp()
	{
		parent::setUp();

		global $auth, $cache, $phpbb_container, $phpbb_dispatcher, $user;

		$auth = new \phpbb\auth\auth();
		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('board3.portal.modules_helper', new \board3\portal\includes\modules_helper($auth));
		$user = new \phpbb\user();
		$user->data['user_id'] = 2;
		$user->timezone = new \DateTimeZone('UTC');
		$user->add_lang('common');
		$user->add_lang('../../ext/board3/portal/language/en/portal');
		$phpbb_dispatcher = new phpbb_mock_event_dispatcher();
		$cache = $this->getMock('\phpbb\cache\cache', array('obtain_word_list', 'get', 'sql_exists'));
		$cache->expects($this->any())
			->method('obtain_word_list')
			->with()
			->will($this->returnValue(array()));
		require_once(dirname(__FILE__) . '/../../../../../../includes/functions_content.php');
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
			array('announcements', array(), 5, true),
			array('news', array(), 0),
			array('foobar', array(), 5, false, '\InvalidArgumentException'),
		);
	}

	/**
	* @dataProvider data_phpbb_fetch_news
	*/
	public function test_phpbb_fetch_news($type, $expected_columns, $number_of_posts = 5, $empty = false, $expected_exception = false)
	{
		$module_id = 5;
		$forum_from = '';
		$permissions = false;
		$text_length = 150;
		$time = time();
		$start = 0;
		$invert = false;

		if ($expected_exception)
		{
			$this->setExpectedException($expected_exception);
		}

		$fetch_posts = phpbb_fetch_posts($module_id, $forum_from, $permissions, $number_of_posts, $text_length, $time, $type, $start, $invert);

		if (!$empty)
		{
			$this->assertArrayHasKey('topic_count', $fetch_posts);
			$this->assertArrayHasKey('global_id', $fetch_posts);
			$this->assertArrayHasKey('topic_icons', $fetch_posts);

			unset($fetch_posts['topic_count']);
			unset($fetch_posts['global_id']);
			unset($fetch_posts['topic_icons']);

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
			$this->assertEmpty($fetch_posts);
		}
	}
}
