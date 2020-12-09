<?php
include('../database/functions.php');
session_start(); // Start a session

$songs = fetchAllSongs($conn);
// var_dump($songs);
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="result" class="border border-info p-5 text-center">

    <?php if (isset($_GET['search'])){
        $search = $_GET['search'];
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
    }

    if ((count($title_result) >= 1) || (count($artist_result) >= 1)){ 

        if (count($title_result) >= 1){?>
            <h1><u>Title</u></h1>
            <div class="row p-2 justify-content-center">

                <?php foreach ($title_result as $song){ ?>

                    <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow ">
                        <div class='text-truncate'>
                            <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                        </div>
                        <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>)"></div>
                    </div>

                <?php } ?>

            </div>
        <?php }

        if (count($artist_result) >= 1){?>
            <h1><u>Artist</u></h1>
            <div class="row p-2 justify-content-center">

                <?php foreach ($artist_result as $song){ ?>

                    <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow ">
                        <div class='text-truncate'>
                            <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                        </div>
                        <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>)"></div>
                    </div>

                <?php } ?>

            </div>
        <?php }
        
    } else { ?>

        <h1>404</h1>
        <h3>Video not found</h3>
        <img src="https://media4.giphy.com/media/6uGhT1O4sxpi8/giphy.gif?cid=ecf05e4745ed5d329a1ce979278cb6762c70355283a5dcc6&rid=giphy.gif" alt="404NotFound">
        <p class="mt-5">Didn't find what you were looking for?</p>
        <a href="">Add a video!</a>
    
    <?php } ?>

</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->