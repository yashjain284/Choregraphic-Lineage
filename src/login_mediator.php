<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();

	include 'connection_open.php';

	$user_email_address =  $_POST['user_email_address'];
	$user_password =  mysql_real_escape_string($_POST['user_password']);

	$query = "SELECT * FROM user_profile
	WHERE user_email_address='$user_email_address' and user_password='$user_password'";

	$result = mysql_query($query)
    or die('Error querying database.: '  .mysql_error());

	$count=mysql_num_rows($result);
	if($count==1){
		$_SESSION["user_email_address"] = $user_email_address;
		$firstrow = mysql_fetch_assoc($result);
		$_SESSION["user_firstname"] = $firstrow["user_first_name"];
		$_SESSION["user_lastname"] = $firstrow["user_last_name"];
		$_SESSION["user_id"] = $firstrow["user_id"];
		echo "Logged in as: ".$user_email_address;
		$location = "profiles.php";
	}
	else{
		$_SESSION["login_message"] = "Incorrect credentials!";
		$location = "add_user_profile.php";
	}

	include 'connection_close.php';
	header("Location: ".$location."");

?>
