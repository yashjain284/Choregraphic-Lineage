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
if(isset($_POST["biography_text"])){

	$biography_text = $_POST["biography_text"];
	$_SESSION["biography_text"] = $biography_text;
	include 'connection_open.php';
	$query = "UPDATE artist_profile
	SET artist_biography_text = '$biography_text'
	WHERE artist_profile_id='".$_SESSION["artist_profile_id"]."'";
	$result = mysql_query($query)
	or die('Error querying database.: '  .mysql_error($dbc));
	include 'connection_close.php';
	echo " &nbsp; &nbsp; &nbsp; Your biography has been saved.";

}
if(isset($_FILES["bio_file"]["type"]))
{
	$validextensions = array("pdf", "docx", "doc");
	$temporary = explode(".", $_FILES["bio_file"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["bio_file"]["type"] == "application/pdf") || ($_FILES["bio_file"]["type"] == "application/msword") || ($_FILES["bio_file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) 
		&& ($_FILES["bio_file"]["size"] < 4194304)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) 
	{

		if ($_FILES["bio_file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["bio_file"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("biography_upload_data/" . $_FILES["bio_file"]["name"])) {
				echo $_FILES["bio_file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['bio_file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "biography_upload_data/".$_FILES['bio_file']['name']; // Target path where file is to be stored
				$_SESSION["biography_file_path"] = $targetPath;
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "<span id='success'>Biographt uploaded successfully...!!</span><br/>";
				// echo "<br/><b>File Name:</b> " . $_FILES["bio_file"]["name"] . "<br>";
				// echo "<b>Type:</b> " . $_FILES["bio_file"]["type"] . "<br>";
				// echo "<b>Size:</b> " . ($_FILES["bio_file"]["size"] / 1024) . " kB<br>";
				//echo "<b>Temp file:</b> " . $_FILES["bio_file"]["tmp_name"] . "<br>";
				include 'connection_open.php';

				$query = "UPDATE artist_profile
				SET artist_biography = '$targetPath'
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