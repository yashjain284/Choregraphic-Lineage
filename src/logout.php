<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';
	
	my_session_start();
	
	my_session_destroy();
	
	header("Location: index.php");
?>