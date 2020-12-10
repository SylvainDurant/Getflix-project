<?php

include('../database/functions.php');
session_start(); // Start a session

$_SESSION['loginErrors'] = [];
$previous_page = '';

if (isset($_POST['loginBtn'])) {
    // Get current page value
    if (isset($_POST['current_page'])) {
        $previous_page = $_POST['current_page'];
    }

    // Get input values & validate form
    if (isset($_POST['login_email'])) {
        $email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL); // Sanitization
        $_SESSION['loginValues']['email'] = $email;

        if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $_SESSION['loginErrors']['login_email'] = "This field is invalid!";
        }
    } else {
       $_SESSION['loginErrors']['login_email'] = "This field is required!";
    }
        
    if (isset($_POST['login_password'])) {
        $password = filter_var($_POST['login_password'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['loginValues']['password'] = $password;
    } else {
       $_SESSION['loginErrors']['password'] = "This field is required!";
    }

    var_dump(count($_SESSION['loginErrors']));

    // Process form data, handling errors & redirections
    if (count($_SESSION['loginErrors']) == 0) {
        $currentUser = getUserByEmail($conn, $email); // array OR false
        var_dump($currentUser);

        // check if the user email exists in the db & if password match
        if ($currentUser != false) {
            if (password_verify($password ,$currentUser['password'])) {
                $_SESSION['user'] = $currentUser;

                // update user in the db: is_connected = true
                $updateUser = updateUserByConnection($conn, $currentUser['user_id'], true); // true or false
                var_dump($updateUser); // false

                if ($updateUser) {
                    $_SESSION['user']['is_connected'] = true;
                    $_SESSION['success_message'] = "You are now logged in.";

                    // redirect to the previous page with success message
                    header('location: '.$previous_page);
                }
            } else {
                $_SESSION['loginErrors']['credentials'] = "Wrong credentials! Please try again.";

                // redirect & send errors to the previous page
                header('location: '.$previous_page);
            }
        } else {
            $_SESSION['loginErrors']['credentials'] = "Wrong credentials! Please try again.";

            // redirect & send errors to the previous page
            header('location: '.$previous_page);
        }        
    } else {
    	// redirect & send validation errors to the previous page
        header('location: '.$previous_page);
    }
} else {
    // the user accesed this page without passing by the form => redirect the user to the previous page
    header('location: '.$previous_page);
    // exit();
}

?>