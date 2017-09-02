<?php
include 'path.php';
include 'util.php';

my_session_start();

if(isset($_SESSION["artist_profile_id"]) and isset($_SESSION["user_email_address"])){
	$artist_profile_id = $_SESSION["artist_profile_id"];
	//echo $artist_profile_id;
	$user_email_address = $_SESSION["user_email_address"];
	//echo $user_email_address;
}
if(isset($_FILES["file"]["type"]))
{
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) 
		&& ($_FILES["file"]["size"] < 4194304)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) 
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("photo_upload_data/" . $_FILES["file"]["name"])) {
				echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{

				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "photo_upload_data/".$_FILES['file']['name']; // Target path where file is to be stored
				$_SESSION["photo_file_path"] = $targetPath;
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
				//echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
				//echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
				//echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				//echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
				include 'connection_open.php';

				$query = "UPDATE artist_profile
				SET artist_photo_path = '$targetPath' 
				WHERE artist_profile_id='".$_SESSION["artist_profile_id"]."'";
				$result = mysql_query($query)
				or die('Error querying database.: '  .mysql_error($dbc));
				include 'connection_close.php';
				// $location = "about_lineage.php";
				// header("Location: ".$location."");
			}
		}
	}
	else
	{
		echo "<span id='invalid'>***Invalid file Size or Type***<span>";
	}
}
?>