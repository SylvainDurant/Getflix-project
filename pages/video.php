<?php
include('../database/db.php');
include('../database/functions.php');

session_start(); // Start a session
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<div class="container col-12">
    <div class="row justify-content-center">
        <div class="col-11 mt-3 shadow-lg mb-5">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/_lK4cX5xGiQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="row">
                <div class="col">
                    <h3>Tenacious D - Tribute (Video)</h3>
                    <p>Tenacious D's official music video for 'Tribute'. Click to listen to Tenacious D on Spotify: http://smarturl.it/TenaciousDSpotify?...</p>
                </div>
                <div class="col-2 p-0">
                    <div class="row">
                        <button type="button" class="btn btn-success"><i class="far fa-thumbs-up"> 3</i></button>
                        <button type="button" class="btn btn-danger"><i class="far fa-thumbs-down"> -1</i></button>
                    </div>
                    <div class="row">
                        <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-11 mb-5">
            <div class="row justify-content-between">
                <div class="col-8 shadow-lg p-3">
                    <div class="shadow-sm mb-1 bg-info rounded">
                        <h5>Das_gogol</h5>
                        lol
                    </div>
                    <div class="shadow-sm bg-info rounded">
                        <h5>Das_gogol</h5>
                        PTDR!!!
                    </div>
                </div>

                <div class="col-3 shadow-lg">
                    lol
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<?php session_unset(); // Close the session ?>