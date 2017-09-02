<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';
	
	my_session_start();
	
	include 'connection_open.php';
	
	$user_email_address =  mysql_real_escape_string($_POST['user_email_address']);
	$user_one_time_password = rand(100000, 999999);
	
	include 'mail_template.php';
	$message = $message."".$user_one_time_password;
	mail($user_email_address,$subject,$message, $headers);
	
	$query = "UPDATE user_profile  
	SET user_one_time_password='$user_one_time_password'
	WHERE user_email_address='$user_email_address'";
	
	$result = mysql_query($query)
    or die('Error querying database.: '  .mysql_error($dbc));
	
	include 'connection_close.php';
	
	session_start();
	$_SESSION["set_user_password"] = "Check your email for a one-time password";
	$_SESSION["email"] = $user_email_address;
	header('Location: set_user_password.php');
?>