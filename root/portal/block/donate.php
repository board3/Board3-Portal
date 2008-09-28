<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

if ($block_type == '')
{
	if (!isset($template->filename['donate_block']))
	{
		$template->set_filenames(array(
			'donate_block'	=> 'portal/block/donation.html')
		);
	}

	$block_temp = $template->assign_display('donate_block');

	$template->assign_block_vars('portal_column_'.$block_pos, array(
		'BLOCK_DATA'	=> $block_temp)
	);
	unset( $block_temp );
}
else
{
	if (!isset($template->filename['donate_side_block']))
	{
		$template->set_filenames(array(
			'donate_side_block'	=> 'portal/block/donation_small.html')
		);
	}

	$block_temp = $template->assign_display('donate_side_block');

	$template->assign_block_vars('portal_column_'.$block_pos, array(
		'BLOCK_DATA'	=> $block_temp)
	);
	unset( $block_temp );
}

// Assign specific vars
$template->assign_vars(array(
	'PAY_ACC' => $portal_config['portal_pay_acc'],
));

?>