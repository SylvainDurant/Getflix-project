<?php
include('../database/functions.php');
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
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="contact" class="container p-5">
    <div class="d-flex flex-column justify-content-center col-8 mx-auto">
        <h3 class="text-info mb-4">Contact us</h3>

        <form action="../controllers/contactUser.php" method="POST">
            <div class="form-group">
                <label for="firstnamecontact">Your name</label>
                <input type="text" name="firstnamecontact" class="form-control">
            </div>

            <div class="form-group">
                <label for="lastnamecontact">Your last name</label>
                <input type="text" name="lastnamecontact" class="form-control">
            </div>


            <div class="form-group">
                <label for="emailcontact">Your email address</label>
                <input type="email" name="emailcontact" class="form-control">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Message</span>
                </div>
                <textarea class="form-control" name="messagecontact" aria-label="With textarea"></textarea>
            </div>

            <div class="form-group text-right p-2">
                <button type="submit" name='buttonContact' class="btn btn-info ">Send</button>
            </div>
        </form>
    </div>
</section>

<?php include('../layouts/footer.php'); ?>
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