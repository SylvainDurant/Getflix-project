<header id="myheader" class="py-1 text-center text-info bg-dark">
    <!-- Navbar -->
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand text-info" href="<?php echo strpos($_SERVER['HTTP_HOST'], 'pages') == false ? '..' : '.'; ?>/index.php">
            <h2 class="mb-0">Moosic</h2>
        </a>

        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navbarColorLight" aria-controls="navbarColorLight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarColorLight">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo strpos($_SERVER['HTTP_HOST'], '/pages/') == false ? '.' : '..'; ?>/index.php" data-abc="true">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">About us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo strpos($_SERVER['HTTP_HOST'], '/pages/') == false ? './pages' : '.'; ?>/contact_us.php">Contact us</a>
                </li>
            </ul>
        </div>

        <div class="d-flex justify-content-between">
           <!-- Search form -->
            <form class="form-inline form-sm active-cyan-2 mr-4">
                <input class="form-control form-control-sm mr-2 w-75" type="text" placeholder="Search"
                aria-label="Search">
                <i class="fas fa-search" aria-hidden="true"></i>
            </form>

            <div class="mr-3 pt-1">
                <a class="text-info text-14" href=""><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Sign in</a>
            </div>

            <div class="pt-1">
                <a class="text-white-50 text-14" href=""><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Sign up</a>
            </div>

            <!-- if connected -->
            <!-- <div class="hello text-light">Hello <span class="" id="username">Nickname</span>!</div> -->
            <!-- <div class="disconnection"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Sign out</div> -->
        </div>
    </nav>
</header>