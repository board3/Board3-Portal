#Board3 Portal 2.1.0

Board Portal 2.1.0 is a second generation portal for phpBB 3.1.x. It adds a portal with several blocks to your forum.
You can change the settings, move the blocks, add new blocks and more in the ACP.

##How to use

You can download the current development version of Board3 Portal 2.1.x here or download the current release at [www.board3.de](http://www.board3.de/ "Board3 • Portal").  
Board3 Portal 2.1.x can currently not be installed.

Once the portal has been merged into the new extension system, you can manually install it by executing the following SQL queries (tested on MySQL):
```sql
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Jan 2013 um 17:28
-- Server Version: 5.5.27
-- PHP-Version: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `qi_board3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `phpbb_portal_config`
--

CREATE TABLE IF NOT EXISTS `phpbb_portal_config` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `phpbb_portal_config`
--

INSERT INTO `phpbb_portal_config` (`config_name`, `config_value`) VALUES
('board3_calendar_events_18', ''),
('board3_links_array_21', 0x613a323a7b693a303b613a343a7b733a353a227469746c65223b733a393a22426f617264332e6465223b733a333a2275726c223b733a32313a22687474703a2f2f7777772e626f617264332e64652f223b733a343a2274797065223b693a323b733a31303a227065726d697373696f6e223b733a303a22223b7d693a313b613a343a7b733a353a227469746c65223b733a393a2270687042422e636f6d223b733a333a2275726c223b733a32313a22687474703a2f2f7777772e70687062622e636f6d2f223b733a343a2274797065223b693a323b733a31303a227065726d697373696f6e223b733a303a22223b7d7d),
('board3_menu_array_1', 0x613a31313a7b693a303b613a343a7b733a353a227469746c65223b733a393a224d5f434f4e54454e54223b733a333a2275726c223b733a303a22223b733a343a2274797065223b693a303b733a31303a227065726d697373696f6e223b733a303a22223b7d693a313b613a343a7b733a353a227469746c65223b733a353a22494e444558223b733a333a2275726c223b733a393a22696e6465782e706870223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a303a22223b7d693a323b613a343a7b733a353a227469746c65223b733a363a22534541524348223b733a333a2275726c223b733a31303a227365617263682e706870223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a303a22223b7d693a333b613a343a7b733a353a227469746c65223b733a383a225245474953544552223b733a333a2275726c223b733a32313a227563702e7068703f6d6f64653d7265676973746572223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a313a2231223b7d693a343b613a343a7b733a353a227469746c65223b733a31303a224d454d4245524c495354223b733a333a2275726c223b733a31343a226d656d6265726c6973742e706870223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a333a22322c33223b7d693a353b613a343a7b733a353a227469746c65223b733a383a225448455f5445414d223b733a333a2275726c223b733a32373a226d656d6265726c6973742e7068703f6d6f64653d6c656164657273223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a333a22322c33223b7d693a363b613a343a7b733a353a227469746c65223b733a363a224d5f48454c50223b733a333a2275726c223b733a303a22223b733a343a2274797065223b693a303b733a31303a227065726d697373696f6e223b733a303a22223b7d693a373b613a343a7b733a353a227469746c65223b733a333a22464151223b733a333a2275726c223b733a373a226661712e706870223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a303a22223b7d693a383b613a343a7b733a353a227469746c65223b733a383a224d5f4242434f4445223b733a333a2275726c223b733a31393a226661712e7068703f6d6f64653d6262636f6465223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a303a22223b7d693a393b613a343a7b733a353a227469746c65223b733a373a224d5f5445524d53223b733a333a2275726c223b733a31383a227563702e7068703f6d6f64653d7465726d73223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a303a22223b7d693a31303b613a343a7b733a353a227469746c65223b733a353a224d5f505256223b733a333a2275726c223b733a32303a227563702e7068703f6d6f64653d70726976616379223b733a343a2274797065223b693a313b733a31303a227065726d697373696f6e223b733a303a22223b7d7d),
('board3_welcome_message_10', 0x57656c636f6d6520746f206d7920436f6d6d756e69747921);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `phpbb_portal_modules`
--

CREATE TABLE IF NOT EXISTS `phpbb_portal_modules` (
  `module_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `module_classname` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_column` tinyint(3) NOT NULL DEFAULT '0',
  `module_order` tinyint(3) NOT NULL DEFAULT '0',
  `module_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_image_src` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_image_width` int(3) NOT NULL DEFAULT '0',
  `module_image_height` int(3) NOT NULL DEFAULT '0',
  `module_group_ids` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `phpbb_portal_modules`
--

INSERT INTO `phpbb_portal_modules` (`module_id`, `module_classname`, `module_column`, `module_order`, `module_name`, `module_image_src`, `module_image_width`, `module_image_height`, `module_group_ids`, `module_status`) VALUES
(1, 'main_menu', 1, 1, 'M_MENU', 'portal_menu.png', 16, 16, '', 1),
(2, 'stylechanger', 1, 2, 'BOARD_STYLE', 'portal_style.png', 16, 16, '', 1),
(3, 'birthday_list', 1, 3, 'BIRTHDAYS', 'portal_birthday.png', 16, 16, '', 1),
(4, 'clock', 1, 5, 'CLOCK', 'portal_clock.png', 16, 16, '', 1),
(5, 'search', 1, 4, 'PORTAL_SEARCH', 'portal_search.png', 16, 16, '', 1),
(6, 'attachments', 1, 7, 'PORTAL_ATTACHMENTS', 'portal_attach.png', 16, 16, '', 1),
(7, 'topposters', 1, 8, 'TOPPOSTERS', 'portal_top_poster.png', 16, 16, '', 1),
(8, 'latest_members', 1, 9, 'LATEST_MEMBERS', 'portal_members.png', 16, 16, '', 1),
(10, 'welcome', 2, 1, 'PORTAL_WELCOME', '', 16, 16, '', 1),
(11, 'recent', 2, 2, 'PORTAL_RECENT', '', 16, 16, '', 1),
(12, 'announcements', 2, 3, 'GLOBAL_ANNOUNCEMENTS', '', 16, 16, '', 1),
(13, 'news', 2, 4, 'LATEST_NEWS', '', 0, 0, '', 1),
(14, 'poll', 2, 5, 'PORTAL_POLL', 'portal_poll.png', 16, 16, '', 1),
(15, 'whois_online', 2, 6, 'PORTAL_WHOIS_ONLINE', 'portal_friends.png', 16, 16, '', 1),
(16, 'user_menu', 3, 1, 'USER_MENU', 'portal_user.png', 16, 16, '', 1),
(17, 'statistics', 3, 2, 'STATISTICS', 'portal_statistics.png', 16, 16, '', 1),
(18, 'calendar', 3, 3, 'PORTAL_CALENDAR', 'portal_calendar.png', 16, 16, '', 1),
(19, 'leaders', 3, 4, 'THE_TEAM', 'portal_team.png', 16, 16, '', 1),
(20, 'latest_bots', 3, 5, 'LATEST_BOTS', 'portal_bots.png', 16, 16, '', 1),
(21, 'links', 3, 6, 'PORTAL_LINKS', 'portal_links.png', 16, 16, '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```
and:
```sql
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Jan 2013 um 17:37
-- Server Version: 5.5.27
-- PHP-Version: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `qi_board3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `phpbb_config`
--

CREATE TABLE IF NOT EXISTS `phpbb_config` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_dynamic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `phpbb_config`
--

INSERT INTO `phpbb_config` (`config_name`, `config_value`, `is_dynamic`) VALUES
('board3_announcements_archive_12', '1', 0),
('board3_announcements_day_12', '0', 0),
('board3_announcements_forum_exclude_12', '0', 0),
('board3_announcements_length_12', '200', 0),
('board3_announcements_permissions_12', '1', 0),
('board3_announcements_style_12', '0', 0),
('board3_attach_max_length_6', '15', 0),
('board3_attachments_exclude_6', '0', 0),
('board3_attachments_filetype_6', '', 0),
('board3_attachments_forum_exclude_6', '0', 0),
('board3_attachments_forum_ids_6', '', 0),
('board3_attachments_number_6', '8', 0),
('board3_birthdays_ahead_3', '30', 0),
('board3_calendar_sunday_color_18', '#FF0000', 0),
('board3_calendar_today_color_18', '#000000', 0),
('board3_clock_src_4', 'board3clock.swf', 0),
('board3_display_events_18', '0', 0),
('board3_display_jumpbox', '1', 0),
('board3_enable', '1', 0),
('board3_events_18', '', 0),
('board3_events_url_new_window_18', '0', 0),
('board3_forum_index', '1', 0),
('board3_global_announcements_forum_12', '', 0),
('board3_last_visited_bots_number_20', '1', 0),
('board3_leaders_ext_19', '0', 0),
('board3_left_column', '1', 0),
('board3_left_column_width', '180', 0),
('board3_links_21', '', 0),
('board3_links_url_new_window_21', '0', 0),
('board3_long_month_18', '0', 0),
('board3_max_last_member_8', '8', 0),
('board3_max_topics_11', '10', 0),
('board3_menu_1', '', 0),
('board3_menu_url_new_window_1', '0', 0),
('board3_news_archive_13', '1', 0),
('board3_news_exclude_13', '0', 0),
('board3_news_forum_13', '', 0),
('board3_news_length_13', '250', 0),
('board3_news_permissions_13', '1', 0),
('board3_news_show_last_13', '0', 0),
('board3_news_style_13', '0', 0),
('board3_number_of_announcements_12', '1', 0),
('board3_number_of_news_13', '5', 0),
('board3_phpbb_menu', '0', 0),
('board3_poll_allow_vote_14', '1', 0),
('board3_poll_exclude_id_14', '0', 0),
('board3_poll_hide_14', '0', 0),
('board3_poll_limit_14', '3', 0),
('board3_poll_topic_id_14', '', 0),
('board3_portal_version', '2.0.1', 0),
('board3_recent_exclude_forums_11', '1', 0),
('board3_recent_forum_11', '', 0),
('board3_recent_title_limit_11', '100', 0),
('board3_right_column', '1', 0),
('board3_right_column_width', '180', 0),
('board3_show_all_news_13', '1', 0),
('board3_show_announcements_replies_views_12', '1', 0),
('board3_show_news_replies_views_13', '1', 0),
('board3_sunday_first_18', '1', 0),
('board3_topposters_7', '5', 0),
('board3_user_menu_register_16', '1', 0),
('board3_version_check', '1', 0),
('board3_welcome_message_10', '', 0),
('board3_welcome_message_bitfield_10', '', 0),
('board3_welcome_message_uid_10', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

##Support

Support for Board3 Portal can be found at [www.board3.de](http://www.board3.de/ "Board3 • Portal") or on [www.phpbb.com](http://www.phpbb.com/community/viewtopic.php?f=70&t=2131824/ "phpBB • Board3 Portal").
