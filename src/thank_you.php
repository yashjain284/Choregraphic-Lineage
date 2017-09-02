<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();


error_reporting(0);

if(isset($_SESSION["user_email_address"])){
	$user_email_address = $_SESSION["user_email_address"];
	$firstName = mysql_real_escape_string($_POST['first_name']);
	$lastName =  mysql_real_escape_string($_POST['last_name']);
	$email =  mysql_real_escape_string($_POST['email_address']);
	$date =  mysql_real_escape_string($_POST['appointment_date']);
	$contact = mysql_real_escape_string($_POST['contact_number']);
	$note = mysql_real_escape_string($_POST['note']);




	include 'appointment_mail_template.php';
	$message = $message."".$date;
	mail($user_email_address, $subject, $message, $headers);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Thank You</title>
</head>
<style type="text/css">
	.confirmation_container{
		margin-top: 3%;
	}
	.p{
		word-wrap: normal;
	}
	.button_container{
		margin: auto;
	}
</style>
<body>
	<div class="confirmation_container">
		<div class="row">
			<div class="small-12 medium-8 large-8 small-centered columns">
				<h1 class="text-center">Thank you for your contribution!</h1>
			</div>
		</div>
		<div class="row">
			<div class="small-12 small-centered columns">
				<p>Please review the terms and conditions below. Send any comments or questions regarding this survey or the Choregraphic Lineage project to <strong><a>aceto@buffalo.edu</a></strong><br>Check back in to days to see your name in the network.<br></p>
				<!-- <p>
					Many Thanks<br>
					<strong>The Choreographic Lineage Team</strong><br>
					Melanie Aceto, Director<br>
					Dr. Bina Ramamurthy, Data Scientist<br>
					Renee Ruffino, Graphic Designer<br>
					Dominic Licata, User Experience Designer<br>
					Jay Shah, Graduate Student Research Assistant<br>
					Yash Jain, Graduate Student Research Assistant<br>
					Sumedh Ambokar, Graduate Student Research Assistant<br>
					Mangesh Viilas Kaslikar, Graduate Student Research Assistant<br><br>
				</p> -->
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="small-12 small-centered columns">
				<p align="justify">

					<strong>TERMS AND CONDITIONS</strong><br><br>
					<ol>
						<li>You are filling this form out voluntarily.<br></li>
						<li>You are aware that the information you provide will be used as a global resource, accessible to the general public, unless otherwise noted in the survey. <br></li>
						<li>Choreographic Lineage will not sell, share or rent your personal information to any third party or use your e-mail address for unsolicited mail. Any emails sent by Choreograhic Lineage will only be in connection with the Choreographic Lineage resource. <br></li>
						<li>The information you provide to Choreographic Lineage is accurate to the best of your knowledge. <br></li>

					</ol>

					Go ahead and click on the <strong>"Submit your lineage"</strong> to submit the form or you can go back to make any corrections.<br>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="small-2 columns">
				<button class="primary button expanded" id="previous" type="button">
					<span><strong>GO BACK</strong></span>
				</button>
			</div>
			<div class="small-3 columns">
				<button class="primary button expanded" id="next" type="button">
					<span><strong>SUBMIT MY LINEAGE</strong></span>
				</button>
			</div>
			<div class="column">
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("#previous").click(function() {
			window.open("/src/add_lineage.php","_self");
		});

		$("#next").click(function() {
			window.open("/src/profiles.php","_self");
		});
</script>
</body>
</html>
