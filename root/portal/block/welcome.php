<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
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

if ( !$portal_config['portal_welcome_guest'] || ( $portal_config['portal_welcome_guest'] && (!isset($user->data['is_registered']) || !$user->data['is_registered']) ) )
{
	$allow_bbcode = 1;
	$allow_urls = 1;
	$allow_smilies = 1;

	$message_parser = new parse_message($portal_config['portal_welcome_intro']);
	$message_parser->parse($allow_bbcode, $allow_urls, $allow_smilies);

	$text = $message_parser->message;
	$bbcode_uid = $message_parser->bbcode_uid;
	$bbcode_bitfield = $message_parser->bbcode_bitfield; 

	$bbcode = new bbcode(base64_encode($bbcode_bitfield));
	$text = censor_text($text);
	$bbcode->bbcode_second_pass($text, $bbcode_uid, $bbcode_bitfield);
	$text = bbcode_nl2br($text);
	$text = smiley_text($text);
	
	if (!isset($template->filename['welcome_block']))
	{
		$template->set_filenames(array(
			'welcome_block'	=> 'portal/block/welcome.html')
		);
	}

	$template->assign_vars(array(
		'PORTAL_WELCOME_INTRO'   => $text,
	));

	$block_temp = $template->assign_display('welcome_block');

	$template->assign_block_vars('portal_column_'.$block_pos, array(
		'BLOCK_DATA'	=> $block_temp)
	);
	unset( $block_temp );
}
?>