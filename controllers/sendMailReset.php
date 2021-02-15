<?php
include('../helpers/functions.php');
session_start(); // Start a session

$_SESSION['forgotErrors'] = [];

if (isset($_POST['forgotBtn'])) {

    // Get input values & validate form
    if (isset($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitization
        $_SESSION['forgotValues']['email'] = $email;

        if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $_SESSION['forgotErrors']['error'] = "This field is invalid!";
        }
    } else {
       $_SESSION['forgotErrors']['error'] = "This field is required!";
    }

    // Process form data, handling errors & redirections
    if (count($_SESSION['forgotErrors']) == 0) {
        $currentUser = getUserByEmail($conn, $email); // array OR false

        // check if the user email exists in the db
        if ($currentUser != false) {
            var_dump($currentUser);
            var_dump($email);

            $token = bin2hex(random_bytes(78));
            $tokenExpire = time() + 1800; // 30 minutes
            var_dump($token);
            var_dump($tokenExpire);

            ///// Give Token to the User /////
            updateUserToken($conn, $currentUser['user_id'], $token, $tokenExpire);

            ///// SEND MAIL /////

            $from = 'thedisturbedone@hotmail.be';
            $subject = "Password Reset";
            $message = 'Hello '.$currentUser['first_name'].',\n\n'.
                'You recently requested to reset your password for your Moosic account. Click the link below to reset it.\n'.
                'http://moosic.great-site.net/pages/resetPage.php?token='.$token.' \n\n'.
                'If you did not request a password reset, please ignore this email. This link is only valid for the next 30 minutes.\n\n'.
                'Thank you and stay tune!';
            mail($email,$subject,$message,$from);
            echo $message;

            $_SESSION['success_message'] = "A password reset link has been sent to your email address.";
            // redirect to the previous page with success message
            header('location: ../pages/resetPassword.php');
        } else {
            $_SESSION['forgotErrors']['error'] = "This email address is not registered";

            // redirect & send errors to the previous page
            header('location: ../pages/resetPassword.php');
        }        
    } else {
    	// redirect & send validation errors to the previous page
        header('location: ../pages/resetPassword.php');
    }
} else {
    // the user accessed this page without passing by the form => redirect the user to the 403 page
    header('location: ../pages/403.php');
}

?>