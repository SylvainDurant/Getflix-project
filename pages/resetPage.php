<?php
include('../helpers/variables.php');
include('../helpers/functions.php');
include('../helpers/session_messages.php');

// Handle errors by type
$resetErrors = isset($_SESSION['resetErrors']) ? $_SESSION['resetErrors'] : '';

// Check authorizations
if (isset($_GET["token"])) {
    $user = getUserByToken($conn, $_GET["token"]);
    if( !$user ) {
        $_SESSION['forgotErrors']['error'] = "This link is invalid or expired";

        // redirect & send errors to the previous page
        header('location: ../pages/resetPassword.php');
    } else {
        if (time() > $user['token_expire']) {
            $_SESSION['forgotErrors']['error'] = "This link is invalid or expired";

            // redirect & send errors to the previous page
            header('location: ../pages/resetPassword.php');
        }
    }
} else {
    $_SESSION['forgotErrors'] = "This link is invalid or expired";

    // redirect & send errors to the previous page
    header('location: ../pages/resetPassword.php');
}
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="contact" class="container d-flex flex-column justify-content-center p-5">
    <div class="col-lg-5 col-sm-8 mx-auto text-center mb-4">
        <h2 class="mb-3 text-info">Password Reset</h2>
        <hr class="bg-info">
    </div>


    <div class="col-8 mx-auto">

        <?php if ($resetErrors) { ?>
            <div class="alert alert-danger"><?php echo $resetErrors['error']; ?></div>
        <?php } ?>

        <form action="../controllers/resetPassword.php" method="POST" id="resetForm">
            <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
            <div class="d-flex justify-content-between">
                <div class="form-group flex-fill">
                    <!-- Password-->
                    <label class="control-label" for="password">Password*</label>
                    <input type="password" name="password" value="<?php echo $password; ?>" class="form-control <?php echo $password_error ? 'border border-danger' : ''; ?>" required>
                    <small class="text-danger"><?php echo $password_error; ?></small>
                </div>

                <div class="form-group flex-fill col-6 pr-0">
                    <!-- Confirm Password -->
                    <label class="control-label" for="password_confirm">Password confirm*</label>
                    <input type="password" name="password_confirm" value="<?php echo $password_confirm; ?>" class="form-control <?php echo $password_confirm_error ? 'border border-danger' : ''; ?>" required>
                    <small class="text-danger"><?php echo $password_confirm_error; ?></small>
                </div>
            </div>
            <div class="form-group text-right p-2">
                <button type="submit" name='resetPasswordBtn' class="btn btn-info ">Reset Password</button>
            </div>
        </form>
    </div>
</section>










<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->