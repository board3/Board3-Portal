/**
*
* @package Board3 Portal v2.1 - Clock
* @copyright (c) 2013 Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

"use strict";

var hour_cur = 0;
var minL_cur = 0;
var minR_cur = 0;
var secL_cur = 0;
var secR_cur = 0;

phpbb.b3pFlipClock = function(identifierUp, identifierDown, val, type) {
	var backIdUp = identifierUp.replace('-front-', '-back-');
	var backIdDown = identifierDown.replace('-front-', '-back-');
	var backPosition = $(backIdUp).css('background-position');
	var backPositionLength;
	var backY;

	// Workaround for Internet Explorer bug
	if (backPosition === undefined) {
		backPosition = $(backIdUp).css('background-position-x') + ' ' + $(backIdUp).css('background-position-y');
	}

	backPositionLength = backPosition.length;

	if (backPosition.substring(backPositionLength - 3, backPositionLength - 2) === '0') {
		backY = '0px';
	} else {
		backY = backPosition.substring(backPositionLength - 5, backPositionLength);
	}

	backPosition = $(backIdUp).css('background-position');
	$(identifierUp)
		.css('background-position', backPosition)
		.height('21px')
		.css({'visibility': 'visible', 'display': 'inline-block' });
	$(identifierDown)
		.height('0px')
		.css('visibility', 'visible');

	// single digits will have digits 0 - 9, double 0 - 24
	if (type === 'single') {
		$(backIdUp).css('background-position', (val * -22) + 'px ' + backY);
	} else if (type === 'double') {
		if (val >= 12) {
			backY = '-22px';
			val = val - 12;
			$(backIdUp).css('background-position', (val * -43) + 'px ' + backY);
			val = val + 12;
		} else {
			if (val < 12 && backY !== '0px') {
				backY = '0px';
			}
			$(backIdUp).css('background-position', (val * -43) + 'px ' + backY);
		}
	} else {
		return;
	}

	// now get the vertical offset of the bottom digit
	backPosition = $(identifierDown).css('background-position');

	// Workaround for Internet Explorer bug
	if (backPosition === undefined) {
		backPosition = $(identifierDown).css('background-position-x') + ' ' + $(identifierDown).css('background-position-y');
	}

	backPositionLength = backPosition.length;

	if (backPosition.substring(backPositionLength - 3, backPositionLength - 2) === '0') {
		backY = '0px';
	} else {
		backY = backPosition.substring(backPositionLength - 5, backPositionLength);
	}

	// single digits will have digits 0 - 9, double 0 - 24
	if (type === 'single') {
		$(identifierDown).css('background-position', (val * -22) + 'px ' + backY);
	} else if (type === 'double') {
		if (val >= 12) {
			backY = '-65px';
			val = val - 12;
			$(identifierDown).css('background-position', (val * -43) + 'px ' + backY);
			val = val + 12;
		} else {
			if (val < 12 && backY !== '-44px') {
				backY = '-44px';
			}
			$(identifierDown).css('background-position', (val * -43) + 'px ' + backY);
		}
	} else {
		return;
	}

	// Animate the top number flipping
	$(identifierUp).animate({
			height: '0px',
			'margin-top': '21px'
		},
		{
			'duration': 150,
			defaultEasing: 'easeInOutSine',
			'complete': function(){
				// Now animate the bottom number flipping
				$(identifierDown).animate(
					{height: '20px'},
					{
						'duration': 150,
						defaultEasing: 'easeInOutSine',
						'complete': function(){
							// For compatibility with IE8
							if ($(identifierDown).css('background-position') !== undefined) {
								$(backIdDown).css('background-position', $(identifierDown).css('background-position'));
							} else {
								$(backIdDown).css('background-position-x', $(identifierDown).css('background-position-x'));
								$(backIdDown).css('background-position-y', $(identifierDown).css('background-position-y'));
							}
							$(identifierDown).css({
								'visibility': 'hidden',
								'display': 'inline-block'
							});
							$(identifierUp).css({
								'visibility': 'hidden',
								'display': 'inline-block',
								'margin-top': '0px'
							});
						}
					} 
				);
			}
		}
	);
};

phpbb.b3pClock = function() {
	var now = new Date();
	var hour = now.getHours();
	var minL = Math.floor(now.getMinutes() / 10);
	var minR = now.getMinutes() % 10;
	var secL = Math.floor(now.getSeconds() / 10);
	var secR = now.getSeconds() % 10;

	if (hour !== hour_cur) {
		phpbb.b3pFlipClock('#portal-clock-front-hours-up', '#portal-clock-front-hours-down', hour, 'double');
		hour_cur = hour;
	}

	if (minR !== minR_cur) {
		phpbb.b3pFlipClock('#portal-clock-front-minutes-up-right', '#portal-clock-front-minutes-down-right', minR, 'single');
		minR_cur = minR;
	}

	if (minL !== minL_cur) {
		phpbb.b3pFlipClock('#portal-clock-front-minutes-up-left', '#portal-clock-front-minutes-down-left', minL, 'single');
		minL_cur = minL;
	}

	if (secR !== secR_cur) {
		phpbb.b3pFlipClock('#portal-clock-front-seconds-up-right', '#portal-clock-front-seconds-down-right', secR, 'single');
		secR_cur = secR;
	}

	if (secL !== secL_cur) {
		phpbb.b3pFlipClock('#portal-clock-front-seconds-up-left', '#portal-clock-front-seconds-down-left', secL, 'single');
		secL_cur = secL;
	}
};

$(document).ready(function() {
	setInterval(phpbb.b3pClock, 1000);
});

})(jQuery); // Avoid conflicts with other libraries
