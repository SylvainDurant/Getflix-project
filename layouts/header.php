<?php

// Get the input values in order to reinsert them in the form
$login_password = isset($_SESSION['login_password']) ? $_SESSION['login_password'] : '';
$login_email = isset($_SESSION['login_email']) ? $_SESSION['login_email'] : '';

$last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
$pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
$password_confirm = isset($_SESSION['password_confirm']) ? $_SESSION['password_confirm'] : '';

// Handle errors by type
$loginErrors = isset($_SESSION['loginErrors']) ? $_SESSION['loginErrors'] : [];
$login_password_error = count($loginErrors) > 0 && isset($loginErrors['login_password']) ? $loginErrors['login_password'] : "";
$login_email_error = count($loginErrors) > 0 && isset($loginErrors['login_email']) ? $loginErrors['login_email'] : "";
$credentials_error = count($loginErrors) > 0 && isset($loginErrors['credentials']) ? $loginErrors['credentials'] : "";

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$last_name_error = isset($errors) && isset($errors['last_name']) ? $errors['last_name'] : "";
$first_name_error = isset($errors) && isset($errors['first_name']) ? $errors['first_name'] : "";
$pseudo_error = isset($errors) && isset($errors['pseudo']) ? $errors['pseudo'] : "";
$email_error = isset($errors) && isset($errors['email']) ? $errors['email'] : "";
$password_error = isset($errors) && isset($errors['password']) ? $errors['password'] : "";
$password_confirm_error = isset($errors) && isset($errors['password_confirm']) ? $errors['password_confirm'] : "";

// Get current user, if connected
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// var_dump($_SESSION);
?>

<header id="myheader" class="py-1 text-center text-info">
    <!-- Navbar -->
	<nav class="navbar navbar-expand-md navbar-dark">
        <div class="d-flex justify-content-center col-lg-1">
            <a class="navbar-brand text-info p-0 m-0" href="<?php echo $root; ?>/index.php">
                <img src="<?php echo $root; ?>/images/Moosic_T2.1.png" class="w-75"></a>
            </a>
        </div>

        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navbarColorLight" aria-controls="navbarColorLight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse col-lg-6" id="navbarColorLight">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-info" href="<?php echo $root; ?>/index.php" data-abc="true">Home <span class="sr-only">(current)</span></a>
                </li> <!-- active becomes white -->

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $pages_root; ?>/about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-info" href="<?php echo $pages_root; ?>/contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <div class="d-flex justify-content-end col-lg-5">
           <!-- Search form -->
            <form class="form-inline form-sm active-cyan-2 mr-3">
                <input class="form-control form-control-sm mr-2 w-75" type="text" placeholder="Search"
                aria-label="Search">
                <i class="fas fa-search text-danger fa-1x" aria-hidden="true"></i>
            </form>

            <?php if ($user && $user['is_connected']) { ?> <!-- if connected -->

                <div class="mr-3 pt-1">
                    <a class="text-light text-14" href="">Hello <span class=""><?php echo $user['pseudo']; ?></span>!</a>
                </div>

                <div class="pt-1">
                    <a class="text-info text-14" href="<?php echo $root; ?>/controllers/logout.php"><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i>&nbsp; Sign out</a>
                </div>

            <?php } else { ?> <!-- if not connected -->

                <div class="mr-3 pt-1">
                    <!-- Trigger/Open The Login Modal -->
                    <a class="text-info text-14" href="" data-toggle="modal" data-target="#loginFormModal"><i class="fa fa-user fa-1x" aria-hidden="true"></i>&nbsp; Sign in</a>
                </div>

                <div class="pt-1">
                    <!-- Trigger/Open The Registration Modal -->
                    <a class="text-white-50 text-14" href="" data-toggle="modal" data-target="#registrationFormModal"><i class="fa fa-user-plus fa-1x" aria-hidden="true"></i>&nbsp; Sign up</a>
                </div>

            <?php } ?>
        </div>
    </nav>

    <!-- Registration form Modal window -->
    <div id="registrationFormModal" class="modal fade <?php echo (count($errors) > 0) ? 'show d-block' : ''; ?>" role="dialog">
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
                                <label class="control-label" for="first_name">First name*</label>
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
                                <label class="control-label" for="pseudo">Pseudo</label>
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
                            <button type="submit" class="btn btn-success" name="registerBtn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login form Modal window -->
    <div id="loginFormModal" class="modal fade <?php echo (count($loginErrors) > 0) ? 'show d-block' : ''; ?>" role="dialog">
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
                            <label class="control-label" for="login_email">E-mail</label>
                            <input type="email" id="login_email" name="login_email" value="<?php echo $login_email; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <!-- Password -->
                            <label class="control-label" for="login_password">Password</label>
                            <input type="password" id="login_password" name="login_password" value="<?php echo $login_password; ?>" class="form-control">
                        </div>

                        <?php if ($credentials_error) { ?>
                            <div class="alert alert-danger"><?php echo $credentials_error; ?></div>
                        <?php } ?>
                        
                        <div class="form-group col-12 text-right px-3">
                            <button type="submit" class="btn btn-success" name="loginBtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>