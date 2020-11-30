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
<?php include('layouts/master.php'); ?>
<? //php include('../layouts/header.php'); ?>

<section id="content" class="border border-info p-5">
    <h3>Carousel </h3>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>

<?php// include('layouts/footer.php'); ?>
<!-- end HTML content -->

<?php session_unset(); // Close the session ?>