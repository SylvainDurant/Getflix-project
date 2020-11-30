<?php
include('../database/db.php');
include('../database/functions.php');

session_start(); // Start a session

$video = $user["source"];
$title = $user["title"];
$artist = $user["artist_name"];
$album = $user["album_name"];
$album_image = $user["album_image"];
$description = $user["description"];
var_dump($description);
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<div class="container col-12">
    <div class="row justify-content-center">
        <div class="col-11 mt-3 shadow-lg mb-5">
            <iframe width="100%" height="600" src="<?php echo $video?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="row">
                <div class="col">
                    <h3><?php echo "$artist: $title"?></h3>
                    <img src="<?php echo $album_image?>" alt="<?php echo $artist?>" style="height:100px; width:100px; float:left;">
                    <p><?php echo $description?></p>
                </div>
                <div class="col-2 p-0">
                    <div class="row">
                        <div class="col text-right mr-3">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-success btn-block"><i class="far fa-thumbs-up"> 666 K</i></button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger btn-block"><i class="far fa-thumbs-down"> -1</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m-3">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
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