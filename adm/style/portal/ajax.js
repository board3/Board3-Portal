(function($) {  // Avoid conflicts with other libraries

"use strict";

/**
 * The following callbacks are for reording items. row_down
 * is triggered when an item is moved down, and row_up is triggered when
 * an item is moved up. It moves the row up or down, and deactivates /
 * activates any up / down icons that require it (the ones at the top or bottom).
 */
phpbb.addAjaxCallback('b3p_move_module_up', function(res) {
	if (typeof res.success === 'undefined' || !res.success) {
		return;
	}

	var $bottomRow = $(this).parents('tr:first'),
		$topRow = $bottomRow.prev(),
		topRowClass = $topRow.attr('class'),
		bottomRowClass = $bottomRow.attr('class');

	$bottomRow.insertBefore($topRow);
	if (bottomRowClass !== 'row3' && topRowClass !== 'row3') {
		$bottomRow.attr('class', topRowClass);
		$topRow.attr('class', bottomRowClass);
	} else if (bottomRowClass === 'row3') {
		$topRow.attr('class', (topRowClass === 'row1') ? 'row2' : 'row1');
	} else if (topRowClass === 'row3') {
		$bottomRow.attr('class', (bottomRowClass === 'row1') ? 'row2' : 'row1');
	}

	// Swap images if swap element is first row
	var swapIsFirstRow = $topRow.find('img[src*="icon_up_disabled"]').parents('span:first').is(':visible');

	if (swapIsFirstRow) {
		$topRow.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
		$topRow.find('img[src*="icon_up."]').parents('span:first').toggle();
		$bottomRow.find('img[src*="icon_up."]').parents('span:first').toggle();
		$bottomRow.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
	}

	// Swap images if move element is last row
	var elIsLastRow = $bottomRow.find('img[src*="icon_down_disabled"]').parents('span:first').is(':visible');

	if (elIsLastRow) {
		$topRow.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
		$topRow.find('img[src*="icon_down."]').parents('span:first').toggle();
		$bottomRow.find('img[src*="icon_down."]').parents('span:first').toggle();
		$bottomRow.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
	}
});

phpbb.addAjaxCallback('b3p_move_module_down', function(res) {
	if (typeof res.success === 'undefined' || !res.success) {
		return;
	}

	var $topRow = $(this).parents('tr:first'),
		$bottomRow = $topRow.next(),
		bottomRowClass = $bottomRow.attr('class'),
		topRowClass = $topRow.attr('class');

	$topRow.insertAfter($bottomRow);
	if (bottomRowClass !== 'row3' && topRowClass !== 'row3') {
		$bottomRow.attr('class', topRowClass);
		$topRow.attr('class', bottomRowClass);
	} else if (bottomRowClass === 'row3') {
		$topRow.attr('class', (topRowClass === 'row1') ? 'row2' : 'row1');
	} else if (topRowClass === 'row3') {
		$bottomRow.attr('class', (bottomRowClass === 'row1') ? 'row2' : 'row1');
	}

	// Swap images if swap element is last row
	var swapIsLastRow = $bottomRow.find('img[src*="icon_down_disabled"]').parents('span:first').is(':visible');

	if (swapIsLastRow) {
		$bottomRow.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
		$bottomRow.find('img[src*="icon_down."]').parents('span:first').toggle();
		$topRow.find('img[src*="icon_down."]').parents('span:first').toggle();
		$topRow.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
	}

	// Swap images if move element is first row
	var elIsFirstRow = $topRow.find('img[src*="icon_up_disabled"]').parents('span:first').is(':visible');

	if (elIsFirstRow) {
		$bottomRow.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
		$bottomRow.find('img[src*="icon_up."]').parents('span:first').toggle();
		$topRow.find('img[src*="icon_up."]').parents('span:first').toggle();
		$topRow.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
	}
});

phpbb.addAjaxCallback('b3p_delete_module', function(res) {
	if (typeof res.success === 'undefined' || !res.success) {
		return;
	}

	var $deletedRow = $(this).parents('tr:first'),
		$nextRow = $deletedRow.next();

	$deletedRow.remove();

	// Fix classes of next elements
	while ($nextRow !== undefined && $nextRow.is('tr')) {
		var nextRowClass = ($nextRow.attr('class') === 'row1') ? 'row2' : 'row1';

		if ($nextRow.attr('class') !== 'row3') {
			$nextRow.attr('class', nextRowClass);
		}

		$nextRow = $nextRow.next();
	}
});

})(jQuery); // Avoid conflicts with other libraries
