<?php
$mysql_hostname = "localhost";
$mysql_user="root";
$mysql_password="";
$mysql_database="choreographic_lineage";
$connection = mysql_connect( $mysql_hostname , $mysql_user , $mysql_password);
$dbc = mysql_select_db($mysql_database);

//echo @mysql_ping() ? 'true' : 'false';

// $dbc = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database)
// 		or die('Error connecting to MySQL server.');
?>