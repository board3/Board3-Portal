/**
*
* @package Board3 Portal v2.1 - javascript code
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

"use strict";

var portal_right_width;

/**
 * Correctly align the right column underneath the left column.
 * This will make sure that the right column doesn't start before the end of
 * the center column but rather right after the last module of the left column.
 */
phpbb.b3p_fix_right_column_margin = function() {
	var width = $(window).width();
	var $portal_right = $('#portal-right');
	var $portal_left = $('#portal-left');
	var $portal_center = $('#portal-center');

	if (width <= (895 - $.getScrollbarWidth())) {
		// Get correct margin-left for portal-right and add 10px for padding
		if ($portal_left.width() > 0) {
			$portal_right.css('margin-left', - ($portal_right.width() + 1));
			$portal_right.css('margin-top', $portal_center.height() + 'px');
			$portal_left.css('margin-top', $portal_center.height() + 'px');
		} else {
			$portal_right.css('margin-left', 0);
			$portal_right.css('margin-top', 0);
		}
	} else {
		$portal_right.css('margin-top', '0px');
		$portal_right.css('margin-left', -portal_right_width);
		$portal_right.width(portal_right_width);
		$portal_left.css('margin-top', 0);
	}
};

$(document).ready(function() {
	portal_right_width = $('#portal-right').width();
	phpbb.b3p_fix_right_column_margin();
	$(window).resize(function() {
		phpbb.b3p_fix_right_column_margin();
	});
});

})(jQuery); // Avoid conflicts with other libraries
