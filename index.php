<?php
include('./database/functions.php');
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

$categories = fetchAllCategory($conn);
$songs = fetchAllSongs($conn);

$musicCarousel = fetchLast4Songs($conn);
$lastSongs = fetchLast4Songs($conn);
//$musicCarousel = array_slice($songs, -4); // get last 4 songs
?>

<!-- HTML content -->
<?php include('./layouts/master.php'); ?>
<?php include('./layouts/header.php'); ?>

<section id="carousel" class="bg-dark p-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>

        <div class="carousel-inner">
            <?php foreach($musicCarousel as $key => $song) { ?>
                <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                    <iframe class="embed-responsive-item w-100 " style="height:500px"
                        src= "<?php echo $song['source'] ?>"></iframe>
                </div>
            <?php  } ?>
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

<section id="categories" class="p-4 row text-center">
    <div class="col-lg-5 col-sm-8 mx-auto my-4">
        <h2 class="mb-3 text-info">Categories</h2>
        <hr class="bg-info">
    </div>

    <div id="accordion" class="col-12">
        <div class="mt-3">
            <h5 class="mb-0">
                <a class="text-info text-uppercase text-15 px-3" href="#" data-toggle="collapse" data-target="#navAll" aria-expanded="true" aria-controls="navAll">All</a>
                <a class="disabled">|</a>

                <?php foreach ($categories as $key => $category) { ?>
                    <a class="text-info text-uppercase text-15 px-3" href="#" data-toggle="collapse" data-target="#nav<?php echo $category["name"]?>" aria-expanded="true" aria-controls="nav<?php echo $category["name"]?>"><?php echo $category["name"]?></a>

                    <?php if ($key != count($categories)-1) { ?>
                        <a class="disabled">|</a>
                    <?php } ?>
                <?php } ?>
            </h5>
        </div>

        <div id="navAll" class="collapse show my-5" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="row p-2 justify-content-center">
                <?php foreach ($songs as $song) { ?>
                    <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow">
                        <div class="text-truncate">
                            <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                        </div>
                        <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>,true)"></div>
                    </div>
                <?php } ?>
            </div>
        </div>  

        <?php foreach ($categories as $category) { ?>
            <div id="nav<?php echo $category["name"]?>" class="collapse my-5" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="row p-2 justify-content-center">
                    <?php foreach ($songs as $song) { 
                        if ($song["category_id"] === $category["id"]){ ?>
                        <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow ">
                            <div class='text-truncate'>
                                <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                            </div>
                            <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>,true)"></div>
                        </div>
                    <?php }} ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section id="editorsChoice">
    <div class="bg-opacity2 row text-center p-4">
        <div class="col-lg-5 col-sm-8 mx-auto my-4">
            <h2 class="mb-3 text-info">Editor's choice</h2>
            <hr class="bg-info">
        </div>

        <div class="col-12">
            <div class="row justify-content-center mx-lg-5 pb-5">
                <?php foreach ($lastSongs as $song) { ?>
                    <div class="col-12 col-sm-6 col-lg-3 my-3">
                        <div class="mx-lg-2 card shadow mb-xs-3">
                            <div class="text-truncate">
                                <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                                <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                            </div>
                            <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>,true)"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section id="newsletter" class="bg-secondary p-5">
    <div class="d-flex justify-content-center w-75 mx-auto">
        <h3 class="text">NEWSletter section</h3>
    </div>
</section>

<!-- <section id="musicChoise">
    <div class="text-center">
        <h3><u>Favorite music</u></h3>
        <div id="accordion">
            <div class="card-header">
                <h5 class="mb-0">
                    <div class="row p-2 justify-content-center">
                        <?php foreach($songs as $songChoise){ ?>
                        <iframe class="embed-responsive-item w-100 " src="<?php echo $songChoise['source'] ?>"></iframe>
                        <?php } ?>
                    </div>
                </h5>
            </div>
        </div>
    </div> 

    <div class="contenaireBlock">
        <div class="item">
            <div class="card" style="width: 18rem;">
                <?php foreach($songs as $songChoise) { ?>
                    <p><?php echo $songChoise['artist_name']?></p>

                    <div class="card-body">
                        <h5 class="card-title">Parcour de Sébastien</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="https://www.instagram.com/aidin_firouzfar/" class="btn btn-primary" id="button1">Go           somewhere</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section> -->

<?php include('./layouts/footer.php'); ?>
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