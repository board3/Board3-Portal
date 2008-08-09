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
    // Placeholders can now contain order information, e.g. instead of
    // 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
    // translators to re-order the output of data while ensuring it remains correct
    //
    // You do not need this where single placeholders are used, e.g. 'Message %d' is fine
    // equally where a string contains only two placeholders which are used to wrap text
    // in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


    $lang = array_merge($lang, array(
       // General
       'PORTAL'            => 'Portail',
       'WELCOME'            => 'Bienvenue',

       'PORTAL_ERROR'         => 'Erreur Portail',
       'PORTAL_DELETE_DIR'      => 'S\'il vous plait, supprimez le répertoire d\'installation du portail: %s',
       'PORTAL_UPDATE'         => 'Mise à jour du Portail',
       'PORTAL_UPDATE_TEXT'   => 'Il y a une mise à jour du portail en attente d\'être installée! Installer <a href="%1$s">%2$s</a>!',

       // news & global announcements
       'LATEST_ANNOUNCEMENTS'   => 'Dernières annonces globales',
       'GLOBAL_ANNOUNCEMENT'   => 'Annonces globales',
       'VIEW_LATEST_ANNOUNCEMENT'   => '1 annonce',
       'VIEW_LATEST_ANNOUNCEMENTS'   => '%d annonces',
       'LATEST_NEWS'         => 'Dernières news',
       'READ_FULL'            => 'Tout lire',
       'NO_NEWS'            => 'Pas de news',
       'NO_ANNOUNCEMENTS'      => 'Pas d\'annonces globales',
       'POSTED_BY'            => 'Posteur',
       'COMMENTS'            => 'Commentaires',
       'VIEW_COMMENTS'         => 'Lire les commentaires',
       'POST_REPLY'         => 'Poster un commentaire',
       'TOPIC_VIEWS'         => 'Vus',
       'JUMP_NEWEST'         => 'Aller au dernier message',
       'JUMP_FIRST'         => 'Aller au premier message',
       'JUMP_TO_POST'         => 'Aller au message',
       'BACK'                     => 'Retour',

       // who is online
       'WIO_TOTAL'         => 'Total',
       'WIO_REGISTERED'   => 'Enregistrés',
       'WIO_HIDDEN'      => 'Invisibles',
       'WIO_GUEST'         => 'Invités',
       //'RECORD_ONLINE_USERS'=> 'View record: <strong>%1$s</strong><br />%2$s',

       // Birthday
       'BIRTHDAYS_AHEAD'              => 'Dans les %s prochains jours',
       'NO_BIRTHDAYS_AHEAD'        => 'Au cours de cette période, Aucun membre n\'a son anniversaire.',

       // user menu
       'USER_MENU'         => 'Menu utilisateur',
       'UM_LOG_ME_IN'      => 'Se souvenir de moi',
       'UM_HIDE_ME'      => 'Cachez moi',
       'UM_MAIN_SUBSCRIBED'=> 'Surveillances',
       'UM_BOOKMARKS'      => 'Favoris',

       // statistics
       /*
       'ST_NEW'      => 'New',
       'ST_NEW_POSTS'   => 'New post',
       'ST_NEW_TOPICS'   => 'New topic',
       'ST_NEW_ANNS'   => 'New announcement',
       'ST_NEW_STICKYS'=> 'New sticky',
       */
       'ST_TOP'      => 'Total',
       'ST_TOP_ANNS'   => 'Total annonces',
       'ST_TOP_STICKYS'=> 'Total post-it',
       'ST_TOT_ATTACH'   => 'Total fichiers joints',

       // search
       'SH'      => 'go',
       'SH_SITE'   => 'forums',
       'SH_POSTS'   => 'messages',
       'SH_AUTHOR'   => 'auteur',
       'SH_ENGINE'   => 'moteurs de recherche',
       'SH_ADV'   => 'recherche avancée',
       
       // recent
       'RECENT_NEWS'      => 'Récents',
       'RECENT_TOPIC'      => 'Sujets récents',
       'RECENT_ANN'      => 'Annonces récentes',
       'RECENT_HOT_TOPIC'   => 'Sujets populaires récents',

       // random member
       'RND_MEMBER'   => 'Membre aléatoire',
       'RND_JOIN'      => 'Inscrit le',
       'RND_POSTS'      => 'Messages',
       'RND_OCC'      => 'Occupation',
       'RND_FROM'      => 'Localisation',
       'RND_WWW'      => 'Site web',

       // top poster
       'TOP_POSTER'   => 'Top posteurs',
       
       // attachments
       'DOWNLOADS'         => 'Pièces jointes',
       'NO_ATTACHMENTS'   => 'Pas de pièce jointe',

       // links
       'LINKS'            => 'Partenaires',
       'NO_LINKS'         => 'Pas de liens',
       
       // latest members
       'LATEST_MEMBERS'   => 'Derniers membres',

       // make donation
       'DONATION'       => 'Faire une donation',
       'DONATION_TEXT'   => 'is a formation suplying services with no intention of any revenue. Anyone who wants to support this formation can do it by donating so that the cost of server, the domain and etc. could be paid of.',
       'PAY_MSG'      => 'After selecting the amount which you want to donate from the menu, you can go on by clicking on the picture of PayPal.',
       'PAY_ITEM'      => 'Faire une donation', // paypal item

       // main menu
       'M_MENU'    => 'Menu',
       'M_CONTENT'   => 'Contenu',
       'M_ACP'      => 'ACP',
       'M_HELP'   => 'Aide',
       'M_BBCODE'   => 'FAQ BBCode',
       'M_TERMS'   => 'Conditions d\'utilisation',
       'M_PRV'      => 'Vie privée',
       'M_SEARCH'   => 'Recherche',

       // link us
       'LINK_US'      => 'Faire un lien avec nous',
       'LINK_US_TXT'   => 'SVP pour faire un lien avec <strong>%s</strong>. Utilisez ce code HTML:',

       // friends
       'FRIENDS'            => 'Amis',
       'FRIENDS_OFFLINE'      => 'Offline',
       'FRIENDS_ONLINE'      => 'Online',
       'NO_FRIENDS'         => 'No friends currently defined',
       'NO_FRIENDS_OFFLINE'   => 'Pas d\'amis offline',
       'NO_FRIENDS_ONLINE'      => 'Pas d\'amis online',
       
       // last bots
       'LAST_VISITED_BOTS'      => 'Les %s derniers robots',
       
       // wordgraph
       'WORDGRAPH'            => 'Wordgraph',

       // change style
       'BOARD_STYLE'         => 'Style du Forum',
       'STYLE_CHOOSE'         => 'Sélection du style',
          
       // team
       'NO_ADMINISTRATORS_P'   => 'Pas d\'administrateurs',
       'NO_MODERATORS_P'      => 'Pas de modérateurs',

       // average Statistics
       'TOPICS_PER_DAY_OTHER'   => 'Sujets par jour: <strong>%d</strong>',
       'TOPICS_PER_DAY_ZERO'   => 'Sujet par jour: <strong>0</strong>',
       'POSTS_PER_DAY_OTHER'   => 'Messages par jour: <strong>%d</strong>',
       'POSTS_PER_DAY_ZERO'   => 'Message par jour: <strong>0</strong>',
       'USERS_PER_DAY_OTHER'   => 'Utilisateurs par jour: <strong>%d</strong>',
       'USERS_PER_DAY_ZERO'   => 'Utilisateur par jour: <strong>0</strong>',
       'TOPICS_PER_USER_OTHER'   => 'Sujets par utilisateur: <strong>%d</strong>',
       'TOPICS_PER_USER_ZERO'   => 'Sujet par utilisateur: <strong>0</strong>',
       'POSTS_PER_USER_OTHER'   => 'Messages par utilisateur: <strong>%d</strong>',
       'POSTS_PER_USER_ZERO'   => 'Messages par utilisateur: <strong>0</strong>',
       'POSTS_PER_TOPIC_OTHER'   => 'Messages par sujet: <strong>%d</strong>',
       'POSTS_PER_TOPIC_ZERO'   => 'Messages par sujet: <strong>0</strong>',

       // Poll
       'POLL'               => 'Sondages',
       'LATEST_POLLS'         => 'Derniers sondages',
       'NO_OPTIONS'         => 'Ce sondage n\'a aucune option disponible.',
       'NO_POLL'            => 'Aucun sondage disponible',
       'RETURN_PORTAL'         => '%sRetour au portail%s',

       // other
       'VIEWING_PORTAL'         => 'Portail',
       'CLOCK'      => 'Horloge',
       'SPONSOR'   => 'Sponsors',
       
       /**
       * DO NOT REMOVE or CHANGE
       */
       'PORTAL_COPY'   => '<a href="http://www.board3.de" title="board3.de">board3 Portal</a> - based on <a href="http://www.phpbb3portal.com" title="phpBB3 Portal">phpBB3 Portal</a>',
       )
    );

    // mini calendar
    $lang = array_merge($lang, array(
       'Mini_Cal_calendar'      => 'Agenda',
       'Mini_Cal_add_event'   => 'Ajouter un évenement',
       'Mini_Cal_events'      => 'Evenements à venir',
       'Mini_Cal_no_events'   => 'Aucun',
       'Mini_cal_this_event'   => 'This month holiday events',
       'View_next_month'      => 'Mois prochain',
       'View_previous_month'   => 'Mois précédent',

    // uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
    // see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
    // currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
       'Mini_Cal_date_format'      => '%b %e',
       'Mini_Cal_date_format_Time'   => '%H:%i',

    // if you change the first day of the week in constants.php, you should change values for the short day names accordingly
    // e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Su'; ... $lang['mini_cal']['day'][7] = 'Sa';
    //      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Mo'; ... $lang['mini_cal']['day'][7] = 'Su';
       'mini_cal'   => array(
          'day'   => array(
             '1'   => 'Lu',
             '2'   => 'Ma',
             '3'   => 'Me',
             '4'   => 'Je',
             '5'   => 'Ve',
             '6'   => 'Sa',
             '7'   => 'Di',
          ),

          'month'   => array(
             '1'   => 'Jan',
             '2'   => 'Fév',
             '3'   => 'Mar',
             '4'   => 'Avr',
             '5'   => 'Mai',
             '6'   => 'Jui',
             '7'   => 'Jul',
             '8'   => 'Aoû',
             '9'   => 'Sep',
             '10'=> 'Oct',
             '11'=> 'Nov',
             '12'=> 'Déc',
          ),

          'long_month'=> array(
             '1'   => 'Janvier',
             '2'   => 'Février',
             '3'   => 'Mars',
             '4'   => 'Avril',
             '5'   => 'Mai',
             '6'   => 'Juin',
             '7'   => 'Juillet',
             '8'   => 'Août',
             '9'   => 'Septembre',
             '10'=> 'Octobre',
             '11'=> 'Novembre',
             '12'=> 'Décembre',
          ),
       ),
    ));

?>