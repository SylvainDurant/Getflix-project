<?php
include('../database/functions.php');
session_start(); // Start a session

$songs = fetchAllSongs($conn);
// var_dump($songs);
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>
<?php include('../layouts/notifications.php'); ?>

<section id="result" class="border border-info p-5 text-center">

    <?php if (isset($_GET['search'])){
        $search = $_GET['search'];
        foreach ($songs as $value) {
            $x = $value["artist_name"];

            // if (str_contains($x, $search)){
            //     echo "Mother Fucking Yeah!!!";
            // }
        }
    } ?>

    <h1>404</h1>
    <h3>Video not found</h3>
    <img src="https://media4.giphy.com/media/6uGhT1O4sxpi8/giphy.gif?cid=ecf05e4745ed5d329a1ce979278cb6762c70355283a5dcc6&rid=giphy.gif" alt="404NotFound">

</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->