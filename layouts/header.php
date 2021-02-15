<?php

// Get the input values in order to reinsert them in the form
$login_password = isset($_SESSION['loginValues']['password']) ? $_SESSION['loginValues']['password'] : '';
$login_email = isset($_SESSION['loginValues']['email']) ? $_SESSION['loginValues']['email'] : '';

$last_name = isset($_SESSION['registerValues']['last_name']) ? $_SESSION['registerValues']['last_name'] : '';
$first_name = isset($_SESSION['registerValues']['first_name']) ? $_SESSION['registerValues']['first_name'] : '';
$pseudo = isset($_SESSION['registerValues']['pseudo']) ? $_SESSION['registerValues']['pseudo'] : '';
$email = isset($_SESSION['registerValues']['email']) ? $_SESSION['registerValues']['email'] : '';
$password = isset($_SESSION['registerValues']['password']) ? $_SESSION['registerValues']['password'] : '';
$password_confirm = isset($_SESSION['registerValues']['password_confirm']) ? $_SESSION['registerValues']['password_confirm'] : '';

/*$song_title = isset($_SESSION['song_title']) ? $_SESSION['song_title'] : '';
$song_artist = isset($_SESSION['song_artist']) ? $_SESSION['song_artist'] : '';
$song_category = isset($_SESSION['song_category']) ? $_SESSION['song_category'] : '';
$song_url = isset($_SESSION['song_url']) ? $_SESSION['song_url'] : '';
$song_album = isset($_SESSION['song_album']) ? $_SESSION['song_album'] : '';
$song_date = isset($_SESSION['song_date']) ? $_SESSION['song_date'] : '';
$song_album_image = isset($_SESSION['song_album_image']) ? $_SESSION['song_album_image'] : '';
$song_description = isset($_SESSION['song_description']) ? $_SESSION['song_description'] : '';*/

// Handle errors by type
$loginErrors = isset($_SESSION['loginErrors']) ? $_SESSION['loginErrors'] : [];
$login_password_error = count($loginErrors) > 0 && isset($loginErrors['password']) ? $loginErrors['password'] : "";
$login_email_error = count($loginErrors) > 0 && isset($loginErrors['email']) ? $loginErrors['email'] : "";
$credentials_error = count($loginErrors) > 0 && isset($loginErrors['credentials']) ? $loginErrors['credentials'] : "";

$registerErrors = isset($_SESSION['registerErrors']) ? $_SESSION['registerErrors'] : [];
$last_name_error = isset($registerErrors) && isset($registerErrors['last_name']) ? $registerErrors['last_name'] : "";
$first_name_error = isset($registerErrors) && isset($registerErrors['first_name']) ? $registerErrors['first_name'] : "";
$pseudo_error = isset($registerErrors) && isset($registerErrors['pseudo']) ? $registerErrors['pseudo'] : "";
$email_error = isset($registerErrors) && isset($registerErrors['email']) ? $registerErrors['email'] : "";
$password_error = isset($registerErrors) && isset($registerErrors['password']) ? $registerErrors['password'] : "";
$password_confirm_error = isset($registerErrors) && isset($registerErrors['password_confirm']) ? $registerErrors['password_confirm'] : "";

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>

