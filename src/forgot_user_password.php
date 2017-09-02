<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';
	
	my_session_start();
?>
<html>
	<head>
		<title>Password Reset</title>		
		<script src="set_password_validation.js"></script>
	</head>
	
	<body>
		<div class="row">
			<div class="medium-8 column">
				<section>
					<form id="add_user_profile_form" name="add_user_profile_form" method="post" action="forgot_user_password_mediator.php" onsubmit="return validateSetForm()" enctype="multipart/form-data">
						<fieldset>
						<legend><strong>Forgot your password?</legend></strong>
							
							<div class="row">
								<div class="small-12 column">
									<label for="user_email_address">Email Address <small>Required</small>
										<input  autocomplete="off" type="text" id="user_email_address" name="user_email_address" <?php if(isset($_SESSION["email"])) echo "value = ".$_SESSION["email"]; ?> placeholder="Email Address" required>
									</label>
								</div>
								<div class="small-12 column">
									<button class="secondary hollow button" type="submit" name="password_change_submit">
										<span>Request Change Password</span>
									</button>
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
</html>