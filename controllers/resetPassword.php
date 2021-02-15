<?php
include('../helpers/functions.php');
session_start(); // Start a session

$_SESSION['resetErrors'] = [];

if (isset($_POST['resetPasswordBtn'])) {

    $token = ($_POST['token']);
    $user = getUserByToken($conn, $token);
    
    if ($user) {
        // Get input values & validate form
        if (!empty($_POST['password'])) {
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Sanitization

            // Validation
            if (strlen($password) < 6 || strlen($password) > 255) {
            $_SESSION['resetErrors']['error'] = "This field must contain between 6 and 255 characters!";
            }
        } else {
            $_SESSION['resetErrors']['error'] = "This field is required!";
        }

        if (!empty($_POST['password_confirm'])) {
                $password_confirm = filter_var($_POST['password_confirm'], FILTER_SANITIZE_STRING); // Sanitization
        } else {
            $_SESSION['resetErrors']['error'] = "This field is required!";
        }

        if ($password != $password_confirm) {
            $_SESSION['resetErrors']['error'] = "Passwords don't match!";
        }

        // Process form data, handling errors & redirections
        if (count($_SESSION['resetErrors']) == 0) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            updateUserPassword($conn, $user['user_id'], $passwordHash); // change user's password and reset token
            
            $_SESSION['success_message'] = "Your password has been reset.";

            // redirect to the previous page with success message
            header('location: ../index.php');
        }else {
            header('location: ../pages/resetPage.php?token='.$token);
        }
	} else {
        $_SESSION['forgotErrors']['error'] = "This link is invalid or expired";

        // redirect & send errors to the previous page
        header('location: ../pages/resetPassword.php');
    }
} else {
	// the user accessed this page without passing by the form => redirect the user to the 403 page
    header('location: ../pages/403.php');
}

?>