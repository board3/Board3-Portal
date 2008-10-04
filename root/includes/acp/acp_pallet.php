<?php

/**
*
* @package - Board3portal
* @version $Id: acp_pallet.php 325 2008-08-17 18:59:40Z kevin74 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

class acp_pallet
{
	function main($id, $mode)
	{
		global $db, $user, $template;
		global $config, $portal_config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		
		$user->add_lang('mods/lang_pallet_acp');
		
		define('IN_PALLET_ACP', true);
		
		$block_sql = 'SELECT * FROM ' . PORTAL_BLOCKS_TABLE . ' ORDER BY block_position ASC , block_order ASC';
		$block_result = $db->sql_query($block_sql);
		
		$template->assign_vars(array(
			'ICON_MOVE_RIGHT'				=> '<img src="' . $phpbb_admin_path . 'images/icon_right.gif" alt="' . $user->lang['MOVE_RIGHT'] . '" title="' . $user->lang['MOVE_RIGHT'] . '" />',
			'ICON_MOVE_LEFT'			=> '<img src="' . $phpbb_admin_path . 'images/icon_left.gif" alt="' . $user->lang['MOVE_LEFT'] . '" title="' . $user->lang['MOVE_LEFT'] . '" />',
		));

		
		$block_array = array();
		
		while ($block_row = $db->sql_fetchrow($block_result))
		{
			switch( $block_row['block_position'] )
			{
				case 0:
					$block_pos = 'left';
					$block_type = 'side';
				break;
				case 1:
					$block_pos = 'center';
					$block_type = '';
				break;
				case 2:
					$block_pos = 'right';
					$block_type = 'side';
				break;
			}
			
			$block_array[$block_pos][$block_row['block_order']] = array(
				'block_name' => ( $block_type == '' ) ? $block_row['block_name'] : $block_row['block_name'] . '_' . $block_type,
				'block_enabled' => $block_row['block_enabled'],
			);
		}
		
		$left_count = sizeof($block_array['left']);
		$center_count = sizeof($block_array['center']);
		$right_count = sizeof($block_array['right']);
		
		$table_length = max($left_count, $center_count, $right_count);
		
		for($i = 0; $i < $table_length; $i++) {
			$table_row = array(
				'LEFT' => '',
				'S_LEFT_ENALBED' => false,
				'CENTER' => '',
				'S_CENTER_ENALBED' => false,
				'RIGHT' => '',
				'S_RIGHT_ENALBED' => false,
				'S_LEFT_FIRST_ROW' => false,
				'S_LEFT_LAST_ROW' => false,
				'S_CENTER_FIRST_ROW' => false,
				'S_CENTER_LAST_ROW' => false,
				'S_RIGHT_FIRST_ROW' => false,
				'S_RIGHT_LAST_ROW' => false,
			);
						
			if( isset( $block_array['left'][$i] ) )
			{
				if( $i == 0 )
				{
					$table_row['S_LEFT_FIRST_ROW'] = true;
				}
				
				if( $i == $left_count-1 )
				{
					$table_row['S_LEFT_LAST_ROW'] = true;
				}
				
				if ( $block_array['left'][$i]['block_enabled'] )
				{
					$table_row['S_LEFT_ENABLED'] = true;
				}
				
				$table_row['LEFT'] = $block_array['left'][$i]['block_name'];
			}
			
			if( isset( $block_array['center'][$i] ) )
			{
				if( $i == 0 )
				{
					$table_row['S_CENTER_FIRST_ROW'] = true;
				}
				
				if( $i == $center_count-1 )
				{
					$table_row['S_CENTER_LAST_ROW'] = true;
				}
				
				if ( $block_array['center'][$i]['block_enabled'] )
				{
					$table_row['S_CENTER_ENABLED'] = true;
				}
				
				$table_row['CENTER'] = $block_array['center'][$i]['block_name'];
			}
			
			if( isset( $block_array['right'][$i] ) )
			{
				if( $i == 0 )
				{
					$table_row['S_RIGHT_FIRST_ROW'] = true;
				}
				
				if( $i == $right_count-1 )
				{
					$table_row['S_RIGHT_LAST_ROW'] = true;
				}
				
				if ( $block_array['right'][$i]['block_enabled'] )
				{
					$table_row['S_RIGHT_ENABLED'] = true;
				}
				
				$table_row['RIGHT'] = $block_array['right'][$i]['block_name'];
			}
			
			$template->assign_block_vars('table_row', $table_row);
		}
		
		$l_title = 'ACP_PALLET_LAYOUT';
		
		$this->tpl_name = 'acp_pallet';
		$this->page_title = $l_title;
		
		$template->assign_var('S_LAYOUT_SETTINGS', true);
		
		
		
		/*$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$l_title],
			'L_TITLE_EXPLAIN'	=> $user->lang[$l_title . '_EXPLAIN'],
			'U_ACTION'			=> $this->u_action)
		);
		
		$template->assign_block_vars('options', array(
			'KEY'			=> $config_key,
			'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
			'S_EXPLAIN'		=> $vars['explain'],
			'TITLE_EXPLAIN'	=> $l_explain,
			'CONTENT'		=> build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
			)
		);*/
	}
}

?>