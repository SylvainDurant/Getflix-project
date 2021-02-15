<?php
include('../helpers/functions.php');
session_start(); // Start a session

$userId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : null;
$previous_page = '';

// update user in the db: is_connected = false
$updateUser = isset($userId) ? updateUserByConnection($conn, $userId, 0) : false;

if ($updateUser) {
	$_SESSION['signout_success'] = "You are now disconnected.";

	// Get current page value
	if (isset($_POST['current_page'])) {
		$previous_page = $_POST['current_page'];
	}

	// Go to homepage after signing out
	header('location: ../pages/about.php');

	// Delete session variables
	// session_destroy();
} else {
	echo "couldn't update user!";
}

// Create a message cookie (The "/" means that the cookie is available in entire website; 86400 = 1 day)
// setcookie('logout_message', 'You are now disconnected.', time() + (86400 * 30), "/");

// Delete cookies, if you have
// setcookie('user', '');
?>