<?php

/**
*
* @package - Board3portal
* @version $Id: welcome.php 577 2009-11-19 21:11:55Z marc1706 $
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB') || !defined('IN_PORTAL'))
{
   exit;
}

$allow_bbcode = $allow_urls = $allow_smilies = true;

// Get bbcode_uid and bbcode_bitfield
$message_parser = new parse_message($portal_config['portal_welcome_intro']);
$message_parser->parse($allow_bbcode, $allow_urls, $allow_smilies);

$text = $message_parser->message;
$bbcode_uid = $message_parser->bbcode_uid;
$bbcode_bitfield = $message_parser->bbcode_bitfield; 

// Generate text for display and assign template vars
$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
$text = generate_text_for_display($text, $bbcode_uid, $bbcode_bitfield, $bbcode_options);

$template->assign_vars(array(
	'S_DISPLAY_WELCOME'		=> true,
	'PORTAL_WELCOME_INTRO'	=> $text,
));

?>