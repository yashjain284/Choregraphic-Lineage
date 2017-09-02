<?php
include 'path.php';
include 'menu.php';
include 'util.php';
?>


<html>
<head>

	<title>Personal Information</title>
	<link rel="stylesheet" href="css/intlTelInput.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/intlTelInput.js"></script>
	<script src="js/utils.js">"></script>
	<style type="text/css">
		.iti-flag {background-image: url("img/flags.png");}

		@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
			.iti-flag {background-image: url("img/flags@2x.png");}
		}
	</style>

</head>

<body>

	<form id="biography" class="biography" action="appointment_confirmation.php" method="post">
		<div class="row">
			<p><h3><strong>CONTRIBUTE YOUR LINEAGE BY PHONE</strong></h3></p>
		</div>
		<div class="row">
			<h5>Please fill out the form below to set a suitable time for you, when we can call you.</h5>
		</div>

		<div class = "row">
			<div class="medium-4 column">
				<label for="artist_first_name">First Name <small>Required</small>
					<input autocomplete="off" type="text" id="first_name" name="first_name" placeholder="First Name" required>
				</label>
			</div>
			<div class="medium-4 column">
				<label for="artist_last_name">Last Name <small>Required</small>
					<input autocomplete="off" type="text" id="last_name" name="last_name" placeholder="Last Name" required>
				</label>
			</div>
			<div class="medium-4 column">
				
			</div>
			<!-- FIRST NAME AND LAST NAME -->
		</div>
		<div class="row">
			<div class="medium-4 column">
				<label for="artist_email_address">Email Address <small>Required</small>
					<input autocomplete="off" type="email" id="email_address" name="email_address" placeholder="Email Address">
				</label>
			</div>
		</div>
		
		<div class="row">
			<div class="medium-10 columns">
				<label for="contact_number">Contact Number <small>Required</small><br>
					<input type="tel" name="contact_number" class="contact_number" id="contact_number" placeholder="Enter 10 digit only" pattern="[1-9]{1}[0-9]{9}" required>
					
				</label>
			</div>
		</div>

		<div class="row">
			<div class="medium-4 column">
				<label for="artist_email_address"><br>Notes
					<textarea placeholder="Feel free to add a note to your appointment." rows="4" name="note" class="note" id="note"></textarea>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="small-1 columns">
				<button class="primary button" name="previous" id="previous">
					<span>Previous</span>
				</button>
			</div>
			<div class="small-1 columns">
				<button class="primary button" type="submit" name="submit" id="submit">
					<span>Next</span>
				</button>
			</div>
			<div class="column">
			</div>
		</div>
	</form>
</body>


<script>
	$("#contact_number").intlTelInput();
	$("#previous").click(function(){
		window.location.href = "/src/Contribution_Introduction.php";
	});
</script>
</script>


<?php
include 'footer.php';
?>