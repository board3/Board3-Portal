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
	protected $column_map = array(
		'left'		=> 1,
		'center'	=> 2,
		'right'		=> 3,
		'top'		=> 4,
		'bottom'	=> 5,
	);

	/**
	 * Convert column number to string equivalent
	 *
	 * @param int $column Column number
	 *
	 * @return string String representation of column number; default: ''
	 */
	public function number_to_string($column)
	{
		return (in_array($column, $this->column_map)) ? array_search($column, $this->column_map) : '';
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
		return (isset($this->column_map[$column])) ? $this->column_map[$column] : 0;
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