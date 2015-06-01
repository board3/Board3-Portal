<?php
/**
*
* @package Board3 Portal v2.1
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Estonian translation by phpBBeesti.com (http://www.phpbbeesti.com/)
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
	// Portal Modules
	'ACP_PORTAL_MODULES_EXP'		=> 'Siin on sul võimalik hallata oma portaali mooduleid. Kui lülitad kõik moodulid välja, siis palun lülita ka välja portaal.',
	'MODULE_POS_TOP'				=> 'Üleval',
	'MODULE_POS_LEFT'				=> 'Kolumn vasakul',
	'MODULE_POS_RIGHT'				=> 'Kolumn paremal',
	'MODULE_POS_CENTER'				=> 'Kolumn keskel',
	'MODULE_POS_BOTTOM'				=> 'All',
	'ADD_MODULE'					=> 'Lisa moodul',
	'CHOOSE_MODULE'					=> 'Vali moodul',
	'CHOOSE_MODULE_EXP'				=> 'Vali moodul rippmenüü nimekirjast',
	'SUCCESS_ADD'					=> 'Moodul on edukalt lisatud.',
	'SUCCESS_DELETE'				=> 'Moodul on edukalt eemaldatud.',
	'NO_MODULES'					=> 'Ühtegi moodulit ei ole tuvastatud.',
	'MOVE_RIGHT'					=> 'Liiguta paremale',
	'MOVE_LEFT'						=> 'Liiguta vasakule',
	'B3P_FILE_NOT_FOUND'			=> 'Nõutud faili ei leitud',
	'UNABLE_TO_MOVE'				=> 'Ei ole võimalik liigutada antud plokki valitud kolumni.',
	'UNABLE_TO_MOVE_ROW'			=> 'Ei ole võimalik liigutada antud plokki valitud ritta.',
	'UNABLE_TO_ADD_MODULE'			=> 'Ei ole võimalik lisada antud moodulit valitud kolumni.',
	'DELETE_MODULE_CONFIRM'			=> 'Kas oled kindel, et soovid kustutada mooduli "%1$s"?',
	'MODULE_RESET_SUCCESS'			=> 'Edukas mooduli seadete lähtestamine.',
	'MODULE_RESET_CONFIRM'			=> 'Kas oled kindel, et soovid lähtestada mooduli seaded "%1$s"?',
	'MODULE_NOT_EXISTS'				=> 'Valitud moodul ei eksisteeri.',
	'MODULE_OPTIONS'			=> 'Mooduli valikud',
	'MODULE_NAME'				=> 'Mooduli nimi',
	'MODULE_NAME_EXP'			=> 'Sisesta mooduli nimi, mis peaks olema kuvatud mooduli konfiguratsioonis.',
	'MODULE_IMAGE'				=> 'Mooduli pilt',
	'MODULE_IMAGE_EXP'			=> 'Sisesta mooduli pildi failinimi. Kõik pildid peavad olema styles/{sinu_stiil}/theme/images/portal/ kaustas',
	'MODULE_PERMISSIONS'		=> 'Mooduli õigused',
	'MODULE_PERMISSIONS_EXP'	=> 'Vali need grupid, kellel on õigus näha moodulit. Juhul kui sa soovid, et kõik kasutajad näeksid moodulit, siis ära vali mitte midagi.<br />Vali/Tühista valik mitu gruppi korraga, hoides <samp>CTRL</samp> klahvi ja klikides.',
	'MODULE_IMAGE_WIDTH'		=> 'Mooduli pildi laius',
	'MODULE_IMAGE_WIDTH_EXP'	=> 'Sisesta mooduli pildi laius pikslites',
	'MODULE_IMAGE_HEIGHT'		=> 'Mooduli pildi kõrgus',
	'MODULE_IMAGE_HEIGHT_EXP'	=> 'Sisesta mooduli ildi kõrgus pikslites',
	'MODULE_RESET'				=> 'Lähtesta mooduli konfiguratsioon',
	'MODULE_RESET_EXP'			=> 'See lähtestab kõik seaded vaikimisi seadetele!',
	'MODULE_STATUS'				=> 'Luba moodul',
	'MODULE_ADD_ONCE'			=> 'Seda moodulit saab lisada ainult korra.',
	'MODULE_IMAGE_ERROR'		=> 'Tekkis viga ajal, mil kontrolliti mooduli pilti:',
	'UNKNOWN_MODULE_METHOD'		=> '%1$s moodulite mooduli viisi ei saa lahendada.',
	// general
	'ACP_PORTAL_CONFIG_INFO'				=> 'Üldised seaded',
	'ACP_PORTAL_GENERAL_TITLE'				=> 'Portaali haldus',
	'ACP_PORTAL_GENERAL_TITLE_EXP'			=> 'Täname, et oled valinud Board3 portaali! See on lehekülg, kus saad oma portaali hallata. All olevad valikud lasevad sul kohandada erinevalt üldisi seadeid.',
	'PORTAL_ENABLE'							=> 'Luba portaal',
	'PORTAL_ENABLE_EXP'						=> 'Lülitab kogu portaali sisse või välja',
	'PORTAL_LEFT_COLUMN'					=> 'Luba vasak kolumn',
	'PORTAL_LEFT_COLUMN_EXP'				=> 'Pane EI, kui soovid vasakpoolse kolumni välja lülitada',
	'PORTAL_RIGHT_COLUMN'					=> 'Luba parem kolumn',
	'PORTAL_RIGHT_COLUMN_EXP'				=> 'Pane EI, kui soovid parempoolse kolumni välja lülitada',
	'PORTAL_VERSION_CHECK'					=> 'Portaali versioonikontroll',
	'PORTAL_DISPLAY_JUMPBOX'				=> 'Näita "Hüppa" kasti',
	'PORTAL_DISPLAY_JUMPBOX_EXP'			=> 'Kuvab "Hüppa" kasti portaalil. Seda näidatakse ainult siis, kui see on lubatud ka foorumis.',
	'ACP_PORTAL_COLUMN_WIDTH_SETTINGS'		=> 'Vasaku ja parema kolumni laiuse seaded',
	'PORTAL_LEFT_COLUMN_WIDTH'				=> 'Vasakpoolse kolumni laius',
	'PORTAL_LEFT_COLUMN_WIDTH_EXP'			=> 'Muudab vasakpoolse kolumni laiust pikslites; soovituslik väärtus on 180',
	'PORTAL_RIGHT_COLUMN_WIDTH'				=> 'Parempoolse kolumni laius',
	'PORTAL_RIGHT_COLUMN_WIDTH_EXP'			=> 'Muudab parempoolse kolumni laiust pikslites; soovituslik väärtus on 180',
	'LINK_ADDED'							=> 'Link on edukalt lisatud',
	'LINK_UPDATED'							=> 'Link on edukalt uuendatud',
	// Install
	'PORTAL_BASIC_INSTALL'			=> 'Lisan baasmoodulid',
	'PORTAL_BASIC_UNINSTALL'		=> 'Eemaldan moodulid andmebaasist',
	/**
	* A copy of Handyman` s MOD version check, to view it on the portal overview
	*/
	'ANNOUNCEMENT_TOPIC'	=> 'Väljalaske teadaanne',
	'CURRENT_VERSION'		=> 'Hetke versioon',
	'DOWNLOAD_LATEST'		=> 'Laadi alla viimane versioon',
	'LATEST_VERSION'		=> 'Viimane versioon',
	'NO_INFO'				=> 'Ei saanud ühendust serveriga, et kontrollida versiooni',
	'NOT_UP_TO_DATE'		=> '%s ei ole ajakohane',
	'RELEASE_ANNOUNCEMENT'	=> 'Teadaande teema',
	'UP_TO_DATE'			=> '%s on ajakohane',
	'VERSION_CHECK'			=> 'Laienduste versiooni kontroll',
));
