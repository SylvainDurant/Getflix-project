// load video pages
function move(songId,index){
	if (index){
		window.location.replace("./pages/video.php?id="+songId);
	}else{
		window.location.replace("./video.php?id="+songId);
	}
}