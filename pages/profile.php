<?php
include('../helpers/variables.php');
include('../helpers/functions.php');
include('../helpers/session_messages.php');

$profile = null;

// get the profile of the user
if (isset($_GET["pseudo"])) {
	$profile = getUserByPseudo($conn, $_GET["pseudo"]);
	$profileComments = fetchAllCommentsByUser($conn, $profile['user_id']);
	$profileVideos = fetchAllSongsByUser($conn,$profile['user_id']);
}

// Get the input values in order to reinsert them in the form
$profile_last_name = isset($profile) && isset($profile['last_name']) ? $profile['last_name'] : '';
$profile_first_name = isset($profile) && isset($profile['first_name']) ? $profile['first_name'] : '';
$profile_pseudo = isset($profile) && isset($profile['pseudo']) ? $profile['pseudo'] : '';
$profile_email = isset($profile) && isset($profile['email']) ? $profile['email'] : '';
$profile_birthday = isset($profile) && isset($profile['birthday']) ? $profile['birthday'] : '';
$profile_description = isset($profile) && isset($profile['description']) ? $profile['description'] : '';

$profile_password = isset($profile['password']) ? $profile['password'] : '';
$profile_password_confirm = isset($profile['password_confirm']) ? $profile['password_confirm'] : '';

// Handle errors
$profile_registerErrors = isset($_SESSION['registerErrors']) ? $_SESSION['registerErrors'] : [];
$profile_last_name_error = isset($registerErrors) && isset($registerErrors['last_name']) ? $registerErrors['last_name'] : "";
$profile_first_name_error = isset($registerErrors) && isset($registerErrors['first_name']) ? $registerErrors['first_name'] : "";
$profile_pseudo_error = isset($registerErrors) && isset($registerErrors['pseudo']) ? $registerErrors['pseudo'] : "";
$profile_email_error = isset($registerErrors) && isset($registerErrors['email']) ? $registerErrors['email'] : "";
$profile_password_error = isset($registerErrors) && isset($registerErrors['password']) ? $registerErrors['password'] : "";
$profile_password_confirm_error = isset($registerErrors) && isset($registerErrors['password_confirm']) ? $registerErrors['password_confirm'] : "";
$profile_description_error = '';
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="profile" class="container-fluid text-light p-0">
	<div class="bg-opacity2 p-md-5">

	    <div class="d-flex px-5">
	  		<div class="col-sm-3 pr-5" id="left_side">
				<div class="text-center">
					<h3><span class="text-danger text-capitalize"><?php echo $profile['pseudo']?></span></h3>
				</div>
	  			<img alt="<?php echo $profile['pseudo']?>" class="img-fluid w-100 rounded-circle border border-info" src="<?php echo $profile['photo'] ? $profile['photo'] : '../images/avatar_cat.png'; ?>">
		        
				<?php if ($profile['user_id'] === $user['user_id']) { ?>
					<h6 class="mt-3 text-info text-14">Upload a different photo...</h6>

					<div class="custom-file">
						<input type="file" class="custom-file-input">
						<label class="custom-file-label" for="customFileLang">Choose file</label>
					</div>
				<?php }; ?>

			</div>

    		<div class="col-sm-9 pl-5" id="right_side">
    			<!-- Nav tabs -->
		        <nav class="">
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<?php if ($profile['user_id'] === $user['user_id']){ ?>
							<a class="nav-item nav-link text-info active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true">Personal data</a>

							<a class="nav-item nav-link text-info" id="nav-changePassword-tab" data-toggle="tab" href="#nav-changePassword" role="tab" aria-controls="nav-changePassword" aria-selected="false">Change password</a>
						<?php } ?>
						

						<a class="nav-item nav-link text-info <?php if ($profile['user_id'] != $user['user_id']){ ?> active <?php }; ?>" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="false">Comments</a>

						<a class="nav-item nav-link text-info" id="nav-songs-tab" data-toggle="tab" href="#nav-songs" role="tab" aria-controls="nav-songs" aria-selected="false">Songs</a>
					</div>
		        </nav>
		    
		        <!-- Tab panes -->
		        <div class="tab-content bg-trans py-4 px-5 rounded-bottom">
					<?php if ($profile['user_id'] === $user['user_id']){ ?>  
						<div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">

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
										<label class="control-label" for="profile_last_name">Last name</label>
										<input type="text" name="profile_last_name" value="<?php echo $profile_last_name; ?>" class="form-control <?php echo $profile_last_name_error ? 'border border-danger' : ''; ?>">
										<small class="text-danger"><?php echo $profile_last_name_error; ?></small>
									</div>
								</div>

								<div class="d-flex justify-content-between">
									<!-- Pseudo -->
									<div class="form-group flex-fill">
										<label class="control-label" for="profile_pseudo">Pseudo</label>
										<input type="text" name="profile_pseudo" value="<?php echo $profile_pseudo; ?>" class="form-control <?php echo $profile_pseudo_error ? 'border border-danger' : ''; ?>">
										<small class="text-danger"><?php echo $profile_pseudo_error; ?></small>
									</div>

									<!-- E-mail -->
									<div class="form-group flex-fill col-4">
										<label class="control-label" for="profile_email">Email</label>
										<input type="email" name="profile_email" value="<?php echo $profile_email; ?>" class="form-control <?php echo $profile_email_error ? 'border border-danger' : ''; ?>">
										<small class="text-danger"><?php echo $profile_email_error; ?></small>
									</div>

									<!-- Birthday -->
									<div class="form-group flex-fill pr-0">
										<label class="form-label" for="profile_birthday">Birthday</label>

										<div class='input-group date' id='datepicker'>
											<input type='text' class="form-control" value="<?php echo $profile_birthday; ?>" placeholder="Choose date"/>

											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
								</div>

								<!-- Description -->
								<div class="form-group">
									<label class="control-label" for="profile_description">Description</label>
									<textarea name="profile_description" class="form-control <?php echo $profile_description_error ? 'border border-danger' : ''; ?>" rows="5"><?php echo $profile_description; ?></textarea>
									<small class="text-danger"><?php echo $profile_description_error; ?></small>
								</div>

								<div class="form-group col-12 text-right px-3">
									<button type="submit" class="btn btn-info" name="updateProfileBtn">Update</button>
								</div>
							</form>
						</div>

						<div class="tab-pane fade" id="nav-changePassword" role="tabpanel" aria-labelledby="nav-changePassword-tab">

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
					<?php } ?>

					
		            <div class="tab-pane fade <?php if ($profile['user_id'] != $user['user_id']){ ?> show active <?php }; ?>" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
						<div class="row">
							<?php if (count($profileComments) < 1) { ?>
								<p>No comment yet.</p>
							<?php } else {
								foreach ($profileComments as $comment) { ?>
									
									<?php $song = fetchOneSong($conn, $comment['song_id']);?>

									<div class="col-12">
										<div class="card col-4 mb-3 mr-3 shadow float-left text-dark">
											<div class='text-truncate'>
												<img width="100%" height="100" style="object-fit: cover;" src="https://img.youtube.com/vi/<?php echo $song['source']?>/mqdefault.jpg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></img>
												<p><?php echo $song['artist_name'].": ". $song['title']?></p>
											</div>
											<div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>)"></div>
										</div>

										<div class="ml-3">
											<h5>"<?php echo $comment['text']; ?>"</h5>
											<p class="text-light">Posted on <?php echo $comment['updated_at']; ?></p>
										</div>
									</div>
								<?php } 
							}?>
						</div>
		            </div>

		            <div class="tab-pane fade" id="nav-songs" role="tabpanel" aria-labelledby="nav-songs-tab">
						<div class="row justify-content-center">
							<?php foreach ($profileVideos as $song) { ?>
								<div class="card col-12 col-sm-3 m-1 shadow">
									<div class="text-truncate text-dark">
										<img width="100%" height="100" style="object-fit: cover;" src="https://img.youtube.com/vi/<?php echo $song['source']?>/mqdefault.jpg"></img>
										<p class='mb-0'><?php echo $song['artist_name'].": "?></p>
										<p class='mb-0'><?php echo $song['title']?></p>
										<?php $category = fetchCategoryByID($conn,$song['category_id']);?>
										<p>Category: <?php echo $category['name']?></p>
									</div>
									<div class="card-img-overlay myLink" onclick="move(<?php echo $song['id']?>)"></div>
								</div>
							<?php } ?>
						</div>
		            </div>
		        </div>    			
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

        $('#datepicker').datepicker({
	        weekStart: 1,
	        format: "dd/mm/yyyy",
	        // daysOfWeekHighlighted: "6,0",
	        autoclose: true,
	        todayHighlight: true,
	    });

	    // $('#datepicker').datepicker("setDate", new Date());
	});
</script>