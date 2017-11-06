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
	$contact = mysql_real_escape_string($_POST['contact_number']);
	$note = mysql_real_escape_string($_POST['note']);

	// echo "Name : ".$firstName." ".$lastName."<br>" ;
	// echo "Email : ".$email."<br>" ;
	// echo "Contact Number : ".$contact."<br>" ;
	// echo "Message : ".$note."<br>" ;

	include 'appointment_mail_template.php';
	mail($user_email_address, $subject, $message, $headers);

	include 'connection_open.php';

	$query = "INSERT INTO phone_appointments
	(
	first_name,
	last_name,
	email,
	contact,
	note)  
	VALUES 
	(
	'$firstName',
	'$lastName',
	'$email',
	'$contact',
	'$note'
	)";

	$result = mysql_query($query)
	or die('Error querying database.: '  .mysql_error($dbc));

	include 'connection_close.php';
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointment Confirmation</title>
</head>
<style type="text/css">
	.confirmation_container{
		margin-top: 6%;
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
				<h2 class="text-center">Thank you for your interest in Choreographic Lineage</h2> 
				<h4 class="text-center"><em>A team member will contact you soon to arrange a lineage appointment.</em></h4>
			</div>
		</div>
		<div class="row">
			<div class="small-12 medium-8 large-8 small-centered columns"> 
				<p class="text-center">Please check your inbox at <br>
					<strong><?php echo $user_email_address?></strong></p>
				</div>
			</div>
		<!-- <div class="row">
			<div class="small-6 small-centered columns"> 
				<p class="text-center"><em>Looking forward to talk to you...</em></p>
			</div>
		</div> -->
		<hr width="30%">

		<div class="row">
			<div class="small-12 medium-8 large-5 small-centered columns"> 
				<h4 class="text-center">Having trouble or need to reschedule?</h4> 
			</div>
			<p class="text-center"> Contact us at choreographiclineage@gmail.com &nbsp; OR &nbsp; <strong><a>+1(716) 645-0605</a></strong><br></p>
		</div>
		<div class="row">
			<div class="button_container small-12 medium-8 large-2 small-centered columns"> 
				<a href="profiles.php" class="button radius text-center">BACK TO HOME</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>

