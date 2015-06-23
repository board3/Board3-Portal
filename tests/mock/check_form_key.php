<?php
/**
 *
 * @package testing
 * @copyright (c) Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\modules;

abstract class check_form_key
{
	static public $form_key_valid = false;
}

function check_form_key($value)
{
	return check_form_key::$form_key_valid;
}