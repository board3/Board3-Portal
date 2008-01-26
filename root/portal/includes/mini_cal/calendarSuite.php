<?php

/**
*
* @package - Board3portal
* @version $Id$
* @copyright (c) kevin / saint ( http://www.board3.de/ ), (c) Ice, (c) nickvergessen ( http://mods.flying-bits.org/ ), (c) redbull254 ( http://www.digitalfotografie-foren.de )
* @copyright (c) Adrian Cockburn - phpbb@netclectic.com (mini calendar)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
   exit;
}

if (!defined('IN_MINI_CAL'))
{
	exit;
}

/**
* Features include:  11 languages, returns all data in one array,
*										 intelligent linker function
*
* day[] = array(0 => 'dayNumeric',			// e.g. 19
*								1 => 'dayName',					// e.g. Tue
*								2 => 'dayNameL',				// e.g. Tuesday
*								3 => 'monthName',				// e.g. March
*								4 => 'monthNumeric'				// e.g. 12
*								5 => 'year'						// e.g. 2002
*								6 => 'timestamp'				// e.g. 1020204000
*								7 => 'dayOfWeek'				// 0-6 ! e.g. sunday=0, monday=1...
*								8 => 'dayOfYear'				// day of year (001 - 366)
*								9 => 'weekNum'					// weeknumber of current year
*							 	10 => 'link'					// link from link function
*							 	11 => 'mysqlDate'				// contains date in mysql-format (YYYY-MM-DD)
*							 
*
* language options:
*								0 = english (default)				1 = german
*								2 = french							3 = spanish
*								4 = finish							5 = polish
*								6 = portuguese						7 = italian
*								8 = italian							9 = slovak
*							   10 = turkish
*
**/


/**
* set language
* @const language
* default 0 / english
**/
define("language", "1");


/**
* set default date format
* @const dateFormat
* default 
**/
define("dateFormat" , "0");


class calendarSuite {

var $dateYYY;						// year in numeric format (YYYY)
var $dateMM;						// month in numeric format (MM)
var $dateDD;						// day in numeric format (DD)
var $ext_dateMM;					// extended month (e.g. February)
var $ext_dateDD;					// extended day (e.g. Mon)
var $daysMonth;						// count of days in month
var $nextMonth;						// contains next month
var $lastMonth;						// contains last month
var $stamp;							// timestamp
var $day;							// return array s.a.


/**
* Constructor
*
* Sets default values for e.g. language (default=english)
**/
function calendarSuite(){
	switch (language) {

		case 0:
		$this->language = "en_EN";
		break;

		case 1:
		$this->language = "de_DE";
		break;

		case 2:
		$this->language = "fr_FR";
		break;

		case 3:
		$this->language = "es_ES";
		break;

		case 4:
		$this->language = "fi_FI";
		break;

		case 5:
		$this->language = "pl_PL";
		break;

		case 6:
		$this->language = "pt_PT";
		break;

		case 7:
		$this->language = "it_IT";
		break;

		case 8:
		$this->language = "ru_RU";
		break;

		case 9:
		$this->language = "sk_SK";
		break;

		case 10:
		$this->language = "tr_TR";
		break;

		default:
		$this->language = "en_EN";

	}
	setlocale (LC_TIME, $this->language); // set language

// end of function calendarSuite
}


/**
* determine the next month after current
**/
function nextMonth() {
	$this->nextMonth = $this->getMonth("+1 month");

// end of function nextMonth
}


/**
* determine the last month before current
**/
function lastMonth() {
	$this->lastMonth = $this->getMonth("-1 month");

// end of function lastMonth
}


/**
* convert date->timestamp
**/
function makeTimestamp($date) {

	$this->stamp = strtotime($date);
	return ($this->stamp);

// end of function makeTimestamp
}


/**
* get date listed in array
**/
function getMonth($callDate) {

	$this->makeTimestamp($callDate);
	$this->dateYYYY = date("Y", $this->stamp);
	$this->dateMM = date("n", $this->stamp);
	$this->ext_dateMM = date("F", $this->stamp);
	$this->dateDD = date("d", $this->stamp);
	$this->daysMonth = date("t", $this->stamp);
	$this->monthStart = date("w", $this->stamp);
    
	for($i=1; $i < $this->daysMonth+1; $i++) {
		$this->makeTimestamp("$i $this->ext_dateMM $this->dateYYYY");
		$this->day[] = array(
				"0" => "$i",
				"1" => (strftime('%a', $this->stamp)),
				"2" => (strftime('%A', $this->stamp)),
				"3" => (strftime("%B", $this->stamp)),
				"4" => $this->dateMM,
				"5" => $this->dateYYYY,
				"6" => $this->stamp,
				"7" => (date('w', $this->stamp)),
				"8" => (strftime('%j', $this->stamp)),
				"9" => (strftime('%U', $this->stamp)),
				"10" => $this->dateLinker($this->stamp),
				"11" => $this->formatDate($this->stamp, 99)
				);
	}

// end of function getMonth
}


/**
* get detailed array of day
**/
function getDayDetail($stamp) {

	$this->dateYYYY = date("Y", $stamp);
	$this->dateMM = date("n", $stamp);
	$this->dateDD = date("d", $stamp);
	$this->ext_dateMM = date("F", $stamp);
	$this->daysMonth = date("t", $stamp);
	$this->monthStart = date("w", $stamp);

	$this->day = array(
				"0" => (date("j",$stamp)),
				"1" => (strftime('%a', $stamp)),
				"2" => (strftime('%A', $stamp)),
				"3" => $this->ext_dateMM,
				"4" => $this->dateMM,
				"5" => $this->dateYYYY,
				"6" => $stamp,
				"7" => (date('w', $stamp)),
				"8" => strftime('%j', $stamp),
				"9" => strftime('%U', $stamp)
				);

// end of function getDay
}


/**
* make links for every day
**/
function dateLinker($stamp) {
	$link = "?stamp=".$stamp;
	return $link;

// end of function dateLinker
}


/**
* format date in different forms
**/
function formatDate($stamp, $option = dateFormat) {

	switch ($option) {

		case 0:
		$this->formatted = date("d n Y", $stamp);
		return $this->formatted;
		break;

		case 1:
		$this->formatted = date("d Y M", $stamp);
		return $this->formatted;
		break;

		case 2:
		$this->formatted = date("M d Y", $stamp);
		return $this->formatted;
		break;

		case 3:
		$this->formatted = date("M Y d", $stamp);
		return $this->formatted;
		break;

		case 4:
		$this->formatted = date("Y M d", $stamp);
		return $this->formatted;
		break;

		case 5:
		$this->formatted = date("Y d M", $stamp);
		return $this->formatted;
		break;

		case 6:
		$this->formatted = date("d M Y", $stamp);
		return $this->formatted;
		break;

		case 99:
		$this->formatted = date("Y-m-d", $stamp);
		return $this->formatted;
		break;

	}

// end of function formatDate
}


// end of class
}

?>
