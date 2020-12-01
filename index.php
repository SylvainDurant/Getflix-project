<?php
include('./database/db.php');
include('./database/functions.php');

session_start(); // Start a session

$users = fetchAllUsers($conn);
$user2 = fetchUserById($conn);
$songs = fetchAllSongs($conn);
// var_dump($user2);
// var_dump($songs);
?>

<!-- HTML content -->
<?php include('./layouts/master.php'); ?>
<?php include('./layouts/header.php'); ?>

<section id="content" class="border border-info p-5">
    <h3>here will be the content</h3>
</section>

<?php include('./layouts/footer.php'); ?>
<!-- end HTML content -->

<?php session_unset(); // Close the session ?>