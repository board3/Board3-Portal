<?php
/**
*
* @package Board3 Portal v2.1 - Statistics
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @translated into French by Galixte (http://www.galixte.com)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge($lang, array(
	'ST_TOP'		=> 'Totaux',
	'ST_TOP_ANNS'	=> 'Total des annonces :',
	'ST_TOP_STICKYS'=> 'Total des post-it :',
	'ST_TOT_ATTACH'	=> 'Total des pièces jointes :',
	'TOPICS_PER_DAY_OTHER'	=> 'Sujets par jour : <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Sujet par jour : <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Messages par jour : <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Message par jour : <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Utilisateurs par jour : <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Utilisateur par jour : <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Sujets par utilisateur : <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Sujet par utilisateur : <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Messages par utilisateur : <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Message par utilisateur : <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Messages par sujet : <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Message par sujet : <strong>0</strong>',
));
