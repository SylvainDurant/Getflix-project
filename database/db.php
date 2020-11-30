<?php
// MySQL DB connection details
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'becodedb';

$path = $_SERVER['REQUEST_URI'];
$url = explode('/', $path);
// var_dump($url);
 
//Custom PDO options
$options = array (
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

// Connect to MySQL and instantiate our PDO object
try {
	$conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password, $options);
	// echo "Connected successfully!<br>"; die();
} catch (PDOException $e) {
	die("Connection failed: " . $e->getMessage());
}
?>