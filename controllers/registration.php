<?php

include('../database/db.php');

var_dump($_POST);
$errors = [];

if (isset($_POST['last_name'])) {
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING); // Sanitization

    // Validation
    if (strlen($last_name) < 3 || strlen($last_name) > 6) {
       $errors['last_name'] = "Last_name field is invalid!";
    }

    /*if (strlen($last_name) > 6)) {
       $errors['last_name'] = "This field is required!";
    }*/
}

if (isset($_POST['first_name'])) {
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING); // Sanitization

    // Validation
    if (strlen($first_name) < 3) {
       $errors['first_name'] = "First_name field is invalid!";
    }
}

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitization

    // Validation
    if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors['email'] = "Email address field is invalid!";
    }
}
    
if (isset($_POST['pseudo'])) {
    $pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING); // Sanitization

    // Validation
    if (strlen($pseudo) < 3) {
       $errors['pseudo'] = "Pseudo field is invalid!";
    }
}

if (isset($_POST['password'])) {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Sanitization
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
}

var_dump($errors);

if (count($errors) == 0) {
    // save the data into database
    /*$stmt = $conn->prepare("INSERT INTO users (id, title, year, text) VALUES (:title, ':year', :text)");       
    $data = array(              
        ':title' => ucwords($_REQUEST['title']),
        ':year' => strtoupper($_REQUEST['year']),
        ':text' => $_REQUEST['text']);
    $stmt->execute($data);*/

    // send response ok to modal window view 
} else {
	$_SESSION['errors'] = $errors;
}

?>