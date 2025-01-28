<<<<<<< HEAD

likeButton.addEventListener('click',fanction(event));{
	number.value += 1;
}
=======
const mysql = require('mysql');
  	const connection = mysql.createConnection({
	host: 'localhost',
    user: 'LAA1618718',
    password: 'dbpasswd',
	database: 'LAA1618718-mydb'                  
    });
    connection.connect((err) => {
    if (err) throw err;
    console.log('Connected!');
    });
document.addEventListener('DOMContentLoaded', function() {
	var number = document.getElementsByClassName('number');
	var likeButtons = document.getElementsByClassName('likeButton');
	Array.from(likeButtons).forEach(function(likeButton) {
	likeButton.addEventListener('click', function() {
	likeButton.classList.toggle('liked');
	});
	});
	}, false);
>>>>>>> origin/ishidaaoi
