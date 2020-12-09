<?php
include('../database/functions.php');
session_start(); // Start a session
var_dump($_SESSION); 
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>
<?php include('../layouts/notifications.php'); ?>

<section id="content" class="border border-info p-5">

    <form action="../controllers/contactUser.php" method="POST">
        <div class="form-group">
            <label for="firstnamecontact">Your name</label>
            <input type="text" name="firstnamecontact" class="form-control" aria-describedby="emailHelp">
        </div>


        <div class="form-group">
            <label for="lastnamecontact">Your last name</label>
            <input type="text" name="lastnamecontact" class="form-control">
        </div>


        <div class="form-group">
            <label for="emailcontact">Your email address</label>
            <input type="email" name="emailcontact" class="form-control">
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Message</span>
            </div>
            <textarea class="form-control" name="messagecontact" aria-label="With textarea"></textarea>
        </div>
        <div class="form-group text-right p-2">
            <button type="submit" name='buttonContact' class="btn btn-info ">Send</button>
        </div>
    </form>


</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->