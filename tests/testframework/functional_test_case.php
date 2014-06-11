<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\tests\testframework;

abstract class functional_test_case extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('board3/portal');
	}
}
