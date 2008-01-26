#
# $Id: schema_data.sql,v 1.257 2007/09/20 21:19:00 stoffel04 Exp $
#

# POSTGRES BEGIN #

# -- Config
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_welcome_intro', 'Welcome to my community!');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_online_friends', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_most_poster', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_last_member', '8');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_welcome', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_links', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_link_us', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_clock', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_random_member', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_latest_members', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_top_posters', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_leaders', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_advanced_stat', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_version', '0.1.0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_welcome_guest', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_birthdays', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_search', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_friends', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_whois_online', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_change_style', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_main_menu', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_user_menu', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_right_collumn_width', '180');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_left_collumn_width', '180');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_topic', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_poll_topic_id', '2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_last_visited_bots_number', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_load_last_visited_bots', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_pay_acc', 'your@paypal.com');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_pay_s_block', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_pay_c_block', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_recent', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_recent_title_limit', '100');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_max_topics', '10');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_exclude_forums', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_forum', '2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_length', '250');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_number_of_news', '5');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_show_all_news', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_news_style', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_style', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_number_of_announcements', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_day', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_announcements_length', '200');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_global_announcements_forum', '2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph_word_counts', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph_max_words', '80');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_wordgraph_ratio', '18');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_minicalendar', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_minicalendar_today_color', '//FF0000');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_minicalendar_day_link_color', '//006F00');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_attachments_number', '8');



# POSTGRES COMMIT #

