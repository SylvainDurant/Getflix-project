<?php
include('../database/db.php');
include('../database/functions.php');

session_start(); // Start a session

$page = 2;
$video = fetchOneSong($conn,$page);
$comments = fetchAllCommentsByVideo($conn,$page);
$recommendations = fetchAllSongs($conn);
// var_dump($video);
// var_dump($comments);
// var_dump($comments[0]);
// var_dump($recommendations);

?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<div class="container col-12">
    <div class="row justify-content-center">
        <div class="col-11 mt-3 shadow-lg mb-5">
            <div class="embed-responsive embed-responsive-16by9 mb-1" style="max-height:500px">
                <iframe class="embed-responsive-item" src="<?php echo $video['source']?>"></iframe>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <div class="container" style="height:100%;">
                        <div class="row">
                            <h3><?php echo $video['artist_name'].": ". $video['title']?></h3>
                        </div>
                        <div class="row">
                            <div class="container p-0">
                                <img src="<?php echo $video['album_image']?>" alt="<?php echo $video['artist_name']?>" class="p-1 float-left" style="height:100px; width:100px;">
                                <div class="row">
                                    <p><?php echo $video['description']?></p>
                                </div>
                                <div class="row align-items-end">
                                    <p class="text-muted m-0">Uploaded by <a href="http://" class="card-link"><?php echo $video['pseudo']?></a> on <?php echo $video['created_at']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 p-0">
                    <div class="container">
                        <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-success btn-block">666 K</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger btn-block">-1</button>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col mt-3">
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
    </div>

    <div class="row justify-content-center">
        <div class="col-11 mb-5">
            <div class="row justify-content-between">
                <?php ?>
                <div class="col-12 col-md-8 p-2">
                    <h5><u>comments:</u></h5>
                    <div class='card mb-3 shadow' style='width: 100%;'>
                        <form action="" method="post" class="form-inline">
                            <!-- CHANGER L'IMAGE POUR CELLE DE L'UTILISATEUR QUI EST LOGGER!!!!!!!! -->
                            <img src="<?php echo $video['photo']?>" class="rounded-circle m-1" alt="<?php echo $video['pseudo']?>" style="height:50px; width:50px; float:left;">
                            <div class="col">
                            <textarea type="text" class="form-control mr-sm-2" id="inlineFormInputName2" rows="1" placeholder="Add a comment" style="width:75%;"></textarea>
                            <input class="btn btn-info" type="submit" value="Send">
                            </div>
                        </form>        
                    </div>
                    <?php foreach ($comments as $value){ ?>
                    <div class='card mb-3 shadow' style='width: 100%;'>
                        <div class='row no-gutters'>
                            <a href="http://"><img src="<?php echo $value['photo']?>" class='rounded-circle m-1' alt="<?php echo $value['pseudo']?>" style="height:50px; width:50px; float:left;"></a>
                            <div>
                                <a href="http://" class="card-link"><h5 class='card-title'><?php echo $value['pseudo']?></h5></a>
                                <p class='card-text'><?php echo $value['text']?></p>
                                <p class='card-text'><small class='text-muted'><?php echo $value['created_at']?></small></p>
                            </div>
                        </div>
                    </div>
                    <?php };?>
                </div>
                
                <div class="col-md-3 p-2">
                    <h5><u>recommendations:</u></h5>
                    <?php foreach ($recommendations as $other){ ?>
                        <div class='col-4 col-md-12 mb-3 shadow float-left text-truncate' style='width: 100%;'>
                            <iframe width="100%" height="100" src="<?php echo $other['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <p><?php echo $other['artist_name'].": ". $other['title']?></p>
                        </div>
                    <?php };?>
                </div>
            </div>  
        </div>
    </div>
</div>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<?php session_unset(); // Close the session ?>