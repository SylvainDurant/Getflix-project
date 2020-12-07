<?php
// MySQL DB connection details
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'moosic_db';

$path = $_SERVER['REQUEST_URI'];
$url = explode('/', $path);
$root = $url[3] == 'pages' ? '..' : '.';
$pages_root = $url[3] == 'pages' ? '.' : './pages';
$page_title = ($url[3] == 'pages' && isset($url[4])) ? substr($url[4], 0, strpos($url[4], '.')) : 'Moosic';
$current_page = ($url[3] == 'pages' && isset($url[4])) ? "../".$url[3]."/".$url[4] : '../index.php';

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