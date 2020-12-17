<?php

session_start(); // Start a session

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$signout_success = isset($_SESSION['signout_success']) ? $_SESSION['signout_success'] : '';

function resetLoginForm() {
    unset($_SESSION['loginErrors']);
    unset($_SESSION['loginValues']);
}

function resetRegisterForm() {
    unset($_SESSION['registerErrors']);
    unset($_SESSION['registerValues']);
}

function resetContactForm() {
    unset($_SESSION['contactErrors']);
    unset($_SESSION['contact']);
}

if (!empty($success_message)) {
    unset($_SESSION['success_message']);
    resetLoginForm();
    resetRegisterForm();
    resetContactForm(); // if success_message from contact
}

if (!empty($signout_success)) {
    unset($_SESSION['signout_success']);
    resetLoginForm();
    resetRegisterForm();
    unset($_SESSION['user']);
}

?>