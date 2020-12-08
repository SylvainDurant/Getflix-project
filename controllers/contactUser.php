<?php 
include('../database/functions.php');
session_start(); // Start a session
//var_dump($_POST); 
//die(); 
$messageSucces = "";
$_SESSION['contactErrors'] = [];

if(isset($_POST['buttonContact'])){
    

    if(empty($_POST['firstnamecontact'])){
        $_SESSION['contactErrors']["firstname"] = "le champ first name est vide";
    }else{
        $firstnamecontact = filter_var($_POST['firstnamecontact'], FILTER_SANITIZE_STRING); // Sanitization
    }
    
    if(empty($_POST['lastnamecontact'])){
        $_SESSION['contactErrors']["lastname"] = "le champ last name est vide"; 
    }else{
        $lastnamecontact = filter_var($_POST['lastnamecontact'], FILTER_SANITIZE_STRING); // Sanitization
    }
    
    if(empty($_POST['emailcontact'])){
        $_SESSION['contactErrors']["emailname"] = "le champ email est vide"; 
    }else{
        $email = filter_var($_POST['emailcontact'], FILTER_SANITIZE_EMAIL); // Sanitization
    }


    if(empty($_POST['messagecontact'])){
        $_SESSION['contactErrors']["messagecontact"] = "champ message est vide";
    }else{
        $message = filter_var($_POST['messagecontact'], FILTER_SANITIZE_STRING); // Sanitization
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