<?php

if( !defined('IN_PHPBB') || !defined('IN_PORTAL_INSTALL') )
{
	exit;
}

include $phpbb_root_path.'install_portal/style/layout_header.' . $phpEx;



?>
						<h1><?php echo $user->lang['INSTALLER_INTRO_TITLE']; ?></h1>
						<p><?php echo $user->lang['INSTALLER_INTRO_NOTE']; ?></p>
						<br />
<?php
switch( $check_mode )
{
case 'install':
?>
						<p><?php echo sprintf($user->lang['INSTALLER_INSTALL_START'], append_sid('install.'.$phpEx, 'mode=install')); ?></p>
<?php
break;
case 'update':
?>
						<p><?php echo sprintf($user->lang['INSTALLER_UPDATE_START'], append_sid('install.'.$phpEx, 'mode=update')); ?></p>
<?php
break;
case 'none':
?>
						<p><?php echo sprintf($user->lang['INSTALLER_MENU_DONE_TEXT'], $current_version, append_sid($phpbb_root_path . 'index.'.$phpEx)); ?></p>
<?php
break;
}
include $phpbb_root_path.'style/layout_footer.' . $phpEx;

?>