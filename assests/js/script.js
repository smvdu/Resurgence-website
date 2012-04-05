/* Author:

*/

$(function () {
	"use strict";
	var liftoffTime = new Date(2012, 4-1, 6);

	$('#countdown').countdown({until: liftoffTime,
		description: 'to the Resurgence 2012!!  Hurry!!'});
});






