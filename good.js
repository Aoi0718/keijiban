
document.addEventListener('DOMContentLoaded', function() {
	var number = document.getElementsByClassName('number');
	var likeButtons = document.getElementsByClassName('likeButton');
	Array.from(likeButtons).forEach(function(likeButton) {
	likeButton.addEventListener('click', function() {
	likeButton.classList.toggle('liked');
	});
	});
	}, false);