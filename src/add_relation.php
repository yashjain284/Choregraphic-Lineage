<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';
	
	my_session_start();
?>

<html>
	<head>
		<title>Add Relationship</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
	</head>
	
	<body>
		<div class="row">
			<div class="medium-8 column">
				<section>
					<form id="add_relation_form" name="add_relation_form" method="post" action="add_relation_mediator.php">
						<fieldset>
							<legend><strong>Add Relations</strong></legend>
							<?php
								if(isset($_SESSION["add_relation_error"])){
									echo "<font color=red>".$_SESSION["add_relation_error"]."</font>";
									my_session_unset();
								}
							?>
							<div class="row collapse">
								<div class="small-12 column">
									<label for="user_name">Artist 1 <small> Required</small>
										<input  autocomplete="off" type="text" id="my_artist" name="my_artist" placeholder="My Artists" required >
										
									</label>
								</div>
								<div class="small-12 column">
									<label for="user_name">Artist 2<small> Required</small>
										<input  autocomplete="off" type="text" id="other_artist" name="other_artist" placeholder="Other Artists" required>
									</label>
								</div>
								<div class="small-12 column">
									<label>Relationship (Artist 1 having Artist 2)<small> Required</small></label>
								</div>
								<div class="small-3 column"><input name="relation_list[]" id="1" value="Studied With" type="checkbox"><label for="1">Studied With</label></div>
								<div class="small-3 column"><input name="relation_list[]" id="2" value="Danced For" type="checkbox"><label for="2">Danced For</label></div>
								<div class="small-3 column"><input name="relation_list[]" id="3" value="Collaborated With" type="checkbox"><label for="3">Collaborated With</label></div>
								<div class="small-3 column"><input name="relation_list[]" id="4" value="Infulenced By" type="checkbox"><label for="4">Infulenced By</label></div>
								
								<div class="small-12 column">
									<button class="secondary hollow button" type="submit" name="relation_submit">
										<span>Add Relation</span>
									</button>
								</div>
							</div>
						</fieldset>
					</form>
				</section>
			</div>
		</div>
	</body>
	<script>
			$(function() {
    			$("#my_artist").autocomplete({
        		source: 'my_artist_list.php'
    		});

    		$("#other_artist").autocomplete({
        		source: 'other_artist_list.php'
    		});
		});
	</script>
<?php
	include 'footer.php';
?>
	
</html>