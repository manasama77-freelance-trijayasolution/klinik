	<?php
	$db_host		="localhost";
	$db_user		="root";
	$db_pass		="";
	// $db_pass		="m355age45";
	$db_name		="demo_flexcodesdk";

	$conn = mysql_connect($db_host, $db_user, $db_pass);
	if (!$conn) die("Connection for user $db_user refused!");
	mysql_select_db($db_name, $conn) or die("Can not connect to database!");
?>

