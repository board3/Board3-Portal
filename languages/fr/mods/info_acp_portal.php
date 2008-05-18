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

    $lang = array_merge($lang, array(
       'ACP_PORTAL_INFO'                     => 'Portail',
       'ACP_PORTAL_GENERAL_INFO'               => 'Général',
       'ACP_PORTAL_ANNOUNCE_INFO'               => 'Annonces globales',
       'ACP_PORTAL_NEWS_INFO'                  => 'News',
       'ACP_PORTAL_RECENT_INFO'               => 'Sujets récents',
       'ACP_PORTAL_WORDGRAPH_INFO'               => 'Wordgraph',
       'ACP_PORTAL_GENERAL_INFO'               => 'Réglages Généraux',
       'ACP_PORTAL_PAYPAL_INFO'               => 'Donation Paypal',
       'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'      => 'Fichiers joints',
       'ACP_PORTAL_MEMBERS_INFO'               => 'Derniers membres',
       'ACP_PORTAL_POLLS_INFO'                  => 'Sondages',
       'ACP_PORTAL_BOTS_INFO'                  => 'Dernières visites robots',
       'ACP_PORTAL_MOST_POSTER_INFO'            => 'Top posteurs',
       'ACP_PORTAL_WELCOME_INFO'               => 'Message de bienvenue',
       'ACP_PORTAL_CUSTOM_INFO'               => 'Blocs personnalisés',
       'ACP_PORTAL_MINICALENDAR_INFO'            => 'Mini calendrier',
       'ACP_PORTAL_LINKS_INFO'                  => 'Liens',
    ));

?>