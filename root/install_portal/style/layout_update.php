<?php

if( !defined('IN_PHPBB') || !defined('IN_PORTAL_INSTALL') )
{
	exit;
}

include $phpbb_root_path.'install_portal/style/layout_header.' . $phpEx;

if( $updated === TRUE )
{

$old_ver_str = ( $phpbb3portal === TRUE ) ? $old_version . ' of phpBB3 Portal' : $old_version ;

?>

	<h1><?php echo $user->lang['INFORMATION']; ?></h1>
	<p><?php echo sprintf($user->lang['INSTALLER_UPDATE_SUCCESSFUL'], $old_ver_str, $current_version); ?></p>
	<p><?php echo $user->lang['INSTALLER_USEFUL_INFO']; ?></p>

<?php
}
else
{
?>

<h1><?php echo $user->lang['INSTALLER_UPDATE_TITLE']; ?></h1>
<p><?php echo sprintf($user->lang['INSTALLER_UPDATE_NOTE'], $old_version, $current_version); ?></p>
<form id="acp_board" method="post" action="install.php?mode=update">
	<fieldset>
		<legend><?php echo $user->lang['INSTALLER_UPDATE']; ?></legend>
		<dl>
			<dt><label for="confirm"><?php echo $user->lang['INSTALLER_UPDATE_TO']; ?> v<?php echo $current_version; ?>:</label></dt>
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

include $phpbb_root_path.'install_portal/style/layout_footer.' . $phpEx;

?>