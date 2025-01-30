<<<<<<< HEAD

likeButton.addEventListener('click',fanction(event));{
	number.value += 1;
}
=======
document.addEventListener('DOMContentLoaded', function() {
    var likeButtons = document.getElementsByClassName('likeButton');
    Array.from(likeButtons).forEach(function(likeButton) {
	likeButton.addEventListener('click', function() {
	likeButton.classList.toggle('liked');
	});
	});
	}, false);


	 
>>>>>>> origin/main
