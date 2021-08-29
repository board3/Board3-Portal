<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\mock;

class user extends \phpbb\user
{
	public $lang = array();

	public function set($data)
	{
		foreach ($data as $key => $column)
		{
			$this->lang[$key] = $column;
		}
	}

	public function add_lang_ext($ext_name, $lang_set, $use_db = false, $use_help = false)
	{
		if ($ext_name != 'board3/portal')
		{
			return; // can't support other extensions
		}

		if (is_array($lang_set))
		{
			foreach ($lang_set as $cur_file)
			{
				$this->add_lang_ext($ext_name, $cur_file);
			}
			return;
		}

		if (file_exists(dirname(__FILE__) . '/../../language/en/' . $lang_set . '.php'))
		{
			include_once(dirname(__FILE__) . '/../../language/en/' . $lang_set . '.php');

			if (isset($lang))
			{
				$this->set($lang);
			}
		}
	}

	public function lang()
	{
		$args = func_get_args();
		return $this->lang[$args[0]];
	}
}
