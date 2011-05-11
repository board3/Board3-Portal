<?php

/**
* This file contains a class, to manage the bbcodes of a given phpbb
* message_parser message.
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
* phpbb_trim_message_bbcodes class
*/
class phpbb_trim_message_bbcodes
{
	/**
	* Variables
	*/
	private $message			= '';
	private $bbcode_uid			= '';
	private $bbcode_list		= array();
	private $array_size			= 0;
	private $max_content_length	= 0;
	private $cur_content_length	= 0;
	private $cur_position		= 0;
	public  $trim_position		= 0;
	public  $is_trimmed			= false;

	/**
	* Constructor
	*
	* @param string	$message		parsed message you want to trim
	* @param string	$bbcode_uid		bbcode_uid of the post
	*/
	public function __construct($message, $bbcode_uid, $content_length)
	{
		$this->message				= $message;
		$this->bbcode_uid			= $bbcode_uid;
		$this->max_content_length	= $content_length;
		$this->array_size			= 0;
	}

	public function get_bbcodes()
	{
		$bbcode_end_length = utf8_strlen(':' . $this->bbcode_uid . ']');
		$quote_end_length = utf8_strlen('&quot;:' . $this->bbcode_uid . ']');

		$possible_bbcodes = explode('[', $this->message);
		$content_length = $this->get_content_length($possible_bbcodes[0]);
		if ($content_length >= $this->max_content_length)
		{
			$allowed_content_position = $this->get_content_position($possible_bbcodes[0], $this->max_content_length);
			$this->trim_position = $this->cur_position + $allowed_content_position;
			// As we did not touch any bbcodes yet, we can just skip all that.
			if (!$this->max_content_length || ($content_length > $this->max_content_length))
			{
				$this->is_trimmed = true;
			}
			return;
		}
		$this->cur_position += utf8_strlen($possible_bbcodes[0]) + 1;
		$this->cur_content_length += $content_length;

		// Skip the first one.
		array_shift($possible_bbcodes);
		$num_possible_bbcodes	= sizeof($possible_bbcodes);
		$num_tested_bbcodes		= 0;
		$start_of_last_part		= 0;

		$allow_close_quote = false;

		foreach ($possible_bbcodes as $part)
		{
			$num_tested_bbcodes++;
			$exploded_parts = explode(':' . $this->bbcode_uid . ']', $part);
			$num_parts = sizeof($exploded_parts);

			/**
			* One element means we do not match an end before the next opening:
			* String: [quote="[bbcode:uid]foobar[/bbcode:uid]":uid]
			* Keys:    ^^^^^^^ = 0
			*/
			if ($num_parts == 1)
			{
				// 1 means, we are in [quote="":uid] and found another bbcode here.
				if (utf8_strpos($exploded_parts[0], 'quote=&quot;') === 0)
				{
					$open_end_quote = utf8_strpos($this->message, '&quot;:' . $this->bbcode_uid . ']', $this->cur_position);
					if ($open_end_quote !== false)
					{
						$close_quote = utf8_strpos($this->message, '[/quote:' . $this->bbcode_uid . ']', $open_end_quote);
						if ($close_quote !== false)
						{
							$open_end_quote += $quote_end_length;
							$this->open_bbcode('quote', $this->cur_position);
							$this->bbcode_action('quote', 'open_end', $open_end_quote);
							$this->cur_position += utf8_strlen($exploded_parts[0]);

							// We allow the 3-keys special-case, when we have found a beginning before...
							$allow_close_quote = true;
						}
					}
				}
			}
			/**
			* Two element is hte normal case:
			* String: [bbcode:uid]foobar
			* Keys:    ^^^^^^ = 0 ^^^^^^ = 1
			* String: [/bbcode:uid]foobar
			* Keys:    ^^^^^^^ = 0 ^^^^^^ = 1
			*/
			elseif ($num_parts == 2)
			{
				// We matched it something ;)
				if ($exploded_parts[0][0] != '/')
				{
					// Open BBCode-tag
					$bbcode_tag = $this->filter_bbcode_tag($exploded_parts[0]);

					$this->open_bbcode($bbcode_tag, $this->cur_position);
					$this->cur_position += utf8_strlen($exploded_parts[0]) + $bbcode_end_length;
					$this->bbcode_action($bbcode_tag, 'open_end', $this->cur_position);

					if (!$allow_close_quote)
					{
						// If we allow a closing quote, we are in the username.
						// We do not count that as content-length.
						$content_length = $this->get_content_length($exploded_parts[1]);
						$max_content_allowed = ($this->max_content_length - $this->cur_content_length);
						if (($content_length >= $max_content_allowed) && !$this->trim_position)
						{
							$allowed_content_position = $this->get_content_position($exploded_parts[1], $max_content_allowed);
							$this->trim_position = $this->cur_position + $allowed_content_position;
						}
						$this->cur_content_length += $content_length;
					}
					$this->cur_position += utf8_strlen($exploded_parts[1]);
				}
				else
				{
					// Close BBCode-tag
					$bbcode_tag = $this->filter_bbcode_tag($exploded_parts[0]);
					$bbcode_tag_extended = $this->filter_bbcode_tag($exploded_parts[0], false);
					if ($bbcode_tag_extended == $bbcode_tag)
					{
						$bbcode_tag_extended = '';
					}

					$this->bbcode_action($bbcode_tag, 'close_start', $this->cur_position);
					$this->cur_position += utf8_strlen($exploded_parts[0]) + $bbcode_end_length;
					$this->bbcode_action($bbcode_tag, 'close_end', $this->cur_position, $bbcode_tag_extended);

					if (!$allow_close_quote)
					{
						// If we allow a closing quote, we are in the username.
						// We do not count that as content-length.
						$content_length = $this->get_content_length($exploded_parts[1]);
						$max_content_allowed = ($this->max_content_length - $this->cur_content_length);
						if (($content_length >= $max_content_allowed) && !$this->trim_position)
						{
							$allowed_content_position = $this->get_content_position($exploded_parts[1], $max_content_allowed);
							$this->trim_position = $this->cur_position + $allowed_content_position;
						}
						$this->cur_content_length += $content_length;
					}
					$this->cur_position += utf8_strlen($exploded_parts[1]);
				}
			}
			/**
			* Three elements means we are closing the opening-quote and the BBCode from inside:
			* String: [quote="[bbcode:uid]foo[/bbcode:uid]bar":uid]quotehere
			* Keys:                           ^^^^^^^ = 0 ^^^^ = 1 ^^^^^^^^^ = 2
			*/
			elseif ($num_parts == 3)
			{
				if (($exploded_parts[0][0] == '/') && (utf8_substr($exploded_parts[1], -6) == '&quot;') && $allow_close_quote)
				{
					$bbcode_tag = $this->filter_bbcode_tag($exploded_parts[0]);

					$this->bbcode_action($bbcode_tag, 'close_start', $this->cur_position);
					$this->cur_position += utf8_strlen($exploded_parts[0]) + $bbcode_end_length;
					$this->bbcode_action($bbcode_tag, 'close_end', $this->cur_position);
					$this->cur_position += utf8_strlen($exploded_parts[1]) + $bbcode_end_length;

					$content_length = $this->get_content_length($exploded_parts[2]);
					$max_content_allowed = ($this->max_content_length - $this->cur_content_length);
					if (($content_length >= $max_content_allowed) && !$this->trim_position)
					{
						$allowed_content_position = $this->get_content_position($exploded_parts[2], $max_content_allowed);
						$this->trim_position = $this->cur_position + $allowed_content_position;
					}
					$this->cur_position += utf8_strlen($exploded_parts[2]);
					$this->cur_content_length += $content_length;

					$allow_close_quote = false;
				}
			}

			// Increase by one for the [ we explode on.
			$this->cur_position++;
		}

		if ($this->cur_content_length > $this->max_content_length)
		{
			$this->is_trimmed = true;
		}
	}

