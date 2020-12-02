<?php
// session_start(); // Start a session
var_dump($_SESSION);
?>

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
                <a class="text-info text-14" href="" data-toggle="modal" data-target="#loginFormModal"><i class="fa fa-user fa-1x" aria-hidden="true"></i>&nbsp; Sign in</a>
            </div>

            <div class="pt-1">
                <!-- Trigger/Open The Registration Modal -->
                <a class="text-white-50 text-14" href="" data-toggle="modal" data-target="#registrationFormModal"><i class="fa fa-user-plus fa-1x" aria-hidden="true"></i>&nbsp; Sign up</a>
            </div>

            <!-- if connected -->
            <!-- <div class="hello text-light">Hello <span class="" id="username">Nickname</span>!</div> -->
            <!-- <div class="disconnection"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Sign out</div> -->
        </div>
    </nav>

    <!-- Registration form Modal window -->
    <div id="registrationFormModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registration form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="" method="post" id="registrationForm" class="text-dark pt-3 px-5 text-left form-horizontal">
                        <div class="form-group">
                            <!-- Last name -->
                            <label class="control-label" for="last_name">Last name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="" class="form-control border border-danger" required>
                        </div>

                        <div class="form-group">
                            <!-- First name -->
                            <label class="control-label" for="first_name">First name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="" class="form-control" required>
                        </div>
                    
                        <div class="form-group">
                            <!-- Pseudo -->
                            <label class="control-label" for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" name="pseudo" placeholder="" class="form-control">
                        </div>

                        <div class="form-group">
                            <!-- E-mail -->
                            <label class="control-label" for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="" class="form-control">
                        </div>
                    
                        <div class="form-group">
                            <!-- Password-->
                            <label class="control-label" for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="" class="form-control">
                        </div>

                        <div class="form-group">
                            <!-- Confirm Password -->
                            <label class="control-label" for="password_confirm">Password (Confirm)</label>
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control">
                        </div>

                        <div class="form-group">
                            <!-- Description -->
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control rounded-0" id="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox"> Remember me</label>
                            </div>
                        </div>
                        
                        <div class="form-group col-12 text-right px-3">
                            <button type="submit" class="btn btn-success" id="registerBtn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login form Modal window -->
    <div id="loginFormModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="" method="post" id="loginForm" class="text-dark pt-3 px-5 text-left form-horizontal">
                        <div class="form-group">
                            <!-- Pseudo -->
                            <label class="control-label" for="login_pseudo">Pseudo</label>
                            <input type="text" id="login_pseudo" name="login_pseudo" placeholder="" class="form-control">
                        </div>

                        <div class="form-group">
                            <!-- E-mail -->
                            <label class="control-label" for="login_email">E-mail</label>
                            <input type="email" id="login_email" name="login_email" placeholder="" class="form-control">
                        </div>
                        
                        <div class="form-group col-12 text-right px-3">
                            <button type="submit" class="btn btn-success" id="loginBtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">

    document.getElementById("registrationForm").addEventListener('submit', function (e) {
        e.preventDefault();

        // console.log(document.getElementById("last_name").value);
        let formData = new FormData(this);
        /*let formData = {
            last_name: document.getElementById("last_name").value,
            first_name: document.getElementById("first_name").value,
            email: document.getElementById("email").value,
            pseudo: document.getElementById("pseudo").value,
            password: document.getElementById("password").value
        };*/

        fetch("../controllers/registration.php", { 
                method: "POST", 
                // headers: { "Content-type": "application/json" },
                body: formData
                // body: JSON.stringify(formData),
            })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch(error => { console.error(error) });
    });

    document.getElementById("loginForm").addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        /*let formData = {
            pseudo: document.getElementById("pseudo").value,
            email: document.getElementById("email").value
        };*/

        fetch("../controllers/login.php", { 
                method: "POST", 
                body: formData
            })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch(error => { console.error(error) });
    });
</script>