<header id="myheader" class="text-center text-info">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="d-flex justify-content-center col-md-1 col-2">
            <a class="navbar-brand text-info p-0 m-0" href="<?php echo $root; ?>/index.php">
                <img src="<?php echo $root; ?>/images/Moosic_T2.1.png" class="img-fluid px-lg-2 w-lg-50 w-sm-75"></a>
            </a>
        </div>

        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navbarColorLight" aria-controls="navbarColorLight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse col-lg-4 col-md-4" id="navbarColorLight">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-info" href="<?php echo $root; ?>/index.php" data-abc="true">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $pages_root; ?>/about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $pages_root; ?>/contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <div class="d-flex justify-content-end col-lg-7 col-xs-12">
           <!-- Search form -->
            <form action="<?php echo $root; ?>/pages/search.php" method="POST" class="form-inline form-sm active-cyan-2 mr-3 w-lg-50 d-flex col-sm-8">
                <input class="form-control form-control-sm mr-2 w-75" type="text" placeholder="Search" aria-label="Search" name="search" required>
                <button type="submit" class="btn btn-outline-dark"><i class="fas fa-search text-danger fa-1x" aria-hidden="true"></i></button>
            </form>

            <?php if ($user && $user['is_connected']) { ?> <!-- if connected -->

                <div class="mr-3 pt-1">
                    <a class="text-light text-14" href="<?php echo $pages_root; ?>/profile.php?pseudo=<?php echo $user['pseudo']?>">Hello <span class="text-capitalize"><?php echo $user['pseudo']; ?></span>!</a>
                </div>

                <div class="pt-1">
                    <a class="text-info text-14" href="<?php echo $root; ?>/controllers/logout.php"><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i>&nbsp; <span class="d-lg-inline-block d-none">Sign out</span></a>
                </div>

            <?php } else { ?> <!-- if not connected -->

                <div class="mr-3 pt-1">
                    <!-- Trigger/Open The Login Modal -->
                    <a class="text-info text-14" href="" data-toggle="modal" data-target="#loginFormModal"><i class="fa fa-user fa-1x" aria-hidden="true"></i>&nbsp; <span class="d-lg-inline-block d-none">Sign in</span></a>
                </div>

                <div class="pt-1">
                    <!-- Trigger/Open The Registration Modal -->
                    <a class="text-white-50 text-14" href="" data-toggle="modal" data-target="#registrationFormModal"><i class="fa fa-user-plus fa-1x" aria-hidden="true"></i>&nbsp; <span class="d-lg-inline-block d-none">Sign up</span></a>
                </div>

            <?php } ?>
        </div>
    </nav>

    <!-- Registration form Modal window -->
    <div id="registrationFormModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registration form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="<?php echo $root; ?>/controllers/register.php" method="post" id="registrationForm" class="text-dark pt-3 px-5 text-left form-horizontal">
                        <input type="hidden" name="current_page" value="<?php echo $current_page; ?>">

                        <div class="d-flex justify-content-between">
                            <div class="form-group flex-fill">
                                <!-- First name -->
                                <label class="control-label" for="first_name">First name</label>
                                <input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control <?php echo $first_name_error ? 'border border-danger' : ''; ?>">
                                <small class="text-danger"><?php echo $first_name_error; ?></small>
                            </div>
                        
                            <div class="form-group flex-fill col-6 pr-0">
                                <!-- Last name -->
                                <label class="control-label" for="last_name">Last name*</label>
                                <input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control <?php echo $last_name_error ? 'border border-danger' : ''; ?>">
                                <small class="text-danger"><?php echo $last_name_error; ?></small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group flex-fill">
                                <!-- Pseudo -->
                                <label class="control-label" for="pseudo">Pseudo*</label>
                                <input type="text" name="pseudo" value="<?php echo $pseudo; ?>" class="form-control <?php echo $pseudo_error ? 'border border-danger' : ''; ?>">
                                <small class="text-danger"><?php echo $pseudo_error; ?></small>
                            </div>

                            <div class="form-group flex-fill col-6 pr-0">
                                <!-- E-mail -->
                                <label class="control-label" for="email">Email*</label>
                                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control <?php echo $email_error ? 'border border-danger' : ''; ?>">
                                <small class="text-danger"><?php echo $email_error; ?></small>
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-between">
                            <div class="form-group flex-fill">
                                <!-- Password-->
                                <label class="control-label" for="password">Password*</label>
                                <input type="password" name="password" value="<?php echo $password; ?>" class="form-control <?php echo $password_error ? 'border border-danger' : ''; ?>">
                                <small class="text-danger"><?php echo $password_error; ?></small>
                            </div>

                            <div class="form-group flex-fill col-6 pr-0">
                                <!-- Confirm Password -->
                                <label class="control-label" for="password_confirm">Password confirm*</label>
                                <input type="password" name="password_confirm" value="<?php echo $password_confirm; ?>" class="form-control <?php echo $password_confirm_error ? 'border border-danger' : ''; ?>">
                                <small class="text-danger"><?php echo $password_confirm_error; ?></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox"> Remember me</label>
                            </div>
                        </div>
                        
                        <div class="form-group col-12 text-right px-3">
                            <button type="submit" class="btn btn-info" name="registerBtn">Register</button>
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
                    <form action="<?php echo $root; ?>/controllers/login.php" method="post" id="loginForm" class="text-dark pt-3 px-5 text-left form-horizontal">
                        <input type="hidden" name="current_page" value="<?php echo $current_page; ?>">

                        <div class="form-group">
                            <!-- E-mail -->
                            <label class="control-label" for="login_email">E-mail*</label>
                            <input type="email" id="login_email" name="login_email" value="<?php echo $login_email; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <!-- Password -->
                            <label class="control-label" for="login_password">Password*</label>
                            <input type="password" id="login_password" name="login_password" value="<?php echo $login_password; ?>" class="form-control">
                        </div>

                        <?php if ($credentials_error) { ?>
                            <div class="alert alert-danger"><?php echo $credentials_error; ?></div>
                        <?php } ?>
                        
                        <div class="form-group col-12 text-right px-3">
                            <a href="<?php echo $pages_root; ?>/resetPassword.php" class="mr-5">forgot password?</a>
                            <button type="submit" class="btn btn-info" name="loginBtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>