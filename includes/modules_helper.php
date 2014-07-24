<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace board3\portal\includes;

class modules_helper
{
	/**
	* Auth object
	* @var \phpbb\auth\auth
	*/
	protected $auth;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	* @param \phpbb\auth\auth $auth Auth object
	*/
	public function __construct($auth)
	{
		$this->auth = $auth;
	}

	/**
	* Get an array of disallowed forums
	*
	* @param bool $disallow_access Whether the array for disallowing access
	*			should be filled
	*/
	public function get_disallowed_forums($disallow_access)
	{
		if ($disallow_access == true)
		{
			$disallow_access = array_unique(array_keys($this->auth->acl_getf('!f_read', true)));
		}
		else
		{
			$disallow_access = array();
		}

		return $disallow_access;
	}

	/**
	* Generate select box
	*
	* @param string	$key			Key of select box
	* @param array	$select_ary		Array of select box options
	* @param array	$selected_options	Array of selected options
	* @param string	$select_key		Key inside select box options
	*					that holds the option value
	* @return string HTML code of select box
	* @access public
	*/
	public function generate_select_box($key, $select_ary, $selected_options)
	{
		// Build options
		$options = '<select id="' . $key . '" name="' . $key . '[]" multiple="multiple">';
		foreach ($select_ary as $id => $option)
		{
			$options .= '<option value="' . $option['value'] . '"' . ((in_array($option['value'], $selected_options)) ? ' selected="selected"' : '') . '>' . $option['title'] . '</option>';
		}
		$options .= '</select>';

		return $options;
	}
}
