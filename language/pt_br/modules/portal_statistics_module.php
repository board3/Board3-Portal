<?php
/**
*
* @package Board3 Portal v2.1 - Statistics
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Brazilian Portuguese  translation by null2 (c) 2015 [ver 2.1.0] (https://github.com/phpBBTraducoes) 
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
	'ST_TOP'				=> 'Totais',
	'ST_TOP_ANNS'			=> 'Total de anúncios:',
	'ST_TOP_STICKYS'		=> 'Total de notas:',
	'ST_TOT_ATTACH'			=> 'Total de anexos:',
	'TOPICS_PER_DAY_OTHER'	=> 'Tópicos por dia: <strong>%d</strong>',
	'TOPICS_PER_DAY_ZERO'	=> 'Tópicos por dia: <strong>0</strong>',
	'POSTS_PER_DAY_OTHER'	=> 'Mensagens por dia: <strong>%d</strong>',
	'POSTS_PER_DAY_ZERO'	=> 'Mensagens por dia: <strong>0</strong>',
	'USERS_PER_DAY_OTHER'	=> 'Usuários por dia: <strong>%d</strong>',
	'USERS_PER_DAY_ZERO'	=> 'Usuários por dia: <strong>0</strong>',
	'TOPICS_PER_USER_OTHER'	=> 'Tópicos por usuário: <strong>%d</strong>',
	'TOPICS_PER_USER_ZERO'	=> 'Tópicos por usuário: <strong>0</strong>',
	'POSTS_PER_USER_OTHER'	=> 'Mensagens por usuário: <strong>%d</strong>',
	'POSTS_PER_USER_ZERO'	=> 'Mensagens por usuário: <strong>0</strong>',
	'POSTS_PER_TOPIC_OTHER'	=> 'Mensagens por tópico: <strong>%d</strong>',
	'POSTS_PER_TOPIC_ZERO'	=> 'Mensagens por tópico: <strong>0</strong>',
));
