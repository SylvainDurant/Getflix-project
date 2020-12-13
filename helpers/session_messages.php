<?php

session_start(); // Start a session

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$signout_success = isset($_SESSION['signout_success']) ? $_SESSION['signout_success'] : '';

if (!empty($success_message)) {
    unset($_SESSION['success_message']);
    unset($_SESSION['registerErrors']);
    unset($_SESSION['registerValues']);
    unset($_SESSION['loginErrors']);
    unset($_SESSION['loginValues']);
    unset($_SESSION['contact']);
    unset($_SESSION['contactErrors']);
}

if (!empty($signout_success)) {
    unset($_SESSION['signout_success']);
    unset($_SESSION['registerErrors']);
    unset($_SESSION['registerValues']);
    unset($_SESSION['loginErrors']);
    unset($_SESSION['loginValues']);
    unset($_SESSION['user']);
}

?>