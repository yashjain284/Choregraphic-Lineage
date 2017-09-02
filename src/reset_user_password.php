<html>
	<head>
		<title>Password Change</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/profile_form.css">
		<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
	</head>
	
	<body>
		<div class="container">
		<center>
			<div id="user_profile_intro">
			<center>
					<h3>Password Change</h3>
			</center>
			</div>
			<br>
			<fieldset class="user_profile_fieldset">
				<form id="add_user_profile_form" name="add_user_profile_form" method="post" action="user-profile-uploadrename-timestamp.php" onsubmit="return validateForm();" enctype="multipart/form-data">
				
					<div id="user_profile_group" class="form-group">
					
						<label for="user_name" class="compulsory_field">One Time Password</label>
						<div class="form-group">
							<input class="form-control-my" maxlength=25 autocomplete="off" type="password" id="user_old_password" name="user_old_password" placeholder="Old Password" required>
						</div>
						<label for="user_email_address" class="compulsory_field">New Password</label>
						<div class="form-group">
							<input class="form-control-my" maxlength=25 autocomplete="off" type="password" id="user_new_password" name="user_new_password" placeholder="New Password" >
						</div>
						<label for="user_email_address" class="compulsory_field">Re-enter New Password</label>
						<div class="form-group">
							<input class="form-control-my" maxlength=25 autocomplete="off" type="password" id="user_rnew_password" name="user_rnew_password" placeholder="Re-enter New Password" >
						</div>
					</div>
				<!--
				</fieldset>
				</div>
				<br>
				-->
					<button class="btn" type="submit" name="password_change_submit" value="<?php echo $_SESSION['SESS_USER_NAME']; ?>" required>Change Password</button>
				</form>
			</fieldset>
		</center>
		</div>
	</body>
</html>