<?php
include('db.php');

// Frontend
function fetchAllSongs($conn) {
	$request = "SELECT * FROM songs
				-- LEFT JOIN users
				-- ON users.id = songs.user_id
				-- LEFT JOIN categories
				-- ON categories.id = songs.category_id"; 

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

function fetchOneSong($conn,$id) {
	$request = "SELECT * FROM songs
				LEFT JOIN users
				ON users.id = songs.user_id
				-- LEFT JOIN categories
				-- ON categories.id = songs.category_id
				WHERE songs.id = $id"; 

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetch() : null;

	return $rows;
}

function fetchAllCategory($conn) {
	$request = "SELECT * FROM categories"; 

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

function fetchAllSongsByCategory($conn,$id) {
	$request = "SELECT * FROM songs
				-- LEFT JOIN categories
				-- ON songs.category_id = categories.name 
				WHERE songs.category_id = $id"; 

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

function fetchAllCommentsByVideo($conn,$id) {
	$request = "SELECT * FROM comments
				LEFT JOIN users
				ON users.id = comments.user_id
				WHERE comments.song_id = $id"; 

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

function fetchLast4Songs($conn){
	$request = "SELECT * FROM songs LIMIT 4";  
	
	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); //renvoie un tab associative
	
	//si result passe avec succès alors on envoie fetchAll()
	$songs = $result ? $stmt->fetchAll() : null; // va nous données des tabs qui contient une ligne de la tab 

	return $songs; //avoir tt les musiques
}

// Backend
function fetchAllUsers($conn) {
	$request = "SELECT * FROM users
				LEFT JOIN songs
				ON songs.id = users.id";
				/*LEFT JOIN comments
				ON comments.id = users.id"; */

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

function getUserByEmail($conn, $email) {
	$request = "SELECT * FROM users WHERE email = '$email'";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); // set the resulting array to associative & fetch
	$user = $result ? $stmt->fetch() : null;

	return $user;
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

function updateUserByConnection($conn, $id, $is_connected) {
	// var_dump($id, $is_connected);
	$request = "UPDATE users SET `is_connected` = $is_connected WHERE `id` = $id";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	return $stmt->rowCount() > 0 ? true : false;
}

function fetchUserById($conn, $id = 2) {
	$request = "SELECT * FROM users
				LEFT JOIN songs
				ON users.id = songs.user_id
				LEFT JOIN categories
				ON songs.category_id = categories.id
				WHERE users.id = $id";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;
	$data = [];

	if ($rows) {
		$data['id'] = $rows[0]['id'];
		$data['last_name'] = $rows[0]['last_name'];
		$data['first_name'] = $rows[0]['first_name'];
		$data['email'] = $rows[0]['email'];
		$data['birthday'] = $rows[0]['birthday'];
		$data['created_at'] = $rows[0]['created_at'];
		$songs = [];

		foreach ($rows as $row) {
			$song = [];
			$song['id'] = $row['id'];
			$song['title'] = isset($row['title']) ? $row['title'] : "";
			$song['album_name'] = isset($row['album_name']) ? $row['album_name'] : "";
			$song['source'] = isset($row['source']) ? $row['source'] : "";
			$song['category'] = isset($row['name']) ? $row['name'] : "";

			array_push($songs, $song);
		}

		$data['songs'] = $songs;
	}

	return $data;
}


?>