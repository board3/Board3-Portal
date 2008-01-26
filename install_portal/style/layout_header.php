<?php

if( !defined('IN_PHPBB') || !defined('IN_PORTAL_INSTALL') )
{
	exit;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-gb" lang="en-gb">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Language" content="en-gb" />
	<meta http-equiv="imagetoolbar" content="no" />
	<title><?php echo $page_title; ?></title>
	<link href="../adm/style/admin.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body class="ltr">
<div id="wrap">
	<div id="page-header">
		<h1><?php echo $page_title; ?></h1>
		<p><a href="<?php echo $phpbb_root_path . '">' . $user->lang['INDEX']; ?></a></p>
		<p id="skip"><a href="#acp">Skip to content</a></p>
	</div>
	<div id="page-body">
		<div id="acp">
		<div class="panel">
			<span class="corners-top"><span></span></span>
				<div id="content">
					<div id="menu">
						<ul>
							<li class="header"><?php echo $user->lang['INSTALLER_MENU']; ?></li>
							<li<?php echo ( ( $mode != 'uninstall' || ( $old_version != 0 && $phpbb3portal === TRUE ) || $old_version == 0 ) ? ' id="activemenu"' : '' ); ?>><a href="install.<?php echo $phpEx; ?>"><span><?php echo $user->lang['INSTALLER_MENU_START']; ?></span></a></li>
<?php
if( $old_version != 0 && $phpbb3portal === false )
{
?>
							<li<?php echo ( ($mode == 'uninstall') ? ' id="activemenu"' : '' ); ?>><a href="install.<?php echo $phpEx; ?>?mode=uninstall"><span><?php echo $user->lang['INSTALLER_UNINSTALL']; ?></span></a></li>
<?php
}
?>
						</ul>
					</div>
					<div id="main">
						<a name="maincontent"></a>