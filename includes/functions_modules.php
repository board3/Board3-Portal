<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
 * Convert column number to string equivalent
 *
 * @param int $column Column number
 *
 * @return string String representation of column number; default: ''
 * @deprecated 2.1.0-RC1 (to be removed: 2.1.0)
 */
function column_num_string($column)
{
	$portal_columns = new \board3\portal\portal\columns();
	return $portal_columns->number_to_string($column);
}

/**
 * Convert column string to equivalent number
 *
 * @param string $column Column name
 *
 * @return int The column number; default: 0
 * @deprecated 2.1.0-RC1 (to be removed: 2.1.0)
 */
function column_string_num($column)
{
	$portal_columns = new \board3\portal\portal\columns();
	return $portal_columns->string_to_number($column);
}

/**
 * Convert column string to equivalent constant
 *
 * @param string $column Column name
 *
 * @return int Column constant; default: 0
 * @deprecated 2.1.0-RC1 (to be removed: 2.1.0)
 */
function column_string_const($column)
{
	$portal_columns = new \board3\portal\portal\columns();
	return $portal_columns->string_to_constant($column);
}
