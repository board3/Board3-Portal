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

	var el = $(this).parents('tr:first'),
		trSwap = el.prev(),
		elClass = trSwap.attr('class'),
		trSwapClass = el.attr('class');

	el.insertBefore(trSwap);
	el.attr('class', elClass);
	trSwap.attr('class', trSwapClass);

	// Swap images if swap element is first row
	var swapIsFirstRow = trSwap.find('img[src*="icon_up_disabled"]').parents('span:first').is(':visible');

	if (swapIsFirstRow) {
		trSwap.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
		trSwap.find('img[src*="icon_up."]').parents('span:first').toggle();
		el.find('img[src*="icon_up."]').parents('span:first').toggle();
		el.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
	}

	// Swap images if move element is last row
	var elIsLastRow = el.find('img[src*="icon_down_disabled"]').parents('span:first').is(':visible');

	if (elIsLastRow) {
		trSwap.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
		trSwap.find('img[src*="icon_down."]').parents('span:first').toggle();
		el.find('img[src*="icon_down."]').parents('span:first').toggle();
		el.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
	}
});

phpbb.addAjaxCallback('b3p_move_module_down', function(res) {
	if (typeof res.success === 'undefined' || !res.success) {
		return;
	}

	var el = $(this).parents('tr:first'),
		trSwap = el.next(),
		elClass = trSwap.attr('class'),
		trSwapClass = el.attr('class');

	el.insertAfter(trSwap);
	el.attr('class', elClass);
	trSwap.attr('class', trSwapClass);

	// Swap images if swap element is last row
	var swapIsLastRow = trSwap.find('img[src*="icon_down_disabled"]').parents('span:first').is(':visible');

	if (swapIsLastRow) {
		trSwap.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
		trSwap.find('img[src*="icon_down."]').parents('span:first').toggle();
		el.find('img[src*="icon_down."]').parents('span:first').toggle();
		el.find('img[src*="icon_down_disabled"]').parents('span:first').toggle();
	}

	// Swap images if move element is first row
	var elIsFirstRow = el.find('img[src*="icon_up_disabled"]').parents('span:first').is(':visible');

	if (elIsFirstRow) {
		trSwap.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
		trSwap.find('img[src*="icon_up."]').parents('span:first').toggle();
		el.find('img[src*="icon_up."]').parents('span:first').toggle();
		el.find('img[src*="icon_up_disabled"]').parents('span:first').toggle();
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
