	<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

if(!isset($_SESSION['artist_profile_view']) && isset($_SESSION["user_email_address"])){

	$biography = $_POST['biography_text'];
	echo $biography."<br>";

//Code for BioGraphy File
	if($_FILES['profile_photo']['name'])
	{
		if(!$_FILES['profile_photo']['error'])
		{
			$photoName = $_FILES['profile_photo']['name'];
			$photoSize = $_FILES['profile_photo']['size'];
			echo "Old File Name : ".$photoName."<br>";
			//now is the time to modify the future file name and validate the file

			echo "<br> Size of the file is :".$photoSize."<br>";

			$valid_file = true;
			if($_FILES['profile_photo']['size'] > (10485760)) //can't be larger than 1 MB
			{
				$valid_file = false;
				$message = 'Oops!  Your file\'s size is to large.';
				echo $message;
			}
			//if the file has passed the test
			if($valid_file)
			{
				$newPath = 'photo_upload_data/'.$photoName;
				move_uploaded_file($_FILES['profile_photo']['tmp_name'], $newPath);
				$message = 'Congratulations!  Your file was accepted.';
				echo $message;
			}
		}
		else//If there is an arror
		{
			$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['profile_photo']['error'];
			echo $message;
		}
		include 'connection_open.php';

		$query = "UPDATE artist_profile
		SET artist_biography_text = '$biography', artist_photo_path = '$newPath'
		WHERE artist_profile_id='".$_SESSION["artist_profile_id"]."'";
		$result = mysql_query($query)
		or die('Error querying database.: '  .mysql_error($dbc));
		include 'connection_close.php';
	}
	$location = "about_lineage.php";
	header("Location: ".$location."");
}



//you get the following information for each file:
// echo $_FILES['biography_file']['name']."\n";
// echo $_FILES['biography_file']['size']."\n";
// echo $_FILES['biography_file']['type']."\n";
// echo $_FILES['biography_file']['tmp_name']."\n";
?>
