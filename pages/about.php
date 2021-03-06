<?php
include('../helpers/variables.php');
include('../helpers/session_messages.php');
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="about" class="container-fluid p-0">
	<div id="header-about" class="">
		<div class="bg-opacity text-center p-md-5">
		    <h3 class="display-4 text-light pt-5">About <span class="text-danger">Moosic</span></h3>

		    <p class="lead text-light col-8 mx-auto">We are Moosic, an enthusiatic team of 3 web developers. We all started a couple of months ago to create websites and we have decided together to bring that knowledge to you.</p>
		    <p class="lead text-light col-8 mx-auto">Our team project is a music video platform. We developed this website using tho following technologies: HTML, CSS, JavaScript, PHP and MySql.</p>

		    <div class="mt-5">
		    	<a class="" href="https://github.com/SylvainDurant/Moosic">
		    		<i class="fa fa-github text-info fa-3x pb-4"></i>
		    	</a>
		    </div>
	    </div>
	</div>

    <div id="team" class="container-fluid bg-dark text-center">
    	<div class="col-lg-6 col-sm-8 mx-auto p-5">
			<h2 class="mb-3 text-info">The Team</h2>
	        <hr class="bg-info">
      	</div>

		<div class="container mx-auto row text-light pb-5 mt-lg-4">
			<div class="col-lg-4 px-5 mb-5">
				<a href="https://github.com/Shticrina" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars0.githubusercontent.com/u/36960315?s=400&u=44b7d11f5c90c9e8ea63223dbc3c77f870253590&v=4" alt="Cristina D">
				</a>

				<h3 class="text-danger text-nothing-you-can-do">Cristina D.</h3>
				<p class="font-weight-light mb-0">"Be yourself. Everyone else is already taken..."</p>
			</div>

			<div class="col-lg-4 px-5 mb-5">
				<a href="https://github.com/SebastienFirouzfar" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars0.githubusercontent.com/u/47642733?s=400&v=4" alt="Sébastien F">
				</a>

				<h3 class="text-danger text-nothing-you-can-do">Sébastien F.</h3>
				<p class="font-weight-light mb-0">"A journey of a thousand miles begins with a single step..."</p>
			</div>

			<div class="col-lg-4 px-5 mb-5">
				<a href="https://github.com/SylvainDurant" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars2.githubusercontent.com/u/71309860?s=400&u=73fbae51d21fba10608550d3cc4f3b087b6abdbd&v=4" alt="Sylvain D">
				</a>

				<h3 class="text-danger text-nothing-you-can-do">Sylvain D.</h3>
				<p class="font-weight-light mb-0">"if metal is the devil's work, then Satan has good musical taste!"</p>
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
	});
</script>