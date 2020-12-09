<!-- notification message -->
<?php if (isset($_SESSION['success'])) : ?>
	<div class="d-flex justify-content-center bg-info pt-2" >
        <p class="text-light font-italic">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </p>
    </div>
<?php endif ?>