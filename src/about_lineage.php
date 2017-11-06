<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

if(isset($_SESSION["artist_profile_id"]) and isset($_SESSION["user_email_address"])){
	$artist_profile_id = $_SESSION["artist_profile_id"];
		// echo $artist_profile_id;
	$user_email_address = $_SESSION["user_email_address"];
		// echo $user_email_address;
}
else{
		// header("Location: add_user_profile.php");
}

?>

<html>
<head>
	<title>About Lineage</title>

</head>

<body>
	<?php
		include 'form_links_header.php'
	?>
	<form id="biography" class="biography">
		<div class="row">
			<div class="progress" role="progressbar" tabindex="0" aria-valuenow="70" aria-valuemin="0" aria-valuetext="70 percent" aria-valuemax="100">
			  <span class="progress-meter" style="width: 70%">
			    <p class="progress-meter-text">70%</p>
			  </span>
			</div>
		</div>
		<div class="row">
			<p align="middle"><h2><strong>ABOUT LINEAGE</strong></h2></p>
		</div>
		<div class="row">
			<p>There are four types of lineal lines or <strong>Relationships:</strong></p>
			<p>1. <strong>DANCED FOR </strong> - Choregraphers for whom you have danced.<br>
			2. <strong>STUDIED WITH</strong> - Teachers with whom you have studied.<br>
			3. <strong>COLLABORATED WITH</strong> - Artists with whom you have collborated.<br>
			4. <strong>INFLUENCED BY </strong> - People who have significantly influenced your work, such as artists, authors, philosophers, etc. You do not need to have a <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;relationship with this person in order to list them as having an impact on your work.<br><br>
			<br><br>
			<strong>Please click the "Next" button to contribute artist's lineage.</strong>
			</p>


		</div>







		<div class="row">
			<div class="large-2 small-8 columns">
				<button class="primary button float-right" type="button" name="user_profile_submit" id="previous">
					<span>Previous</span>
				</button>
			</div>
			<div class="large-2 small-8 columns">
				<button class="primary button" type="button" name="user_profile_submit" id="next">
					<span>Next</span>
				</button>
			</div>
			<div class="column">
			</div>
		</div>
	</form>

	<script>
		$("#previous").click(function() {
		// onclick event is assigned to the #button element.
			window.open("/src/add_artist_biography.php","_self");

		  //document.location.href = "/src/add_artist_personal_information.php",true;
		});
		// onclick event is assigned to the #button element.
		$("#next").click(function() {
			window.open("/src/add_lineage.php","_self");
		});
	</script>

</body>

<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>
