<?php

$url = explode('/', $_SERVER['REQUEST_URI']); // full url path
$root = $url[1] == 'pages' || $url[1] == 'controllers' ? '..' : '.';
include($root.'/config/db.php');

function executeRequest($conn, $request, $fetchMode = 'all') { // $fetchMode = 'all', 'one' or ''
	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement
	$rows = false;

	if ($fetchMode == 'all') {
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $result ? $stmt->fetchAll() : null;
	} elseif ($fetchMode == 'one') {
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $result ? $stmt->fetch() : null;
	} elseif ($fetchMode == '') {
		$rows = $stmt->rowCount() > 0 ? true : false; // for updateUserByConnection()
	}

	return $rows;
}

function fetchAllSongs($conn) {
	$request = "SELECT * FROM songs";

	return executeRequest($conn, $request);
}

function fetchOneSong($conn, $id) {
	$request = "SELECT * FROM songs
				LEFT JOIN users
				ON users.user_id = songs.user_id
				WHERE songs.id = '$id'"; 

	return executeRequest($conn, $request, 'one');
}

function fetchSongByTitle($conn,$title,$artist) {
	$request = "SELECT * FROM songs
				WHERE songs.title = '$title'
				AND songs.artist_name = '$artist'"; 

	return executeRequest($conn, $request, 'one');
}

function fetchAllCategory($conn) {
	$request = "SELECT * FROM categories"; 

	return executeRequest($conn, $request);
}

function fetchAllSongsByCategory($conn,$id) {
	$request = "SELECT * FROM songs WHERE songs.category_id = $id"; 

	return executeRequest($conn, $request); // 'all'
}

function fetchAllSongsByUser($conn,$id) {
	$request = "SELECT * FROM songs WHERE songs.user_id = $id"; 

	return executeRequest($conn, $request); // 'all'
}

function fetchCategoryByID($conn,$id) {
	$request = "SELECT * FROM categories WHERE categories.id = $id"; 

	return executeRequest($conn, $request, 'one');
}

function fetchAllCommentsByVideo($conn,$id) {
	$request = "SELECT * FROM comments
				LEFT JOIN users
				ON users.user_id = comments.user_id
				WHERE comments.song_id = $id"; 

	return executeRequest($conn, $request);
}

function fetchAllCommentsByUser($conn,$id) {
	$request = "SELECT * FROM comments
				LEFT JOIN users
				ON users.user_id = comments.user_id
				WHERE comments.user_id = $id"; 

	return executeRequest($conn, $request);
}

function fetchLast4Songs($conn) {
	$request = "SELECT * FROM songs LIMIT 4";  
	
	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); //renvoie un tab associative
	
	//si result passe avec succès alors on envoie fetchAll()
	$songs = $result ? $stmt->fetchAll() : null; // va nous données des tabs qui contient une ligne de la tab 

	return $songs; //avoir tt les musiques
}

function fetchAllUsers($conn) {
	$request = "SELECT * FROM users
				LEFT JOIN songs
				ON songs.id = users.user_id";

	return executeRequest($conn, $request);
}

function getUserByEmail($conn, $email) {
	$request = "SELECT * FROM users WHERE email = '$email'";

	return executeRequest($conn, $request, 'one');
}

function getUserByToken($conn, $token) {
	$request = "SELECT * FROM users WHERE reset_token = '$token'";

	return executeRequest($conn, $request, 'one');
}

function getUserByPseudo($conn, $pseudo) {
	$request = "SELECT * FROM users WHERE pseudo = '$pseudo'";

	return executeRequest($conn, $request, 'one');
}

function createUser($conn, $data) {
	$first_name = $data["first_name"];
	$last_name = $data["last_name"];
	$pseudo = $data["pseudo"];
	$email = $data["email"];
	$password = $data["password"];

	$request = "INSERT INTO users (first_name, last_name, pseudo, email, password, is_connected) 
				VALUES ('$first_name', '$last_name', '$pseudo', '$email', '$password', true)";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute();
}

function createSong($conn, $data) {
	$title = $data['title'];
	$description = !empty($data['description']) ? $data['description'] : 'No description' ;
	$source = $data['source'];
	$artist_name = $data['artist_name'];
	$album_name = !empty($data['album_name']) ? $data['album_name'] : 'Unknown';
	$album_image = !empty($data['album_image']) ? $data['album_image'] : '../images/Moosic_T2.1.png';
	$released_date = !empty($data['released_date']) ? $data['released_date'] : '2020-01-01';
	$user_id = $data['user_id'];
	$category_id = $data['category_id'];

	$request = "INSERT INTO songs (`title`, `description`, `source`, `artist_name`, `album_name`, `album_image`, `released_date`, `user_id`, `category_id`) 
				VALUES ('$title', '$description', '$source', '$artist_name', '$album_name', '$album_image', '$released_date', '$user_id', '$category_id')";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute();
}

function updateUserByConnection($conn, $id, $is_connected) {
	$request = "UPDATE users SET `is_connected` = $is_connected WHERE `user_id` = $id";

	return executeRequest($conn, $request, '');
}

function updateUserToken($conn, $id, $token, $tokenExpire) {
	$request = "UPDATE users SET `reset_token` = '$token',
							`token_expire` = '$tokenExpire'
							WHERE `user_id` = '$id'";

	return executeRequest($conn, $request, '');
}

function updateUserPassword($conn, $id, $password) {
	$request = "UPDATE users SET `reset_token` = '',
							`token_expire` = 0,
							`password` = '$password'
							WHERE `user_id` = '$id'";

	return executeRequest($conn, $request, '');
}

function fetchComment($conn,$text,$user_id) {
	$request = "SELECT * FROM comments
				WHERE comments.text = '$text'
				AND comments.user_id = '$user_id'"; 

	return executeRequest($conn, $request, 'one');
}

function createComment($conn, $data) {
    $text = $data['text'];
    $user_id = $data['user_id'];
    $song_id = $data['song_id'];

	$request = "INSERT INTO comments (`text`, `user_id`, `song_id`) 
				VALUES ('$text', '$user_id', '$song_id')";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute();
}

?>