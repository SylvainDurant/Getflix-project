<?php 
include('../database/functions.php');
session_start(); // Start a session
//var_dump($_POST); 
//die(); 
$messageSucces = "";
$_SESSION['contactErrors'] = [];

if(isset($_POST['buttonContact'])){
    

    if(empty($_POST['firstnamecontact'])){
        $_SESSION['contactErrors']["firstname"] = "the field first name  is empty ";
    }else{
        $firstnamecontact = filter_var($_POST['firstnamecontact'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['contact']['firstnamecontact'] = $firstnamecontact ;
        
        if(strlen($firstnamecontact) < 2){
            $_SESSION['contactErrors']["firstname"] = "The field must have more than 2 characters";
        }
    }
    
    if(empty($_POST['lastnamecontact'])){
        $_SESSION['contactErrors']["lastname"] = "the field last name  is empty "; 
    }else{
        $lastnamecontact = filter_var($_POST['lastnamecontact'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['contact']['lastnamecontact'] = $lastnamecontact ;

        if(strlen($lastnamecontact) < 2){
            $_SESSION['contactErrors']["lastname"] = "The field must have more than 2 characters";
        }
    }
    
    if(empty($_POST['emailcontact'])){
        $_SESSION['contactErrors']["emailname"] = "the field email adress is empty"; 
    }else{
        $emailcontact = filter_var($_POST['emailcontact'], FILTER_SANITIZE_EMAIL); // Sanitization
        $_SESSION['contact']['emailcontact'] = $emailcontact ;
    }


    if(empty($_POST['messagecontact'])){
        $_SESSION['contactErrors']["messagecontact"] = "the field message is empty";
    }else{
        $message = filter_var($_POST['messagecontact'], FILTER_SANITIZE_STRING); // Sanitization
        $_SESSION['contact']['message'] = $message ;

        if(strlen($message) < 2){
            $_SESSION['contactErrors']["messagecontact"] = "The field must have more than 2 characters";
        }
        // $messageSucces = "Succès :)";
    }
//var_dump($_SESSION); 
//die(); 

/**S'il y a aucune erreur alors envoyer un message de succès**/
    if(count($_SESSION['contactErrors']) == 0){
        $_SESSION['contactSucces'] = "Succès :)"; 
    }else{
        
    }

    header('location: '. '../pages/contact.php');
}




?>