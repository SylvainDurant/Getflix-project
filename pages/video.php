<?php
include('../database/db.php');

$video = $user["source"];
$title = $user["title"];
$artist = $user["artist_name"];
$album = $user["album_name"];
$album_image = $user["album_image"];
$description = $user["description"];
var_dump($description);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
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
</body>
</html>