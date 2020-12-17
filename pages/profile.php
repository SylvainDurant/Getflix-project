<?php
include('../helpers/variables.php');
include('../helpers/session_messages.php');

// Get the input values in order to reinsert them in the form
$profile_last_name = isset($_SESSION['registerValues']['last_name']) ? $_SESSION['registerValues']['last_name'] : '';
$profile_first_name = isset($_SESSION['registerValues']['first_name']) ? $_SESSION['registerValues']['first_name'] : '';
$profile_pseudo = isset($_SESSION['registerValues']['pseudo']) ? $_SESSION['registerValues']['pseudo'] : '';
$profile_email = isset($_SESSION['registerValues']['email']) ? $_SESSION['registerValues']['email'] : '';
$profile_password = isset($_SESSION['registerValues']['password']) ? $_SESSION['registerValues']['password'] : '';
$profile_password_confirm = isset($_SESSION['registerValues']['password_confirm']) ? $_SESSION['registerValues']['password_confirm'] : '';

// Handle errors
$profile_registerErrors = isset($_SESSION['registerErrors']) ? $_SESSION['registerErrors'] : [];
$profile_last_name_error = isset($registerErrors) && isset($registerErrors['last_name']) ? $registerErrors['last_name'] : "";
$profile_first_name_error = isset($registerErrors) && isset($registerErrors['first_name']) ? $registerErrors['first_name'] : "";
$profile_pseudo_error = isset($registerErrors) && isset($registerErrors['pseudo']) ? $registerErrors['pseudo'] : "";
$profile_email_error = isset($registerErrors) && isset($registerErrors['email']) ? $registerErrors['email'] : "";
$profile_password_error = isset($registerErrors) && isset($registerErrors['password']) ? $registerErrors['password'] : "";
$profile_password_confirm_error = isset($registerErrors) && isset($registerErrors['password_confirm']) ? $registerErrors['password_confirm'] : "";
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="profile" class="container-fluid text-light p-0">
	<div class="bg-opacity p-md-5">
	    <div class="d-flex px-5">
	  		<div class="col-sm-10">
	  			<h3>Hi, <span class="text-danger text-capitalize">username</span> !</h3>
	  		</div>

	    	<div class="col-sm-2 text-right">
	    		<!-- ... -->
	    	</div>
	    </div>

	    <div class="d-flex px-5">
	  		<div class="col-sm-3 pr-5" id="left_side">
	  			<img alt="cat default avatar" class="img-fluid w-100 rounded-circle border border-info" src="../images/avatar_cat.png">
		        <h6 class="mt-3 text-info text-14">Upload a different photo...</h6>

		        <div class="custom-file">
				  	<input type="file" class="custom-file-input">
				  	<label class="custom-file-label" for="customFileLang">Choose file</label>
				</div>
			</div>

    		<div class="col-sm-9 pl-5" id="right_side">
    			<h3 class="mb-3 text-info">Personal informations</h3>
        		<hr class="bg-info w-50 ml-0">

             	<form class="pt-3" action="##" method="post" id="profileForm">
					<div class="d-flex justify-content-between">
                        <div class="form-group flex-fill">
                            <!-- First name -->
                            <label class="control-label" for="profile_first_name">First name</label>
                            <input type="text" name="profile_first_name" value="<?php echo $profile_first_name; ?>" class="form-control <?php echo $profile_first_name_error ? 'border border-danger' : ''; ?>">
                            <small class="text-danger"><?php echo $profile_first_name_error; ?></small>
                        </div>
                    
                        <div class="form-group flex-fill col-6 pr-0">
                            <!-- Last name -->
                            <label class="control-label" for="profile_last_name">Last name*</label>
                            <input type="text" name="profile_last_name" value="<?php echo $profile_last_name; ?>" class="form-control <?php echo $profile_last_name_error ? 'border border-danger' : ''; ?>">
                            <small class="text-danger"><?php echo $profile_last_name_error; ?></small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group flex-fill">
                            <!-- Pseudo -->
                            <label class="control-label" for="profile_pseudo">Pseudo*</label>
                            <input type="text" name="profile_pseudo" value="<?php echo $profile_pseudo; ?>" class="form-control <?php echo $profile_pseudo_error ? 'border border-danger' : ''; ?>">
                            <small class="text-danger"><?php echo $profile_pseudo_error; ?></small>
                        </div>

                        <div class="form-group flex-fill col-6 pr-0">
                            <!-- E-mail -->
                            <label class="control-label" for="profile_email">Email*</label>
                            <input type="email" name="profile_email" value="<?php echo $profile_email; ?>" class="form-control <?php echo $profile_email_error ? 'border border-danger' : ''; ?>">
                            <small class="text-danger"><?php echo $profile_email_error; ?></small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group flex-fill">
                            <!-- Birthday -->
                            <label class="control-label" for="profile_birthday">Birthday</label>
                            <input id="datepickerfrom" name="datepickerfrom" width="250" required />
                            <!-- <input type="text" name="profile_birthday" value="<?php echo $profile_pseudo; ?>" class="form-control <?php echo $profile_pseudo_error ? 'border border-danger' : ''; ?>"> -->
                            <small class="text-danger"><?php echo $profile_pseudo_error; ?></small>
                        </div>

                        <div class="form-group flex-fill col-6 pr-0">
                            <!-- Description -->
                            <label class="control-label" for="profile_description">Description</label>
                            <textarea name="profile_description" class="form-control <?php echo $profile_email_error ? 'border border-danger' : ''; ?>" rows="4"><?php echo $profile_email; ?></textarea>
                            <small class="text-danger"><?php echo $profile_email_error; ?></small>
                        </div>
                    </div>

                    <div class="form-group col-12 text-right px-3">
                        <button type="submit" class="btn btn-info" name="updateProfileBtn">Update</button>
                    </div>
                </form>

				<h3 class="mb-3 text-info">Changing password</h3>
        		<hr class="bg-info w-50 ml-0">

				<form method="POST" action="#" class="pt-3">
                    <div class="d-flex justify-content-between">
                        <div class="form-group flex-fill">
                            <!-- Password-->
                            <label class="control-label" for="profile_password">Password*</label>
                            <input type="password" name="profile_password" value="<?php echo $profile_password; ?>" class="form-control <?php echo $profile_password_error ? 'border border-danger' : ''; ?>">
                            <small class="text-danger"><?php echo $profile_password_error; ?></small>
                        </div>

                        <div class="form-group flex-fill col-6 pr-0">
                            <!-- Confirm Password -->
                            <label class="control-label" for="profile_password_confirm">Password confirm*</label>
                            <input type="password" name="profile_password_confirm" value="<?php echo $profile_password_confirm; ?>" class="form-control <?php echo $profile_password_confirm_error ? 'border border-danger' : ''; ?>">
                            <small class="text-danger"><?php echo $profile_password_confirm_error; ?></small>
                        </div>
                    </div>
                    
                    <div class="form-group col-12 text-right px-3">
                        <button type="submit" class="btn btn-info" name="updatePasswordBtn">Update</button>
                    </div>
              	</form>
        	</div>
        </div>
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

        /*$('#datepickerfrom').datepicker({
            uiLibrary: 'bootstrap4'
        });*/
	});
</script>