	/**
	* Add a bbcode to the bbcode-list
	*
	* @param	string	$tag			BBCode-tag, Exp: code
	* @param	int		$open_start		start-position of the bbcode-open-tag
	*									(Exp: >[<code]) in the message
	*/
	private function open_bbcode($tag, $open_start)
	{
		$this->bbcode_list[] = array(
			'bbcode_tag'	=> $tag,
			'open_start'	=> $open_start,
			'open_end'		=> 0,
			'close_start'	=> 0,
			'close_end'		=> 0,
		);
		$this->array_size++;
	}

	/**
	* Add position to a listed bbcode
	*
	* @param	string	$tag		BBCode-tag, Exp: code
	* @param	string	$part		part can be one of the following:
	*								i)   open_end	=> [code>]<[/code]
	*								ii)  close_open	=> [code]>[</code]
	*								iii) close_end	=> [code][/code>]<
	* @param	int		$position	start-position of the bbcode-open-tag
	* @param	int		$tag_extended	with the list-bbcode we get some
	*									information about the bbcode at the end
	*									of it. So we need to readd that.
	*/
	private function bbcode_action($tag, $part, $position, $tag_extended = false)
	{
		for ($i = 1; $i <= $this->array_size; $i++)
		{
			if ($this->bbcode_list[$this->array_size - $i]['bbcode_tag'] == $tag)
			{
				if (!$this->bbcode_list[$this->array_size - $i][$part])
				{
					$this->bbcode_list[$this->array_size - $i][$part] = $position;
					if ($tag_extended)
					{
						$this->bbcode_list[$this->array_size - $i]['bbcode_tag'] = $tag_extended;
					}
					return;
				}
			}
		}
	}

