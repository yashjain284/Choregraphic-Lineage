<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

include 'connection_open.php';

$first_name =  mysql_real_escape_string($_POST['first_name']);
$last_name =  mysql_real_escape_string($_POST['last_name']);
$user_email_address =  mysql_real_escape_string($_POST['user_email_address']);
$query = "SELECT * FROM user_profile 
WHERE user_email_address='$user_email_address'";

$result = mysql_query($query)
or die('Error querying database.: '  .mysql_error($dbc));

$count=mysql_num_rows($result);
if($count==0){
	
	$user_password = "PGlYFveq56MdwCoEiCaC";
	$user_one_time_password = rand(100000, 999999);
	
	include 'mail_template.php';
	$message = $message."".$user_one_time_password;
	mail($user_email_address, $subject, $message, $headers);
	
	$query = "INSERT INTO user_profile 
	(
	user_first_name,
	user_last_name,
	user_email_address,
	user_password,
	user_one_time_password)  
	VALUES 
	(
	'$first_name',
	'$last_name',
	'$user_email_address',
	'$user_password',
	'$user_one_time_password'
	)";
	
	$result = mysql_query($query)
	or die('Error querying database.: '  .mysql_error($dbc));
	
	$_SESSION["set_user_password"] = "Check your email for a one-time password";
	$_SESSION["email"] = $user_email_address;
	$location = "set_user_password.php";
}
else{
	$_SESSION["add_user_profile"] = "User with email already exists!";
	$location = "add_user_profile.php";
}

include 'connection_close.php';
header("Location: ".$location."");
?>