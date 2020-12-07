<?php
include('./database/functions.php');
session_start(); // Start a session

$categories = fetchAllCategory($conn);
$songs = fetchAllSongs($conn);
$musicCarousel = fetchLast4Songs($conn);
//var_dump($songs); 

?>

<!-- HTML content -->
<?php include('./layouts/master.php'); ?>
<?php include('./layouts/header.php'); ?>
<?php include('./layouts/notifications.php'); ?>

<section id="content" class="bg-dark p-5">
    <h3>The movies</h3>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>

        <div class="carousel-inner">
            <?php foreach($musicCarousel as $key => $song){ ?>
            <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                <iframe class="embed-responsive-item w-100 " style="height:500px"
                    src="<?php echo $song['source'] ?>"></iframe>
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

<section id="categories">
    <div class="text-center">
        <h3><u>Categories</u></h3>
        <div id="accordion">
            <div class="card-header">
                <h5 class="mb-0">
                    <a class="btn btn-link" data-toggle="collapse" data-target="#navAll" aria-expanded="true"
                        aria-controls="navAll">All</a>
                    <a class="disabled">|</a>
                    <?php foreach ($categories as $key => $category) { ?>
                    <a class="btn btn-link" data-toggle="collapse" data-target="#nav<?php echo $category["name"]?>"
                        aria-expanded="true"
                        aria-controls="nav<?php echo $category["name"]?>"><?php echo $category["name"]?></a>
                    <?php if ($key != count($categories)-1){ ?>
                    <a class="disabled">|</a>
                    <?php }} ?>
                </h5>
            </div>
            <div id="navAll" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="row p-2 justify-content-center">
                    <?php foreach ($songs as $song) { ?>
                    <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow">
                        <div class="text-truncate">
                            <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                        </div>
                        <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>,true)"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php foreach ($categories as $category) { ?>
            <div id="nav<?php echo $category["name"]?>" class="collapse" aria-labelledby="headingOne"
                data-parent="#accordion">
                <div class="row p-2 justify-content-center">
                    <?php foreach ($songs as $song) { 
                            if ($song["category_id"] === $category["id"]){ ?>
                    <div class="card col-12 col-sm-4 col-lg-2 m-1 shadow ">
                        <div class='text-truncate'>
                            <iframe width="100%" height="100" src="<?php echo $song['source']?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <p><?php echo $song['artist_name'].": ". $song['title']?></p>
                        </div>
                        <div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>,true)"></div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>



<section id="musicChoise">
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
                <p><?php foreach($songs as $songChoise){  ?>" </p>
                    <p><?php echo $songChoise['artist_name']?></p>
                <div class="card-body">
                    <h5 class="card-title">Parcour de Sébastien</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the card's
                        content.</p>
                    <a href="https://www.instagram.com/aidin_firouzfar/" class="btn btn-primary" id="button1">Go
                        somewhere</a>
                </div>
                <?php }?>
            </div>
        </div>
        
        


    </div>
</section>

<?php include('./layouts/footer.php'); ?>
<!-- end HTML content -->