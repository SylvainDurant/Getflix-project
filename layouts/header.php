<header id="myheader" class="py-1 text-center text-info">
    <!-- Navbar -->
	<nav class="navbar navbar-expand-md navbar-dark">
        <div class="d-flex justify-content-center col-lg-1">
            <a class="navbar-brand text-info p-0 m-0" href="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/index.php">
                <img src="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/images/Moosic_T1.1.png" class="w-100"></a>
            </a>
        </div>

        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navbarColorLight" aria-controls="navbarColorLight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse col-lg-7" id="navbarColorLight">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-info" href="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/index.php" data-abc="true">Home <span class="sr-only">(current)</span></a>
                </li> <!-- active becomes white -->

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/video.php">SongDetail</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/profile.php">UserProfile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $url[3] == 'pages' ? '.' : './pages'; ?>/contact.php">Contact</a>
                </li>

                <li class="nav-item w-50">
                    <a class="p-0" href="">
                        <img src="<?php echo $url[3] == 'pages' ? '..' : '.'; ?>/images/Moosic_T2.1.png" class="w-25">
                    </a>
                </li>
            </ul>
        </div>

        <div class="d-flex justify-content-between">
           <!-- Search form -->
            <form class="form-inline form-sm active-cyan-2 mr-4">
                <input class="form-control form-control-sm mr-2 w-75" type="text" placeholder="Search"
                aria-label="Search">
                <i class="fas fa-search text-danger fa-1x" aria-hidden="true"></i>
            </form>

            <div class="mr-3 pt-1">
                <!-- Trigger/Open The Login Modal -->
                <a id="loginBtn" class="text-info text-14" href=""><i class="fa fa-user fa-1x" aria-hidden="true"></i>&nbsp; Sign in</a>
            </div>

            <div class="pt-1">
                <!-- Trigger/Open The Registration Modal -->
                <a id="registrationBtn" class="text-white-50 text-14" href=""><i class="fa fa-user-plus fa-1x" aria-hidden="true"></i>&nbsp; Sign up</a>
            </div>

            <!-- if connected -->
            <!-- <div class="hello text-light">Hello <span class="" id="username">Nickname</span>!</div> -->
            <!-- <div class="disconnection"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Sign out</div> -->
        </div>
    </nav>

    <!-- Registration form Modal window -->
    <div id="registrationFormModal" class="my-modal">
        <div class="my-modal-content">
            <div class="my-modal-header d-flex p-0">
                <h4 class="text-secondary flex-fill pt-3">Please enter your nickname</h4>
                <span class="close-btn text-secondary flex-fill col-1">&times;</span>
            </div>

            <div class="my-modal-body">
                <form action="" method="post" id="nicknameForm">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nickname" placeholder="Enter nickname">
                    </div>

                    <button type="button" id="submitNickname" class="btn btn-info" onclick="setNickname(document.getElementById('nickname').value)">Okay, got it!</button>
                </form>
            </div>
        </div>
    </div>
</header>