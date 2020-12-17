<?php
include('../database/functions.php');
session_start(); // Start a session

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$signout_success = isset($_SESSION['signout_success']) ? $_SESSION['signout_success'] : '';

if (!empty($success_message)) {
    unset($_SESSION['success_message']);
    unset($_SESSION['registerErrors']);
    unset($_SESSION['loginErrors']);
    unset($_SESSION['registerValues']);
    unset($_SESSION['loginValues']);
}

if (!empty($signout_success)) {
    unset($_SESSION['signout_success']);
    unset($_SESSION['registerErrors']);
    unset($_SESSION['loginErrors']);
    unset($_SESSION['registerValues']);
    unset($_SESSION['loginValues']);
    unset($_SESSION['user']);
}

$page = 1;
if (isset($_GET["id"])){
    $page = $_GET["id"];
}

$video = fetchOneSong($conn,$page);
$comments = fetchAllCommentsByVideo($conn,$page);
$recommendations = fetchAllSongsByCategory($conn,$video["category_id"]);
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<div class="container col-11 mx-auto mt-4 videoBackground">
    <div class="row justify-content-center">
        <div class="col-11 mt-3 shadow-lg mb-3">
            <div class="embed-responsive embed-responsive-16by9 mb-1" style="max-height:500px">
                <iframe class="embed-responsive-item" src="<?php echo $video['source']?>"></iframe>
            </div>
            
            <div class="row pt-3">
                <div class="col mb-2">
                    <div class="container" style="height:100%;">
                        <div class="row">
                            <h3><?php echo $video['artist_name'].": ". $video['title']?></h3>
                        </div>
                        <div class="row">
                            <div class="container p-0">
                                <img src="<?php echo $video['album_image']?>" alt="<?php echo $video['artist_name']?>" class="p-1 float-left" style="max-height:100px; width:auto;">
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

                <div class="col-3 p-0">
                    <div class="row pr-4">
                        <div class="col-6">
                            <button type="button" class="btn btn-info btn-block">666 K</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger btn-block">-1</button>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="row justify-content-between px-5 mb-5">
        <div class="col-12 col-md-8 pl-0 pr-5">
            <div class="container px-0 my-5">
                <h3 class="mb-3 text-info">Comments</h3>
                <hr class="bg-info w-50 ml-0">
            </div>

            <div class='card mb-3 shadow' style='width: 100%;'>
                <form action="" method="post" class="form-inline">
                    <!-- CHANGER L'IMAGE POUR CELLE DE L'UTILISATEUR QUI EST LOGGER!!!!!!!! -->
                    <img src="<?php echo $video['photo']?>" class="rounded-circle m-1" alt="<?php echo $video['pseudo']?>" style="height:50px; width:50px; float:left;">

                    <div class="col p-2">
                        <textarea type="text" class="form-control mr-sm-4" id="inlineFormInputName2" rows="3" placeholder="Add a comment" style="width:75%;"></textarea>
                        <input class="btn btn-info" type="submit" value="Send">
                    </div>
                </form>        
            </div>

            <?php foreach ($comments as $value) { ?>
                <div class='card mb-3 shadow' style='width: 100%;'>
                    <div class='row no-gutters'>
                        <a href="http://"><img src="<?php echo $value['photo']?>" class='rounded-circle m-1' alt="<?php echo $value['pseudo']?>" style="height:50px; width:50px; float:left;"></a>
                        
                        <div class="p-2">
                            <a href="http://" class="card-link"><h5 class='card-title'><?php echo $value['pseudo']?></h5></a>
                            <p class='card-text'><?php echo $value['text']?></p>
                            <p class='card-text'><small class='text-muted'><?php echo $value['created_at']?></small></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
                
        <div class="col-12 col-md-4 pl-0">
            <div class="container px-0 my-5">
                <h3 class="mb-3 text-info">Recommendations</h3>
                <hr class="bg-info w-50 ml-0">
            </div>

            <?php foreach ($recommendations as $other) { 
                // !!!! it's user id not video id :'( !!!!!!!!!
                if ($other["id"] != $video["id"]) { ?>
                    <div class="card col-4 col-md-12 mb-3 shadow float-left">
                        <div class='text-truncate'>
                            <iframe width="100%" height="100" src="<?php echo $other['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <p><?php echo $other['artist_name'].": ". $other['title']?></p>
                        </div>
                        <div class="card-img-overlay myLink" onclick="move(<?php echo $other['id']?>)"></div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<script type="text/javascript">
    $(function() {
        var success_message = "<?php echo $success_message; ?>";
        var signout_success = "<?php echo $signout_success; ?>";

        if (success_message != '') {
            toastr.info(success_message);
        }

        if (signout_success != '') {
            toastr.info(signout_success);
        }
    });
</script>