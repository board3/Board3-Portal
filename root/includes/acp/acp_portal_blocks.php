<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
* @package acp
*/
class acp_portal_blocks
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $template, $cache, $portal_config;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$portal_root_path = PORTAL_ROOT_PATH;
		$portal_icons_path = PORTAL_ICONS_PATH;
		include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
		$portal_config = obtain_portal_config();
		
		// Set up general vars
		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$block_id = request_var('id', 0);

		$this->tpl_name = 'acp_portal_blocks';
		$this->page_title = 'ACP_PORTAL_BLOCKS';

		$form_name = 'acp_portal_blocks';
		add_form_key($form_name);

		switch ($action)
		{
			case 'save':

				if (!check_form_key($form_name))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
				}

				$block_title = utf8_normalize_nfc(request_var('block_title', '', true));
				$block_birthday = request_var('block_birthday', '');
				$block_online_friends = request_var('block_online_friends', '');
				$block_donation = request_var('block_donation', '');
				$block_latest_members = request_var('block_latest_members', '');
				$block_latest_bots = request_var('block_latest_bots', '');
				$block_type = request_var('block_type', '');
				$block_position = request_var('block_position', 0);
				$block_groups = request_var('block_groups', 0);
				$block_icon = request_var('block_icon', '');
				$block_text = ($block_type == 'custom') ? utf8_normalize_nfc(request_var('block_text', '', true)) : '';

				if ($block_icon != '' && !preg_match('#(\.gif|\.png|\.jpg|\.jpeg)$#i', $block_icon))
				{
					$block_icon = '';
				}
				if (!$block_title)
				{
					trigger_error($user->lang['NO_BLOCK_TITLE'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if ($block_type == 'custom' && $block_text == '')
				{
					trigger_error($user->lang['NO_BLOCK_TEXT'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				set_portal_config('portal_birthdays_ahead', $block_birthday);
				set_portal_config('portal_max_online_friends', $block_online_friends);
				set_portal_config('portal_pay_acc', $block_donation);
				set_portal_config('portal_max_last_member', $block_latest_members);
				set_portal_config('portal_last_visited_bots_number', $block_latest_bots);
				
				$sql_ary = array(
					'block_title'			=> $block_title,
					'block_type'			=> $block_type,
					'block_position'		=> $block_position,
					'block_groups'			=> $block_groups,
					'block_icon'			=> htmlspecialchars_decode($block_icon),
					'block_text'			=> ($block_type == 'custom') ? $block_text : '',
					'block_text_uid'		=> '',
					'block_text_options'	=> 7,
					'block_text_bitfield'	=> '',
				);

				$order_ary = array(
					'block_order'	=> $portal_config['num_blocks'] + 1,
				);

				// Get data for block text if specified
				if ($sql_ary['block_text'])
				{
					generate_text_for_storage($sql_ary['block_text'], $sql_ary['block_text_uid'], $sql_ary['block_text_bitfield'], $sql_ary['block_text_options'], request_var('text_parse_bbcode', false), request_var('text_parse_urls', false), request_var('text_parse_smilies', false));
				}

				if ($block_id)
				{
					$sql = 'UPDATE ' . PORTAL_BLOCKS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE block_id = $block_id";
					$message = $user->lang['BLOCK_UPDATED'];

					add_log('admin', 'LOG_BLOCK_UPDATED', (!empty($user->lang[strtoupper($block_title)])) ? $user->lang[strtoupper($block_title)] : $block_title);
				}
				else
				{
					$sql = 'INSERT INTO ' . PORTAL_BLOCKS_TABLE . ' ' . $db->sql_build_array('INSERT', array_merge($sql_ary, $order_ary));
					$message = $user->lang['BLOCK_ADDED'];

					set_portal_config('num_blocks', $portal_config['num_blocks'] + 1, true);
					add_log('admin', 'LOG_BLOCK_ADDED', (!empty($user->lang[strtoupper($block_title)])) ? $user->lang[strtoupper($block_title)] : $block_title);
				}
				$db->sql_query($sql);

				$cache->destroy('_blocks');

				trigger_error($message . adm_back_link($this->u_action));

			break;

			case 'delete':

				if (!$block_id)
				{
					trigger_error($user->lang['MUST_SELECT_BLOCK'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT block_title, block_order
						FROM ' . PORTAL_BLOCKS_TABLE . "
						WHERE block_id = $block_id";
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($row)
					{
						$row['block_title'] = (string) $row['block_title'];
						$row['block_order'] = (int) $row['block_order'];
					}

					$sql = 'DELETE FROM ' . PORTAL_BLOCKS_TABLE . " WHERE block_id = $block_id";
					$db->sql_query($sql);

					$sql = 'UPDATE ' . PORTAL_BLOCKS_TABLE . ' SET block_order = block_order - 1 WHERE block_order > ' . $row['block_order'];
					$db->sql_query($sql);

					$cache->destroy('_blocks');

					set_portal_config('num_blocks', $portal_config['num_blocks'] - 1, true);
					add_log('admin', 'LOG_BLOCK_REMOVED', (!empty($user->lang[strtoupper($row['block_title'])])) ? $user->lang[strtoupper($row['block_title'])] : $row['block_title']);
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'block_id'	=> $block_id,
						'action'	=> 'delete',
					)));
				}

			break;

			case 'disable':

				if (!$block_id)
				{
					trigger_error($user->lang['MUST_SELECT_BLOCK'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT block_title
					FROM ' . PORTAL_BLOCKS_TABLE . "
					WHERE block_id = $block_id";
				$result = $db->sql_query($sql);
				$disabled_block = $db->sql_fetchfield('block_title');
				$db->sql_freeresult($result);

				$sql = 'UPDATE ' . PORTAL_BLOCKS_TABLE . " SET block_position = 0 WHERE block_id = $block_id";
				$db->sql_query($sql);

				$cache->destroy('_blocks');

				add_log('admin', 'LOG_BLOCK_DISABLED', (!empty($user->lang[strtoupper($disabled_block)])) ? $user->lang[strtoupper($disabled_block)] : $disabled_block);

			break;

			case 'move_up':
			case 'move_down':

				if (!$block_id)
				{
					trigger_error($user->lang['MUST_SELECT_BLOCK'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Get current order id...
				$sql = 'SELECT block_order AS current_order
					FROM ' . PORTAL_BLOCKS_TABLE . "
					WHERE block_id = $block_id";
				$result = $db->sql_query($sql);
				$current_order = (int) $db->sql_fetchfield('current_order');
				$db->sql_freeresult($result);

				if ($current_order == 0 && $action == 'move_up')
				{
					break;
				}
				$switch_order_id = ($action == 'move_down') ? $current_order + 1 : $current_order - 1;

				$sql = 'UPDATE ' . PORTAL_BLOCKS_TABLE . "
					SET block_order = $current_order
					WHERE block_order = $switch_order_id
						AND block_id <> $block_id";
				$db->sql_query($sql);

				if ($db->sql_affectedrows())
				{
					$sql = 'UPDATE ' . PORTAL_BLOCKS_TABLE . "
						SET block_order = $switch_order_id
						WHERE block_order = $current_order
							AND block_id = $block_id";
					$db->sql_query($sql);
				}

				$cache->destroy('_blocks');

			break;

			case 'edit':
			case 'add':

				include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

				$user->add_lang('posting');

				// Assigning custom bbcodes
				display_custom_bbcodes();

				$blocks = $existing_icons = array();

				$sql = 'SELECT *
					FROM ' . PORTAL_BLOCKS_TABLE . '
					ORDER BY block_order';
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$existing_icons[] = $row['block_icon'];

					if ($action == 'edit' && $block_id == $row['block_id'])
					{
						$blocks = $row;
					}
				}
				$db->sql_freeresult($result);

				// Select the block icon
				$icon_list = filelist($phpbb_root_path . $portal_icons_path);
				$edit_icon = $icon_filename_list = '';

				foreach ($icon_list as $path => $icon_ary)
				{
					sort($icon_ary);

					foreach ($icon_ary as $icon)
					{
						$icon = $path . $icon;

						if (!in_array($icon, $existing_icons) || $action == 'edit')
						{
							if ($blocks && $icon == $blocks['block_icon'])
							{
								$selected = ' selected="selected"';
								$edit_icon = $icon;
							}
							else
							{
								$selected = '';
							}

							if (strlen($icon) > 255)
							{
								continue;
							}

							$icon_filename_list .= '<option value="' . htmlspecialchars($icon) . '"' . $selected . '>' . $icon . '</option>';
						}
					}
				}

				$icon_filename_list = '<option value=""' . (($edit_icon == '') ? ' selected="selected"' : '') . '>' . $user->lang['SELECT_BLOCK_ICON'] . '</option>' . $icon_filename_list;
				unset($existing_icons, $icon_list);

				$block_groups = '';
				$sql = 'SELECT g.*
					FROM ' . GROUPS_TABLE . ' g
					ORDER BY g.group_id';
				$result = $db->sql_query($sql);
				
				$block_groups = '<option value="0"' . ((0 <> isset($blocks['block_groups'])) ? '' : ' selected="selected"') .  '>' . "Alle" . '</option>';
				while ($row = $db->sql_fetchrow($result))
				{
					$block_groups .= '<option value="' . $row['group_id'] . '"' . (($row['group_id'] <> isset($blocks['block_groups'])) ? '' : ' selected="selected"') .  '>' . (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']) . '</option>';
				}
				$db->sql_freeresult($result);

				// Select the display position for block
				$position_list = array(
					'none'			=> array($user->lang['BLOCK_POSITION_NONE'], BLOCK_NONE),
					'left'			=> array($user->lang['BLOCK_POSITION_LEFT'], BLOCK_LEFT),
					'right'			=> array($user->lang['BLOCK_POSITION_RIGHT'], BLOCK_RIGHT),
					'top'			=> array($user->lang['BLOCK_POSITION_TOP'], BLOCK_TOP),
					'bottom'		=> array($user->lang['BLOCK_POSITION_BOTTOM'], BLOCK_BOTTOM),
					'middle_top'	=> array($user->lang['BLOCK_POSITION_MIDDLE_TOP'], BLOCK_MIDDLE_TOP),
					'middle_bottom'	=> array($user->lang['BLOCK_POSITION_MIDDLE_BOTTOM'], BLOCK_MIDDLE_BOTTOM),
				);

				$s_position_options = '<option value=""' . ((!isset($blocks['block_position'])) ? ' selected="selected"' : '') . '>' . $user->lang['SELECT_BLOCK_POSITION'] . '</option>';

				foreach ($position_list as $position_var => $position_ary)
				{
					$selected = (isset($blocks['block_position']) && $position_ary[1] == $blocks['block_position']) ? ' selected="selected"' : '';
					$s_position_options .= '<option value="' . $position_ary[1] . '" ' . $selected . '>' . $position_ary[0] . '</option>';
				}

				// Select the block type
				$type_list = array(
					0	=> array($user->lang['BLOCK_CUSTOM'], 'custom'),
					1	=> array($user->lang['BLOCK_BIRTHDAY'], 'birthday'),
					2	=> array($user->lang['BLOCK_ONLINE'], 'online'),
					3	=> array($user->lang['BLOCK_SEARCH'], 'search'),
					4	=> array($user->lang['BLOCK_CLOCK'], 'clock'),
					5	=> array($user->lang['BLOCK_USER_MENU'], 'user_menu'),
					6	=> array($user->lang['BLOCK_CHANGE_STYLE'], 'change_style'),
					7	=> array($user->lang['BLOCK_DONATION'], 'donation'),
					8	=> array($user->lang['BLOCK_LINKS'], 'links'),
					9	=> array($user->lang['BLOCK_LATEST_BOTS'], 'latest_bots'),
					10	=> array($user->lang['BLOCK_LATEST_MEMBERS'], 'latest_members'),
					11	=> array($user->lang['BLOCK_MINI_CALENDAR'], 'mini_calendar'),
					12	=> array($user->lang['BLOCK_ONLINE_FRIENDS'], 'online_friends'),
					13	=> array($user->lang['BLOCK_STATISTICS'], 'statistics'),
					14	=> array($user->lang['BLOCK_TOP_POSTER'], 'top_poster'),
					//15	=> array($user->lang['BLOCK_'], ''),// Add your blocks here...
				);


				
				$s_type_options = '<option value=""' . ((!isset($blocks['block_type'])) ? ' selected="selected"' : '') . '>' . $user->lang['SELECT_BLOCK_TYPE'] . '</option>';

				foreach ($type_list as $type_var => $type_ary)
				{
					$selected = (isset($blocks['block_type']) && $type_ary[1] == $blocks['block_type']) ? ' selected="selected"' : '';
					$s_type_options .= '<option value="' . $type_ary[1] . '" ' . $selected . '>' . $type_ary[0] . '</option>';
				}

				$block_text_data = array(
					'text'			=> (isset($blocks['block_text'])) ? $blocks['block_text'] : '',
					'allow_bbcode'	=> true,
					'allow_smilies'	=> true,
					'allow_urls'	=> true
				);

				$block_text_preview = '';

				if (isset($blocks['block_text']))
				{
					if (!isset($blocks['block_text_uid']))
					{
						$blocks['block_text_uid'] = '';
						$blocks['block_text_bitfield'] = '';
						$blocks['block_text_options'] = 0;

						generate_text_for_storage($blocks['block_text'], $blocks['block_text_uid'], $blocks['block_text_bitfield'], $blocks['block_text_options'], request_var('text_allow_bbcode', false), request_var('text_allow_urls', false), request_var('text_allow_smilies', false));
					}
					$block_text_preview = generate_text_for_display($blocks['block_text'], $blocks['block_text_uid'], $blocks['block_text_bitfield'], $blocks['block_text_options']);
					$block_text_data = generate_text_for_edit($blocks['block_text'], $blocks['block_text_uid'], $blocks['block_text_options']);
				}

				$template->assign_vars(array(
					'TYPE'			=> (isset($blocks['block_type'])) ? $blocks['block_type'] : '',
					'ICONS_PATH'	=> $phpbb_root_path . $portal_icons_path,
					
					'BLOCK_TITLE'			=> (isset($blocks['block_title'])) ? $blocks['block_title'] : '',
					'BLOCK_PAYPAL'			=> (isset($portal_config['portal_pay_acc'])) ? $portal_config['portal_pay_acc'] : '',
					'BLOCK_BIRTHDAY'		=> (isset($portal_config['portal_birthdays_ahead'])) ? $portal_config['portal_birthdays_ahead'] : '',
					'BLOCK_LATEST_MEMBERS'	=> (isset($portal_config['portal_max_last_member'])) ? $portal_config['portal_max_last_member'] : '',
					'BLOCK_ONLINE_FRIENDS'	=> (isset($portal_config['portal_max_online_friends'])) ? $portal_config['portal_max_online_friends'] : '',
					'BLOCK_LATEST_BOTS'		=> (isset($portal_config['portal_last_visited_bots_number'])) ? $portal_config['portal_last_visited_bots_number'] : '',
					'BLOCK_GROUPS'			=> (isset($blocks['block_groups'])) ? $blocks['block_groups'] : 0,
					'BLOCK_POSITION'		=> (isset($blocks['block_position'])) ? $blocks['block_position'] : 0,
					'BLOCK_ICON'			=> ($edit_icon) ? $phpbb_root_path . $portal_icons_path . '/' . $edit_icon : $phpbb_admin_path . 'images/spacer.gif',
					'BLOCK_TEXT'			=> $block_text_data['text'],
					'BLOCK_TEXT_PREVIEW'	=> $block_text_preview,

					'U_BACK'	=> $this->u_action,
					'U_ACTION'	=> $this->u_action . '&amp;id=' . $block_id,

					'S_EDIT'					=> true,
					'S_ICON_FILENAME_LIST'		=> $icon_filename_list,
					'S_POSITION_OPTIONS'		=> $s_position_options,
					'S_BLOCK_GROUPS'			=> $block_groups,
					'S_TYPE_OPTIONS'			=> $s_type_options,
					'S_SELECT_BLOCK'			=> (!isset($blocks['block_type']) || $blocks['block_type'] != 'custom') ? true : false,
					'S_SELECT_BIRTHDAY'			=> (!isset($blocks['block_type']) || $blocks['block_type'] != 'birthday') ? true : false,
					'S_SELECT_ONLINE_FRIENDS'	=> (!isset($blocks['block_type']) || $blocks['block_type'] != 'online_friends') ? true : false,
					'S_SELECT_PAYPAL'			=> (!isset($blocks['block_type']) || $blocks['block_type'] != 'donation') ? true : false,
					'S_SELECT_LATEST_MEMBERS'	=> (!isset($blocks['block_type']) || $blocks['block_type'] != 'latest_members') ? true : false,
					'S_SELECT_LATEST_BOTS'		=> (!isset($blocks['block_type']) || $blocks['block_type'] != 'latest_bots') ? true : false,
					'S_TEXT_BBCODE_CHECKED'		=> ($block_text_data['allow_bbcode']) ? true : false,
					'S_TEXT_SMILIES_CHECKED'	=> ($block_text_data['allow_smilies']) ? true : false,
					'S_TEXT_URLS_CHECKED'		=> ($block_text_data['allow_urls']) ? true : false,
				));

				return;

			break;
		}

		$template->assign_vars(array(
			'U_ACTION'	=> $this->u_action,
		));

		$sql = 'SELECT *
			FROM ' . PORTAL_BLOCKS_TABLE . '
			ORDER BY block_order';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			switch ($row['block_position'])
			{
				case BLOCK_LEFT:
					$position = $user->lang['BLOCK_POSITION_LEFT'];
				break;

				case BLOCK_RIGHT:
					$position = $user->lang['BLOCK_POSITION_RIGHT'];
				break;

				case BLOCK_TOP:
					$position = $user->lang['BLOCK_POSITION_TOP'];
				break;

				case BLOCK_BOTTOM:
					$position = $user->lang['BLOCK_POSITION_BOTTOM'];
				break;

				case BLOCK_MIDDLE_TOP:
					$position = $user->lang['BLOCK_POSITION_MIDDLE_TOP'];
				break;

				case BLOCK_MIDDLE_BOTTOM:
					$position = $user->lang['BLOCK_POSITION_MIDDLE_BOTTOM'];
				break;

				case BLOCK_NONE:
				default:
					$position = $user->lang['BLOCK_POSITION_NONE'];
				break;
			}
	
			$template->assign_block_vars('blocks', array(
				'BLOCK_TITLE'		=> (!empty($user->lang[strtoupper($row['block_title'])])) ? $user->lang[strtoupper($row['block_title'])] : $row['block_title'],
				'BLOCK_POSITION'	=> $position,
				//'BLOCK_GROUP'		=> $groups,
				'BLOCK_TYPE'		=> $user->lang['BLOCK_' . strtoupper($row['block_type'])],
				'BLOCK_ICON'		=> $phpbb_root_path . $portal_icons_path . '/' . $row['block_icon'],

				'U_DISABLE'		=> $this->u_action . '&amp;action=disable&amp;id=' . $row['block_id'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['block_id'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['block_id'],
				'U_MOVE_UP'		=> $this->u_action . '&amp;action=move_up&amp;id=' . $row['block_id'],
				'U_MOVE_DOWN'	=> $this->u_action . '&amp;action=move_down&amp;id=' . $row['block_id'],

				'S_BLOCK_ICON'		=> ($row['block_icon']) ? true : false,
				'S_BLOCK_DISABLED'	=> ($row['block_position'] == BLOCK_NONE) ? true : false,
			));	
		}
		$db->sql_freeresult($result);
	}
}

?>