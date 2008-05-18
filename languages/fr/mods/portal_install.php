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

       'INSTALLER_MENU'                  => 'Menu PInUp',
       'INSTALLER_MENU_START'            => 'Démarrer',
       'INSTALLER_UNINSTALL'               => 'Déinstaller',
       'INSTALLER_UPDATE'                  => 'Mettre à jour',
       'INSTALLER_INSTALL'                  => 'Installer',

       'INSTALLER_INTRO_TITLE'            => 'Installation portail/Utilitaire de mise à jour',
       'INSTALLER_INTRO_NOTE'            => 'Bienvenue sur le programme d\'installation du portail /Utilitaire de mise à jour, connu sous le nom de PInUp',

       'INSTALLER_MENU_DONE'               => 'Dernière Version',
       'INSTALLER_MENU_DONE_TEXT'         => 'Vous avez déjà la version %s d\'installée, SVP supprimez le répertoire install_portal et retournez à votre <a href="%s">forums</a>.',

       'INSTALLER_INSTALL_TITLE'            => 'Installation PInUp',
       'INSTALLER_INSTALL_NOTE'            => 'Quand vous choisissez d\'installer le MOD, toutes les bases de données de versions précédentes seront effacées.',
       'INSTALLER_INSTALL_MENU'            => 'Menu Installation',
       'INSTALLER_INSTALL_SUCCESSFUL'      => 'Installation du MOD v%s effectuée avec succès.',
       'INSTALLER_INSTALL_UNSUCCESSFUL'   => 'Installation du MOD v%s n\'est <strong>pas effectuée</strong> avec succès.',
       'INSTALLER_INSTALL_VERSION'         => 'Installion du MOD v%s',
       'INSTALLER_INSTALL_START'         => 'SVP cliquez <a href="%s">Install</a> pour démarrer l\'utilitaire d\'installation.',

       'INSTALLER_UPDATE_TITLE'            => 'Mise à jour PInUp',
       'INSTALLER_UPDATE_NOTE'            => 'Mise à jour du MOD de v%s vers v%s',

       'INSTALLER_UNINSTALL_TITLE'         => 'Désinstallation PInUp',
       'INSTALLER_UNINSTALL_NOTE'         => 'Bienvenue dans le menu de mise à jour',
       'INSTALLER_UNINSTALL_SUCCESSFUL'   => 'Installation du MOD v%s effectuée avec succès.',

       'INSTALLER_NEEDS_ADMIN'         => 'Vous devez être connecté comme administrateur.<br /><a href="../ucp.php?mode=login"><strong>Aller à connexion</strong>',

       'INSTALLER_UPDATE'                  => 'Mise à jour',
       'INSTALLER_UPDATE_MENU'            => 'Menu Mise à jour',
       'INSTALLER_UPDATE_NOTE'            => 'Mise à jour du MOD de v%s vers v%s',
       'INSTALLER_UPDATE_SUCCESSFUL'      => 'Mise à jour du MOD de v%s vers v%s effectuée avec succès.',
       'INSTALLER_UPDATE_UNSUCCESSFUL'   => 'Mise à jour du MOD de v%s vers v%s n\'est <strong>pas effectuée</strong> avec succès.',
       'INSTALLER_UPDATE_VERSION'         => 'Mise à jour du MOD de v%s',
       'INSTALLER_UPDATE_TO'               => 'Mise à jour à',
       'INSTALLER_UPDATE_START'            => 'SVP cliquer sur <a href="%s">Mise à jour</a> pour démarrer l\'utilitaire de mise à jour.',

       'INSTALLER_UNINSTALL_OLDVERSION'   => 'Désolé, PInUp ne supporte pas la déinstallation du portail phpBB3 original.',

       'INSTALLER_ERROR'                  => 'Erreur PInUp',

       'INSTALLER_USEFUL_INFO'            => 'SVP supprimez le répertoire /install_portal.',

       'INSTALLER_UNINSTALL_USEFUL_INFO'   => 'Rappelez-vous de supprimer les fichiers du portail et de supprimer les modification effectuées dans les fichiers édités.',

       'WARNING'                           => 'Attention',
    ));

?>