<?php
/**
*
* @package dbal
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Define the basic structure
* The format:
*		array('{TABLE_NAME}' => {TABLE_DATA})
*		{TABLE_DATA}:
*			COLUMNS = array({column_name} = array({column_type}, {default}, {auto_increment}))
*			PRIMARY_KEY = {column_name(s)}
*			KEYS = array({key_name} = array({key_type}, {column_name(s)})),
*
*	Column Types:
*	INT:x		=> SIGNED int(x)
*	BINT		=> BIGINT
*	UINT		=> mediumint(8) UNSIGNED
*	UINT:x		=> int(x) UNSIGNED
*	TINT:x		=> tinyint(x)
*	USINT		=> smallint(4) UNSIGNED (for _order columns)
*	BOOL		=> tinyint(1) UNSIGNED
*	VCHAR		=> varchar(255)
*	CHAR:x		=> char(x)
*	XSTEXT_UNI	=> text for storing 100 characters (topic_title for example)
*	STEXT_UNI	=> text for storing 255 characters (normal input field with a max of 255 single-byte chars) - same as VCHAR_UNI
*	TEXT_UNI	=> text for storing 3000 characters (short text, descriptions, comments, etc.)
*	MTEXT_UNI	=> mediumtext (post text, large text)
*	VCHAR:x		=> varchar(x)
*	TIMESTAMP	=> int(11) UNSIGNED
*	DECIMAL		=> decimal number (5,2)
*	DECIMAL:	=> decimal number (x,2)
*	PDECIMAL	=> precision decimal number (6,3)
*	PDECIMAL:	=> precision decimal number (x,3)
*	VCHAR_UNI	=> varchar(255) BINARY
*	VCHAR_CI	=> varchar_ci for postgresql, others VCHAR
*/

/**
* Step 1: Manipulate phpbb's tables
*/
$schema_data['phpbb_log']['COLUMNS']['album_id'] = array('UINT', 0);
$schema_data['phpbb_log']['COLUMNS']['image_id'] = array('UINT', 0);
$schema_data['phpbb_sessions']['COLUMNS']['session_album_id'] = array('UINT', 0);
$schema_data['phpbb_sessions']['KEYS']['session_aid'] = array('INDEX', 'session_album_id');

/**
* Step 2: Add own tables
*/
$schema_data['phpbb_gallery_albums'] = array(
	'COLUMNS'		=> array(
		'album_id'					=> array('UINT', NULL, 'auto_increment'),
		'parent_id'					=> array('UINT', 0),
		'left_id'					=> array('UINT', 1),
		'right_id'					=> array('UINT', 2),
		'album_parents'				=> array('MTEXT_UNI', ''),
		'album_type'				=> array('UINT:3', 1),
		'album_status'				=> array('UINT:1', 1),
		'album_contest'				=> array('UINT', 0),
		'album_name'				=> array('VCHAR:255', ''),
		'album_desc'				=> array('MTEXT_UNI', ''),
		'album_desc_options'		=> array('UINT:3', 7),
		'album_desc_uid'			=> array('VCHAR:8', ''),
		'album_desc_bitfield'		=> array('VCHAR:255', ''),
		'album_user_id'				=> array('UINT', 0),
		'album_images'				=> array('UINT', 0),
		'album_images_real'			=> array('UINT', 0),
		'album_last_image_id'		=> array('UINT', 0),
		'album_image'				=> array('VCHAR', ''),
		'album_last_image_time'		=> array('INT:11', 0),
		'album_last_image_name'		=> array('VCHAR', ''),
		'album_last_username'		=> array('VCHAR', ''),
		'album_last_user_colour'	=> array('VCHAR:6', ''),
		'album_last_user_id'		=> array('UINT', 0),
		'album_watermark'			=> array('UINT:1', 1),
		'album_sort_key'			=> array('VCHAR:8', ''),
		'album_sort_dir'			=> array('VCHAR:8', ''),
		'display_in_rrc'			=> array('UINT:1', 1),
		'display_on_index'			=> array('UINT:1', 1),
		'display_subalbum_list'		=> array('UINT:1', 1),
		'album_feed'				=> array('BOOL', 1),
		'album_auth_access'			=> array('TINT:1', 0),
	),
	'PRIMARY_KEY'	=> 'album_id',
);

$schema_data['phpbb_gallery_albums_track'] = array(
	'COLUMNS'		=> array(
		'user_id'				=> array('UINT', 0),
		'album_id'				=> array('UINT', 0),
		'mark_time'				=> array('TIMESTAMP', 0),
	),
	'PRIMARY_KEY'	=> array('user_id', 'album_id'),
);

