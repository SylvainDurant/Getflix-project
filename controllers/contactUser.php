<?php 
include('../helpers/functions.php');
session_start(); // Start a session

//var_dump($_POST); 
//die(); 
$messageSucces = "";
$_SESSION['contactErrors'] = [];

if(isset($_POST['buttonContact'])){

    if(empty($_POST['firstnamecontact'])){
        $_SESSION['contactErrors']["firstname"] = "The field first name is empty!";
    }else{
        $firstnamecontact = filter_var($_POST['firstnamecontact'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['contact']['firstnamecontact'] = $firstnamecontact ;
        
        if(strlen($firstnamecontact) < 2){
            $_SESSION['contactErrors']["firstname"] = "The field must have more than 2 characters!";
        }
    }
    
    if(empty($_POST['lastnamecontact'])){
        $_SESSION['contactErrors']["lastname"] = "The field last name is empty!"; 
    }else{
        $lastnamecontact = filter_var($_POST['lastnamecontact'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['contact']['lastnamecontact'] = $lastnamecontact ;

        if(strlen($lastnamecontact) < 2){
            $_SESSION['contactErrors']["lastname"] = "The field must have more than 2 characters!";
        }
    }
    
    if(empty($_POST['emailcontact'])){
        $_SESSION['contactErrors']["emailcontact"] = "The field email address is empty!"; 
    }else{
        $emailcontact = filter_var($_POST['emailcontact'], FILTER_SANITIZE_EMAIL); // Sanitization
        $_SESSION['contact']['emailcontact'] = $emailcontact ;
    }

    if(empty($_POST['messagecontact'])){
        $_SESSION['contactErrors']["messagecontact"] = "The field message is empty!";
    }else{
        $message = filter_var($_POST['messagecontact'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['contact']['message'] = $message ;

        if(strlen($message) < 2){
            $_SESSION['contactErrors']["messagecontact"] = "The field must have more than 2 characters!";
        }
        // $messageSucces = "Succès :)";
    }
    //var_dump($_SESSION); 
    //die(); 

    /**S'il y a aucune erreur alors envoyer un message de succès**/
    if (count($_SESSION['contactErrors']) == 0) {
        $_SESSION['success_message'] = "Message successfully send! <br> We will contact you as soon as possible."; 
    }

    header('location: ../pages/contact.php');
} else {
    // the user accessed this page without passing by the form => redirect the user to the 403 page
    header('location: ../pages/403.php');
}

?>