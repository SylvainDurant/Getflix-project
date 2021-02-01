// Get all <span> elements that closes the modals
var closeModalBtns = document.querySelectorAll(".close");

// Get all modal elements
var modals = document.querySelectorAll(".modal.fade");

// load video pages
function move(songId,index){
	if (index){
		window.location.replace("./pages/video.php?id="+songId);
	}else{
		window.location.replace("./video.php?id="+songId);
	}
}

function hideModals() {
	Array.from(modals).forEach((modal) => {
		modal.classList.remove("show");
	  	modal.classList.remove("d-block");
  	});
}

Array.from(closeModalBtns).forEach((btn) => {
    btn.onclick = function() {
	  	hideModals();
	}
});

// hideModals();

// Set the options for the toastr messages
toastr.options = {
	"closeButton": true,
	"newestOnTop": true,
	"positionClass": "toast-top-full-width",
	// "positionClass": "toast-top-center",
	"timeOut": "5000",
}

$(function() {
	// toastr.info('Hé, ça marche !'); // message, titre
});

function modify(comment_id) {
	let id = comment_id;
	document.getElementById("comment"+id).innerHTML = document.getElementById(id).innerHTML;

	if (document.getElementById(id).hidden === false){
		document.getElementById(id).hidden = true;
		document.getElementById("modify"+id).hidden = false;
	} else {
		document.getElementById(id).hidden = false;
		document.getElementById("modify"+id).hidden = true;
	}
}

function confirmModify(comment_id) {
	let id = comment_id;
	let new_comment = document.getElementById("comment"+id).innerHTML;

	document.getElementById(id).innerHTML = new_comment;
	document.getElementById(id).hidden = false;
	document.getElementById("modify"+id).hidden = true;
}