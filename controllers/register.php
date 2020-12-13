<?php
include('../helpers/functions.php');
session_start(); // Start a session

$_SESSION['registerErrors'] = [];
$previous_page = '';

if (isset($_POST['registerBtn'])) {
	// Get current page value
    if (isset($_POST['current_page'])) {
        $previous_page = $_POST['current_page'];
    }

    // Get input values & validate form
    if (isset($_POST['first_name'])) {
	  	$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['registerValues']['first_name'] = $first_name;

	  	// Validation
	  	if (strlen($first_name) < 2 || strlen($first_name) > 60) {
		 	$_SESSION['registerErrors']['first_name'] = "This field must contain between 2 and 60 characters!";
	  	}
	}

	if (!empty($_POST['last_name'])) {
		$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING); // Sanitization
		$_SESSION['registerValues']['last_name'] = $last_name;

		// Validation
		if (strlen($last_name) < 2 || strlen($last_name) > 60) {
		 	$_SESSION['registerErrors']['last_name'] = "This field must contain between 2 and 60 characters!";
		}
	} else {
	 	$_SESSION['registerErrors']['last_name'] = "This field is required!";
	}

	if (!empty($_POST['email'])) {
	  	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitization
	  	$_SESSION['registerValues']['email'] = $email;

	  	// Validation
	  	if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 	$_SESSION['registerErrors']['email'] = "Invalid field!";
	  	}

	  	if (strlen($email) > 255) {
		 	$_SESSION['registerErrors']['email'] = "This field must contain maximum 255 characters!";
	  	}
	} else {
	 	$_SESSION['registerErrors']['email'] = "This field is required!";
	}
	  
	if (isset($_POST['pseudo'])) {
	  	$pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['registerValues']['pseudo'] = $pseudo;

	  	// Validation
	  	if (strlen($pseudo) < 2 || strlen($pseudo) > 60) {
		 	$_SESSION['registerErrors']['pseudo'] = "This field must contain between 2 and 60 characters!";
	  	}
	} else {
	 	$_SESSION['registerErrors']['pseudo'] = "This field is required!";
	}

	if (!empty($_POST['password'])) {
	  	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['registerValues']['password'] = $password;

	  	// Validation
	  	if (strlen($password) < 6 || strlen($password) > 255) {
		 	$_SESSION['registerErrors']['password'] = "This field must contain between 6 and 255 characters!";
	  	}
	} else {
	 	$_SESSION['registerErrors']['password'] = "This field is required!";
	}

	if (!empty($_POST['password_confirm'])) {
	  	$password_confirm = filter_var($_POST['password_confirm'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['registerValues']['password_confirm'] = $password_confirm;
	} else {
	 	$_SESSION['registerErrors']['password_confirm'] = "This field is required!";
	}

	if ($password != $password_confirm) {
		$_SESSION['registerErrors']['password'] = "Password and password_confirm doesn't match!";
	}

  	// check if the user email exists in the db
  	$checkUser = getUserByEmail($conn, $email); // array OR false

    if ($checkUser != false) { // if the user email doesn't exists in the db
    	$_SESSION['registerErrors']['email'] = "This email already exists! Please try again.";
	}
	// var_dump($_SESSION); die();

	// Process form data, handling errors & redirections
	if (count($_SESSION['registerErrors']) == 0) {
  		$passwordHash = password_hash($password, PASSWORD_DEFAULT);

  		// insert user in the db & connect the user
  		$data = [];
  		$data['first_name'] = $first_name;
  		$data['last_name'] = $last_name;
  		$data['pseudo'] = $pseudo;
  		$data['email'] = $email;
  		$data['password'] = $passwordHash;
  		// $data['description'] = $description;
  		$data['first_name'] = $first_name;

  		createUser($conn, $data);
  		$newUser = getUserByEmail($conn, $email); // array OR false

  		$_SESSION['user'] = $newUser;
  		$_SESSION['success_message'] = "Successfully registered. <br/>You are now connected.";

        // redirect to the previous page with success message
        header('location: '.$previous_page);
	} else {
		// redirect & send validation errors to the previous page
        header('location: '.$previous_page);
	}
} else {
	// the user accessed this page without passing by the form => redirect the user to the 403 page
    header('location: ../pages/403.php');
}

?>