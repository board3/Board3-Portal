<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_PORTAL'))
{
   exit;
}

$allow_bbcode = 1;
$allow_urls = 1;
$allow_smilies = 1;

// Center Box
	if ($portal_config['portal_custom_center'])
	{
		if ($portal_config['portal_custom_center_bbcode'])
		{
			$message_parser = new parse_message($portal_config['portal_custom_code_center']);
			$message_parser->parse($allow_bbcode, $allow_urls, $allow_smilies);

			$text_center = $message_parser->message;
			$bbcode_uid = $message_parser->bbcode_uid;
			$bbcode_bitfield = $message_parser->bbcode_bitfield; 

			$bbcode = new bbcode(base64_encode($bbcode_bitfield));
			$text_center = censor_text($text_center);
			$bbcode->bbcode_second_pass($text_center, $bbcode_uid, $bbcode_bitfield);
			$text_center = bbcode_nl2br($text_center);
			$text_center = smiley_text($text_center);

			       $template->assign_vars(array(
					'PORTAL_CUSTOM_CENTER_CODE'   => $text_center,	
			       ));
		}
		else
		{
			       $template->assign_vars(array(
					'PORTAL_CUSTOM_CENTER_CODE'   => htmlspecialchars_decode($portal_config['portal_custom_code_center'],ENT_QUOTES),
			       ));
		}
       $template->assign_vars(array(
		'S_CUSTOM_CENTER' => true,		
		'PORTAL_CUSTOM_CENTER_HEADLINE'	=> $portal_config['portal_custom_center_headline'],
       ));
	}

// Small Box
	if ($portal_config['portal_custom_small'])
	{
		if ($portal_config['portal_custom_small_bbcode'])
		{
			$message_parser = new parse_message($portal_config['portal_custom_code_small']);
			$message_parser->parse($allow_bbcode, $allow_urls, $allow_smilies);

			$text_small = $message_parser->message;
			$bbcode_uid = $message_parser->bbcode_uid;
			$bbcode_bitfield = $message_parser->bbcode_bitfield; 

			$bbcode = new bbcode(base64_encode($bbcode_bitfield));
			$text_small = censor_text($text_small);
			$bbcode->bbcode_second_pass($text_small, $bbcode_uid, $bbcode_bitfield);
			$text_small = bbcode_nl2br($text_small);
			$text_small = smiley_text($text_small);

			       $template->assign_vars(array(
					'PORTAL_CUSTOM_SMALL_CODE'   => $text_small,
			       ));
		}
		else
		{
			       $template->assign_vars(array(
					'PORTAL_CUSTOM_SMALL_CODE'   => htmlspecialchars_decode($portal_config['portal_custom_code_small'],ENT_QUOTES),
			       ));
		}
       $template->assign_vars(array(
		'S_CUSTOM_SMALL' => true,
		'PORTAL_CUSTOM_SMALL_HEADLINE'	=> $portal_config['portal_custom_small_headline'],
       ));

	}

?>