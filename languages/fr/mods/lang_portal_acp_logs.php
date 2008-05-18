<?php

/**
 *
 * @package - Board3portal
 * @version $Id$
 * @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://www.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
 * @based on: phpBB3 Portal by Sevdin Filiz, www.phpbb3portal.com
 * @translator (c) ( fred_du_41 - http://www.photos-entre-amis.fr )
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
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
       'LOG_CONFIG_GENERAL'         => '<strong>Portail: Réglages Généraux changés</strong>',
       'LOG_CONFIG_NEWS'            => '<strong>Portail: Réglages News changés</strong>',
       'LOG_CONFIG_ANNOUNCEMENTS'      => '<strong>Portail: Réglages Annonces changés</strong>',
       'LOG_CONFIG_WELCOME'         => '<strong>Portail: Réglages Message de bienvenue changés</strong>',
       'LOG_CONFIG_RECENT'            => '<strong>Portail: Réglages Sujets récents changés</strong>',
       'LOG_CONFIG_WORDGRAPH'         => '<strong>Portail: Réglages wordgraph changés</strong>',
       'LOG_CONFIG_PAYPAL'            => '<strong>Portail: Réglages Donation Paypal changés</strong>',
       'LOG_CONFIG_ATTACHMENTS'      => '<strong>Portail: Réglages Fichiers joints changés</strong>',
       'LOG_CONFIG_MEMBERS'         => '<strong>Portail: Réglages Derniers membres changés</strong>',
       'LOG_CONFIG_POLLS'            => '<strong>Portail: Réglages Sondages changés</strong>',
       'LOG_CONFIG_BOTS'            => '<strong>Portail: Réglages Robots changés</strong>',
       'LOG_CONFIG_POSTER'            => '<strong>Portail: Réglages Top posteurs changés</strong>',
       'LOG_CONFIG_MINICALENDAR'      => '<strong>Portail: Réglages Mini calendrier changés</strong>',
       'LOG_CONFIG_CUSTOMBLOCK'      => '<strong>Portail: Réglages Blocs personnalisés changés</strong>',
       'LOG_CONFIG_LINKS'            => '<strong>Portail: Réglages Bloc liens changés</strong>',

    ));

?>