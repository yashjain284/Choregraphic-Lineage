<?php

	include 'path.php';
	include 'menu.php';
	include 'util.php';
	
	my_session_start();
	$_SESSION["user_email_address"] = "test@email.com";
	
	if(isset($_SESSION["user_email_address"])){
		$user_email_address = $_SESSION["user_email_address"];
	}
	else{
		header("Location: add_user_profile.php");
	}
	
	$ttime = date("U");
	$relation_id = $user_email_address."_".$ttime;
	
	include 'connection_open.php';
	
	$my_artist =  mysql_real_escape_string($_POST['my_artist']);
	$other_artist =  mysql_real_escape_string($_POST['other_artist']);
	
	if($my_artist != $other_artist){
	
		$query = "SELECT * FROM artist_profile WHERE artist_name = '$my_artist' AND profile_name ='$user_email_address'";
		
		$result = mysql_query($query)
		or die('Error querying database.: '  .mysql_error($dbc));
		
		$count=mysql_num_rows($result);
		if($count>=1){
			
			while($resultant = mysql_fetch_array($result)){
				$my_id = $resultant['artist_profile_id'];
			}
			
			$query = "SELECT * FROM artist_profile WHERE artist_name = '$other_artist'";
		
			$result = mysql_query($query)
			or die('Error querying database.: '  .mysql_error($dbc));
			
			$count=mysql_num_rows($result);
			if($count>=1){
				
				while($resultant = mysql_fetch_array($result)){
					$other_id = $resultant['artist_profile_id'];
				}
				
				if(!empty($_POST['relation_list'])) {
					foreach($_POST['relation_list'] as $relation) {
						// echo $check;
						$query = "INSERT INTO artist_relation 
						(
						relation_id,
						artist_profile_id_1,
						artist_profile_id_2,
						artist_name_1,
						artist_name_2,
						artist_relation)  
						VALUES 
						(
						'$relation_id',
						'$my_id',
						'$other_id',
						'$my_artist',
						'$other_artist',
						'$relation'
						)";
						
						$result = mysql_query($query)
						or die('Error querying database.: '  .mysql_error($dbc));
					}
					$location = "";
				echo "Added Relationships";
				}
				else{
					$_SESSION["add_relation_error"] = "Please select atleast one relationship!";
					$location = "add_relation.php";
				}
				
			}
			else{
				$_SESSION["add_relation_error"] = "Please select artists from suggestions!";
				$location = "add_relation.php";
			}
			
		}
		else{
			$_SESSION["add_relation_error"] = "Please select artists from suggestions!";
			$location = "add_relation.php";
		}		
	}
	else{
		$_SESSION["add_relation_error"] = "Please select different artists!";
		$location = "add_relation.php";
	}
	include 'connection_close.php';
	// echo $_SESSION["add_relation_error"];
	header("Location: ".$location."");
?>