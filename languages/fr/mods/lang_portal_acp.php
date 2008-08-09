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
       'ACP_PORTAL_INFO_SETTINGS'         => 'Réglages Généraux',
       'ACP_PORTAL_INFO_SETTINGS_EXPLAIN'   => 'Merci d\'avoir choisi board3 Portal. Sur cette page vous pouvez administrer le portail de votre forum. Les écrans vous donnerons une vue d\'ensemble de tous les différents réglages du portail. Les liens sur la gauche de cet écran vous permettent de controler tous les aspects de votre portail.',

       'ACP_PORTAL_SETTINGS'            => 'Réglages du Portail',
       'ACP_PORTAL_SETTINGS_EXPLAIN'      => 'Merci d\'avoir choisi board3 Portal. Sur cette page vous pouvez administrer le portail de votre forum. Les écrans vous donnerons une vue d\'ensemble de tous les différents réglages du portail. Les liens sur la gauche de cet écran vous permettent de controler tous les aspects de votre portail.',

       // general
       'ACP_PORTAL_GENERAL_INFO'            => 'Administration du portail',
       'ACP_PORTAL_GENERAL_INFO_EXPLAIN'      => 'Merci d\'avoir choisi board3 Portal. Sur cette page vous pouvez administrer le portail de votre forum. Les écrans vous donnerons une vue d\'ensemble de tous les différents réglages du portail. Les liens sur la gauche de cet écran vous permettent de controler tous les aspects de votre portail.',
       'ACP_PORTAL_VERSION'                  => '<strong>Board3 Portal Version v%s</strong>',
       'ACP_PORTAL_GENERAL_SETTINGS'         => 'Réglages Généraux',
       'ACP_PORTAL_GENERAL_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations et certaines options spécifiques.',
       'PORTAL_ADVANCED_STAT'               => 'Bloc Statistiques avancées',
       'PORTAL_ADVANCED_STAT_EXPLAIN'         => 'Montrer ce Bloc sur le portail.',
       'PORTAL_LEADERS'                  => 'Bloc de la TEAM',
       'PORTAL_LEADERS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_CLOCK'                     => 'Bloc Horloge',
       'PORTAL_CLOCK_EXPLAIN'               => 'Montrer ce Bloc sur le portail.',
       'PORTAL_LINK_US'                  => 'Bloc Faire un lien avec nous',
       'PORTAL_LINK_US_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_BIRTHDAYS'                  => 'Bloc Anniversaire',
       'PORTAL_BIRTHDAYS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_BIRTHDAYS_AHEAD'            => 'Bloc Anniversaires à venir',
       'PORTAL_BIRTHDAYS_AHEAD_EXPLAIN'      => 'Anniversaires à venir jusqu\'à combien de jours .',
       'PORTAL_SEARCH'                     => 'Bloc Recherche',
       'PORTAL_SEARCH_EXPLAIN'               => 'Montrer ce Bloc sur le portail.',
       'PORTAL_WELCOME'                  => 'Bloc de Bienvenue',
       'PORTAL_WELCOME_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_WHOIS_ONLINE'                     => 'Bloc Qui est en ligne?',
       'PORTAL_WHOIS_ONLINE_EXPLAIN'               => 'Montrer ce Bloc sur le portail.',
       'PORTAL_CHANGE_STYLE'                     => 'Bloc Styles',
       'PORTAL_CHANGE_STYLE_EXPLAIN'               => 'Montrer ce Bloc sur le portail.<br /><span style="color:red">SVP notez:</span> si "Annuler le style de l\'utilisateur:" dans les réglages du forum est sur "Oui", Ce Bloc <u>ne sera pas montré</u>, indépendamment de ces réglages.',
       'PORTAL_FRIENDS'                  => 'Bloc Amis',
       'PORTAL_FRIENDS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_MAX_ONLINE_FRIENDS'            => 'Nombre d\'amis effichés.',
       'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'      => 'Valeur limite d\'affichage des amis en ligne.',
       'PORTAL_MAIN_MENU'                  => 'Menu Principal',
       'PORTAL_MAIN_MENU_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_USER_MENU'                  => 'Menu utilisateur / Bloc de connexion',
       'PORTAL_USER_MENU_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_FORUM_INDEX'                     => 'Index du Forum (Liste du Forum)',
       'PORTAL_FORUM_INDEX_EXPLAIN'               => 'Montrer ce Bloc sur le portail.',

       // random member
       'PORTAL_RANDOM_MEMBER'               => 'Bloc Membre aléatoire',
       'PORTAL_RANDOM_MEMBER_EXPLAIN'         => 'Montrer ce Bloc sur le portail.',

       // global announcements
       'ACP_PORTAL_ANNOUNCE_INFO'               => 'Annonces globales',
       'ACP_PORTAL_ANNOUNCE_SETTINGS'            => 'Réglages Annonces globales',
       'ACP_PORTAL_ANNOUNCE_SETTINGS_EXPLAIN'      => 'Ici vous pouvez changer la plupart des informations du Bloc Annonces globales et certaines options spécifiques.',
       'PORTAL_ANNOUNCEMENTS'                  => 'Montrer les Annonces globales',
       'PORTAL_ANNOUNCEMENTS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_ANNOUNCEMENTS_STYLE'            => 'Bloc Annonces globales style compact',
       'PORTAL_ANNOUNCEMENTS_STYLE_EXPLAIN'      => 'Si "Oui" est sélectionné vous utilisez le style compact pour les Annonces globales, "Non" c\'est le style large',
       'PORTAL_NUMBER_OF_ANNOUNCEMENTS'         => 'Nombre d\'annonces sur le portail',
       'PORTAL_NUMBER_OF_ANNOUNCEMENTS_EXPLAIN'   => '0 pour sans limite',
       'PORTAL_ANNOUNCEMENTS_DAY'               => 'Nombre de jours d\'affichage des Annonces',
       'PORTAL_ANNOUNCEMENTS_DAY_EXPLAIN'         => '0 pour sans limite',
       'PORTAL_ANNOUNCEMENTS_LENGTH'            => 'Longueur Maxi pour les Annonces globales',
       'PORTAL_ANNOUNCEMENTS_LENGTH_EXPLAIN'      => '0 pour sans limite',
       'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM'         => 'ID du forum des Annonces globales',
       'PORTAL_GLOBAL_ANNOUNCEMENTS_FORUM_EXPLAIN'   => 'Forum où sont pris les sujets, laisser blanc pour tous les forums, séparer par une virgule pour forums multiples, ex. 1,2,5',
       'PORTAL_ANNOUNCEMENTS_PERMISSIONS'         => 'Permissions Activées/Désactivées',
       'PORTAL_ANNOUNCEMENTS_PERMISSIONS_EXPLAIN'   => 'Prendre les permissions de lecture des forums pour voir les annonces',
       'PORTAL_ANNOUNCEMENTS_ARCHIVE'            => 'Activer le système archive des annonces',
       'PORTAL_ANNOUNCEMENTS_ARCHIVE_EXPLAIN'      => 'Si le système archive des annonces est activé / Les numéros de pages seront affichés.',

       // news
       'ACP_PORTAL_NEWS_INFO'            => 'News',
       'ACP_PORTAL_NEWS_SETTINGS'         => 'Réglages News',
       'ACP_PORTAL_NEWS_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc News et certaines options spécifiques.',
       'PORTAL_NEWS'                  => 'Montrer le Bloc News sur le portail',
       'PORTAL_NEWS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_NEWS_STYLE'               => 'Bloc News style compact',
       'PORTAL_NEWS_STYLE_EXPLAIN'         => 'Si "Oui" est sélectionné vous utilisez le style compact pour les News, "Non" c\'est le style large (texte vu).',
       'PORTAL_SHOW_ALL_NEWS'            => 'Voir tous les sujets de ce forum',
       'PORTAL_SHOW_ALL_NEWS_EXPLAIN'      => 'Inclure les post-it.',
       'PORTAL_NUMBER_OF_NEWS'            => 'Nombre de sujets de News sur le portail',
       'PORTAL_NUMBER_OF_NEWS_EXPLAIN'      => '0 pour sans limite',
       'PORTAL_NEWS_LENGTH'            => 'Longueur Maxi des sujets de News',
       'PORTAL_NEWS_LENGTH_EXPLAIN'      => '0 pour sans limite',
       'PORTAL_NEWS_FORUM'               => 'ID du forum des News',
       'PORTAL_NEWS_FORUM_EXPLAIN'         => 'Forum où seront pris les sujets, laisser blanc pour tous les forums, séparer par une virgule pour forums multiples, ex. 1,2,5',
       'PORTAL_EXCLUDE_FORUM'            => 'ID forums à exclure',
       'PORTAL_EXCLUDE_FORUM_EXPLAIN'      => 'ID des forums dont les sujets seront à exclure, laisser blanc pour autoriser tous les forums, séparer par une virgule pour forums multiples, ex. 1,2,5',
       'PORTAL_NEWS_PERMISSIONS'         => 'Permissions Activées/Désactivées',
       'PORTAL_NEWS_PERMISSIONS_EXPLAIN'   => 'Prendre les permissions de lecture des forums pour voir les News',
       'PORTAL_NEWS_SHOW_LAST'            => 'Voir le message le plus récent',
       'PORTAL_NEWS_SHOW_LAST_EXPLAIN'      => 'Quand activé, le message le plus récent sera vu dans le texte. Quand désactivé, c\'est le premier message du sujet qui le sera.<br />Avec le style compact du Bloc de News le lien renverra sur le message le plus récent.',
       'PORTAL_NEWS_ARCHIVE'            => 'Activer le système archive des News',
       'PORTAL_NEWS_ARCHIVE_EXPLAIN'      => 'Si le système archive des News est activé / les numéros de pages seront affichés.',

       // recent topics
       'ACP_PORTAL_RECENT_INFO'            => 'Sujets récents',
       'ACP_PORTAL_RECENT_SETTINGS'         => 'Réglages Sujets récents',
       'ACP_PORTAL_RECENT_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Sujets récents et certaines options spécifiques.',
       'PORTAL_RECENT'                     => 'Montrer le Bloc Sujets récents',
       'PORTAL_RECENT_EXPLAIN'               => 'Montrer ce Bloc sur le portail.',
       'PORTAL_MAX_TOPIC'                  => 'Nombre de sujets récents ou populaires affichés',
       'PORTAL_MAX_TOPIC_EXPLAIN'            => '0 pour sans limite',
       'PORTAL_RECENT_TITLE_LIMIT'            => 'Nombre de caractères pour les sujets récents ou populaires',
       'PORTAL_RECENT_TITLE_LIMIT_EXPLAIN'      => '0 pour sans limite',

       // paypal
       'ACP_PORTAL_PAYPAL_INFO'            => 'Paypal',
       'ACP_PORTAL_PAYPAL_SETTINGS'         => 'Réglages Paypal',
       'ACP_PORTAL_PAYPAL_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Paypal et certaines options spécifiques.',
       'PORTAL_PAY_C_BLOCK'               => 'Montrer le Bloc cental Paypal',
       'PORTAL_PAY_C_BLOCK_EXPLAIN'         => 'Montrer ce Bloc sur le portail.',
       'PORTAL_PAY_S_BLOCK'               => 'Montrer le petit Bloc Paypal',
       'PORTAL_PAY_S_BLOCK_EXPLAIN'         => 'Montrer ce Bloc sur le portail.',
       'PORTAL_PAY_ACC'                  => 'Votre compte Paypal',
       'PORTAL_PAY_ACC_EXPLAIN'            => 'Entrer votre adresse e-mail Paypal ex. xxx@xxx.com',

       // last member
       'ACP_PORTAL_MEMBERS_INFO'            => 'Derniers membres',
       'ACP_PORTAL_MEMBERS_SETTINGS'         => 'Réglages Dernières membres',
       'ACP_PORTAL_MEMBERS_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Derniers membres et certaines options spécifiques.',
       'PORTAL_LATEST_MEMBERS'               => 'Montrer le Bloc Derniers membres',
       'PORTAL_LATEST_MEMBERS_EXPLAIN'         => 'Montrer ce Bloc sur le portail.',
       'PORTAL_MAX_LAST_MEMBER'            => 'Nombre de membres affichés',
       'PORTAL_MAX_LAST_MEMBER_EXPLAIN'      => '0 pour sans limite',

       // bots
       'ACP_PORTAL_BOTS_INFO'                  => 'Robots',
       'ACP_PORTAL_BOTS_SETTINGS'               => 'Réglages Robots',
       'ACP_PORTAL_BOTS_SETTINGS_EXPLAIN'         => 'Ici vous pouvez changer la plupart des informations du Bloc Robots et certaines options spécifiques.',
       'PORTAL_LOAD_LAST_VISITED_BOTS'            => 'Montrer le Bloc Robots',
       'PORTAL_LOAD_LAST_VISITED_BOTS_EXPLAIN'      => 'Montrer ce Bloc sur le portail.',
       'PORTAL_LAST_VISITED_BOTS_NUMBER'         => 'Nombre de Robots affichés',
       'PORTAL_LAST_VISITED_BOTS_NUMBER_EXPLAIN'   => '0 pour sans limite',

       // polls   
       'ACP_PORTAL_POLLS_INFO'            => 'Sondages',
       'ACP_PORTAL_POLLS_SETTINGS'         => 'Réglages Sondages',
       'ACP_PORTAL_POLLS_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Sondages et certaines options spécifiques.',
       'PORTAL_POLL_TOPIC'               => 'Montrer le Bloc Sondages',
       'PORTAL_POLL_TOPIC_EXPLAIN'         => 'Montrer ce Bloc sur le portail.',
       'PORTAL_POLL_TOPIC_ID'            => 'Id(s) forums des sondages',
       'PORTAL_POLL_TOPIC_ID_EXPLAIN'      => 'Id(s) des forums où seront pris les sondages affichés. laisser blanc pour tous les forums, séparer par une virgule pour forums multiples, ex. 1,2,5.',
       'PORTAL_POLL_LIMIT'               => 'Nombre de sondages affichés',
       'PORTAL_POLL_LIMIT_EXPLAIN'         => 'Nombre de sondages que vous souhaitez afficher sur le portail.',
       'PORTAL_POLL_ALLOW_VOTE'         => 'Autoriser le vote',
       'PORTAL_POLL_ALLOW_VOTE_EXPLAIN'   => 'Autoriser les utilisateurs qui ont les permissions requises à voter à partir du portail.',

       // most poster
       'ACP_PORTAL_MOST_POSTER_INFO'            => 'Top posteurs',
       'ACP_PORTAL_MOST_POSTER_SETTINGS'         => 'Réglages Top posteurs',
       'ACP_PORTAL_MOST_POSTER_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Top posteurs et certaines options spécifiques.',
       'PORTAL_TOP_POSTERS'                        => 'Montrer le Bloc Top posteurs',
       'PORTAL_TOP_POSTERS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_MAX_MOST_POSTER'               => 'Nombre de posteurs affichés',
       'PORTAL_MAX_MOST_POSTER_EXPLAIN'         => '0 pour sans limite',

       // left and right collumn width
       'ACP_PORTAL_COLLUMN_WIDTH_INFO'            => 'Largeur colonne',
       'ACP_PORTAL_COLLUMN_WIDTH_SETTINGS'         => 'Réglage largeur colonnes Gauche et Droite du portail',
       'PORTAL_LEFT_COLLUMN_WIDTH'               => 'Valeur de la largeur de la colonne de gauche',
       'PORTAL_LEFT_COLLUMN_WIDTH_EXPLAIN'         => 'Changer la largeur de la colonne de gauche en pixels, valeur recommandée 180',
       'PORTAL_RIGHT_COLLUMN_WIDTH'            => 'Valeur de la largeur de la colonne de droite',
       'PORTAL_RIGHT_COLLUMN_WIDTH_EXPLAIN'      => 'Changer la largeur de la colonne de droite en pixels, valeur recommandée 180',

       // attachments   
       'ACP_PORTAL_ATTACHMENTS_NUMBER_INFO'            => 'Fichiers joints',
       'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS'         => 'Réglages Fichiers joints',
       'ACP_PORTAL_ATTACHMENTS_NUMBER_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Fichiers joints et certaines options spécifiques.',
       'PORTAL_ATTACHMENTS'                        => 'Montrer le Bloc Fichiers joints',
       'PORTAL_ATTACHMENTS_EXPLAIN'                  => 'Montrer ce Bloc sur le portail.',
       'PORTAL_ATTACHMENTS_NUMBER'                     => 'Nombre de fichiers joints affichés',
       'PORTAL_ATTACHMENTS_NUMBER_EXPLAIN'               => '0 pour sans limite',
       'PORTAL_ATTACHMENTS_FORUM_IDS'                     => 'Id(s) des forums des fichiers joints',
       'PORTAL_ATTACHMENTS_FORUM_IDS_EXPLAIN'            => 'Id(s) des forums à partir desquels les fichiers joints pourront être affichés. laisser blanc pour tous les forums, séparer par une virgule pour forums autorisés multiples.',
       
       // friends
       'ACP_PORTAL_FRIENDS_INFO'            => 'Amis',
       'ACP_PORTAL_FRIENDS_SETTINGS'         => 'Réglages Amis',
       'ACP_PORTAL_FRIENDS_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Amis et certaines options spécifiques.',
       'PORTAL_FRIENDS'                  => 'Montrer le Bloc Amis',
       'PORTAL_FRIENDS_EXPLAIN'            => 'Montrer ce Bloc sur le portail',
       'PORTAL_MAX_ONLINE_FRIENDS'            => 'Nombre d\'amis affichés',
       'PORTAL_MAX_ONLINE_FRIENDS_EXPLAIN'      => 'Nombre limite d\'amis affichés dans le Bloc.',

       // wordgraph
       'ACP_PORTAL_WORDGRAPH_INFO'            => 'Wordgraph',
       'ACP_PORTAL_WORDGRAPH_SETTINGS'         => 'Réglages Wordgraph',
       'ACP_PORTAL_WORDGRAPH_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Wordgraph et certaines options spécifiques.',
       'PORTAL_WORDGRAPH'                  => 'Montrer le Bloc Wordgraph',
       'PORTAL_WORDGRAPH_EXPLAIN'            => 'Montrer ce Bloc sur le portail.<br /><strong>Wordgraph ne fonctionne pas quand fulltext mysql est selectionné comme système de recherche.</strong>',
       'PORTAL_WORDGRAPH_MAX_WORDS'         => 'Nombre de mots affichés',
       'PORTAL_WORDGRAPH_MAX_WORDS_EXPLAIN'   => '0 pour sans limite',
       'PORTAL_WORDGRAPH_WORD_COUNTS'         => 'Include le nombre de mots à l\'affichage',
       'PORTAL_WORDGRAPH_WORD_COUNTS_EXPLAIN'   => 'Affiche le mombre de mots ex. (25).',
       'PORTAL_WORDGRAPH_RATIO'            => 'Taille des mots',
       'PORTAL_WORDGRAPH_RATIO_EXPLAIN'      => 'Changer la taille des mots (plus grand/plus petit) taille mot (par défaut=18)',

       // welcome message
       'ACP_PORTAL_WELCOME_INFO'            => 'Bienvenue',
       'ACP_PORTAL_WELCOME_SETTINGS'         => 'Réglages Bienvenue',
       'ACP_PORTAL_WELCOME_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Bienvenue et certaines options spécifiques.',
       'PORTAL_WELCOME_INTRO'               => 'Message de bienvenue',
       'PORTAL_WELCOME_GUEST'               => 'Message de bienvenue seulement pour les invités?',
       'PORTAL_WELCOME_INTRO_EXPLAIN'         => 'Changer le message de bienvenue (BBCode autorisés).',
       
       // links
       'ACP_PORTAL_LINKS_INFO'          => 'Liens',
       'ACP_PORTAL_LINKS_SETTINGS'       => 'Réglages Liens',
       'ACP_PORTAL_LINKS_SETTINGS_EXPLAIN' => 'Administration du Bloc Liens.',
       'PORTAL_LINKS'                  => 'Bloc Liens',
       'PORTAL_LINKS_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_LINK_TEXT'               => 'Texte/URL',
       'PORTAL_LINK_TEXT_EXPLAIN'         => 'Texte et URL du lien. Utilisez les boutons pour supprimer et réordonner les liens. N\'oubliez pas le http:// !',
       'PORTAL_ADD_LINK_TEXT'            => 'Ajouter un lien',
       'PORTAL_ADD_LINK_TEXT_EXPLAIN'      => 'Cliquer sur le texte pour créer un nouveau lien.',
       'PORTAL_LINK_ADD'               => '<strong>Ajouter</strong>',

       // custom
       'ACP_PORTAL_CUSTOM_INFO'                        => 'Blocs personnalisés',
       'ACP_PORTAL_CUSTOM_SETTINGS'                     => 'Réglages Blocs personnalisés',
       'ACP_PORTAL_CUSTOM_SETTINGS_EXPLAIN'            => 'Ici vous pouvez changer vos Blocs personnalisés. Ces Blocs peuvent contenir du HTML ou des BBCodes pour des sujets tels que: videos, images, flash ou texte. Vous devez juste insérer le code adéquat.',
       'ACP_PORTAL_CUSTOM_SMALL_SETTINGS'                     => 'Réglages pour le petit Bloc personnalisé',
       'PORTAL_CUSTOM_SMALL_HEADLINE'                  => 'Titre pour le petit Bloc personnalisé',
       'PORTAL_CUSTOM_SMALL_HEADLINE_EXPLAIN'            => 'Ici vous pouvez changer le titre pour le petit Bloc personnalisé.',
       'PORTAL_CUSTOM_SMALL'                           => 'Montrer le petit Bloc personnalisé',
       'PORTAL_CUSTOM_SMALL_EXPLAIN'                     => 'Montrer ce Bloc sur le portail.',
       'PORTAL_CUSTOM_SMALL_BBCODE'                     => 'Activer BBCode pour le petit Bloc personnalisé',
       'PORTAL_CUSTOM_SMALL_BBCODE_EXPLAIN'            => 'Les BBCodes peuvent être utilés dans cette zone de saisie. Si BBCode est désactivé, HTML est pris en compte.',
       'PORTAL_CUSTOM_CODE_SMALL'                     => 'Code pour le petit Bloc personnalisé',
       'PORTAL_CUSTOM_CODE_SMALL_EXPLAIN'               => 'Changer le code pour le petit Bloc personnalisé (HTML ou BBCode) ici.',
       'ACP_PORTAL_CUSTOM_CENTER_SETTINGS'                     => 'Réglages pour le Bloc central personnalisé',
       'PORTAL_CUSTOM_CENTER'                           => 'Montrer le Bloc central personnalisé',
       'PORTAL_CUSTOM_CENTER_EXPLAIN'                  => 'Montrer ce Bloc sur le portail.',
       'PORTAL_CUSTOM_CENTER_HEADLINE'                  => 'Titre pour le Bloc central personnalisé',
       'PORTAL_CUSTOM_CENTER_HEADLINE_EXPLAIN'         => 'Ici vous pouvez changer le titre pour le Bloc central personnalisé.',
       'PORTAL_CUSTOM_CENTER_BBCODE'                  => 'Activer BBCode pour le Bloc central personnalisé',
       'PORTAL_CUSTOM_CENTER_BBCODE_EXPLAIN'            => 'Les BBCodes peuvent être utilés dans cette zone de saisie. Si BBCode est désactivé, HTML est pris en compte.',
       'PORTAL_CUSTOM_CODE_CENTER'                     => 'Code pour le Bloc central personnalisé',
       'PORTAL_CUSTOM_CODE_CENTER_EXPLAIN'            => 'Changer le code pour le Bloc central personnalisé (HTML ou BBCode) ici.',

       // minicalendar
       'ACP_PORTAL_MINICALENDAR_INFO'            => 'Mini calendrier',
       'ACP_PORTAL_MINICALENDAR_SETTINGS'         => 'Réglages Mini calendrier',
       'ACP_PORTAL_MINICALENDAR_SETTINGS_EXPLAIN'   => 'Ici vous pouvez changer la plupart des informations du Bloc Mini calendrier et certaines options spécifiques.',
       'PORTAL_MINICALENDAR'                  => 'Montrer le Bloc Mini calendrier',
       'PORTAL_MINICALENDAR_EXPLAIN'            => 'Montrer ce Bloc sur le portail.',
       'PORTAL_MINICALENDAR_TODAY_COLOR'         => 'Couleur du jour actif',
       'PORTAL_MINICALENDAR_TODAY_COLOR_EXPLAIN'   => 'Code HEX des couleurs comme #FFFFFF pour Blanc, ou noms des couleurs comme par exemple vilolet.',
       'PORTAL_MINICALENDAR_DAY_LINK_COLOR'      => 'Couleur du lien jour',
       'PORTAL_MINICALENDAR_DAY_LINK_COLOR_EXPLAIN'=> 'Code HEX des couleurs comme #FFFFFF pour Blanc, ou noms des couleurs comme par exemple vilolet.',


    ));

?>