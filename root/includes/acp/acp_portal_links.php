<?php
/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

// COULD BE DELETED

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
class acp_portal_links
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $template, $cache, $portal_config;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('mods/portal');
		$portal_root_path = PORTAL_ROOT_PATH;
		$portal_icons_path = PORTAL_ICONS_PATH;
		include($phpbb_root_path . $portal_root_path . 'includes/functions.' . $phpEx);
		$portal_config = obtain_portal_config();

		// Set up general vars
		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$link_id = request_var('id', 0);

		$this->tpl_name = 'acp_portal_links';
		$this->page_title = 'ACP_PORTAL_LINKS';

		$form_name = 'acp_portal_links';
		add_form_key($form_name);

		switch ($action)
		{
			case 'save':

				if (!check_form_key($form_name))
				{
					trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
				}

				$link_title = utf8_normalize_nfc(request_var('link_title', '', true));
				$link_is_cat = request_var('link_is_cat', 0);
				$link_url = ($link_is_cat) ? '' : request_var('link_url', '');

				if (!$link_title)
				{
					trigger_error($user->lang['NO_LINK_TITLE'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (!$link_is_cat && !$link_url)
				{
					trigger_error($user->lang['NO_LINK_URL'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql_ary = array(
					'link_title'	=> $link_title,
					'link_is_cat'	=> $link_is_cat,
					'link_url'		=> htmlspecialchars_decode($link_url),
				);

				$order_ary = array(
					'link_order'	=> $portal_config['num_links'] + 1,
				);

				if ($link_id)
				{
					$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE link_id = $link_id";
					$message = $user->lang['LINK_UPDATED'];

					add_log('admin', 'LOG_PORTAL_LINK_UPDATED', $link_title);
				}
				else
				{
					$sql = 'INSERT INTO ' . PORTAL_LINKS_TABLE . ' ' . $db->sql_build_array('INSERT', array_merge($sql_ary, $order_ary));
					$message = $user->lang['LINK_ADDED'];

					set_portal_config('num_links', $portal_config['num_links'] + 1, true);
					add_log('admin', 'LOG_PORTAL_LINK_ADDED', $link_title);
				}
				$db->sql_query($sql);

				$cache->destroy('_links');

				trigger_error($message . adm_back_link($this->u_action));

			break;

			case 'delete':

				if (!$link_id)
				{
					trigger_error($user->lang['MUST_SELECT_LINK'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT link_title, link_order
						FROM ' . PORTAL_LINKS_TABLE . "
						WHERE link_id = $link_id";
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($row)
					{
						$row['link_title'] = (string) $row['link_title'];
						$row['link_order'] = (int) $row['link_order'];
					}

					$sql = 'DELETE FROM ' . PORTAL_LINKS_TABLE . " WHERE link_id = $link_id";
					$db->sql_query($sql);

					// Reset link order...
					$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . ' SET link_order = link_order - 1 WHERE link_order > ' . $row['link_order'];
					$db->sql_query($sql);

					$cache->destroy('_links');

					set_portal_config('num_links', $portal_config['num_links'] - 1, true);
					add_log('admin', 'LOG_PORTAL_LINK_REMOVED', $row['link_title']);
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'link_id'	=> $link_id,
						'action'	=> 'delete',
					)));
				}

			break;

			case 'move_up':
			case 'move_down':

				if (!$link_id)
				{
					trigger_error($user->lang['MUST_SELECT_LINK'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Get current order id...
				$sql = 'SELECT link_order AS current_order
					FROM ' . PORTAL_LINKS_TABLE . "
					WHERE link_id = $link_id";
				$result = $db->sql_query($sql);
				$current_order = (int) $db->sql_fetchfield('current_order');
				$db->sql_freeresult($result);

				if ($current_order == 0 && $action == 'move_up')
				{
					break;
				}

				// on move_down, switch position with next order_id...
				// on move_up, switch position with previous order_id...
				$switch_order_id = ($action == 'move_down') ? $current_order + 1 : $current_order - 1;

				// Update order values
				$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . "
					SET link_order = $current_order
					WHERE link_order = $switch_order_id
						AND link_id <> $link_id";
				$db->sql_query($sql);

				// Only update the other entry too if the previous entry got updated
				if ($db->sql_affectedrows())
				{
					$sql = 'UPDATE ' . PORTAL_LINKS_TABLE . "
						SET link_order = $switch_order_id
						WHERE link_order = $current_order
							AND link_id = $link_id";
					$db->sql_query($sql);
				}

			break;

			case 'edit':
			case 'add':

				$links = array();

				$sql = 'SELECT *
					FROM ' . PORTAL_LINKS_TABLE . '
					ORDER BY link_order';
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					if ($action == 'edit' && $link_id == $row['link_id'])
					{
						$links = $row;
					}
				}
				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'LINK_TITLE'	=> (isset($links['link_title'])) ? $links['link_title'] : '',
					'LINK_URL'		=> (isset($links['link_url']) && !$links['link_is_cat']) ? $links['link_url'] : '',

					'U_BACK'	=> $this->u_action,
					'U_ACTION'	=> $this->u_action . '&amp;id=' . $link_id,

					'S_EDIT'				=> true,
					'S_LINK_IS_CAT'			=> (!isset($links['link_is_cat']) || $links['link_is_cat']) ? true : false,
				));

				return;

			break;
		}

		$template->assign_vars(array(
			'U_ACTION'	=> $this->u_action,
		));

		$sql = 'SELECT *
			FROM ' . PORTAL_LINKS_TABLE . '
			ORDER BY link_order';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('links', array(
				'LINK_TITLE'	=> $row['link_title'],
				'LINK_URL'		=> $row['link_url'],

				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['link_id'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['link_id'],
				'U_MOVE_UP'		=> $this->u_action . '&amp;action=move_up&amp;id=' . $row['link_id'],
				'U_MOVE_DOWN'	=> $this->u_action . '&amp;action=move_down&amp;id=' . $row['link_id'],

				'S_LINK_IS_CAT'	=> ($row['link_is_cat']) ? true : false,
			));	
		}
		$db->sql_freeresult($result);
	}
}

?>