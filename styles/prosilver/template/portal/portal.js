/**
*
* @package Board3 Portal v2.1 - javascript code
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

"use strict";

/**
 * Correctly align the right column underneath the left column.
 * This will make sure that the right column doesn't start before the end of
 * the center column but rather right after the last module of the left column.
 */
phpbb.b3p_fix_right_column_margin = function() {
	var width = $(window).width();

	if (width <= 700) {
		// Get height of left and center column
		var center_height = $('#portal-center').outerHeight();
		var left_height = $('#portal-left').outerHeight();

		$('#portal-right').css('margin-top', -(center_height - left_height) + 'px');
	} else {
		$('#portal-right').css('margin-top', '0px');
	}
};

$(document).ready(function() {
	phpbb.b3p_fix_right_column_margin();
	$(window).resize(function() {
		phpbb.b3p_fix_right_column_margin();
	});
});

})(jQuery); // Avoid conflicts with other libraries
