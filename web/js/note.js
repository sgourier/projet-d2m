var noteEl = document.querySelector('#note');
var currentRating = 0;
var maxRating= 5;
var callback = function(rating) {
	document.querySelector('#inputNote').value = rating;
};
var myRating = rating(noteEl, currentRating, maxRating, callback);