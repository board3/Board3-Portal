<?php
/**
*
* @package testing
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\mock;

class user extends \PHPUnit_Framework_TestCase
{
	public $lang = array();

	public function set($data)
	{
		$this->assertTrue(is_array($data));

		foreach ($data as $key => $column)
		{
			$this->lang[$key] = $column;
		}
	}

	public function add_lang_ext($ext, $file)
	{
		if ($ext != 'board3/portal')
		{
			return; // can't support other extensions
		}

		if (is_array($file))
		{
			foreach ($file as $cur_file)
			{
				$this->add_lang_ext($ext, $cur_file);
			}
			return;
		}

		if (file_exists(dirname(__FILE__) . '/../../language/en/' . $file . '.php'))
		{
			include_once(dirname(__FILE__) . '/../../language/en/' . $file . '.php');

			if (isset($lang))
			{
				$this->set($lang);
			}
		}
		else
		{
			$this->markTestIncomplete('Unable to include language file ' . $file);
		}
	}

	public function lang($var)
	{
		return $this->lang[$var];
	}
}
