<header id="myheader" class="py-1 text-center text-info bg-dark">
    <!-- Navbar -->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="w-25 d-flex justify-content-center">
            <a class="navbar-brand text-info" href="<?php echo strpos($_SERVER['HTTP_HOST'], 'pages') == false ? '..' : '.'; ?>/index.php">
                <img src="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/images/Moosic_T1.1.png" class="w-25"></a>
            </a>
            <a class="navbar-brand text-info" href="<?php echo strpos($_SERVER['HTTP_HOST'], 'pages') == false ? '..' : '.'; ?>/index.php">
                <img src="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/images/Moosic_T2.1.png" class="w-25"></a>
            </a>
        </div>

        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navbarColorLight" aria-controls="navbarColorLight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarColorLight">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/index.php" data-abc="true">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/video.php">SongDetail</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/profile.php">UserProfile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/contact_us.php">Contact</a>
                </li>
            </ul>
        </div>

        <div class="d-flex justify-content-between">
           <!-- Search form -->
            <form class="form-inline form-sm active-cyan-2 mr-4">
                <input class="form-control form-control-sm mr-2 w-75" type="text" placeholder="Search"
                aria-label="Search">
                <i class="fas fa-search text-orange fa-1x" aria-hidden="true"></i>
            </form>

            <div class="mr-3 pt-1">
                <a class="text-info text-14" href=""><i class="fa fa-user fa-1x" aria-hidden="true"></i>&nbsp; Sign in</a>
            </div>

            <div class="pt-1">
                <a class="text-white-50 text-14" href=""><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i>&nbsp; Sign up</a>
            </div>

            <!-- if connected -->
            <!-- <div class="hello text-light">Hello <span class="" id="username">Nickname</span>!</div> -->
            <!-- <div class="disconnection"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Sign out</div> -->
        </div>
    </nav>
</header>