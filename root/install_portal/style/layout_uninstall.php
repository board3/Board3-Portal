<?php

if( !defined('IN_PHPBB') || !defined('IN_PORTAL_INSTALL') )
{
	exit;
}

include 'style/layout_header.' . $phpEx;

if( $confirm == 1 )
{
?>

	<h1><?php echo $user->lang['INFORMATION']; ?></h1>
	<p><?php echo sprintf($user->lang['INSTALLER_UNINSTALL_SUCCESSFUL'], $current_version); ?></p>
	<p><?php echo $user->lang['INSTALLER_UNINSTALL_USEFUL_INFO']; ?></p>

<?php
}
else
{
?>

<h1><?php echo $user->lang['INSTALLER_UNINSTALL_TITLE']; ?></h1>
<p><?php echo $user->lang['INSTALLER_UNINSTALL_NOTE']; ?></p>
<form id="acp_board" method="post" action="install.php?mode=uninstall">
	<fieldset>
		<legend><?php echo $user->lang['INSTALLER_UNINSTALL']; ?></legend>
		<dl>
			<dt><label for="install"><?php echo $user->lang['INSTALLER_UNINSTALL']; ?> v<?php echo $old_version; ?>:</label></dt>
			<dd><label><input name="confirm" value="1" class="radio" type="radio" /><?php echo $user->lang['YES']; ?></label><label><input name="confirm" value="0" checked="checked" class="radio" type="radio" /><?php echo $user->lang['NO']; ?></label></dd>
		</dl>
		<p class="submit-buttons">
			<input class="button1" id="submit" name="submit" value="Submit" type="submit" />&nbsp;
			<input class="button2" id="reset" name="reset" value="Reset" type="reset" />
		</p>
	</fieldset>
</form>

<?php
}

include 'style/layout_footer.' . $phpEx;

?>