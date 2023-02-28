<?php
/**
*
* @package Board3 Portal v2.3
* @copyright (c) 2023 Board3 Group ( www.board3.de )
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace board3\portal;

class ext extends \phpbb\extension\base
{
	/**
	* Check whether the extension can be enabled.
	* Provides meaningful(s) error message(s) and the back-link on failure.
	* CLI and 3.2/3.3 compatible.
	*
	* @return bool
	*/
	public function is_enableable()
	{
		$phpbb_min_ver		= '3.2.6';
		$phpbb_below_ver	= '3.4.0-dev';
		$php_min_ver		= '7.1.0';
		$php_below_ver		= '8.3.0-dev';

		if (phpbb_version_compare(PHPBB_VERSION, '3.2.0-dev', '<'))
		{
			$lang = $this->container->get('user');
			$lang->add_lang_ext('board3/portal', 'b3p_enable_error');
		}
		else
		{
			$lang = $this->container->get('language');
			$lang->add_lang('b3p_enable_error', 'board3/portal');
		}
		$error_message	= [$lang->lang('ERROR_B3P_EXTENSION_NOT_ENABLEABLE', $lang->lang('BOARD3_PORTAL'))];

		if ((phpbb_version_compare(PHPBB_VERSION, $phpbb_min_ver, '<') || phpbb_version_compare(PHPBB_VERSION, $phpbb_below_ver, '>=')))
		{
			$error_message[] = $lang->lang('ERROR_B3P_MSG_PHPBB_WRONG_VERSION', $phpbb_min_ver, $phpbb_below_ver);
		}

		if ((phpbb_version_compare(PHP_VERSION, $php_min_ver, '<') || phpbb_version_compare(PHP_VERSION, $php_below_ver, '>=')))
		{
			$error_message[] = $lang->lang('ERROR_B3P_MSG_PHP_WRONG_VERSION', $php_min_ver, $php_below_ver);
		}

		if (phpbb_version_compare(PHPBB_VERSION, '3.3.0-dev', '<') && count($error_message) > 1)
		{
			$error_message = implode('<br>', $error_message);
			trigger_error($error_message . $this->get_adm_back_link(), E_USER_WARNING);
		}

		return (count($error_message) > 1) ? $error_message : true;
	}

	private function get_adm_back_link()
	{
		return adm_back_link(append_sid('index.' . $this->container->getParameter('core.php_ext'), 'i=acp_extensions&amp;mode=main'));
	}
}
