<?php
/**
*
* @package Board3 Portal v2 - Donation
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
* @package Donation
*/
class portal_donation_module
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 31;

	/**
	* Default modulename
	*/
	public $name = 'DONATION';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = 'portal_donation.png';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	public $language = 'portal_donation_module';

	public function get_template_center($module_id)
	{
		global $config, $template, $user;

		$template->assign_vars(array(
			'PAY_ACC_CENTER'	=> $config['board3_pay_acc_' . $module_id],
			'PAY_CUSTOM_CENTER'	=> (!empty($config['board3_pay_custom_' . $module_id])) ? $user->data['username_clean'] : false,
		));

		return 'donation_center.html';
	}

	public function get_template_side($module_id)
	{
		global $config, $template, $user;

		$template->assign_vars(array(
			'PAY_ACC_SIDE'	=> $config['board3_pay_acc_' . $module_id],
			'PAY_CUSTOM_SIDE'	=> (!empty($config['board3_pay_custom_' . $module_id])) ? $user->data['username_clean'] : false,
		));

		return 'donation_side.html';
	}

	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_PAYPAL_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_PAYPAL_SETTINGS',
				'board3_pay_acc_' . $module_id		=> array('lang' => 'PORTAL_PAY_ACC', 'validate' => 'string', 'type' => 'text:25:100', 'explain' => true),
				'board3_pay_custom_' . $module_id	=> array('lang' => 'PORTAL_PAY_CUSTOM', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false),
			)
		);
	}

	/**
	* API functions
	*/
	public function install($module_id)
	{
		set_config('board3_pay_acc_' . $module_id, 'your@paypal.com');
		set_config('board3_pay_custom_' . $module_id, true);
		return true;
	}

	public function uninstall($module_id)
	{
		global $db;

		$del_config = array(
			'board3_pay_acc_' . $module_id,
			'board3_pay_custom_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
