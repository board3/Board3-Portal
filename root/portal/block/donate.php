<?php

/**
*
* @package Board3 Portal v2
* @version $Id$
* @copyright (c) Board3 Group ( www.board3.de )
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