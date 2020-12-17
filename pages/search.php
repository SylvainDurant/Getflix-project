<?php
include('../helpers/variables.php');
include('../helpers/functions.php');
include('../helpers/session_messages.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$songs = fetchAllSongs($conn);
$categories = fetchAllCategory($conn);
// var_dump($songs);
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="result" class="row p-5 text-center">

    <?php if (isset($_POST['search'])){
        $search = $_POST['search'];
        $title_result = [];
        $artist_result = [];

        foreach ($songs as $value) {
            if (stripos($value["title"],$search) === false) {

            } else {
                array_push($title_result,$value);
            }
            if (stripos($value["artist_name"],$search) === false) {

            } else {
                array_push($artist_result,$value);
            }
        }

        if ((count($title_result) >= 1) || (count($artist_result) >= 1)){ 

            if (count($title_result) >= 1){?>
                <div class="col-lg-5 col-sm-8 mx-auto mb-4">
                    <h2 class="mb-3 text-info">Song title</h2>
                    <hr class="bg-info">
                </div>

                <div class="col-12 mb-5">
                    <div class="row p-2 justify-content-center">
        
                        <?php foreach ($title_result as $song) { 
                            $song_name = $song['title'];
                            $song_name = preg_replace("/($search)/i","<span class='bg-info'>$1</span>",$song_name);
                            ?>
                            
                            <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow ">
                                <div class='text-truncate'>
                                    <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <p><?php echo $song_name?></p>
                                </div>
                                <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>)"></div>
                            </div>
        
                        <?php } ?>
        
                    </div>
                </div>
            <?php }
    
            if (count($artist_result) >= 1){?>
                <div class="col-lg-5 col-sm-8 mx-auto mb-4">
                    <h2 class="mb-3 text-info">Artist</h2>
                    <hr class="bg-info">
                </div>

                <div class="col-12">
                    <div class="row p-2 justify-content-center">
        
                        <?php foreach ($artist_result as $song){ 
                            $artist_name = $song['artist_name'];
                            $artist_name = preg_replace("/($search)/i","<span class='bg-info'>$1</span>",$artist_name);
                            ?>
        
                            <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow ">
                                <div class='text-truncate'>
                                    <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <p><?php echo $artist_name.": ". $song['title']?></p>
                                </div>
                                <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>)"></div>
                            </div>
        
                        <?php } ?>
    
                    </div>
                </div>
            <?php }
            
        } else { ?>
    
            <div class="col-12">
                <h3>Video not found !</h3>
                <img src="https://media4.giphy.com/media/6uGhT1O4sxpi8/giphy.gif?cid=ecf05e4745ed5d329a1ce979278cb6762c70355283a5dcc6&rid=giphy.gif" alt="404NotFound">
            </div>
        
        <?php } ?>
    
        <?php if ($user && $user['is_connected']) { ?> <!-- if connected -->
            <div class="col-12">
                <p class="mt-5">Didn't find what you were looking for?</p>
                <a href="" data-toggle="modal" class="btn btn-secondary" data-target="#addVideoFormModal">Add a video!</a>
            </div>
        <?php } 
    } else { ?>
        <div class="col-12">
            <img src="https://memegenerator.net/img/instances/51059800.jpg" alt="WTF">
        </div>
    <?php } ?>
</section>

<!-- Add a video form Modal window -->
<div id="addVideoFormModal" class="modal fade <?php echo (count($loginErrors) > 0) ? 'show d-block' : ''; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add a new video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form action="<?php echo $root; ?>/controllers/newVideo.php" method="post" id="newVideoForm" class="text-dark pt-3 px-5 text-left form-horizontal">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

                    <div class="d-flex justify-content-between">
                        <div class="form-group flex-fill">
                            <!-- title -->
                            <label class="control-label" for="song_title">Title*</label>
                            <input type="text" id="song_title" name="song_title" value="<?php echo $song_title; ?>" class="form-control" placeholder="Song's title" required>
                        </div>

                        <div class="form-group flex-fill col-4 pr-0">
                            <!-- artist -->
                            <label class="control-label" for="song_artist">Artist*</label>
                            <input type="text" id="song_artist" name="song_artist" value="<?php echo $song_artist; ?>" class="form-control" placeholder="Song's artist" required>
                        </div>

                        <div class="form-group flex-fill col-4 pr-0">
                            <!-- category -->
                            <label class="control-label" for="song_category">Category*</label>
                            <select id="song_category" name="song_category" class="form-control" required>

                                <option value="">Select a category</option>

                                <?php foreach ($categories as $key => $category) { ?>
                                    <option value="<?php echo $key+1; ?>"><?php echo $category["name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- url -->
                        <label class="control-label" for="song_url">Url Youtube*</label>
                        <input type="url" id="song_url" name="song_url" value="<?php echo $song_url; ?>" class="form-control" placeholder="https://www.youtube.com/example" required>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <div class="form-group flex-fill">
                            <!-- album name -->
                            <label class="control-label" for="song_album">Album name</label>
                            <input type="text" id="song_album" name="song_album" value="<?php echo $song_album; ?>" class="form-control" placeholder="Song's album">
                        </div>

                        <div class="form-group flex-fill col-3 pr-0">
                            <!-- released date -->
                            <label class="control-label" for="song_date">Released date</label>
                            <input type="date" id="song_date" name="song_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- album image -->
                        <label class="control-label" for="song_album_image">Url album image</label>
                        <input type="url" id="song_album_image" name="song_album_image" value="<?php echo $song_album_image; ?>" class="form-control" placeholder="https://wikipedia/theAlbumCover.jpg">
                    </div>

                    <div class="form-group">
                        <!-- description -->
                        <label class="control-label" for="song_description">Description</label>
                        <textarea id="song_description" name="song_description" rows="2" cols="30" class="form-control"></textarea>
                    </div>

                    <?php if ($credentials_error) { ?>
                        <div class="alert alert-danger"><?php echo $credentials_error; ?></div>
                    <?php } ?>
                    
                    <div class="form-group col-12 text-right px-3">
                        <button type="submit" class="btn btn-info" name="addBtn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->