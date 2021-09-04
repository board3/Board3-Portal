<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\mock;

class language extends \phpbb\language\language
{
	public function set($data)
	{
		foreach ($data as $key => $column)
		{
			$this->lang[$key] = $column;
		}
	}

	public function add_lang($component, $extension_name = null)
	{
		if (!$extension_name !== null)
		{
			$this->add_lang_ext($extension_name, $component);
		}
		else
		{
			parent::add_lang($component, $extension_name);
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
			$foo = dirname(__FILE__) . '/../../language/en/' . $lang_set . '.php';
			include(dirname(__FILE__) . '/../../language/en/' . $lang_set . '.php');

			if (isset($lang))
			{
				$this->set($lang);
			}
		}
	}
}
