<div class="row">
	<div class="medium-12">
		<section>
<?php
if(isset($_SESSION["user_email_address"])){
	echo "<div class='text-right'>";
	echo "Logged in as ".$_SESSION["user_email_address"]."&nbsp;<a href='logout.php'>Logout</a>";
	echo "</div>";
}
?>
		</section>
	</div>
</div>
<!--
<div class="row">
	<div class="medium-12">	
-->
<footer class="row" style="position:relative; bottom:0;">
	<!--<div>-->
		<div class="small-6 column">
			<ul class="vertical medium-horizontal menu">
				<li><a href="#">Home</a></li>
				<li><a href="#">FAQ</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</div>
		<div class="small-6 column">
			<ul class="menu align-right">
				<li class="menu-text"><small>Choreographic Lineage © 2017</small></li>
			</ul>
		</div>
	<!--</div>-->
</footer>
<!--
	</div>
</div>
-->	
