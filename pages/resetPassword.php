<?php
include('../helpers/variables.php');
include('../helpers/session_messages.php');

// Handle errors by type
$forgotErrors = isset($_SESSION['forgotErrors']) ? $_SESSION['forgotErrors'] : [];

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
        <?php if ($forgotErrors) { ?>
            <div class="alert alert-danger"><?php echo $forgotErrors['error']; ?></div>
        <?php } ?>

        <form action="<?php echo $root; ?>/controllers/sendMailReset.php" method="POST" id="sendMailResetForm">
            <div class="form-group">
                <label for="email">Your email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="text-center">
                <button id="forgotButton" name="forgotBtn" type="submit" class="btn btn-primary m-auto btn-submit-login">Reset Password</button>
            </div>
        </form>
    </div>
</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<script type="text/javascript">
    var success_message = "<?php echo $success_message; ?>";
   
    function resetForm(formId) {
        // console.log(formId);
        $("#"+formId+" input[type=text], #"+formId+" textarea").val("");
    }
    
    if (success_message != '') {
        toastr.info(success_message);
        resetForm('contactForm');
    }
</script>