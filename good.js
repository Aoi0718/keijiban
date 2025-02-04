document.addEventListener('DOMContentLoaded', function() {
	var likeButtons = document.getElementsByClassName('likeButton');
    Array.from(likeButtons).forEach(function(likeButton) {
	likeButton.addEventListener('click', function() {
	likeButton.classList.toggle('liked');
	});
	});
	}, false);

	document.querySelectorAll(".likeButton").addEventListener("click", function() {
		let toukouId = this.getAttribute("data-toukou-id");
	
		fetch("good.php", {
			method: "POST",
			body: new URLSearchParams({ toukou_id: toukouId }),
			headers: { "Content-Type": "application/x-www-form-urlencoded" }
		})
		.then(response => response.json())
		.then(data => {
			if (data.status === "liked") {
				
				document.querySelectorAll(".likeButton").textContent = "❤️ いいね済み";
			} else {
				
				document.getElementByClassName("likeButton").textContent = "👍 いいね";
			}
		});
	});


