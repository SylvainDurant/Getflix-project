<?php
include('../database/functions.php');
session_start(); // Start a session
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>
<?php include('../layouts/notifications.php'); ?>

<section id="content" class="border border-info p-5">

    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Your name</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Your last name</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Your email address</label>
            <input type="text" class="form-control" id="textInput" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Message</span>
            </div>
            <textarea class="form-control" aria-label="With textarea"></textarea>
            <button type="submit" class="btn btn-primary">Valider</button>
    </form>


</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->