$schema_data['phpbb_gallery_comments'] = array(
	'COLUMNS'		=> array(
		'comment_id'			=> array('UINT', NULL, 'auto_increment'),
		'comment_image_id'		=> array('UINT', NULL),
		'comment_user_id'		=> array('UINT', 0),
		'comment_username'		=> array('VCHAR', ''),
		'comment_user_colour'	=> array('VCHAR:6', ''),
		'comment_user_ip'		=> array('VCHAR:40', ''),
		'comment_signature'		=> array('BOOL', 0),
		'comment_time'			=> array('UINT:11', 0),
		'comment'				=> array('MTEXT_UNI', ''),
		'comment_uid'			=> array('VCHAR:8', ''),
		'comment_bitfield'		=> array('VCHAR:255', ''),
		'comment_edit_time'		=> array('UINT:11', 0),
		'comment_edit_count'	=> array('USINT', 0),
		'comment_edit_user_id'	=> array('UINT', 0),
	),
	'PRIMARY_KEY'	=> 'comment_id',
	'KEYS'		=> array(
		'id'			=> array('INDEX', 'comment_image_id'),
		'uid'			=> array('INDEX', 'comment_user_id'),
		'ip'			=> array('INDEX', 'comment_user_ip'),
		'time'			=> array('INDEX', 'comment_time'),
	),
);

$schema_data['phpbb_gallery_contests'] = array(
	'COLUMNS'		=> array(
		'contest_id'			=> array('UINT', NULL, 'auto_increment'),
		'contest_album_id'		=> array('UINT', 0),
		'contest_start'			=> array('UINT:11', 0),
		'contest_rating'		=> array('UINT:11', 0),
		'contest_end'			=> array('UINT:11', 0),
		'contest_marked'		=> array('TINT:1', 0),
		'contest_first'			=> array('UINT', 0),
		'contest_second'		=> array('UINT', 0),
		'contest_third'			=> array('UINT', 0),
	),
	'PRIMARY_KEY'	=> 'contest_id',
);

$schema_data['phpbb_gallery_favorites'] = array(
	'COLUMNS'		=> array(
		'favorite_id'			=> array('UINT', NULL, 'auto_increment'),
		'user_id'				=> array('UINT', 0),
		'image_id'				=> array('UINT', 0),
	),
	'PRIMARY_KEY'	=> 'favorite_id',
	'KEYS'		=> array(
		'uid'		=> array('INDEX', 'user_id'),
		'id'		=> array('INDEX', 'image_id'),
	),
);

$schema_data['phpbb_gallery_images'] = array(
	'COLUMNS'		=> array(
		'image_id'				=> array('UINT', NULL, 'auto_increment'),
		'image_filename'		=> array('VCHAR:255', ''),
		'image_name'			=> array('VCHAR:255', ''),
		'image_name_clean'		=> array('VCHAR:255', ''),
		'image_desc'			=> array('MTEXT_UNI', ''),
		'image_desc_uid'		=> array('VCHAR:8', ''),
		'image_desc_bitfield'	=> array('VCHAR:255', ''),
		'image_user_id'			=> array('UINT', 0),
		'image_username'		=> array('VCHAR:255', ''),
		'image_username_clean'	=> array('VCHAR:255', ''),
		'image_user_colour'		=> array('VCHAR:6', ''),
		'image_user_ip'			=> array('VCHAR:40', ''),
		'image_time'			=> array('UINT:11', 0),
		'image_album_id'		=> array('UINT', 0),
		'image_view_count'		=> array('UINT:11', 0),
		'image_status'			=> array('UINT:3', 0),
		'image_contest'			=> array('UINT:1', 0),
		'image_contest_end'		=> array('TIMESTAMP', 0),
		'image_contest_rank'	=> array('UINT:3', 0),
		'image_filemissing'		=> array('UINT:3', 0),
		'image_has_exif'		=> array('UINT:3', 2),
		'image_exif_data'		=> array('TEXT', ''),
		'image_rates'			=> array('UINT', 0),
		'image_rate_points'		=> array('UINT', 0),
		'image_rate_avg'		=> array('UINT', 0),
		'image_comments'		=> array('UINT', 0),
		'image_last_comment'	=> array('UINT', 0),
		'image_allow_comments'	=> array('TINT:1', 1),
		'image_favorited'		=> array('UINT', 0),
		'image_reported'		=> array('UINT', 0),
		'filesize_upload'		=> array('UINT:20', 0),
		'filesize_medium'		=> array('UINT:20', 0),
		'filesize_cache'		=> array('UINT:20', 0),
	),
	'PRIMARY_KEY'				=> 'image_id',
	'KEYS'		=> array(
		'aid'			=> array('INDEX', 'image_album_id'),
		'uid'			=> array('INDEX', 'image_user_id'),
		'time'			=> array('INDEX', 'image_time'),
	),
);

$schema_data['phpbb_gallery_modscache'] = array(
	'COLUMNS'		=> array(
		'album_id'				=> array('UINT', 0),
		'user_id'				=> array('UINT', 0),
		'username'				=> array('VCHAR', ''),
		'group_id'				=> array('UINT', 0),
		'group_name'			=> array('VCHAR', ''),
		'display_on_index'		=> array('TINT:1', 1),
	),
	'KEYS'		=> array(
		'doi'		=> array('INDEX', 'display_on_index'),
		'aid'		=> array('INDEX', 'album_id'),
	),
);

