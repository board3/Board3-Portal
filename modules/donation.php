<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\modules;

/**
* @package Donation
*/
class donation extends module_base
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

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \board3\portal\includes\modules_helper */
	protected $helper;

	/** @var array List of currencies supported in donations */
	protected $currencies = array(
		'AUD',
		'CAD',
		'CZK',
		'DKK',
		'HKD',
		'HUF',
		'NZD',
		'NOK',
		'PLN',
		'GBP',
		'SGD',
		'SEK',
		'CHF',
		'JPY',
		'USD',
		'EUR',
		'MXN',
		'ILS',
	);

	/**
	* Construct a donation module object
	*
	* @param \phpbb\config\config $config phpBB config
	* @param \phpbb\request\request_interface $request Request
	* @param \phpbb\template\template $template phpBB template
	* @param \phpbb\user $user phpBB user object
	* @param \board3\portal\includes\modules_helper $helper Board3 Portal modules helper
	*/
	public function __construct($config, $request, $template, $user, $helper)
	{
		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->helper = $helper;
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_center($module_id)
	{
		$this->template->assign_vars(array(
			'PAY_ACC_CENTER'	=> $this->config['board3_pay_acc_' . $module_id],
			'PAY_CUSTOM_CENTER'	=> (!empty($this->config['board3_pay_custom_' . $module_id])) ? $this->user->data['username_clean'] : false,
		));

		$this->build_currency_select($module_id, 'b3p_donation_currency_center');

		return 'donation_center.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_side($module_id)
	{
		$this->template->assign_vars(array(
			'PAY_ACC_SIDE'	=> $this->config['board3_pay_acc_' . $module_id],
			'PAY_CUSTOM_SIDE'	=> (!empty($this->config['board3_pay_custom_' . $module_id])) ? $this->user->data['username_clean'] : false,
		));

		$this->build_currency_select($module_id, 'b3p_donation_currency_side', true);

		return 'donation_side.html';
	}

	/**
	* {@inheritdoc}
	*/
	public function get_template_acp($module_id)
	{
		return array(
			'title'	=> 'ACP_PORTAL_PAYPAL_SETTINGS',
			'vars'	=> array(
				'legend1'							=> 'ACP_PORTAL_PAYPAL_SETTINGS',
				'board3_pay_acc_' . $module_id		=> array('lang' => 'PORTAL_PAY_ACC', 'validate' => 'string', 'type' => 'text:25:100', 'explain' => true),
				'board3_pay_custom_' . $module_id	=> array('lang' => 'PORTAL_PAY_CUSTOM', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false),
				'board3_pay_default_' . $module_id	=> array('lang' => 'PORTAL_PAY_DEFAULT', 'validate' => 'string', 'type' => 'custom', 'method' => 'select_currency', 'submit' => 'save_currency', 'explain' => true),
			)
		);
	}

	/**
	 * Build currency select for block name
	 *
	 * @param int $module_id Module ID
	 * @param string $block_name Name of template block
	 * @param bool $short Whether short ISO titles should be used
	 */
	protected function build_currency_select($module_id, $block_name, $short = false)
	{
		foreach ($this->currencies as $currency)
		{
			$this->template->assign_block_vars($block_name, array(
				'VALUE'				=> $currency,
				'TITLE'				=> ($short) ? $currency : $this->user->lang($currency),
				'SELECTED'			=> $currency === $this->config['board3_pay_default_' . $module_id],
			));
		}
	}

	/**
	 * Create select box for attachment filetype
	 *
	 * @param mixed $value Value of input
	 * @param string $key Key name
	 * @param int $module_id Module ID
	 *
	 * @return string Forum select box HTML
	 */
	public function select_currency($value, $key, $module_id)
	{
		$currencies = $selected = array();
		foreach ($this->currencies as $currency)
		{
			$currencies[] = array(
				'title'		=> $this->user->lang($currency),
				'value'		=> $currency,
			);

			if ($currency === $this->config['board3_pay_default_' . $module_id])
			{
				$selected[] = $currency;
			}
		}

		return $this->helper->generate_select_box($key, $currencies, $selected);
	}

	/**
	 * Save currency setting
	 *
	 * @param string $key
	 * @param int $module_id
	 */
	public function save_currency($key, $module_id)
	{
		$this->config->set($key, $this->request->variable('board3_pay_default_' . $module_id, ''));
	}

	/**
	* {@inheritdoc}
	*/
	public function install($module_id)
	{
		$this->config->set('board3_pay_acc_' . $module_id, 'your@paypal.com');
		$this->config->set('board3_pay_custom_' . $module_id, true);
		$this->config->set('board3_pay_default_' . $module_id, 'EUR');
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function uninstall($module_id, $db)
	{
		$del_config = array(
			'board3_pay_acc_' . $module_id,
			'board3_pay_custom_' . $module_id,
			'board3_pay_default_' . $module_id,
		);
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $db->sql_in_set('config_name', $del_config);
		return $db->sql_query($sql);
	}
}
