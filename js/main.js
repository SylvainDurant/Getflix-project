
function setNickname(name) {
	/*document.getElementById("username").innerHTML = name;
	document.querySelector("header h4.hello").classList.remove("d-none");
	document.getElementById("startGame").classList.add("d-none");
	document.getElementById("game").classList.remove("d-none");
	document.getElementById("score").classList.remove("d-none");
	modal.style.display = "none";*/
} 

///////////////////////////////////////////////////
// When the user clicks on the button, open the modal
btn.onclick = function() {
  	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
///////////////////////////////////////////////////

// load video pages
function move(songId,index){
	if (index){
		window.location.replace("./pages/video.php?id="+songId);
	}else{
		window.location.replace("./video.php?id="+songId);
	}
	
}