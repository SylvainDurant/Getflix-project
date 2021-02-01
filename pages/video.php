<?php
include('../helpers/variables.php');
include('../helpers/functions.php');
include('../helpers/session_messages.php');

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

<div class="videoBackground w-100">
    <div class="bg-opacity row justify-content-center m-0">
        <!-- <div class="col-11 mt-3 mb-5 text-light transparentBackground"> -->
        <div class="container col-11 mx-auto mt-4">

            <!--///// video section \\\\\-->
            <div class="row justify-content-center">
                <div class="col-11 mt-3 mb-3 text-light">
                    <div class="embed-responsive embed-responsive-16by9 mb-1" style="max-height:500px">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $video['source']?>"></iframe>
                    </div>
                    
                    <div class="row pt-3">
                        <div class="col mb-2">
                            <div class="container" style="height:100%;">
                                <div class="row">
                                    <h1><?php echo $video['artist_name'].": ". $video['title']?></h1>
                                </div>
                                <div class="row">
                                    <div class="d-flex p-0">
                                        <div>
                                            <img src="<?php echo $video['album_image']?>" alt="<?php echo $video['artist_name']?>" class="p-1 float-left" style="max-height:100px; width:auto;">
                                        </div>

                                        <div class="d-flex flex-column">
                                            <h4><?php echo "From the album: ".$video['album_name']?></h4>
                                            <p><?php echo $video['description']?></p>
                                            <p class="text-muted mb-0 mt-auto">Uploaded by <a href="./profile.php?pseudo=<?php echo $video['pseudo']?>" class="card-link"><?php echo $video['pseudo']?></a> on <?php echo $video['created_at']?></p>
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

                <!--///// comments section \\\\\-->
                <div class="col-12 col-md-8 pl-0 pr-5">
                    <div class="container px-0 my-5">
                        <h3 class="mb-3 text-info">Comments</h3>
                        <hr class="bg-info w-50 ml-0">
                    </div>

                    <div class='card mb-3 shadow' style='width: 100%;'>
                        <form action="<?php echo $root; ?>/controllers/newComment.php" method="post" class="form-inline">
                            <img src=" <?php echo isset($user) ? $user['photo']:'../images/Unknown_user.png'?> " class="rounded-circle m-1" alt="<?php echo isset($user) ? $user['pseudo']:'Unregistered user' ?>" style="height:50px; width:50px; float:left;">
                            <div class="col">
                                <textarea id="comment" name="comment" type="text" class="form-control mr-sm-2" id="inlineFormInputName2" rows="1" placeholder="<?php echo isset($user) ? 'Add a comment':'you must be logged in to post a comment'?>" style="width:75%;" <?php echo isset($user) ? '':'disabled data-bs-toggle="tooltip" data-bs-placement="bottom" title="you must be logged in to post a comment"'?>></textarea>
                                <input type="hidden" name="song_id" value="<?php echo $video['id'] ?>">
                                <input id="addComment" name="addComment" class="btn btn-info" type="submit" value="Send" <?php echo isset($user) ? '':'disabled data-bs-toggle="tooltip" data-bs-placement="bottom" title="you must be logged in to post a comment"'?>>
                            </div>
                        </form>        
                    </div>

                    <?php foreach ($comments as $value) { ?>
                        <div class='card mb-3 shadow' style='width: 100%;'>
                            <div class='row no-gutters'>
                                <a href="./profile.php?pseudo=<?php echo $value['pseudo']?>"><img src="<?php echo $value['photo']?>" class='rounded-circle m-1' alt="<?php echo $value['pseudo']?>" style="height:50px; width:50px; float:left;"></a>
                                
                                <div class="p-2 col-11">
                                    <a href="./profile.php?pseudo=<?php echo $value['pseudo']?>" class="card-title font-weight-bold"><?php echo $value['pseudo']?></a>
                                    <?php if ($value['user_id'] === $user['user_id']){ ?>
                                        <a href="" class="card-title float-right"><i class="fas fa-trash-alt"></i></a>
                                        <a class="card-title float-right px-2" onclick="modify(<?php echo $value['id'] ?>)"><i class="fas fa-edit"></i></a>
                                    <?php } ?>

                                    <p id="<?php echo $value['id'] ?>" class='card-text'><?php echo $value['text']?></p>
                                    <div id="modify<?php echo $value['id'] ?>" hidden>
                                        <textarea id="comment<?php echo $value['id'] ?>" name="comment<?php echo $value['id'] ?>" type="text" class="form-control mr-sm-2" rows="1" style="width:75%;"></textarea>
                                        <input class="btn btn-info" type="button" value="Cancel" onclick="modify(<?php echo $value['id'] ?>)">
                                        <input id="modifyComment" name="modifyComment" class="btn btn-info" type="submit" value="Save changes" onclick="confirmModify(<?php echo $value['id'] ?>)">
                                    </div>
                                    <p class='card-text'><small class='text-muted'><?php echo $value['created_at']?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                
                <!--///// recommendations section \\\\\-->
                <div class="col-12 col-md-4 pl-0">
                    <div class="container px-0 my-5">
                        <h3 class="mb-3 text-info">Recommendations</h3>
                        <hr class="bg-info w-50 ml-0">
                    </div>

                    <?php foreach ($recommendations as $other) { 
                        if ($other["id"] != $video["id"]) { ?>
                            <div class="card col-4 col-md-12 mb-3 shadow float-left">
                                <div class='text-truncate'>
                                    <img width="100%" height="100" style="object-fit: cover;" src="https://img.youtube.com/vi/<?php echo $other['source']?>/mqdefault.jpg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></img>
                                    <p><?php echo $other['artist_name'].": ". $other['title']?></p>
                                </div>
                                <div class="card-img-overlay myLink" onclick="move(<?php echo $other['id']?>)"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
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