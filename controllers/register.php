<?php

include('../database/functions.php');

session_start(); // Start a session

$_SESSION['errors'] = [];
$previous_page = '';

if (isset($_POST['registerBtn'])) {
	// Get current page value
    if (isset($_POST['current_page'])) {
        $previous_page = $_POST['current_page'];
    }

    // Get input values & validate form
    if (!empty($_POST['first_name'])) {
	  	$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['first_name'] = $first_name;

	  	// Validation
	  	if (strlen($first_name) < 2 || strlen($first_name) > 60) {
		 	$_SESSION['errors']['first_name'] = "This field must contain between 2 and 60 characters!";
	  	}
	} else {
	 	$_SESSION['errors']['first_name'] = "This field is required!";
	}

	if (!empty($_POST['last_name'])) {
		$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING); // Sanitization
		$_SESSION['last_name'] = $last_name;

		// Validation
		if (strlen($last_name) < 2 || strlen($last_name) > 60) {
		 	$_SESSION['errors']['last_name'] = "This field must contain between 2 and 60 characters!";
		}
	} else {
	 	$_SESSION['errors']['last_name'] = "This field is required!";
	}

	if (!empty($_POST['email'])) {
	  	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitization
	  	$_SESSION['email'] = $email;

	  	// Validation
	  	if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 	$_SESSION['errors']['email'] = "Invalid field!";
	  	}

	  	if (strlen($email) > 255) {
		 	$_SESSION['errors']['email'] = "This field must contain maximum 255 characters!";
	  	}
	} else {
	 	$_SESSION['errors']['email'] = "This field is required!";
	}
	  
	if (isset($_POST['pseudo'])) {
	  	$pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['pseudo'] = $pseudo;

	  	// Validation
	  	if (strlen($pseudo) < 2 || strlen($pseudo) > 60) {
		 	$_SESSION['errors']['pseudo'] = "This field must contain between 2 and 60 characters!";
	  	}
	}

	if (!empty($_POST['password'])) {
	  	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['password'] = $password;

	  	// Validation
	  	if (strlen($password) < 6 || strlen($password) > 255) {
		 	$_SESSION['errors']['password'] = "This field must contain between 6 and 255 characters!";
	  	}
	} else {
	 	$_SESSION['errors']['password'] = "This field is required!";
	}

	if (!empty($_POST['password_confirm'])) {
	  	$password_confirm = filter_var($_POST['password_confirm'], FILTER_SANITIZE_STRING); // Sanitization
	  	$_SESSION['password_confirm'] = $password_confirm;
	} else {
	 	$_SESSION['errors']['password_confirm'] = "This field is required!";
	}

	if ($password != $password_confirm) {
		$_SESSION['errors']['password'] = "Password and password_confirm doesn't match!";
	}

  	// check if the user email exists in the db
  	$checkUser = getUserByEmail($conn, $email); // array OR false

    if ($checkUser != false) { // if the user email doesn't exists in the db
    	$_SESSION['errors']['email'] = "This email already exists! Please try again.";
	}
	// var_dump($_SESSION); die();

	// Process form data, handling errors & redirections
	if (count($_SESSION['errors']) == 0) {
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
  		$_SESSION['success'] = "Successfully registered. You are now connected.";

        // redirect to the previous page with success message
        header('location: '.$previous_page);
	} else {
		// redirect & send validation errors to the previous page
        header('location: '.$previous_page);
	}
} else {
	// the user accesed this page without passing by the form => redirect the user to the previous page
    header('location: '.$previous_page);
    exit();
}

?>