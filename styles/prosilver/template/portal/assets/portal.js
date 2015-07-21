/**
*
* @package Board3 Portal v2.1 - javascript code
* @copyright (c) 2014 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/* global phpbb, jQuery */

(function($) {  // Avoid conflicts with other libraries

"use strict";

var portal_right_width;

/**
 * Correctly align the right column underneath the left column.
 * This will make sure that the right column doesn't start before the end of
 * the center column but rather right after the last module of the left column.
 */
phpbb.b3p_fix_right_column_margin = function() {
	var width = $(window).width(),
		$portal_right = $('#portal-right'),
		$portal_left = $('#portal-left'),
		$portal_center = $('#portal-center'),
		marginLeft = 'margin-left',
		marginRight = 'margin-right';

	if ($('body').hasClass('rtl')) {
		marginLeft = marginRight;
		marginRight = 'margin-left';
	}


	if (width <= (895 - $.getScrollbarWidth())) {
		// Get correct margin-left for portal-right and add 10px for padding
		if ($portal_left.width() > 0) {
			if (!$portal_center.length && $portal_left.length) {
				$portal_right.css(marginLeft, 5);
				$portal_left.css(marginRight, 0);
			} else {
				$portal_right.css(marginLeft, - ($portal_right.width() + 1));
			}
		} else {
			$portal_right.css(marginLeft, 0);
		}
	} else {
		if (!$portal_center.length && $portal_left.length) {
			$portal_right.css(marginLeft, 0);
		} else {
			$portal_right.css(marginLeft, -portal_right_width);
		}
		$portal_right.width(portal_right_width);
		phpbb.b3pFixLeftColumnMargin();
	}
};

/**
 * Correctly align left column if center column does not exist
 */
phpbb.b3pFixLeftColumnMargin = function() {
	var $portalLeft = $('#portal-left'),
		marginLeft = 'margin-left',
		marginRight = 'margin-right';

	if ($('body').hasClass('rtl')) {
		marginLeft = marginRight;
		marginRight = 'margin-left';
	}

	if ($portalLeft.length && !$('#portal-center').length) {
		$portalLeft.css(marginLeft, '0');
		$portalLeft.css(marginRight, 10);
	}
};

$(document).ready(function() {
	portal_right_width = $('#portal-right').attr('data-width');
	phpbb.b3pFixLeftColumnMargin();
	phpbb.b3p_fix_right_column_margin();
	$(window).resize(function() {
		phpbb.b3p_fix_right_column_margin();
	});
});

})(jQuery); // Avoid conflicts with other libraries
