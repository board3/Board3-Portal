<?php

/**
* This file contains a class, that is able to trim a message from the phpbb
* message_parser to a maximum length without breaking the bbcodes/smilies and
* links.
*
* @author     Joas Schilling	<nickvergessen at gmx dot de>
* @package    trim_message
* @copyright  2011
* @license    http://opensource.org/licenses/gpl-license.php GNU Public License
* @version    1.0
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* phpbb_trim_message class
*/
class phpbb_trim_message
{
	/**
	* Variables
	*/
	private $message			= '';
	private $trimmed_message	= '';
	private $bbcode_uid			= '';
	private $append_str			= '';
	private $length				= 0;
	private $length_tolerance	= 0;
	private $is_trimmed			= null;
	private $bbcodes			= null;

	/**
	* Constructor
	*
	* @param string	$message		parsed message you want to trim
	* @param string	$bbcode_uid		bbcode_uid of the post
	* @param int	$length			length the code should be trimmed to
	* @param string	$append_str		text that is appended after trimmed message
	* @param int	$tolerance		tolerance for the message: we don't trim it
	*								if it is shorter than length + tolerance.
	*/
	public function __construct($message, $bbcode_uid, $length, $append_str = ' [...]', $tolerance = 25)
	{
		$this->message			= $message;
		$this->bbcode_uid		= $bbcode_uid;
		$this->append_str		= $append_str;
		$this->length			= (int) $length;
		$this->length_tolerance	= (int) $tolerance;
	}

	/**
	* Did we trim the message, or was it short enough?
	*/
	public function is_trimmed()
	{
		return (bool) $this->is_trimmed;
	}

	/**
	* Returns the message, trimmed or in full length
	*/
	public function message($force_full_length = false)
	{
		if (is_null($this->is_trimmed) && !$force_full_length)
		{
			$this->is_trimmed = $this->trim();
		}

		return ($this->is_trimmed && !$force_full_length) ? $this->trimmed_message : $this->message;
	}

	/**
	* Filter some easy cases where we can return the result easily
	*
	* @return	bool	Returns whether the message was trimmed or not.
	*/
	private function trim()
	{
		if (utf8_strlen($this->message) <= ($this->length + $this->length_tolerance))
		{
			return false;
		}

		if (!$this->bbcode_uid)
		{
			$this->trimmed_message = utf8_substr($this->message, 0, $this->length) . $this->append_str;
			return true;
		}

		$this->trim_action();
		return $this->bbcodes->is_trimmed;
	}

	/**
	* Do some magic... uhhh
	*/
	private function trim_action()
	{
		/**
		* Prepare the difficult action
		*/
		$this->trimmed_message = $this->message;
		$this->bbcodes = new phpbb_trim_message_bbcodes($this->trimmed_message, $this->bbcode_uid, $this->length);

		/**
		* Step 1:	Get a list of all BBCodes
		*/
		$this->bbcodes->get_bbcodes();

		/**
		* Step 2:	Remove all bbcodes from the list, that are opened after
		*			the trim-position
		*/
		$this->bbcodes->remove_bbcodes_after();

		/**
		* Step 3:	Trim message
		*/
		$this->trimmed_message = utf8_substr($this->message, 0, $this->bbcodes->trim_position);

		/**
		* Step 4:	i)		Remove links/emails/smilies that are cut, somewhere
		*					in the middle
		*			ii)		Renew trim-position if we did something
		*			iii)	Append the message that is provided
		*/
		$this->remove_broken_links();
		$text_length = utf8_strlen($this->trimmed_message);
		if ($this->bbcodes->is_trimmed)
		{
			$this->trimmed_message .= $this->append_str;
		}

		/**
		* Step 5:	Close open BBCodes
		*/
		$open_bbcodes = $this->bbcodes->get_open_bbcodes_after($text_length);
		$this->close_bbcodes($open_bbcodes);
	}

	/**
	* Removes broken smilies, emails and links without the URL-tag.
	*/
	private function remove_broken_links()
	{
		$open_brakets = substr_count($this->trimmed_message, '<');
		$closing_brakets = substr_count($this->trimmed_message, '>');
		if ($open_brakets != $closing_brakets)
		{
			/**
			* There was an open braket for an unparsed link
			* Example: <{cut}!-- l -->
			*/
			$this->trimmed_message = utf8_substr($this->trimmed_message, 0, utf8_strrpos($this->trimmed_message, '<'));
		}

		$open_link = substr_count($this->trimmed_message, '<!-- ');
		if (($open_link % 2) == 1)
		{
			/**
			* We did not close all links we opened, so we cut off the message
			* before the last open tag ;)
			* Example: <!-- l -->{cut}<!-- l -->
			*/
			$this->trimmed_message = utf8_substr($this->trimmed_message, 0, utf8_strrpos($this->trimmed_message, '<!-- '));
			return;
		}
	}

	/**
	* Close all open bbcodes
	*
	* @param	array	$open_bbcodes	Array of all open bbcodes
	*/
	private function close_bbcodes($open_bbcodes)
	{
		foreach ($open_bbcodes as $bbcode_tag)
		{
			$this->trimmed_message .= '[/' . $bbcode_tag . ':' . $this->bbcode_uid . ']';
		}
	}
}