$schema_data['phpbb_gallery_permissions'] = array(
	'COLUMNS'		=> array(
		'perm_id'			=> array('UINT', NULL, 'auto_increment'),
		'perm_role_id'		=> array('UINT', 0),
		'perm_album_id'		=> array('UINT', 0),
		'perm_user_id'		=> array('UINT', 0),
		'perm_group_id'		=> array('UINT', 0),
		'perm_system'		=> array('INT:3', 0),
	),
	'PRIMARY_KEY'			=> 'perm_id',
);

$schema_data['phpbb_gallery_rates'] = array(
	'COLUMNS'		=> array(
		'rate_image_id'		=> array('UINT', 0),
		'rate_user_id'		=> array('UINT', 0),
		'rate_user_ip'		=> array('VCHAR:40', ''),
		'rate_point'		=> array('UINT:3', 0),
	),
	'PRIMARY_KEY'	=> array('rate_image_id', 'rate_user_id'),
);

$schema_data['phpbb_gallery_reports'] = array(
	'COLUMNS'		=> array(
		'report_id'				=> array('UINT', NULL, 'auto_increment'),
		'report_album_id'		=> array('UINT', 0),
		'report_image_id'		=> array('UINT', 0),
		'reporter_id'			=> array('UINT', 0),
		'report_manager'		=> array('UINT', 0),
		'report_note'			=> array('MTEXT_UNI', ''),
		'report_time'			=> array('UINT:11', 0),
		'report_status'			=> array('UINT:3', 0),
	),
	'PRIMARY_KEY'	=> 'report_id',
);

$schema_data['phpbb_gallery_roles'] = array(
	'COLUMNS'		=> array(
		'role_id'			=> array('UINT', NULL, 'auto_increment'),
		'a_list'			=> array('UINT:3', 0),
		'i_view'			=> array('UINT:3', 0),
		'i_watermark'		=> array('UINT:3', 0),
		'i_upload'			=> array('UINT:3', 0),
		'i_edit'			=> array('UINT:3', 0),
		'i_delete'			=> array('UINT:3', 0),
		'i_rate'			=> array('UINT:3', 0),
		'i_approve'			=> array('UINT:3', 0),
		'i_lock'			=> array('UINT:3', 0),
		'i_report'			=> array('UINT:3', 0),
		'i_count'			=> array('UINT', 0),
		'i_unlimited'		=> array('UINT:3', 0),
		'c_read'			=> array('UINT:3', 0),
		'c_post'			=> array('UINT:3', 0),
		'c_edit'			=> array('UINT:3', 0),
		'c_delete'			=> array('UINT:3', 0),
		'm_comments'		=> array('UINT:3', 0),
		'm_delete'			=> array('UINT:3', 0),
		'm_edit'			=> array('UINT:3', 0),
		'm_move'			=> array('UINT:3', 0),
		'm_report'			=> array('UINT:3', 0),
		'm_status'			=> array('UINT:3', 0),
		'a_count'			=> array('UINT', 0),
		'a_unlimited'		=> array('UINT:3', 0),
		'a_restrict'		=> array('UINT:3', 0),
	),
	'PRIMARY_KEY'		=> 'role_id',
);

$schema_data['phpbb_gallery_users'] = array(
	'COLUMNS'		=> array(
		'user_id'			=> array('UINT', 0),
		'watch_own'			=> array('UINT:3', 0),
		'watch_favo'		=> array('UINT:3', 0),
		'watch_com'			=> array('UINT:3', 0),
		'user_images'		=> array('UINT', 0),
		'personal_album_id'	=> array('UINT', 0),
		'user_lastmark'		=> array('TIMESTAMP', 0),
		'user_last_update'	=> array('TIMESTAMP', 0),
		'user_viewexif'		=> array('UINT:1', 0),
		'user_permissions'	=> array('MTEXT_UNI', ''),
		'user_permissions_changed'	=> array('TIMESTAMP', 0),
		'user_allow_comments'		=> array('TINT:1', 1),
		'subscribe_pegas'			=> array('TINT:1', 0),
	),
	'PRIMARY_KEY'		=> 'user_id',
	'KEYS'		=> array(
		'pega'			=> array('INDEX', array('personal_album_id')),
	),
);

$schema_data['phpbb_gallery_watch'] = array(
	'COLUMNS'		=> array(
		'watch_id'		=> array('UINT', NULL, 'auto_increment'),
		'album_id'		=> array('UINT', 0),
		'image_id'		=> array('UINT', 0),
		'user_id'		=> array('UINT', 0),
	),
	'PRIMARY_KEY'		=> 'watch_id',
	'KEYS'		=> array(
		'uid'			=> array('INDEX', 'user_id'),
		'id'			=> array('INDEX', 'image_id'),
		'aid'			=> array('INDEX', 'album_id'),
	),
);