	/**
	* Removes all BBcodes after a given position
	*/
	public function remove_bbcodes_after()
	{
		for ($i = 1; $i <= $this->array_size; $i++)
		{
			if ($this->bbcode_list[$this->array_size - $i]['open_start'] >= $this->trim_position)
			{
				unset($this->bbcode_list[$this->array_size - $i]);
			}
		}

		$this->array_size = sizeof($this->bbcode_list);
	}

	/**
	* Returns an array with BBCodes that need to be closed, after the position.
	*/
	public function get_open_bbcodes_after($position)
	{
		$bbcodes = array();
		for ($i = 1; $i <= $this->array_size; $i++)
		{
			if (($this->bbcode_list[$this->array_size - $i]['open_start'] < $position) &&
				 ($this->bbcode_list[$this->array_size - $i]['close_start'] >= $position))
			{
				$bbcodes[] = $this->bbcode_list[$this->array_size - $i]['bbcode_tag'];
			}
		}
		return $bbcodes;
	}

	/**
	* Get the length of the content (substract code for smilie and url parsing)
	*
	* @param	string	$content	Message to get the content length from
	*								Exp:     <markup>text<markup2>
	*								Content:         ^^^^
	*
	* @return	int		length of content without special markup
	*/
	static public function get_content_length($content)
	{
		$content_length = utf8_strlen($content);
		$last_html_opening = $last_html_closing = $last_smiley = false;
		while (($last_html_opening = utf8_strpos($content, '<', $last_html_closing)) !== false)
		{
			$last_html_closing = utf8_strpos($content, '>', $last_html_opening);
			if (($smiley_code = utf8_substr($content, $last_html_opening + 7, ($last_html_closing - $last_html_opening - 11))) != '--')
			{
				if ($last_smiley == $smiley_code)
				{
					$content_length += utf8_strlen($smiley_code);
					$last_smiley = false;
				}
				else
				{
					$last_smiley = $smiley_code;
				}
			}
			$content_length -= ($last_html_closing - $last_html_opening) + 1;
		}
		return $content_length;
	}

	/**
	* Get the position in the text, where we need to cut the message.
	*
	* Exp:     sample<markup>text<markup2>	AL = 8
	* Content: ^^^^^^^^^^^^^^^^  Text-Position = 16
	*
	* @param	string	$content			Message to get the position in
	* @param	int		$allowed_length		Content length we are allowed to add.
	*
	* @return	int		position in the markup-text where we cut the text
	*/
	static public function get_content_position($content, $allowed_length)
	{
		if (utf8_strpos(utf8_substr($content, 0, $allowed_length), '<') === false)
		{
			/**
			* If we did not find any HTML in our section, we can cut it.
			* Exp:     sample<markup>text<markup2>	AL = 3
			* Content: ^^^               Text-Position = 3
			*/
			return $allowed_length;
		}

		$content_length = $allowed_length;
		$start_position = 0;
		$last_smiley = false;
		while (($last_html_opening = utf8_strpos(utf8_substr($content, 0, $content_length), '<', $start_position)) !== false)
		{
			// foreach markup we find in the string, we enlarge our text-size.
			$last_html_closing = utf8_strpos($content, '>', $last_html_opening);
			$content_length += ($last_html_closing - $last_html_opening) + 1;

			$smiley_code = utf8_substr($content, $last_html_opening + 7, ($last_html_closing - $last_html_opening - 11));
			if (($smiley_code != '--') && (utf8_strpos($smiley_code, 'c="{SMILIES_PATH}/') === false))
			{
				if ($last_smiley == $smiley_code)
				{
					$content_length -= utf8_strlen($smiley_code);
					$last_smiley = false;
				}
				else
				{
					$last_smiley = $smiley_code;
				}
			}

			$start_position = $last_html_opening + 1;
		}

		return $content_length;
	}

	/**
	* Filter BBCode-Tags:
	*
	* Exp:	[/*:m]					<= automatically added end of [*]
	* Exp:	[/list:x]				<= end of [list] tag with list-style-element
	* Exp:	[bbcode=param1;param2]	<= start of bbcode-tag with parameters
	*
	* @return	string		plain bbcode-tag
	*/
	static public function filter_bbcode_tag($bbcode_tag, $strip_information = true)
	{
		if ($bbcode_tag[0] == '/')
		{
			$bbcode_tag = utf8_substr($bbcode_tag, 1);
		}

		if ($strip_information && ($bbcode_tag == '*:m'))
		{
			return '*';
		}

		if ($strip_information && (utf8_substr($bbcode_tag, 0, 5) == 'list:'))
		{
			return 'list';
		}

		if ($strip_information && (($equals = utf8_strpos($bbcode_tag, '=')) !== false))
		{
			$bbcode_tag = utf8_substr($bbcode_tag, 0, $equals);
		}

		return $bbcode_tag;
	}
}
