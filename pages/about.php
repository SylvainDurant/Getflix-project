<?php
include('../database/db.php');

session_start(); // Start a session

// var_dump($url);
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="about" class="container-fluid p-0">
	<div id="header-about" class="">
		<div class="bg-opacity text-center p-5">
		    <h3 class="display-4 text-light mt-5">About <span class="text-danger">Moosic</span></h3>

		    <p class="lead text-light col-8 mx-auto">We are Moosic, an enthusiatic team with 4 web developers. We all started a couple of months ago to create websites and we have decided together to bring that knowledge to you.</p>
		    <p class="lead text-light col-8 mx-auto">This website is a team project ....</p>

		    <div class="mt-5">
		    	<a class="" href="https://github.com/SylvainDurant/Getflix-project">
		    		<i class="fa fa-github text-info fa-3x"></i>
		    	</a>
		    </div>
	    </div>
	</div>

    <div id="team" class="container-fluid bg-dark text-center">
    	<div class="col-8 mx-auto p-5">
			<h2 class="mb-3 text-info">The Team</h2>
	        <hr class="bg-info">
      	</div>

		<div class="container mx-auto row text-light pb-5 mt-4">
			<div class="col-lg-3 px-5 mb-5">
				<a href="https://github.com/Shticrina" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars0.githubusercontent.com/u/36960315?s=400&u=44b7d11f5c90c9e8ea63223dbc3c77f870253590&v=4" alt="Cristina D">
				</a>

				<h3 class="text-danger text-nothing-you-can-do">Cristina D.</h3>
				<p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
			</div>

			<div class="col-lg-3 px-5 mb-5">
				<a href="https://github.com/SebastienFirouzfar" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars0.githubusercontent.com/u/47642733?s=400&v=4" alt="Sébastien F">
				</a>

				<h3 class="text-danger text-nothing-you-can-do">Sébastien F.</h3>
				<p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
			</div>

			<div class="col-lg-3 px-5 mb-5">
				<a href="https://github.com/SylvainDurant" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars2.githubusercontent.com/u/71309860?s=400&u=73fbae51d21fba10608550d3cc4f3b087b6abdbd&v=4" alt="Sylvain D">
				</a>

				<h3 class="text-info text-nothing-you-can-do">Sylvain D.</h3>
				<p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
			</div>

			<div class="col-lg-3 px-5 mb-5">
				<a href="https://github.com/ryadouelhadj" class="profile-img">
					<img class="img-fluid rounded-circle mb-3 border border-info" src="https://avatars3.githubusercontent.com/u/70713584?s=400&v=4" alt="Ryad O">
				</a>

				<h3 class="text-info text-nothing-you-can-do">Ryad O.</h3>
				<p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
			</div>
		</div>
    </div>
</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<?php session_unset(); // Close the session ?>