<?php

// MySQL DB connection details
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'becodedb';
 
//Custom PDO options
$options = array (
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

// Connect to MySQL and instantiate our PDO object
try {
	$conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password, $options);
	echo "Connected successfully!<br>";

	$stmt = $conn->prepare("SELECT * FROM users");
	$stmt->execute();

	// set the resulting array to associative
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	$rows = $stmt->fetchAll();
	var_dump($rows);

	foreach($rows as $key => $value) {
		// var_dump($value); // array
		echo "<br>last_name: ".$value['last_name'];
		echo "<br>first_name: ".$value['first_name'];
		echo "<br>email: ".$value['email'];
		echo "<br>-------------------------------------<br>";
	}

	// die();
} catch (PDOException $e) {
	die("Connection failed: " . $e->getMessage());
}

$conn = null;

?>