<?php

/**
*
* @package - Board3portal
* @version $Id: donate.php 523 2009-08-27 21:41:08Z christian_n $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

if ($portal_config['portal_pay_acc'])
{
	if ($portal_config['portal_pay_c_block'])
	{
		$template->assign_var('S_DISPLAY_PAY_C', true);
	}

	if ($portal_config['portal_pay_s_block'])
	{
		$template->assign_var('S_DISPLAY_PAY_S', true);
	}

	// Assign specific vars
	$template->assign_var('PAY_ACC', $portal_config['portal_pay_acc']);
}

?>