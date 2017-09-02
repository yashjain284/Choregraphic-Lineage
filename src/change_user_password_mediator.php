<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';
	
	my_session_start();
	
	include 'connection_open.php';
	
	$user_email_address =  mysql_real_escape_string($_POST['user_email_address']);
	$user_old_password =  mysql_real_escape_string($_POST['user_old_password']);
	$user_new_password =  mysql_real_escape_string($_POST['user_new_password']);
	
	$query = "SELECT * FROM user_profile 
	WHERE user_email_address='$user_email_address' AND user_password='$user_old_password'";
	
	$result = mysql_query($query)
    or die('Error querying database.: '  .mysql_error($dbc));
	
	$count=mysql_num_rows($result);
	if($count==1){
		// echo "Password Changed";
		$user_one_time_password = rand(100000, 999999);
		
		$query = "UPDATE user_profile  
		SET user_password='$user_new_password', user_one_time_password='$user_one_time_password'
		WHERE user_email_address='$user_email_address'";
		
		$result = mysql_query($query)
		or die('Error querying database.: '  .mysql_error($dbc));
		
		echo "Password Changed";
		session_destroy(); 

	}
	else{
		$query = "SELECT * FROM user_profile 
		WHERE user_email_address='$user_email_address'";
		
		$result = mysql_query($query)
		or die('Error querying database.: '  .mysql_error($dbc));
		
		$count=mysql_num_rows($result);
		$_SESSION["error_flag"] = "y";
		$_SESSION["email"] = $user_email_address;
		if($count==1){
			$_SESSION["change_user_password"]="Enter Correct Old Password";
		}
		else{
			$_SESSION["change_user_password"]="Profile Does Not Exists";
		}
		
		include 'connection_close.php';
		header('Location: change_user_password.php');
	}
	
	
?>