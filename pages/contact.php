<?php
// AVOIR LA BASE DE DONNER DANS LE LOCAL !
//include('../database/db.php');
//include('../database/functions.php');

session_start(); // Start a session

//$users = fetchAllUsers($conn);
//$user2 = fetchUserById($conn);
//$songs = fetchAllSongs($conn);
// var_dump($user2);
// var_dump($songs);
?>

<!-- HTML content -->
<!-- Ici nous sortons du dossier page pour se rendre vers le layout/master.php -->
<?php include('../layouts/master.php'); ?>
<?php //include('../layouts/header.php'); ?>

<!--Formulaire contact-->
<section id="contactFormulaire" class=" container row p-5">
    <div class="col-8 mx-auto">
        <h3>Formulaire contact </h3>
        <form>
            <div class="form-group">
                <label for="formGroupExampleInput">Your first name</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Your last name</label>
                <input type="text" class="form-control" id="formGroupExampleInput2">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Your email adress</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Message</span>
                </div>
                <textarea class="form-control" aria-label="With textarea" rows="5"></textarea>
            </div>
            <button type="button" class="btn btn-primary btn-lg mt-2">Large button</button>
        </form>
    </div>
</section>
<!-- end formulaire contact -->

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<?php session_unset(); // Close the session ?>