#
# $Id: schema_data.sql,v 1.257 2007/09/20 21:19:00 stoffel04 Exp $
#

# POSTGRES BEGIN #

# -- Config
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_welcome_intro', 'Welcome to my community!');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_online_friends', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_most_poster', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_last_member', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_right_column_width', '180');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_left_column_width', '180');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_topic_id', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_last_visited_bots_number', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_pay_acc', 'your@paypal.com');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_recent_title_limit', '100');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_topics', '10');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_exclude_forums', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_forum', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_length', '250');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_number_of_news', '5');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_show_all_news', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_style', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_style', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_number_of_announcements', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_day', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_length', '200');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_global_announcements_forum', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph_word_counts', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph_max_words', '80');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph_ratio', '18');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_minicalendar_today_color', '#006F00');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_minicalendar_sunday_color', '#FF0000');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_long_month', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_sunday_first', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments_number', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_limit', '3');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_allow_vote', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_birthdays_ahead', '7');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments_forum_ids', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_permissions', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_permissions', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_code_center', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_code_small', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center_bbcode', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small_bbcode', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center_headline', 'Headline center box');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small_headline', 'Headline small box');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_show_last', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_archive', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_archive', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_links_array', 'a:2:{i:1;a:2:{s:4:"text";s:9:"Board3.de";s:3:"url";s:21:"http://www.board3.de/";}i:2;a:2:{s:4:"text";s:9:"phpBB.com";s:3:"url";s:21:"http://www.phpbb.com/";}}');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_show_announcements_replies_views', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_show_news_replies_views', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_welcome_guest', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_enable', '1');

# Inserts who have to be checked at a later stage of the block pallet feature #
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_leaders_ext', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_forum_index', '0');

# Removed inserts - remove before release #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_center', '0'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_custom_small', '0'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph', '0'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_minicalendar', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_recent', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_welcome', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_links', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_link_us', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_clock', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_random_member', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_latest_members', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_top_posters', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_leaders', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_advanced_stat', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_birthdays', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_search', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_friends', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_whois_online', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_change_style', '0'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_main_menu', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_user_menu', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_pay_s_block', '0'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_pay_c_block', '0'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_load_last_visited_bots', '1'); #
# INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_topic', '1'); #

# New inserts for portal_blocks table #
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('announcements', '0', '1', '1', '3');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('attachments', '1', '1', '0', '5');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('birthday_list', '1', '1', '0', '1');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('change_style', '1', '0', '0', '7');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('clock', '1', '1', '0', '2');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('custom', '0', '0', '1', '1');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('custom', '1', '0', '0', '6');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('donate', '0', '0', '1', '8');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('donate', '1', '0', '2', '7');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('forum_index', '0', '0', '1', '6');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('friends', '1', '1', '2', '1');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('jumpbox', '0', '1', '1', '10');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('latest_bots', '1', '1', '2', '5');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('latest_members', '1', '1', '0', '9');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('leaders', '1', '1', '2', '4');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('link_us', '1', '1', '0', '10');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('links', '1', '1', '2', '6');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('main_menu', '1', '1', '0', '0');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('mini_cal', '1', '1', '2', '3');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('news', '0', '1', '1', '4');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('poll', '0', '1', '1', '5');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('search', '1', '1', '0', '3');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('random_member', '1', '1', '0', '4');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('recent', '0', '1', '1', '2');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('statistics', '1', '1', '2', '2');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('top_posters', '1', '1', '0', '8');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('user_menu', '1', '1', '2', '0');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('welcome', '0', '1', '1', '0');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('whois_online', '0', '1', '1', '7');
INSERT INTO phpbb_portal_blocks (block_name, block_type, block_enabled, block_position, block_order) VALUES ('wordgraph', '0', '0', '1', '9');
# Rename second custom and donate insert? #

# POSTGRES COMMIT #

