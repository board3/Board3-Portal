<?php

/**
*
* @package - Board3portal
* @version $Id: custom.php 582 2009-11-22 16:53:25Z marc1706 $
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
		
		// Generate text for display and assign template vars
		$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
		$text_center = generate_text_for_display($text_center, $bbcode_uid, $bbcode_bitfield, $bbcode_options);

		$template->assign_vars(array(
			'PORTAL_CUSTOM_CENTER_CODE'	=> $text_center,
		));
	}
	else
	{
		$template->assign_vars(array(
			'PORTAL_CUSTOM_CENTER_CODE'	=> htmlspecialchars_decode($portal_config['portal_custom_code_center'],ENT_QUOTES),
		));
	}
	$template->assign_vars(array(
		'S_CUSTOM_CENTER'				=> true,
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

		// Generate text for display and assign template vars
		$bbcode_options = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
		$text_small = generate_text_for_display($text_small, $bbcode_uid, $bbcode_bitfield, $bbcode_options);

		$template->assign_vars(array(
			'PORTAL_CUSTOM_SMALL_CODE'	=> $text_small,
		));
	}
	else
	{
		$template->assign_vars(array(
			'PORTAL_CUSTOM_SMALL_CODE'	=> htmlspecialchars_decode($portal_config['portal_custom_code_small'],ENT_QUOTES),
		));
	}
	$template->assign_vars(array(
		'S_CUSTOM_SMALL' => true,
		'PORTAL_CUSTOM_SMALL_HEADLINE'	=> $portal_config['portal_custom_small_headline'],
	));
}

?>