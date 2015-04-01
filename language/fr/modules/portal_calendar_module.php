<?php
/**
*
* @package Board3 Portal v2.1 - Calendar
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @translated into French by Galixte (http://www.galixte.com)
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
	'PORTAL_CALENDAR'			=> 'Calendrier',
	'VIEW_NEXT_MONTH'		=> 'Mois prochain',
	'VIEW_PREVIOUS_MONTH'	=> 'Mois précédent',
	'EVENT_START'			=> 'Depuis',
	'EVENT_END'				=> 'Jusqu’à',
	'EVENT_TIME'			=> 'Durée',
	'EVENT_ALL_DAY'			=> 'Journée entière',
	'CURRENT_EVENTS'		=> 'Événements',
	'NO_CUR_EVENTS'			=> 'Aucun évènement',
	'UPCOMING_EVENTS'		=> 'Événements à venir',
	'NO_UPCOMING_EVENTS'	=> 'Aucun événement à venir',

	'mini_cal'	=> array(
		'day'	=> array(
			'1'	=> 'Di',
			'2'	=> 'Lu',
			'3'	=> 'Ma',
			'4'	=> 'Me',
			'5'	=> 'Je',
			'6'	=> 'Ve',
			'7'	=> 'Sa',
		),

		'month'	=> array(
			'1'	=> 'Jan.',
			'2'	=> 'Fev.',
			'3'	=> 'Mar.',
			'4'	=> 'Avr.',
			'5'	=> 'Mai',
			'6'	=> 'Jui.',
			'7'	=> 'Jui.',
			'8'	=> 'Aou.',
			'9'	=> 'Sep.',
			'10'=> 'Oct.',
			'11'=> 'Nov.',
			'12'=> 'Dec.',
		),

		'long_month'=> array(
			'1'	=> 'Janvier',
			'2'	=> 'Février',
			'3'	=> 'Mars',
			'4'	=> 'Avril',
			'5'	=> 'Mai',
			'6'	=> 'Juin',
			'7'	=> 'Juillet',
			'8'	=> 'Aout',
			'9'	=> 'Septembre',
			'10'=> 'Octobre',
			'11'=> 'Novembre',
			'12'=> 'Décembre',
		),
	),

	// ACP
	'ACP_PORTAL_CALENDAR'					=> 'Paramètres du calendrier',
	'ACP_PORTAL_CALENDAR_EXP'				=> 'Ici vous personnalisez le bloc du calendrier.',
	'ACP_PORTAL_EVENTS'						=> 'Évènements du calendrier',
	'PORTAL_CALENDAR_TODAY_COLOR'			=> 'Couleur du jour en cours',
	'PORTAL_CALENDAR_TODAY_COLOR_EXP'	=> 'Utiliser du code HEX (hexadécimal ou HEXA) ou nommer la couleur sont autorisés tel que #FFFFFF pour du blanc, ou le nom de la couleur (en anglais) tel que violet.',
	'PORTAL_CALENDAR_SUNDAY_COLOR'			=> 'Couleur du premier jour de la semaine',
	'PORTAL_CALENDAR_SUNDAY_COLOR_EXP'	=> 'Utiliser du code HEX (hexadécimal ou HEXA) ou nommer la couleur sont autorisés tel que #FFFFFF pour du blanc, ou le nom de la couleur (en anglais) tel que violet.',
	'PORTAL_LONG_MONTH'						=> 'Afficher le nom complet des mois',
	'PORTAL_LONG_MONTH_EXP'				=> 'Si désactivé  le nom des mois sera tronqué, comme par exemple : Jan. à la place de Janvier.',
	'PORTAL_SUNDAY_FIRST'					=> 'Premier jour de la semaine',
	'PORTAL_SUNDAY_FIRST_EXP'			=> 'Si désactivé le calendrier affichera Lu. --> Di., à la place de Di. --> Sa.',
	'PORTAL_DISPLAY_EVENTS'					=> 'Afficher les évènements',
	'PORTAL_DISPLAY_EVENTS_EXP'				=> 'Afficher les événements qui ont été créés pour le bloc calendrier.',
	'PORTAL_EVENTS_MANAGE'					=> 'Gérer les évènements',
	'NO_EVENT_TITLE'						=> 'Vous n’avez pas spécifier un titre pour l’évènement.',
	'NO_EVENT_START'						=> 'Vous n’avez pas spécifier une date de début pour l’évènement.',
	'ADD_EVENT'								=> 'Ajouter un nouvel évènement',
	'EVENT_UPDATED'							=> 'Évènement mis à jour avec succès.',
	'EVENT_ADDED'							=> 'Évènement ajouté avec succès.',
	'NO_EVENT'								=> 'Aucun évènement spécifié.',
	'EVENT_TITLE'							=> 'Titre de l’évènement',
	'EVENT_DESC'							=> 'Description de l’évènement',
	'EVENT_LINK'							=> 'Lien de l’évènement',
	'EVENT_LINK_EXP'						=> 'Saisir le lien vers un sujet ou un site WEB en rapport avec l’évènement.',
	'NO_EVENTS'								=> 'Aucun évènement',
	'ACP_PORTAL_CALENDAR_START_INCORRECT'	=> 'La date spécifiée du début de l’évènement est incorrecte. Veuillez suivez les instructions attentivement.',
	'ACP_PORTAL_CALENDAR_END_INCORRECT'		=> 'La date spécifiée de la fin de l’évènement est incorrecte. Veuillez suivez les instructions attentivement.',
	'ACP_PORTAL_CALENDAR_EVENT_PAST'		=> 'La date du début de l’évènement doit être située dans l’avenir.',
	'ACP_PORTAL_EVENT_START_DATE'			=> 'Date du début de l’évènement',
	'ACP_PORTAL_EVENT_START_DATE_EXP'		=> 'Saisir la date et l’heure du début de l’événement. La date doit avoir le format suivant : MM/DD/YYYY 3:00 PM.',
	'ACP_PORTAL_EVENT_END_DATE'			=> 'Date de la fin de l’évènement',
	'ACP_PORTAL_EVENT_END_DATE_EXP'			=> 'Saisir la date et l’heure de la fin de l’événement. La date doit avoir le format suivant : MM/DD/YYYY 3:00 PM.',
	'ACP_PORTAL_CALENDAR_EVENT_START_FIRST'	=> 'La date de la fin de l’évènement doit être située après la date du début de l’évènement.',
	'ACP_PORTAL_CALENDAR_PERMISSION'		=> 'Permissions de l’évènement',
	'ACP_PORTAL_CALENDAR_PERMISSION_EXP'	=> 'Sélectionner les groupes qui doivent être autorisés à voir le module. Afin que tous les utilisateurs soient en mesure d’afficher le module, ne rien sélectionner.<br />Pour sélectionner / désélectionner plusieurs groupes maintenir la touche <samp>CTRL</samp> tout en cliquant.',
	'PORTAL_EVENTS_URL_NEW_WINDOW'			=> 'Ouvrir les liens externes des évènements dans une nouvelle fenêtre',

	// Logs
	'LOG_PORTAL_EVENT_UPDATED'				=> '<strong>Évènement mis à jour</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_ADDED'				=> '<strong>Évènement ajouté</strong><br />&raquo; %s',
	'LOG_PORTAL_EVENT_REMOVED'				=> '<strong>Évènement retiré</strong><br />&raquo; %s',
));
