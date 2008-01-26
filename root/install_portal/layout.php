<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

$activemenu = ' id="activemenu"';
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-gb" lang="en-gb"><head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
echo '<meta http-equiv="Content-Style-Type" content="text/css">';
echo '<meta http-equiv="Content-Language" content="en-gb">';
echo '<meta http-equiv="imagetoolbar" content="no"><title>' . $page_title . '</title>';
echo '<link href="../adm/style/admin.css" rel="stylesheet" type="text/css" media="screen">';
echo '</head>';
echo '<body class="ltr">';
echo '<div id="wrap">';
echo '	<div id="page-header">';
echo '		<h1>' . $page_title . '</h1>';
echo '		<p><a href="' . $phpbb_root_path . '">' . $user->lang['INDEX'] . '</a></p>';
echo '		<p id="skip"><a href="#acp">Skip to content</a></p>';
echo '	</div>';
echo '	<div id="page-body">';
echo '		<div id="acp">';
echo '		<div class="panel">';
echo '			<span class="corners-top"><span></span></span>';
echo '				<div id="content">';
echo '					<div id="menu">';
echo '						<ul>';
echo '							<li' . (($mode == 'else') ? $activemenu : '') . '><a href="install.php"><span>' . $user->lang['INSTALLER_INTRO'] . '</span></a></li>';
echo '							<li class="header">' . $user->lang['INSTALLER_INSTALL_MENU'] . '</li>';
echo '							<li' . (($mode == 'install') ? $activemenu : '') . '><a href="install.php?mode=install"><span>' . sprintf($user->lang['INSTALLER_INSTALL_VERSION'], $new_mod_version) . '</span></a></li>';
echo '							<li class="header">' . $user->lang['INSTALLER_UPDATE_MENU'] . '</li>';
echo '							<li' . (($mode == 'update110b') ? $activemenu : '') . '><a href="install.php?mode=update110b&amp;v=1.1.0b"><span>' . $user->lang['INSTALLER_UPDATE_VERSION'] . '1.1.0b - phpbb3portal</span></a></li>';
echo '						</ul>';
echo '					</div>';
echo '					<div id="main">';
echo '<a name="maincontent"></a>';
if ($mode == 'install')
{
	if ($install == 1)
	{
		if ($installed)
		{
			echo '<div class="successbox">';
			echo '	<h3>' . $user->lang['INFORMATION'] . '</h3>';
			echo '	<p>' . sprintf($user->lang['INSTALLER_INSTALL_SUCCESSFUL'], $new_mod_version) . '</p>';
			echo '</div>';
		}
		else
		{
			echo '<div class="errorbox">';
			echo '	<h3>' . $user->lang['WARNING'] . '</h3>';
			echo '	<p>' . sprintf($user->lang['INSTALLER_INSTALL_UNSUCCESSFUL'], $new_mod_version) . '</p>';
			echo '</div>';
		}
	}
	else
	{
		echo '<h1>' . $user->lang['INSTALLER_INSTALL_WELCOME'] . '</h1>';
		echo '<p>' . $user->lang['INSTALLER_INSTALL_WELCOME_NOTE'] . '</p>';
		echo '<form id="acp_board" method="post" action="install.php?mode=install">';
		echo '	<fieldset>';
		echo '		<legend>' . $user->lang['INSTALLER_INSTALL'] . '</legend>';
		echo '		<dl>';
		echo '			<dt><label for="install">v' . $new_mod_version . ':</label></dt>';
		echo '			<dd><label><input name="install" value="1" class="radio" type="radio" />' . $user->lang['YES'] . '</label><label><input name="install" value="0" checked="checked" class="radio" type="radio" />' . $user->lang['NO'] . '</label></dd>';
		echo '		</dl>';
		echo '		<p class="submit-buttons">';
		echo '			<input class="button1" id="submit" name="submit" value="Submit" type="submit" />&nbsp;';
		echo '			<input class="button2" id="reset" name="reset" value="Reset" type="reset" />';
		echo '		</p>';
		echo '	</fieldset>';
		echo '</form>';
	}
}
else if ($mode == 'update110b')
{
	if ($update == 1)
	{
		if ($updated)
		{
			echo '<div class="successbox">';
			echo '	<h3>' . $user->lang['INFORMATION'] . '</h3>';
			echo '	<p>' . sprintf($user->lang['INSTALLER_UPDATE_SUCCESSFUL'], $version, $new_mod_version) . '</p>';
			echo '</div>';
		}
		else
		{
			echo '<div class="errorbox">';
			echo '	<h3>' . $user->lang['WARNING'] . '</h3>';
			echo '	<p>' . sprintf($user->lang['INSTALLER_UPDATE_UNSUCCESSFUL'], $version, $new_mod_version) . '</p>';
			echo '</div>';
		}
	}
	else
	{
		echo '<h1>' . $user->lang['INSTALLER_UPDATE_WELCOME'] . '</h1>';
		echo '<form id="acp_board" method="post" action="install.php?mode=' . $mode . '&amp;v=' . $version . '">';
		echo '	<fieldset>';
		echo '		<legend>' . $user->lang['INSTALLER_UPDATE'] . '</legend>';
		echo '		<dl>';
		echo '			<dt><label for="update">' . sprintf($user->lang['INSTALLER_UPDATE_NOTE'], $version, $new_mod_version) . ':</label></dt>';
		echo '			<dd><label><input name="update" value="1" class="radio" type="radio" />' . $user->lang['YES'] . '</label><label><input name="update" value="0" checked="checked" class="radio" type="radio" />' . $user->lang['NO'] . '</label></dd>';
		echo '		</dl>';
		echo '		<p class="submit-buttons">';
		echo '			<input class="button1" id="submit" name="submit" value="Submit" type="submit" />&nbsp;';
		echo '			<input class="button2" id="reset" name="reset" value="Reset" type="reset" />';
		echo '		</p>';
		echo '	</fieldset>';
		echo '</form>';
	}
}
else if ($mode == 'else')
{
	echo '<h1>' . $user->lang['INSTALLER_INTRO_WELCOME'] . '</h1>';
	echo '<p>' . $user->lang['INSTALLER_INTRO_WELCOME_NOTE'] . '</p>';
}
else
{
	echo '<div class="errorbox">';
	echo '	<h3>ERROR</h3>';
	echo '	<p>' . $user->lang['INSTALLER_NEEDS_FOUNDER'] . '</p>';
	echo '</div>';
}
echo '						</div>';
echo '					</div>';
echo '				<span class="corners-bottom"><span></span></span>';
echo '			</div>';
echo '		</div>';
echo '	</div>';
echo '	<!--';
echo '		We request you retain the full copyright notice below including the link to www.phpbb.com.';
echo '		This not only gives respect to the large amount of time given freely by the developers';
echo '		but also helps build interest, traffic and use of phpBB. If you (honestly) cannot retain';
echo '		the full copyright we ask you at least leave in place the "Powered by phpBB" line, with';
echo '		"phpBB" linked to www.phpbb.com. If you refuse to include even this then support on our';
echo '		forums may be affected.';
echo '		The phpBB Group : 2006';
echo '	// -->';
echo '<div id="page-footer">Powered by phpBB &copy; 2000, 2002, 2005, 2007 <a href="http://www.phpbb.com/">phpBB Group</a><br />Installer by <a href="http://mods.flying-bits.org/">nickvergessen</a></div>';
echo '</div>';
echo '</body>';
echo '</html>';
?>