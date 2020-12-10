<?php
include('../database/functions.php');
session_start(); // Start a session
//var_dump($_SESSION['contactErrors']); 
//var_dump($_SESSION['contact']);

// Handle errors by type
$contactErrors = isset($_SESSION['contactErrors']) ? $_SESSION['contactErrors'] : [];
$contact_firstName_error = count($contactErrors) > 0 && isset($contactErrors['firstname']) ? $contactErrors['firstname'] : "";
$contact_lastName_error = count($contactErrors) > 0 && isset($contactErrors['lastname']) ? $contactErrors['lastname'] : "";
$contact_email_error = count($contactErrors) > 0 && isset($contactErrors['emailname']) ? $contactErrors['emailname'] : "";
$contact_message_error = count($contactErrors) > 0 && isset($contactErrors['messagecontact']) ? $contactErrors['messagecontact'] : "";

// Get the input values in order to reinsert them in the form
$firstnameValue = isset($_SESSION['contact']['firstnamecontact']) ? $_SESSION['contact']['firstnamecontact'] : '';
$lastnameValue = isset($_SESSION['contact']['lastnamecontact']) ? $_SESSION['contact']['lastnamecontact'] : '';
$emailValue = isset($_SESSION['contact']['emailname']) ? $_SESSION['contact']['emailname'] : '';
$messageValue = isset($_SESSION['contact']['message']) ? $_SESSION['contact']['message'] : '';

//$firstnamecontact = isset($_SESSION['firstnamecontact']) ? $_SESSION['firstnamecontact'] : '';
//$lastnamecontact = isset($_SESSION['firstnamecontact']) ? $_SESSION['firstnamecontact'] : '';

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


<section id="content" class="border border-info p-5">

    <form action="../controllers/contactUser.php" method="POST">
        <div class="form-group">
            <label for="firstnamecontact">First name</label>
            <input type="text" name="firstnamecontact" class="form-control" value="<?php echo $firstnameValue; ?>" >
            <small class="text-danger"><?php echo $contact_firstName_error ; ?></small>
        </div>


        <div class="form-group">
            <label for="lastnamecontact">Last name</label>
            <input type="text" name="lastnamecontact" class="form-control" value="<?php echo $lastnameValue; ?>" >
            <small class="text-danger"><?php echo $contact_lastName_error; ?></small>
        </div>


        <div class="form-group">
            <label for="emailcontact">Email address</label>
            <input type="email" name="emailcontact" class="form-control" value="<?php echo $emailValue; ?>" >
            <small class="text-danger"><?php echo $contact_email_error; ?></small>
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Message</span>
            </div>
            <textarea class="form-control" name="messagecontact" aria-label="With textarea"><?php echo $messageValue; ?>  </textarea>
            <small class="text-danger"><?php echo $contact_message_error; ?></small>
        </div>
        <div class="form-group text-right p-2">
            <button type="submit" name='buttonContact' class="btn btn-info ">Send</button>
        </div>
    </form>


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