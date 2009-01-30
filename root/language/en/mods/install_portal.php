<?php
/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( www.board3.de/ ), (c) Ice, (c) nickvergessen ( www.flying-bits.org/ ), (c) redbull254 ( www.digitalfotografie-foren.de ), (c) Christian_N ( www.phpbb-projekt.de )
* @installer based on: phpBB Gallery by nickvergessen, www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
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
	'INSTALL_CONGRATS_EXPLAIN'		=> 	'<p>You have succesfully installed the Board3 Portal v%s<br/><br/><strong>Now delete, move or rename the "install"-folder before you use your board. As long as this directory is present, you will only have access to your ACP.</strong></p>',
	'INSTALL_INTRO_BODY'			=> 	'This installation system will guide you through installing the Board3 Portal to your phpBB forum.',

	'MISSING_CONSTANTS'			=> 	'Prior to run the install script, you have to upload the edited files, especially /includes/constants.php.',
	'MODULES_CREATE_PARENT'		=> 	'Create parent standard module',
	'MODULES_PARENT_SELECT'		=> 	'Select parent module',
	'MODULES_SELECT_4ACP'		=> 	'Parent module for the ACP',
	'MODULES_SELECT_NONE'		=> 	'No parent module',

	'STAGE_ADVANCED_EXPLAIN'        =>  'Please select the parent modules for the Board3 Portal modules. Usually there is no need to change the default settings.',
	'STAGE_CREATE_TABLE_EXPLAIN'	=> 	'The Board3 Portal database tables have been created and initialized with basic values. Proceed to the next step to finish the Board3 Portal installation.',
	'STAGE_ADVANCED_SUCCESSFUL'		=> 	'The Board3 Portal modules have been created. Proceed to finish the Board3 Portal installation.',
	'STAGE_UNINSTALL'				=> 	'Uninstall',

	'FILES_EXISTS'				=> 	'File still exists',
	'FILES_OUTDATED'			=> 	'Out-of-date files',
	'FILES_OUTDATED_EXPLAIN'	=> 	'<strong>Out-of-date files</strong> - please delete these files to avoid security issues.',
	'REQUIREMENTS_EXPLAIN'		=> 	'Please delete all out-of-date files from your server prior to proceed with updating.',
	'NOT_REQUIREMENTS_EXPLAIN'	=> 	'No out-of-date files were found on your server, you may proceed with updating.',

	'UPDATE_INSTALLATION'			=> 	'Update Board3 Portal',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 	'This option will update your Board3 Portal to the current version.',
	'UPDATE_CONGRATS_EXPLAIN'		=> 	'<p>You have updated your Board3 Portal successfully to v%s<br/><br/><strong>Now delete, move or rename the "install"-folder before you use your board. As long as this directory is present, you will only have access to your ACP.</strong></p>',

	'UNINSTALL_INTRO'				=> 	'Welcome to Uninstall',
	'UNINSTALL_INTRO_BODY'			=> 	'This installation system will guide you through uninstalling the Board3 Portal from your phpBB forum.',
	'CAT_UNINSTALL'					=> 	'Uninstall',
	'UNINSTALL_CONGRATS'			=> 	'<h1>Board3 Portal removed.</h1>
									You have successfully uninstalled the Board3 Portal.',
	'UNINSTALL_CONGRATS_EXPLAIN'	=> 	'<strong>Now delete, move or rename the "install"-folder before you use your board. As long as this directory is present, you will only have access to your ACP.<br /><br />Make sure to delete the Portal-related files and reverse all Portal-related edits of phpBB core files.</strong></p>',

	'SUPPORT_BODY'		=> 	'Support for the latest stable version of the Board3 Portal is available free of charge for:</p><ul><li>Installation</li><li>Technical questions</li><li>Program-related issues</li><li>Updating Release Candidates (RC) or stable versions to the latest stable version</li></ul><p>You will find support in these forums:</p><ul><li><a href="http://www.board3.de/">board3.de - Homepage of Kevin - MOD author</a></li><li><a href="http://www.phpbb.de/">phpbb.de</a></li><li><a href="http://www.phpbb.com/">phpbb.com</a></li></ul><p>',
	'GOTO_INDEX'		=> 	'Proceed to forum',
	'GOTO_PORTAL'		=> 	'Proceed to Portal',
	
	'CAT_CONVERT'					=> 'Convert phpBB3 Portal',
	'CONVERT_P3P_INTRO'				=> 'Converts your "phpBB3 Portal" to a "Board3 Portal"',
	'STAGE_REMOVE_P3P'				=> 'Remove phpBB3 Portal',
	'STAGE_REMOVE_TABLE'			=> 'Remove database-tables',
	'STAGE_REMOVE_TABLE_EXPLAIN'	=> 'The phpBB3 Portal database-tables have been removed succesfully. Proceed to the next step to finish the Board3 Portal installation.',
	'CONVERT_COMPLETE_EXPLAIN'		=> 'The phpBB3 Portal has been converted to Board3 Portal v%s succesfully.<br /><br /><strong>Now delete, move or rename the "install"-folder before you use your board. As long as this directory is present, you will only have access to your ACP.</strong>',
));

?>