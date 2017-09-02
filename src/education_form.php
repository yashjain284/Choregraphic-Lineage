<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();



?>
<html>
<head>
	<title>Add Artist</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
	<div class="row">
		<div class="medium-8 column">
			<section>
				<form id="add_user_profile_form" name="add_user_profile_form" method="post" action="user_profile_mediator.php" enctype="multipart/form-data">
					<fieldset>
						<legend><strong>University/College</strong></legend>
						<div id="education_container">
							<div id="education_entries" class="row" >
								<div class="small-4 column">
									<label for="artist_first_name">Name
										<input  autocomplete="off" type="text" id="unoversity_name" name="artist_first_name" placeholder="Name of the school/Univrsity" required>
									</label>
								</div>
								<div class="small-4 column">
									<label for="artist_last_name">Major
										<input  autocomplete="off" type="text" id="major" name="artist_last_name" placeholder="Name of the Major" required>
									</label>
								</div>
								<div class="small-4 column">
									<label for="artist_email_address">Degree
										<input  autocomplete="off" type="text" id="degree" name="artist_email_address" placeholder="Name of the degree earned">
									</label>
								</div>
								
							</div>
						</div>
						
					</fieldset>
				</form>
			</section>
		</div>
		<div class="medium-4 column">
			<br><br>
			<button class="secondary hollow button" id="add" type="button">
				<span>Add another college/university</span>
			</button>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){

		$("#add").click(function(){
			$("#education_entries").clone().insertAfter("#education_entries");
		});
	});
</script>
<?php
include 'footer.php';
?>
</html