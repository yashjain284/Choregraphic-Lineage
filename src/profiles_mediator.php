<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();


	if(isset($_POST['artist_profile_delete'])){

		$artist_profile_id = $_POST['artist_profile_delete'];
		include 'connection_open.php';
		$query = "DELETE FROM artist_profile WHERE artist_profile_id='$artist_profile_id'";
		$result = mysql_query($query)
		or die('Error querying database.: '  .mysql_error($dbc));
		include 'connection_close.php';
		$location = "profiles.php";
		header("Location: ".$location."");
	}
	else if(isset($_POST['artist_profile_add'])){

		$_SESSION["user_email_address"] = $_POST['artist_profile_add'];
		$_SESSION["artist_profile_add"] = "add";
		$location = "Contribution_Introduction.php";
		// $location = "add_artist_profile.php";
		header("Location: ".$location."");
	}
	else if(isset($_POST['artist_profile_edit'])){

		$_SESSION["artist_profile_id"] = $_POST['artist_profile_edit'];
		$_SESSION["artist_profile_edit"] = "edit";
		$location = "artist_database_retrieval.php";
		header("Location: ".$location."");
	}
	else if(isset($_POST['artist_profile_view'])){

		$_SESSION["artist_profile_id"] = $_POST['artist_profile_view'];
		$_SESSION["artist_profile_view"] = "view";
		$location = "artist_database_retrieval.php";
		header("Location: ".$location."");
	}
	else if(isset($_POST['artist_relation_add'])){

		$_SESSION["artist_profile_id"] = $_POST['artist_relation_add'];
		$_SESSION["artist_relation_add"] = "relation";
		$location = "add_artist_relation_mediator.php";
		header("Location: ".$location."");
	}
?>
