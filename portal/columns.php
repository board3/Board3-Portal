<?php
/**
 *
 * @package Board3 Portal v2.1
 * @copyright (c) 2014 Board3 Group ( www.board3.de )
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace board3\portal\portal;

class columns
{
	/**
	 * Convert column number to string equivalent
	 *
	 * @param int $column Column number
	 *
	 * @return string String representation of column number; default: ''
	 */
	public function number_to_string($column)
	{
		switch ($column)
		{
			case 1:
				return 'left';
			case 2:
				return 'center';
			case 3:
				return 'right';
			case 4:
				return 'top';
			case 5:
				return 'bottom';
			default:
				return '';
		}
	}

	/**
	 * Convert column string to equivalent number
	 *
	 * @param string $column Column name
	 *
	 * @return int The column number; default: 0
	 */
	public function string_to_number($column)
	{
		switch ($column)
		{
			case 'left':
				return 1;
			case 'center':
				return 2;
			case 'right':
				return 3;
			case 'top':
				return 4;
			case 'bottom':
				return 5;
			default:
				return 0;
		}
	}

	/**
	 * Convert column string to equivalent constant
	 *
	 * @param string $column Column name
	 *
	 * @return int Column constant; default: 0
	 */
	public function string_to_constant($column)
	{
		switch ($column)
		{
			case 'top':
				return 1;
			case 'left':
				return 2;
			case 'center':
				return 4;
			case 'right':
				return 8;
			case 'bottom':
				return 16;
			default:
				return 0;
		}
	}
}