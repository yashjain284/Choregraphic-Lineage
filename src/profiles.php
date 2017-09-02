<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();
	// $_SESSION["user_email_address"] = "test@email.com";
	// $_SESSION["add_user_profile"] = "User with email already exists!";;
?>

<html>
	<head>
		<title>Artist Profiles</title>
	</head>

	<body>
	<div class="row">
			<div class="medium-12">
				<section>
					<form id="profiles_form" name="profiles_form" method="post" action="profiles_mediator.php" enctype="multipart/form-data">
					<fieldset>
					<legend><strong><h3>Artist Profiles</h3></legend></strong>
						<div class="row">
							<div class="small-12 column">
				<?php
					if(isset($_SESSION["user_email_address"])){
						$user_email_address = $_SESSION["user_email_address"];
						$user_firstname = $_SESSION["user_firstname"];
						$user_lastname = $_SESSION["user_lastname"];
						$user_id = $_SESSION["user_id"];

						$_SESSION = [];
						$_SESSION["user_email_address"] = $user_email_address;
						$_SESSION["user_firstname"] = $user_firstname;
						$_SESSION["user_lastname"] = $user_lastname;
						$_SESSION["user_id"] = $user_id;

						$user_email_address = $_SESSION["user_email_address"];

						include 'connection_open.php';

						$query = "SELECT * FROM artist_profile
						WHERE profile_name='$user_email_address'";

						$result = mysql_query($query)
						or die('Error querying database.: '  .mysql_error());

						$count=mysql_num_rows($result);

						if($count==0){
							echo "<legend><strong>No artist profiles. Create a new one!</legend></strong>";
						}
						else{
							// echo "<legend><strong><h1>Artist Profiles</h1></legend></strong>";
						?>
							<table>
								<thead>
									<tr>
										<th width="200">Artist Name</th>
										<th width="200">Artist Email Address</th>
										<th width="300"></th>
									</tr>
								</thead>

					<?php
							echo "<tbody>";
							while($resultant = mysql_fetch_array($result)){
								// echo "<tr style='background-color: transparent !important;'>";

								echo "<tr>";
									echo "<td>".$resultant['artist_first_name']." ".$resultant['artist_last_name']."</td>";
									echo "<td>".$resultant['artist_email_address']."</td>";
									echo "<td>";
										echo "<button class='secondary  hollow button' type='submit' name='artist_relation_add' value=".$resultant['artist_profile_id'].">";
										echo "<span>Add Lineal Relationship</span>";
										echo "</button>";

										echo "<button class='success  hollow button' type='submit' name='artist_profile_view' value=".$resultant['artist_profile_id'].">";
										echo "<span>View</span>";
										echo "</button>";

										echo "<button class='primary hollow button' type='submit' name='artist_profile_edit' value=".$resultant['artist_profile_id'].">";
										echo "<span>Edit</span>";
										echo "</button>";

										echo "<button class='alert  hollow button' type='submit' name='artist_profile_delete' value=".$resultant['artist_profile_id']." onclick='return confirmDelete();'>";
										echo "<span>Delete</span>";
										echo "</button>";

									echo "</td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
						}
					}
					?>
							</div>
						</div>
						<div class = "row">
							<div class="small-3 column">
								<button class="secondary hollow button" type="submit" name="artist_profile_add" value="<?php echo $user_email_address; ?>">
									<span>Add Artist</span>
								</button>
							</div>

				<?php

					if($count!=0){
				?>
				<!--
							<div class="small-3 column">
								<button class="secondary hollow button" type="submit" name="artist_relation_add" value="<?php echo $user_email_address; ?>">
									<span>Add Relation</span>
								</button>
							</div>
						-->
				<?php
					}
				?>
							<div class="small-3 column">
								&nbsp;
							</div>
							<div class="small-3 column">
								&nbsp;
							</div>
						</div>
					</fieldset>
					</form>
				</section>
			</div>
		</div>
	</body>

<?php
	include 'footer.php';
?>
	<script>
	function confirmDelete(){
		var c = confirm("Warning: You are about to delete this entire profile! Click 'OK' to cancel.");
		return c;
	}
	</script>

</html>
